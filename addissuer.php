<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Stock Issuer</title>
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
                <div class="formHead">Add Stock Issuer<span onclick="window.location='viewissuers.php'">View</span></div>
                <div class="formRows">
                    <div class="row">
                        <span class="stuNameHead">Enter Stock Issuer Name</span>
                        <input type="text" class="stuNameVal" id="issuer" placeholder="Enter name here..."
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
        if(isset($_GET['issuerid']))
        {
            $issuerid = $_GET['issuerid'];
            $qry = "select * from issue where idIssue = $issuerid";
            $result = mysql_query($qry) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            $issuername = $row['name'];
            ?>
            <script> $('#addForm').hide(); </script>
            <form method="post">
                <div class="form clearfix">
                    <div class="formHead">Edit Issuer Form<span onclick="window.location='viewissuers.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Issuer Name</span>
                            <input type="text" class="stuNameVal" id="buyer" name="issuerName"
                                   onKeyPress="return nameonly(this, event)" value="<?php if(isset($_GET['issuerid'])){echo $issuername;}?>">
                        </div>
                    </div>
                    <div class="formFoot clearfix">
                        <input type="submit" name="submitEdit" value="Submit" id="submit">
                        <input type="reset" value="Cancel" onclick="window.location='viewissuers.php'">
                        <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                    </div>
                </div>
            </form>
            <?php
            if(isset($_POST['submitEdit']))
            {
                $edit_issuername = $_POST['issuerName'];
                if($edit_issuername != $issuername)
                {
                    $qry = "update issue set name = '$edit_issuername' where idIssue = '$issuerid'";
                    mysql_query($qry) or die(mysql_error());
                    header('location:viewissuers.php');
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
    var issuername;
    $('#submit').click(function(){
        if($.trim($('#issuer').val())!='')
        {
            $('#issuer').css('border','');
            issuername=$.trim($('#issuer').val());
            addissuer();
        }
        else
        {
            validateAndShowInvalid();
        }
    });
    function validateAndShowInvalid()
    {
        if($.trim($('#issuer').val())=='')
        {
            $('#issuer').css('border','1px solid red');
            $('#issuer').attr('title','Part Name cannot be empty');
        }
    }
    function addissuer()
    {
        var httpfeed = getHttpFeedURL('addissuer');
        httpfeed = setHttpParameter(httpfeed, 'issuername',encodeURIComponent(issuername));
        initializeHttpRequest(httpfeed, onSuccessAddIssuer, onFailureAddIssuer);
    }
    function onSuccessAddIssuer(value)
    {
        // var obj = eval ("(" + value + ")");
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#issuer').val('');
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
    function onFailureAddIssuer()
    {

    }
    $('#issuer').keyup(function(){
        $('#issuer').css('border','');
    });
    $('#reset').click(function(){
        $('#issuer').val('');
        $('#issuer').css('border','');
        $('#issuer').css('background','#fff');
    });
    $('#refresh').click(function(){
        window.location.reload();
    });

</script>
<?php include "footer.php";?>
</body>
</html>