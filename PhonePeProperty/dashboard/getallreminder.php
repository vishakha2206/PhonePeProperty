<?php
	header('Content-type: application/json');
	include "../connection.php";

	
	$query_reminder = $conn->query("select r.rel_id,l.name,r.description,r.date from tblreminders r, tblleads l where r.rel_id=l.id order by r.date desc limit 5");
	//$query_reminder = $conn->query("select * from tblreminders order by date desc limit 5");

		if($query_reminder->num_rows != 0)
		{

			while($result = $query_reminder->fetch_assoc())
			{
				//$res['id'] = $result['rel_id'];
				$res['name'] = $result['name'];
				$res['description'] = $result['description'];
				$res['date'] = $result['date'];
				
				$res1[] = $res;
			}
			
			
			echo $res = json_encode(array("success"=>"true","data"=>$res1));		
		}
		else
		{
			echo $res = json_encode(array("success"=>"false","message"=>"Something went wrong"));
		}

	
?>