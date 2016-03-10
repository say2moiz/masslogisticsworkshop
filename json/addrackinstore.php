<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['rackdescription']) && isset($_GET['rackid']) && isset($_GET['userid']))
        {
            $rackid = $_GET['rackid'];
            $rackdescription = $_GET['rackdescription'];
            $userid = $_GET['userid'];

            if($rackid!='' && $rackdescription!='' && $userid!='')
            {
                $result = $c->addrackinstore($rackid,$rackdescription,$userid);
            }
            else
            {
                $result['DetailedStatus']="Exceptiom occured in addrackinstore json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addrackinstore json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>