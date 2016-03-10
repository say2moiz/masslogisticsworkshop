<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Seller</title>
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
                    <div class="formHead">Add Seller Form<span onclick="window.location='viewsellers.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Seller Name</span>
                            <input type="text" class="stuNameVal" id="seller" placeholder="Enter seller name here..."
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
            if(isset($_GET['sellerid']))
            {
                $sellerid = $_GET['sellerid'];
                $qry = "select * from seller where idSeller = $sellerid";
                $result = mysql_query($qry) or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $sellername = $row['sellerName'];
                ?>
                <script> $('#addForm').hide(); </script>
                <form method="post">
                    <div class="form clearfix">
                        <div class="formHead">Edit Seller Form<span onclick="window.location='viewsellers.php'">View</span></div>
                        <div class="formRows">
                            <div class="row">
                                <span class="stuNameHead">Enter Seller Name</span>
                                <input type="text" class="stuNameVal" id="buyer" name="sellerName"
                                       onKeyPress="return nameonly(this, event)" value="<?php if(isset($_GET['sellerid'])){echo $sellername;}?>">
                            </div>
                        </div>
                        <div class="formFoot clearfix">
                            <input type="submit" name="submitEdit" value="Submit" id="submit">
                            <input type="reset" value="Cancel" onclick="window.location='viewsellers.php'">
                            <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submitEdit']))
                {
                    $edit_sellername = $_POST['sellerName'];
                    if($edit_sellername != $sellername)
                    {
                        $qry = "update seller set sellerName = '$edit_sellername' where idSeller = '$sellerid'";
                        mysql_query($qry) or die(mysql_error());
                        header('location:viewsellers.php');
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
            var sellername;
            $('#submit').click(function(){
                if($.trim($('#seller').val())!='')
                {
                    $('#seller').css('border','');
                    sellername=$.trim($('#seller').val());
                    addseller();
                }
                else
                {
                    validateAndShowInvalid();
                }
            });
            function validateAndShowInvalid()
            {
                if($.trim($('#seller').val())=='')
                {
                    $('#seller').css('border','1px solid red');
                    $('#seller').attr('title','Part Name cannot be empty');
                }
            }
            function addseller()
            {
                var httpfeed = getHttpFeedURL('addseller');
                httpfeed = setHttpParameter(httpfeed, 'sellername',encodeURIComponent(sellername));
                initializeHttpRequest(httpfeed, onSuccessAddSeller, onFailureAddSeller);
            }
            function onSuccessAddSeller(value)
            {
                // var obj = eval ("(" + value + ")");
                var json = JSON.parse(value);
                if(json['Status']=="true")
                {
                    $('#seller').val('');
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
                    $('#seller').css('border','1px solid red');
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
            function onFailureAddSeller()
            {

            }
            $('#seller').keyup(function(){
                $('#seller').css('border','');
            });
            $('#reset').click(function(){
                $('#seller').val('');
                $('#seller').css('border','');
                $('#seller').css('background','#fff');
            });
            $('#refresh').click(function(){
                window.location.reload();
            });

        </script>
    <?php include "footer.php";?>
    </body>
</html>



