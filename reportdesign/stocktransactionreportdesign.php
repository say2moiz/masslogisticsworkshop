<?php
require_once('mysqlcon/mysql1.php');
ini_set('max_execution_time', 240);
date_default_timezone_set('Asia/Karachi');
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

<title> <?php echo $reportname;?></title>
<link rel="icon" href="images/title.png" type="image/png">
<style>
body{margin:0; padding:0;font-family:sans-serif;}
body select{font-size: 12px !important; width: 110px !important;}
body input[type="date"]{width: 125px !important;}

.header{width:100%; background-color:#282626; height:30px; top:0px; position:fixed; color:white; text-align:center; line-height:30px;}
.footer{width:100%; background-color:#282626; height:30px; bottom:0px; position:fixed;color:white; text-align:center; line-height:30px;
font-size:large;letter-spacing:5px;}
.reportcontrols{width:100%;height:40px; background-color:#B4A3CA; top:30px; position:fixed;}
.rightportioncontrols .dates{display: inline-block;margin-left: 10px;}
.rightportioncontrols{width:67%;float:right;}
.rightportioncontrols select{padding:4px 6px; margin-top:5px;}
.rightportioncontrols input{padding:2px 6px; margin-top:5px;}
.date{float:left;}
.partfilter{float:right; margin-right:10px;width: 125px;}
.brandfilter{float:right; margin-right:10px;width: 125px;}
.buyerfilter{float:right; margin-right:10px;width: 125px;}
.sellerfilter{float:right; margin-right:10px;width: 125px;}
.sidebarfixed{width:6%; float:left; background-color:white; height:85%; position:fixed; top:70px;}
.allsidebarcontrols{margin-top:150%; padding-left:5px;}
input[type=submit] {width: 80px;height: 30px;color: #f3f3f3; -moz-border-radius: 6px;-webkit-border-radius: 6px;
background-image: -moz-linear-gradient(top, #0cb114, #07580b); /* FF3.6 */background-image: -webkit-gradient(linear,left bottom,left top,
color-stop(0, #07580b),color-stop(1, #0cb114)); /* Saf4+, Chrome */-webkit-box-shadow: #4b4b4b 0px 2px 5px; -moz-box-shadow: #4e4e4e 0px 2px 5px;
box-shadow: #e3e3e3 0px 2px 5px;border: none;zoom: .8;}
.reportname{float:left; line-height:40px; font-size:larger; font-weight:bolder; margin-left: 10px;}
.returndate{margin-left: 8%;display: inline-block;}
.fluid{}
.fluid table{border: 1px solid gray;border-collapse: collapse;width:85%;margin: 0 auto;clear:both;margin-top:75px;text-align:center;font-size:12px;margin-bottom: 50px;margin-top: 90px;}
.fluid table td{border-right:1px solid gray; border-left:1px solid gray;padding-bottom: 5px;padding-top: 5px;}
.fluid table th{border: 1px solid #357880;font-size: larger;font-variant: small-caps;background-color:#B4A3CA;padding: 10px 4px;}
.fluid table tr:nth-child(even){background-color:#DFDFFF;}
.fluid table tr:hover{background-color:/*#428bca*/ #9db9ff;}
.fluid table input[type="text"]{width:72px; font-size:12px; color:blue;}
.orangebg{background-color:#ed9c28;}
.redbg{background-color:#d9534f;}
.grandtotal{background-color: lightsalmon; margin-left: 910px; font-size: 12px; padding: 5px 0px; margin-top: 1px; position: absolute;
    width:99px; text-align: center;}
.editbtns{cursor: pointer;}
.exporttoexcel button#btnExport{margin-top: 7px;border: none;background-color: green;color: white;padding: 5px 10px;}

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
<form method="get">
<div class="reportcontrols">
    <span class="reportname"><?php echo $reportname;?></span>&nbsp;
    <span class="exporttoexcel" >
        <button id="btnExport">Export to Excel</button>
    </span>
    <div class="rightportioncontrols">
<span class="dates">
    <input type="date" name="date1" id="date1" onchange="this.form.submit();"
           value="<?php if(isset($_GET['date1'])){echo $_GET['date1'];} ?>">

    <span id="tobetweendates">To</span>

    <input type="date" name="date2" id="date2" onchange="this.form.submit();"
           value="<?php if(isset($_GET['date2'])){echo $_GET['date2'];} ?>" >
</span>

 <?php
       $partname='';
       $partid='';
       //$qry="select idPart,partName from part";//qry kro mqlsql per sb kux select kro user k table c
$qry="select idPart,partName from part";

 $result=mysql_query($qry) or die(mysql_error());

$partdd='';
?>
<select class="partfilter" name='part' id="partdd" onchange='this.form.submit();'>
    <!-- aik control bnao aisa jime bht sare options mill sake-->
<option value='-1'>Select Part</option>
<?php
while($row=mysql_fetch_array($result))
       {
	$partname=$row['partName'];
	$partid=$row['idPart'];
	if(isset($_GET['part']))
	{ 
	$partdd=$_GET['part'];
	}
	?>
       <!--jese id hoti he wese he class hoti he styling k kaam ati he, aik classs bht sari
       cheezo ko day skte han lakin id aik c zayada chezo ki aik jesi nai hoskti -->
	  <option  value='<?php echo $partid; ?>'<?php if (isset($_GET['part'])){ if($partid==$_GET['part']) echo 'selected="selected"';}?>>
	<?php echo $partname;?>
	</option> <!-- option ye hoge hamare control me -->

	<?php
	}
	?>
</select>


    <?php
    $brandname='';
    $brandid='';
    //$qry="select idPart,partName from part";//qry kro mqlsql per sb kux select kro user k table c
    $qry="select idBrand,brandName from brand";

    $result=mysql_query($qry) or die(mysql_error());

    $branddd='';
    ?>
    <select class="brandfilter" name='brand' id="branddd" onchange='this.form.submit();'>
        <!-- aik control bnao aisa jime bht sare options mill sake-->
        <option value='-1'>Select Brand</option>
        <?php
        while($row=mysql_fetch_array($result))
        {
            $brandname=$row['brandName'];
            $brandid=$row['idBrand'];
            if(isset($_GET['brand']))
            {
                $branddd=$_GET['brand'];
            }
            ?>
            <!--jese id hoti he wese he class hoti he styling k kaam ati he, aik classs bht sari
            cheezo ko day skte han lakin id aik c zayada chezo ki aik jesi nai hoskti -->
            <option  value='<?php echo $brandid; ?>'<?php if (isset($_GET['brand'])){ if($brandid==$_GET['brand']) echo 'selected="selected"';}?>>
                <?php echo $brandname;?>
            </option> <!-- option ye hoge hamare control me -->

        <?php
        }
        ?>
    </select>

    <?php
    $buyername='';
    $buyerid='';
    //$qry="select idPart,partName from part";//qry kro mqlsql per sb kux select kro user k table c
    $qry="select idBuyer,buyerName from buyer";

    $result=mysql_query($qry) or die(mysql_error());

    $buyerdd='';
    ?>
    <select class="buyerfilter" name='buyer' id="buyerdd" onchange='this.form.submit();'>
        <!-- aik control bnao aisa jime bht sare options mill sake-->
        <option value='-1'>Select Buyer</option>
        <?php
        while($row=mysql_fetch_array($result))
        {
            $buyername=$row['buyerName'];
            $buyerid=$row['idBuyer'];
            if(isset($_GET['buyer']))
            {
                $buyerdd=$_GET['buyer'];
            }
            ?>
            <!--jese id hoti he wese he class hoti he styling k kaam ati he, aik classs bht sari
            cheezo ko day skte han lakin id aik c zayada chezo ki aik jesi nai hoskti -->
            <option  value='<?php echo $buyerid; ?>'<?php if (isset($_GET['buyer'])){ if($buyerid==$_GET['buyer']) echo 'selected="selected"';}?>>
                <?php echo $buyername;?>
            </option> <!-- $buyername ye hoge hamare control me -->

        <?php
        }
        ?>
    </select>


    <?php
    $sellername='';
    $sellerid='';
    //$qry="select idPart,partName from part";//qry kro mqlsql per sb kux select kro user k table c
    $qry="select idSeller,sellerName from seller";

    $result=mysql_query($qry) or die(mysql_error());

    $sellerdd='';
    ?>
    <select class="sellerfilter" name='seller' id="sellerdd" onchange='this.form.submit();'>
        <!-- aik control bnao aisa jime bht sare options mill sake-->
        <option value='-1'>Select Seller</option>
        <?php
        while($row=mysql_fetch_array($result))
        {
            $sellername=$row['sellerName'];
            $sellerid=$row['idSeller'];
            if(isset($_GET['seller']))
            {
                $sellerdd=$_GET['seller'];
            }
            ?>
            <!--jese id hoti he wese he class hoti he styling k kaam ati he, aik classs bht sari
            cheezo ko day skte han lakin id aik c zayada chezo ki aik jesi nai hoskti -->
            <option  value='<?php echo $sellerid; ?>'<?php if (isset($_GET['seller'])){ if($sellerid==$_GET['seller']) echo 'selected="selected"';}?>>
                <?php echo $sellername;?>
            </option> <!-- $buyername ye hoge hamare control me -->

        <?php
        }
        ?>
    </select>
</div>
</div>
</form>

<?php
$date1='';
$date2='';

if(isset($_GET['date1']) || isset($_GET['date2']))
{
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];

    if($date1!='' && $date2!='')
    {
        my2($date1,$date2);
        //header("location:stockreport.php");
    }

    elseif($date1!='')
    {
        my($date1);
		//header("location:stockreport.php");
    }

    elseif($date2!='')
    {
        my($date2);
		//header("location:stockreport.php");
    }

    else
    {
        //header("location:stockreport.php");
        my($date2);
    }
}

?>

<div class="sidebarfixed">
<div class="allsidebarcontrols">
<br>
<div class="home"><a href="index.php"><img src="../MassLogisticsWorkshop/images/home.png" width="60"></a></div>
<br>
<div class="admin"><a href="#"><img src="../MassLogisticsWorkshop/images/admin.jpg" width="60"></a></div>
<br>
<div class="logout">
<form method="post">
<input type="submit" name="logout" value="Logout">
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