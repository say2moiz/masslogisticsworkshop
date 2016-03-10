<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Make Purchase</title>
        <script src="Scripts/jquery-1.11.1.js"></script>
        <script src="Scripts/jquery-1.11.1.min.js"></script>
        <script src="Scripts/jquery.btechco.excelexport.js"></script>
        <script src="Scripts/jquery.base64.js"></script>
        <script src="parts/datasource.js"></script>
        <script src="base/base.js"></script>
        <script src="Scripts/keyrestrict.js"></script>
    </head>
    <?php
    include "header.php";
    include "navigationbar.php";
    $userid='';
    $username='';
    if (isset($_SESSION['userid']) && isset($_SESSION['username']))
    {
        $userid=$_SESSION['userid'];
        $username=$_SESSION['username'];
    }
    if (isset($_GET['purchaseid']))
    {
        $purchaseid = $_GET['purchaseid'];
        $qry = "select pa.idPart,pa.partName,b.idbrand,b.brandName,bu.idBuyer,bu.buyerName,s.idSeller,s.sellerName,p.quantity,p.purchasedFor,p.price,         p.unitOfPurchase,p.userPurchaseDate,p.remarks from purchase p
        inner join part pa on p.idPart=pa.idPart
        inner join brand b on p.idBrand=b.idBrand
        inner join buyer bu on p.idBuyer=bu.idBuyer
        inner join seller s on p.idSeller=s.idSeller
        where idPurchase='$purchaseid'";

        $result = mysql_query($qry) or die(mysql_error());
        $row = mysql_fetch_assoc($result);
        $edit_partname = $row['partName'];
        $edit_brandname = $row['brandName'];
        $edit_buyername = $row['buyerName'];
        $edit_sellername = $row['sellerName'];

        $edit_partid = $row['idPart'];
        $edit_brandid = $row['idbrand'];
        $edit_buyerid = $row['idBuyer'];
        $edit_sellerid = $row['idSeller'];

        $edit_quantity = $row['quantity'];
        $edit_purchasefor = $row['purchasedFor'];
        $edit_price = $row['price'];
        $edit_unitofpurchase = $row['unitOfPurchase'];
        $edit_remarks = $row['remarks'];
        $edit_userpurchasedate = $row['userPurchaseDate'];
    }
    ?>
    <body>
    <div id="containerOuter">
        <div id="containerInner">
            <form  method="post" id="form">
                <div class="form clearfix">
                    <div class="formHead">Make Purchase Form</div>
                    <div class="row">
                        <span class="stuNameHead">Select Buyer</span>
                        <?php
                        $buyername = '';
                        $buyerid = '';
                        $qry = "select idBuyer,buyerName from buyer";
                        $result = mysql_query($qry);
                        $buyerdd = '';
                        ?>
                        <select name='buyer' id="buyer">
                            <option value='-1'>Select buyer</option>
                            <?php
                            while ($row = mysql_fetch_array($result))
                            {
                                $buyername = $row['buyerName'];
                                $buyerid = $row['idBuyer'];
                                if (isset($_POST['buyer']))
                                {
                                    $buyerdd = $_POST['buyer'];
                                }
                                ?>
                                <option value='<?php echo $buyerid; ?>'
                                <?php
                                if (isset($_POST['buyer']))
                                {
                                    if ($buyerdd == $buyerid)
                                    {
                                        echo 'selected="selected"';
                                    }
                                }
                                else if (isset($_GET['purchaseid']))
                                {
                                    if ($edit_buyerid == $buyerid)
                                    {
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >
                                <?php echo $buyername; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Select Seller</span>
                        <?php
                        $sellername = '';
                        $sellerid = '';
                        $qry = "select idSeller,sellerName from seller";
                        $result = mysql_query($qry);
                        $sellerdd = '';
                        ?>
                        <select name="seller" id="seller">
                            <option value='-1'>Select seller</option>
                            <?php
                            while ($row = mysql_fetch_array($result))
                            {
                                $sellername = $row['sellerName'];
                                $sellerid = $row['idSeller'];
                                if (isset($_POST["seller"]))
                                {
                                    $sellerdd = $_POST['seller'];
                                }
                                ?>
                                <option value='<?php echo $sellerid ?>'
                                <?php
                                if (isset($_POST['buyer']))
                                {
                                    if ($sellerdd == $sellerid)
                                    {
                                        echo 'selected="selected"';
                                    }
                                }
                                else if (isset($_GET['purchaseid']))
                                {
                                    if ($edit_sellerid == $sellerid)
                                    {
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >
                                <?php echo $sellername; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Select Brand</span>
                        <?php
                        $brandname = '';
                        $brandid = '';
                        $qry = "select idBrand,brandName from brand";
                        $result = mysql_query($qry);
                        $branddd = '';
                        ?>
                        <select name="brand" id="brand" onchange='getpartsforthisbrand();'>
                            <option value='-1'>Select brand</option>
                            <?php
                            while ($row = mysql_fetch_array($result))
                            {
                                $brandname = $row['brandName'];
                                $brandid = $row['idBrand'];
                                if (isset($_POST["brand"]))
                                {
                                    $branddd = $_POST['brand'];
                                }
                                ?>
                                <option value='<?php echo $brandid ?>'
                                <?php
                                if ($branddd == $brandid)
                                {
                                    echo 'selected="selected"';
                                }
                                else if (isset($_GET['purchaseid']))
                                {
                                    if ($edit_brandid == $brandid) echo 'selected="selected"';
                                }
                                ?>
                                >
                                <?php echo $brandname; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Select Part</span>
                        <select name="part" id="part">
                            <option value="-1">Select Part</option>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Quantity</span>
                        <input type="text" class="stuNameVal" id="quantity" autocomplete="off" placeholder="Enter Quantity here..."
                        onKeyPress="return numberonly(this, event)" name="quantity"
                        value='<?php if (isset($_POST['quantity'])) {echo $_POST['quantity'];}
                        else if (isset($_GET['purchaseid'])){echo $edit_quantity;}?>' required>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Purchase For</span>
                        <input type="text" class="stuNameVal" id="purchasefor" placeholder="Enter Purchase For here..."
                        name="purchasefor" value='<?php if (isset($_POST['purchasefor'])){ echo $_POST['purchasefor'];}
                        else if (isset($_GET['purchaseid'])) {echo $edit_purchasefor;}?>' required>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Unit Price</span>
                        <input type="text" class="stuNameVal" id="price" autocomplete="off" placeholder="Enter Price here..."
                        name="price" onKeyPress="return numberonly(this, event)" value='<?php if (isset($_POST['price'])) {echo $_POST['price'];}
                        else if (isset($_GET['purchaseid'])) {echo $edit_price;}?>' required>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Unit Of Purchase</span>
                        <input type="text" class="stuNameVal" id="unitofpurchase" autocomplete="off" placeholder="Ex: Liters / Numbers / Dozen / Boxes"
                        name="unitofpurchase" onKeyPress="return alphabetsonly(this, event)"
                        value='<?php if (isset($_POST['unitofpurchase'])) { echo $_POST['unitofpurchase']; }
                        else if (isset($_GET['purchaseid'])) {echo $edit_unitofpurchase; } ?>' required>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Date</span>
                        <input type="date" class="stuNameVal" id="userdate" autocomplete="off" placeholder="Enter description id here..."
                        name="userdate" value='<?php if (isset($_POST['userdate'])) { echo $_POST['userdate']; }
                        else if (isset($_GET['purchaseid'])) {echo $edit_userpurchasedate;}?>' required>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Remarks</span>
                        <input type="text" class="stuNameVal" id="remarks" autocomplete="off" placeholder="Enter Remarks here..."
                        name="remarks" value='<?php if (isset($_POST['remarks'])) { echo $_POST['remarks']; }
                        else if (isset($_GET['purchaseid'])) {  echo $edit_remarks;}?>' required>
                    </div>
                    <div class="formFoot clearfix" id="submitRow">
                        <input type="submit" name="submit" value="Submit" id="submit">
                        <input type="reset" value="Reset" id="reset" title="Click to reset the form">
                        <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                    </div>
                    <div id="msg" style="display: none;" class="popup clearfix">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="responseMsg clearfix" id="responseMsg" style="display: none;">
        <!--<img src="images/success.png" width="20" id="addResponseImg">
            <span class="msg" id="msg"></span>-->
    </div>


    <?php
    $purchasedfor = '';
    $buyer = '';
    $seller = '';
    $part = '';
    $brand = '';
    $quantity = '';
    $price = '';
    $unitofpurchase = '';
    $userdate = '';
    $remarks = '';

    if (isset($_POST['buyer']) && isset($_POST['seller']) && isset($_POST['brand']) && isset($_POST['part']))
    {
        if ($_POST['buyer'] != -1 && $_POST['seller'] != -1 && $_POST['part'] != -1 && $_POST['brand'] != -1)
        {
            if (isset($_POST['buyer'])) { $buyer = mysql_real_escape_string($_POST['buyer']); }
            if (isset($_POST['seller'])) { $seller = mysql_real_escape_string($_POST['seller']); }
            if (isset($_POST['part'])) { $part = mysql_real_escape_string($_POST['part']); }
            if (isset($_POST['brand'])) { $brand = mysql_real_escape_string($_POST['brand']); }
            if (isset($_POST['quantity'])) { $quantity = mysql_real_escape_string($_POST['quantity']); }
            if (isset($_POST['purchasefor'])) { $purchasedfor = mysql_real_escape_string($_POST['purchasefor']); }
            if (isset($_POST['price'])) { $price = mysql_real_escape_string($_POST['price']); }
            if (isset($_POST['unitofpurchase'])) { $unitofpurchase = mysql_real_escape_string($_POST['unitofpurchase']); }
            if (isset($_POST['userdate'])) { $userdate = mysql_real_escape_string($_POST['userdate']); }
            if (isset($_POST['remarks'])) { $remarks = mysql_real_escape_string($_POST['remarks']); }

            if (!isset($_GET['purchaseid']))
            {
                if ($purchasedfor != '' && $remarks != '' && $price != '' && $part != '' && $brand != '' && $quantity != '' && $seller != ''
                && $buyer != '' && $userdate && $unitofpurchase != '')
                {
                    $qryinsert = "insert into purchase (purchasedFor,remarks,price,idBuyer,idBrand,quantity,
                    idSeller,idPart,systemPurchaseDate,userPurchaseDate,unitOfPurchase,userId)values
                    ('$purchasedfor','$remarks','$price','$buyer','$brand','$quantity','$seller','$part',now(),'$userdate','$unitofpurchase'
                    ,'$userid')";
                    mysql_query($qryinsert) or die(mysql_error());
                    $qryselect = "select idPurchase from purchase order by idPurchase desc limit 1"; //picking last purchase id from table(Most recent)
                    $result = mysql_query($qryselect) or die(mysql_error());
                    $row = mysql_fetch_array($result);
                    $idpur = $row['idPurchase']; //picking up last purchase id so that we can insert data against it in the stock table
                    //select * from stock where dateIssued like '%00-00-00%'(select the records where date is null or zero)
                    //select * from purchase order by idPurchase desc limit 2,3
                    //this query will get  2 rows from last and then will skip next 3rows and then will pick next 2 and so on
                    for ($i = 0; $i < $quantity; $i++)
                    {
                        $qryinsertstock = "insert into stock
                        (idBrand,idPurchase,idPart,price,dateEnterance,remarks,userDateEnterance)
                        values ('$brand','$idpur','$part','$price',now(),'$remarks','$userdate')";
                        mysql_query($qryinsertstock) or die(mysql_error());
                    }
                    $qry = "select b.brandName,partName, count(ss.idPart) as availableStock ,
                    sum(ss.price) as totalWorthOfStock, max(ss.price) as unitPrice,ss.dateEnterance  from stock ss
                    inner join part p on p.idPart=ss.idPart
                    inner join brand b on b.idBrand=ss.idBrand
                    where ss.idPart='$part' and ss.idBrand='$brand' and (ss.issueStatus is null or ss.issueStatus='') group by ss.idPart";
                    $result = mysql_query($qry) or die(mysql_error());
                    $row = mysql_fetch_assoc($result);
                    $availablestock = $row['availableStock'];
                    $availablestock = $availablestock;
                    $totalworthofavailablestock = $row['totalWorthOfStock'];

                    $qry = "insert into stocktransaction
                    (idPart,idBrand,idPurchase,availableStock,totalWorthOfAvailableStock,additionInStock,subtractionFromStock
                    ,dateTransaction,userDateTransaction,userId)
                    values('$part','$brand','$idpur','$availablestock','$totalworthofavailablestock','$quantity','',now(),'$userdate','$userid')";
                    mysql_query($qry) or die(mysql_error());
                    ?>
                    <script>
                    window.alert("Your new purchase has been added in to the system");
                    window.location = "addpurchase.php";
                    </script>
                    <?php
                }
            }
            else
            {
                $purchaseid = $_GET['purchaseid'];

                if ($purchasedfor != '' && $remarks != '' && $price != '' && $part != '' && $brand != '' && $quantity != ''
                    && $seller != '' && $buyer != '' && $userdate && $unitofpurchase != '')
                {
                    $qryEditPermit="select * from purchase where idbrand='$brand' and idPart='$part' order by idPurchase desc limit 1";
                    $resultEditPermit=mysql_query($qryEditPermit) or die(mysql_error());
                    $rowEditPermit=mysql_fetch_assoc($resultEditPermit);
                    $purchaseIdPermit=$rowEditPermit['idPurchase'];


                    $qryEditPermit2="select * from stock where idPurchase='$purchaseid' and (issueStatus!='' or returnStatus!=''
                    or dateIssued!='' or dateReturned!='')";
                    $resultEditPermit2=mysql_query($qryEditPermit2) or die(mysql_error());
                    $rowEditPermit2=mysql_fetch_assoc($resultEditPermit2);
                    $countEditPermit2=mysql_num_rows($resultEditPermit2);


                    if($purchaseid==$purchaseIdPermit && $countEditPermit2==0)
                    {
                        $qry="select * from purchase where idPurchase='$purchaseid'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $row=mysql_fetch_assoc($result);

                        $beforeEditPurchaseId=$row['idPurchase'];
                        $beforeEditBrandId=$row['idBrand'];
                        $beforeEditPartId=$row['idPart'];
                        $beforeEditBuyerId=$row['idBuyer'];
                        $beforeEditSellerId=$row['idSeller'];
                        $beforeEditSystemPurchaseDate=$row['systemPurchaseDate'];
                        $beforeEditPurchaseFor=$row['purchasedFor'];
                        $beforeEditRemarks=$row['remarks'];
                        $beforeEditPrice=$row['price'];
                        $beforeEditQuantity=$row['quantity'];
                        $beforeEditUserPurchaseDate=$row['userPurchaseDate'];
                        $beforeEditUnitOfPurchase=$row['unitOfPurchase'];
                        $beforeEditUserId=$row['userId'];

                        $qryinsert = "insert into edithistory (idPurchase,idBrand,idPart,idBuyer,idSeller,systemPurchaseDate,purchasedFor,remarks,
                        price,quantity,userPurchaseDate,unitOfPurchase,editPurchaseFlag,userId)values
                        ('$beforeEditPurchaseId','$beforeEditBrandId','$beforeEditPartId','$beforeEditBuyerId','$beforeEditSellerId',                                         '$beforeEditSystemPurchaseDate','$beforeEditPurchaseFor','$beforeEditRemarks','$beforeEditPrice','$beforeEditQuantity',                               '$beforeEditUserPurchaseDate','$beforeEditUnitOfPurchase','1','$beforeEditUserId')";
                        mysql_query($qryinsert) or die(mysql_error());


                        $qryinsert = "update purchase set purchasedFor='$purchasedfor',remarks='$remarks',price='$price',idBuyer='$buyer',
                        idBrand='$brand',quantity='$quantity',idSeller='$seller',idPart='$part',systemPurchaseDate=now(),userPurchaseDate='$userdate'
                        ,unitOfPurchase='$unitofpurchase',editPurchaseFlag='1',userId='$userid' where idPurchase='$purchaseid'";
                        mysql_query($qryinsert) or die(mysql_error());
                        $qryselect = "delete from stock where idPurchase='$purchaseid'";
                        $result = mysql_query($qryselect) or die(mysql_error());
                        //select * from stock where dateIssued like '%00-00-00%'(select the records where date is null or zero)
                        //select * from purchase order by idPurchase desc limit 2,3
                        //this query will get  2 rows from last and then will skip next 3rows and then will pick next 2 and so on
                        for ($i = 0; $i < $quantity; $i++)
                        {
                            $qryinsertstock = "insert into stock
                            (idBrand,idPurchase,idPart,price,dateEnterance,remarks,userDateEnterance)
                            values ('$brand','$purchaseid','$part','$price',now(),'$remarks','$userdate')";
                            mysql_query($qryinsertstock) or die(mysql_error());
                        }

                        $qry = "select b.brandName,partName, count(ss.idPart) as availableStock ,
                        sum(ss.price) as totalWorthOfStock, max(ss.price) as unitPrice,ss.dateEnterance  from stock ss
                        inner join part p on p.idPart=ss.idPart
                        inner join brand b on b.idBrand=ss.idBrand
                        where ss.idPart='$part' and ss.idBrand='$brand' and (ss.issueStatus is null or ss.issueStatus='') group by ss.idPart";
                        $result = mysql_query($qry) or die(mysql_error());
                        $row = mysql_fetch_assoc($result);
                        $availablestock = $row['availableStock'];
                        $totalworthofavailablestock = $row['totalWorthOfStock'];


                        $qry = "update stocktransaction set
                        idPart='$part',idBrand='$brand',availableStock='$availablestock'
                        ,totalWorthOfAvailableStock='$totalworthofavailablestock',userDateTransaction='$userdate'
                        ,additionInStock='$quantity',subtractionFromStock='',dateTransaction=now(),userId='$userid',editStockTransactionFlag='1'
                         where  idPurchase='$purchaseid'";
                        mysql_query($qry) or die(mysql_error());



                        $qry1="select * from edithistory order by idEditHistory desc limit 1";
                        $result1=mysql_query($qry1) or die(mysql_error());
                        $row1=mysql_fetch_assoc($result1);
                        $idEditHistory=$row1['idEditHistory'];

                        $qry="select * from purchase where idPurchase='$purchaseid'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $row=mysql_fetch_assoc($result);

                        $editPurchaseId=$row['idPurchase'];
                        $editBrandId=$row['idBrand'];
                        $editPartId=$row['idPart'];
                        $editBuyerId=$row['idBuyer'];
                        $editSellerId=$row['idSeller'];
                        $editSystemPurchaseDate=$row['systemPurchaseDate'];
                        $editPurchaseFor=$row['purchasedFor'];
                        $editRemarks=$row['remarks'];
                        $editPrice=$row['price'];
                        $editQuantity=$row['quantity'];
                        $editUserPurchaseDate=$row['userPurchaseDate'];
                        $editUnitOfPurchase=$row['unitOfPurchase'];

                        $qryinsert = "insert into edithistory (idPurchase,idBrand,idPart,idBuyer,idSeller,systemPurchaseDate,purchasedFor,remarks,
                        price,quantity,userPurchaseDate,unitOfPurchase,editPurchaseFlag,userId,editId)values
                        ('$editPurchaseId','$editBrandId','$editPartId','$editBuyerId','$editSellerId','$editSystemPurchaseDate'
                        ,'$editPurchaseFor','$editRemarks','$editPrice','$editQuantity','$editUserPurchaseDate','$editUnitOfPurchase'
                        ,'','$userid','$idEditHistory')";
                        mysql_query($qryinsert) or die(mysql_error());
                        header('location:addpurchase.php?success=1');
                        //echo "Purchaseid=".$purchaseid."----purchaseIdPermit=".$purchaseIdPermit."---count=".$countEditPermit2;
                    }
                    else
                    {
                        //echo "Purchaseid=".$purchaseid."----purchaseIdPermit=".$purchaseIdPermit."---count=".$countEditPermit2;
                        header("location:addpurchase.php?success=0&purchaseid=".$purchaseid);
                    }
                }
            }
        }
        else
        {
            ?>
            <script>
                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">Alert!!! Please fill the form properly. Required field empty or unselected.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                setTimeout(function(){
                    $('#responseMsg').hide();
                },10000);
            </script>
            <?php
        }
    }
    if(isset($_GET['success']))
    {
        if($_GET['success']==0)
        {
            ?>
            <script>
                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">Alert!!!: You cannot edit this purchase because, either you have already issued an item from ' +
                    'it or made a new purchase over it.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                setTimeout(function(){
                    $('#responseMsg').hide();
                },10000);

            </script>
            <?php
        }
        else if($_GET['success']==1)
        {
            ?>
            <script>
                $('#responseMsg').css('color','green');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20">' +
                    '<span id="msg">Thanks, your purchase has been updated successfully.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                setTimeout(function(){
                    $('#responseMsg').hide();
                },10000);
            </script>
            <?php
        }
    }
    ?>

    <script>
        var brandid;
        getpartsforthisbrand();
        function getpartsforthisbrand()
        {
            brandid=$('#brand').val();
            var httpfeed = getHttpFeedURL('getpartsforthisbrand');
            httpfeed = setHttpParameter(httpfeed, 'brandid', encodeURIComponent(brandid));
            initializeHttpRequest(httpfeed, onSuccess, onFailure);
        }
        function onSuccess(value)
        {
            $('#part').html('<option value="-1">Select Part</option>');
            var json = JSON.parse(value);
            for (var i = 0; i < json['partid'].length; i++)
            {
                $('#part').append('<option value="'+json['partid'][i]+'">'+json['partname'][i]+'</option>');
            }
        }
        function onFailure()
        {
        }
        $('#reset').click(function(){
            window.location="addpurchase.php";
        });
        $('#refresh').click(function(){
            window.location="addpurchase.php";
        });
    </script>
    <?php include "footer.php";?>
    </body>
</html>



