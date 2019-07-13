<?php 
	header('Content-type: application/json');
    include "../connection.php";

    if(isset($_REQUEST['userid']) && isset($_REQUEST['description'])) 
    {
    	$userid = $_REQUEST['userid'];
		$description = $_REQUEST['description'];
		$datenotified = $datecontact= date('Y-m-d H:i:s');

		//$reminderto = $_REQUEST('');
		if(isset($_REQUEST['date'])) 
		{
			$datecontact = date('Y-m-d H:i:s', strtotime($_REQUEST['date']));
		}

		$query_reminder = "insert into tblreminders(`rel_id`,`rel_type`,`description`,`date`,`isnotified`,`staff`,`notify_by_email`,`creator`) 
			values(".$userid." , 'customer' , '".$description."' , '".$datecontact."' , 1 , 1 , 0 , 1 )";

		mysqli_query($conn , $query_reminder) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Reminder added successfully"));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Reminder not added"));
	}
 ?>		
		
