<?php
require_once('checkLoginAndVerifyAccessPage.php');
require_once("header.php");
$reportname="Manage Privacy";
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
    <script src="parts/datasource.js"></script>
    <script src="base/base.js"></script>
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
                <?php
                $username = '';
                $userid = '';
                $qry = "select * from userauth where accessLevel!=1000";
                $result = mysql_query($qry) or die(mysql_error());
                $partdd = '';
                ?>
                <select name="user" id="userdd" onchange="this.form.submit();">
                    <option value='-1'>Select User</option>
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $username = $row['userName'];
                        $userid = $row['idUserAuth'];
                        if (isset($_GET['user'])) {
                            $userdd = $_GET['user'];
                        }
                        ?>
                        <option value='<?php echo $userid; ?>'<?php if (isset($_GET['user'])) {
                            if ($userid == $_GET['user']) echo 'selected="selected"';
                        } ?>>
                            <?php echo $username; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>
<?php
    $securityplan='';
    if(isset($_GET['part'])){ $partid=$_GET['part']; }

    $qry="select * from userauth where accessLevel!=1000";
    $result=mysql_query($qry) or die(mysql_error());
    $numofrows=mysql_num_rows($result);
    if($numofrows!=0)
    {
        ?>
        <table id="mytable" class="reportTable managePrivacy">
            <tr class="tableHeadRow">
                <th title="Part Name">User Name</th>
                <th title="Brand Name">Security Plan Emposed</th>
                <th title="Date Enterance">Date User Created</th>
            </tr>
            <?php
            while($row=mysql_fetch_array($result))
            {
                $id=$row['idUserAuth'];
                $date=date('d-m-Y',strtotime($row['dateUserCreated']));
                if($row['accessLevel']==1){$securityplan="Restricted";}
                else if($row['accessLevel']==10){$securityplan="General";}
                else if($row['accessLevel']==100){$securityplan="Admin";}
                ?>
                <tr class="tableDataRow">
                    <td class="userNameTd">
                        <span id="viewUserName<?php echo $id;?>" class="viewUserName">
                            <span id="viewModeUserName<?php echo $id;?>"><?php echo $row['userName'];?></span>
                            <img src="images/edit.png" width="20" title="Click to edit user name."
                            id="username_<?php echo $id;?>" onclick="editUserName(this.id);">
                        </span>
                        <span id="spanUserName<?php echo $id;?>" class="spanUserName" style="display: none;">
                            <input type="text" value="<?php echo $row['userName'];?>" id="inputUserName<?php echo $id;?>">
                            <input type="button" value="Done" id="doneuser_<?php echo $id;?>" onclick="doneEdit(this.id);">
                            <input type="button" value="Cancel" id="canceluser_<?php echo $id;?>" onclick="cancelEdit(this.id);">
                        </span>
                    </td>

                    <td class="securityPlanTd">
                        <span id="viewSecurityPlan<?php echo $id;?>">
                            <span id="viewModeSecurityPlan<?php echo $id;?>"><?php echo $securityplan;?></span>
                            <img src="images/edit.png" width="20" title="Click to change security plan for this user."
                            id="securityplan_<?php echo $id;?>" onclick="editSecurityPlan(this.id);">
                        </span>
                        <span id="spanSecurityPlan<?php echo $id;?>" style="display: none;">
                            <span id="radioButtonSpan<?php echo $id;?>">
                                <span>
                                    Restricted
                                    <input type="radio" id="trackable<?php echo $id;?>" name="trackable" value='1' required
                                        <?php if($row['accessLevel']==1){echo "checked='checked'";} ?>/>
                                </span>
                                <span>
                                    General
                                    <input type="radio" id="trackable1<?php echo $id;?>" name="trackable" value='10' required
                                        <?php if($row['accessLevel']==10){echo "checked='checked'";} ?>/>
                                </span>
                                <span>
                                    Admin
                                    <input type="radio" id="trackable2<?php echo $id;?>" name="trackable" value='100' required
                                        <?php if($row['accessLevel']==100){echo "checked='checked'";}?>/>
                                </span>
                            </span>
                            <input type="button" value="Done" id="donesecplan_<?php echo $id;?>" onclick="doneEditSecurityPlan(this.id);">
                            <input type="button" value="Cancel" id="cancelsecplan_<?php echo $id;?>" onclick="cancelEditSecurityPlan(this.id);">
                        </span>
                    </td>

                    <td><?php echo $date;?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    <?php
    }
require_once("footer.php");
?>
</div>
<script>
    var oldusername;
    var oldsecurityplannumber;
    var username;
    var userid;
    var securityplannumber;

    function editUserName(id)
    {
        var temp=id.split("_");
        var id="username_"+temp[1];
        oldusername= $.trim($('#inputUserName'+temp[1]).val());
        //alert(id);
        $('#viewUserName'+temp[1]).hide();
        $('#spanUserName'+temp[1]).show();
    }
    function cancelEdit(id)
    {
        var temp=id.split("_");
        var id="canceluser"+temp[1];
        $('#viewUserName'+temp[1]).show();
        $('#spanUserName'+temp[1]).hide();
        $('#inputUserName'+temp[1]).val(oldusername);
        $('#inputUserName'+temp[1]).css('border','');
    }
    function doneEdit(id)
    {
        var temp=id.split("_");
        var id="doneuser"+temp[1];
        userid=temp[1];
        username= $.trim($('#inputUserName'+temp[1]).val());
        if(username!=oldusername)
        {
            changeUserName();
        }
        else
        {
            $('#inputUserName'+temp[1]).css('border','1px solid red');
            $('#inputUserName'+temp[1]).attr('title','Please make some change in name if you want to edit.')
        }
    }
    function changeUserName()
    {
        var httpfeed = getHttpFeedURL('changeusername');
        httpfeed = setHttpParameter(httpfeed, 'userid',encodeURIComponent(userid));
        httpfeed = setHttpParameter(httpfeed, 'username',encodeURIComponent(username));
        initializeHttpRequest(httpfeed, onSuccessChangeUserName, onFailureChangeUserName);
    }
    function onSuccessChangeUserName(value)
    {
        $('#inputUserName'+temp[1]).css('border','');
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#viewUserName'+userid).show();
            $('#spanUserName'+userid).hide();
            $('#viewModeUserName'+userid).html(username);

        }
    }
    function onFailureChangeUserName()
    {

    }



    function editSecurityPlan(id)
    {
        var temp=id.split("_");
        var id="securityplan_"+temp[1];
        oldsecurityplannumber= $("input[name=trackable]:checked").val();
        //alert(id);
        $('#viewSecurityPlan'+temp[1]).hide();
        $('#spanSecurityPlan'+temp[1]).show();
    }
    function doneEditSecurityPlan(id)
    {
        var temp=id.split("_");
        var id="securityplan_"+temp[1];
        userid=temp[1];
        securityplannumber= $("input[name=trackable]:checked").val();
        if(securityplannumber!=oldsecurityplannumber)
        {
            changeSecurityPlan();
        }
        else
        {
            $('#radioButtonSpan'+temp[1]).css('border','1px solid red');
            $('#radioButtonSpan'+temp[1]).attr('title','Please select any other security plan if you want to change it');
        }
    }
    function cancelEditSecurityPlan(id)
    {
        var temp=id.split("_");
        var id="username_"+temp[1];
        $('#viewSecurityPlan'+temp[1]).show();
        $('#spanSecurityPlan'+temp[1]).hide();
        $( "input[id^='trackable']").removeAttr('checked');
        if(oldsecurityplannumber==1){$('#trackable'+temp[1]).prop('checked','checked');}
        else if(oldsecurityplannumber==10){$('#trackable1'+temp[1]).prop('checked','checked');}
        else if(oldsecurityplannumber==100){$('#trackable2'+temp[1]).prop('checked','checked');}
        $('#radioButtonSpan'+temp[1]).css('border','');
    }

    function changeSecurityPlan()
    {
        var httpfeed = getHttpFeedURL('changesecurityplan');
        httpfeed = setHttpParameter(httpfeed, 'userid',encodeURIComponent(userid));
        httpfeed = setHttpParameter(httpfeed, 'securityplannumber',encodeURIComponent(securityplannumber));
        initializeHttpRequest(httpfeed, onSuccessChangeSecurityPlan, onFailureChangeSecurityPlan);
    }
    function onSuccessChangeSecurityPlan(value)
    {
        $('#radioButtonSpan'+userid).css('border','');
        var json = JSON.parse(value);
        if(json['Status']=="true")
        {
            $('#viewSecurityPlan'+userid).show();
            $('#spanSecurityPlan'+userid).hide();
            $('#viewModeSecurityPlan'+userid).html(username);

        }
    }
    function onFailureChangeSecurityPlan()
    {

    }
</script>
</body>
</html>

