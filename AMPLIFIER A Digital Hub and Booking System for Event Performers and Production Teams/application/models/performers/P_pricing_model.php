<?php
    class P_Pricing_Model extends CI_Model {
        public function index(){
			$templates['title'] = 'Pricing';

			$this->load->view('inc/header-performer', $templates);
			$this->load->view('performer/pricing');
			$this->load->view('inc/footer');            
        }
        public function pricing_validate(){
            $this->form_validation->set_rules('name', 'Package Name', 'required', array('required'=>'Please Input Package Name'));
            $this->form_validation->set_rules('price', 'Price Offer', 'required|numeric|greater_than[499]|less_than_equal_to[999999999]', array('required'=>'Please Input Price', 'numeric'=>'Please input a valid Price', 'greater_than'=>'Minimum Price is set to ₱ 500', 'less_than_equal_to'=>'Maximum Price is set to ₱ 999,999,999'));
            $this->form_validation->set_rules('desc', 'Description', 'required', array('required'=>'Please Input Description'));
            // $this->form_validation->set_rules('userfile', 'Profile Picture', 'callback_file_check');
            
            $data['name'] = $this->input->post('name');
            $data['price'] = $this->input->post('price');
            $data['desc'] = $this->input->post('desc');

            if($this->form_validation->run() === FALSE){
                $templates['title'] = 'Pricing';

                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/pricing', $data);
                $this->load->view('inc/footer');
            }else{
                $id = $this->P_pricing_model->pricing_insert();
                $notif['message'] = 'Package Name: '.$this->input->post('name').' has been successfully added! Click here to view.';
                $notif['links'] = base_url().'p_package_info_page/'.$id;
                $notif['notif_type'] = 'package';
                $notif['notif_status'] = 'created';
                $this->Notification_model->index($notif);
                
                $this->session->set_flashdata('success_message', 'Package Name: '.$this->input->post('name').' has been successfully added!');
                redirect('p_pricing');
            }
        }
        public function pricing_insert(){
            $timestamp = date('Y-m-d H:i:s');
            $data = array(
                'package_id' => null,
                'package_name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'details' => $this->input->post('desc'),
                'owner' => $this->session->userdata('user_id'),
                'booked' => 0,
                'date_created' => '0000-00-00',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            );
            $this->db->insert('packages', $data);
            return $this->db->insert_id();
        }
    }