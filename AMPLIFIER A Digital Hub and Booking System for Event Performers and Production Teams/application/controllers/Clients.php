<?php 

	class Clients extends CI_Controller {	
		public function logout (){
			$this->Session_model->unset_user();
			redirect('profile');
		}
		public function login_attempt(){
			$this->Session_model->session_index_page ();
			$this->Login_model->login_attempt();
		}
		public function login(){
			$this->Session_model->session_index_page ();
			$this->Login_model->index();
		}
		public function register (){
			$this->Session_model->session_index_page ();
			$this->Register_model->index();
		}
		public function register_user(){
			$this->Session_model->session_index_page ();
			$this->Register_model->register_user();
		}
		public function profile(){
			// $this->Session_model->session_index_page ();
			$this->Profile_model->index();			
		}
		public function gallery(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();

			$this->C_gallery_model->index();
		}
		public function history(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();
			
			$this->History_model->index();
		}
		public function history_info(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();
			
			$this->History_model->history_info();
		}
		public function rate_event(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();
			
			$this->C_rate_model->index();
		}
		public function rate_attempt(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->C_rate_model->rate_attempt();
		}
		public function report_event(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();
			
			$this->C_report_model->index();
		}
		public function search($page = 0)
		{
			$this->load->model("Admin_model");
			$where=array();
			if ($this->input->get("user_id")) {
				$where['owner'] = $this->input->get("user_id");
			}
			
			$total_rows = $this->Admin_model->count_results_package($where);		
			$rpg = 3;
	
			$config['base_url'] = base_url('services');
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rpg;
			$config['reuse_query_string'] = true;
			$config['uri_segment'] = 2;
			
			$this->pagination->initialize($config);
	
			$data['pagination'] = $this->pagination->create_links();
			// $data["query_results_package_check"] = $this->Admin_model->query_results_package_check();
			$data["query_results_package"] = $this->Admin_model->query_results_package($where, $rpg, $page);
			$data["fetch_data_perf"] = $this->Admin_model->fetch_data_perf();
			$data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
			$this->load->view('/client/search_performer', $data);
		}
		public function report_attempt(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->C_report_model->report_attempt();
		}
		public function delete_event(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->delete_event();
		}
		public function events (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->index();
		}
		public function event_created (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->event_created();			
		}
		public function event_info (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->event_info();
		}
		public function event_add (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->event_add();
		}
		public function event_add_attempt (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->event_add_attempt();
		}
		public function print_pdf(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Event_model->print_pdf();
		}
		public function booking(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Booking_model->index();
		}
		public function booking_book_event(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Booking_model->booking_book_event();
		}
		public function booking_attempt(){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Booking_model->booking_attempt();
		}
		public function performer_profile_info (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->Profile_model->performer_profile_info();
		}
		public function performer_gallery (){
			$this->Session_model->session_check();
			$this->Session_model->user_type_check_client();

			$this->C_gallery_model->performer_gallery();
		}
		public function calendar(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Calendar_model->index();
		}
		public function check_event(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Calendar_model->check_event();
		}
		public function calendar_info(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Calendar_model->calendar_info();
		}
		public function package(){
			$this->Session_model->session_check();			
			$this->Session_model->user_type_check_client();
			
			$this->Package_model->index();
		}
		public function chat(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();

			$this->C_chat_model->index();
		}
		public function chat_message(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();

			$this->C_chat_model->chat_message();
		}
		public function send_search_message (){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_client();

			$this->C_chat_model->send_search_message();			
		}
		public function profile_info(){
			$this->Session_model->session_check();			
			// $this->Session_model->user_type_check_client();
			
			$this->Profile_model->profile_info();
		}
		public function profile_edit_page(){
			$this->Session_model->session_check();			
			// $this->Session_model->user_type_check_client();
			
			$this->Profile_model->profile_edit_page();
		}
		public function rating(){
			$this->C_rate_model->rating_page();
		}
		public function add_rating(){
			$this->C_rate_model->add_rating();
		}
		public function profile_edit_info(){
			$this->Session_model->session_check();			
			// $this->Session_model->user_type_check_client();
			
			$this->Profile_model->profile_edit_info();
		}
		public function profile_password_edit_page(){
			$this->Session_model->session_check();			
			// $this->Session_model->user_type_check_client();
			
			$this->Profile_model->profile_password_edit_page();
		}
		public function profile_password_update(){
			$this->Session_model->session_check();			
			// $this->Session_model->user_type_check_client();
			
			$this->Profile_model->profile_password_update();
		}
		public function file_check(){
			$allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
			$mime = get_mime_by_extension($_FILES['userfile']['name']);
			if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
				if($_FILES['userfile']['error'] != 0){
					$this->form_validation->set_message('file_check', 'Image File Exceed 2MB');
					return false;
				}
				// if($width > 5000 && $height > 5000){
				// 	$this->form_validation->set_message('file_check', 'Image Dimension Exceed 5000 x 5000');
				// 	return false;
				// }
				if(in_array($mime, $allowed_mime_type_arr)){
					return true;
				}else{
					$this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
					return false;
				}
			}else{
				$this->form_validation->set_message('file_check', 'Please choose a file image to upload.');
				return false;
			}
		}				
		public function file_check_update(){

			$allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
			$mime = get_mime_by_extension($_FILES['userfile']['name']);
			if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
				if($_FILES['userfile']['error'] != 0){
					$this->form_validation->set_message('file_check_update', 'Image File Exceed 2MB');
					return false;
				}
				// if($width > 5000 && $height > 5000){
				// 	$this->form_validation->set_message('file_check_update', 'Image Dimension Exceed 5000 x 5000');
				// 	return false;
				// }
				if(in_array($mime, $allowed_mime_type_arr)){
					return true;
				}else{
					$this->form_validation->set_message('file_check_update', 'Please select only gif/jpg/png file.');
					return false;
				}
			}else{
				return true;
			}
		}	
		public function file_check_user_video(){			
			$allowed_mime_type_arr = array('video/mp4');
			$mime = get_mime_by_extension($_FILES['uservideo']['name']);
			if(isset($_FILES['uservideo']['name']) && $_FILES['uservideo']['name']!=""){
				if($_FILES['uservideo']['error'] != 0){
					$this->form_validation->set_message('file_check_user_video', 'The video file is corrupted. Cannot proceed');
					return false;
				}
				if(in_array($mime, $allowed_mime_type_arr)){
					if($_FILES['uservideo']['size'] <= 200000000){
						return true;
					}else{
						$this->form_validation->set_message('file_check_user_video', 'Video file size exceed 200mb, please select another video.');
						return false;
					}
				}else{
					$this->form_validation->set_message('file_check_user_video', 'Please select only mp4 file.');
					return false;
				}
			}else{
				$this->form_validation->set_message('file_check_user_video', 'Please choose a video file.');
				return false;
			}
		}	
		function alpha_dash_space($str){
			if(!preg_match("/^([-a-z_. ])+$/i", $str)){
				$this->form_validation->set_message('alpha_dash_space', 'First name only accept letters');
				return FALSE;
			}else{
				return TRUE;
			}
		} 
		public function check_to_time(){
		
			$time_from = $this->input->post('duration');
			$time_to = $this->input->post('event_time');
			$event_time = date('H:i', strtotime('+1 hour', strtotime($time_from)));
			// echo $this->input->post('event_date') >= date('Y-m-d');
			// die;
			if($this->input->post('event_date') >= date('Y-m-d')){
				if(!$time_to){
					$this->form_validation->set_message('check_to_time', 'No Time is Selected');
					return FALSE;
				}else{
					if($event_time > $time_to){
						$this->form_validation->set_message('check_to_time', 'The minimum event duration is atleast 1 hour long');
						return FALSE;
					}
				}					
			}
		}
		public function check_date(){
			if($this->input->post('event_date') < date('Y-m-d')){
				$this->form_validation->set_message('check_date', 'Date selected is invalid');
				return FALSE;
			}else{			
				return TRUE;
			}
		}
		public function dup_flname (){
			// Check if fname, lname, contact number (1,2) are duplicate
			$this->db->select('fname, lname');
			$this->db->where('fname', $this->input->post('fname'));
			$this->db->or_where('lname', $this->input->post('lname'));
			// $this->db->or_where('telephone_1', $this->input->post('number1'));
			// $this->db->or_where('telephone_2', $this->input->post('number2'));
			$query = $this->db->get('users');
			$temp = $query->row_array();
			
			if($temp['fname'] == $this->input->post('fname') && $temp['lname'] == $this->input->post('lname')){
				$this->form_validation->set_message('dup_flname', 'Duplicated First Name and Last Name');
				return FALSE;
			}else{
				return TRUE;
			}			
		}
		public function dup_number1 (){
			// Check if fname, lname, contact number (1,2) are duplicate
			$this->db->select('telephone_1');
			$this->db->where('telephone_1', $this->input->post('number1'));
			$query = $this->db->get('users');
			$temp = $query->row_array();
			
			if($temp['telephone_1'] == $this->input->post('number1')){
				$this->form_validation->set_message('dup_number1', 'Duplicated Contact Number');
				return FALSE;
			}else{
				return TRUE;
			}			
		}
		public function dup_number2 (){
			// Check if fname, lname, contact number (1,2) are duplicate
			$this->db->select('telephone_2');
			$this->db->where('telephone_2', $this->input->post('number2'));
			$query = $this->db->get('users');
			$temp = $query->row_array();
			
			if($temp){
				if($temp['telephone_2'] == $this->input->post('number2')){
					$this->form_validation->set_message('dup_number2', 'Duplicated Contact Number');
					return FALSE;
				}else{
					return TRUE;
				}	
			}else{ 
				return TRUE;
			}		
		}
		public function optional_image_upload(){
			if(!$_FILES['userfile']['name']){
				return true;
			}else{				
				$allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
				$mime = get_mime_by_extension($_FILES['userfile']['name']);
				
				if($_FILES['userfile']['size'] > 2000000){
					$this->form_validation->set_message('optional_image_upload', 'Please Limit size to 2mb');
					return false;
				}
				if(in_array($mime, $allowed_mime_type_arr)){
					return true;
				}else{
					$this->form_validation->set_message('optional_image_upload', 'Please select only gif/jpg/png file.');
					return false;
				}
			}
		}	
		public function optional_video_upload(){			
			if(!$_FILES['uservideo']['name']){
				return true;
			}else{				
				$allowed_mime_type_arr = array('video/mp4');
				$mime = get_mime_by_extension($_FILES['uservideo']['name']);
				if($_FILES['uservideo']['error'] != 0){
					$this->form_validation->set_message('optional_video_upload', 'The video file is corrupted. Cannot proceed');
					return false;
				}
				if(in_array($mime, $allowed_mime_type_arr)){
					if($_FILES['uservideo']['size'] <= 200000000){
						return true;
					}else{
						$this->form_validation->set_message('optional_video_upload', 'Video file size exceed 200mb, please select another video.');
						return false;
					}
				}else{
					$this->form_validation->set_message('optional_video_upload', 'Please select only mp4 file.');
					return false;
				}
			}
		}	
		public function dup_profile_number1 (){
			// Check if fname, lname, contact number (1,2) are duplicate
			$this->db->select('telephone_1');
			$this->db->where(array('telephone_1' => $this->input->post('number1'), 'telephone_2' => $this->input->post('number1'), 'user_id !='=>$this->session->userdata('user_id')));
			$query = $this->db->get('users');
			$temp = $query->row_array();
			
			if($temp['telephone_1'] == $this->input->post('number1')){
				$this->form_validation->set_message('dup_profile_number1', 'Duplicated Contact Number');
				return FALSE;
			}else{
				return TRUE;
			}			
		}
		public function dup_profile_number2 (){
			// Check if fname, lname, contact number (1,2) are duplicate
			$this->db->select('telephone_2');
			$this->db->where(array('telephone_2' => $this->input->post('number2'), 'telephone_1' => $this->input->post('number2'), 'user_id !='=>$this->session->userdata('user_id')));
			$query = $this->db->get('users');
			$temp = $query->row_array();
			
			if($temp){
				if($temp['telephone_2'] == $this->input->post('number2')){
					$this->form_validation->set_message('dup_profile_number2', 'Duplicated Contact Number');
					return FALSE;
				}else{
					return TRUE;
				}	
			}else{ 
				return TRUE;
			}		
		}
		public function dup_both_number1(){
			if($this->session->userdata('telephone_1') == $this->input->post('number1') && $this->session->userdata('telephone_1') != $this->session->userdata('telephone_1')){
				$this->form_validation->set_message('dup_both_number1', 'Duplicated Contact Number');
				return FALSE;
			}else{
				return TRUE;
			}
		}
		public function dup_both_number2(){
			// echo $this->session->userdata('telephone_2'); echo '<br>';
			// echo $this->input->post('number1');
			if($this->session->userdata('telephone_2') == $this->input->post('number2') && $this->session->userdata('telephone_2') != $this->session->userdata('telephone_2')){
				$this->form_validation->set_message('dup_both_number2', 'Duplicated Contact Number');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	} 