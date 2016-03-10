<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['scrapreceivername']))
        {
            $scrapreceivername = $_GET['scrapreceivername'];

            if($scrapreceivername!='')
            {
                $result = $c->addscrapreceivername($scrapreceivername);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in addscrapreceivername json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addscrapreceivername json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>