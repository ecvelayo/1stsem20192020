<?php  
    class Profile_Model extends CI_Model {
        public function index (){
			$templates['title'] = 'AMPLIFIER';
			$data['package'] = $this->Profile_model->get_three_packages();
			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/profile', $data);
			$this->load->view('inc/footer');            
		}        
		public function profile_password_edit_page(){		
			$templates['title'] = 'Change Password';

			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/profile_password_edit_page');
			$this->load->view('inc/footer');
		}
		public function profile_password_update(){			
			if(!$this->session->userdata('user_id')){
				redirect('clients/profile');
			}
			$templates['title'] = 'Change Password';

			$this->form_validation->set_rules('passOld', 'Old Password', 'required', array('required'=> 'Please Input Old Password'));
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]', array('required'=> 'Please Input Password'));
			$this->form_validation->set_rules('passConf', 'Confirm Password', 'required|matches[pass]', array('required'=> 'Please Input Confirm Password', 'matches'=>'Password Not Matched'));

			$data['passOld'] = md5($this->input->post('passOld'));
			$data['pass'] = md5($this->input->post('pass'));

			if($this->form_validation->run() === FALSE){
				$this->load->view('inc/header-client', $templates);
				$this->load->view('client/profile_password_edit_page');
				$this->load->view('inc/footer');
			}else{
				$check = $this->Profile_model->profile_update_password($data);
				if($check === FALSE){
					$this->session->set_flashdata('danger_message', 'Current Password Not Matched');
					redirect('profile_password_edit_page');
				}else{
					$notif['message'] = 'Your password has been recently updated!';
					$notif['links'] = '#';
 					$this->Notification_model->index($notif);

					$this->session->set_flashdata('success_message', 'Your Password Has Been Updated!');
					redirect('profile_password_edit_page');
				}
			}
		}
		public function profile_edit_page(){			
			if(!$this->session->userdata('user_id')){
				redirect('profile');
			}

			$templates['title'] = 'Profile Edit';

			$users['users'] = $this->client_model->get_user($this->session->userdata('email'));

			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/profile_edit', $users);
			$this->load->view('inc/footer');
		}
        public function profile_info (){        
			$templates['title'] = 'Profile Information';

			// echo $this->session->userdata('user_id');
			$query = $this->db->get_where('bookings', array('performer_id'=>$this->session->userdata('user_id')));
			$data = $query->result_array();

			if($this->session->userdata('user_type') == 'performer' && 1==0){				
				$i = 0;
				$sum = 0;
				foreach($data as $d){
					$sum = $sum + $d['performer_rating'];
					
					// echo '<br>';
					$i++;
				}
				// echo $i; echo '<br>';
				$data['average'] = $sum/$i;
			}

			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/profile_info', $data);
			$this->load->view('inc/footer');
		}
		public function profile_edit_info(){
			$templates['title'] = 'Edit Profile';
			
			$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_dash_space', array('required'=> 'Please Input First Name', 'alpha' => 'Please input letters only'));
			$this->form_validation->set_rules('uname', 'Username', 'required|alpha_numeric', array('required'=> 'Please Input Username', 'alpha' => 'Please input letters only', 'alpha_numeric'=> 'Username contain no spaces', 'is_unique'=>'Duplicated Username'));
			$this->form_validation->set_rules('lname', 'Last Name', 'required|callback_alpha_dash_space', array('required'=> 'Please Input Last Name', 'alpha' => 'Please input letters only'));
			$this->form_validation->set_rules('number1', 'Contact Number 1', 'required|numeric|exact_length[9]|callback_dup_profile_number1|callback_dup_both_number1', array('required'=> 'Please Input Contact Number', 'numeric'=>'Contact Number should be Numbers not Letters', 'exact_length'=>'Contains only 9 digits')); 
			$this->form_validation->set_rules('number2', 'Contact Number 2', 'numeric|exact_length[9]|callback_dup_profile_number2|callback_dup_both_number2', array('required'=> 'Please Input Contact Number', 'numeric'=>'Contact Number should be Numbers not Letters', 'exact_length'=>'Contains only 9 digits')); 
			$this->form_validation->set_rules('address', 'Address', 'required', array('required'=> 'Please Input Address'));
			$this->form_validation->set_rules('userfile', 'Profile Picture');
		   	
			// if($this->session->userdata('user_type') == 'performer'){				
			// 	$this->form_validation->set_rules('service', 'Service', 'required', array('required'=>'Please Select Service'));
			// 	$this->form_validation->set_rules('desc', 'Description', 'required', array('required'=>'Please Input Description'));
			// }

			// echo '<pre>';
			// print_r($this->input->post());
			// echo '</pre>';

			$data['uname'] = $this->input->post('uname');
			$data['fname'] = $this->input->post('fname');
			$data['lname'] = $this->input->post('lname');
			$data['number1'] = $this->input->post('number1');
			$data['number2'] = $this->input->post('number2');
			$data['userfile'] = $this->input->post('userfile');
			$data['address'] = $this->input->post('address');
			$data['service'] = $this->input->post('service');
			$data['desc'] = $this->input->post('desc');

			if($this->form_validation->run() === FALSE){
				$this->load->view('inc/header-client', $templates);
				$this->load->view('client/profile_edit', $data);
				$this->load->view('inc/footer');
			}else{
				$timestamp = date('Y_m_d_H_i_s');
				$array = explode('.', $_FILES['userfile']['name']);
				$ext = end($array);
				$folder = 'C:/xampp/htdocs/Amplifier-repo/';
				$path = $folder.$this->session->userdata('photo');	
				$copyFolder = 'C:/xampp/htdocs/Amplifier-repo/assets/img/client/';
				$extFile = pathinfo($path);

				// If there is no new photo upload
				$newfile = $copyFolder.$extFile['filename'].'_temp.'.$extFile['extension'];
				copy($path, $newfile);
				// Unlinking/Deleting Profile picture	
				if($temp = $this->session->userdata('photo') != 'assets/img/client/no_image.jpg'){
					unlink($path);	
					// die('delete');
				}
				// Copy temp file
				copy($newfile, $path);
				unlink($newfile);	
				
				// Upload Image
				$config['file_name'] = $timestamp.'.'.$ext;
				$config['upload_path'] = './assets/img/client';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = '2048';
				$config['max_width'] = '50000';
				$config['max_height'] = '50000';
					
				$this->load->library('upload', $config);	
				if(!$this->upload->do_upload()){
					$errors = array ('error' => $this->upload->display_errors());
					$client_image = $this->session->userdata('photo');
				}else{
					$data = array ('upload_data' => $this->upload->data());
					$client_image = 'assets/img/client/'.$timestamp.'.'.$ext;
					// Unlinking/Deleting old Profile picture 	
					if($temp = $this->session->userdata('photo') != 'assets/img/client/no_image.jpg'){
						unlink($path);	
						// die('delete');
					}
				}

				$this->Profile_model->profile_update($client_image);
				$session_user = $this->Profile_model->user_select($this->session->userdata('email'));	
				$this->Session_model->session_user($session_user);
				$this->session->set_flashdata('success_message', 'Profile has been updated!');		
	
				redirect('profile_info'); 
				// hi;
			}
		}	
        public function profile_update_password($data){
            $condition =  array('email'=> $this->session->userdata('email'), 'password' => $data['passOld']);
            $query = $this->db->get_where('users',$condition);
			$profile = $query->row_array();
			// echo $this->session->userdata('email');
			// echo $data['passOld'];
			// echo $this->db->last_query();
			// print_r($profile);
			// die;
            if(!$profile){
                return FALSE;
            }else{
                $data = array(
                    'password' => $data['pass']
                );
                $this->db->set($data);
                $this->db->where($condition);
                $this->db->update('users');
                // echo $this->db->last_query();
                // die();
            }      
		}		
        public function profile_update($client_image){
			if($this->input->post('service') || $this->input->post('desc')){
				$artist_type = $this->input->post('service');
				$artist_desc = $this->input->post('desc');
			}else{
				$artist_type = null;
				$artist_desc = null;
			}
			// echo $artist_type;
			// echo $artist_desc;
			// die;
            $date = date('Y-m-j H:i:s');
            // die();
            $data = array(
                'username'=> $this->input->post('uname'),
                'fname'=> $this->input->post('fname'),
                'lname'=> $this->input->post('lname'),
                'address'=> $this->input->post('address'),
                'photo'=> $client_image,
                'telephone_1'=> $this->input->post('number1'),
				'telephone_2'=> $this->input->post('number2'),
				'artist_type' => $this->input->post('service'),
				'artist_desc' => $this->input->post('desc'),
                'updated_at' => $date,
			);
		
            $this->db->set($data);
            $this->db->where(array('email' => $this->session->userdata('email'), 'user_id' => $this->session->userdata('user_id')));
            return $this->db->update('users');
            // print_r($this->db->last_query());
            // die('here');
        } 
        public function user_select($email){
            $query = $this->db->get_where('users', array('email'=>$email));
            return $query->row_array();
		}
		public function get_three_packages(){
			$this->db->limit(3);
			// $this->db->group_by('owner');
			$this->db->order_by('packages.created_at', 'DESC');
			$this->db->join('band_galleries', 'user_id = owner');
			$this->db->select('packages.*, band_galleries.*, band_galleries.created_at as g_created_at, band_galleries.updated_at as g_updated_at, packages.created_at as p_created_at, packages.updated_at as p_updated_at');
			$query = $this->db->get_where('packages', array('booked'=>0));
			return $data = $query->result_array();
			 echo '<pre>';
			print_r($data);
			echo '</pre>';
			die;
		}
		public function performer_profile_info (){
			$this->db->select('bookings.*, users.*');
			$this->db->join('users', 'users.user_id = bookings.performer_id');
			$query = $this->db->get_where('bookings', array('booking_id'=>$this->uri->segment(2)));
			$data = $query->row_array();

			if($data){			
				$templates['title'] = 'Performer Info';
				$this->load->view('inc/header-client', $templates);
				$this->load->view('client/performer_event_info', $data);
				$this->load->view('inc/footer');
			}else{
				$this->session->set_flashdata('danger_message', 'The page your to access is not available!');
				redirect('c_events');
			}
		}
		public function check_event_reminder(){
			$query = $this->db->get_where('bookings', array('client_id'=>$this->session->userdata('user_id'), 'status' => 'approve'));
			$data = $query->result_array();
			// print_r($data);
			$system_date = date('Y-m-d'); 
			$system_time = date('H:i:s');
			$event_date = date('F d, y');
			foreach($data as $d){
				$event_time = date('h:i a', strtotime($d['event_from']));
				$system_time_minus_1hour = date('H:i', strtotime('-1 hour', strtotime($d['event_from'])));
				$system_time_minus_15mins = date('H:i', strtotime('-15 minutes', strtotime($d['event_to'])));
				if($system_date >= $d['event_date']){
					
					$notif['message'] = "Reminder! Today event ".$d['event_name']. ' will start at '.$event_time;
					$reminder_date_is_done = $this->Notification_model->check_event_reminder_trigger($notif['message']);					
					if(!$reminder_date_is_done){
						$notif['links'] = '#';
						$this->Notification_model->index($notif);
					}

					$notif['message'] = 'Reminder! Event '.$d['event_name'].' will start around '.$event_time;
					$reminder_time_is_done = $this->Notification_model->check_event_reminder_trigger($notif['message']);
					if($system_time_minus_1hour <= $d['event_from'] ){
						if(!$reminder_time_is_done){
							$notif['links'] = '#';
							$this->Notification_model->index($notif);
						}
					}

					$notif['message'] = 'Reminder! Event '.$d['event_name'].' is starting!';
					$reminder_time_is_done = $this->Notification_model->check_event_reminder_trigger($notif['message']);					
					if($system_time >= $d['event_from'] ){
						if(!$reminder_time_is_done){
							$notif['links'] = '#';
							$this->Notification_model->index($notif);
						}
					}

					$notif['message'] = 'Reminder! Event '.$d['event_name'].' is about to end!';
					$reminder_time_is_done = $this->Notification_model->check_event_reminder_trigger($notif['message']);					
					if($system_time >= $system_time_minus_15mins ){
						if(!$reminder_time_is_done){
							$notif['links'] = '#';
							$this->Notification_model->index($notif);
						}
					}
					
					$notif['message'] = 'Reminder! Event '.$d['event_name'].' is ended!';
					$reminder_time_is_done = $this->Notification_model->check_event_reminder_trigger($notif['message']);					
					if($system_time >= $d['event_to'] ){
						if(!$reminder_time_is_done){
							$notif['links'] = '#';
							$this->Notification_model->index($notif);
						}
					}
				}
			}
		}
    }