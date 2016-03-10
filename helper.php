<?php
require_once('mysqlcon/mysql1.php');
function trackable($brandid,$partid)
{
    $qry="select trackable from junctionbp where idBrand='$brandid' and idPart='$partid' ";
    $result=mysql_query($qry) or die(mysql_error());
    $row=mysql_fetch_assoc($result);
    $trackable=$row['trackable'];
    //echo"<script>alert(".$trackable.");</script>";
    return $trackable;
}
//$val=trackable(2,16);
//echo $val;
function getPart($partid)
{
    $qry="select * from part where idPart='$partid' ";
    $result=mysql_query($qry) or die(mysql_error());
    $row=mysql_fetch_assoc($result);
    $part['partid']=$row['idStore'];
    $part['storeid']=$row['idStore'];
    $part['partname']=$row['partName'];
    $part['parttype']=$row['partType'];
    $part['partnumber']=$row['partNumber'];
    $part['datepartcreated']=$row['datePartCreated'];
    //print_r($part);
    //echo"<script>alert(".$trackable.");</script>";
    return $part;
}
//$part=getPart(3);
//echo $part['partid'];



function getBrand($brandid)
{
    $qry="select * from brand where idBrand='$brandid' ";
    $result=mysql_query($qry) or die(mysql_error());
    $row=mysql_fetch_assoc($result);
    $brand['brandid']=$row['idBrand'];
    $brand['brandname']=$row['brandName'];
    $brand['datebrandcreated']=$row['dateBrandCreated'];
    //print_r($brand);
    return $brand;
}
//$brand=getBrand(3);
//echo $brand['brandname'];

function getIssuer($issuerid)
{
    $qry="select * from Issue where idIssue='$issuerid' ";
    $result=mysql_query($qry) or die(mysql_error());
    $row=mysql_fetch_assoc($result);
    $issuer['issuerid']=$row['idIssue'];
    $issuer['issuername']=$row['name'];
    $issuer['dateissuercreated']=$row['dateCreated'];
    //print_r($issuer);
    return $issuer;
}
//$issuer=getIssuer(1);
//echo $issuer['issuername'];
?>
