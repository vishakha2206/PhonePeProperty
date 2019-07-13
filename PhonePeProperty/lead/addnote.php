<?php
	header('Content-type: application/json');
	include "../connection.php";

	if(isset($_REQUEST['userid']) && isset($_REQUEST['description']))
	{
		$userid = $_REQUEST['userid'];
		$description = $_REQUEST['description'];
		$dateadded = $datecontact = date('Y-m-d H:i:s');

		if(isset($_REQUEST['date'])){
			$datecontact = date('Y-m-d H:i:s',strtotime($_REQUEST['date']));

		}

		$querynote = "insert into tblnotes(`rel_id`,`rel_type`,`description`,`date_contacted`,`addedfrom`,`dateadded`) 
		values(".$userid.",'lead','".$description."','".$datecontact."',1,'".$dateadded."')";
		mysqli_query($conn,$querynote) or die(mysqli_error($conn));

		echo $res = json_encode(array("success"=>true,"message"=>"Note added Succesfully"));
	}
	else
	{
		echo $res = json_encode(array("success"=>false,"message"=>"Oops Something went wrong"));
	}
?>