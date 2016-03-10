<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Rack In Store</title>
        <script src="Scripts/jquery-1.11.1.js"></script>
        <script src="Scripts/jquery-1.11.1.min.js"></script>
        <script src="Scripts/jquery.btechco.excelexport.js"></script>
        <script src="Scripts/jquery.base64.js"></script>
        <script src="parts/datasource.js"></script>
        <script src="base/base.js"></script>
        <script src="Scripts/keyrestrict.js"></script>
    </head>
    <?php
    include "header.php";
    include "navigationbar.php";
    $userid='';
    $username='';
    if (isset($_SESSION['userid']) && isset($_SESSION['username']))
    {
        $userid=$_SESSION['userid'];
        $username=$_SESSION['username'];
    }
    ?>
    <body>

    <div id="containerOuter">
        <div id="containerInner">
            <form onsubmit="return false" id="addForm">
                <div class="form clearfix">
                    <div class="formHead">Add Rack In Store Form<span onclick="window.location='viewracks.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Rack ID</span>
                            <input type="text" class="stuNameVal" id="rackid" placeholder="Enter rack id here..." autocomplete="off">
                        </div>
                        <div class="row">
                            <span class="stuNameHead">Enter Rack Name</span>
                            <input type="text" class="stuNameVal" id="rackdescription" placeholder="Enter rack description here...">
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
            if(isset($_GET['rackid']))
            {
                $rackid = $_GET['rackid'];
                $qry = "select * from store where idStore = $rackid";
                $result = mysql_query($qry) or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $rackname = $row['rackDescription'];
                $rackiduser = $row['rackId'];
                ?>
                <script> $('#addForm').hide(); </script>
                <form method="post">
                    <div class="form clearfix">
                        <div class="formHead">Edit Rack Form<span onclick="window.location='viewracks.php'">View</span></div>
                        <div class="formRows">
                            <div class="row">
                                <span class="stuNameHead">Enter Rack Id</span>
                                <input type="text" class="stuNameVal" id="rack" name="rackId" value="<?php if(isset($_GET['rackid'])){echo $rackiduser;}?>">
                            </div>
                            <div class="row">
                                <span class="stuNameHead">Enter Rack Name</span>
                                <input type="text" class="stuNameVal" name="rackName" value="<?php if(isset($_GET['rackid'])){echo $rackname;}?>">
                            </div>
                        </div>
                        <div class="formFoot clearfix">
                            <input type="submit" name="submitEdit" value="Submit" id="submit">
                            <input type="reset" value="Cancel" onclick="window.location='viewracks.php'">
                            <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submitEdit']))
                {
                    $edit_rackname = $_POST['rackName'];
                    $edit_rackiduser = $_POST['rackId'];
                    if($edit_rackname != $rackname || $edit_rackiduser != $rackiduser)
                    {
                        $qry="select * from store where rackDescription = '$edit_rackname'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $numOfRows=mysql_num_rows($result);
                        if($numOfRows==0)
                        {

                            $qry = "update store set rackDescription = '$edit_rackname', rackId = '$edit_rackiduser' where idStore = '$rackid'";
                            mysql_query($qry) or die(mysql_error());
                            header('location:viewracks.php');
                        }
                        else if($edit_rackiduser != $rackiduser)
                        {
                            $qry = "update store set rackId = '$edit_rackiduser' where idStore = '$rackid'";
                            mysql_query($qry) or die(mysql_error());
                            header('location:viewracks.php');
                        }
                        else
                        {
                            ?><script>alert('Similar rack already exist');</script><?php
                        }
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
            var rackid;
            var rackdescription;
            var userid='<?php echo $userid;?>';
            $('#submit').click(function(){
                if($.trim($('#rackid').val())!='' && $.trim($('#rackdescription').val())!='')
                {
                    rackid=$.trim($('#rackid').val());
                    rackdescription=$.trim($('#rackdescription').val());
                    addrack();
                }
                else
                {
                    validateAndShowInvalid();
                    $('#responseMsg').css('color','red');
                    $('#rackdescription').css('border','1px solid red');
                    $('#rackid').css('border','1px solid red');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden;" ' +
                        'src="images/failure.png "width="20"><span id="msg">Required fields cannot be empty.</span>');
                    $('#responseMsg').show();
                    setTimeout(function(){
                        $('#addResponseImg').css('visibility','visible');
                    },300);
                    setTimeout(function(){
                        $('#responseMsg').hide();
                    },10000);
                }
            });
            function validateAndShowInvalid()
            {
                if($.trim($('#rackid').val())=='')
                {
                    $('#rackid').css('border','1px solid red');
                    $('#rackid').attr('title','Rack id cannot be empty');
                }
                if($.trim($('#rackdescription').val())=='')
                {
                    $('#rackdescription').css('border','1px solid red');
                    $('#rackdescription').attr('title','Rack description cannot be empty');
                }
            }
            function addrack()
            {
                var httpfeed = getHttpFeedURL('addrackinstore');
                httpfeed = setHttpParameter(httpfeed, 'rackid',encodeURIComponent(rackid));
                httpfeed = setHttpParameter(httpfeed, 'rackdescription',encodeURIComponent(rackdescription));
                httpfeed = setHttpParameter(httpfeed, 'userid',encodeURIComponent(userid));
                initializeHttpRequest(httpfeed, onSuccessAddRack, onFailureAddRack);
            }
            function onSuccessAddRack(value)
            {
                // var obj = eval ("(" + value + ")");
                var json = JSON.parse(value);
                if(json['Status']=="true")
                {
                    $('#rackdescription').val('');
                    $('#rackdescription').css('border','');
                    $('#rackdescription').css('background','#fff');

                    $('#rackid').val('');
                    $('#rackid').css('border','');
                    $('#rackid').css('background','#fff');

                    $('#responseMsg').html('');
                    $('#responseMsg').css('color','green');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                               id="msg">Thanks, your record has been added successfully into the system.</span>');
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
                    $('#rackdescription').css('border','1px solid red');
                    $('#rackid').css('border','1px solid red');
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
            function onFailureAddRack()
            {

            }
            $('#rackdescription').keyup(function(){
                $('#rackdescription').css('border','');
            });
            $('#rackid').keyup(function(){
                $('#rackid').css('border','');
            });
            $('#reset').click(function(){
                $('#rackdescription').val('');
                $('#rackdescription').css('border','');
                $('#rackdescription').css('background','#fff');

                $('#rackid').val('');
                $('#rackid').css('border','');
                $('#rackid').css('background','#fff');
            });
            $('#refresh').click(function(){
                window.location.reload();
            });

        </script>
    <?php include "footer.php";?>
    </body>
</html>



