<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];
		$firstname = $_REQUEST['firstname'];
    	$lastname = $_REQUEST['lastname'];
    	$email = $_REQUEST['email'];
    	$phonenumber = $_REQUEST['phonenumber'];
    	$password = $_REQUEST['password'];
    	//$datecreated = date('Y-m-d H:i:s');

    	$query_contact = "update tblcontacts SET firstname='".$firstname."' , lastname='".$lastname."' , email='".$email."' , phonenumber='".$phonenumber."' , password='".$password."' WHERE userid='".$userid."'";

    	mysqli_query($conn,$query_contact) or die(mysqli_error($conn));
    	echo $res = json_encode(array("success"=>true,"message"=>"customer contact updated."));
	}
	else
    {
    	echo $res = json_encode(array("success"=>false,"message"=>"customer contact not updated."));	
    }
?>