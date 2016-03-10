<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once('helper.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Issuing From Stock</title>
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
?>
<body>
<div id="containerOuter">
    <div id="containerInner">
        <form method="post">
            <div class="form clearfix">
                <div class="formHead">Issue Stock Form</div>

                <div class="row">
                    <span class="stuNameHead">Issuer Name</span>
                    <?php
                    $issuername='';
                    $issuerid='';
                    $qry="select * from issue";
                    $result=mysql_query($qry) or die(mysql_error());
                    $issuerdd='';
                    ?>
                    <select name="issuer" id="issuer">
                        <option value='-1'>Select Name</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $issuername=$row['name'];
                            $issuerid=$row['idIssue'];
                            if(isset($_POST["issuer"]))
                            {
                                $issuerdd=$_POST['issuer'];
                            }
                            ?>
                            <option  value='<?php echo $issuerid ?>' <?php if ( $issuerdd ==$issuerid) echo 'selected="selected"';?> >
                                <?php echo $issuername; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span class="stuNameHead">Brand Name</span>
                    <?php
                    $brandname='';
                    $brandid='';
                    $qry="select idBrand,brandName from brand";
                    $result=mysql_query($qry);
                    $branddd='';
                    ?>
                    <select name="brand" id="brand" onchange='getPartsInStockForThisBrand();'>
                        <option value='-1'>Select brand</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $brandname=$row['brandName'];
                            $brandid=$row['idBrand'];
                            if(isset($_POST["brand"]))
                            {
                                $branddd=$_POST['brand'];
                            }
                            ?>
                            <option  value='<?php echo $brandid ?>' <?php /*if ( $branddd ==$brandid) echo 'selected="selected"';*/?> >
                                <?php echo $brandname; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span class="stuNameHead">Part Name</span>
                    <select name="part" id="part">

                    </select>
                </div>
                <div class="row">
                    <span class="stuNameHead">Issuing For</span>
                    <?php
                    $vehicalname='';
                    $vehicalid='';
                    $qry="select * from vehical";
                    $result=mysql_query($qry);
                    $vehicaldd='';
                    ?>
                    <select name="issuingfor" id="issuingfor">
                        <option value='-1'>Select Vehical</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $vehicalname=$row['vehicalName'];
                            $vehicalid=$row['idVehical'];
                            $vehicalnumber=$row['vehicalNumber'];
                            if(isset($_POST["issuingfor"]))
                            {
                                $vehicaldd=$_POST['issuingfor'];
                            }
                            ?>
                            <option  value='<?php echo $vehicalid ?>' <?php if ( $vehicaldd ==$vehicalid) echo 'selected="selected"';?> >
                                <?php echo $vehicalnumber. " (".$vehicalname.")"; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span class="stuNameHead">Issuing To</span>
                    <input type="text" class="stuNameVal" id="issuingto"  placeholder="Name of person here..."
                           name="issuingto" value='<?php if(isset($_POST['issuingto'])){echo $_POST['issuingto'];}?>' required>
                </div>
                <div class="row">
                    <span class="stuNameHead">Date</span>
                    <input type="date" class="stuNameVal" id="userdate" autocomplete="off"
                           name="userdate" value='<?php if (isset($_POST['userdate'])) { echo $_POST['userdate']; }?>' required>
                </div>
                <div class="row">
                    <span class="stuNameHead">Remarks</span>
                    <input type="text" class="stuNameVal" id="remarks" placeholder="Enter remarks here..."
                           name="remarks" value='<?php if(isset($_POST['remarks'])){echo $_POST['remarks'];}?>' required>
                </div>
                <div class="row trackableRow" id="trackableRow" title="Select yes if you want to track this part in future and no if you donot.">
                    <span class="stuNameHead">Trackable</span>
                    <span>
                        Yes
                        <input type="radio" id="trackable" name="trackable" value='1' required
                        <?php /*if(isset($_POST['trackable'])){if($_POST['trackable']==1){echo "checked='checked'";}}*/ ?>/>
                    </span>
                    <span>
                        No
                        <input type="radio" id="trackable1" name="trackable" value='0' required
                        <?php /*if(isset($_POST['trackable'])){if($_POST['trackable']==0){echo "checked='checked'";}}*/ ?>/>
                    </span>
                </div>
                <div class="row" style="display: none;" id="trackingIdRow">
                    <span class="stuNameHead">Tracking ID</span>
                    <input type="text" class="stuNameVal" id="trackingid" autocomplete="off" placeholder="Enter tracking id here..."
                    name="trackingid" value='<?php if(isset($_POST['trackingid'])){echo $_POST['trackingid'];}?>'>
                </div>
                <div class="row" style="display: none;" id="quantityRow">
                    <span class="stuNameHead">Quantity</span>
                    <input type="text" class="stuNameVal" id="quantity" autocomplete="off" placeholder="Enter quantity here..."
                           onKeyPress="return numbersonly(this, event)"
                           name="quantity" value='<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>'>
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
$userid='';
$username='';
if (isset($_SESSION['userid']) && isset($_SESSION['username']))
{
    $userid=$_SESSION['userid'];
    $username=$_SESSION['username'];
}
if(isset($_POST['brand']) && isset($_POST['part']) && isset($_POST['trackable']) && isset($_POST['issuer']) && isset($_POST['userdate'])
&& isset($_POST['issuingfor']) && isset($_POST['quantity']) && isset($_POST['trackingid']) && isset($_POST['remarks']) && isset($_POST['issuingto']))
{
    $brand=$_POST['brand'];
    $part=$_POST['part'];
    $trackable=$_POST['trackable'];
    $issuer=$_POST['issuer'];
    $issuingfor=$_POST['issuingfor'];
    $issuingto=$_POST['issuingto'];
    $quantity=$_POST['quantity'];
    $trackingid=$_POST['trackingid'];
    $issueremarks=$_POST['remarks'];
    $userdate=$_POST['userdate'];
    //print_r($_POST);
    if($trackable!=0 && $part!='' && $brand!='')
    {
        $qry="update junctionbp set trackable='$trackable' where idbrand='$brand' and idPart='$part'";
        mysql_query($qry)or die(mysql_error());
    }
    //$val=trackable($brand_id,$part_id);

    if( $quantity!='' && $quantity!=0 && $part!='' && $issuingto!='' && $issueremarks!=''&& $issuer!='' && $brand!=''
        && $issuer!=-1 && $brand!=-1 && $part!=-1 && $issuingfor!='' && $issuingfor!=-1 && $trackable==0 && $userdate!='')
    {
        for($i=0;$i<$quantity;$i++)
        {
            $qry="select * from stock where idPart='$part' and idBrand='$brand' and (issueStatus is null or issueStatus='') order by idStock asc limit 1";
            $result=mysql_query($qry) or die (mysql_error());
            $row=mysql_fetch_array($result);
            $idstock=$row['idStock'];
            $idpur=$row['idPurchase'];
            $qry="update stock set issueStatus='1',dateIssued=now(),issueRemarks='$issueremarks',idIssue='$issuer',issuedTo='$issuingto'
            ,idVehical='$issuingfor',userIdIssue='$userid',userDateIssue='$userdate' where idStock='$idstock'";
            $result=mysql_query($qry) or die (mysql_error());
        }

        $qry="select b.brandName,p.partName, count(ss.idPart) as availableStock ,
        sum(ss.price) as totalWorthOfStock, max(ss.price) as unitPrice,ss.dateEnterance  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join brand b on b.idBrand=ss.idBrand
        where ss.idPart='$part' and ss.idBrand='$brand' and (ss.issueStatus is null or ss.issueStatus='') group by ss.idPart";
        $result=mysql_query($qry) or die(mysql_error());
        $row=mysql_fetch_assoc($result);
        $availablestock=$row['availableStock'];
        $totalworthofavailablestock=$row['totalWorthOfStock'];
        $qry="insert into stocktransaction
        (idPart,idBrand,idPurchase,availableStock,totalWorthOfAvailableStock,additionInStock,subtractionFromStock,dateTransaction,
        userDateTransaction,userId)
        values('$part','$brand','$idpur','$availablestock','$totalworthofavailablestock','','$quantity',now(),'$userdate','$userid')";
        mysql_query($qry) or die(mysql_error());
        ?>
        <script>
            window.alert("You have issued the item successfully");
            window.location="issuepage.php";
        </script>
        <?php
    }
    else if(($quantity=='' || $quantity==0) && $part!='' && $issuingto!='' && $issueremarks!=''&& $issuer!='' && $brand!=''
        && $issuingfor!='' && $issuingfor!=-1 && $trackable==1 && $userdate!='' && $trackingid!='' && $issuer!=-1 && $brand!=-1 && $part!=-1)
    {
        $qry="select * from stock where trackingId='$trackingid'";
        $result=mysql_query($qry) or die(mysql_error());
        $countTrackingId=mysql_num_rows($result);
        if($countTrackingId==0)
        {
        $qry="select * from stock where idPart='$part' and idBrand='$brand' and (issueStatus is null or issueStatus='') order by idStock asc limit 1";
        $result=mysql_query($qry) or die (mysql_error());
        $row=mysql_fetch_array($result);
        $idstock=$row['idStock'];
        $idpur=$row['idPurchase'];
        $qry="update stock set issueStatus='1',dateIssued=now(),issueRemarks='$issueremarks',idIssue='$issuer',issuedTo='$issuingto'
            ,trackingId='$trackingid',idVehical='$issuingfor',userIdIssue='$userid',userDateIssue='$userdate' where idStock='$idstock'";
        $result=mysql_query($qry) or die (mysql_error());

        $qry="select b.brandName,p.partName, count(ss.idPart) as availableStock ,
        sum(ss.price) as totalWorthOfStock, max(ss.price) as unitPrice,ss.dateEnterance  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join brand b on b.idBrand=ss.idBrand
        where ss.idPart='$part' and ss.idBrand='$brand' and (ss.issueStatus is null or ss.issueStatus='') group by ss.idPart";
        $result=mysql_query($qry) or die(mysql_error());
        $row=mysql_fetch_assoc($result);
        $availablestock=$row['availableStock'];
        $totalworthofavailablestock=$row['totalWorthOfStock'];
        $qry="insert into stocktransaction
        (idPart,idBrand,idPurchase,availableStock,totalWorthOfAvailableStock,additionInStock,subtractionFromStock,dateTransaction,
        userDateTransaction,userId)
        values('$part','$brand','$idpur','$availablestock','$totalworthofavailablestock','','1',now(),'$userdate','$userid')";
        mysql_query($qry) or die(mysql_error());

        ?>
        <script>
            window.alert("You have issued the item successfully");
            window.location="issuepage.php";
        </script>
        <?php
        }
        else
        {
            ?>
            <script>
                window.alert("This tracking id has already been used, please enter any other tracking and then submit the form");
                //window.location="issuepage.php";
            </script>
            <?php
        }
    }
    else
    {
        ?>
        <script>
            $('#responseMsg').css('color','red');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                '<span id="msg">Alert!!! Required fields cannot be empty.</span>');
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
    $('#part').html('<option value="-1">Select Part</option>');
    if($('#part').val()==-1)
    {
        $('#part').css('border','1px solid red');
        $('#part').attr('title','Cannot be unselected');
    }
    if($('#brand').val()==-1)
    {
        $('#brand').css('border','1px solid red');
        $('#brand').attr('title','Cannot be unselected');
    }
    if($('#issuer').val()==-1)
    {
        $('#issuer').css('border','1px solid red');
        $('#issuer').attr('title','Cannot be unselected');
    }
    $('#part').change(function(){
        $('#part').css('border','');
    });
    $('#issuer').change(function(){
        $('#issuer').css('border','');
    });

    var brandid;
    var partid;
    var trackingid;
    function getPartsInStockForThisBrand()
    {
        $('#brand').css('border','');
        brandid=$('#brand').val();
        var httpfeed = getHttpFeedURL('getpartsinstockforthisbrand');
        httpfeed = setHttpParameter(httpfeed, 'brandid',encodeURIComponent(brandid));
        initializeHttpRequest(httpfeed, onSuccess, onFailure);
    }
    function onSuccess(value)
    {
        var partid='';
        var partname='';
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#part').html('<option value="-1">Select Part</option>');
            for(var i=0;i<json['partid'].length;i++)
            {
                partid=json['partid'][i];
                partname=json['partname'][i];
                $('#part').append('<option value="'+partid+'">'+partname+'</option>');
            }
        }
        else
        {
            $('#part').html('<option value="-1">Select Part</option>');
            $('#part').append('<option value="-2">No part available</option>');
        }
    }
    function onFailure()
    {

    }

    $("input[name=trackable]").change(function(){
        $('#quantity').val('');
        $('#trackingid').val('');
        if($("input[name=trackable]:checked").val()==1)
        {
            $('#trackingIdRow').show();
            $('#quantityRow').hide();
        }
        else if($("input[name=trackable]:checked").val()==0)
        {
            $('#trackingIdRow').hide();
            $('#quantityRow').show();
        }
        else
        {
            $('#trackingIdRow').hide();
            $('#quantityRow').hide();
        }
    });


    function checkmaxavailablestock()
    {
        $('#brand').css('border','');
        $('#part').css('border','');
        var httpfeed = getHttpFeedURL('checkmaxavailablestock');
        httpfeed = setHttpParameter(httpfeed, 'brandid',encodeURIComponent(brandid));
        httpfeed = setHttpParameter(httpfeed, 'partid',encodeURIComponent(partid));
        initializeHttpRequest(httpfeed, onSuccessChkStock, onFailureChkStock);
    }
    function onSuccessChkStock(value)
    {
        var numOfPartsInStock;
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            numOfPartsInStock=json['numofpartsavailable'];
            if($('#quantity').val()>numOfPartsInStock)
            {
                $('#submit').attr('disabled','disabled');
                $('#reset').attr('disabled','disabled');
                $('#quantity').css('border','1px solid red');
                $('#quantity').attr('title','You can issue all of this  '+numOfPartsInStock+' items but not more  than that.');


                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">You only have '+numOfPartsInStock+' items in stock. You cannot issue more than you have in stock. Please purchase more and come back and issue again.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
            }
            else
            {
                $('#submit').removeAttr('disabled');
                $('#reset').removeAttr('disabled');
                $('#quantity').css('border','');
                $('#quantity').removeAttr('title');
                $('#responseMsg').hide();
            }
        }
        else
        {
            alert('Service returning false please contact the developer');
        }
    }
    function onFailureChkStock()
    {

    }
    $('#quantity').keyup(function(){
        brandid=$('#brand').val();
        partid=$('#part').val();
        if($('#part').val()!=-1  && $('#brand').val()!=-1)
        {
            if(brandid!='' && partid!=''){checkmaxavailablestock();}
            else{alert("brandid or partid cannot be empty");}
        }
    });


    function checktrackingidexpiry()
    {
        $('#trackingid').css('border','');
        var httpfeed = getHttpFeedURL('checktrackingidexpiry');
        httpfeed = setHttpParameter(httpfeed, 'trackingid',encodeURIComponent(trackingid));
        initializeHttpRequest(httpfeed, onSuccessChkTrackingIdExpiry, onFailureChkTrackingIdExpiry);
    }
    function onSuccessChkTrackingIdExpiry(value)
    {
        var json = JSON.parse(value);
        if(json['Status']=="false")
        {
                $('#submit').attr('disabled','disabled');
                $('#reset').attr('disabled','disabled');
                $('#trackingid').css('border','1px solid red');
                $('#trackingid').attr('title','Please use any new tracking id.');

            $('#responseMsg').css('color','red');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                '<span id="msg">Tracking ID: '+trackingid+' has already been used. You cannot use 1 tracking id multiple times. Please use another one.</span>');
            $('#responseMsg').show();
            setTimeout(function(){
                $('#addResponseImg').css('visibility','visible');
            },300);
        }
        else
        {
            $('#submit').removeAttr('disabled');
            $('#reset').removeAttr('disabled','disabled');
            $('#trackingid').css('border','');
            $('#trackingid').removeAttr('title');
            $('#responseMsg').hide();
        }
    }
    function onFailureChkTrackingIdExpiry()
    {

    }
    $('#trackingid').keyup(function(){
        trackingid=$('#trackingid').val();
        if($('#part').val()!=-1  && $('#brand').val()!=-1)
        {
            if(trackingid!=''){checktrackingidexpiry();}
            else{alert("tracking id cannot be empty");}
        }
    });


    $('#reset').click(function(){
        location.reload();
    });
    $('#refresh').click(function(){
        window.location="issuepage.php";
    });
</script>
<?php include "footer.php";?>
</body>
</html>
