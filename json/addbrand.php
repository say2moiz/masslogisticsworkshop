<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['brandname']) && isset($_GET['partid']))
        {
            $brandname = $_GET['brandname'];
            $trackable = $_GET['trackable'];
            $partid = $_GET['partid'];
            if($brandname!='' && $trackable!='' && $partid!='')
            {
                $result = $c->addbrand($brandname,$partid,$trackable);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in addbrand json service";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addbrand json service";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>