<?php
    $con=mysql_connect("127.0.0.1","root","");
    $databasename="masslogistics";
    mysql_select_db($databasename, $con);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>

