<?php
    header('Content-type: application/json');
    include "../connection.php";

    if(isset($_REQUEST['name']))
    {
        //$userid = $_REQUEST['userid'];
        $company = $_REQUEST['name'];
        $address = $_REQUEST['address'];
        //$vat_num = $_REQUEST['vat'];
        $city = $_REQUEST['city'];
        $phone = $_REQUEST['phonenumber'];
        $website = $_REQUEST['website'];
        //$state = $_REQUEST['state'];
        $zipcode = $_REQUEST['zip'];
        //$country = $_REQUEST['country'];
        $datecreated = date('Y-m-d H:i:s');

        /*$billing_street = $_REQUEST['billing_street'];
        $billing_city = $_REQUEST['billing_city'];
        $billing_state = $_REQUEST['billing_state'];
        $billing_zip = $_REQUEST['billing_zip'];
        $billing_country = $_REQUEST['billing_country'];

        $shipping_street = $_REQUEST['shipping_street'];
        $shipping_city = $_REQUEST['shipping_city'];
        $shipping_state = $_REQUEST['shipping_state'];
        $shipping_zip = $_REQUEST['shipping_zip'];
        $shipping_country = $_REQUEST['shipping_country'];*/

        $projectid = 7; 
        $projects = $_REQUEST['projects'];

        $interestedid = 5;
        $interested = $_REQUEST['interested'];

        $replyid = 6;
        $reply = $_REQUEST['reply'];

        $query_newcustomer = "insert into 
                        tblclients(`company`,`vat`,`phonenumber`,`country`,`city`,`zip`,`state`,`address`,`website`,`datecreated`,`active`,`leadid`,`billing_street`,`billing_city`,`billing_state`,`billing_zip`,`billing_country`,`shipping_street`,`shipping_city`,`shipping_state`,`shipping_zip`,`shipping_country`,`addedfrom`) 
                        values('".$company."' , NULL , '".$phone."' , 0 , '".$city."' , '".$zipcode."' , NULL , '".$address."' , '".$website."' , '".$datecreated."' ,1, NULL , NULL , NULL, NULL ,NULL, NULL , NULL , NULL , NULL , NULL , NULL ,1)";

        mysqli_query($conn,$query_newcustomer) or die(mysqli_error($conn));

        $customer_id = $conn->insert_id;

        $query_project = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values ('".$customer_id."','".$projectid."','customers','".$projects."')";
        mysqli_query($conn,$query_project) or die(mysqli_error($conn));

        $query_interest = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values ('".$customer_id."','".$interestedid."','customers','".$interested."')";
        mysqli_query($conn,$query_interest) or die(mysqli_error($conn));

        $query_reply = "insert into tblcustomfieldsvalues (`relid`,`fieldid`,`fieldto`,`value`) values ('".$customer_id."','".$replyid."','customers','".$reply."')";
        mysqli_query($conn,$query_reply) or die(mysqli_error($conn));

        echo $res = json_encode(array("success"=>true,"message"=>"New customer added."));
    }
    else
        echo $res = json_encode(array("success"=>false,"message"=>"Ops something went wrong")); 

?>