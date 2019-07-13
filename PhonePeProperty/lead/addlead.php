<?php
    header('Content-type: application/json');
    include "../connection.php";
  
	if(isset($_REQUEST['name']) && isset($_REQUEST['mobile'])) {
		$name = $_REQUEST['name'];
		//$description = $_REQUEST['description'];
		$mobile = $_REQUEST['mobile'];
		$address = $_REQUEST['address'];
		$email = $_REQUEST['email'];
		$assigned = $_REQUEST['staffid'];
		$status = $_REQUEST['status'];
		$source = $_REQUEST['source'];
		
		$projectid = 4;
		$projects = $_REQUEST['projects'];

		$interestedid = 1;
		$interested = $_REQUEST['interested'];

		$replyid = 2;
		$reply = $_REQUEST['reply'];
		

		$hash = md5(rand() . microtime() . time() . uniqid());
		$dateadded = $lastcontact = $datecontact = date('Y-m-d H:i:s');
		$dateassigned = date('Y-m-d');
		
		if(isset($_REQUEST['date'])) {
			$datecontact = date('Y-m-d H:i:s', strtotime($_REQUEST['date']));
		}

		$ispublic = 0;
		$country = 0;

		

		$query_lead = "insert into tblleads (`hash`,`name`,`description`,`phonenumber`,`address`,`email`,`dateadded`,`assigned`,`status`,`source`,`lastcontact`,`dateassigned`,`country`,`addedfrom`,`leadorder`,`is_public`) values ('".$hash."','".$name."',NULL,'".$mobile."','".$address."','".$email."','".$dateadded."',".$assigned.",".$status.",".$source.",'".$lastcontact."','".$dateassigned."','".$country."',1,1,".$ispublic.")";
		mysqli_query($conn,$query_lead) or die(mysqli_error($conn));

		$lead_id = mysqli_insert_id($conn);

		$query_lead = "insert into tblleadactivitylog (`leadid`,`description`,`date`,`staffid`,`full_name`,`custom_activity`) values ('".$lead_id."','not_lead_activity_created','".$dateadded."','".$assigned."','Ashutosh Real Estate',0)";
		mysqli_query($conn,$query_lead) or die(mysqli_error($conn));

		$query_project = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values (".$lead_id.",".$projectid.",'leads','".$projects."')";
		mysqli_query($conn,$query_project) or die(mysqli_error($conn));

		$query_interest = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values (".$lead_id.",".$interestedid.",'leads','".$interested."')";
		mysqli_query($conn,$query_interest) or die(mysqli_error($conn));

		$query_reply = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values (".$lead_id.",".$replyid.",'leads','".$reply."')";
		mysqli_query($conn,$query_reply) or die(mysqli_error($conn));

		if($reply!=NULL)
		{
			$query_note = "insert into tblnotes (`rel_id`,`rel_type`,`description`,`addedfrom`,`dateadded`,`date_contacted`) values (".$lead_id.",'lead','".$reply."',1,'".$dateadded."','".$datecontact."')";
			mysqli_query($conn,$query_note) or die(mysqli_error($conn));

			$query_reminder = "insert into tblreminders (`rel_id`,`rel_type`,`description`,`date`,`isnotified`,`staff`,`notify_by_email`,`creator`) values (".$lead_id.",'lead','".$reply."','".$datecontact."',0,1,0,1)";
			mysqli_query($conn,$query_reminder) or die(mysqli_error($conn));
     	   	
		}
		      
		echo $res = json_encode(array("success"=>true,"message"=>"Lead added successfully."));
	}
	else {
		echo $res = json_encode(array("success"=>false,"message"=>"Ops Something goes wrong."));
	}
?>
