<?php
    header('Content-type: application/json');
    include "./connection.php";

	if(isset($_REQUEST['name']))) {
		$field_name = $_REQUEST['field_name'];
		$field_belongs = $_REQUEST['field_belongs'];
		$field_type = $_REQUEST['field_type'];
		$field_bs_column = $_REQUEST[]