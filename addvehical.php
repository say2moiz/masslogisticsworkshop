<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Vehical</title>
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
                    <div class="formHead">Add Vehical Form<span onclick="window.location='viewvehicals.php'">View</span></div>
                    <div class="formRows">
                        <div class="row">
                            <span class="stuNameHead">Enter Vehical Name</span>
                            <input type="text" class="stuNameVal" id="vehicalname" placeholder="Enter Vehical name here..."
                            onKeyPress="return nameonly(this, event)">
                        </div>
                        <div class="row">
                            <span class="stuNameHead">Enter Vehical Number</span>
                            <input type="text" class="stuNameVal" id="vehicalnumber" placeholder="Enter Vehical number here...">
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
            if(isset($_GET['vehicalid']))
            {
                $vehicalid = $_GET['vehicalid'];
                $qry = "select * from vehical where idVehical = $vehicalid";
                $result = mysql_query($qry) or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $vehicalname = $row['vehicalName'];
                $vehicalnumber = $row['vehicalNumber'];
                ?>
                <script> $('#addForm').hide(); </script>
                <form method="post">
                    <div class="form clearfix">
                        <div class="formHead">Edit Vehical Form<span onclick="window.location='viewvehicals.php'">View</span></div>
                        <div class="formRows">
                            <div class="row">
                                <span class="stuNameHead">Enter Vehical Number</span>
                                <input type="text" class="stuNameVal" id="vehical" name="vehicalNumber" value="<?php if(isset($_GET['vehicalid'])){echo $vehicalnumber;}?>">
                            </div>
                            <div class="row">
                                <span class="stuNameHead">Enter Vehicals Name</span>
                                <input type="text" class="stuNameVal" name="vehicalName" value="<?php if(isset($_GET['vehicalid'])){echo $vehicalname;}?>">
                            </div>
                        </div>
                        <div class="formFoot clearfix">
                            <input type="submit" name="submitEdit" value="Submit" id="submit">
                            <input type="reset" value="Cancel" onclick="window.location='viewvehicals.php'">
                            <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submitEdit']))
                {
                    $edit_vehicalname = $_POST['vehicalName'];
                    $edit_vehicalnumber = $_POST['vehicalNumber'];
                    if($edit_vehicalname != $vehicalname || $edit_vehicalnumber != $vehicalnumber)
                    {
                        $qry="select * from vehical where vehicalName = '$edit_vehicalname'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $numOfRows=mysql_num_rows($result);
                        if($numOfRows==0)
                        {
                            $qry = "update vehical set vehicalName = '$edit_vehicalname', vehicalNumber = '$edit_vehicalnumber' where idVehical = '$vehicalid'";
                            mysql_query($qry) or die(mysql_error());
                            header('location:viewvehicals.php');
                        }
                        else if($edit_vehicalnumber != $vehicalnumber)
                        {
                            $qry = "update vehical set vehicalNumber = '$edit_vehicalnumber' where idVehical = '$vehicalid'";
                            mysql_query($qry) or die(mysql_error());
                            header('location:viewvehicals.php');
                        }
                        else
                        {
                            ?><script>alert('Similar vehical already exist');</script><?php
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
            var vehicalname;
            var vehicalnumber;
            var userid='<?php echo $userid;?>';
            $('#submit').click(function(){
                if($.trim($('#vehicalname').val())!='' && $.trim($('#vehicalnumber').val())!='')
                {
                    $('#vehicalname').css('border','');
                    vehicalname=$.trim($('#vehicalname').val());
                    vehicalnumber=$.trim($('#vehicalnumber').val());
                    addvehical();
                }
                else
                {
                    validateAndShowInvalid();
                }
            });
            function validateAndShowInvalid()
            {
                if($.trim($('#vehicalname').val())=='')
                {
                    $('#vehicalname').css('border','1px solid red');
                    $('#vehicalname').attr('title','Vehical Name cannot be empty');
                }
                if($.trim($('#vehicalnumber').val())=='')
                {
                    $('#vehicalnumber').css('border','1px solid red');
                    $('#vehicalnumber').attr('title','Vehical Number cannot be empty');
                }
            }
            function addvehical()
            {
                var httpfeed = getHttpFeedURL('addvehical');
                httpfeed = setHttpParameter(httpfeed, 'vehicalname',encodeURIComponent(vehicalname));
                httpfeed = setHttpParameter(httpfeed, 'vehicalnumber',encodeURIComponent(vehicalnumber));
                httpfeed = setHttpParameter(httpfeed, 'userid',encodeURIComponent(userid));
                initializeHttpRequest(httpfeed, onSuccessAddVehical, onFailureAddVehical);
            }
            function onSuccessAddVehical(value)
            {
                // var obj = eval ("(" + value + ")");
                var json = JSON.parse(value);
                if(json['Status']=="true")
                {
                    $('#vehicalname').val('');
                    $('#vehicalnumber').val('');
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
                    $('#vehicalname').css('border','1px solid red');
                    $('#vehicalnumber').css('border','1px solid red');
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
            function onFailureAddVehical()
            {

            }
            $('#vehicalname').keyup(function(){
                $('#vehicalname').css('border','');
            });
            $('#vehicalnumber').keyup(function(){
                $('#vehicalnumber').css('border','');
            });
            $('#reset').click(function(){
                $('#vehicalname').val('');
                $('#vehicalname').css('border','');
                $('#vehicalname').css('background','#fff');

                $('#vehicalnumber').val('');
                $('#vehicalnumber').css('border','');
                $('#vehicalnumber').css('background','#fff');
            });
            $('#refresh').click(function(){
                window.location.reload();
            });

        </script>
    <?php include "footer.php";?>
    </body>
</html>



