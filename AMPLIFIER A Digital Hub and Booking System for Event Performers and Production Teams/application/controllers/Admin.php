<?php
    class Admin extends CI_Controller {
		public function chat(){
			$this->Session_model->session_check();		
            $this->Session_model->user_type_check_admin();

			$this->A_chat_model->index();
		}
		public function chat_message(){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_admin();

			$this->A_chat_model->chat_message();
		}
		public function send_search_message (){
			$this->Session_model->session_check();		
			$this->Session_model->user_type_check_admin();

			$this->A_chat_model->send_search_message();			
		}
    }