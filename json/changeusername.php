<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['userid']) && isset($_GET['username']))
        {
            $userid = $_GET['userid'];
            $username=$_GET['username'];
            if($userid!='' && $username!='')
            {
                $result = $c->changeUserName($userid,$username);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in changeusername json service";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in changeusername json service";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>