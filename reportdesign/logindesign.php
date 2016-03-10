<?php
require_once('mysqlcon/mysql1.php');
ini_set('max_execution_time', 240);
date_default_timezone_set('Asia/Karachi');
session_start();
?>
<!DOCTYPE html>
<html>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-1.11.1.js"></script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<head>
    <script src="Scripts/jquery-2.0.1.min.js"></script>
    <script src="Scripts/jquery.btechco.excelexport.js"></script>
    <script src="Scripts/jquery.base64.js"></script>

<link rel="icon" href="images/title.png" type="image/png">
<style>
body{margin:0; padding:0;font-family:sans-serif;}
body select{font-size: 12px !important; width: 110px !important;}
body input[type="date"]{width: 125px !important;}

.header{width:100%; background-color:#282626; height:30px; top:0px; position:fixed; color:white; text-align:center; line-height:30px;}
.footer{width:100%; background-color:#282626; height:30px; bottom:0px; position:fixed;color:white; text-align:center; line-height:30px;
font-size:large;letter-spacing:5px;}

.sidebarfixed{width:6%; float:left; background-color:white; height:85%; position:fixed; top:70px;}
.allsidebarcontrols{margin-top:150%; padding-left:5px;}
input[type=submit] {width: 80px;height: 30px;color: #f3f3f3; -moz-border-radius: 6px;-webkit-border-radius: 6px;
background-image: -moz-linear-gradient(top, #0cb114, #07580b); /* FF3.6 */background-image: -webkit-gradient(linear,left bottom,left top,
color-stop(0, #07580b),color-stop(1, #0cb114)); /* Saf4+, Chrome */-webkit-box-shadow: #4b4b4b 0px 2px 5px; -moz-box-shadow: #4e4e4e 0px 2px 5px;
box-shadow: #e3e3e3 0px 2px 5px;border: none;zoom: .8;}


</style>
</head>

<body>
<div class="container">
<div class="header">
Mass Logistics
    <span>
        <b style="float: right;margin:0px 15px 0px 5px;font-variant: small-caps;font-family: sans-serif;letter-spacing: 2px;"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?></b>
        <img src="images/user.png" style="float: right;display: inline-block;width: 24px;margin-top: 4px;">
    </span>
</div>




<div class="sidebarfixed" id="sidebarfixed">
<div class="allsidebarcontrols">
<br>
<div class="home"><a href="index.php"><img src="../MassLogisticsWorkshop/images/home.png" width="60"></a></div>
<br>
<div class="admin"><a href="#"><img src="../MassLogisticsWorkshop/images/admin.jpg" width="60"></a></div>
<br>
<div class="logout">
<form method="post">
<input type="submit" name="logout" value="Logout" id="logout">
</form>
</div>
</div>
</div>



</div>

<div class="footer">
WingBiz Soft's Inventory Managment System
</div>

</div>
</body>
</html>