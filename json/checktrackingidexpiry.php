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
                $result = $c->checktrackingidexpiry($trackingid);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in checktrackingidexpiry json service, tracking id is empty or null";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in checktrackingidexpiry json service, unknown URL";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>