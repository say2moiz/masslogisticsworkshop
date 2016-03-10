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
        <title>Stop</title>

        <style>

        </style>
        <link rel="icon" href="images/title.png" type="image/png">
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
        <img src="images/backhome.png" width="64" class="backHome" title="Go back home" onclick="window.location='index.php'">
            <span class="restrictMsg">
                You do not have access to this page.
                <br><br>
                Please don't try to access it by unfair means.
                <br><br>
                Contact the administrator to get access.
            </span>
            <img src="images/restrict.png" width="300" class="restrictImg" title="Restriction shield, you do not have access to the page, you were trying to access. ">
        <?php include "footer.php";?>
    </body>
</html>
