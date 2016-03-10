<?php
try
{
    header('Content-type: application/json');
    require_once("../mysqlcon/mysql1.php");
    require_once("../class/Graph.php");
    $result=array();
    $c = new reportdata( $con, $databasename );
    if(isset($_GET['trackingid']))
    {
        $trackingid = $_GET['trackingid'];
        if($trackingid!='')
        {
            $result = $c->checktrackingid($trackingid);
        }
        else
        {
            $result['DetailedStatus']="Exception occured in checktrackingid json service, Tracking ID is null or empty or undefined.";
            $result['Status']="false";
        }
    }
    else
    {
        $result['DetailedStatus']="Exception occured in checktrackingid json service, Tracking ID is not defined. Invalid or in complete parameters in             url";
        $result['Status']="false";
    }
    echo json_encode($result);
}
catch(Exception $ex)
{
}
?>