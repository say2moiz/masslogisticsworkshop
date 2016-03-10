<?php
require_once('mysqlcon/mysql1.php');
?>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<!----------------------------------------   Naviagtion Bar Start Moiz  ----------------------------------------->
<div id="mainNav">
        <span class="alllinks">
            <ul>

                <li>
                    <a href="#" class="userNameSmallCaps">
                        <img src="images/user.png" class="userIcon">
                        <?php echo $_SESSION['username'];?>
                    </a>
                    <ul>
                        <li><a href="login.php">Logout</a></li>
                    </ul>
                </li>
                <li
                <?php
                    if (stripos($_SERVER['REQUEST_URI'], 'adduser.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addpart.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addbrand.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addbuyer.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addseller.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addissuer.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addrackinstore.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addvehical.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'reportdesign.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'addscrapreceiver.php')
                        )
                    {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#">Control Panel</a>
                    <ul>
                        <li><a href="adduser.php">Make New User</a></li>
                        <li><a href="addpart.php">Add New Part</a></li>
                        <li><a href="addbrand.php">Add New Brand</a></li>
                        <li><a href="addbuyer.php">Add New Buyer</a></li>
                        <li><a href="addvehical.php">Add New Vehical</a></li>
                        <li><a href="addseller.php">Add New Seller</a></li>
                        <li><a href="addissuer.php">Add Stock Issuer</a></li>
                        <li><a href="addscrapreceiver.php">Add Scrap Receiver</a></li>
                        <li><a href="addrackinstore.php">Add Rack In Store</a></li>
                        <li><a href="manageprivacy.php">Manage Privacy Settings</a></li>
                    </ul>
                </li>
                <li
                    <?php
                    if (stripos($_SERVER['REQUEST_URI'], 'addpurchase.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'issuepage.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'return.php')   )
                    {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#">Perform Transactions</a>
                    <ul>
                        <li><a href="addpurchase.php">Make Purchase</a></li>
                        <li><a href="issuepage.php">Issue From Stock</a></li>
                        <li><a href="return.php">Receive Scrap Back</a></li>
                    </ul>
                </li>
                <li
                <?php
                    if (stripos($_SERVER['REQUEST_URI'], 'purchasereport.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'stockreport.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'stockissuereport.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'scrapreport.php') ||
                        stripos($_SERVER['REQUEST_URI'], 'stocktransactionreport.php')  )
                    {
                        echo 'class="active"';
                    }
                ?>>
                    <a href="#">Reports</a>
                    <ul>
                        <li><a href="purchasereport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1">Purchase Report</a></li>
                        <li><a href="stockreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1">Stock Report</a></li>
                        <li><a href="stockissuereport.php?date1=&date2=&part=-1&issue=-1&pick=&brand=-1">Stock Issue Report</a></li>
                        <li><a href="scrapreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1">Scrap Report</a></li>
                        <li><a href="stocktransactionreport.php?date1=&date2=&part=-1&brand=-1&buyer=-1&seller=-1">Bin Card Report</a></li>
                    </ul>
                </li>
                <li
                <?php
                    if (stripos($_SERVER['REQUEST_URI'], 'addpurchase.php'))
                    {
                        //echo 'class="active"';
                    }
                ?>>
                <a href="addpurchase.php">Make Purchase</a></li>
                <li><a href="index.php">Home</a></li>


                <!--<li <?php /*if (stripos($_SERVER['REQUEST_URI'], 'activityreport.php')) {
                    echo 'class="active"';
                } */?>><a href="activityreport.php">Activity Report</a></li>-->
            </ul>
        </span>
</div>
<!---------------------------------------------   Naviagtion Bar End Moiz   ------------------------------------------>



