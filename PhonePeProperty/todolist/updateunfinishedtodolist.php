<?php
	header('Content-type: application/json');
	include "../connection.php";


	if(isset($_REQUEST['todoid']))
	{

		$todoid = $_REQUEST['todoid'];
		
		$query_todo = "update tbltodoitems SET datefinished=NULL,finished=0 where todoid='".$todoid."'";

		mysqli_query($conn,$query_todo) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Todo Status changed"));
	}
	else
		echo $res = json_encode(array("success"=>false,"message"=>"Something went wrong"));	
?> 