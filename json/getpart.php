<?php
    try
     {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['partname']))
        {
            $partname = $_GET['partname'];
            if($partname!='')
            {
                $result = $c->getpartsforthisbrand($partname);
            }
            else
            {
                $result['DetailedStatus']="Exception occured in getpart json service";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in getpart json service partname is not set in URL";
            $result['Status']="false";
        }
        echo json_encode($result);
     }

     catch(Exception $ex)
     {

     }
?>