<?php
session_start();
if($_SESSION['login']!=true)
{
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inventory Managment</title>

        <style>

        </style>

        <script src="Scripts/jquery-1.11.1.js"></script>
        <script src="Scripts/jquery-1.11.1.min.js"></script>
        <script src="Scripts/jquery.btechco.excelexport.js"></script>
        <script src="Scripts/jquery.base64.js"></script>
        <script src="parts/datasource.js"></script>
        <script src="base/base.js"></script>
        <script src="Scripts/keyrestrict.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    </head>

    <body id="reportsBody">
        <?php include "header.php";?>
        <div class="outer">
            <div class="middle">
                <div class="inner">

                    <div id="contentMainDiv">
                        <div class="indexRow">
                            <div class="tile" onclick="window.location.href='index.php'" title="Click to goto home page">
                                <img src="images/home.png">
                                <span>Home</span>
                            </div>
                            <div class="tile" onclick="window.location.href='purchasereport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'"                                     title="View purchase report">
                                <img src="images/reporttile.png">
                                <span>Purchase Report</span>
                            </div>

                            <div class="tile" onclick="window.location.href='stockreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'"
                            title="View stock report">
                                <img src="images/reporttile.png">
                                <span>Stock Report</span>
                            </div>
                        </div>
                        <div class="indexRow">
                            <div class="tile" onclick="window.location.href='stockissuereport.php?date1=&date2=&part=-1&issue=-1&pick=&brand=-1'"
                                 title="View stock issue report">
                                <img src="images/reporttile.png">
                                <span>Stock Issue Report</span>
                            </div>
                            <div class="tile" onclick="window.location.href='scrapreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'"
                                 title="View scrap report">
                                <img src="images/reporttile.png">
                                <span>Scrap Report</span>
                            </div>
                            <div class="tile" onclick="window.location.href='stocktransactionreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1'"
                                 title="View bin card report">
                                <img src="images/reporttile.png">
                                <span>Bin Card Report</span>
                            </div>
                        </div>
                        <div class="indexRow">
                            <div class="tile notInUse" onclick="window.location.href='#';">
                                <img src="images/stop.png">
                                <span>Not in use</span>
                            </div>
                            <div class="tile notInUse" onclick="window.location.href='#';">
                                <img src="images/stop.png">
                                <span>Not in use</span>
                            </div>
                            <div class="tile" onclick="window.location.href='login.php'" title="Click to logout">
                                <img src="images/logouttile.png">
                                <span>Logout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php";?>
    </body>
</html>
