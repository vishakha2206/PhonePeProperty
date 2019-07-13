<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];
		$query_note = $conn->query("select * from tblnotes where rel_type='lead' and rel_id=".$userid." order by dateadded desc limit 10");

		if($query_note->num_rows != 0){

			
			while($result = $query_note->fetch_assoc())
				{

					$res['dateadded'] = $result['dateadded'];
					$res['description'] = $result['description'];
					
					$res1[] = $res;
				}
			

			echo json_encode(array("success"=>"true","data"=>$res1));
		}

	}		
		else {
		echo $res = json_encode(array("success"=>false));
	}

?>
