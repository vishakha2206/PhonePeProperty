<?php
	header('Content-type: application/json');
    include "../connection.php";

    $query_countries = $conn->query("select country_id , short_name from tblcountries");

    if($query_countries->num_rows != 0)
    {
    	$result_countries = $query_countries->fetch_assoc();
    	$res1['$country_id'] = $result_countries['$country_id'];
    	$res1['$short_name'] = $result_countries['$short_name'];

    	$res['countries'] = $res1;
    	echo $res = json_encode(array("success"=>true,"data"=>$res));
    }
    else
    	echo $res = json_encode(array("success"=>false,"data"=>"not found"));
?>