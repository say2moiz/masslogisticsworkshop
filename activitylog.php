<?php
//Add test comment
function monitorActivity($status)
{
    if(isset($_SESSION['username']) && isset($_SESSION['userid']))
    {
        $userid=$_SESSION['userid'];
        $accessedUrl=$_SERVER['REQUEST_URI'];
        $accessedUrl=mysql_real_escape_string($accessedUrl);
        $qry="insert into activitylog (urlAccessed,idUserAuth,dateActivity,attemptStatus) values('$accessedUrl','$userid',now(),'$status')";
        mysql_query($qry) or die(mysql_error());
    }
}
?>