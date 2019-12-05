<?php
    class Login_Model extends CI_Model {
        public function index (){
            if($this->session->userdata('user_id')){
				// redirect('clients/profile');
			}
			$templates['title'] = 'Login';
			
			$this->load->view('inc/header-no-navbar', $templates);
			$this->load->view('login');
			$this->load->view('inc/footer');
        }
        public function login_attempt (){            
			$templates['title'] = 'Client Login';

			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email', array('required'=>'Email address is required', 'valid_email'=>'Email address not valid'));
			$this->form_validation->set_rules('pass', 'Password', 'required', array('required'=>'Password is required'));
			
			$data['email'] = $this->input->post('email');
			$data['pass'] = $this->input->post('pass');

			if($this->form_validation->run() == FALSE){
				$this->load->view('inc/header-no-navbar', $templates);
				$this->load->view('login', $data);
				$this->load->view('inc/footer');
			}else{
				$hash_pass = md5($data['pass']);
				$query = $this->Login_model->user_login($data['email'], $hash_pass);
				
				if(!$query){
					$this->session->set_flashdata('danger_message', 'Invalid Email address or Password');
					$this->session->set_flashdata('email', $this->input->post('email'));
					redirect('login');
				}else{
					$this->Session_model->session_user($query);
					$this->session->set_flashdata('success_message', 'Welcome back '.$this->session->userdata('fname').' '.$this->session->userdata('lname').'!');

					$this->Session_model->session_check();
					$this->Session_model->user_type_check();
				}
			}
		}
		
        public function user_login ($email, $pass){
			$query = $this->db->get_where('users', array('email'=>$email, 'password' => $pass));
            return $query->row_array();
        }
    }