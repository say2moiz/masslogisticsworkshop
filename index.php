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

        <script src="Scripts/jquery-2.0.1.min.js"></script>
        <script src="Scripts/jquery.btechco.excelexport.js"></script>
        <script src="Scripts/jquery.base64.js"></script>
        <script src="parts/datasource.js"></script>
        <script src="base/base.js"></script>
        <script src="Scripts/keyrestrict.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    </head>

    <body id="indexBody">
        <?php include "header.php";?>
        <div class="outer">
            <div class="middle">
                <div class="inner">

                    <div id="contentMainDiv">

                        <div class="indexRow">
                            <div class="tile">
                                <img src="images/usertile.png">
                                <span><?php echo $_SESSION['username'];?></span>
                            </div>

                            <div class="tile" onclick="window.location.href='controlpanel.php';">
                                <img src="images/cptile.png">
                                <span>Control Panel</span>
                            </div>

                            <div class="tile" onclick="window.location.href='transactions.php';">
                                <img src="images/transactiontile.png">
                                <span>Perform Transaction</span>
                            </div>
                        </div>
                        <div class="indexRow">
                            <div class="tile"  onclick="window.location.href='reports.php';">
                                <img src="images/reporttile.png">
                                <span>Reports</span>
                            </div>
                            <div class="tile">
                                <img src="images/helptile.png">
                                <span>Help</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='login.php';">
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
