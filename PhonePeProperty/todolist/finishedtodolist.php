<?php
	header('Content-type: application/json');
	include "../connection.php";


		$query_todo = $conn->query("select * from tbltodoitems where finished=1");

		if($query_todo->num_rows != 0)
		{
			while($result = $query_todo->fetch_assoc())
			{
				$res['description'] = $result['description'];
				$res['dateadded'] = $result['dateadded'];
				$res1[] = $res;
			}
			
			
			echo json_encode(array("success"=>true,"data"=>$res1));
		}
		else
		{
			echo json_encode(array("success"=>false));
		
		}


		
?> 