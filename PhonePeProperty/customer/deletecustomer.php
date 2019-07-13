<?php

	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		/*$query_customer = "delete FROM tblclients,tblcontacts WHERE tblclients.userid = tblcontacts.userid  AND userid = '".$userid."'";*/

		$query_customer = "delete a.* , b.* FROM tblclients as a , tblcontacts as b WHERE a.userid = b.userid  AND a.userid = '".$userid."'";
		mysqli_query($conn,$query_customer) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Customer deleted Succesfully."));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Something went wrong."));
	}

?>