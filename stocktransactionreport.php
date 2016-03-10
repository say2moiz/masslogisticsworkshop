<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Bin Card Report";
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
            <?php
            $partname = '';
            $partid = '';
            $qry = "select idPart,partName from part";
            $result = mysql_query($qry) or die(mysql_error());
            $partdd = '';
            ?>
            <select name="part" id="partdd" onchange="this.form.submit();">
                <option value='-1'>Select Part</option>
                <?php
                while ($row = mysql_fetch_array($result)) {
                    $partname = $row['partName'];
                    $partid = $row['idPart'];
                    if (isset($_GET['part'])) {
                        $partdd = $_GET['part'];
                    }
                    ?>
                    <option value='<?php echo $partid; ?>'<?php if (isset($_GET['part'])) {
                        if ($partid == $_GET['part']) echo 'selected="selected"';
                    } ?>>
                        <?php echo $partname; ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <?php
            $brandname = '';
            $brandid = '';
            $qry = "select idBrand,brandName from brand";
            $result = mysql_query($qry) or die(mysql_error());
            $branddd = '';
            ?>
            <select name="brand" id="branddd" onchange="this.form.submit();">
                <option value='-1'>Select Brand</option>
                <?php
                while ($row = mysql_fetch_array($result)) {
                    $brandname = $row['brandName'];
                    $brandid = $row['idBrand'];
                    if (isset($_GET['brand'])) {
                        $branddd = $_GET['brand'];
                    }
                    ?>
                    <option value='<?php echo $brandid; ?>'<?php if (isset($_GET['brand'])) {
                        if ($brandid == $_GET['brand']) echo 'selected="selected"';
                    } ?>>
                        <?php echo $brandname; ?>
                    </option>
                <?php
                }
                ?>
            </select>
                <span>
                    <input type="date" name="date1" id="date1" onchange="this.form.submit();"
                           value="<?php if (isset($_GET['date1'])) {echo $_GET['date1'];} ?>">
                    To
                    <input type="date" name="date2" id="date2" onchange="this.form.submit();"
                           value="<?php if (isset($_GET['date2'])) {echo $_GET['date2'];}?>">
                </span>
        </div>
    </div>
</form>
<?php
$date1 = '';
$date2 = '';
if (isset($_GET['date1']) || isset($_GET['date2']))
{
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];
    if ($date1 != '' && $date2 != '') { my2($date1, $date2); }
    elseif ($date1 != '') { my($date1); }
    elseif ($date2 != '') { my($date2); }
    else { my($date2); }
}

function my($d1)
{
    $lowerlimit=5;
    $reportname="Bin Card Report";
    if(isset($_GET['part'])){ $partid=$_GET['part']; }
    if(!isset($_GET['part']) ) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1; ?>';
    </script>
    <?php
if($partid!=-1 && $d1=='' && $brandid==-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where p.idPart='$partid'";
}
else if($partid==-1 && $d1!='' && $brandid==-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where st.userDateTransaction like '%$d1%'";
}
else if($partid==-1 && $d1=='' && $brandid!=-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where b.idBrand='$brandid'";
}
else if($partid!=-1 && $d1!='' && $brandid==-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where p.idPart='$partid' and st.userDateTransaction like '%$d1%'";
}
else if($partid!=-1 && $d1=='' && $brandid!=-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where p.idPart='$partid' and b.idBrand='$brandid'";
}
else if($partid==-1 && $d1!='' && $brandid!=-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where b.idBrand='$brandid' and st.userDateTransaction like '%$d1%'";
}
else if($partid!=-1 && $d1!='' && $brandid!=-1)
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer
    where p.idPart='$partid' and b.idBrand='$brandid' and  st.userDateTransaction like '%$d1%'";
}
else
{
    $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
    buy.buyerName,buy.idBuyer,st.availableStock,
    st.totalWorthOfAvailableStock,
    st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
    inner join part p on p.idPart=st.idPart
    inner join brand b on b.idBrand=st.idBrand
    inner join purchase pur on pur.idPurchase=st.idPurchase
    inner join seller s on s.idSeller=pur.idSeller
    inner join buyer buy on buy.idBuyer=pur.idBuyer";
    ?>
    <script>
        reportname='<?php echo $reportname." - ".date('d-m-Y'); ?>';
    </script>
    <?php
}
$result=mysql_query($qry) or die(mysql_error());
$numofrows=mysql_num_rows($result);
if($numofrows!=0)
{
?>
    <table id="mytable" class="reportTable">
        <tr class="tableHeadRow">
            <th title="Part Name">Part</th>
            <th title="Brand Name">Brand</th>
            <th title="Buyer Name">Buyer</th>
            <th title="Seller Name">Seller</th>
            <th>Available Stock</th>
            <th title="Total Price Of Stock">TPOS</th>
            <th title="Addition in stock(Purchase)">Recieve</th>
            <th title="Subtraction from stock(Issue)">Issue</th>
            <th title="Date of Transaction">Date</th>
        </tr>
        <?php
        while($row=mysql_fetch_array($result))
        {
            $date=date('d-m-Y',strtotime($row['userDateTransaction']));
            ?>

            <tr class="tableDataRow" <?php if($row['availableStock'] <= $lowerlimit){echo "style='background:#ffd6c6'"."
            title=' Red row shows, you are running out of stock'";}?>>
                <td><?php echo $row['partName'];?> </td>
                <td><?php echo $row['brandName'];?> </td>
                <td><?php echo $row['buyerName'];?> </td>
                <td><?php echo $row['sellerName'];?> </td>
                <td><?php echo $row['availableStock'];?> </td>
                <td><?php echo $row['totalWorthOfAvailableStock'];?> </td>
                <td><?php echo $row['additionInStock'];?> </td>
                <td><?php echo $row['subtractionFromStock'];?> </td>
                <td><?php echo $date;?> </td>
            </tr>
        <?php
        }
    ?>
    </table>
    <?php
}
}

function my2($d1,$d2)
{
    $lowerlimit=5;
    $reportname="Bin Card Report";
    if(isset($_GET['part'])){ $partid=$_GET['part']; }
    if(!isset($_GET['part']) ) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    $dateLocal2=date('d-m-Y',strtotime($d2));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1." To ".$dateLocal2; ?>';
    </script>
    <?php
    if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where p.idPart='$partid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where st.userDateTransaction between '$d1' and '$d2'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where b.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where p.idPart='$partid' and  st.userDateTransaction between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where p.idPart='$partid' and b.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where b.idBrand='$brandid' and  st.userDateTransaction between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1)
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer
        where p.idPart='$partid' and b.idBrand='$brandid' and  st.userDateTransaction between '$d1' and '$d2'";
    }
    else
    {
        $qry="select pur.idPurchase,p.partName,p.idPart,b.brandName,b.idBrand,s.sellerName,s.idSeller,
        buy.buyerName,buy.idBuyer,st.availableStock,
        st.totalWorthOfAvailableStock,
        st.additionInStock,st.subtractionFromStock,userDateTransaction from stocktransaction st
        inner join part p on p.idPart=st.idPart
        inner join brand b on b.idBrand=st.idBrand
        inner join purchase pur on pur.idPurchase=st.idPurchase
        inner join seller s on s.idSeller=pur.idSeller
        inner join buyer buy on buy.idBuyer=pur.idBuyer";
    }
    $result=mysql_query($qry) or die(mysql_error());
    $numofrows=mysql_num_rows($result);
    if($numofrows!=0)
    {
    ?>
        <table id="mytable" class="reportTable">
            <tr class="tableHeadRow">
                <th title="Part Name">Part</th>
                <th title="Brand Name">Brand</th>
                <th title="Buyer Name">Buyer</th>
                <th title="Seller Name">Seller</th>
                <th>Available Stock</th>
                <th title="Total Price Of Stock">TPOS</th>
                <th title="Addition in stock(Purchase)">Up</th>
                <th title="Subtraction from stock(Issue)">Down</th>
                <th title="Date of Transaction">Date</th>
            </tr>
            <?php
            while($row=mysql_fetch_array($result))
            {
                $date=date('d-m-Y',strtotime($row['userDateTransaction']));
                ?>

                <tr class="tableDataRow" <?php if($row['availableStock'] <= $lowerlimit){echo "style='background:#ffd6c6'"."
                title=' Red row shows, you are running out of stock'";}?>>
                    <td><?php echo $row['partName'];?> </td>
                    <td><?php echo $row['brandName'];?> </td>
                    <td><?php echo $row['buyerName'];?> </td>
                    <td><?php echo $row['sellerName'];?> </td>
                    <td><?php echo $row['availableStock'];?> </td>
                    <td><?php echo $row['totalWorthOfAvailableStock'];?> </td>
                    <td><?php echo $row['additionInStock'];?> </td>
                    <td><?php echo $row['subtractionFromStock'];?> </td>
                    <td><?php echo $date;?> </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }
}
?>
</body>
</html>
