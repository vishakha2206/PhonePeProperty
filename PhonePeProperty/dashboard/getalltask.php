<?php
	header('Content-type: application/json');
	include "../connection.php";

	
	$query_reminder = $conn->query("select * from tblstafftasks order by startdate asc");
	//$query_reminder = $conn->query("select * from tblreminders order by date desc limit 5");

		if($query_reminder->num_rows != 0)
		{

			while($result = $query_reminder->fetch_assoc())
			{
				
				$res['name'] = $result['name'];
				$res['status'] = $result['status'];
				$res['startdate'] = $result['startdate'];
				$res['duedate'] = $result['duedate'];
				$res['priority'] = $result['priority'];
				
				$res1[] = $res;
			}
			
			
			echo $res = json_encode(array("success"=>"true","data"=>$res1));		
		}
		else
		{
			echo $res = json_encode(array("success"=>"false","message"=>"Something went wrong"));
		}

	
?>