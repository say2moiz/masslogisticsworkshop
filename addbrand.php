<?php
require_once('checkLoginAndVerifyAccessPage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Brand</title>
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
    ?>
    <body>

    <div id="containerOuter">
        <div id="containerInner">
            <form onsubmit="return false" id="addForm">
                <div class="form clearfix">
                    <div class="formHead">Add Brand Form <span onclick="window.location='viewbrands.php'">View</span></div>
                    <div class="row">
                        <span class="stuNameHead">Select Part</span>
                        <?php
                        $partname='';
                        $partid='';
                        $qry="select idPart,partName from Part";
                        $result=mysql_query($qry) or die(mysql_error());
                        ?>
                        <select name="part" id="part">
                            <option value='-1'>Select Part</option>
                            <?php
                            while($row=mysql_fetch_array($result))
                            {
                                $partname=$row['partName'];
                                $partid=$row['idPart'];
                                ?>
                                <option  value='<?php echo $partid ?>'><?php echo $partname; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <span class="stuNameHead">Enter Brand Name</span>
                        <input type="text" class="stuNameVal" id="brand" autocomplete="off" placeholder="Add new / Search old brands...">
                    </div>
                    <div class="row"id="trackableRow" style="display: none;" title="Select yes if you want to track this part in future and no if you donot.">
                        <span class="stuNameHead">Trackable</span>
                        <span>Yes<input type="radio" id="trackable" name="trackable" value='1'required/></span>
                        <span>No<input type="radio" id="trackable1" name="trackable" value='0'required/></span>
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

            <?php
            if(isset($_GET['brandid']))
            {
                $brandid=$_GET['brandid'];
                $qry = "select * from brand where idBrand = '$brandid'";
                $result = mysql_query($qry) or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $brandname = $row['brandName'];
                ?>
                <script> $('#addForm').hide(); </script>
                <form method="post" id="editForm">
                    <div class="form clearfix">
                        <div class="formHead">Edit Brand Form<span onclick="window.location='viewbrands.php'">View</span></div>
                        <div class="row">
                            <span class="stuNameHead">Enter Brand Name</span>
                            <input type="text" class="stuNameVal" id="brand" autocomplete="off"  name="brandName"
                                   value="<?php if(isset($_GET['brandid'])) echo $brandname;?>">
                        </div>
                        <div class="formFoot clearfix" id="submitRow">
                            <input type="submit" name="submitEdit" value="Submit" id="submit">
                            <input type="reset" value="Cancel" onclick="window.location='viewbrands.php'">
                            <input type="image" src="images/refresh.png" title="Click to refresh the page" id="refresh">
                        </div>
                        <div id="msg" style="display: none;" class="popup clearfix"> </div>
                    </div>
                </form>
                <?php
                if(isset($_POST['submitEdit']))
                {
                    $edit_brandname=$_POST['brandName'];
                    if($edit_brandname != $brandname)
                    {
                        $qry="select * from brand where brandName='$edit_brandname'";
                        $result=mysql_query($qry) or die(mysql_error());
                        $numOfRows=mysql_num_rows($result);
                        if($numOfRows==0)
                        {
                            $qry="update brand set brandName='$edit_brandname' where idBrand='$brandid'";
                            mysql_query($qry) or die(mysql_error());
                            header("location:viewbrands.php");
                        }
                        else
                        {
                            ?><script>alert('Similar brand already exist');</script><?php
                        }
                    }
                    else
                    {
                    ?>
                        <script>$('#editForm').submit(function(){
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
        var html='<span>You did not select any part !!! <br>Are you sure, you donot want to associate any part with this                                      brand?</span><br><input type="button" class="yes" value="Yes" id="yes"><input type="button" class="no" value="No" id="no">';
        $('#submit').click(function(){

            $('#brand').css('border','');
            $('#part').css('border','');
            if($('#part').val()==-1 && $.trim($('#brand').val())!='')
            {
                $('#msg').html(html);
                $('#submitRow').hide();
                $('#msg').show();
                $('#part').css('border','1px solid orange');
            }
            else if( $('#part').val()!=-1  && $.trim($('#brand').val())!='' && $("input[name=trackable]:checked").val()!=undefined)
            {
                brandname= $.trim($('#brand').val());
                partid=$('#part').val();
                trackable=$("input[name=trackable]:checked").val();
                addbrand();
            }
            else
            {
                validateAndShowInvalid();
            }
            $('#yes').click(function(){
                brandname= $.trim($('#brand').val());
                partid=$('#part').val();
                trackable="false";
                if(brandname!='')
                {
                    addbrand();
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
                if($('#part').val()==-1)
                {
                    $('#part').css('border','1px solid orange');
                }
                if($('#brand').val()=='')
                {
                    $('#brand').css('border','1px solid red');
                    $('#part').attr('title','Part Name cannot be empty');
                }
                if($("input[name=trackable]:checked").val()==undefined)
                {
                    $('#trackableRow').css('border','1px solid red');
                    $('#trackableRow').attr('title','Trackable cannot be unselected');
                }
            }
        });
        function addbrand()
        {
            var httpfeed = getHttpFeedURL('addbrand');
            httpfeed = setHttpParameter(httpfeed, 'brandname',encodeURIComponent(brandname));
            httpfeed = setHttpParameter(httpfeed, 'partid',encodeURIComponent(partid));
            httpfeed = setHttpParameter(httpfeed, 'trackable',encodeURIComponent(trackable));
            initializeHttpRequest(httpfeed, onSuccessAddBrand, onFailureAddBrand);
        }
        function onSuccessAddBrand(value)
        {
            // var obj = eval ("(" + value + ")");
            var json = JSON.parse(value);
            if(json['Status']=="true")
            {
                $('#part').val('-1');
                $('#brand').val('');
                $('#msg').hide();
                $('#submitRow').show();
                $('#trackableRow').hide();
                $('#responseMsg').html('');
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
                $('#msg').hide();
                $('#submitRow').show();
                $('#responseMsg').html('');
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
            //var numofele=json.length;
        }
        function onFailureAddBrand()
        {

        }

        var oldPartDropdownHtml=$('#part').html();
        function getbranddetails()
        {
            var httpfeed = getHttpFeedURL('getbranddetails');
            httpfeed = setHttpParameter(httpfeed, 'brandname',encodeURIComponent(brandname));
            initializeHttpRequest(httpfeed, onSuccessGetBrandDetails, onFailureGetBrandDetails);
        }
        function onSuccessGetBrandDetails(value)
        {
            // var obj = eval ("(" + value + ")");
            var json = JSON.parse(value);
            if(json['Status']=="true")
            {
                $('#part').css('border','');
                $('#brand').css('border','');
                $('#trackableRow').css('border','');
                var brandid=json['brandid'];
                var brandname=json['brandname'];
                var partid=json['partid'];
                var partname=json['partname'];
                var trackable=json['trackable'];

                $('#part').html('<option value="-1">Select Part</option><option value="'+partid+'" selected="selected">'+partname+'</option>');

                $('#part').css('background','#C5FFC7');

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

                if(partid!='' && partid!=null && partid!=undefined && partid!=' ' &&  partid!=-1)
                {
                    $('#trackableRow').show();
                    $('#submit').attr('disabled','disabled');
                    //$('#reset').attr('disabled','disabled');
                    $('#responseMsg').html('');
                    $('#responseMsg').css('color','green');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                id="msg">Search Result: Brand already exist in the system, you cannot add the similar brand again.</span>');
                    $('#responseMsg').show();
                    setTimeout(function(){
                        $('#addResponseImg').css('visibility','visible');
                    },300);
                }
                else
                {
                    //$('#reset').attr('disabled','disabled');
                    $('#brand').html(oldPartDropdownHtml);
                    $('#submit').removeAttr('disabled');
                    $('#part').css('background','');
                    $('#responseMsg').html('');
                    $('#responseMsg').css('color','');
                    $('#responseMsg').html('<img id="addResponseImg" style="visibility: hidden"; src="images/success.png" width="20"><span                                id="msg">Search Result: Brand found, but no part is attached with it yet. Please select part and submit if you want to attach a                      part with this brand.</span>');
                    $('#responseMsg').show();
                    setTimeout(function(){
                        $('#addResponseImg').css('visibility','visible');
                    },300);
                }

            }
            else
            {
                $('#part').html(oldPartDropdownHtml);

                $('#part').css('background','');

                $('#trackableRow').hide();
                $('#trackable1').prop('checked', false);

                $('#reset').removeAttr('disabled');
                $('#submit').removeAttr('disabled');

                $('#responseMsg').html('');
            }
        }
        function onFailureGetBrandDetails()
        {

        }


        $('#brand').keyup(function(){
            $('#brand').css('border','');
            if($.trim($('#brand').val())!='')
            {
                brandname= $.trim($('#brand').val());
                getbranddetails();
            }
        });
        $('#part').change(function(){
            if($('#part').val()!=-1)
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
            $('#part').css('border','');
        });

        $('#trackable').change(function(){
            $('#trackableRow').css('border','');
        });


        $('#reset').click(function(){
            $('#part').html(oldPartDropdownHtml);
            $('#brand').val('');
            $('#part').val('-1');
            $('#responseMsg').html('');
            $('#brand').css('border','');
            $('#part').css('border','');
            $('#trackableRow').css('border','');
            $('#part').css('background','');
            $('#submit').removeAttr('disabled');
        });
        $('#refresh').click(function(){
            window.location.reload();
        });
    </script>
    <?php include "footer.php";?>
    </body>
</html>



