<?php
    class reportdata
    {
        private $connection;
        private $database;
        function __construct( $conn, $db )
        {
            $this->connection = $conn;
            $this->database = $db;
        }
        /*---------------------------Get Parts For This Brand-----------------------------*/
        function getpartsforthisbrand($brandid)
        {
            $brandid=mysql_real_escape_string($brandid);
            $qry ="select j.idPart,p.partName from junctionbp j inner join part p on p.idPart=j.idPart where j.idBrand='$brandid'";
            $result = mysql_query( $qry, $this->connection ) or throwerror(new Exception(mysql_error()));
            $numofrows=mysql_num_rows($result);
            if($numofrows!=0)
            {
                while($row= mysql_fetch_array($result))
                {
                    $resultArr['partid'][]= $row['idPart'];
                    $resultArr['partname'][]= $row['partName'];
                }
                $resultArr['Status']="true";
                $resultArr['DetailedStatus']="Above are the Parts available against the brandid=".$brandid;
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="No part available against the brandid=".$brandid;
            }
            return $resultArr;
        }
        /*---------------------------Get Parts For This Brand-----------------------------*/

        /*--------------------------Add Brand Method Start--------------------------------*/
        function addbrand($brandname,$partid)
        {
            $brandname=mysql_real_escape_string($brandname);
            $partid=mysql_real_escape_string($partid);
            $resultArr=array();
            if($brandname!='' && $partid!=-1)
            {
                $qry="select * from brand where brandName='$brandname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into brand (brandName,dateBrandCreated)values('$brandname',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $qry="select * from brand order by idBrand desc limit 1";
                    $result=mysql_query($qry) or die (mysql_error());
                    $row=mysql_fetch_assoc($result);
                    $brandid=$row['idBrand'];

                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Brand ID: ".$brandid." successfully inserted into Brand table";
                }
                else
                {
                    $qry="select * from brand where brandName='$brandname'";
                    $result=mysql_query($qry) or die (mysql_error());
                    $row=mysql_fetch_assoc($result);
                    $brandid=$row['idBrand'];

                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Brand ID: ".$brandid." already exist in Brand table";
                }
                $qry="select * from junctionbp where idBrand='$brandid' and idPart='$partid'";
                $trackable=100;
                $result=mysql_query($qry) or die (mysql_error());
                $numofrowsInJunBp=mysql_num_rows($result);
                if($numofrowsInJunBp==0)
                {
                    $qryinsert="insert into junctionbp (idbrand,idPart,trackable)values('$brandid','$partid','$trackable')";
                    mysql_query($qryinsert)or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Brand ID: ".$brandid." with Part ID: ".$partid." and Trackable: ".$trackable." successfully                                inserted into junctionbp";
                }
                else
                {
                    $resultArr['DetailedStatus']="Brand Name: ".$brandname." with Part ID: ".$partid.", already exist system.";
                    $resultArr['Status']="false";
                }
            }
            else if($brandname!='' && $partid==-1)
            {
                $qry="select * from brand where brandName='$brandname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into brand (brandName,dateBrandCreated)values('$brandname',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['DetailedStatus']="Brand Name: ".$brandname." added successfully to Brand table. Goto addpart.php if you want to associate                    any part with this brand";
                    $resultArr['Status']="true";
                }
                else
                {
                    $resultArr['DetailedStatus']="This brand name already exist in Brand table";
                    $resultArr['Status']="false";
                }
            }
            else
            {
                $resultArr['DetailedStatus']="An unknown error occured in addbrand() method of graph.php";
                $resultArr['Status']="false";
            }
            return $resultArr;
        }
        /*----------------------------Add Brand Method End-------------------------*/


        /*--------------------------Add Part Method Start--------------------------------*/
        function addpart($partname,$brandid,$rackid,$parttype,$partdiscription)
        {
            $partname=mysql_real_escape_string($partname);
            $brandid=mysql_real_escape_string($brandid);
            $rackid=mysql_real_escape_string($rackid);
            $parttype=mysql_real_escape_string($parttype);
            $partdiscription=mysql_real_escape_string($partdiscription);

            $resultArr=array();
            if($partname!='' && $brandid!=-1)
            {
                $qry="select * from part where partName='$partname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into part (idStore,partName,partType,partNumber,datePartCreated)
                    values('$rackid','$partname','$parttype','$partdiscription',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $qry="select * from part order by idPart desc limit 1";
                    $result=mysql_query($qry) or die (mysql_error());
                    $row=mysql_fetch_assoc($result);
                    $partid=$row['idPart'];

                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Part ID: ".$partid." successfully inserted into Part table";
                }
                else
                {
                    $qry="select * from part where partName='$partname'";
                    $result=mysql_query($qry) or die (mysql_error());
                    $row=mysql_fetch_assoc($result);
                    $partid=$row['idPart'];

                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Part ID: ".$partid." already exist in Part table";
                }
                $qry="select * from junctionbp where idBrand='$brandid' and idPart='$partid'";
                $result=mysql_query($qry) or die (mysql_error());
                $trackable=100;
                $numofrowsInJunBp=mysql_num_rows($result);
                if($numofrowsInJunBp==0)
                {
                    $qryinsert="insert into junctionbp (idbrand,idPart,trackable)values('$brandid','$partid','$trackable')";
                    mysql_query($qryinsert)or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Part ID: ".$partid." with Brand ID: ".$brandid." and Trackable: ".$trackable." successfully                                inserted into junctionbp";
                }
                else
                {
                    $resultArr['DetailedStatus']="Part Name: ".$partname." with Brand ID: ".$brandid.", already exist system.";
                    $resultArr['Status']="false";
                }
            }
            else if($partname!='' && $brandid==-1)
            {
                $qry="select * from Part where partName='$partname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into part (idStore,partName,partType,partNumber,datePartCreated)
                    values('$rackid','$partname','$parttype','$partdiscription',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['DetailedStatus']="Part Name: ".$partname." added successfully to Part table. Goto addBrand.php if you want to                             associate any brand with this brand";
                    $resultArr['Status']="true";
                }
                else
                {
                    $resultArr['DetailedStatus']="This part name already exist in Part table";
                    $resultArr['Status']="false";
                }
            }
            else
            {
                $resultArr['DetailedStatus']="An unknown error occured in addpartd() method of graph.php";
                $resultArr['Status']="false";
            }
            return $resultArr;
        }
        /*----------------------------Add Part Method End-------------------------*/


        /*--------------------------Add Seller Method Start--------------------------------*/
        function addseller($sellername)
        {
            $sellername=mysql_real_escape_string($sellername);
            $resultArr=array();
            if($sellername!='')
            {
                $qry="select * from seller where sellerName='$sellername'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into seller (sellerName,dateSellerCreated)values('$sellername',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Seller Name: ".$sellername." successfully inserted into seller table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Seller Name: ".$sellername." already exist in seller table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Seller Method End-------------------------*/

        /*--------------------------Add Buyer Method Start--------------------------------*/
        function addbuyer($buyername)
        {
            $buyername=mysql_real_escape_string($buyername);
            $resultArr=array();
            if($buyername!='')
            {
                $qry="select * from buyer where buyerName='$buyername'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into buyer (buyerName,dateBuyerCreated)values('$buyername',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Buyer Name: ".$buyername." successfully inserted into buyer table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Buyer Name: ".$buyername." already exist in buyer table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Buyer Method End-------------------------*/

        /*--------------------------Add Issue Method Start--------------------------------*/
        function addissuer($issuername)
        {
            $issuername=mysql_real_escape_string($issuername);
            $resultArr=array();
            if($issuername!='')
            {
                $qry="select * from issue where name='$issuername'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into issue (name,dateCreated)values('$issuername',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Issuer Name: ".$issuername." successfully inserted into issue table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Issuer Name: ".$issuername." already exist in issue table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Issue Method End-------------------------*/

        /*--------------------------Add Return Method Start--------------------------------*/
        function addscrapreceivername($scrapreceivername)
        {
            $scrapreceivername=mysql_real_escape_string($scrapreceivername);
            $resultArr=array();
            if($scrapreceivername!='')
            {
                $qry="select * from return1 where name='$scrapreceivername'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into return1 (name,dateCreated)values('$scrapreceivername',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Scrap Reciever Name: ".$scrapreceivername." successfully inserted into return1 table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Scrap Reciever Name: ".$scrapreceivername." already exist in return1 table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Return Method End-------------------------*/

        /*--------------------------Add User Method Start--------------------------------*/
        function adduser($username,$password,$email,$securityplan)
        {
            $username=mysql_real_escape_string($username);
            $password=mysql_real_escape_string($password);
            $email=mysql_real_escape_string($email);
            $securityplan=mysql_real_escape_string($securityplan);
            $resultArr=array();
            if($username!='' && $password!='' && $email!='' && $securityplan!='')
            {
                $qry="select * from userauth where userName='$username'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into userauth (userName,password,email,accessLevel,dateUserCreated)
                    values('$username','$password','$email','$securityplan',now())";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="User Name: ".$username." successfully inserted into userauth table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="User Name: ".$username." already exist in userauth table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add User Method End-------------------------*/

        /*--------------------------Get Part Details Method Start--------------------------------*/
        function getpartdetails($partname)
        {
            $partname=mysql_real_escape_string($partname);
            $resultArr=array();
            if($partname!='')
            {
                $qry="select * from part where partName='$partname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows!=0)
                {
                    $row=mysql_fetch_assoc($result);
                    $resultArr['partid']=$row['idPart'];
                    $resultArr['parttype']=$row['partType'];
                    $resultArr['partdescription']=$row['partNumber'];
                    $resultArr['datecreated']=$row['datePartCreated'];
                    $resultArr['storeid']=$row['idStore'];

                    $qry1="select * from store where idStore='".$row['idStore']."'";
                    $result1=mysql_query($qry1) or die (mysql_error());
                    $row1=mysql_fetch_assoc($result1);
                    $resultArr['rackname']=$row1['rackDescription'];

                    $qry1="select b.idBrand,b.brandName,j.trackable from junctionbp j
                     inner join brand b on b.idBrand=j.idBrand
                     where j.idPart='".$row['idPart']."' order by j.idJunctionbp desc limit 1";
                    $result1=mysql_query($qry1) or die (mysql_error());
                    $row1=mysql_fetch_assoc($result1);
                    $resultArr['brandname']=$row1['brandName'];
                    $resultArr['brandid']=$row1['idBrand'];
                    $resultArr['trackable']=$row1['trackable'];


                    $resultArr['partname']=$partname;
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Part Name: ".$partname." is already in the part table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Part Name: ".$partname." not fount in part table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Get Part Details Method End-------------------------*/


        /*--------------------------Get Brand Details Method Start--------------------------------*/
        function getbranddetails($brandname)
        {
            $brandname=mysql_real_escape_string($brandname);
            $resultArr=array();
            if($brandname!='')
            {
                $qry="select * from brand where brandName='$brandname'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows!=0)
                {
                    $row=mysql_fetch_assoc($result);
                    $resultArr['brandid']=$row['idBrand'];
                    $resultArr['datecreated']=$row['dateBrandCreated'];

                    $qry1="select p.idPart,p.partName,j.trackable from junctionbp j
                     inner join part p on p.idPart=j.idPart
                     where j.idBrand='".$row['idBrand']."' order by j.idJunctionbp desc limit 1";
                    $result1=mysql_query($qry1) or die (mysql_error());
                    $row1=mysql_fetch_assoc($result1);
                    $resultArr['partname']=$row1['partName'];
                    $resultArr['partid']=$row1['idPart'];
                    $resultArr['trackable']=$row1['trackable'];


                    $resultArr['brandname']=$brandname;
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Brand Name: ".$brandname." is already in the brand table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Brand Name: ".$brandname." not fount in brand table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Get Brand Details Method End-------------------------*/

        /*--------------------------Get User Details Method Start--------------------------------*/
        function getuserdetails($username)
        {
            $username=mysql_real_escape_string($username);
            $resultArr=array();
            if($username!='')
            {
                $qry="select * from userauth where userName='$username'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows!=0)
                {
                    $row=mysql_fetch_assoc($result);
                    $resultArr['username']=$username;
                    $resultArr['userid']=$row['idUserAuth'];
                    //$resultArr['password']=$row['password'];
                    //$resultArr['email']=$row['$email'];
                    $resultArr['accesslevel']=$row['accessLevel'];
                    $resultArr['dateusercreated']=$row['dateUserCreated'];
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="User Name: ".$username." is already in the userauth table";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="User Name: ".$username." not found in userauth table";
                }
            }
            return $resultArr;
        }
        /*----------------------------Get User Details Method End-------------------------*/

        /*--------------------------Get Parts In Stock For Given Brand Method Start--------------------------------*/
        function getpartsinstockforthisbrand($brandid)
        {
            $brandid=mysql_real_escape_string($brandid);
            $resultArr=array();
            if($brandid!='')
            {
                $qry="select brandName from brand where idBrand='$brandid'";
                $result=mysql_query($qry) or die (mysql_error());
                $row=mysql_fetch_assoc($result);
                $brandname=$row['brandName'];
                if($brandname!='')
                {
                    $qry="select distinct(s.idPart),p.partName from stock s
                    inner join part p on p.idPart=s.idPart
                    where s.idBrand='$brandid' and (s.issueStatus is null or s.issueStatus='') and (s.dateIssued='' or s.dateIssued is null)";
                    $result=mysql_query($qry) or die (mysql_error());
                    $numofrows=mysql_num_rows($result);
                    if($numofrows!=0)
                    {
                        while($row=mysql_fetch_assoc($result))
                        {
                            $resultArr['partname'][]=$row['partName'];
                            $resultArr['partid'][]=$row['idPart'];
                        }
                        $resultArr['brandid']=$brandid;
                        $resultArr['brandname']=$brandname;
                        $resultArr['Status']="true";
                        $resultArr['DetailedStatus']="Returned the distinct parts available in stock table
                        against brandid=".$brandid." and brandname=".$brandname;
                        $resultArr['Query']=$qry;
                    }
                    else
                    {
                        $resultArr['brandid']=$brandid;
                        $resultArr['brandname']=$brandname;
                        $resultArr['Status']="false";
                        $resultArr['DetailedStatus']="No part is available against brandid=".$brandid." and brandname=".$brandname.
                        "you might be running out of stock";
                    }
                }
                else
                {
                    $resultArr['brandid']=$brandid;
                    $resultArr['brandname']=$brandname;
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="No brand available against brandid=".$brandid." in brand table";
                }
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Exception occured in getpartsinstockforthisbrand graph method Brand ID cannot be null or empty or undefined.";
            }
            return $resultArr;
        }
        /*----------------------------Get Parts In Stock For Given Brand Method End-------------------------*/

        /*--------------------------Check Number of Part available Method Start--------------------------------*/
        function checkmaxavailablestock($brandid,$partid)
        {
            $brandid=mysql_real_escape_string($brandid);
            $partid=mysql_real_escape_string($partid);
            $resultArr=array();
            if($partid!='' && $brandid!='')
            {
                $qry="select count(*) as count from stock where idBrand='$brandid' and idPart='$partid' and (issueStatus is null or issueStatus='')";
                $result=mysql_query($qry) or die (mysql_error());
                $row=mysql_fetch_assoc($result);
                $resultArr['numofpartsavailable']=$row['count'];
                $resultArr['Status']="true";
                $resultArr['DetailedStatus']="Number of parts available=".$row['count'];

            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Brand ID or Part ID cannot be empty or null";
            }
            return $resultArr;
        }
        /*----------------------------Check Number of Part available Method End-------------------------*/

        /*--------------------------Check Tracking ID Expiry Method Start--------------------------------*/
        function checktrackingidexpiry($trackingid)
        {
            $trackingid=mysql_real_escape_string($trackingid);
            $resultArr=array();
            if($trackingid!='')
            {
                $qry="select * from stock where trackingId='$trackingid'";
                $result=mysql_query($qry) or die(mysql_error());
                $countTrackingId=mysql_num_rows($result);
                if($countTrackingId==0)
                {
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Tracking ID ".$trackingid." is OK";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Tracking ID ".$trackingid." has already been used";
                }
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Tracking ID cannot be empty or null";
            }
            return $resultArr;
        }
        /*----------------------------Check Tracking ID Expiry Method End-------------------------*/

        /*--------------------------Check Tracking ID Method Start--------------------------------*/
        function checktrackingid($trackingid)
        {
            $trackingid=mysql_real_escape_string($trackingid);
            $resultArr=array();
            if($trackingid!='')
            {
                $qry="select p.partName ,b.brandName,i.name as issuedBy,s.issueRemarks,s.userDateIssue,
                s.issuedTo,s.trackingId,s.returnStatus from stock s
                inner join part p on p.idPart=s.idPart
                inner join brand b on b.idBrand=s.idBrand
                inner join issue i on i.idIssue=s.idIssue
                where s.trackingId= '$trackingid'";
                $result=mysql_query($qry) or die(mysql_error());
                $row=mysql_fetch_assoc($result);
                $countTrackingId=mysql_num_rows($result);
                if($countTrackingId!=0)
                {
                    $resultArr['partname']=$row['partName'];
                    $resultArr['brandname']=$row['brandName'];
                    $resultArr['issuername']=$row['issuedBy'];
                    $resultArr['dateissued']=$row['userDateIssue'];
                    $resultArr['remarks']=$row['issueRemarks'];
                    $resultArr['issuedto']=$row['issuedTo'];
                    $resultArr['trackingid']=$trackingid;
                    $resultArr['returnstatus']=$row['returnStatus'];
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Tracking ID ".$trackingid." is found against the the above record";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Tracking ID ".$trackingid." not found";
                }
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Tracking ID cannot be empty or null";
            }
            return $resultArr;
        }
        /*----------------------------Check Tracking ID Method End-------------------------*/

        /*--------------------------Update Tracking ID Method Start--------------------------------*/
        function updatetrackingid($trackingid,$remarks,$returnid,$returnedby,$userid,$userdatereturn)
        {
            $trackingid=mysql_real_escape_string($trackingid);
            $remarks=mysql_real_escape_string($remarks);
            $returnid=mysql_real_escape_string($returnid);
            $returnedby=mysql_real_escape_string($returnedby);
            $userid=mysql_real_escape_string($userid);
            $userdatereturn=mysql_real_escape_string($userdatereturn);

            $resultArr=array();
            if($trackingid!='' && $remarks!='' && $returnid!='' && $returnedby && $userid!='' && $userdatereturn!='')
            {
                $qry="update stock set returnRemarks='$remarks',idReturn='$returnid',returnedBy='$returnedby',dateReturned=now()
                ,returnStatus='1', userIdReturn='$userid',userDateReturn='$userdatereturn' where trackingId='$trackingid'";
                $result=mysql_query($qry) or die(mysql_error());
                $resultArr['returnid']=$returnid;
                $resultArr['remarks']=$remarks;
                $resultArr['returnedby']=$returnedby;
                $resultArr['returnstatus']="1";
                $resultArr['useridreturn']=$userid;
                $resultArr['userdatereturn']=$userdatereturn;

                $resultArr['Status']="true";
                $resultArr['DetailedStatus']="Tracking ID ".$trackingid." has been updated, you part has been returned";
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Tracking ID cannot be empty or null";
            }
            return $resultArr;
        }
        /*----------------------------Update Tracking ID Method End-------------------------*/

        /*--------------------------Add Vehical Method Start--------------------------------*/
        function addvehical($vehicalname,$vehicalnumber,$userid)
        {
            $vehicalname=mysql_real_escape_string($vehicalname);
            $vehicalnumber=mysql_real_escape_string($vehicalnumber);
            $userid=mysql_real_escape_string($userid);
            $resultArr=array();
            if($vehicalname!='' && $vehicalnumber!='' && $userid!='')
            {
                $qry="select * from vehical where vehicalNumber='$vehicalnumber'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);
                if($numofrows==0)
                {
                    $qryinsert="insert into vehical (vehicalName,vehicalNumber,dateVehicalCreated,userId)values('$vehicalname','$vehicalnumber',now(),                        '$userid')";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Vehical Name: ".$vehicalname." and Vehical Number: ".$vehicalnumber." successfully inserted into vehical table.";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="Vehical Number: ".$vehicalnumber." already exist in vehical table. You cannot add the same vehical again.";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Vehical Method End-------------------------*/


        /*--------------------------Add Vehical Method Start--------------------------------*/
        function addrackinstore($rackid,$rackdescription,$userid)
        {
            $rackid=mysql_real_escape_string($rackid);
            $rackdescription=mysql_real_escape_string($rackdescription);
            $userid=mysql_real_escape_string($userid);
            $resultArr=array();
            if($rackid!='' && $rackdescription!='' && $userid!='')
            {
                $qry="select * from store where rackId='$rackid'";
                $result=mysql_query($qry) or die (mysql_error());
                $numofrows=mysql_num_rows($result);

                $qry1="select * from store where rackDescription='$rackdescription'";
                $result1=mysql_query($qry1) or die (mysql_error());
                $numofrows1=mysql_num_rows($result1);

                if($numofrows==0 && $numofrows1==0)
                {
                    $qryinsert="insert into store (rackId,rackDescription,dateRackCreated,userId) values ('$rackid','$rackdescription',now(),'$userid')";
                    mysql_query($qryinsert) or die(mysql_error());
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="Rack Id: ".$rackid." and Rack Description: ".$rackdescription." successfully inserted into store table.";
                }
                else
                {
                    if($numofrows!=0)
                    {
                        $resultArr['Status']="false";
                        $resultArr['DetailedStatus']="Rack Id: ".$rackid." already exist in store table. You cannot add the same rack in store again.";
                    }
                    if($numofrows1!=0)
                    {
                        $resultArr['Status']="false";
                        $resultArr['DetailedStatus']="Rack Description: ".$rackdescription." already exist in store table.
                        You cannot add the same rack in store again.";
                    }
                    if($numofrows!=0 && $numofrows1!=0)
                    {
                        $resultArr['Status']="false";
                        $resultArr['DetailedStatus']="Rack Id: ".$rackid." and Rack Description: ".$rackdescription." already exist in store table.
                        You cannot add the same rack in store again.";
                    }
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Vehical Method End-------------------------*/

        /*--------------------------Add Vehical Method Start--------------------------------*/
        function login($username,$password)
        {
            session_start();
            $username=mysql_real_escape_string($username);
            $password=mysql_real_escape_string($password);
            $resultArr=array();
            if($username!='' && $password!='')
            {
                $qry = "select * from userauth where userName='$username' and password='$password'";
                $result = mysql_query($qry) or die(mysql_error());
                $numOfRows = mysql_num_rows($result);
                $row=mysql_fetch_assoc($result);
                if ($numOfRows != 0)
                {
                    $_SESSION['username'] = $row['userName'];
                    $_SESSION['userid'] = $row['idUserAuth'];
                    $_SESSION['accesslevel'] = $row['accessLevel'];
                    $_SESSION['login']=true;
                    $resultArr['username'] = $row['userName'];
                    $resultArr['userid'] = $row['idUserAuth'];
                    $resultArr['accesslevel'] = $row['accessLevel'];
                    $resultArr['Status']="true";
                    $resultArr['DetailedStatus']="User name and passowrd are OK.";
                }
                else
                {
                    $resultArr['Status']="false";
                    $resultArr['DetailedStatus']="User name or passowrd are invalid.";
                }
            }
            return $resultArr;
        }
        /*----------------------------Add Vehical Method End-------------------------*/

        /*--------------------------Change User Name Method Start--------------------------------*/
        function changeUserName($userid,$username)
        {
            session_start();
            $username=mysql_real_escape_string($username);
            $userid=mysql_real_escape_string($userid);
            $resultArr=array();
            if(!is_numeric($username) && $username!='' && $userid!='' && is_numeric($userid))
            {
                $qry = "update userauth set userName='$username' where idUserAuth='$userid'";
                $result = mysql_query($qry) or die(mysql_error());
                $resultArr['Status']="true";
                $resultArr['DetailedStatus']="User name has been updated.";
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="User name or User Id is undefined or any of the value is not valid(numeric or non numeric).";
            }
            return $resultArr;
        }
        /*----------------------------Change User Name Method End-------------------------*/

        /*--------------------------Change Security Plan Method Start--------------------------------*/
        function changeSecurityPlan($userid,$securityplannumber)
        {
            session_start();
            $securityplannumber=mysql_real_escape_string($securityplannumber);
            $userid=mysql_real_escape_string($userid);
            $resultArr=array();
            if($securityplannumber!='' && $userid!='')
            {
                $qry = "update userauth set accessLevel='$securityplannumber' where idUserAuth='$userid'";
                $result = mysql_query($qry) or die(mysql_error());
                $resultArr['Status']="true";
                $resultArr['DetailedStatus']="Security Plan has been updated.";
            }
            else
            {
                $resultArr['Status']="false";
                $resultArr['DetailedStatus']="Security Plan Number or User Id is undefined.";
            }
            return $resultArr;
        }
        /*----------------------------Change Security Plan Method End-------------------------*/


    }
?>
