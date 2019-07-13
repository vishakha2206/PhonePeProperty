<?php
	header('Content-type: application/json');
	include "../connection.php";


	if(isset($_REQUEST['todoid']))
	{

		$todoid = $_REQUEST['todoid'];
		$datefinished = date('Y-m-d H:i:s');

		$query_todo = "update tbltodoitems SET datefinished='".$datefinished."',finished=1 where todoid='".$todoid."'";

		mysqli_query($conn,$query_todo) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Todo item finished."));
	}
	else
		echo $res = json_encode(array("success"=>false,"message"=>"Todo item not finished."));	
?> 