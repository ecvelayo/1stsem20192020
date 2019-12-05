<?php 
    class P_Report_model extends CI_Model {
        public function index(){
            $templates['title'] = 'Report Event';
            $data['report'] = $this->P_report_model->get_event();
            if(!$data['report']){
                $this->session->set_flashdata('danger_message', 'The event your trying to report is not found!');
                redirect('p_bookings');
            }

            $this->load->view('inc/header-performer', $templates);
            $this->load->view('performer/report-event', $data);
            $this->load->view('inc/footer');
        }
        public function report_attempt(){
            $templates['title'] = 'Report Event';
            $data['report'] = $this->P_report_model->get_event();
            if(!$data['report']){
                $this->session->set_flashdata('danger_message', 'The event your trying to report is not found!');
                redirect('p_bookings');
            }

            $this->form_validation->set_rules('desc', 'Description', 'required', array('required'=>'Please Input Description'));
            $this->form_validation->set_rules('userfile', 'Report Photo', 'callback_optional_image_upload');
            $this->form_validation->set_rules('uservideo', 'Report Video', 'callback_optional_video_upload');

            $data['desc'] = $this->input->post('desc');

            // echo '<pre>';
            // print_r($_FILES);
            // echo '</pre>';
            // die;

            if($this->form_validation->run() === FALSE){
                $this->load->view('inc/header-performer', $templates);
                $this->load->view('performer/report-event', $data);
                $this->load->view('inc/footer');
            }else{
                // echo '<pre>';
                // print_r($_FILES);
                // echo '</pre>';
				$timestamp = date('Y_m_d_H_i_s');											
				$allowed_mime_images = array('image/jpeg','image/png');
				$allowed_mime_videos = array('video/mp4');
				foreach ($_FILES as $f){
					$_FILES['file']['name'] = $f['name'];
					$_FILES['file']['type'] = $f['type'];
					$_FILES['file']['tmp_name'] = $f['tmp_name'];
					$_FILES['file']['error'] = $f['error'];
					$_FILES['file']['size'] = $f['size'];
					$mime = get_mime_by_extension($f['name']);	

					if(in_array($mime, $allowed_mime_images)){                          
                        $array = explode('.', $f['name']);
                        $ext = end($array);
                        // Upload Image
                        $config['file_name'] = $timestamp.'.'.$ext;
                        $config['upload_path'] = './assets/img/report';
                        $config['allowed_types'] = 'jpg|png';
                        $config['max_size'] = '2048';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];	
                        }	
                    }else if(in_array($mime, $allowed_mime_videos)){                         
                        $array = explode('.', $f['name']);
                        $ext = end($array);
                        // Upload Image
                        $config['file_name'] = $timestamp.'.'.$ext;
                        $config['upload_path'] = './assets/video/report';
                        $config['allowed_types'] = 'mp4';
                        $config['max_size'] = '200000';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);	

                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];	
                        }
					}else{
                        $filename = 'no_attachment.jpg';
                    }			
					$files[] = $filename;
				}
                $new_array = array(
                    'booking_id' => $data['report']['booking_id'],
                    'report_from' => $this->session->userdata('user_id'),
                    'report_to' => $data['report']['performer_id'],
                    'report_photo' => 'assets/img/report/'.$files[0],
                    'report_video' => 'assets/video/report/'.$files[1],
                    'report_details' => $data['desc'],                    
                );
                $this->db->insert('reports', $new_array);                
                
                $notif['message'] = 'You have been reported the event: '.$data['report']['event_name'];
                $notif['links'] = '#';
                $this->Notification_model->index($notif);

                $this->session->set_flashdata('warning_message', 'You have been reported the event: '.$data['report']['event_name']);
                redirect('p_event_info/'.$data['report']['booking_id']);
            }
        }
        public function get_event(){
            $id = $this->uri->segment(2);
            $user_id = $this->session->userdata('user_id');
            $query = $this->db->query("SELECT * FROM bookings WHERE booking_id = $id AND performer_id = $user_id ");
            return $data = $query->row_array();
            // echo $this->db->last_query();
            // die;
        }
    }