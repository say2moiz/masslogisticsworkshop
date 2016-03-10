<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Return</title>
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
        <form onsubmit="return false">
            <div class="form clearfix">
                <div class="formHead">Return Form</div>
                <div class="row">
                    <span class="stuNameHead">Enter Tracking ID</span>
                    <input type="text" class="stuNameVal" id="trackingid" autocomplete="off" placeholder="Tracking id here...">
                </div>
                <div class="row">
                    <span class="stuNameHead">Select your name</span>
                    <?php
                    $name='';
                    $returnid='';
                    $qry="select idReturn,name from return1";
                    $result=mysql_query($qry);
                    $returndd='';
                    ?>
                    <select name="part" id="receiver">
                        <option value='-1'>Select your Name</option>
                        <?php
                        while($row=mysql_fetch_array($result))
                        {
                            $name=$row['name'];
                            $returnid=$row['idReturn'];
                            ?>
                            <option  value='<?php echo $returnid ?>'><?php echo $name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span class="stuNameHead">Returned By</span>
                    <input type="text" class="stuNameVal" id="returnedby" placeholder="Enter name here...">
                </div>
                <div class="row">
                    <span class="stuNameHead">Remarks</span>
                    <input type="text" class="stuNameVal" id="remarks" placeholder="Enter remarks here...">
                </div>
                <div class="row">
                    <span class="stuNameHead">Date</span>
                    <input type="date" class="stuNameVal" id="date">
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
    </div>
</div>
<div class="responseMsg clearfix" id="responseMsg" style="display: none;">
    <!--<img src="images/success.png" width="20" id="addResponseImg">
        <span class="msg" id="msg"></span>-->
</div>
<div class="fluidReturnConfirm" style="display: none;">
    <table>
        <tr>
            <th>Part Name</th>
            <th>Brand Name</th>
            <th>Issued By</th>
            <th>Issue Remarks</th>
            <th>Date Issued</th>
            <th>Issued To</th>
            <th>Tracking ID</th>
        </tr>
        <tr id="tabledatarow">

        </tr>
    </table>
</div>
<script>

var trackingid;
var returnid;
var returnedby;
var userid='<?php echo $userid?>';
var remarks;
var userdatereturn;
function checktrackingid()
{
    var httpfeed = getHttpFeedURL('checktrackingid');
    httpfeed = setHttpParameter(httpfeed, 'trackingid',encodeURIComponent(trackingid));
    initializeHttpRequest(httpfeed, onSuccessChkTrackingId, onFailureChkTrackingId);
}
function onSuccessChkTrackingId(value)
{
    var json = JSON.parse(value);
    if(json['Status']=="true")
    {
        $('#tabledatarow').html('<td>'+json['partname']+'</td><td>'+json['brandname']+'</td><td>'+json['issuername']+'</td><td>'
            +json['remarks']+'</td><td>'+json['dateissued']+'</td>' +
            '<td>'+json['issuedto']+'</td><td>'+json['trackingid']+'</td>');
        if(json['returnstatus']==1)
        {
            $('#submit').attr('disabled','disabled');
            $('#responseMsg').css('color','red');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden;" src="images/failure.png" width="20"><span                                      id="msg">You have already returned this part previously. You donot need to do it again.</span>');
            $('#tabledatarow').css('background','#ffd6c6');
            $('#tabledatarow').attr('title','You have already returned this item. You can return anything else but not this one again.')
        }
        else
        {
            $('#tabledatarow').css('background','#fff');
            $('#submit').removeAttr('disabled','disabled');
            $('#responseMsg').css('color','green');
            $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden;" src="images/success.png" width="20"><span                                    id="msg">Record against the tracking Id you entered is given below. If you are sure you want to return this part, so please fill the form' +
            ' completely and then click submit.</span>');
            $('#tabledatarow').attr('title','')
        }
        $('#responseMsg').show();
        $('.fluidReturnConfirm').show();
        setTimeout(function(){
            $('#addResponseImg').css('visibility','visible');
        },300);
    }
    else
    {
        $('#submit').attr('disabled','disabled');
        $('#responseMsg').hide();
        $('.fluidReturnConfirm').hide();

    }
}
function onFailureChkTrackingId()
{

}
$('#trackingid').keyup(function(){
    $('#trackingid').css('border','');
    trackingid= $.trim($('#trackingid').val());
    if(trackingid!='')
    {
        checktrackingid();
    }
});



function updatetrackingid()
{
    var httpfeed = getHttpFeedURL('updatetrackingid');
    httpfeed = setHttpParameter(httpfeed, 'trackingid',encodeURIComponent(trackingid));
    httpfeed = setHttpParameter(httpfeed, 'returnid',encodeURIComponent(returnid));
    httpfeed = setHttpParameter(httpfeed, 'returnedby',encodeURIComponent(returnedby));
    httpfeed = setHttpParameter(httpfeed, 'userid',encodeURIComponent(userid));
    httpfeed = setHttpParameter(httpfeed, 'userdatereturn',encodeURIComponent(userdatereturn));
    httpfeed = setHttpParameter(httpfeed, 'remarks',encodeURIComponent(remarks));
    initializeHttpRequest(httpfeed, onSuccessUpdateTrackingId, onFailureUpdateTrackingId);
}
function onSuccessUpdateTrackingId(value)
{
    var json = JSON.parse(value);
    if(json['Status']=="true")
    {
        $('#receiver').val('-1');
        $('#returnedby').val('');
        $('#date').val('');
        $('#remarks').val('');
        $('#trackingid').val('');
        $('#responseMsg').css('color','green');
        $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                    id="msg">Thanks, your record has been updated successfully into the system. Refer to the Scrap report for verification.</span>');
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
        $('#responseMsg').css('color','red');
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
function onFailureUpdateTrackingId()
{

}

$('#submit').click(function(){
    trackingid= $.trim($('#trackingid').val());
    returnid= $.trim($('#receiver').val());
    returnedby=$.trim($('#returnedby').val());
    userid='<?php echo $userid;?>';
    userdatereturn=$('#date').val();
    remarks= $.trim($('#remarks').val());
    if(trackingid=='')
    {
        $('#trackingid').css('border','1px solid red');
    }
    if(returnid=='' || returnid==-1)
    {
        $('#receiver').css('border','1px solid red');
    }
    if(returnedby=='')
    {
        $('#returnedby').css('border','1px solid red');
    }
    if(userdatereturn=='')
    {
        $('#date').css('border','1px solid red');
    }
    if(remarks=='')
    {
        $('#remarks').css('border','1px solid red');
    }
    if(trackingid!='' && returnid!='' && returnedby!='' && userid!='' && userdatereturn!='' && remarks!='')
    {
        /*$('#submit').removeAttr('disabled');
        $('#reset').removeAttr('disabled');*/
        $('#responseMsg').hide();
        $('.fluidReturnConfirm').hide();
        updatetrackingid();
    }
    else
    {
        $('#responseMsg').css('color','red');
        $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden;" ' +
            'src="images/failure.png "width="20"><span id="msg">Required fields cannot be empty or unselected.</span>');
        $('#responseMsg').show();
        setTimeout(function(){
            $('#addResponseImg').css('visibility','visible');
        },300);
        setTimeout(function(){
            $('#responseMsg').hide();
        },10000);
    }
});
$('#receiver').change(function(){
    $('#receiver').css('border','');
});
$('#returnedby').keyup(function(){
    $('#returnedby').css('border','');
});
$('#date').change(function(){
    $('#date').css('border','');
});
$('#remarks').keyup(function(){
    $('#remarks').css('border','');
});


$('#reset').click(function(){
    $('#receiver').css('border','');
    $('#returnedby').css('border','');
    $('#date').css('border','');
    $('#remarks').css('border','');
    $('#trackingid').css('border','');

    $('#receiver').val('-1');
    $('#returnedby').val('');
    $('#date').val('');
    $('#remarks').val('');
    $('#trackingid').val('');
    $('.fluidReturnConfirm').hide();
    $('#tabledatarow').attr('title','');
    $('#responseMsg').hide();
    $('#submit').removeAttr('disabled');
});
$('#refresh').click(function(){
    window.location.reload();
});
</script>
<?php include "footer.php";?>
</body>
</html>



