<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		$query_note = "delete FROM tblnotes where rel_id = '".$userid."' and rel_type='lead'";
		mysqli_query($conn,$query_note) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Note deleted Succesfully."));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Something went wrong."));
	}
?>