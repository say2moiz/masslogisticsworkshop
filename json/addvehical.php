<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['vehicalname']) && isset($_GET['vehicalnumber']) && isset($_GET['userid']))
        {
            $vehicalname = $_GET['vehicalname'];
            $vehicalnumber = $_GET['vehicalnumber'];
            $userid = $_GET['userid'];

            if($vehicalname!='' && $vehicalnumber!='' && $userid!='')
            {
                $result = $c->addvehical($vehicalname,$vehicalnumber,$userid);
            }
            else
            {
                $result['DetailedStatus']="Exceptiom occured in addseller json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addseller json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>