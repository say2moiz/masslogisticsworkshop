<?php
require_once('mysqlcon/mysql1.php');
session_start();
$_SESSION['login'] = false;
$preUrl='';
if(isset($_GET['url']))
{
    $preUrl=$_GET['url'];
    $search='/MassLogisticsWorkshop/';
    $preUrl=str_replace($search, '', $preUrl);/*remove /MassLogisticsWorkshop/ from the $preUrl*/
    $preUrl=str_replace("'", "", $preUrl);/*remove ' from the $preUrl, now we hava a proper url*/
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="Scripts/jquery-1.11.1.js"></script>
    <script src="Scripts/jquery-1.11.1.min.js"></script>
    <script src="Scripts/jquery.btechco.excelexport.js"></script>
    <script src="Scripts/jquery.base64.js"></script>
    <script src="parts/datasource.js"></script>
    <script src="base/base.js"></script>
    <script src="Scripts/keyrestrict.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <style>
        #loginBackGround{position:absolute; top:300px;left: -500px;}
        #loginBackGroundRotated{position:absolute; top:300px;left: 1200px;}
        .rotated{-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH;-ms-filter: "FlipH";}
    </style>
</head>
<?php include "header.php";?>
<body>
<div id="containerOuter">
    <div id="containerInner">
        <form method="post" id="loginform" onsubmit="return false;">
            <div class="form clearfix">
                <div class="formHead">Login Form</div>
                <div class="row">
                    <span class="stuNameHead">User Name</span>
                    <input type="text" class="stuNameVal" id="username" name="username" autocomplete="off" placeholder="Enter username here..." >
                </div>
                <div class="row">
                    <span class="stuNameHead">Password</span>
                    <input type="password" class="stuNameVal" id="password" name="password" autocomplete="off" placeholder="Enter Password here...">
                </div>
                <div class="formFoot clearfix" id="submitRow">
                    <input type="submit" name="submit" value="Submit" id="submit">
                    <input type="reset" value="Reset" id="reset" title="Click to reset the form">
                    <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                </div>
                <div id="msg" style="display: none;" class="popup clearfix">

                </div>
            </div>
        </form>
        <img src="images/truck.png" id="loginBackGround">
        <img src="images/truck.png" id="loginBackGroundRotated" class="rotated" style="display: none;">
    </div>
</div>
<div class="responseMsg clearfix" id="responseMsg" style="display: none;">
    <!--<img src="images/success.png" width="20" id="addResponseImg">
        <span class="msg" id="msg"></span>-->
</div>
<script>
        $("#loginBackGround").animate({left: "+=2000"}, 4500);
        setTimeout(function(){
            $("#loginBackGround").hide();
            $("#loginBackGroundRotated").show();
            $("#loginBackGroundRotated").animate({left: "-=850"}, 3000);
        },4500);

        $('#reset').click(function(){
            location.reload();
        });
        $('#refresh').click(function(){
            window.location="issuepage.php";
        });

        $('#username').keyup(function(){
            $('#username').css('border','');
            $('#responseMsg').hide();
        });
        $('#password').keyup(function(){
            $('#password').css('border','');
            $('#responseMsg').hide();
        });
        var username;
        var password;
        $('#submit').click(function(){
            if($.trim($('#username').val())=='' || $.trim($('#password').val())=='')
            {
                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">Alert!!! User Name or Password cannot be empty.</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                $('#username').css('border','1px solid red');
                $('#password').css('border','1px solid red');
                return false;
            }
            else
            {
                username= $.trim($('#username').val());
                password= $.trim($('#password').val());
                login();
            }
        });
        function login()
        {
            var httpfeed = getHttpFeedURL('login');
            httpfeed = setHttpParameter(httpfeed, 'username',encodeURIComponent(username));
            httpfeed = setHttpParameter(httpfeed, 'password',encodeURIComponent(password));
            initializeHttpRequest(httpfeed, onSuccessLogin, onFailureLogin);
        }
        function onSuccessLogin(value)
        {
            var json = JSON.parse(value);
            if(json['Status']=="true")
            {
                var preUrl="<?php echo $preUrl;?>";
                if(preUrl!='')
                {
                    window.location=preUrl;
                }
                else
                {
                    window.location="index.php";
                }
            }
            else
            {
                $('#responseMsg').css('color','red');
                $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/failure.png" width="20">' +
                    '<span id="msg">Alert!!! Wrong Credentials please try again. (H I N T : Check capslock)</span>');
                $('#responseMsg').show();
                setTimeout(function(){
                    $('#addResponseImg').css('visibility','visible');
                },300);
                setTimeout(function(){
                    $('#responseMsg').hide();
                },10000);
            }
        }
        function onFailureLogin()
        {

        }
</script>
<?php include "footer.php";?>
</body>
</html>



