<?php
    class P_Gallery_Model extends CI_Model {
        public function index (){
            $templates['title'] = 'Galleries';
            $data['galleries'] = $this->P_gallery_model->get_galleries();

            $this->load->view('inc/header-performer', $templates);
            $this->load->view('performer/gallery', $data);
            $this->load->view('inc/footer');
        }
        public function get_galleries(){
            $query = $this->db->get_where('band_galleries', array('user_id'=>$this->session->userdata('user_id')));
            $data = $query->row_array();
            return $data;
        }
    }