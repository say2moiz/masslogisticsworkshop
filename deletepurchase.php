<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Delete Purchase";
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $reportname;?></title>
    <link rel="icon" href="images/title.png" type="image/png">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <script src="Scripts/jquery-1.11.1.min.js"></script>
    <script src="Scripts/jquery-1.11.1.js"></script>
    <script src="Scripts/jquery.btechco.excelexport.js"></script>
    <script src="Scripts/jquery.base64.js"></script>
    <script src="Scripts/exportToExcel.js"></script>
    <script>
        reportname='<?php echo $reportname?>';
    </script>
</head>
<body>
<div id="reportContainer" class="clearfix">
    <form method="get">
        <div class="reportControls clearfix">
            <div class="leftPortion">
                <div class="reportName"><?php echo $reportname;?></div>
                <div class="Img" title="Click to go to home" onclick="window.location='index.php';">
                    <img src="images/home.png" width="24">
                </div>
                <div class="Img" title="Click to go to reports page" onclick="window.location='reports.php';">
                    <img src="images/reporttile.png" width="24">
                </div>
                <div class="Img" title="Click to download this report as excel">
                    <img src="images/excel.png" id="btnExport" class="exporttoexcel">
                </div>
            </div>
            <div class="rightPortion">

            </div>
        </div>
    </form>
<body>
<h4 class="confirmdeletemsg">Are you sure you want to delete the Following Purchase?</h4>
<h4 class="stockupdatemsg"><span>Note:</span>Your stock will be updated automatically</h4>

<?php
if (isset($_GET['purchaseid'])) { $purchaseid = $_GET['purchaseid']; }
else { header('location:purchasereport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'); }
if ($purchaseid != '')
{
    $qry = "select pp.partName,bb.brandName,b.buyerName,s.sellerName,pp.idPart,bb.idBrand,
    p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
    inner join buyer b on b.idBuyer=p.idBuyer
    inner join seller s on s.idSeller=p.idSeller
    inner join part pp on pp.idPart=p.idPart
    inner join brand bb on bb.idBrand=p.idBrand where idPurchase='$purchaseid'";
}
?>
<table id="mytable" class="reportTable">
    <tr class="tableHeadRow">
        <th>Part Name</th>
        <th>Brand Name</th>
        <th>Buyer Name</th>
        <th>Seller Name</th>
        <th>Purchase Date</th>
        <th>Purchased For</th>
        <th>Remarks</th>
        <th>Price</th>
        <th>Total Price</th>
        <th>Quantity</th>
        <th>Unit Of Purchase</th>
    </tr>
    <?php
    $result = mysql_query($qry) or die(mysql_error());
    while ($row = mysql_fetch_array($result))
    {
        $partid=$row['idPart'];
        $brandid=$row['idBrand'];
        ?>
        <tr class="tableDataRow">
            <td><?php echo $row['partName']; ?> </td>
            <td><?php echo $row['brandName']; ?> </td>
            <td><?php echo $row['buyerName']; ?> </td>
            <td><?php echo $row['sellerName']; ?> </td>
            <td><?php echo $row['userPurchaseDate']; ?> </td>
            <td><?php echo $row['purchasedFor']; ?> </td>
            <td><?php echo $row['remarks']; ?> </td>
            <td><?php echo $row['price']; ?> </td>
            <td><?php echo $row['price'] * $row['quantity']; ?> </td>
            <td><?php echo $row['quantity']; ?> </td>
            <td><?php echo $row['unitOfPurchase']; ?> </td>
        </tr>
    <?php
    }
    ?>
</table>
<div id="containerOuter">
    <div id="containerInner">
        <form method="post">
            <div class="form clearfix">
                <div class="formHead">Delete Purchase</div>
                    <div class="formFoot clearfix">
                    <span>Are you sure? you want to delete the above purchase? if yes click delete. Or click  cancel to go back to purchase report</span>
                    <input type="submit" name="submit" value="Delete" id="submit">
                    <input type="button" name="cancel" value="Cancel" id="cancel"
                    onclick="window.location='purchasereport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="responseMsg clearfix" id="responseMsg" style="display: none;">

</div>
<?php
if (isset($_POST['submit']))
{
    $qryEditPermit="select * from purchase where idbrand='$brandid' and idPart='$partid' order by idPurchase desc limit 1";
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
        $qry = "delete from purchase where idPurchase='$purchaseid'";
        $result = mysql_query($qry) or die(mysql_error());

        $qry = "delete from stock where idPurchase='$purchaseid'";
        $result = mysql_query($qry) or die(mysql_error());

        header('location:purchasereport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1');
    }
    else
    {
        ?>
        <script>
            $('#responseMsg').css('color','red');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                '<span id="msg">Alert!!! You cannot delete this purchase because either you issued an item from it or have made ' +
                'another purchase over it.</span>');
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

</body>

</html>