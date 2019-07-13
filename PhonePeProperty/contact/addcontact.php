<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
    {
    	$userid = $_REQUEST['userid'];
    	$firstname = $_REQUEST['firstname'];
    	$lastname = $_REQUEST['lastname'];
    	$email = $_REQUEST['email'];
    	$phonenumber = $_REQUEST['phonenumber'];
    	$password = $_REQUEST['password'];
    	$datecreated = date('Y-m-d H:i:s');

    	$query_contact = "insert into tblcontacts 
    		(`userid` , `is_primary` , `firstname` , `lastname` , `email` , `phonenumber` , `title` , `datecreated` , `password`, `new_pass_key` , `new_pass_key_requested` , `last_ip` , `last_login` , `last_password_change` , `active` , `profile_image` , `direction` , `invoice_emails` , `estimate_emails` , `credit_note_emails` , `contract_emails` , `task_emails` , `project_emails` , `ticket_emails`) 
    			values ('".$userid."' , 1 , '".$firstname."' , '".$lastname."' , '".$email."' , '".$phonenumber."' , 'NULL' , '".$datecreated."' , '".$password."' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 1 , 'NULL' , 'NULL' , 1 , 1 , 'NULL' , 1 , 'NULL' , 1 , 'NULL')";

    			mysqli_query($conn,$query_contact) or die(mysqli_error($conn));

    	echo $res = json_encode(array("success"=>true,"message"=>"New contact added."));
    }
    else
		echo $res = json_encode(array("success"=>false,"message"=>"customer not added."));	

?>