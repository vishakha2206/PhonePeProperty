<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];
		$name = $_REQUEST['name'];
		$description = $_REQUEST['description'];
		$mobile = $_REQUEST['mobile'];
		$address = $_REQUEST['address'];
		$email = $_REQUEST['email'];
		$assigned = $_REQUEST['staffid'];
		$status = $_REQUEST['status'];
		$source = $_REQUEST['source'];
		$city = $_REQUEST['city'];
		$lastcontact = $datecontact = date('Y-m-d H:i:s');
		if(isset($_REQUEST['date'])) {
			$datecontact = date('Y-m-d H:i:s', strtotime($_REQUEST['date']));
		}

		$projectid = $_REQUEST['projectid'];
		$projects = $_REQUEST['projects'];

		$interestedid = $_REQUEST['interestedid'];
		$interested = $_REQUEST['interested'];

		$replyid = 2;
		$reply = $_REQUEST['reply'];

		$query_lead = "update tblleads SET name='".$name."',address='".$address."',email='".$email."',city='".$city."',
		description='".$description."',phonenumber='".$mobile."',lastcontact='".$lastcontact."',status='".$status."',source='".$source."',assigned='".$assigned."' where id = '".$userid."'";
		mysqli_query($conn,$query_lead) or die(mysqli_error($conn));

		$query_project = "update tblcustomfieldsvalues SET value='".$projects."' where relid='".$userid."' and fieldid='".$projectid."'";
		mysqli_query($conn,$query_project) or die(mysqli_error($conn));

		$query_interest = "update tblcustomfieldsvalues SET value='".$interested."' where relid='".$userid."' and fieldid='".$interestedid."'";
		mysqli_query($conn,$query_interest) or die(mysqli_error($conn));

		$query_reply = "update tblcustomfieldsvalues SET value='".$reply."' where relid='".$userid."' and fieldid='".$replyid."'";
		mysqli_query($conn,$query_reply) or die(mysqli_error($conn));


		echo json_encode(array("success"=>"true","message"=>"Successfully updated"));
	}
	else
	{
		echo json_encode(array("success"=>"false","message"=>"Something went wrong"));
	}

?>