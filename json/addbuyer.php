<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['buyername']))
        {
            $buyername = $_GET['buyername'];

            if($buyername!='')
            {
                $result = $c->addbuyer($buyername);
            }
            else
            {
                $result['DetailedStatus']="Exceptiom occured in addbuyer json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addbuyer json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>