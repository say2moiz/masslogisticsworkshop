<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['brandid']) && isset($_GET['partid']))
        {
            $brandid = $_GET['brandid'];
            $partid = $_GET['partid'];
            if($brandid!='' && $partid!='')
            {
                $result = $c->checkmaxavailablestock($brandid,$partid);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in checkmaxavailablestock json service, partid or brandid is empty or null";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in checkmaxavailablestock json service, unknown URL";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>