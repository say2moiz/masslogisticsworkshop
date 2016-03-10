<?php
try
{
    header('Content-type: application/json');
    require_once("../mysqlcon/mysql1.php");
    require_once("../class/Graph.php");
    $result=array();
    $c = new reportdata( $con, $databasename );
    if(isset($_GET['trackingid']) && isset($_GET['remarks']) && isset($_GET['returnid']) && isset($_GET['returnedby'])
      && isset($_GET['userid']) && isset($_GET['userdatereturn']))
    {
        $trackingid = $_GET['trackingid'];
        $remarks = $_GET['remarks'];
        $returnid = $_GET['returnid'];
        $returnedby = $_GET['returnedby'];
        $userid = $_GET['userid'];
        $userdatereturn = $_GET['userdatereturn'];
        if($trackingid!='')
        {
            $result = $c->updatetrackingid($trackingid,$remarks,$returnid,$returnedby,$userid,$userdatereturn);
        }
        else
        {
            $result['DetailedStatus']="Exception occured in updatetrackingid json service, required parameters are null or empty or undefined.";
            $result['Status']="false";
        }
    }
    else
    {
        $result['DetailedStatus']="Exception occured in updatetrackingid json service. Invalid or in complete parameters in url";
        $result['Status']="false";
    }
    echo json_encode($result);
}
catch(Exception $ex)
{
}
?>