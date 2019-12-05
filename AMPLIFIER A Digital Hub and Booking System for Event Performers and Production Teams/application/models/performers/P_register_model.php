<?php
    class P_Register_Model extends CI_Model {
        public function index (){           
			$templates['title'] = 'Performer Registration';

			$this->load->view('inc/header-no-navbar', $templates);
			$this->load->view('performer/register');
			$this->load->view('inc/footer');
        }
        public function register(){
			$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_dash_space|callback_dup_flname', array('required'=> 'Please Input First Name', 'alpha' => 'Please input letters only'));
			$this->form_validation->set_rules('uname', 'Username', 'required|alpha_numeric|is_unique[users.username]', array('required'=> 'Please Input Username', 'alpha' => 'Please input letters only', 'alpha_numeric'=> 'Username contain no spaces', 'is_unique'=>'Duplicated Username'));
			$this->form_validation->set_rules('lname', 'Last Name', 'required|callback_alpha_dash_space|callback_dup_flname', array('required'=> 'Please Input Last Name', 'alpha' => 'Please input letters only'));
			$this->form_validation->set_rules('address', 'Address', 'required', array('required'=> 'Please Input Address'));
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]', array('required'=> 'Please Input Emaill Address', 'valid_email'=> 'Please Input a Valid Email Address', 'is_unique'=>'Email Address is already registered'));
			$this->form_validation->set_rules('number1', 'Contact Number 1', 'required|numeric|exact_length[9]|callback_dup_number1', array('required'=> 'Please Input Contact Number', 'numeric'=>'Contact Number should be Numbers not Letters', 'exact_length'=>'Contains only 9 digits')); 
			$this->form_validation->set_rules('number2', 'Contact Number 2', 'numeric|exact_length[9]|callback_dup_number2', array('required'=> 'Please Input Contact Number', 'numeric'=>'Contact Number should be Numbers not Letters', 'exact_length'=>'Contains only 9 digits')); 
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]', array('required'=>'Password is required', 'min_length'=>'Password must be at least 8 characters long'));
			$this->form_validation->set_rules('con_pass', 'Confirm Password', 'matches[pass]|min_length[8]', array('matches'=>'Password not matched', 'min_length'=>'Password must be at least 8 characters long'));
			$this->form_validation->set_rules('service', 'Service', 'required', array('required'=>'No Service Selected'));
            $this->form_validation->set_rules('desc', 'Description', 'required', array('required'=> 'Please Input Description'));
			$this->form_validation->set_rules('userfile', 'Profile Picture', 'callback_file_check');
			$this->form_validation->set_rules('group_photo', 'Group Photo', 'callback_file_check_group_photo');
			$this->form_validation->set_rules('video1', 'Video Sample 1', 'callback_file_check_video_1');
			$this->form_validation->set_rules('video2', 'Video Sample 2', 'callback_file_check_video_2');
			$this->form_validation->set_rules('video3', 'Video Sample 3', 'callback_file_check_video_3');			

            $data['fname'] = $this->input->post('fname');
            $data['lname'] = $this->input->post('lname');
			$data['uname'] = $this->input->post('uname');
			$data['address'] = $this->input->post('address');
            $data['email'] = $this->input->post('email');
            $data['number1'] = $this->input->post('number1');
            $data['number2'] = $this->input->post('number2');
			$data['service'] = $this->input->post('service');
			$data['desc'] = $this->input->post('desc');

            if($this->form_validation->run() === FALSE){
				if($data['number2'] == $data['number1']){

				}
                $templates['title'] = 'Performer Registration';

                $this->load->view('inc/header-no-navbar', $templates);
                $this->load->view('performer/register', $data);
                $this->load->view('inc/footer');
            }else{
				$data = [];
				$timestamp = date('Y_m_d_H_i_s');											
				$allowed_mime_images = array('image/jpeg','image/png');
				$allowed_mime_videos = array('video/mp4');
			
				foreach ($_FILES as $f){
					$_FILES['file']['name'] = $f['name'];
					$_FILES['file']['type'] = $f['type'];
					$_FILES['file']['tmp_name'] = $f['tmp_name'];
					$_FILES['file']['error'] = $f['error'];
					$_FILES['file']['size'] = $f['size'];
					$mime = get_mime_by_extension($f['name']);	

					if(in_array($mime, $allowed_mime_images)){
						$array = explode('.', $f['name']);
						$ext = end($array);
						// Upload Image
						$config['file_name'] = $timestamp.'.'.$ext;
						$config['upload_path'] = './assets/img/performer';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size'] = '2048';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];	
						}			

					}elseif (in_array($mime, $allowed_mime_videos)){
						$array = explode('.', $f['name']);
						$ext = end($array);
						// Upload Image
						$config['file_name'] = $timestamp.'.'.$ext;
						$config['upload_path'] = './assets/video/performer';
						$config['allowed_types'] = 'mp4';
						$config['max_size'] = '200000';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);	

						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];	
						}	
					}			
					$files[] = $filename;
				}

				$user_id = $this->P_register_model->user_insert($files);
				$session_user = $this->P_register_model->user_select($this->input->post('email'));
				$this->Session_model->session_user($session_user);
				
				$notif['message'] = 'Welcome '.$this->session->userdata('fname').' '.$this->session->userdata('lname').', now you can view, update password and update your user information in profile page';
				$notif['links'] = base_url().'profile_info';
				$notif['notif_type'] = 'user';
				$notif['notif_status'] = 'created';
				$this->Notification_model->index($notif);

				$this->session->set_flashdata('success_message', 'Hey '.$this->session->userdata('fname').' '.$this->session->userdata('lname').' welcome to AMPLIFER!');
				redirect('p_bookings');
			}
		}
		public function user_select($email){
            $query = $this->db->get_where('users', array('email'=>$email));
            return $query->row_array();
        }
		public function user_insert($files){
				$date = date('Y-m-j H:i:s');
				$data = array(
					'user_id' => null,
					'user_type'=> 'performer',
					'username'=> $this->input->post('uname'),
					'password' => md5($this->input->post('pass')),
					'status'=> 'verified',
					'fname'=> $this->input->post('fname'),
					'lname'=> $this->input->post('lname'),
					'email' => $this->input->post('email'),
					'address'=> $this->input->post('address'),
					'rate'=>0,
					'photo'=> 'assets/img/performer/'.$files[0],
					'telephone_1'=> $this->input->post('number1'),
					'telephone_2'=> $this->input->post('number2'),
					'offense' => 0,
					'report_count' => 0,
					'media_fk' => null,
					'created_at' => $date,
					'updated_at' => $date,
					'block_end' => '0000-00-00',
					'artist_type' => $this->input->post('service'),
					'artist_desc' => $this->input->post('desc')
				);				
				$this->db->insert('users', $data);
				$new_user_id = $this->db->insert_id();

				$data = array (
					'id'=> null,
					'user_id'=> $new_user_id,
					'band_photo'=> 'assets/img/performer/'.$files[4],
					'video_1'=> 'assets/video/performer/'.$files[1],
					'video_2'=> 'assets/video/performer/'.$files[2],
					'video_3'=> 'assets/video/performer/'.$files[3],
				);
				$this->db->insert('band_galleries', $data);
				$gallery_id = $this->db->insert_id();
				return;
		}
    }