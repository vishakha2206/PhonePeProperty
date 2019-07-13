<?php
	include './connection.php';
	
	if(isset($_REQUEST['email']) && $_REQUEST['password'])
	{
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		//$itoa64_1 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$iteration_count_log = 8;
		$portable_hashes = false;
		$random_state = microtime();
		$random_state .= getmypid();
		$count1 = 16;

		/*$query_get = $conn->query("select email,password from tblstaff WHERE email = ".$uname." AND password = ".$pass."");*/
		
		$query_get = $conn->query("select * from tblstaff WHERE email = '".$email."'");

		if($query_get->num_rows != 0) 
		{
			$result = $query_get->fetch_assoc();
			$res['password'] = $result['password'];
			$setting = $res['password'];

			$output = '*0';
        		if (substr($setting, 0, 2) == $output) 
        		{
           		 	$output = '*1';
        		}
       			 $id = substr($setting, 0, 3);
        		# We use "$P$", phpBB3 uses "$H$" for the same thing
        		if ($id != '$P$' && $id != '$H$') 
        		{
            		$hash =  $output;
       			 }
      			
       			$count_log2 = strpos($itoa64, $setting[3]);
        		if ($count_log2 < 7 || $count_log2 > 30) 
        		{
           			 $hash =  $output;           			 
       			}
       			
        		$count = 1 << $count_log2;
      		    $salt  = substr($setting, 4, 8);
        		if (strlen($salt) != 8) 
        		{
            		$hash = $output;            		
        		}
        		
        		// We're kind of forced to use MD5 here since it's the only
        		// cryptographic primitive available in all versions of PHP
        		// currently in use.  To implement our own low-level crypto
        		// in PHP would result in much worse performance and
        		// consequently in lower iteration counts and hashes that are
        		// quicker to crack (by non-PHP code).
        		if (PHP_VERSION >= '5') 
        		{
           			 $hash1 = md5($salt . $password, true);
            		do 
            		{
               		 	$hash1 = md5($hash1 . $password, true);
            		} while (--$count);
       			} 
       			else 
       			{
           			$hash1 = pack('H*', md5($salt . $password));
           			do 
           			{
                		$hash1 = pack('H*', md5($hash1 . $password));
           			} while (--$count);
        		}
        		$output = substr($setting, 0, 12);

        		    $output1 = '';
        		    $input = $hash1;
                $i = 0;
        	do 
        	{
            	$value = ord($input[$i++]);
            	$output1 .= $itoa64[$value & 0x3f];

            //echo $output1;
        		//echo "</br>";
            if ($i < $count1) 
            {
                $value |= ord($input[$i]) << 8;
            }

            $output1 .= $itoa64[($value >> 6) & 0x3f];

            if ($i++ >= $count1) 
            {
                break;
            }
            if ($i < $count1) 
            {
                $value |= ord($input[$i]) << 16;
            }

            $output1 .= $itoa64[($value >> 12) & 0x3f];

            if ($i++ >= $count1) 
            {
                break;
            }

            $output1 .= $itoa64[($value >> 18) & 0x3f];
          } while ($i < $count1);

          $output .= $output1;

        		//$output .= base64_encode($hash);

        		$hash .= $output;
        		if ($hash[0] == '*') 
        		{
        			 $hash = crypt($password, $setting);
        		}

        		//echo $hash;
        		//echo "</br>";
        		//echo $setting;

        		if(hash_equals($setting, $hash) == true)
        		{
        			echo json_encode(array("success"=>true,"message"=>"Correct user"));
        		}

        		/*if($pass = $res['password'])
        		{
        			echo json_encode(array("success"=>true,"message"=>"Correct user"));
        		}*/
			else
				{
					echo json_encode(array("success"=>false,"message"=>"Invalid password"));
				}			
		}
		else
		{
			echo json_encode(array("success"=>false,"message"=>"Invalid email"));
		}
	}
	else
		echo $res = json_encode(array("success"=>false,"message"=>"Please enter email and password"));		
?>