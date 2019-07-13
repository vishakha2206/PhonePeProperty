<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
    {
    	$userid = $_REQUEST['userid'];
    	$company = $_REQUEST['company'];
    	$address = $_REQUEST['address'];
    	//$vat_num = $_REQUEST['vat'];
    	$city = $_REQUEST['city'];
    	$phone = $_REQUEST['phonenumber'];
    	$website = $_REQUEST['website'];
    	//$state = $_REQUEST['state'];
    	$zipcode = $_REQUEST['zip'];
    	//$country = $_REQUEST['country'];
    	$datecreated = date('Y-m-d H:i:s');

    	/*$billing_street = $_REQUEST['billing_street'];
    	$billing_city = $_REQUEST['billing_city'];
    	$billing_state = $_REQUEST['billing_state'];
    	$billing_zip = $_REQUEST['billing_zip'];
    	$billing_country = $_REQUEST['billing_country'];

    	$shipping_street = $_REQUEST['shipping_street'];
    	$shipping_city = $_REQUEST['shipping_city'];
    	$shipping_state = $_REQUEST['shipping_state'];
    	$shipping_zip = $_REQUEST['shipping_zip'];
    	$shipping_country = $_REQUEST['shipping_country'];*/

    	$query_update = "update tblclients 
    				SET company='".$company."' , address='".$address."' , vat = NULL , city='".$city."' , phonenumber='".$phone."' , website='".$website."' , state = NULL  , zip='".$zipcode."' , country = NULL , datecreated='".$datecreated."' , billing_street = NULL , billing_city = NULL , billing_state = NULL , billing_zip = NULL , billing_country = NULL , shipping_street = NULL , shipping_city = NULL , shipping_state = NULL , shipping_zip = NULL , shipping_country = NULL WHERE userid='".$userid."'";

    	mysqli_query($conn,$query_update) or die(mysqli_error($conn));
    	echo $res = json_encode(array("success"=>true,"message"=>"customer updated."));

    }
    else
    {
    	echo $res = json_encode(array("success"=>false,"message"=>"Not updated."));	
    }
?>