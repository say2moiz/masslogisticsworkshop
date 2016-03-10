<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Delete Rack";
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
            </div>
            <div class="rightPortion">

            </div>
        </div>
    </form>
    <?php
    if (isset($_GET['rackid'])) { $rackid = $_GET['rackid']; }
    else { header('location:viewracks.php'); }
    if ($rackid != '')
    {
        $qry = "select * from store where idStore='$rackid'";
    }
    ?>
    <table id="mytable" class="reportTable">
        <tr class="tableHeadRow">
            <th>Rack Name</th>
        </tr>
        <?php
        $result = mysql_query($qry) or die(mysql_error());
        while ($row = mysql_fetch_array($result))
        {
            ?>
            <tr class="tableDataRow">
                <td><?php echo $row['rackDescription'];?> </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div id="containerOuter">
        <div id="containerInner">
            <form method="post">
                <div class="form clearfix">
                    <div class="formHead">Delete Rack</div>
                    <div class="formFoot clearfix">
                        <span>Are you sure? you want to delete the above rack? if yes click delete. Or click  cancel to go back.</span>
                        <input type="submit" name="submit" value="Delete" id="submit">
                        <input type="button" name="cancel" value="Cancel" id="cancel"
                               onclick="window.location='viewracks.php'">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="responseMsg clearfix" id="responseMsg" style="display: none;">

    </div>
    <?php
    if (isset($_POST['submit']))
    {
        $qryDeletePermit="select * from part where idStore='$rackid'";
        $resultDeletePermit=mysql_query($qryDeletePermit) or die(mysql_error());
        $countDeletePermit=mysql_num_rows($resultDeletePermit);

        if($countDeletePermit==0)
        {
            $qry = "delete from store where idStore='$rackid'";
            $result = mysql_query($qry) or die(mysql_error());
            header('location:viewracks.php');
        }
        else
        {
            ?>
            <script>
                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">Alert!!! You cannot delete this rack because he has sold you something.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                setTimeout(function(){
                    $('#responseMsg').hide();
                },10000);
            </script>
        <?php
        }
    }
    ?>
    </body>
</html>