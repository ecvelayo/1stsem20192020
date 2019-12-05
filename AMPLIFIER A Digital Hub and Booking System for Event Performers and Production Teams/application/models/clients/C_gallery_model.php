<?php
    class C_Gallery_Model extends CI_Model {
        public function index (){
            $templates['title'] = 'Galleries';
            $data['galleries'] = $this->C_gallery_model->get_galleries();

            // echo '<pre>';
            // print_r($data['galleries']);
            // echo '</pre>';
            // die;
            $this->load->view('inc/header-client', $templates);
            $this->load->view('client/gallery', $data);
            $this->load->view('inc/footer');
        }
        public function get_galleries(){
            $id = $this->uri->segment(2);
            $query = $this->db->get_where('packages', array('package_id'=>$id));
            $data = $query->row_array();
            $query = $this->db->get_where('band_galleries', array('user_id'=>$data['owner']));
            $data = $query->row_array();
            return $data;
        }
        public function performer_gallery (){
            $templates['title'] = 'Galleries';
            $data['galleries'] = $this->C_gallery_model->get_galleries_performer();

            $this->load->view('inc/header-client', $templates);
            $this->load->view('client/performer_gallery', $data);
            $this->load->view('inc/footer');
        }
        public function get_galleries_performer(){
            $id = $this->uri->segment(2);
            $query = $this->db->get_where('bookings', array('booking_id'=>$id));
            $data = $query->row_array();
            if($data){
                $query = $this->db->get_where('band_galleries', array('user_id'=>$data['performer_id']));
                $data = $query->row_array();            
                return $data;
            }else{
                $this->session->set_flashdata('danger_message', 'The page your trying to preview is not found!');
                redirect('c_events');
            }
        }
    }