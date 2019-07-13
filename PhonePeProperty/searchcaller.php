<?php
    header('Content-type: application/json');
    include "./connection.php";
    //include "./functions.php";

	if(isset($_REQUEST['mobile'])) {
		$mobile = $_REQUEST['mobile'];
		$call_state = $_REQUEST['call_state'];
		if($call_state == 1) {
		    $activity_description = "Incoming call from - ".$_REQUEST['mobile'];
		} 
		else {
		    $activity_description = "Outgoing call to - ".$_REQUEST['mobile'];   
		}
		$dateadded = date('Y-m-d H:i:s');

		// Activity code
		$query_activity = "insert into tblactivitylog (`description`,`date`,`staffid`) values ('".$activity_description."','".$dateadded."','Ashutosh Real Estate')";
		mysqli_query($conn,$query_activity) or die(mysqli_error($conn));
		// Activity code
		
		$query_clients = $conn->query("select * from tblclients where phonenumber like '%".$mobile."%'");
		$query_leads = $conn->query("select * from tblleads where lost=0 and phonenumber like '%".$mobile."%'");

		if($query_clients->num_rows != 0){
			$result = $query_clients->fetch_assoc();
			$res["id"] = $result['userid'];				
			$res["name"] = ucwords(strtolower($result['company']));
			$res["mobile"] = $result['phonenumber'];
			$res["url"] = "https://clickncount.com/crm/admin/clients/client/".$result['userid']."?group=profile";
			
			$query_note = $conn->query("select * from tblnotes where rel_type='customer' and rel_id=".$result['userid']." order by dateadded desc limit 1");
			$result_note = $query_note->fetch_assoc();
			$res["note"] = $result_note['description'];

			echo $res = json_encode(array("success"=>true,"data"=>$res));
		}
		else if($query_leads->num_rows != 0) {
			$result = $query_leads->fetch_assoc();
			$res["id"] = $result['id'];				
			$res["name"] = ucwords(strtolower($result['name']." ".$result['company']));
			$res["mobile"] = $result['phonenumber'];
			$res["url"] = "https://clickncount.com/crm/admin/leads/index/".$result['id'];

			$query_note = $conn->query("select * from tblnotes where rel_type='lead' and rel_id=".$result['id']." order by dateadded desc limit 1");
			$result_note = $query_note->fetch_assoc();
			if($result_note['date_contacted'] != null) { 
				$res["note"] = date('d-m-Y', strtotime($result_note['date_contacted']))." - ".$result_note['description'];
			}
			else {
				$res["note"] = $result_note['description'];
			}

			// Activity code
			$query_leadactivity = "insert into tblleadactivitylog (`leadid`,`description`,`date`,`staffid`,`full_name`,`custom_activity`) values (".$result['id'].",'".$activity_description."','".$dateadded."',1,'Ashutosh Real Estate',0)";
			mysqli_query($conn,$query_leadactivity) or die(mysqli_error($conn));
			// Activity code

			echo $res = json_encode(array("success"=>true,"data"=>$res));
		}
		else {
			echo $res = json_encode(array("success"=>false));
		}
	}
	else {
		echo $res = json_encode(array("success"=>false));
	}

	
?>
