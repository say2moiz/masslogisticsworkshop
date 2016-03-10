<?php
require_once('mysqlcon/mysql1.php');
function getPhpFilesAndInsertInAccessCheckTableAgainstNewUser($newUserId)
{
    $dir=__DIR__;
    $files=scandir($dir);
    for($i=0;$i<count($files);$i++)
    {
        if(strpos($files[$i],".php")!=false)
        {
            /*Insert all the pages scanned from directory in to the table security*/
            $qry="insert into security (pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)
            values('$files[$i]',0,0,0,1000,now(),'$newUserId')";
            mysql_query($qry) or die(mysql_error());
            echo $qry."<br><br>";
        }
    }
}
//getPhpFilesAndInsertInAccessCheckTableAgainstNewUser(11);
function getDataFromSecurityAndMakeInsertQuery()
{
    $count=0;
    $qry="select * from security";
    $result=mysql_query($qry) or die(mysql_error());
    while($row=mysql_fetch_assoc($result))
    {
        $count++;
        $idSecurity=$row['idSecurity'];
        $pageName=$row['pageName'];
        $securityPlan1=$row['securityPlan1'];
        $securityPlan2=$row['securityPlan2'];
        $securityPlan3=$row['securityPlan3'];
        $securityPlanAdmin=$row['securityPlanAdmin'];
        $dateCreated=$row['dateCreated'];
        $userId=$row['userId'];

        $qryString="Insert into security (idSecurity,pageName,securityPlan1,securityPlan2,securityPlan3,securityPlanAdmin,dateCreated,userId)values ('$idSecurity','$pageName','$securityPlan1','$securityPlan2','$securityPlan3','$securityPlanAdmin','$dateCreated','$userId');";


        $qryStringRealEscape=mysql_real_escape_string($qryString);
        $qry1="select * from backUpSecurity where queryString='$qryStringRealEscape'";
        $result1=mysql_query($qry1) or die(mysql_error());
        $numOfRows=mysql_num_rows($result1);
        if($numOfRows==0)
        {
            $qryInsert="insert into backUpSecurity (queryString,dateCreated) values ('$qryStringRealEscape',now())";
            mysql_query($qryInsert) or die(mysql_error());
            //echo $count." ) ".mysql_real_escape_string($qryString)."<br>";
            //echo $qryString."<br><br>";
        }
    }
    $qry="select * from backUpSecurity";
    $result=mysql_query($qry) or die(mysql_error());
    while($row=mysql_fetch_assoc($result))
    {
        echo $row['queryString']."<br><br>";
    }
}
/*Un comment this function and run the page to update the backup security table if you have added any new page in the security table*/
getDataFromSecurityAndMakeInsertQuery();
?>
<h1 style="color: red">Please go into the page code and call the function according to your requirment carefully.</h1>