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

    <body id="CPBody">
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
                            <div class="tile" onclick="window.location.href='adduser.php';" title="Click to make new user">
                                <img src="images/add.png">
                                <span>User</span>
                            </div>
                            <div class="tile" onclick="window.location.href='addpart.php';" title="Click to add new part">
                                <img src="images/add.png">
                                <span>Part</span>
                            </div>
                            <div class="tile" onclick="window.location.href='addbrand.php';" title="Click to add new brand">
                                <img src="images/add.png">
                                <span>Brand</span>
                            </div>

                        </div>
                        <div class="indexRow">
                            <div class="tile"  onclick="window.location.href='addbuyer.php';" title="Click to add new buyer">
                                <img src="images/add.png">
                                <span>Buyer</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='addseller.php';" title="Click to add new seller">
                                <img src="images/add.png">
                                <span>Seller</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='addissuer.php';" title="Click to add new issuer">
                                <img src="images/add.png">
                                <span>Issuer</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='addscrapreceiver.php';" title="Click to add new scrap receiver">
                                <img src="images/add.png">
                                <span>Receiver</span>
                            </div>
                        </div>
                        <div class="indexRow">
                            <div class="tile"  onclick="window.location.href='addvehical.php';" title="Click to add new vehical">
                                <img src="images/add.png">
                                <span>Vehical</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='addrackinstore.php';" title="Click to add rack in store">
                                <img src="images/add.png">
                                <span>Rack</span>
                            </div>
                            <div class="tile"  onclick="window.location.href='manageprivacy.php';" title="Click to change privacy setting">
                                <img src="images/privacy.png">
                                <span>Manage Privacy</span>
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
