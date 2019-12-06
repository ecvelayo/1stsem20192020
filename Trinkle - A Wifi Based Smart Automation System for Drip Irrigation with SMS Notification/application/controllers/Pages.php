<?php
	class Pages extends CI_Controller{
			

		public function index(){
			$this->load->view('pages/index');
		}

		public function view(){
			// Load login page bruh
			$page = 'login';
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			$this->load->model("UserModel");
			$data['title'] = ucfirst($page);
			$this->load->view('pages/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('pages/footer');
			$this->load->model('CropModel');
			$_SESSION['crop'] = $this->CropModel->get_selected_crop(); //crop ID
		}

		public function logincheck(){
			$this->load->model('UserModel');
			$this->UserModel->check_login($_POST);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url('pages/view'), 'refresh');
		}

		public function main(){
			$this->load->model("SensorModel");
			$this->load->model("CropModel");
			$data['load_latest'] = $this->SensorModel->get_latest_sensor_value();
			$data['crop_data'] = $this->CropModel->get_selected_crop_data();
			$data['all_crop_data'] = $this->CropModel->get_all_crop_specifications();
			$data['valve_status'] = $this->SensorModel->get_valve_status();
			// $data['use_crop_spec'] = $this->CropModel->use_crop();
			// Load main menu / home page

			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/mainMenuBody', $data);
			$this->load->view('pages/footer');
		}
		
		public function latest_data(){
			$this->load->model("SensorModel");
			$result['data'] = $this->SensorModel->get_latest_sensor_value();
			echo json_encode($result['data']);
		}

		public function load_userlist(){
			$this->load->model("UserModel");
			$data['all_userList'] = $this->UserModel->get_all_user_data();
			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/userlist', $data);
			$this->load->view('pages/footer');
		}

		public function load_system_logs(){
			$this->load->model("SensorModel");
			$data['system_logs'] = $this->SensorModel->get_all_system_logs();
			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/system_logs', $data);
			$this->load->view('pages/footer');
		}

		public function load_crop_specifications(){
			$this->load->model("CropModel");
			$data['crop_specifications'] = $this->CropModel->get_all_crop_specifications();
			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/crop_specifications', $data);
			$this->load->view('pages/footer');
		}

		public function load_account_information(){
			$this->load->model("UserModel");
			$data['account_info'] = $this->UserModel->get_specific_user_data($_SESSION['userID']);
			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/account_information', $data);
			$this->load->view('pages/footer');
		}

		public function load_irrigation_data(){
			$this->load->model("SensorModel");
			$data['irrigation_data'] = $this->SensorModel->get_all_irrigation_data();
			$this->load->view('pages/header');
			$this->load->view('pages/urlCheck');
			$this->load->view('pages/sidebar');
			$this->load->view('pages/irrigation_logs', $data);
			$this->load->view('pages/footer');

		}

		public function add_new_crop(){
			$this->load->model("CropModel");
			$this->CropModel->add_crop($_POST);
		}

		public function register_user(){
			$this->load->model("UserModel");
			$this->UserModel->register_user($_POST);
		}

		public function use_crop_data(){
			$this->load->model("CropModel");
			$this->CropModel->use_crop($_POST);
		}

		public function sensor_reading(){
			if(!empty($_POST))
		    {
		    	$this->load->model('SensorModel');
				$this->SensorModel->insert_sensor_value($_POST);

				$this->load->model('CropModel');
				$check = $this->CropModel->check_crop_parameters($_POST);
				$carboncheck = $this->CropModel->check_carbon($_POST);

				$this->load->model('UserModel');
				$smsdata = $this->UserModel->get_sms_users();
				$size = $this->UserModel->get_count_sms_users();

				$response = $size;	
				
				 if($carboncheck){
				 	$response .= "{'carboncheck':true,";
				 }else{
				 	$response .=	"{'carboncheck':false,";
				 }


				if($check){

					//$this->SensorModel->insert_system_logs($_POST);	

					$response .= "'valve':true,";
					$response .= "'phone_number': [";

					if($size > 0){
						$x = 1;
						foreach($smsdata as $sms){
							$response .= "'" . $sms->phone_number . "'";
							if($x != $size){
									$response .= ",";
							}
							$x++;
						}
						$response .="],";
						$response .= "'sms':true}"; 		
					}else{
						$response .= "'0000000000'";
						$response .="],";
						$response .= "'sms':false}";
					}
				}else{
					$response .= "'valve':false,";
					$response .= "'phone_number':" . "'0000000000',";
					$response .= "'sms':false}";

				}


				
				echo $response;
			}
		}

		public function set_inactive(){
			
			$this->load->model('UserModel');
			$this->UserModel->set_inactive($_POST['id']);
			$this->load->view('pages/header');
			$data['all_userList'] = $this->UserModel->get_all_user_data();
			$this->load->view('pages/userlist', $data);
			$this->load->view('pages/footer');
		}

		public function set_active(){
			
			$this->load->model('UserModel');
			$this->UserModel->set_active($_POST['id']);
			$this->load->view('pages/header');
			$data['all_userList'] = $this->UserModel->get_all_user_data();
			$this->load->view('pages/userlist', $data);
			$this->load->view('pages/footer');
		}

		public function delete_crop(){
			$this->load->model('CropModel');
			$this->CropModel->delete_crop_func($_POST['id']);
			
		}

		public function edit_user_type(){
			$this->load->model('UserModel');
			$this->UserModel->change_user_type($_POST);
		}

		public function append_user_data(){
			if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id"])){
				$this->load->model('UserModel');
				$result['user_data'] = $this->UserModel->get_specific_user_data($_POST['id']);
				echo json_encode($result['user_data']);
			}
		}

		public function append_crop_data(){
			if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id"])){
				$this->load->model('CropModel');
				$result['crop_data'] = $this->CropModel->get_specific_crop_data($_POST['id']);
				echo json_encode($result['crop_data']);
			}
		}

		public function account_update(){
			$this->load->model("UserModel");
			$this->UserModel->update_user_data($_POST);
		}

		public function receiveSMS_update(){
			$this->load->model("UserModel");
			$this->UserModel->update_receiveSMS();
		}
		
		public function update_password_admin(){
			$this->load->model("UserModel");
			$this->UserModel->update_user_password_admin($_POST);
		}

		public function update_password_account(){
			$this->load->model("UserModel");
			$this->UserModel->update_user_password_account($_POST);
		}

		public function update_crop_info(){
			$this->load->model("CropModel");
			$this->CropModel->crop_update($_POST);
		}
	}
?>