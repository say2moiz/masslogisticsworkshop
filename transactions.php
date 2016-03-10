<?php
require_once('checkLoginAndVerifyAccessPage.php');
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

    <body id="transactionBody">
        <?php include "header.php";?>
        <div class="outer">
            <div class="middle">
                <div class="inner">

                    <div id="contentMainDiv">

                        <div class="indexRow">
                            <div class="tile" onclick="window.location.href='index.php';" title="Click to goto home page">
                                <img src="images/home.png">
                                <span>Home</span>
                            </div>
                            <div class="tile" onclick="window.location.href='addpurchase.php';" title="Click to make purchase">
                                <img src="images/purchase.png">
                                <span>Make purchase</span>
                            </div>
                            <div class="tile" onclick="window.location.href='issuepage.php';" title="Click to issue from stock">
                                <img src="images/issue.png">
                                <span>Issue from stock</span>
                            </div>
                        </div>
                        <div class="indexRow">
                            <div class="tile" onclick="window.location.href='return.php';" title="Click to receive back scrap">
                                <img src="images/return.png">
                                <span>Receive scrap back</span>
                            </div>
                            <div class="tile notInUse" onclick="window.location.href='#';">
                                <img src="images/stop.png">
                                <span>Not in use</span>
                            </div>
                            <div class="tile notInUse" onclick="window.location.href='#';">
                                <img src="images/stop.png">
                                <span>Not in use</span>
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
