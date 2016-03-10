<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Make New User</title>
    <script src="Scripts/jquery-1.11.1.js"></script>
    <script src="Scripts/jquery-1.11.1.min.js"></script>
    <script src="Scripts/jquery.btechco.excelexport.js"></script>
    <script src="Scripts/jquery.base64.js"></script>
    <script src="parts/datasource.js"></script>
    <script src="base/base.js"></script>
    <script src="Scripts/keyrestrict.js"></script>
    <style>
        .securityPlan{width: 450px !important;}
    </style>
</head>
<?php
include "navigationbar.php";
?>
<body>
<?php include "header.php";?>
<div id="containerOuter">
    <div id="containerInner">
        <form onsubmit="return false">
            <div class="form clearfix">
                <div class="formHead">Make New User</div>
                <div class="formRows">
                    <div class="row">
                        <span class="stuNameHead">Enter User Name</span>
                        <input type="text" class="stuNameVal" id="username"  autocomplete="off" placeholder="Enter user name here..."
                        onKeyPress="return nameonly(this, event)">
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Enter Password</span>
                        <input type="password" class="stuNameVal" id="password" placeholder="Enter password here...">
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Enter Email</span>
                        <input type="text" class="stuNameVal" id="email" placeholder="Enter email here..."
                        onKeyPress="return emailonly(this, event)">
                    </div>
                    <div class="row trackableRow securityPlan" id="trackableRow" title="Select security plan for the user.">
                        <span class="stuNameHead">Select Security Plan:</span>
                    <span>
                        Restricted
                        <input type="radio" id="trackable" name="trackable" value='1' required
                            <?php /*if(isset($_POST['trackable'])){if($_POST['trackable']==1){echo "checked='checked'";}}*/ ?>/>
                    </span>
                    <span>
                        General
                        <input type="radio" id="trackable1" name="trackable" value='10' required
                            <?php /*if(isset($_POST['trackable'])){if($_POST['trackable']==0){echo "checked='checked'";}}*/ ?>/>
                    </span>
                    <span>
                        Admin
                        <input type="radio" id="trackable2" name="trackable" value='100' required
                            <?php /*if(isset($_POST['trackable'])){if($_POST['trackable']==0){echo "checked='checked'";}}*/ ?>/>
                    </span>
                    </div>
                </div>
                <div class="formFoot clearfix">
                    <input type="submit" name="submit" value="Submit" id="submit">
                    <input type="reset" value="Reset" id="reset"title="Click to reset the form">
                    <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="responseMsg clearfix" id="responseMsg" style="display: none;">
    <!--<img src="images/success.png" width="20" id="addResponseImg">
        <span class="msg" id="msg"></span>-->
</div>

<script>
    var username;
    var email;
    var password;
    /*var accesslevel;*/
    var securityPlan;
    $('#submit').click(function(){
        if($.trim($('#username').val())!='' && $.trim($('#password').val())!='' && $.trim($('#email').val())!=''/* && $.trim($('#accesslevel').val())!=''*/)
        {
            username=$.trim($('#username').val());
            password=$.trim($('#password').val());
            email=$.trim($('#email').val());
            /*accesslevel=$.trim($('#accesslevel').val());*/
            securityPlan=$.trim($("input[name=trackable]:checked").val());
            adduser();
        }
        else
        {
            validateAndShowInvalid();
        }
    });
    function validateAndShowInvalid()
    {
        if($.trim($('#username').val())=='')
        {
            $('#username').css('border','1px solid red');
            $('#username').attr('title','User Name cannot be empty');
        }
        if($.trim($('#password').val())=='')
        {
            $('#password').css('border','1px solid red');
            $('#password').attr('title','Password cannot be empty');
        }
        if($.trim($('#email').val())=='')
        {
            $('#email').css('border','1px solid red');
            $('#email').attr('title','Email cannot be empty');
        }
        /*if($.trim($('#accesslevel').val())=='')
        {
            $('#accesslevel').css('border','1px solid red');
            $('#accesslevel').attr('title','Access level Name cannot be empty, it must be a number');
        }*/
    }
    function adduser()
    {
        var httpfeed = getHttpFeedURL('adduser');
        httpfeed = setHttpParameter(httpfeed, 'username',encodeURIComponent(username));
        httpfeed = setHttpParameter(httpfeed, 'password',encodeURIComponent(password));
        httpfeed = setHttpParameter(httpfeed, 'email',encodeURIComponent(email));
        httpfeed = setHttpParameter(httpfeed, 'securityplan',encodeURIComponent(securityPlan));
        /*httpfeed = setHttpParameter(httpfeed, 'accesslevel',encodeURIComponent(accesslevel));*/
        initializeHttpRequest(httpfeed, onSuccessAddUser, onFailureAddUser);
    }
    function onSuccessAddUser(value)
    {
        // var obj = eval ("(" + value + ")");
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#reset').trigger('click');
            $('#responseMsg').css('color','green');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                id="msg">Thanks, your record has been added successfully into the system</span>');
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
            $('#msg').html('');
            $('#responseMsg').html('');
            $('#responseMsg').css('color','red');
            $('#username').css('border','1px solid red');
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
    function onFailureAddUser()
    {

    }


    function getuserdetails()
    {
        var httpfeed = getHttpFeedURL('getuserdetails');
        httpfeed = setHttpParameter(httpfeed, 'username',encodeURIComponent(username));
        initializeHttpRequest(httpfeed, onSuccessGetUser, onFailureGetUser);
    }
    function onSuccessGetUser(value)
    {
        // var obj = eval ("(" + value + ")");
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            //$('#reset').trigger('click');
            var username=json['username'];
            var dateusercreated=json['dateusercreated'];
            var accesslevel=json['accesslevel'];
            var userid=json['userid'];

            $('#username').val(username);
            $('#password').val('Hidden for privacy');
            $('#email').val('Hidden for privacy');
            $('#accesslevel').val(accesslevel);

            $('#username').css('background','#C5FFC7');
            $('#password').css('background','#C5FFC7');
            $('#email').css('background','#C5FFC7');
            $('#accesslevel').css('background','#C5FFC7');

            $('#submit').attr('disabled','disabled');
            //$('#reset').attr('disabled','disabled');
            $('#responseMsg').html('');
            $('#responseMsg').css('color','green');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                id="msg">Search Result: User already exist in the system, you cannot add the similar part again.</span>');
            $('#responseMsg').show();
            setTimeout(function(){
                $('#addResponseImg').css('visibility','visible');
            },300);
        }
        else
        {
            $('#password').val('');
            $('#email').val('');
            $('#accesslevel').val('');
            $('#password').css('background','#fff');
            $('#email').css('background','#fff');
            $('#accesslevel').css('background','#fff');
            $('#submit').removeAttr('disabled');
            $('#responseMsg').html('');
        }

    }
    function onFailureGetUser()
    {

    }


    $('#username').keyup(function(){
        $('#username').css('border','');
        $('#username').css('background','#fff');
        username=$('#username').val();
        getuserdetails();
    });
    $('#reset').click(function(){
        $('#username').val('');
        $('#password').val('');
        $('#email').val('');
        $('#accesslevel').val('');

        $('#username').css('border','');
        $('#password').css('border','');
        $('#email').css('border','');
        $('#accesslevel').css('border','');

        $('#username').css('background','#fff');
        $('#password').css('background','#fff');
        $('#email').css('background','#fff');
        $('#accesslevel').css('background','#fff');

        $('#responseMsg').html('');
        $('#submit').removeAttr('disabled');
    });
    $('#refresh').click(function(){
        window.location.reload();
    });

</script>
<?php include "footer.php";?>
</body>
</html>