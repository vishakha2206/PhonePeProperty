<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		$query_delete = "delete from tblreminders where rel_id = '".$userid."' and rel_type='lead'";
		mysqli_query($conn,$query_delete) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Reminder deleted Succesfully."));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Something went wrong."));
	}
?>