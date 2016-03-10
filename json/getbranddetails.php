<?php
try
{
    header('Content-type: application/json');
    require_once("../mysqlcon/mysql1.php");
    require_once("../class/Graph.php");
    $result=array();
    $c = new reportdata( $con, $databasename );
    if(isset($_GET['brandname']))
    {
        $brandname = $_GET['brandname'];
        if($brandname!='')
        {
            $result = $c->getbranddetails($brandname);
        }
        else
        {
            $result['DetailedStatus']="Exception occured in getbranddetails json service, Brand Name is null or empty or undefined.";
            $result['Status']="false";
        }
    }
    else
    {
        $result['DetailedStatus']="Exception occured in getbranddetails json service, Brand Name is not defined. Invalid or in complete parameters in          url";
        $result['Status']="false";
    }
    echo json_encode($result);
}
catch(Exception $ex)
{
}
?>