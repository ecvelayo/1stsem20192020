<?php
    class Notifications extends CI_Controller {
        public function index ($offset = 0){

            $config['base_url'] = base_url().'notifications/index';
            $config['total_rows'] = $this->Notification_model->count_notifications();
            $config['uri_segment'] = 3;
            $config['per_page'] = 5;
            $this->pagination->initialize($config);
            $templates['title'] = 'Notifications';
            $data['notifications'] = $this->Notification_model->get_notifications ($limit = 5, $offset);

            $this->load->view('inc/header-client', $templates);
            $this->load->view('notifications', $data);
            $this->load->view('inc/footer');
        }
    }