<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Purchase Report";
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
                    <?php
                    $buyername = '';
                    $buyerid = '';
                    $qry = "select idBuyer,buyerName from buyer";
                    $result = mysql_query($qry) or die(mysql_error());
                    $buyerdd = '';
                    ?>
                    <select name="buyer" id="buyerdd" onchange="this.form.submit();">
                        <option value='-1'>Select Buyer</option>
                        <?php
                        while ($row = mysql_fetch_array($result)) {
                            $buyername = $row['buyerName'];
                            $buyerid = $row['idBuyer'];
                            if (isset($_GET['buyer'])) {
                                $buyerdd = $_GET['buyer'];
                            }
                            ?>
                            <option value='<?php echo $buyerid; ?>'<?php if (isset($_GET['buyer'])) {
                                if ($buyerid == $_GET['buyer']) echo 'selected="selected"';
                            } ?>>
                                <?php echo $buyername; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php
                    $sellername = '';
                    $sellerid = '';
                    $qry = "select idSeller,sellerName from seller";
                    $result = mysql_query($qry) or die(mysql_error());
                    $sellerdd = '';
                    ?>
                    <select name="seller" id="sellerdd" onchange="this.form.submit();">
                        <option value='-1'>Select Seller</option>
                        <?php
                        while ($row = mysql_fetch_array($result)) {
                            $sellername = $row['sellerName'];
                            $sellerid = $row['idSeller'];
                            if (isset($_GET['seller'])) {
                                $sellerdd = $_GET['seller'];
                            }
                            ?>
                            <option value='<?php echo $sellerid; ?>'<?php if (isset($_GET['seller'])) {
                                if ($sellerid == $_GET['seller']) echo 'selected="selected"';
                            } ?>>
                                <?php echo $sellername; ?>
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
    $reportname="Purchase Report";
    if(isset($_GET['part'])){ $partid=$_GET['part']; }
    if(!isset($_GET['part']) ) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    if(isset($_GET['buyer'])) { $buyerid=$_GET['buyer']; }
    if(!isset($_GET['buyer']) ) { $buyerid=-1; }
    if(isset($_GET['seller'])) { $sellerid=$_GET['seller']; }
    if(!isset($_GET['seller']) ) { $sellerid=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1; ?>';
    </script>
    <?php
    if($partid!=-1 && $d1=='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.idPart='$partid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid'";
    }

    else if($partid==-1 && $d1=='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid==-1 && $buyerid==-1  && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and pp.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and s.idSeller='$sellerid'";
    }
     else if($partid!=-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and pp.idPart='$partid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid' and pp.idPart='$partid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and b.idBuyer='$buyerid' and bb.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid' and bb.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate like '%$d1%' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate like '%$d1%' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and p.userPurchaseDate like '%$d1%' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and s.idSeller='$sellerid' and bb.idBrand='$brandid'";
    }
     else if($partid!=-1 && $d1!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid'
        and b.idBuyer='$buyerid' and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid' and s.idSeller='$sellerid'
        and p.userPurchaseDate like '%$d1%'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid'
        and p.userPurchaseDate like '%$d1%' and b.idBuyer='$buyerid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid'
        and bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.userPurchaseDate like '%$d1%' and s.idSeller='$sellerid'
        and bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }



    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.idPart='$partid' and s.idSeller='$sellerid'
        and b.idBuyer='$buyerid' and p.userPurchaseDate like '%$d1%'";
    }

    else
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand";
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
                <th title="Purchase Date">Pur Date</th>
                <th title="Purchased For">Pur For</th>
                <th title="Purchase Remarks">Remarks</th>
                <th title="Unit Price">Price</th>
                <th title="Total Price">T-Price</th>
                <th title="Quantity">Q</th>
                <th title="Unit Of Purchase">UOP</th>
                <th title="Edit Purchase">Edit</th>
                <th title="Delete Purchase">Delete</th>
            </tr>
            <?php
            $sumOfTotalPrice=0;
            $sumOfUnitPrice=0;
            $sumOfQuantity=0;
            while($row=mysql_fetch_array($result))
            {
                $date=date('d-m-Y',strtotime($row['userPurchaseDate']));
                $purchaseid=$row['idPurchase'];
                ?>
                <tr class="tableDataRow">
                    <td><?php echo $row['partName'];?> </td>
                    <td><?php echo $row['brandName'];?> </td>
                    <td><?php echo $row['buyerName'];?> </td>
                    <td><?php echo $row['sellerName'];?> </td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $row['purchasedFor'];?> </td>
                    <td><?php echo $row['remarks'];?> </td>
                    <td><?php echo $row['price'];?> </td>
                    <td><?php echo $row['price']*$row['quantity'];?> </td>
                    <td><?php echo $row['quantity'];?> </td>
                    <td><?php echo $row['unitOfPurchase'];?> </td>
                    <td>
                        <a href="addpurchase.php?purchaseid=<?php echo $purchaseid; ?>" target="_blank" title="Click to edit purchase">
                            <img src="images/edit.png" width="18">
                        </a>
                    </td>
                    <td>
                        <a href="deletepurchase.php?purchaseid=<?php echo $purchaseid; ?>" title="Click to delete purchase">
                            <img src="images/delete.png" width="18">
                        </a>
                    </td>
                </tr>
            <?php
                $sumOfTotalPrice+=($row['price']*$row['quantity']);
                $sumOfUnitPrice+=$row['price'];
                $sumOfQuantity+=$row['quantity'];
            }
            ?>
            <tr class="tableDataRow">
                <td colspan="7"></td>
                <td class="sumOfCol" title="Sum of price column">= <?php echo $sumOfUnitPrice;?></td>
                <td class="sumOfCol" title="Sum of total price column">= <?php echo $sumOfTotalPrice;?></td>
                <td class="sumOfCol" title="Sum of quantity column">= <?php echo $sumOfQuantity;?></td>
                <td colspan="3"></td>
            </tr>
        </table>
        <?php
    }
}

function my2($d1,$d2)
{
    $reportname="Purchase Report";
    if(isset($_GET['part'])) { $partid=$_GET['part']; }
    if(!isset($_GET['part'])) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    if(isset($_GET['buyer'])) { $buyerid=$_GET['buyer']; }
    if(!isset($_GET['buyer']) ) { $buyerid=-1; }
    if(isset($_GET['seller'])) { $sellerid=$_GET['seller']; }
    if(!isset($_GET['seller']) ) { $sellerid=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    $dateLocal2=date('d-m-Y',strtotime($d2));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1." To ".$dateLocal2; ?>';
    </script>
    <?php
    if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.idPart='$partid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid==-1  && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.userPurchaseDate between '$d1' and '$d2'";
    }




    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and pp.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid' and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and s.idSeller='$sellerid'";
    }



    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid'
        and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and pp.idPart='$partid'
        and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where s.idSeller='$sellerid' and pp.idPart='$partid'
        and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and b.idBuyer='$buyerid' and bb.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid' and bb.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid'
        and p.userPurchaseDate between '$d1' and '$d2' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and
        p.userPurchaseDate between '$d1' and '$d2' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid'
        and p.userPurchaseDate between '$d1' and '$d2' and s.idSeller='$sellerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where b.idBuyer='$buyerid' and s.idSeller='$sellerid' and bb.idBrand='$brandid'";
    }




    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid==-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid'
        and b.idBuyer='$buyerid' and p.userPurchaseDate  between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid==-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and pp.idPart='$partid' and s.idSeller='$sellerid' and p.userPurchaseDate          between '$d1' and '$d2'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid'
        and p.userPurchaseDate  between '$d1' and '$d2' and b.idBuyer='$buyerid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where pp.idPart='$partid' and s.idSeller='$sellerid' and bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where p.userPurchaseDate between '$d1' and '$d2'
        and s.idSeller='$sellerid' and bb.idBrand='$brandid' and b.idBuyer='$buyerid'";
    }


    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $buyerid!=-1 && $sellerid!=-1)
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand='$brandid' and p.idPart='$partid'
        and s.idSeller='$sellerid' and b.idBuyer='$buyerid' and p.userPurchaseDate between '$d1' and '$d2'";
    }
    else
    {
        $qry="select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand";
    }

    $sumOfTotalPrice=0;
    $sumOfUnitPrice=0;
    $sumOfQuantity=0;
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
                <th title="Purchase Date">Pur Date</th>
                <th title="Purchased For">Pur For</th>
                <th title="Purchase Remarks">Remarks</th>
                <th title="Unit Price">Price</th>
                <th title="Total Price">T-Price</th>
                <th title="Quantity">Q</th>
                <th title="Unit Of Purchase">UOP</th>
                <th title="Edit Purchase">Edit</th>
                <th title="Delete Purchase">Delete</th>
            </tr>
            <?php
            while($row=mysql_fetch_array($result))
            {
                $date=date('d-m-Y',strtotime($row['userPurchaseDate']));
                $purchaseid=$row['idPurchase'];
                ?>
                <tr class="tableDataRow">
                    <td><?php echo $row['partName'];?> </td>
                    <td><?php echo $row['brandName'];?> </td>
                    <td><?php echo $row['buyerName'];?> </td>
                    <td><?php echo $row['sellerName'];?> </td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $row['purchasedFor'];?> </td>
                    <td><?php echo $row['remarks'];?> </td>
                    <td><?php echo $row['price'];?> </td>
                    <td><?php echo $row['price']*$row['quantity'];?> </td>
                    <td><?php echo $row['quantity'];?> </td>
                    <td><?php echo $row['unitOfPurchase'];?> </td>
                    <td>
                        <a href="addpurchase.php?purchaseid=<?php echo $purchaseid; ?>" target="_blank" title="Click to edit purchase">
                            <img src="images/edit.png" width="18">
                        </a>
                    </td>
                    <td>
                        <a href="deletepurchase.php?purchaseid=<?php echo $purchaseid; ?>" title="Click to delete purchase">
                            <img src="images/delete.png" width="18">
                        </a>
                    </td>
                </tr>
                <?php
                $sumOfTotalPrice+=($row['price']*$row['quantity']);
                $sumOfUnitPrice+=$row['price'];
                $sumOfQuantity+=$row['quantity'];
            }
            ?>
            <tr class="tableDataRow">
                <td colspan="7"></td>
                <td class="sumOfCol" title="Sum of price column">= <?php echo $sumOfUnitPrice;?></td>
                <td class="sumOfCol" title="Sum of total price column">= <?php echo $sumOfTotalPrice;?></td>
                <td class="sumOfCol" title="Sum of quantity column">= <?php echo $sumOfQuantity;?></td>
                <td colspan="3"></td>
            </tr>
        </table>
    <?php
    }
}
require_once("footer.php");
?>
    </div>
</body>
</html>