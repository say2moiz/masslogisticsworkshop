<?php
 try
 {
        header('Content-type: application/json');
        include("../mysqlcon/mysql1.php");
        include("../class/Graph.php");
        $c = new reportdata( $mysql1, $databasename );



        if (isset($_GET['partnamepurchaseid']))
        {
            if (isset($_GET['purchaseid ']))
            {

                $purchaseid = $_GET['purchaseid'];
                $partnamepurchaseid = $_GET['partnamepurchaseid'];
                $brandnamepurchaseid= $_GET['brandnamepurchaseid'];
                $buyernamepurchaseid= $_GET['buyernamepurchaseid'];
                $sellernamepurchaseid= $_GET['sellernamepurchaseid'];
                $datepurchaseid=$_GET['datepurchaseid'];
                $purchaseforpurchaseid=$_GET['purchaseforpurchaseid'];
                $remarkspurchaseid=$_GET['remarkspurchaseid'];
                $pricepurchaseid=$_GET['pricepurchaseid'];
                $amountpurchaseid=$_GET['amountpurchaseid'];
                $quantitypurchaseid=$_GET['quantitypurchaseid'];
                $unitofpurchasepurchaseid=$_GET['unitofpurchasepurchaseid'];


                $result = $c->updatepurchase($purchaseid,$partnamepurchaseid,$brandnamepurchaseid, $buyernamepurchaseid, $sellernamepurchaseid,                     $datepurchaseid,$purchaseforpurchaseid,$remarkspurchaseid,$pricepurchaseid,$amountpurchaseid,$quantitypurchaseid,                                   $unitofpurchasepurchaseid);
                if($result)
                {
                    echo json_encode($result);
                }
            }
        }
 } 

	 catch(Exception $ex)      
		 {              
		 } 
    ?>