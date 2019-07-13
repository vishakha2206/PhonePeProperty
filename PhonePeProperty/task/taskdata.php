<?php
    header('Content-type: application/json');
    include "../connection.php";
    
    
	$query_priority = $conn->query("select priorityid,name from tblpriorities");
	if($query_priority->num_rows != 0){
		$result_pro = $query_priority->fetch_assoc();
		$res1["id"] = $result_pro['priorityid'];
		$res1["title"] = $result_pro['name'];
		
		$res["priority"] = $res1;
	}


	$query_interested = $conn->query("select id,name,options from tblcustomfields where id=1 and fieldto='leads' and active=1");
	if($query_interested->num_rows != 0){
		$result_intr = $query_interested->fetch_assoc();
		$res2["id"] = $result_intr['id'];
		$res2["title"] = $result_intr['name'];
		$option_intr = $result_intr['options'];
		$res2["options"] = explode(',', $option_intr);	
		
		$res["interested"] = $res2;
	}


	$query_status = $conn->query("select * from tblleadsstatus order by statusorder asc");
	if($query_status->num_rows != 0){
		while($result_status = $query_status->fetch_assoc()) {
			$res3["id"] = $result_status['id'];
			$res3["name"] = $result_status['name'];
			$res4[] = $res3;
		}
		$res["status"] = $res4;
	}


	$query_source = $conn->query("select * from tblleadssources order by id asc");
	if($query_source->num_rows != 0){
		while($result_source = $query_source->fetch_assoc()) {
			$res5["id"] = $result_source['id'];
			$res5["name"] = $result_source['name'];
			$res6[] = $res5;
		}
		
		$res["source"] = $res6;
	}


	$query_assign = $conn->query("select staffid,firstname,lastname from tblstaff where active=1 and is_not_staff=0 order by firstname asc");
	if($query_assign->num_rows != 0){
		while($result_assign = $query_assign->fetch_assoc()) {
			$res7["id"] = $result_assign['staffid'];
			$res7["name"] = $result_assign['firstname']." ".$result_assign['lastname'];
			$res8[] = $res7;
		}
		
		$res["assign"] = $res8;
	}

	/*$query_country = $conn->query("select * from tblcountries order by country_id asc");
	if($query_country->num_rows != 0){
		while($result_country = $query_country->fetch_assoc()){
			$res9["id"] = $result_country["country_id"];
			$res9["name"] = $result_country["short_name"];
			$res10[] = $res9;
		}

		$res["country"] = $res10;
	}
*/

	
	echo $res = json_encode(array("success"=>true,"data"=>$res));
?>
