<?php
    header('Content-type: application/json');
    include "../connection.php";    
    
	$query_projects = $conn->query("select id,name,options from tblcustomfields where id=7 and fieldto='customers' and active=1");
	if($query_projects->num_rows != 0){
		$result_pro = $query_projects->fetch_assoc();
		$res1["id"] = $result_pro['id'];
		$res1["title"] = $result_pro['name'];
		$option_pro = $result_pro['options'];
		$res1["options"] = explode(',', $option_pro);	
		
		$res["projects"] = $res1;
	}


	$query_interested = $conn->query("select id,name,options from tblcustomfields where id=5 and fieldto='customers' and active=1");
	if($query_interested->num_rows != 0){
		$result_intr = $query_interested->fetch_assoc();
		$res2["id"] = $result_intr['id'];
		$res2["title"] = $result_intr['name'];
		$option_intr = $result_intr['options'];
		$res2["options"] = explode(',', $option_intr);	
		
		$res["interested"] = $res2;
	}
	
	echo $res = json_encode(array("success"=>true,"data"=>$res));
?>
