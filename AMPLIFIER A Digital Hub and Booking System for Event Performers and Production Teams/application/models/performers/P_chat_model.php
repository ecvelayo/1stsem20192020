<?php
    class P_Chat_Model extends CI_Model {
        public function chat_message(){
            $id = $this->uri->segment(2);
            if($id != $this->session->userdata('user_id')){
                $data['chats'] = $this->P_chat_model->chat_conversation($id);
                $data['users'] = $this->P_chat_model->get_only_name_from_users();
                $data['user_info'] = $this->P_chat_model->get_user_info($id);   
                $data['refresh'] = $this->P_chat_model->refresh_chat();

                $templates['title'] = 'Chat';
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/chat', $data);
                $this->load->view('inc/footer');
            }else{
                $data['users'] = $this->P_chat_model->get_only_name_from_users();
                $data['refresh'] = $this->P_chat_model->refresh_chat();
                $templates['title'] = 'Chat';
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/chat', $data);
                $this->load->view('inc/footer');                
            }    
            
        }
        public function index (){
            $data['latest_user_message'] = $this->P_chat_model->get_latest_user_message();
            
            if($data['latest_user_message']){
                redirect('p_chat/'.$data['latest_user_message']['user_id']);
            }else{
                redirect('p_chat/'.$this->session->userdata('user_id'));                
            }
        }
        public function get_user_info($id){
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('users', array('user_id'=> $id));
            return $query->row_array();
        }
        public function chat_conversation($id){
            // incoming message
            $this->db->select('chats.*, users.*, chats.created_at as c_created_at, chats.updated_at as c_updated_at');
            $this->db->join('users', 'users.user_id = chats.incoming_id');
            $this->db->where(array('incoming_id'=>$id, 'outgoing_id'=>$this->session->userdata('user_id')));
            $this->db->or_where(array('incoming_id'=>$this->session->userdata('user_id')));
            $this->db->where(array('outgoing_id'=>$id));
            $this->db->order_by('c_created_at', 'ASC');
            $query = $this->db->get('chats');
            $data['incoming_message'] = $query->result_array();

            $data['left_panel'] = $this->P_chat_model->chat_left_panel();

            // echo '<pre>';
            // print_r($data['left_panel']);
            // echo '</pre>';
            // die();

            return $data;
        }
        public function chat_left_panel(){
            // Get all latest message id
            $this->db->select('chats.*, MAX(id) as max_id');
            $this->db->order_by('created_at', 'DESC');
            $this->db->where(array('incoming_id'=>$this->session->userdata('user_id')));
            $this->db->group_by('outgoing_id');
            $query = $this->db->get('chats');
            $data['get_latest_id'] = $query->result_array();

            // get all latest message 
            foreach($data['get_latest_id'] as $d){ 
                $user_id = $this->session->userdata('user_id');
                $outgoing_id = $d['outgoing_id'];         
                $query = $this->db->query("SELECT chats.*, MAX(id) as max_id FROM chats WHERE outgoing_id = '$user_id' AND incoming_id = '$outgoing_id' ");
                $temp = $query->row_array();
                if($temp['max_id'] > $d['max_id']){
                    $max_id = $temp['max_id'];
                    $query = $this->db->query("SELECT * FROM chats WHERE id = '$max_id' ");
                    $temp1 = $query->row_array();
                    $data['latest_messages'][] = $temp1;
                }else{
                    $max_id = $d['max_id'];
                    $query = $this->db->query("SELECT * FROM chats WHERE id = '$max_id' ");
                    $temp1 = $query->row_array();
                    $data['latest_messages'][] = $temp1;
                }
            }
            

            // echo '<pre>';
            // print_r($data['latest_messages']);
            // echo '</pre>';
            // die();

            if($data['get_latest_id']){
                // get all incoming user info
                foreach($data['latest_messages'] as $d){
                    if($d['outgoing_id'] == $this->session->userdata('user_id')){
                        $query = $this->db->get_where('users', array('user_id' => $d['incoming_id']));
                        $stack = $query->row_array();
                        $temp = array_push($stack, $d);
                        $data['user_info'][] = $stack;                    
                    }else{
                        $query = $this->db->get_where('users', array('user_id' => $d['outgoing_id']));
                        $stack = $query->row_array();
                        $temp = array_push($stack, $d);
                        $data['user_info'][] = $stack;     
                    }
                }
                return $data['user_info'];
            }else{
                return FALSE;
            }

        }
        public function get_only_name_from_users(){
            $this->db->where('user_id !=', $this->session->userdata('user_id'));
            $this->db->select(array('user_id', 'fname', 'lname'));
            $this->db->order_by('created_at', 'DESC');
            $query= $this->db->get('users');
            return $query->result_array();            
        }
        public function get_latest_user_message(){
            $this->db->order_by('created_at', 'DESC');
            $this->db->select('chats.*, MAX(id) as max_id');
            $this->db->limit(1);
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('chats', array('incoming_id'=>$this->session->userdata('user_id')));
            $data = $query->row_array();

            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('chats', array('id'=>$data['max_id']));
            $data = $query->row_array();

            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get_where('users', array('user_id'=>$data['outgoing_id']));
            
            return $data = $query->row_array();  
        }
        public function send_search_message(){
            $id = $this->uri->segment(2);
            $timestamps = date('Y-m-d H:i:s');
            if($this->input->post('search') == 'search'){
                $this->P_chat_model->search_user();
                // 
            }else if ($this->input->post('send_message') == 'send_message'){
                $this->form_validation->set_rules('message', 'Message', 'required', array('required'=>'Please Input Message'));
                $this->form_validation->set_error_delimiters('', '');
                $data['message'] = $this->input->post('message');

                if($this->form_validation->run() == FALSE){
                    $data['chats'] = $this->P_chat_model->chat_conversation($id);
                    $data['users'] = $this->P_chat_model->get_only_name_from_users();
                    $data['user_info'] = $this->P_chat_model->get_user_info($id); 
                    $data['refresh'] = $this->P_chat_model->refresh_chat();
        
                    $templates['title'] = 'Chat';
                    $this->load->view('inc/header-performer', $templates);
                    $this->load->view('performer/chat', $data);
                    $this->load->view('inc/footer');                    
                }else{
                    if($this->session->userdata('last_message') == $this->input->post('message')){
                    
                        redirect('p_chat/'.$id);   
                    }
                    
                    $temp = array(
                        'id' => null,
                        'incoming_id' => $id,
                        'outgoing_id' => $this->session->userdata('user_id'),
                        'message' => $this->input->post('message'),
                        'created_at' => $timestamps,
                        'updated_at' => $timestamps
                    );
                    $this->db->insert('chats', $temp);
                    $this->session->set_userdata('last_message', $this->input->post('message'));
                    
                    $data['chats'] = $this->P_chat_model->chat_conversation($id);
                    $data['users'] = $this->P_chat_model->get_only_name_from_users();
                    $data['user_info'] = $this->P_chat_model->get_user_info($id); 
                    $data['refresh'] = $this->P_chat_model->refresh_chat();
        
                    $templates['title'] = 'Chat';
                    $this->load->view('inc/header-performer', $templates);
                    $this->load->view('performer/chat', $data);
                    $this->load->view('inc/footer');      
                }
            }
        }
        public function search_user(){
            $id = $this->uri->segment(2);
            $data['users'] = $this->P_chat_model->get_only_name_from_users();
            $templates['title'] = 'Chat';

            $this->form_validation->set_rules('userID', 'User ID', 'required|numeric', array('required'=> 'User not found', 'numeric'=>'ID contains invalid data'));
            $this->form_validation->set_rules('userName', 'User Name', 'required', array('required'=> 'Name is required'));
            $this->form_validation->set_error_delimiters('', '');

            if($this->form_validation->run() === FALSE){
                $data['chats'] = $this->P_chat_model->chat_conversation($id);
                $data['user_info'] = $this->P_chat_model->get_user_info($id); 
                
                $this->load->view('inc/header-client', $templates);
                $this->load->view('performer/chat', $data);
                $this->load->view('inc/footer');
            }else{
                $query = $this->db->get_where('users', array('user_id'=>$this->input->post('userID')));
                $temp = $query->row_array();

                redirect('p_chat/'.$temp['user_id']);             
            }
        }
        public function refresh_chat(){
            return $data = '<script language="javascript">
            setTimeout(function(){
               window.location.reload(1);
            }, 10000);
            </script>';       
        }
    }