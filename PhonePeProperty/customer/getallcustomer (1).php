<?php
	header('Content-type: application/json');
    include "connection.php";

	
		$query_clients = $conn->query("select * from tblclients C, tblcontacts Co WHERE C.userid = Co.userid ");

		$userid = $_REQUEST['userid'];

		$query_projectname = $conn->query("select * from tblcustomfieldsvalues cv , tblcustomfields c , tblcontacts co WHERE c.id = cv.fieldid AND cv.fieldto = 'customers' AND c.slug = 'customers_project_name' AND cv.relid = co.id");

	/*	$query_interested = $conn->query("select * from tblcustomfieldsvalues cv , tblcustomfields c WHERE c.id = cv.fieldid AND cv.fieldto = 'customers'");*/

		if($query_clients->num_rows != 0) 
		{
			while($result = $query_clients->fetch_assoc())
			{
				$res1["userid"] = $result["userid"];
				$res1["primary_contact"] = $result["firstname"]." ".$result["lastname"];
				$res1["company"] = $result["company"];
				$res1["phone"] = $result["phonenumber"];
				$result2 = $query_projectname->fetch_assoc();
				$res1["value"] = $result2["value"];
				$res1["active"] = $result["active"];
				$res1["datecreated"] = $result["datecreated"];
				//$res1["value"] = $result2["value"];

				$res2[] = $res1;
			}
			$res["clients"] = $res2;

			/*while($result = $query_projectname->fetch_assoc()) 
			{
				$res4["value"] = $result["value"];

			}
			$res["interested"] = $res4;*/

			echo $res = json_encode(array("success"=>"true","data"=>$res));

		}
		else
		{
			echo json_encode(array("success"=>"false"));
		}
?>
