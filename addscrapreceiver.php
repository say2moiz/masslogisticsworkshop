<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Scrap Receiver</title>
    <script src="Scripts/jquery-2.0.1.min.js"></script>
    <script src="Scripts/jquery.btechco.excelexport.js"></script>
    <script src="Scripts/jquery.base64.js"></script>
    <script src="parts/datasource.js"></script>
    <script src="base/base.js"></script>
    <script src="Scripts/keyrestrict.js"></script>
</head>
<?php
include "navigationbar.php";
?>
<body>
<?php include "header.php";?>
<div id="containerOuter">
    <div id="containerInner">
        <form onsubmit="return false" id="addForm">
            <div class="form clearfix">
                <div class="formHead">Add Scrap Receiver<span onclick="window.location='viewreceivers.php'">View</span></div>
                <div class="formRows">
                    <div class="row">
                        <span class="stuNameHead">Enter Scrap Receiver Name</span>
                        <input type="text" class="stuNameVal" id="scrapreceiver" placeholder="Enter name here..."
                        onKeyPress="return nameonly(this, event)">
                    </div>
                </div>
                <div class="formFoot clearfix">
                    <input type="submit" name="submit" value="Submit" id="submit">
                    <input type="reset" value="Reset" id="reset"title="Click to reset the form">
                    <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                </div>
            </div>
        </form>
        <?php
        if(isset($_GET['scrapreceiverid']))
        {
            $scrapreceiverid = $_GET['scrapreceiverid'];
            $qry = "select * from return1 where idReturn = $scrapreceiverid";
            $result = mysql_query($qry) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            $scrapreceivername = $row['name'];
            ?>
            <script> $('#addForm').hide(); </script>
            <form method="post">
                <div class="form clearfix">
                    <div class="formHead">Edit Scrap Receiver Form<span onclick="window.location='viewreceivers.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Scrap Receiver Name</span>
                            <input type="text" class="stuNameVal" id="scrapreceiver" name="scrapreceiver"
                                   onKeyPress="return nameonly(this, event)" value="<?php if(isset($_GET['scrapreceiverid'])){echo $scrapreceivername;}?>">
                        </div>
                    </div>
                    <div class="formFoot clearfix">
                        <input type="submit" name="submitEdit" value="Submit" id="submit">
                        <input type="reset" value="Cancel" onclick="window.location='viewreceivers.php'">
                        <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                    </div>
                </div>
            </form>
            <?php
            if(isset($_POST['submitEdit']))
            {
                $edit_scrapreceivername = $_POST['scrapreceiver'];
                if($edit_scrapreceivername != $scrapreceivername)
                {
                    $qry = "update return1 set name = '$edit_scrapreceivername' where idReturn = '$scrapreceiverid'";
                    mysql_query($qry) or die(mysql_error());
                    header('location:viewreceivers.php');
                }
                else
                {
                    ?><script>alert('Please edit some thing or click cancel to go back.')</script><?php
                }
            }
        }
        ?>
    </div>
</div>
<div class="responseMsg clearfix" id="responseMsg" style="display: none;">
    <!--<img src="images/success.png" width="20" id="addResponseImg">
        <span class="msg" id="msg"></span>-->
</div>

<script>
    var scrapreceivername;
    $('#submit').click(function(){
        if($.trim($('#scrapreceiver').val())!='')
        {
            $('#scrapreceiver').css('border','');
            scrapreceivername=$.trim($('#scrapreceiver').val());
            addscrapreceiver();
        }
        else
        {
            validateAndShowInvalid();
        }
    });
    function validateAndShowInvalid()
    {
        if($.trim($('#scrapreceiver').val())=='')
        {
            $('#scrapreceiver').css('border','1px solid red');
            $('#scrapreceiver').attr('title','Part Name cannot be empty');
        }
    }
    function addscrapreceiver()
    {
        var httpfeed = getHttpFeedURL('addscrapreceiver');
        httpfeed = setHttpParameter(httpfeed, 'scrapreceivername',encodeURIComponent(scrapreceivername));
        initializeHttpRequest(httpfeed, onSuccessAddScrapReceiver, onFailureAddScrapReceiver);
    }
    function onSuccessAddScrapReceiver(value)
    {
        // var obj = eval ("(" + value + ")");
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#scrapreceiver').val('');
            $('#responseMsg').html('');
            $('#responseMsg').css('color','green');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                               id="msg">Thanks, your record has been added successfully into the system</span>');
            $('#responseMsg').show();
            setTimeout(function(){
                $('#addResponseImg').css('visibility','visible');
            },300);
            setTimeout(function(){
                $('#responseMsg').hide();
            },10000);
        }
        else
        {
            $('#responseMsg').html('');
            $('#responseMsg').css('color','red');
            $('#issuer').css('border','1px solid red');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden;" ' +
                'src="images/failure.png "width="20"><span id="msg">'+json['DetailedStatus']+'</span>');
            $('#responseMsg').show();
            setTimeout(function(){
                $('#addResponseImg').css('visibility','visible');
            },300);
            setTimeout(function(){
                $('#responseMsg').hide();
            },10000);
        }
    }
    function onFailureAddScrapReceiver()
    {

    }
    $('#scrapreceiver').keyup(function(){
        $('#scrapreceiver').css('border','');
    });
    $('#reset').click(function(){
        $('#scrapreceiver').val('');
        $('#scrapreceiver').css('border','');
        $('#scrapreceiver').css('background','#fff');
    });
    $('#refresh').click(function(){
        window.location.reload();
    });

</script>
<?php include "footer.php";?>
</body>
</html>