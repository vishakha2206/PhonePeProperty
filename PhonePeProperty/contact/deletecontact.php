<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		$query_delete = $conn->query("delete from tblcontacts where userid='".$userid."'");
		echo $res = json_encode(array("success"=>true,"message"=>"Customer deleted Succesfully."));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Something went wrong."));
	}
?>