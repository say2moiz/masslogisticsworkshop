<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['partname']) && isset($_GET['brandid']) && isset($_GET['trackable'])
            && isset($_GET['rackid']) && isset($_GET['parttype']) && isset($_GET['partdescription']))
        {
            $partname = $_GET['partname'];
            $brandid = $_GET['brandid'];
            $trackable = $_GET['trackable'];
            $rackid = $_GET['rackid'];
            $parttype = $_GET['parttype'];
            $partdiscription = $_GET['partdescription'];
            if($trackable!='' && $partname!='' && $rackid!=-1 && $partdiscription!='' && $parttype!='')
            {
                $result = $c->addpart($partname,$brandid,$trackable,$rackid,$parttype,$partdiscription);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in addpart json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addpart json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>