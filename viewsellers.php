<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="List of all sellers";
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
                <div class="Img" title="Back to Add Buyer" onclick="window.location='addseller.php'">
                    <img src="images/backhome.png" width="24">
                </div>
            </div>
        </div>
        <div class="rightPortion"></div>
    </form>
    <table id="mytable" class="reportTable">
        <tr class="tableHeadRow">
            <th>Seller Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $qry="select * from seller";
        $result=mysql_query($qry) or die(mysql_error());
        while($row=mysql_fetch_array($result))
        {
            $sellerid=$row['idSeller'];
            ?>
            <tr class="tableDataRow">
                <td><?php echo $row['sellerName'];?> </td>
                <td>
                    <a href="addseller.php?sellerid=<?php echo $sellerid; ?>" title="Click to edit seller">
                        <img src="images/edit.png" width="18">
                    </a>
                </td>
                <td>
                    <a href="deleteseller.php?sellerid=<?php echo $sellerid; ?>" title="Click to delete seller">
                        <img src="images/delete.png" width="18">
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    require_once("footer.php");
    ?>
</div>
</body>
</html>