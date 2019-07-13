<?php
	header("Content-type: application/json");
	include "../connection.php";


	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		$query_profile = $conn->query("select * from tblclients where userid='".$userid."'");

		$query_reminder = $conn->query("select * from tblreminders where rel_id = ".$userid." and rel_type = 'customer' order by date desc limit 2");

		$query_note = $conn->query("select * from tblnotes where rel_type='customer' and rel_id=".$userid." order by dateadded desc limit 5");

		$query_contact = $conn->query("select * from tblcontacts where userid = '".$userid."'");

		$query_task=$conn->query("select * from tblstafftasks where rel_type='customer' and rel_id='".$userid."' order by dateadded desc limit 10");

		$query_customfields = $conn->query("select * from tblcustomfieldsvalues where fieldto='customers' AND relid='".$userid."' ");

		/*$query_tasks = $conn->query("select name,status,startdate,duedate,priority from tblstafftasks where rel_id=".$userid." order by dateadded desc limit 5");
		*/

		//$query_activitylog = $conn->query("select")
		//$res=$res1=$res2=$res3=array();

		//if($query_profile->num_rows != 0) 
		//{
			while($result = $query_profile->fetch_assoc())
			{

			$res1['company'] = $result['company'];
			$res1['address'] = $result['address'];
			$res1['city'] = $result['city'];	
			$res1['state'] = $result['state'];
			$res1['zip'] = $result['zip'];
			$res1['phonenumber'] = $result['phonenumber'];
			$res1['website'] = $result['website'];

			/*
			$res1['billing_street'] = $result['billing_street'];
			$res1['billing_city'] = $result['billing_city'];
			$res1['billing_state'] = $result['billing_state'];
			$res1['billing_zip'] = $result['billing_zip'];
			$res1['billing_country'] = $result['billing_country'];

			$res1['shipping_street'] = $result['shipping_street'];
			$res1['shipping_city'] = $result['shipping_city'];
			$res1['shipping_state'] = $result['shipping_state'];
			$res1['shipping_zip'] = $result['shipping_zip'];
			$res1['shipping_country'] = $result['shipping_country'];
			*/
			$res2[] = $res1;
			}
				$res["profile"] = $res2;

			while($result = $query_reminder->fetch_assoc()) 
			{
				$res3['date'] = $result['date'];
				$res3['description'] = $result['description'];
				$res3['isnotified'] = $result['isnotified'];
				$res4[] = $res3;
			}
			$res["reminder"] = $res4;


			while($result = $query_note->fetch_assoc()) 
			{
				$res5['description'] = $result['description'];
				$res5['addedfrom'] = $result['addedfrom'];
				$res5['dateadded'] = $result['dateadded'];
				$res6[] = $res5;
			}
			$res["note"] = $res6;

			while($result = $query_contact->fetch_assoc())
			{
				$res7['userid'] = $result['userid'];
				$res7['firstname'] = $result['firstname'];
				$res7['lastname'] = $result['lastname'];
				$res7['email'] = $result['email'];
				$res7['phonenumber'] = $result['phonenumber'];
				$res7['last_login'] = $result['last_login'];
				$res7['active'] = $result['active'];

				$res8[] = $res7;
			}

			$res["contact"] = $res8;

			while($result = mysqli_fetch_assoc($query_task))
				{
					$res9['name'] = $result['name'];
					$res9['status'] = $result['status'];
					$res9['hourly_rate'] = $result['hourly_rate'];
					$res9['startdate'] = $result['startdate'];
					$res9['duedate'] = $result['duedate'];
					$res9['priority'] = $result['priority'];
					
					$res10[] = $res9;
				}

			$res["tasks"] = $res10;


			while($result = mysqli_fetch_assoc($query_customfields))
				{
					$fieldid = $result['fieldid'];
					$query4 = "SELECT name FROM `tblcustomfields` WHERE id = '".$fieldid."' ";
					$result4 = mysqli_query($conn,$query4);
					$row4 = mysqli_fetch_assoc($result4);
					$field_name = $row4['name'];
					$row1[$field_name] = $result['value'];
					
				}

			$res["customfields"] = $row1;

			echo json_encode(array("success"=>true,"data"=>$res));
		//}
	}
	else
		{
			echo json_encode(array("success"=>false,"msg"=>"problem"));
		}
?>