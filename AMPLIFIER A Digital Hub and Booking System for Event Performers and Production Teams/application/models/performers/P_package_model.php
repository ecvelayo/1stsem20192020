<?php 
    class P_Package_Model extends CI_Model {
        public function index (){
            $templates['title'] = 'Package';
            
            $data['packages'] = $this->P_package_model->select_packages();

			$this->load->view('inc/header-performer', $templates);
			$this->load->view('performer/package', $data);
            $this->load->view('inc/footer');
        }
        public function package_info_page(){            
            $id = $this->uri->segment(2);
            $query = $this->db->get_where('packages', array('package_id' => $id));
            $data = $query->row_array();

            if($data){
                $templates['title'] = 'Package Info';
        
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/package-info', $data);
                $this->load->view('inc/footer');
            }else{
                $this->session->set_flashdata('danger_message', 'The page your trying to view is not found!');
                redirect('p_package');
            }
            
        }
        public function select_packages(){
            $this->db->order_by('updated_at', 'DESC');
            $this->db->select('packages.*');
            $query = $this->db->get_where('packages', array('owner'=>$this->session->userdata('user_id')));
            return $temp = $query->result_array();        
        }
        public function package_edit_page(){
            $id = $this->uri->segment(2);

            $query = $this->db->get_where('packages', array('package_id' => $id));
            $data = $query->row_array();
            
            if($data){            
                $templates['title'] = 'Edit Package '.$data['package_name'];
    
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/package-edit', $data);
                $this->load->view('inc/footer');
            }else{
                $this->session->set_flashdata('danger_message', 'The package your trying to edit is not found');
                redirect('p_package');
            }
        }
        public function package_update(){
			$this->form_validation->set_rules('package_name', 'Package Name', 'required' , array('required'=> 'Please Input Package Name'));
			$this->form_validation->set_rules('price', 'Package Price', 'required|numeric|less_than_equal_to[999999999]|greater_than_equal_to[500]' , array('required'=> 'Please Input Package Price', 'numeric'=> 'Price contains only numbers', 'greater_than_equal_to'=>'Price should not below ₱ 500.00', 'less_than_equal_to'=>'Price should not beyond to ₱ 999,999,999.00'));
			$this->form_validation->set_rules('details', 'Package Description', 'required' , array('required'=> 'Please Input Package Description'));

			$data['package_name'] = $this->input->post('package_name');
			$data['price'] = $this->input->post('price');
            $data['details'] = $this->input->post('details');
            
            // print_r($this->input->post());
            // die;

			if($this->form_validation->run() === FALSE){
				$templates['title'] = 'Edit Package '.$this->input->post('name');
				$this->load->view('inc/header-performer', $templates);
				$this->load->view('performer/package-edit', $data);
				$this->load->view('inc/footer');
			}else{
                $id = $this->input->post('id');
                $timestamps = date('Y-m-d H:i:s');
				$data = array(
					'package_name' => $data['package_name'],
					'price' => $data['price'],
                    'details' => $data['details'],
                    'updated_at'=> $timestamps
                );
                $this->db->set($data);
                $this->db->where(array('owner'=> $this->session->userdata('user_id'), 'package_id'=>$id));
                $this->db->update('packages');
                
                $notif['message'] = 'Package: '.$data['package_name']. ' has been updated!';
                $notif['links'] = base_url().'p_package_info_page/'.$id;
                $notif['target_user_id'] = null;
                $notif['notif_type'] = 'package';
                $notif['notif_status'] = 'created';
                $this->Notification_model->index($notif);

                $this->session->set_flashdata('success_message', 'Package Name: '.$data['package_name'].' has been updated!');
				redirect('p_package_info_page/'.$id);
            }
        }
        public function p_package_delete(){
            $id= $this->uri->segment(2);
            $this->db->where(array('package_id'=>$id, 'owner'=>$this->session->userdata('user_id')));
            $query = $this->db->get('packages');
            $data = $query->row_array();
            
            if(!$data){
                $this->session->set_flashdata('danger_message', 'The package your trying to delete is not found');
                redirect('p_package');
            }else{
                $this->db->where(array('package_id'=>$id, 'owner'=>$this->session->userdata('user_id')));
                $this->db->delete('packages');
                $notif['message'] = 'Package Name: '.$data['package_name'].' has been deleted!';
                $notif['links'] = '#';
                $notif['notif_type'] = 'package';
                $notif['notif_status'] = 'removed';
                $this->Notification_model->index($notif);
                
                $this->session->set_flashdata('success_message', 'Package has been successfully Deleted!');
                redirect('p_package');
            }
        }
        public function get_event_info (){
            $templates['title'] = 'Event Info';

            $this->db->select('bookings.*, price');
            $this->db->join('packages', 'packages.package_id = bookings.package_id');
			// $query = $this->db->get_where('bookings', array('booking_id'=>$this->uri->segment(2), 'status'=>'approve'));
			$query = $this->db->get_where('bookings', array('booking_id'=>$this->uri->segment(2)));
            $data['event'] = $query->row_array();
            $data['report'] = $this->P_package_model->get_report();

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // die;

            if($data['event']){
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/event_info', $data);
                $this->load->view('inc/footer');
            }else{  
                $this->session->set_flashdata('danger_message', 'The page your trying to access is not found!');
                redirect('p_bookings');
            }
        }
        public function get_report(){
            // $query = $this->db->get_where('reports', array('booking_id'=>$this->uri->segment(2), 'report_from'=>$this->session->userdata('user_id')));
            $query = $this->db->get_where('reports', array('booking_id'=>$this->uri->segment(2), 'report_from'=>$this->session->userdata('user_id')));
            return $query->row_array();
        }
    }