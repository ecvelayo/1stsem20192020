<?php 
    class P_Rate_Model extends CI_Model {
        public function index (){
            $id = $this->uri->segment(2);
            $user_id = $this->session->userdata('user_id');
            // $query = $this->db->query("SELECT * FROM bookings WHERE booking_id = $id AND performer_rating IS NULL AND performer_id = $user_id ");
            $query = $this->db->get_where('rating', array('package_id'=>$this->uri->segment(2), 'user_id'=>$this->session->userdata('user_id')));
            $data['rate'] = $query->row_array();
            if(!$data['rate']){
                $templates['title'] = 'Event Rating';

                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/rate', $data);
                $this->load->view('inc/footer');
            }else{
                $this->session->set_flashdata('danger_message', 'The event your trying to rate is not found!');
                redirect('p_event_info/'.$this->session->userdata('history_performer_id'));
            }
        }
        public function rate_attempt(){
            $templates['title'] = 'Event Rating';
            $id = $this->uri->segment(2);
            $user_id = $this->session->userdata('user_id');
            // $query = $this->db->query("SELECT * FROM bookings WHERE booking_id = $id AND performer_rating IS NULL AND performer_id = $user_id ");
            $query = $this->db->get_where('rating', array('package_id'=>$this->uri->segment(2), 'user_id'=>$this->session->userdata('user_id')));
            $data['rate'] = $query->row_array();
            $this->form_validation->set_rules('rate1', 'Rate 1', 'required|numeric', array('required'=> 'Rate is required', 'numeric'=>'Something went wrong'));
            // $this->form_validation->set_rules('rate2', 'Rate 2', 'required|numeric', array('required'=> 'Rate is required', 'numeric'=>'Something went wrong'));

            $data['rate1'] = $this->input->post('rate1');
            $data['rate2'] = $this->input->post('rate2');
            $data['review'] = $this->input->post('review');

            if(!$data['rate']){
                if($this->form_validation->run() === FALSE){
                    $this->load->view('inc/header-performer', $templates);
                    $this->load->view('performer/rate', $data);
                    $this->load->view('inc/footer');
                }else{
                    $average = $data['rate1']; 
                    // $this->db->set(array('performer_rating'=>$average));
                    // $this->db->where('booking_id', $this->uri->segment(2));
                    // $this->db->update('bookings');
                    $query = $this->db->get_where('bookings', array('booking_id'=>$this->uri->segment(2)));
                    $temp = $query->row_array();
                    
                    $userdata = array(
                        'package_id' => $temp['package_id'],
                        'user_id' => $this->session->userdata('user_id'),
                        'fname' => $this->session->userdata('fname'),
                        'lname' => $this->session->userdata('lname'),
                        'rate' => $average,
                        'review' => $data['review']
                    );
                    $this->db->insert('rating', $userdata);
                    
                    $this->session->set_flashdata('success_message', 'Event '.$data['rate']['event_name'].' has been successfully rated!');
                    redirect('p_event_info/'.$this->uri->segment(2));
                }
            }else{
                $this->session->set_flashdata('danger_message', 'The event your trying to rate is not found!');
                redirect('p_event_info/'.$this->uri->segment(2));
            }
            
        }
    }