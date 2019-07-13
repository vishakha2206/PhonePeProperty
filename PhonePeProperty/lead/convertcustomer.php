<?php
	header("Content-type: application/json");
	include "../connection.php";

	if(isset($_REQUEST['userid']))
    {
    	$userid = $_REQUEST['userid'];

		$query_profile = $conn->query("select * from tblleads where id = ".$userid."");

		while($result = $query_profile->fetch_assoc())
				{

					$res1['Firstname'] = strtok($result['name'], ' ');
					$res1['Lastname'] = strstr($result['name'], ' ');
					$res1['email'] = $result['email'];
					$res1['phonenumber'] = $result['phonenumber'];
					//$res1['website'] = $result['website'];
					$res1['company'] = $result['company'];
					$res1['address'] = $result['address'];
					$res1['city'] = $result['city'];
					$res1['state'] = $result['state'];
					
					$res2[] = $res1;
				}

				$res["profile"] = $res2;


				$query_custom = $conn->query("select value from tblcustomfieldsvalues where relid='".$userid."' AND fieldto='leads' ");

					while($result = $query_custom->fetch_assoc())
					{

					$res3['value'] = $result['value'];
					$res4[] = $res3;
				}
					//$res3['value'] = $result['value'];
				//	$res4[] = $res3;
			

				$res["custom"] = $res4;

				echo  json_encode(array("success"=>true,"data"=>$res));
    }
    else 
    {
		echo $res = json_encode(array("success"=>false));
	}
?>