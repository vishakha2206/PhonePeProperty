<?php
	header('Content-type: application/json');
    include "../connection.php";

    $query_latestactivity = $conn->query("select * from tblactivitylog order by date desc limit 15");

    if($query_latestactivity->num_rows != 0) 
    {
    	while($result = $query_latestactivity->fetch_assoc())
    	{
    		$res['staffid'] = $result['staffid'];
    		$res['description'] = $result['description'];
    		$res['date'] = $result['date'];
    		$res1[] = $res;
    	}
    	//$res2["latestactivity"] = $res1;

    	echo json_encode(array("success"=>"true","data"=>$res1));
    }
    else
    {
    	echo json_encode(array("success"=>"false"));
    }

?>