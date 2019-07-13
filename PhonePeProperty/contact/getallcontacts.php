<?php
	header("Content-type: application/json");
	include "../connection.php";

	$query_contacts = $conn->query("select * from tblcontacts,tblclients where tblclients.userid = tblcontacts.userid order by firstname asc");

	if($query_contacts->num_rows != 0)
	{
		while($result = $query_contacts->fetch_assoc())
		{
			$res["firstname"] = $result["firstname"];
			$res["lastname"] = $result["lastname"];
			$res["email"] = $result["email"];
			$res["company"] = $result["company"];
			$res["phone"] = $result["phonenumber"];
			$res["active"] = $result["active"];

			$res1[] = $res;
		}

		echo $res = json_encode(array("success"=>"true","data"=>$res1));
	}
	else
	{
		echo $res = json_encode(array("success"=>"false"));

	}


?>