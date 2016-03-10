<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Stock Issue Report";
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
                    $issuername='';
                    $issuerid='';
                    $qry="select * from issue";
                    $result=mysql_query($qry) or die(mysql_error());
                    $issuerdd='';
                    ?>
                    <select name="issue" id="issuerdd" onchange="this.form.submit();">
                        <option value='-1'>Select Issuer</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $issuername=$row['name'];
                            $issuerid=$row['idIssue'];
                            if(isset($_GET['issue']))
                            {
                                $issuedd=$_GET['issue'];
                            }
                            ?>
                            <option  value='<?php echo $issuerid; ?>' <?php if (isset($_GET['issue'])){
                                if($issuerid==$_GET['issue']) echo 'selected="selected"';}?>>
                                <?php echo $issuername;?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php
                    $pickername='';
                    $stockidpicker='';
                    $qry="select distinct issuedTo from stock where issueStatus!='null' and issueStatus=1";
                    $result=mysql_query($qry) or die(mysql_error());
                    $pickerdd='';
                    ?>
                    <select name="pick" id="pickerdd" onchange="this.form.submit();">
                        <option value=''>Select Picker</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $pickername=$row['issuedTo'];
                            if(isset($_GET['pick']))
                            {
                                $pickerdd=$_GET['pick'];
                            }
                            ?>
                            <option  value='<?php echo $pickername; ?>'<?php if (isset($_GET['pick'])){
                                if($pickername==$_GET['pick']) echo 'selected="selected"';}?>>
                                <?php echo $pickername;?>
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
    $reportname="Stock Issue Report";
    if(isset($_GET['part'])){ $partid=$_GET['part']; }
    if(!isset($_GET['part']) ) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    if(isset($_GET['issue'])) { $issuerid=$_GET['issue']; }
    if(!isset($_GET['issue']) ) { $issuerid=-1; }
    if(isset($_GET['pick'])) { $pickername=$_GET['pick']; }
    if(!isset($_GET['pick']) ) { $pickername=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1; ?>';
    </script>
    <?php
    if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid==-1 && $issuerid==-1  && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'";
    }

    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.idPart='$partid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername' and ss.idIssue='$issuerid'";
    }

    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idPart='$partid' and ss.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idPart='$partid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idPart='$partid' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.issuedTo='$pickername' and ss.idIssue='$issuerid' ";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid' ";
    }
    else if($partid!=-1 && $d1=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'
        and ss.userDateIssue like '%$d1%' and ss.idIssue='$issuerid' ";
    }

    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idPart='$partid' and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%'
        and ss.idPart='$partid' and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.issuedTo='$pickername'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername'
         and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername'
        and ss.userDateIssue like '%$d1%' and ss.idIssue='$issuerid'";
    }

    else if($partid!=-1 && $d1!='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue like '%$d1%' and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername' and ss.idIssue='$issuerid'";
    }

    else
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1";
        ?>
        <script>
            reportname='<?php echo $reportname." - ".date('d-m-Y'); ?>';
        </script>
        <?php
    }
    $sumOfUnitPrice=0;
    $result=mysql_query($qry) or die(mysql_error());
    $numofrows=mysql_num_rows($result);
    if($numofrows!=0)
    {
        ?>
        <table id="mytable" class="reportTable">
            <tr class="tableHeadRow">
                <th title="Part Name">Part</th>
                <th title="Brand Name">Brand</th>
                <th title="Name of person who issued this part">Issuer</th>
                <th title="Name of person who pick this part from issuer">Picker</th>
                <th title="Name of vehical this part was issued">Issued For</th>
                <th title="Part Number">P.No.</th>
                <th title="Place in store where this part is kept">PIS</th>
                <th title="Issue remarks">Remarks</th>
                <th title="Unit of purchase">Unit Price</th>
                <th title="Issue Date">Date</th>
                <th title="This id will be required when this part will be returning">Tracking Id</th>
            </tr>
            <?php
            while($row=mysql_fetch_array($result))
            {
                $date=date('d-m-Y',strtotime($row['userDateIssue']));
                ?>
                <tr class="tableDataRow" <?php if($row['trackingId'] != ''){echo "style='background:#D7FFDB'"."
                title='Green row shows, you are tracking this part, scrap report will be generated when this part will return'";}?>>
                    <td><?php echo $row['partName'];?> </td>
                    <td><?php echo $row['brandName'];?> </td>
                    <td><?php echo $row['issuedBy'];?> </td>
                    <td><?php echo $row['issuedTo'];?> </td>
                    <td><?php echo $row['vehicalNumber'];?> </td>
                    <td><?php echo $row['partNumber'];?> </td>
                    <td><?php echo $row['rackDescription'];?> </td>
                    <td><?php echo $row['remarks'];?> </td>
                    <td><?php echo $row['unitPrice'];?> </td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $row['trackingId'];?> </td>
                </tr>
                <?php
                $sumOfUnitPrice+=$row['unitPrice'];
            }
            ?>
            <tr class="tableDataRow">
                <td colspan="8"></td>
                <td class="sumOfCol" title="Sum of price column">= <?php echo $sumOfUnitPrice;?></td>
                <td colspan="2"></td>
            </tr>
        </table>
    <?php
    }
}

function my2($d1,$d2)
{
    $reportname="Stock Issue Report";
    if(isset($_GET['part'])){ $partid=$_GET['part']; }
    if(!isset($_GET['part']) ) { $partid=-1; }
    if(isset($_GET['brand'])) { $brandid=$_GET['brand']; }
    if(!isset($_GET['brand']) ) { $brandid=-1; }
    if(isset($_GET['issue'])) { $issuerid=$_GET['issue']; }
    if(!isset($_GET['issue']) ) { $issuerid=-1; }
    if(isset($_GET['pick'])) { $pickername=$_GET['pick']; }
    if(!isset($_GET['pick']) ) { $pickername=-1; }
    $dateLocal1=date('d-m-Y',strtotime($d1));
    $dateLocal2=date('d-m-Y',strtotime($d2));
    ?>
    <script>
        reportname='<?php echo $reportname." - ".$dateLocal1." To ".$dateLocal2; ?>';
    </script>
    <?php

    if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid==-1  && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'";
    }

    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.idPart='$partid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idPart='$partid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idBrand='$brandid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid==-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'
        and ss.idPart='$partid' and ss.idBrand='$brandid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'
        and ss.idPart='$partid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'
        and ss.idPart='$partid' and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid'
        and ss.issuedTo='$pickername' and ss.idIssue='$issuerid' ";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid' ";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.issuedTo='$pickername'
        and ss.userDateIssue between '$d1' and '$d2' and ss.idIssue='$issuerid' ";
    }

    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid!=-1 && $pickername=='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idPart='$partid' and ss.idBrand='$brandid'
        and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid==-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idPart='$partid' and ss.idBrand='$brandid'
        and ss.issuedTo='$pickername'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.issuedTo='$pickername'
        and ss.idBrand='$brandid' and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername' and ss.idBrand='$brandid'
        and ss.idIssue='$issuerid'";
    }
    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.idPart='$partid' and ss.issuedTo='$pickername' and ss.userDateIssue between '$d1' and '$d2'
        and ss.idIssue='$issuerid'";
    }

    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1 && $issuerid!=-1 && $pickername!='')
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1 and ss.userDateIssue between '$d1' and '$d2' and ss.idPart='$partid'
        and ss.idBrand='$brandid' and ss.issuedTo='$pickername' and ss.idIssue='$issuerid'";
    }

    else
    {
        $qry="select p.idPart,p.partName,b.brandName,(select name from issue where idIssue=ss.idIssue)as
        issuedBy,partNumber,s.rackDescription,ss.remarks,
        (ss.price) as unitPrice,ss.userDateIssue,ss.issuedTo,v.vehicalNumber,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus!='null' and ss.issueStatus=1";
    }
    $sumOfUnitPrice=0;
    $result=mysql_query($qry) or die(mysql_error());
    $numofrows=mysql_num_rows($result);
    if($numofrows!=0)
    {
        ?>
        <table id="mytable" class="reportTable">
            <tr class="tableHeadRow">
                <th title="Part Name">Part</th>
                <th title="Brand Name">Brand</th>
                <th title="Name of person who issued this part">Issuer</th>
                <th title="Name of person who pick this part from issuer">Picker</th>
                <th title="Name of vehical this part was issued">Issued For</th>
                <th title="Part Number">P.No.</th>
                <th title="Place in store where this part is kept">PIS</th>
                <th title="Issue remarks">Remarks</th>
                <th title="Unit of purchase">Unit Price</th>
                <th title="Issue Date">Date</th>
                <th title="This id will be required when this part will be returning">Tracking Id</th>
            </tr>
            <?php
            while($row=mysql_fetch_array($result))
            {
                $date=date('d-m-Y',strtotime($row['userDateIssue']));
                ?>
                <tr class="tableDataRow" <?php if($row['trackingId'] != ''){echo "style='background:#D7FFDB'"."
                title='Green row shows, you are tracking this part, scrap report will be generated when this part will return'";}?>>
                    <td><?php echo $row['partName'];?> </td>
                    <td><?php echo $row['brandName'];?> </td>
                    <td><?php echo $row['issuedBy'];?> </td>
                    <td><?php echo $row['issuedTo'];?> </td>
                    <td><?php echo $row['vehicalNumber'];?> </td>
                    <td><?php echo $row['partNumber'];?> </td>
                    <td><?php echo $row['rackDescription'];?> </td>
                    <td><?php echo $row['remarks'];?> </td>
                    <td><?php echo $row['unitPrice'];?> </td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $row['trackingId'];?> </td>
                </tr>
            <?php
                $sumOfUnitPrice+=$row['unitPrice'];
            }
            ?>
            <tr class="tableDataRow">
                <td colspan="8"></td>
                <td class="sumOfCol" title="Sum of price column">= <?php echo $sumOfUnitPrice;?></td>
                <td colspan="2"></td>
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
