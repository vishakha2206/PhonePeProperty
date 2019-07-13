<?php
	header('Content-type: application/json');
	include "../connection.php";


	if(isset($_REQUEST['description']))
	{
		$description = $_REQUEST['description'];
		$dateadded = date('Y-m-d H:i:s');

		$query_todo = "insert into tbltodoitems(`description`,`staffid`,`dateadded`,`finished`,`datefinished`,`item_order`)
						values('".$description."' , 1 , '".$dateadded."' , 0 , NULL , NULL)";

		mysqli_query($conn,$query_todo) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Todo list added."));
	}
	else
		echo $res = json_encode(array("success"=>false,"message"=>"Todo list not added."));	
?> 