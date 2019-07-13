<?php
	header('Content-type: application/json');
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		
		$userid = $_REQUEST['userid'];
		$query_reminder = $conn->query("select description,date from tblreminders where rel_id = ".$userid." and rel_type = 'lead' order by date desc limit 2");

		if($query_reminder->num_rows !=0)
		{

			while($result = $query_reminder->fetch_assoc())
			{
				$res['date'] = $result['date'];
				$res['description'] = $result['description'];
				$res1[] = $res;
			}
			
			
			echo $res = json_encode(array("success"=>"true","data"=>$res1));		
		}

	}
	else
		{
			echo $res = json_encode(array("success"=>"false","msg"=>"problem"));		
		}
?>