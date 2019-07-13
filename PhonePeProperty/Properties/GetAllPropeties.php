<?php
	header('Content-type: application/json');
	include '../connection.php';
	$quary1 = "SELECT * FROM `tblitems` WHERE 1";
	$result1 = mysqli_query($conn,$quary1);
	while($row =mysqli_fetch_assoc($result1) )
	{
		
		
		$row1['id'] = $row["id"];
		$row1['project_title'] = $row["description"];
		$row1['area'] = $row["long_description"];
		$row1['rate'] = $row["rate"];
		$group = $row["group_id"];
		$relid  = $row['id'];

		$quary2 = "SELECT * FROM `tblitems_groups` WHERE id = $group";
		$result2 = mysqli_query($conn,$quary2);
		$row2 = mysqli_fetch_assoc($result2);
		$row1['property_type'] = $row2['name'];
		
		$quary3 = "SELECT * FROM `tblcustomfieldsvalues` WHERE relid = $relid and fieldid >= 9 and fieldid <= 16;" ;
		$result3 = mysqli_query($conn,$quary3);

		while($row3 =mysqli_fetch_assoc($result3) ) //Custom fields
		{
			$fieldid = $row3['fieldid'];
			$quary4 = "SELECT name FROM `tblcustomfields` WHERE id = $fieldid ";
			$result4 = mysqli_query($conn,$quary4);
			$row4 = mysqli_fetch_assoc($result4);
			$field_name = $row4['name'];
			$row1[$field_name] = $row3['value'];
		}
		$out[] = $row1;
		
	}
	echo json_encode(array("success"=>"true","data"=>$out));


?>