<?php
try
{
    header('Content-type: application/json');
    require_once("../mysqlcon/mysql1.php");
    require_once("../class/Graph.php");
    $c = new reportdata( $con, $databasename );
    if(isset($_GET['brandid']))
    {
        $brandid = $_GET['brandid'];
        if($brandid!='')
        {
            $result = $c->getpartsforthisbrand($brandid);
        }
        else
        {
            $result['DetailedStatus']="Exception occured in getpartsforthisbrand json service";
            $result['Status']="false";
        }
    }
    else
    {
        $result['DetailedStatus']="Exception occured in getpartsforthisbrand json service brandid is not set in URL";
        $result['Status']="false";
    }
    echo json_encode($result);
}

catch(Exception $ex)
{

}
?>