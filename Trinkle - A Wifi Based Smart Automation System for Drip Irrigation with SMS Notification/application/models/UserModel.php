    <?php

        
        // session_start();
        class UserModel extends CI_Model {

        	public function check_login($data){
                $password = sha1($data['password']);

                $result = $this->db->query("SELECT * FROM user WHERE username = '{$data['username']}' AND password ='{$password}'");

        		if($result->num_rows() > 0){
                    $_SESSION["userID"] = $result->row()->user_id;
                    $_SESSION["username"] = $result->row()->username;
                    $_SESSION["phoneNumber"] = $result->row()->phone_number;
                    $_SESSION["userType"] = $result->row()->type;
                    $_SESSION["first_name"] = $result->row()->first_name;
                    $_SESSION["last_name"] = $result->row()->last_name;
                    $_SESSION["receiveSMS"] = $result->row()->receiveSMS;
                    $_SESSION["hashedPassword"] = $result->row()->password;
                    $_SESSION["loggedIn"] = TRUE;
                    redirect(base_url('pages/main'));
        		}else{
                    $_SESSION['loginError'] = TRUE;
        			redirect(base_url('pages/view'));
        		}
        	}

            public function get_all_user_data(){
                $result = $this->db->query("SELECT * FROM user");
                return $result->result();
            }

            public function get_all_inactive_user_data(){
                $result = $this->db->query("SELECT * FROM user WHERE isActive = 0");
                return $result->result();
            }

            public function get_all_active_user_data(){
                $result = $this->db->query("SELECT * FROM user WHERE isActive = 1");
                return $result->result();
            }
            
            public function register_user($data){
                $password = sha1($data['password']);
                $check_existing = $this->db->query("SELECT * FROM user WHERE username = '{$data['username']}'");
                if($check_existing->num_rows() == 0){
                    $result = $this->db->query("INSERT INTO `user`(`username`, `password`, `phone_number`,  `first_name`, `last_name`,`type`) 
                                                VALUES ('{$data['username']}', '{$password}', {$data['phone']}, '{$data['fname']}', '{$data['lname']}', '{$data['userType']}')");
                }
                redirect(base_url('pages/load_userlist'));
            }

            public function set_inactive($id){
                $this->db->query("UPDATE `user` SET `isActive`= 0 WHERE user_id = {$id}");
            }

            public function set_active($id){
                $this->db->query("UPDATE `user` SET `isActive`= 1 WHERE user_id = {$id}");
            }

            public function get_specific_user_data($id){
                $result = $this->db->query("SELECT * FROM user WHERE user_id = {$id}");
                return $result->result();
            }

            public function update_user_data($data){

                
                  $this->db->query("UPDATE `user` 
                                    SET `username`=\"{$data['account_username']}\",`phone_number`={$data['account_contact']},`first_name`=\"{$data['account_fname']}\",`last_name`=\"{$data['account_lname']}\" WHERE user_id = {$data['account_id']}
                                    "); 
                    $_SESSION["first_name"] = $data['account_fname'];
                    $_SESSION["last_name"] = $data['account_lname'];
                    $_SESSION["username"] = $data['account_username'];
                    $_SESSION["phoneNumber"] = $data['account_contact'];
                    if(isset($_SESSION['account_change_page']) && $_SESSION['account_change_page'] == "account_information"){
                        redirect(base_url('Pages/load_account_information'));
                    }else if($_SESSION['account_change_page'] == "userlist"){
                        redirect(base_url('Pages/load_userlist'));
                    }
            }

            public function update_user_password_admin($data){
                $password = sha1($data['password']);
                $this->db->query("UPDATE `user` SET `password`= '{$password}' WHERE username = \"{$data['username']}\"");
                redirect(base_url('Pages/load_userlist'));
            }

            public function update_user_password_account($data){
                $newPassword = sha1($data['password']);
                $oldPassword = sha1($data['currentPassword']);
                //if($this->check_password($oldpassword)){
                if($oldPassword == $_SESSION['hashedPassword']){
                     $this->db->query("UPDATE user 
                                        SET password=\"{$newPassword}\"
                                        WHERE user_id = {$_SESSION['userID']}
                                    ");
                }else{
                    $_SESSION["wrong_password"] = true;
                }
                redirect(base_url('Pages/load_account_information'));
            }

            public function check_password($password){
                $samePassword = false;
                $result = $this->db->query("SELECT * FROM `user` WHERE password = '{$password}'");
                if ($result->num_rows() == 1) {
                    $samePassword = true;
                }
                return $samePassword;
            }

            public function update_receiveSMS(){
                $id = $_SESSION['userID'];
                $receiveSMSstatus = $_SESSION['receiveSMS'];

                if($receiveSMSstatus == 1){
                     $this->db->query("UPDATE `user` SET `receiveSMS`= 0 WHERE user_id = {$id}");
                     $_SESSION['receiveSMS'] = 0;
                }else{
                    $this->db->query("UPDATE `user` SET `receiveSMS`= 1 WHERE user_id = {$id}");
                     $_SESSION['receiveSMS'] = 1;
                }               
            }

            public function get_receiveSMS(){
                $result = $this->db->query("SELECT receiveSMS FROM user WHERE user_id = {$_SESSION['userID']}");
                return $result->row()->receiveSMS;
            }

            public function get_sms_users(){
                $result = $this->db->query("SELECT phone_number FROM user WHERE receiveSMS = 1");
                return $result->result();
            }

            public function get_count_sms_users(){
                $result = $this->db->query("SELECT phone_number FROM user WHERE receiveSMS = 1");
                return $result->num_rows();
            }

            public function change_user_type($data){
                $this->db->query("UPDATE `user` SET `type`= '{$data['type']}' WHERE username = \"{$data['username']}\"");
                redirect(base_url('Pages/load_userlist'));
            }

        }
    ?>