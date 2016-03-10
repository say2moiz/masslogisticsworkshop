<?php
//This is a test comment to check push pull and commit
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