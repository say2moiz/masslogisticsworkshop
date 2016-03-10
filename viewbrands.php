<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="List of all brands";
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
                    <div class="Img" title="Back to Add Brand" onclick="window.location='addbrand.php'">
                        <img src="images/backhome.png" width="24">
                    </div>
                </div>
            </div>
            <div class="rightPortion"></div>
        </form>
        <table id="mytable" class="reportTable">
            <tr class="tableHeadRow">
                <th>Brand Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $qry="select * from brand";
            $result=mysql_query($qry) or die(mysql_error());
            while($row=mysql_fetch_array($result))
            {
                $brandid=$row['idBrand'];
                ?>
                <tr class="tableDataRow">
                    <td><?php echo $row['brandName'];?> </td>
                    <td>
                        <a href="addbrand.php?brandid=<?php echo $brandid; ?>" title="Click to edit part">
                            <img src="images/edit.png" width="18">
                        </a>
                    </td>
                    <td>
                        <a href="deletebrand.php?brandid=<?php echo $brandid; ?>" title="Click to delete part">
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