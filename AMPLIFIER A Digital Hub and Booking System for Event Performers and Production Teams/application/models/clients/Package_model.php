<?php
    class Package_Model extends CI_Model {
        public function index(){
            if(!$this->session->userdata('user_id')){
				redirect('clients/profile');
			}
			$templates['title'] = 'Package';

			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/package');
			$this->load->view('inc/footer');
        }
    }