<?php 
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid'])) {

		$userid = $_REQUEST['userid'];
		$query_task=$conn->query("select * from tblstafftasks where rel_type='customer' and rel_id='".$userid."' order by dateadded desc limit 10");
		
		

		if($query_task->num_rows != 0){
			
			while($result = mysqli_fetch_assoc($query_task))
				{
					$res['name'] = $result['name'];
					$res['status'] = $result['status'];
					$res['hourly_rate'] = $result['hourly_rate'];
					$res['startdate'] = $result['startdate'];
					$res['duedate'] = $result['duedate'];
					$res['priority'] = $result['priority'];
					
					$res1[] = $res;
				}
			
			
			echo json_encode(array("success"=>"true","data"=>$res1));
		}

	}
	else
	{
		echo json_encode(array("success"=>"false"));
	}
?>