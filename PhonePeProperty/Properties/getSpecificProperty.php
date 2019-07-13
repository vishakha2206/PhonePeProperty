<?php  
	header('Content-type: application/json');
	include '../connection.php';

	if(isset($_REQUEST['id'])) {

		$id = $_REQUEST['id'];
		$query1 = "select * from tblitems where id=$id";
		$result1 = mysqli_query($conn,$query1);
		$row =mysqli_fetch_assoc($result1);
		$group = $row["group_id"];

		$query2 = "SELECT * FROM `tblitems_groups` WHERE id = $group";
		$result2 = mysqli_query($conn,$query2);
		$row2 = mysqli_fetch_assoc($result2);

		$row1['property_type'] = $row2['name'];
		$row1['project_title'] = $row['description'];	
		$row1['area'] = $row["long_description"];
		$row1['rate'] = $row["rate"];

		$relid  = $row['id'];
		$query3 = "SELECT * FROM `tblcustomfieldsvalues` WHERE relid = $relid and fieldid >=9  and fieldid <= 16;" ;
		$result3 = mysqli_query($conn,$query3);

		while($row3 =mysqli_fetch_assoc($result3) ) //Custom fields
		{
			$fieldid = $row3['fieldid'];
			$query4 = "SELECT name FROM `tblcustomfields` WHERE id = $fieldid ";
			$result4 = mysqli_query($conn,$query4);
			$row4 = mysqli_fetch_assoc($result4);
			$field_name = $row4['name'];
			$row1[$field_name] = $row3['value'];
		}

		echo json_encode(array("data"=>$row1));
		mysqli_close($conn);

	} else {
		echo json_encode(array("success"=>"false"));
	}
?>