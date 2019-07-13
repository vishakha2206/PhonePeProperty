<?php
	header('Content-type: application/json');
    include "../connection.php";

		$query_leads = $conn->query("select * from tblleads ORDER BY id DESC limit 500");

		if($query_leads->num_rows != 0) 
		{
			while($result = $query_leads->fetch_assoc())
			{
				$res1["id"] = $result["id"];
				$res1["name"] = $result["name"];
				$res1["phonenumber"] = $result["phonenumber"];

				$sid =  $result["status"];
				$query_status = $conn->query("SELECT name FROM `tblleadsstatus` WHERE id = $sid");
				$result2 = $query_status->fetch_assoc();
				$res1["status"] = $result2["name"];

				$res1["lastcontact"] = date("d-m-Y h:i", strtotime($result['lastcontact']));
				//$query_date = $conn->query("SELECT CONVERT (varchar, $res1['lastcontact'], 3)");

				$sourceid =  $result["source"];
				$query_source = $conn->query("SELECT name FROM `tblleadssources` WHERE id = $sourceid");
				$result3 = $query_source->fetch_assoc();
				$res1["source"] = $result3["name"];

				//$first_lastname = $result["firstname"]." ".$result["lastname"];
				$first_lastname = $result["assigned"];
				/*$query_assigned = $conn->query("SELECT tblstaff.firstname,tblstaff.lastname FROM `tblstaff` WHERE staffid = $first_lastname");*/

				$query_assigned = $conn->query("SELECT tblstaff.firstname,tblstaff.lastname FROM `tblstaff` INNER JOIN tblleads ON tblstaff.staffid = $first_lastname");
				$result4 = $query_assigned->fetch_assoc();
				$res1["assigned"] = $result4["firstname"]." ".$result4["lastname"];
				//$res['created'] = $result['created'];
				$res2[] = $res1; 

			}
			
			echo $res1 = json_encode(array("success"=>"true","data"=>$res2));

		}
		else
		{
			echo json_encode(array("success"=>false,"msg"=>"problem"));
		}
?>