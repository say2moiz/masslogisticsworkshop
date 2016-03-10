<?php
session_start();
$reportname="Purchase Report";
require_once('mysqlcon/mysql1.php');
require_once("header.php");
//require_once("navigationbar.php");
if($_SESSION['login']!=true)
{
    header('location:login.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title> <?php echo $reportname;?></title>
    <link rel="icon" href="images/title.png" type="image/png">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
</head>
<body>
    <div id="reportContainer" class="clearfix">
        <form method="get">
            <div class="reportControls clearfix">
                <div class="leftPortion">
                    <div class="reportName">Purchase Report</div>
                    <div class="Img" title="Click to go to home" onclick="window.location='index.php';">
                        <img src="images/home.png" width="24">
                    </div>
                    <div class="Img" title="Click to go to reports page" onclick="window.location='reports.php';">
                        <img src="images/reporttile.png" width="24">
                    </div>
                    <div class="Img" id="btnExport" title="Click to download this report as excel" onclick="window.location='index.php';">
                        <img src="images/excel.png">
                    </div>
                </div>
                <div class="rightPortion">
                    <select>
                        <option>Opt1</option>
                        <option>Opt1</option>
                        <option>Opt1</option>
                    </select>
                    <select>
                        <option>Opt1</option>
                        <option>Opt1</option>
                        <option>Opt1</option>
                    </select>
                    <select>
                        <option>Opt1</option>
                        <option>Opt1</option>
                        <option>Opt1</option>
                    </select>
                    <select>
                        <option>Opt1</option>
                        <option>Opt1</option>
                        <option>Opt1</option>
                    </select>
                    <select>
                        <option>Opt1</option>
                        <option>Opt1</option>
                        <option>Opt1</option>
                    </select>
                    <span>
                        <input type="date">
                        To
                        <input type="date">
                    </span>
                </div>
            </div>
        </form>
        <table class="reportTable">
            <tr class="tableHeadRow" >
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
            </tr>
            <?php for($i=0 ; $i<100 ; $i++){ ?>
            <tr class="tableDataRow">
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
            </tr>
            <?php }?>
        </table>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>
</html>