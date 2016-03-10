<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Part</title>
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
    $partdescid='';
    $parttype='';
    $partname='';
    ?>
    <body>
    <div id="containerOuter">
        <div id="containerInner">
            <form onsubmit="return false" id="addForm">
                <div class="form clearfix">
                    <div class="formHead">Add Part Form<span onclick="window.location='viewparts.php'">View</span></div>
                    <div class="row">
                        <span class="stuNameHead">Enter Part Name</span>
                        <input type="text" class="stuNameVal" id="part" autocomplete="off" placeholder="Add new / Search old parts...">
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Select Rack</span>
                        <?php
                        $rackname='';
                        $storetid='';
                        $qry="select idStore,rackDescription,rackId from store";
                        $result=mysql_query($qry) or die(mysql_error());
                        ?>
                        <select name='rack' id="rack">
                            <option value='-1'>Select rack</option>
                            <?php
                            while($row=mysql_fetch_array($result))
                            {
                                $rackname=$row['rackDescription'];
                                $storeid=$row['idStore'];
                                $rackid=$row['rackId'];
                                ?>
                                <option  value='<?php echo $storeid ?>'><?php echo $rackid; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Select Brand</span>
                        <?php
                        $brandname='';
                        $brandid='';
                        $qry="select idBrand,brandName from Brand";
                        $result=mysql_query($qry) or die(mysql_error());
                        ?>
                        <select name="brand" id="brand">
                            <option value='-1'>Select Brand</option>
                            <?php
                            while($row=mysql_fetch_array($result))
                            {
                                $brandname=$row['brandName'];
                                $brandid=$row['idBrand'];
                                ?>
                                <option  value='<?php echo $brandid ?>'><?php echo $brandname; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Enter Part Type</span>
                        <input type="text" class="stuNameVal" id="parttype" placeholder="Enter type here...">
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Enter part description id</span>
                        <input type="text" class="stuNameVal" id="partdescription" autocomplete="off" placeholder="Enter description id here...">
                    </div>
                    <div class="row"id="trackableRow" style="display: none;" title="Select yes if you want to track this brand in future and no if you donot.">
                        <span class="stuNameHead">Trackable</span>
                        <span>Yes<input type="radio" id="trackable" name="trackable" value='1'required/></span>
                        <span>No<input type="radio" id="trackable1" name="trackable" value='0'required/></span>
                    </div>
                    <div class="formFoot clearfix" id="submitRow">
                        <input type="submit" name="submit" value="Submit" id="submit">
                        <input type="reset" value="Reset" id="reset" title="Click to reset the form">
                        <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                    </div>
                    <div id="msg" style="display: none;" class="popup clearfix"> </div>
                </div>
            </form>
            <?php
            if(isset($_GET['partid']))
            {
                $partid=$_GET['partid'];
                $qry = "select * from part where idPart = '$partid'";
                $result = mysql_query($qry) or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $partname = $row['partName'];
                $partdescid = $row['partNumber'];
                $parttype = $row['partType'];
                ?>
                <script> $('#addForm').hide(); </script>
                <form method="post" id="editForm">
                    <div class="form clearfix">
                        <div class="formHead">Edit Part Form<span onclick="window.location='viewparts.php'">View</span></div>
                        <div class="row">
                            <span class="stuNameHead">Enter part description id</span>
                            <input type="text" class="stuNameVal" id="partdescription" autocomplete="off" name="partDesc"
                                   value="<?php if(isset($_GET['partid'])) echo $partdescid;?>">
                        </div>
                        <div class="row">
                            <span class="stuNameHead">Enter Part Name</span>
                            <input type="text" class="stuNameVal" id="part" autocomplete="off"  name="partName"
                                   value="<?php if(isset($_GET['partid'])) echo $partname;?>">
                        </div>
                        <div class="row">
                            <span class="stuNameHead">Enter Part Type</span>
                            <input type="text" class="stuNameVal" id="parttype" name="partType"
                                   value="<?php if(isset($_GET['partid'])) echo $parttype;?>">
                        </div>
                        <div class="formFoot clearfix" id="submitRow">
                            <input type="submit" name="submitEdit" value="Submit" id="submit">
                            <input type="reset" value="Cancel" onclick="window.location='viewparts.php'">
                            <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                        </div>
                        <div id="msg" style="display: none;" class="popup clearfix"> </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submitEdit']))
                {
                    $edit_partdescid=$_POST['partDesc'];
                    $edit_partname=$_POST['partName'];
                    $edit_parttype=$_POST['partType'];
                    if($edit_partdescid != $partdescid || $edit_partname != $partname || $edit_parttype != $parttype)
                    {
                        $qry="select * from part where partName='$edit_partname'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $numOfRows=mysql_num_rows($result);
                        if($numOfRows==0)
                        {
                            $qry="update part set partNumber='$edit_partdescid',partType='$edit_parttype',partName='$edit_partname' where idPart='$partid'";
                            mysql_query($qry) or die(mysql_error());
                            header("location:viewparts.php");
                        }
                        else if($edit_partdescid != $partdescid)
                        {
                            $qry="update part set partNumber='$edit_partdescid' where idPart='$partid'";
                            mysql_query($qry) or die(mysql_error());
                            header("location:viewparts.php");
                        }

                        else if($parttype != $edit_parttype)
                        {
                            $qry="update part set partType='$edit_parttype' where idPart='$partid'";
                            mysql_query($qry) or die(mysql_error());
                            header("location:viewparts.php");
                        }
                        else
                        {
                            ?><script>alert('Similar part already exist');</script><?php
                        }


                    }
                    else
                    {
                    ?>
                        <script>$('#editForm').submit(function(){
                                //alert('<?php echo $partname."=".$edit_partname."---".$parttype."=".$edit_parttype."---".$partdescid."=".$edit_partdescid;?>');
                                alert('Please edit some thing or click cancel to go back');
                            });
                        </script>
                    <?php
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
        var partname;
        var parttype;
        var partdescription;
        var brandid;
        var rackid;
        var trackable;
        var html='<span>You did not select any brand !!! <br>Are you sure, you donot want to associate any brand with this                                  part?</span><br><input type="button" class="yes" value="Yes" id="yes"><input type="button" class="no" value="No" id="no">';
        $('#submit').click(function(){

            $('#brand').css('border','');
            $('#part').css('border','');
            /*alert($('#rack').val());
             alert($('#brand').val());
             alert($.trim($('#part').val()));
             alert($.trim($('#parttype').val()));
             alert($.trim($('#partdescription').val()));
             alert($("input[name=trackable]:checked").val());*/
            if($('#brand').val()==-1 && $('#rack').val()!=-1 && $.trim($('#part').val())!='' &&
                $.trim($('#parttype').val())!='' && $.trim($('#partdescription').val())!='')
            {
                $('#msg').html(html);
                $('#submitRow').hide();
                $('#msg').show();
                $('#brand').css('border','1px solid orange');
            }
            else if( $('#brand').val()!=-1 && $('#rack').val()!=-1 && $.trim($('#part').val())!='' && $.trim($('#parttype').val())!=''
                && $.trim($('#partdescription').val())!='' && $("input[name=trackable]:checked").val()!=undefined)
            {
                partname= $.trim($('#part').val());
                parttype= $.trim($('#parttype').val());
                partdescription= $.trim($('#partdescription').val());
                brandid=$('#brand').val();
                rackid=$('#rack').val();
                trackable=$("input[name=trackable]:checked").val();
                addpart();
            }
            else
            {
                validateAndShowInvalid();
            }
            $('#yes').click(function(){
                partname= $.trim($('#part').val());
                parttype= $.trim($('#parttype').val());
                partdescription= $.trim($('#partdescription').val());
                brandid=$('#brand').val();
                rackid=$('#rack').val();
                trackable="false";
                if(partname!='' && parttype!='' && partdescription!='' && trackable!='' && rackid!=-1)
                {
                    addpart();
                }
                else
                {
                    validateAndShowInvalid();
                }
            });
            $('#no').click(function(){
                $('#submitRow').show();
                $('#msg').hide();
            });
            function validateAndShowInvalid()
            {
                if($('#part').val()=='')
                {
                    $('#part').css('border','1px solid red');
                    $('#part').attr('title','Part Name cannot be empty');
                }
                if($('#parttype').val()=='')
                {
                    $('#parttype').css('border','1px solid red');
                    $('#parttype').attr('title','Part Type cannot be empty');
                }
                if($('#partdescription').val()=='')
                {
                    $('#partdescription').css('border','1px solid red');
                    $('#partdescription').attr('title','Part Description cannot be empty');
                }
                if($('#rack').val()==-1)
                {
                    $('#rack').css('border','1px solid red');
                    $('#rack').attr('title','Rack cannot be unselected');
                }
                if($('#brand').val()==-1)
                {
                    $('#brand').css('border','1px solid orange');
                }
                if($("input[name=trackable]:checked").val()==undefined)
                {
                    $('#trackableRow').css('border','1px solid red');
                    $('#trackableRow').attr('title','Trackable cannot be unselected');
                }
            }
        });
        function addpart()
        {
            var httpfeed = getHttpFeedURL('addpart');
            httpfeed = setHttpParameter(httpfeed, 'partname',encodeURIComponent(partname));
            httpfeed = setHttpParameter(httpfeed, 'brandid',encodeURIComponent(brandid));
            httpfeed = setHttpParameter(httpfeed, 'trackable',encodeURIComponent(trackable));
            httpfeed = setHttpParameter(httpfeed, 'parttype',encodeURIComponent(parttype));
            httpfeed = setHttpParameter(httpfeed, 'partdescription',encodeURIComponent(partdescription));
            httpfeed = setHttpParameter(httpfeed, 'rackid',encodeURIComponent(rackid));
            initializeHttpRequest(httpfeed, onSuccessAddPart, onFailureAddPart);
        }
        function onSuccessAddPart(value)
        {
            // var obj = eval ("(" + value + ")");
            var json = JSON.parse(value);
            if(json['Status']=="true")
            {
                $('#part').val('');
                $('#brand').val('-1');
                $('#parttype').val('');
                $('#partdescription').val('');
                $('#rack').val('-1');
                $('#msg').hide();
                $('#submitRow').show();
                $('#trackableRow').hide();
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
                $('#msg').html('');
                $('#msg').hide();
                $('#submitRow').show();
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
            //var numofele=json.length;
        }
        function onFailureAddPart()
        {

        }

        var oldRackDropdownHtml=$('#rack').html();
        var oldBrandDropdownHtml=$('#brand').html();
        function getpartdetails()
        {
            var httpfeed = getHttpFeedURL('getpartdetails');
            httpfeed = setHttpParameter(httpfeed, 'partname',partname);
            initializeHttpRequest(httpfeed, onSuccessGetPartDetails, onFailureGetPartDetails);
        }
        function onSuccessGetPartDetails(value)
        {
            // var obj = eval ("(" + value + ")");
            var json = JSON.parse(value);
            if(json['Status']=="true")
            {
                $('#rack').css('border','');
                $('#part').css('border','');
                $('#brand').css('border','');
                $('#parttype').css('border','');
                $('#partdescription').css('border','');
                $('#trackableRow').css('border','');
                var parttype=json['parttype'];
                var partdescription=json['partdescription'];
                var rackname=json['rackname'];
                var rackid=json['storeid'];
                var brandid=json['brandid'];
                var brandname=json['brandname'];
                var trackable=json['trackable'];

                $('#parttype').val(parttype);
                $('#partdescription').val(partdescription);
                $('#rack').html('<option value="-1">Select Rack</option><option value="'+rackid+'" selected="selected">'+rackname+'</option>');
                $('#brand').html('<option value="-1">Select Brand</option><option value="'+brandid+'" selected="selected">'+brandname+'</option>');

                $('#parttype').css('background','#C5FFC7');
                $('#partdescription').css('background','#C5FFC7');
                $('#rack').css('background','#C5FFC7');
                $('#brand').css('background','#C5FFC7');

                if(trackable==1)
                {
                    $('#trackable').prop('checked', true);
                }
                else if(trackable==0)
                {
                    $('#trackable1').prop('checked', true);
                }
                else
                {
                    $('#trackable').prop('checked', false);
                    $('#trackable1').prop('checked', false);
                    $('#trackableRow').hide();
                }

                if(brandid!='' && brandid!=null && brandid!=undefined && brandid!=' ' &&  brandid!=-1)
                {
                    $('#trackableRow').show();
                    $('#submit').attr('disabled','disabled');
                    //$('#reset').attr('disabled','disabled');
                    $('#responseMsg').html('');
                    $('#responseMsg').css('color','green');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span id="msg">Search Result: Part already exist in the system, you cannot add the similar part again.</span>');
                    $('#responseMsg').show();
                    setTimeout(function(){
                        $('#addResponseImg').css('visibility','visible');
                    },300);
                }
                else
                {
                    //$('#reset').attr('disabled','disabled');
                    $('#brand').html(oldBrandDropdownHtml);
                    $('#submit').removeAttr('disabled');
                    $('#parttype').css('background','');
                    $('#partdescription').css('background','');
                    $('#rack').css('background','');
                    $('#brand').css('background','');
                    $('#responseMsg').html('');
                    $('#responseMsg').css('color','');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                id="msg">Search Result: Part found, but no brand is attached with it yet. Please select brand and submit if you want to attach a                      brand with this part.</span>');
                    $('#responseMsg').show();
                    setTimeout(function(){
                        $('#addResponseImg').css('visibility','visible');
                    },300);
                }

            }
            else
            {
                $('#parttype').val('');
                $('#partdescription').val('');
                $('#rack').html(oldRackDropdownHtml);
                $('#brand').html(oldBrandDropdownHtml);

                $('#parttype').css('background','');
                $('#partdescription').css('background','');
                $('#rack').css('background','');
                $('#brand').css('background','');

                $('#trackableRow').hide();
                $('#trackable1').prop('checked', false);

                $('#reset').removeAttr('disabled');
                $('#submit').removeAttr('disabled');

                $('#responseMsg').html('');
            }
        }
        function onFailureGetPartDetails()
        {

        }


        $('#part').keyup(function(){
            $('#part').css('border','');
            if($.trim($('#part').val())!='')
            {
                partname= $.trim($('#part').val());
                getpartdetails();
            }
        });
        $('#brand').change(function(){
            if($('#brand').val()!=-1)
            {
                $('#trackableRow').show();
                $('#msg').html('');
                $('#msg').hide();
                $('#submitRow').show();
            }
            else
            {
                $('#trackableRow').hide();
            }
            $('#brand').css('border','');
        });
        $('#parttype').keyup(function(){
            $('#parttype').css('border','');
        });
        $('#rack').change(function(){
            $('#rack').css('border','');
        });
        $('#trackable').change(function(){
            $('#trackableRow').css('border','');
        });
        $('#partdescription').keyup(function(){
            $('#partdescription').css('border','');
        });

        $('#reset').click(function(){
            $('#brand').html(oldBrandDropdownHtml);
            $('#rack').html(oldRackDropdownHtml);
            $('#part').val('');
            $('#brand').val('-1');
            $('#parttype').val('');
            $('#partdescription').val('');
            $('#rack').val('-1');
            $('#responseMsg').html('');
            $('#rack').css('border','');
            $('#part').css('border','');
            $('#brand').css('border','');
            $('#parttype').css('border','');
            $('#partdescription').css('border','');
            $('#trackableRow').css('border','');
            $('#parttype').css('background','');
            $('#partdescription').css('background','');
            $('#rack').css('background','');
            $('#brand').css('background','');
            $('#submit').removeAttr('disabled');
        });
        $('#refresh').click(function(){
            window.location.reload();
        });
    </script>
    <?php include "footer.php";?>
    </body>
</html>



