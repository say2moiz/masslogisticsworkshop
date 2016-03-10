<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['userid']) && isset($_GET['securityplannumber']))
        {
            $userid = $_GET['userid'];
            $securityplannumber=$_GET['securityplannumber'];
            if($userid!='' && $securityplannumber!='')
            {
                $result = $c->changeSecurityPlan($userid,$securityplannumber);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in changesecurityplan json service";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in changesecurityplan json service";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>