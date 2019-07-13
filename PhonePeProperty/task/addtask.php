<?php
	header('Content-type: application/json');
	include '../connection.php';


	if (isset($_REQUEST['rel_id'])) 
	{
		if ( isset($_REQUEST['subject']) && isset($_REQUEST['start_date']) && isset($_REQUEST['due_date']) )
		 {
		 	$rel_id = $_REQUEST['rel_id'];
			$subject = $_REQUEST['subject'];
			$hourly_rate = $_REQUEST['hourly_rate'];
			$start_date = $_REQUEST['start_date'];
			$due_date = $_REQUEST['due_date'];
			$priority = $_REQUEST['priority'];
			$repeat = $_REQUEST['repeat_every'];
			$rel_type = "Lead";
			$related_to = $_REQUEST['related_to'];
			$lead = $_REQUEST['lead'];
			$tags = $_REQUEST['tags'];
			$task_d = $_REQUEST['task_d'];
			$public = $_REQUEST['public'];
			$billable = $_REQUEST['billable'];

			if (isset($_REQUEST['hourly_rate'])) {
				if (is_nan($hourly_rate)) {
					$hourly_rate = 0;
				}
			}
			else
			{
				$hourly_rate = 0;
			}
			
			if (!isset($_REQUEST['task_d']))
			{
				$task_d = NULL;
			}

			$quarry = "INSERT INTO`tblstafftasks`
			( `name`, `description`, `priority`, `startdate`, `duedate`,`rel_id`, `rel_type`, `is_public`, `billable`,`hourly_rate`) VALUES 
			('$subject','$task_d',$priority,'$start_date','$due_date',$rel_id,'$rel_type',$public,$billable,$hourly_rate)";

			if (mysqli_query($conn, $quarry)) {
    			echo json_encode(array('success' => 'true' ,"message"=>"Task added Succesfully"));
			} else {
    		echo "Error:". mysqli_error($conn);
		}

			mysqli_close($conn);

		}
		else
		{
			echo json_encode(array('success' => 'false' , 'data'=> 'Mandotary values no passed'));
		}
	}
	else
	{
		echo json_encode(array('success' => 'false' , 'data'=> 'rel_id no passed'));
	}








?>