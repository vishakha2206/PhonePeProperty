<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
	{
		$userid = $_REQUEST['userid'];
		$query_contact = $conn->query("select * from tblcontacts where userid = '".$userid."'");

		if($query_contact->num_rows != 0)
		{
			$result = $query_contact->fetch_assoc();

			$res['userid'] = $result['userid'];
			$res['firstname'] = $result['firstname'];
			$res['lastname'] = $result['lastname'];
			$res['email'] = $result['email'];
			$res['phonenumber'] = $result['phonenumber'];
			$res['last_login'] = $result['last_login'];
			$res['active'] = $result['active'];

			echo json_encode(array("success"=>true,"data"=>$res));
		}
		else
		{
			echo json_encode(array("success"=>false,"msg"=>"problem"));
		}
	}
?>