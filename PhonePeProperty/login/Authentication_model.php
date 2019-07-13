<?php
include '../connection.php';

class Authentication_model 
{
   

    
    public function login($email, $password)
    {
        if ((!empty($email)) and (!empty($password))) {
            $table = 'tblcontacts';
            $_id   = 'id';
            if ($staff == true) {
                $table = 'tblstaff';
                $_id   = 'staffid';
            }
            $this->db->where('email', $email);
            $user = $this->db->get($table)->row();
            if ($user) {
                // Email is okey lets check the password now
               
                include('phpass_helper.php');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                
                if (!$hasher->CheckPassword($password, $user->password)) {
                    // Password failed, return
                    return false;
                }
            } else {
                echo "false"
                }
    }
}
