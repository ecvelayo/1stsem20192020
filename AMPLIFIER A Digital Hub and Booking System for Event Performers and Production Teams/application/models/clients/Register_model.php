<?php
    class Register_Model extends CI_Model {
        public function index (){
            if($this->session->userdata('user_id')){
				// redirect('clients/profile');
			}
			$templates['title'] = 'Client Registration';

			$this->load->view('inc/header-no-navbar', $templates);
			$this->load->view('client/register');
            $this->load->view('inc/footer');
        }
        public function register_user(){    
			$templates['title'] = 'Client Registration';
			$this->form_validation->set_rules('uname', 'Username', 'required|is_unique[users.username]', array('required' => 'Plese Input Username', 'is_unique'=>'Duplicated Username'));
			$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_dash_space|callback_dup_flname', array('required' => 'Please Input First Name'));
			$this->form_validation->set_rules('lname', 'Last Name', 'required|callback_alpha_dash_space|callback_dup_flname', array('required' => 'Please input Last Name'));
			$this->form_validation->set_rules('number1', 'Contact Number', 'required|numeric|exact_length[9]|callback_dup_number1|callback_dup_both_number1', array('required' => 'Please input contact number', 'numeric'=>'Please input a valid Contact Number', 'exact_length'=> 'Please enter 9 digits only'));
			$this->form_validation->set_rules('number2', 'Contact Number', 'numeric|exact_length[9]|callback_dup_number2|callback_dup_both_number2', array('numeric'=>'Please input a valid Contact Number', 'exact_length'=> 'Please enter 9 digits only'));
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]', array('required' => 'Please input Email Address', 'valid_email'=>'Email Address not valid', 'is_unique'=>'Email Address is already taken'));
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]', array('required' => 'Please input Password', 'min_length'=>'Password must be 8 or more characters'));
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[pass]|min_length[8]', array('matches'=>'Password not matched', 'min_length'=>'Password must be 8 or more characters'));
			$this->form_validation->set_rules('userfile', 'Userfile', 'callback_file_check');
			$this->form_validation->set_rules('address', 'Address', 'required', array('required'=>'Please input address'));

			$data['uname'] = $this->input->post('uname');
			$data['fname'] = $this->input->post('fname');
			$data['lname'] = $this->input->post('lname');
			$data['number1'] = $this->input->post('number1');
			$data['number2'] = $this->input->post('number2');
			$data['email'] = $this->input->post('email');
			$data['userfile'] = $this->input->post('userfile');
			$data['address'] = $this->input->post('address');
			$data['pass'] = $this->input->post('pass');

			if($this->form_validation->run() === FALSE){
				$this->load->view('inc/header-no-navbar', $templates);
				$this->load->view('client/register', $data);
				$this->load->view('inc/footer');
			}else{
				$timestamp = date('Y_m_d_H_i_s');
				$array = explode('.', $_FILES['userfile']['name']);
				$ext = end($array);

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
					$client_image = 'assets/img/client/no_image.jpg';
				}else{
					$data = array ('upload_data' => $this->upload->data());
					$client_image = 'assets/img/client/'.$timestamp.'.'.$ext;
				}
				
				$this->Register_model->user_insert($client_image);
				$session_user = $this->Register_model->user_select($this->input->post('email'));
				$this->Session_model->session_user($session_user);

				$notif['message'] = 'Welcome '.$this->session->userdata('fname').' '.$this->session->userdata('lname').', now you can view or change your user information in profile page.';
				$notif['links'] = base_url().'profile_info';
				$notif['notif_type'] = 'user';
				$notif['notif_status'] = 'created';

				$this->Notification_model->index($notif);
				// die();

				$this->session->set_flashdata('success_message', 'Hey '.$this->session->userdata('fname').' '.$this->session->userdata('lname').' welcome to AMPLIFER!');
				
				redirect('profile');
			}
		}
		public function user_select($email){
            $query = $this->db->get_where('users', array('email'=>$email));
            return $query->row_array();
        }
		public function user_insert($performer_image){
            $date = date('Y-m-j H:i:s');
            $data = array(
                'user_id' => null,
                'user_type'=> $this->input->post('user_type'),
                'username'=> $this->input->post('uname'),
                'password' => md5($this->input->post('pass')),
                'status'=> 'verified',
                'fname'=> $this->input->post('fname'),
                'lname'=> $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'address'=> $this->input->post('address'),
                'rate'=>0,
                'photo'=> $performer_image,
                'telephone_1'=> $this->input->post('number1'),
                'telephone_2'=> $this->input->post('number2'),
                'offense' => 0,
				'report_count' => 0,
				'block_end' => '0000-00-00',
				'media_fk' => null,
                'created_at' => $date,
				'updated_at' => $date
			);

			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			return $this->db->insert('users', $data);
			echo $this->db->last_query();
			die;
		}
		
		// INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`, `status`, `fname`, `lname`, `email`, `address`, `rate`, `photo`, `telephone_1`, `telephone_2`, `offense`, `report_count`, `media_fk`, `created_at`, `updated_at`) VALUES (NULL, 'client', 'NikeMarti', '41fd220f05ed0d8c56e3b83af87d45d7', 'verified', 'Nike', 'Cueva', 'alice1@gmail.com', 'asdfasdfasdf', 0, 'assets/img/client/2019_11_11_17_57_15.jpg', '09365264573', '09124567890', 0, 0, NULL, '2019-11-11 17:57:15', '2019-11-11 17:57:15')
    }