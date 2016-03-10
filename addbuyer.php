<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Buyer</title>
    <script src="Scripts/jquery-1.11.1.js"></script>
    <script src="Scripts/jquery-1.11.1.min.js"></script>
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
                <div class="formHead">Add Buyer Form<span onclick="window.location='viewbuyers.php'">View</span></div>
                <div class="formRows">
                    <div class="row">
                        <span class="stuNameHead">Enter Buyer Name</span>
                        <input type="text" class="stuNameVal" id="buyer" placeholder="Enter buyer name here..."
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
        if(isset($_GET['buyerid']))
        {
            $buyerid = $_GET['buyerid'];
            $qry = "select * from buyer where idBuyer = $buyerid";
            $result = mysql_query($qry) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            $buyername = $row['buyerName'];
            ?>
            <script> $('#addForm').hide(); </script>
            <form method="post">
                <div class="form clearfix">
                    <div class="formHead">Edit Buyer Form<span onclick="window.location='viewbuyers.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Buyer Name</span>
                            <input type="text" class="stuNameVal" id="buyer" name="buyerName"
                                   onKeyPress="return nameonly(this, event)" value="<?php if(isset($_GET['buyerid'])){echo $buyername;}?>">
                        </div>
                    </div>
                    <div class="formFoot clearfix">
                        <input type="submit" name="submitEdit" value="Submit" id="submit">
                        <input type="reset" value="Cancel" onclick="window.location='viewbuyers.php'">
                        <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                    </div>
                </div>
            </form>
        <?php
            if(isset($_POST['submitEdit']))
            {
                $edit_buyername = $_POST['buyerName'];
                if($edit_buyername != $buyername)
                {
                    $qry = "update buyer set buyerName = '$edit_buyername' where idBuyer = '$buyerid'";
                    mysql_query($qry) or die(mysql_error());
                    header('location:viewbuyers.php');
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
<div class="responseMsg clearfix" id="responseMsg" style="display: none;"></div>
<script>
    var buyername;
    $('#submit').click(function(){
        if($.trim($('#buyer').val())!='')
        {
            $('#buyer').css('border','');
            buyername=$.trim($('#buyer').val());
            addbuyer();
        }
        else
        {
            validateAndShowInvalid();
        }
    });
    function validateAndShowInvalid()
    {
        if($.trim($('#buyer').val())=='')
        {
            $('#buyer').css('border','1px solid red');
            $('#buyer').attr('title','Buyer Name cannot be empty');
        }
    }
    function addbuyer()
    {
        var httpfeed = getHttpFeedURL('addbuyer');
        httpfeed = setHttpParameter(httpfeed, 'buyername',encodeURIComponent(buyername));
        initializeHttpRequest(httpfeed, onSuccessAddBuyer, onFailureAddBuyer);
    }
    function onSuccessAddBuyer(value)
    {
        // var obj = eval ("(" + value + ")");
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#buyer').val('');
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
            $('#buyer').css('border','1px solid red');
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
    function onFailureAddBuyer()
    {

    }
    $('#buyer').keyup(function(){
        $('#buyer').css('border','');
    });
    $('#reset').click(function(){
        $('#buyer').val('');
        $('#buyer').css('border','');
        $('#buyer').css('background','#fff');
    });
    $('#refresh').click(function(){
        window.location.reload();
    });

</script>
<?php include "footer.php";?>
</body>
</html>



