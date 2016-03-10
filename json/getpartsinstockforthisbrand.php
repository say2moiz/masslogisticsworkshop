<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['brandid']))
        {
            $brandid = $_GET['brandid'];
            if($brandid!='')
            {
                $result = $c->getpartsinstockforthisbrand($brandid);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in getpartsinstockforthisbrand json service, brandid is empty or undefined";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in getpartsinstockforthisbrand json service, brandid id not defined in URL";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>