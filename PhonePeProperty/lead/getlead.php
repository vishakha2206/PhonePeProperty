<?php
	header("Content-type: application/json");
	include "../connection.php";


	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];

		$query_profile = $conn->query("select * from tblleads where id = ".$userid."");

		$query_tasks = $conn->query("select * from tblstafftasks where rel_id=".$userid." order by dateadded desc limit 15");

		$query_reminder = $conn->query("select * from tblreminders where rel_id = ".$userid." and rel_type = 'lead' order by date asc limit 15");

		$query_note = $conn->query("select * from tblnotes where rel_type='lead' and rel_id=".$userid." order by dateadded desc limit 15");

		$query_customfields = $conn->query("select * from tblcustomfieldsvalues where fieldto='leads' AND  relid='".$userid."' ");

		while($result = $query_profile->fetch_assoc())
				{

					$res1['name'] = $result['name'];
					$res1['email'] = $result['email'];
					$res1['phonenumber'] = $result['phonenumber'];
					$res1['website'] = $result['website'];
					$res1['company'] = $result['company'];
					$res1['address'] = $result['address'];
					$res1['city'] = $result['city'];
					$res1['state'] = $result['state'];
					$res1['description'] = $result['description'];
					$res1['status'] = $result['status'];
					$res1['source'] = $result['source'];
					$res1['assigned'] = $result['assigned'];
					$res1['dateadded'] = $result['dateadded'];
					$res1['lastcontact'] = $result['lastcontact'];

					$res2[] = $res1;
				}

				$res["profile"] = $res2;


		while($result = $query_tasks->fetch_assoc())
				{

					$res3['name'] = $result['name'];
					$res3['status'] = $result['status'];
					$res3['startdate'] = $result['startdate'];
					$res3['duedate'] = $result['duedate'];
					$res3['priority'] = $result['priority'];
					$res4[] = $res3;

				}

				$res["task"] = $res4;

		while($result = $query_note->fetch_assoc())
				{

					$res5['dateadded'] = $result['dateadded'];
					$res5['description'] = $result['description'];
					$res6[] = $res5;

				}

				$res["notes"] = $res6;


		while($result = $query_reminder->fetch_assoc()) 
			{
				$res7['date'] = $result['date'];
				$res7['description'] = $result['description'];
				$res7['isnotified'] = $result['isnotified'];
				$res8[] = $res7;
			}
			$res["reminder"] = $res8;


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
				
		echo  json_encode(array("success"=>true,"data"=>$res));
	}
	else {
		echo $res = json_encode(array("success"=>false));
	}
?>