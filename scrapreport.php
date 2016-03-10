<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Scrap Report";
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
                    <input type="date" name="date1" id="date1" onchange="this.form.submit();" title="Search by return date"
                           value="<?php if (isset($_GET['date1'])) {echo $_GET['date1'];} ?>">
                    To
                    <input type="date" name="date2" id="date2" onchange="this.form.submit();" title="Search by return date"
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
    $reportname="Scrap Report";
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
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1!='' && $brandid==-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn like '%$d1%' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1=='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }



    else if($partid!=-1 && $d1!='' && $brandid==-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn like '%$d1%' and ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1!='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn like '%$d1%' and ss.idBrand='$brandid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid!=-1 && $d1=='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }



    else if($partid!=-1 && $d1!='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.idPart='$partid' and ss.userDateReturn like '%$d1%' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus='1' and ss.returnStatus='1'";
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
            <th title="Name">Brand</th>
            <th title="Person who issued this part">Issuer</th>
            <th title="Person who picked the part">Picker</th>
            <th title="Name of person whome part is returned to">Return To</th>
            <th title="Name of person who returned the part">Return By</th>
            <th title="Name of vehical part was issued">Issued For</th>
            <th>Date Issued</th>
            <th title="Search by return date only for this report">Date Returned</th>
            <th title="Part Number">P.No.</th>
            <th title="Place in store">PIS</th>
            <th title="Unit price of purchase">Price</th>
            <th title="Purchase Remarks">P.Remarks</th>
            <th title="Issue remarks">I.Remarks</th>
            <th title="Return remarks">R.Remarks</th>
            <th>Tracking Id</th>
        </tr>
        <?php
        while($row=mysql_fetch_array($result))
        {
            $date=date('d-m-Y',strtotime($row['userDateIssue']));
            $date1=date('d-m-Y',strtotime($row['userDateReturn']));
            ?>
            <tr class="tableDataRow">
                <td><?php echo $row['partName'];?> </td>
                <td><?php echo $row['brandName'];?> </td>
                <td><?php echo $row['issuedTo'];?> </td>
                <td><?php echo $row['issuedBy'];?> </td>
                <td><?php echo $row['returnedTo'];?> </td>
                <td><?php echo $row['returnedBy'];?> </td>
                <td><?php echo $row['vehicalNumber'];?> </td>
                <td><?php echo $date;?></td>
                <td><?php echo $date1;?></td>
                <td><?php echo $row['partNumber'];?> </td>
                <td><?php echo $row['rackDescription'];?> </td>
                <td><?php echo $row['unitPrice'];?> </td>
                <td><?php echo $row['remarks'];?> </td>
                <td><?php echo $row['issueRemarks'];?> </td>
                <td><?php echo $row['returnRemarks'];?> </td>
                <td><?php echo $row['trackingId'];?> </td>
            </tr>
        <?php
        }
}
?>
    </table>
<?php
}

function my2($d1,$d2)
{
    $reportname="Scrap Report";
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
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid==-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn between '$d1' and '$d2' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1=='' && $d2=='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }

    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid==-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn between '$d1' and '$d2' and ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid==-1 && $d1!='' && $d2!='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.userDateReturn between '$d1' and '$d2' and ss.idBrand='$brandid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else if($partid!=-1 && $d1=='' && $d2=='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.idPart='$partid' and ss.issueStatus='1' and ss.returnStatus='1'";
    }



    else if($partid!=-1 && $d1!='' && $d2!='' && $brandid!=-1)
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.idBrand='$brandid' and ss.idPart='$partid' and ss.userDateReturn between '$d1' and '$d2'
        and ss.issueStatus='1' and ss.returnStatus='1'";
    }
    else
    {
        $qry="select p.idPart,p.partName,b.brandName,i.name as issuedBy,ss.issuedTo,ss.returnedBy,
        r.name as returnedTo,v.vehicalNumber,ss.userDateIssue,ss.userDateReturn,partNumber,s.rackDescription,
        ss.price as unitPrice,remarks,issueRemarks,returnRemarks,ss.trackingId  from stock ss
        inner join part p on p.idPart=ss.idPart
        inner join store s on s.idStore=p.idStore
        inner join brand b on b.idBrand=ss.idBrand
        inner join issue i on i.idIssue=ss.idIssue
        inner join return1 r on r.idReturn=ss.idReturn
        inner join vehical v on v.idVehical=ss.idVehical
        where ss.issueStatus='1' and ss.returnStatus='1'";
    }
$result=mysql_query($qry) or die(mysql_error());
$numofrows=mysql_num_rows($result);
if($numofrows!=0)
{
?>
<table id="mytable" class="reportTable">
    <tr class="tableHeadRow">
        <th title="Part Name">Part</th>
        <th title="Name">Brand</th>
        <th title="Person who issued this part">Issuer</th>
        <th title="Person who picked the part">Picker</th>
        <th title="Name of person who returned the part">Return By</th>
        <th title="Name of person whome part is returned to">Return To</th>
        <th title="Name of vehical part was issued">Issued For</th>
        <th>Date Issued</th>
        <th title="Search by return date only for this report">Date Returned</th>
        <th title="Part Number">P.No.</th>
        <th title="Place in store">PIS</th>
        <th title="Unit price of purchase">Price</th>
        <th title="Purchase Remarks">P.Remarks</th>
        <th title="Issue remarks">I.Remarks</th>
        <th title="Return remarks">R.Remarks</th>
        <th>Tracking Id</th>
    </tr>
    <?php
    while($row=mysql_fetch_array($result))
    {
        $date=date('d-m-Y',strtotime($row['userDateIssue']));
        $date1=date('d-m-Y',strtotime($row['userDateReturn']));
        ?>
        <tr class="tableDataRow">
            <td><?php echo $row['partName'];?> </td>
            <td><?php echo $row['brandName'];?> </td>
            <td><?php echo $row['issuedTo'];?> </td>
            <td><?php echo $row['issuedBy'];?> </td>
            <td><?php echo $row['returnedTo'];?> </td>
            <td><?php echo $row['returnedBy'];?> </td>
            <td><?php echo $row['vehicalNumber'];?> </td>
            <td><?php echo $date;?></td>
            <td><?php echo $date1;?></td>
            <td><?php echo $row['partNumber'];?> </td>
            <td><?php echo $row['rackDescription'];?> </td>
            <td><?php echo $row['unitPrice'];?> </td>
            <td><?php echo $row['remarks'];?> </td>
            <td><?php echo $row['issueRemarks'];?> </td>
            <td><?php echo $row['returnRemarks'];?> </td>
            <td><?php echo $row['trackingId'];?> </td>
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

