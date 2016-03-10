<?php
require_once('mysqlcon/mysql1.php');
session_start();
require_once('activitylog.php');
if($_SESSION['login']!=true)
{
    monitorActivity("Failure");
    $preUrl=$_SERVER['PHP_SELF'];
    header("location:login.php?url='$preUrl'");
}
else
{
    $userid=$_SESSION['userid'];
    $qry="select accessLevel from userauth where idUserAuth='$userid'";
    $result=mysql_query($qry) or die(mysql_error());
    $row=mysql_fetch_assoc($result);
    $accesslevel=$row['accessLevel'];
    $pagename=$_SERVER['PHP_SELF'];
    $search='/MassLogisticsWorkshop/';
    $pagename=str_replace($search, '', $pagename);/*remove /MassLogisticsWorkshop/ from the $preUrl*/
    $pagename=str_replace("'", "", $pagename);/*remove ' from the $preUrl, now we hava a proper url*/

    if($accesslevel==1)
    {
        $qry="select * from security where pageName='$pagename' and securityPlan1='$accesslevel' ";
    }
    else if($accesslevel==10)
    {
        $qry="select * from security where pageName='$pagename' and securityPlan2='$accesslevel' ";
    }
    else if($accesslevel==100)
    {
        $qry="select * from security where pageName='$pagename' and securityPlan3='$accesslevel' ";
    }
    else if($accesslevel==1000)
    {
        $qry="select * from security where pageName='$pagename' and securityPlanAdmin='$accesslevel' ";
    }
/*    */?><!--<script>alert("<?php /*echo $qry;*/?>");</script>--><?php
    $result=mysql_query($qry) or die (mysql_error());
    $numOfRows=mysql_num_rows($result);
    if($numOfRows==0)
    {
        header("location:restrict.php");
        monitorActivity("Restricted");
    }
    else
    {
        monitorActivity("Success");
    }
}
?>