<?php
    try
    {
        header('Content-type: application/json');
        require_once("../mysqlcon/mysql1.php");
        require_once("../class/Graph.php");
        $result=array();
        $c = new reportdata( $con, $databasename );
        if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['email']) && isset($_GET['securityplan']))
        {
            $username = $_GET['username'];
            $password = $_GET['password'];
            $email = $_GET['email'];
            $securityplan = $_GET['securityplan'];

            if($username!='' && $password!='' && $email!='' && $securityplan!='')
            {
                $result = $c->adduser($username,$password,$email,$securityplan);
            }
            else
            {
                $result['DetailedStatus']="Exceptin occured in adduser json service. Invalid or in complete parameters in url";
                $result['Status']="false";
            }
        }
        else
        {
            $result['DetailedStatus']="Exception occured in addusers json service. In complete url or unknown url scheme";
            $result['Status']="false";
        }
        echo json_encode($result);
    }
    catch(Exception $ex)
    {
    }
?>