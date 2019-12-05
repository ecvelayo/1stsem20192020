<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function transaction($id)
    {
        $this->load->model("Admin_model");
        $this->load->library('upload');
    
        $data["query_data_transaction"] = $this->Admin_model->query_data_transaction($id);
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/transaction', $data);
    }
    public function offense_count($id)
    {
        $this->load->model("Admin_model");
        $this->load->library('upload');
        if ($this->input->post("offenseNo") == "1") {
            $date = date('Y-m-d');
            $block_date = date_create($date);
            date_add($block_date, date_interval_create_from_date_string("3 days"));
            $block_date = date_format($block_date, "Y-m-d");
            $status = "block";
        }
        if ($this->input->post("offenseNo") == "2") {
            $date = date('Y-m-d');
            $block_date = date_create($date);
            date_add($block_date, date_interval_create_from_date_string("30 days"));
            $block_date = date_format($block_date, "Y-m-d");
            $status = "block";
        }
        if ($this->input->post("offenseNo") == "3") {
            $status = "banned";
            $block_date = "0000-00-00";
        }
        $this->form_validation->set_rules("offenseNo", "offense number", 'numeric');
        $offense = array(
            "offense" => $this->input->post("offenseNo"),
            "block_end" => $block_date,
            "status" => $status,
        );
        $this->Admin_model->update_offense_user($offense);
        $notif_insert = array(
            "user_id" => $id,
            "notif_type" => "user",
            "notif_status" => $status,
            "status" => "notified",
            "notif_name" => "User account has been blocked",
            "target_user_id" => $id,
            "target_status" => "notified",
            "target_notif_name" => "Notice: Your Account has been blocked by admin.",


        );
        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "users");
    }
    public function changeoff()
    {
        $this->load->model("Admin_model");
        $this->load->library('upload');
        $block_date = "0000-00-00";

        $offense = array(
            "block_end" => $block_date,
            "status" => "verified",
        );

        $this->Admin_model->update_offense_user1($offense);
        echo '<script> alert("Account can now be used please login again");</script>';
        echo '<script> window.location.replace("logout_user")</script>';

    }
    public function recover($id)
    {
        $this->load->model("Admin_model");
        $this->load->library('upload');
        $status = "verified";
        $recover = array("status" => $status);
        $this->Admin_model->update_recover_user($recover);
        $notif_insert = array(
            "user_id" => $id,
            "notif_type" => "user",
            "notif_status" => "created",
            "status" => "notified",
            "notif_name" => "User account has been recovered.",
            "target_user_id" => $id,
            "target_status" => "notified",
            "target_notif_name" => "Notice: Your Account has been recovered by admin.",

        );
        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "users");
    }
// delete start
    public function delete_user($id)
    {
        $this->load->model("Admin_model");
        $offense = array("status" => "hide");

        $this->Admin_model->update_hide_user($offense);
        $notif_insert = array(
            "user_id" => $id,
            "notif_type" => "user",
            "notif_status" => "removed",
            "status" => "notified",
            "notif_name" => "User account has been removed.",

        );

        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "users");
    }
    public function delete_report($id)
    {
        $this->load->model("Admin_model");
        $offense = array("reports_status" => "hide");

        $this->Admin_model->update_hide_report($offense);

        $notif_insert = array(
            "report_id" => $id,
            "notif_type" => "report",
            "notif_status" => "removed",
            "status" => "notified",
            "notif_name" => "A user report has been removed",

        );

        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "reports");

    }
    public function delete_event($id)
    {
        $this->load->model("Admin_model");
        $offense = array("status" => "cancel");

        $this->Admin_model->update_hide_event($offense);

        $notif_insert = array(
            "booking_id" => $id,
            "notif_type" => "event",
            "notif_status" => "cancel",
            "status" => "notified",
            "notif_name" => "An event has been cancelled",
        );

        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "events");
    }

    public function delete_package($id)
    {
        $this->load->model("Admin_model");
        $offense = array("package_status" => "hide");

        $this->Admin_model->update_hide_package($offense);

        $notif_insert = array(
            "package_id" => $id,
            "notif_type" => "package",
            "notif_status" => "removed",
            "status" => "notified",
            "notif_name" => "A performers package has been removed.",

        );
        $this->Admin_model->insert_data_notifications($notif_insert);
        redirect(base_url() . "services");

    }
// delete end

    public function block_page()
    {

        $this->load->view('/admin/block_page');
    }

    public function form_validation()
    {
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model("Admin_model");
        $this->form_validation->set_rules("fname", "first name", 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules("address", "address", 'required');
        $this->form_validation->set_rules("lname", "last name", 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules("password", "password", 'required|min_length[5]');
        $this->form_validation->set_rules("username", "username", 'required|min_length[5]');
        $this->form_validation->set_rules("contact_number", "contact number", 'required|integer|max_length[13]|greater_than_equal_to[0]');
        $this->form_validation->set_rules("contact_number1", "contact number 2", 'integer|max_length[13]|greater_than_equal_to[0]');
        $this->form_validation->set_rules("email", "email", 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules("usertype", "usertype", 'required');


        $password = md5($this->input->post("password"));

        if ($this->form_validation->run()) {
            $timestamp = date('Y_m_d_H_i_s');
            $array = explode('.', $_FILES['userfile']['name']);
            $ext = end($array);

            // Upload Image
            $config['file_name'] = $timestamp . '.' . $ext;
            $config['upload_path'] = './assets/img/client/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '50000';
            $config['max_height'] = '50000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                $errors = $this->upload->display_errors();
                $client_image = 'assets/img/client/no_image.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $client_image = 'assets/img/client/' . $timestamp . '.' . $ext;
            }

            //             echo '<pre>';
            // print_r($_FILES);
            // echo $client_image;
            // echo $errors;
            // echo $config['upload_path'];
            // echo '</pre>';
            // die;

            $this->load->model("Admin_model");
            $status = "verified";
            $data_insert = array(
                "fname" => $this->input->post("fname"),
                "lname" => $this->input->post("lname"),
                "password" => $password,
                "username" => $this->input->post("username"),
                "telephone_1" => $this->input->post("contact_number"),
                "telephone_2" => $this->input->post("contact_number1"),
                "email" => $this->input->post("email"),
                "user_type" => $this->input->post("usertype"),
                "address" => $this->input->post("address"),
                "status" => $status,
                "created_at" => date('y-m-d'),
                "photo" => $client_image,
            );

            $this->Admin_model->insert_data_users($data_insert);
            if ($status == "verified") {
                $details = "has Created a new account";
                $notif_insert = array(
                    "user_id" => $this->db->insert_id(),
                    "notif_type" => "user",
                    "notif_status" => "created",
                    "status" => "notified",
                    "notif_name" => "A new user account has been created. ",

                );
                $this->Admin_model->insert_data_notifications($notif_insert);
            }

            redirect(base_url() . "users");
        } else {
            echo '<script> alert("invalid inputs, Try again");</script>';
            echo '<script> history.go(-1);</script>';
            
            
        }
    }

// report add
    public function form_validation_report()
    {
        $id = $this->input->post('booking_id');
        $this->db->select('*');
        $this->db->from('bookings');
        $this->db->where('booking_id', $id);
        $temp = $this->db->get();
        $data['bookings'] = $temp->row_array();
        // echo '<pre>';
        // print_r($this->input->post('report_to'));
        // echo '</pre>';
        // die;
        // $video_check=$this->file_check_video();
        // if($video_check=='true'){
        $data['booking_id'] = $this->input->post('booking_id');
        $data['report_info'] = $this->input->post('report_info');
        if ($this->input->post("report_to")==''){
            echo '<script> alert("PLease select who to report");</script>';
            echo '<script> history.go(-1);</script>';
        }else if ($this->input->post("report_info")==''){
            echo '<script> alert("Please provide details of the report");</script>';
            echo '<script> history.go(-1);</script>';
        }else{
                $book_id = $this->report_insert($data['bookings']);
                $this->session->set_flashdata('success_message', 'Event ' . $data['event_name'] . ' has been successfully booked!');
                redirect('reports');
            }
        }
    // }

    // public function report_insert($booking)
    // {
    //     $this->load->library('upload');
    //     $this->load->model("Admin_model");
    //     if($this->input->post("report_to")=='client'){
    //         $reported = $booking['client_id'];
    //     }else{
    //         $reported = $booking['performer_id'];
    //     }
    //     $timestamp = date('Y_m_d_H_i_s');
    //     $array = explode('.', $_FILES['userfile']['name']);
    //     $ext = end($array);
    //     $config['file_name'] = $timestamp . '.' . $ext;
    //     $config['upload_path'] = './assets/img/report/';
    //     $config['allowed_types'] = 'video|mp4|mkv';
    //     $config['max_size'] = '200000';

    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);

    //     if (!$this->upload->do_upload()) {
    //         $errors = $this->upload->display_errors();
    //         $report_video   = 'assets/img/report/no_image.jpg';
    //     } else {
    //         $data           = array('upload_data' => $this->upload->data());
    //         $report_video   = 'assets/img/report/' . $timestamp . '.' . $ext;
    //     }
    //     echo '<pre>';
    
    //     // print_r($this->input->post('userfile'));
    //     // echo '</pre>';
    //     // die;
        
    //     $data_insert = array(
    //         "booking_id" => $this->input->post("booking_id"),
    //         "report_from" => $this->session->userdata('user_id'),
    //         "report_to" => $reported,
    //         "report_photo" => $report_video,
    //         "report_details" =>$this->input->post("report_info"),
    //         "reports_status" => "show"

    //      );
    //      $this->Admin_model->insert_data_report($data_insert);
    //      $notif_insert = array(
    //          "user_id"          => $reported,
    //          "notif_type"       => "report",
    //          "notif_status"     => "reporter",
    //          "status"           => "notified",
    //          "notif_name"       => "Account has been reported by admin.",
    //          "report_id"        => $this->db->insert_id()
    //      );
    //      $this->Admin_model->insert_data_notifications($notif_insert);

    //     //  $notif_insert2 = array(
    //     //      "user_id"          => $reported,
    //     //      "notif_type"       => "report",
    //     //      "notif_status"     => "reported",
    //     //      "status"           => "notified",
    //     //      "notif_name"       => "Account Reported",
    //     //      "report_id"        => $this->db->insert_id()
    //     //  );
    //     //  $this->Admin_model->insert_data_notifications2($notif_insert2);
    //      redirect('reports');

    //     $id = $this->db->insert_id();
    //     // echo $this->db->last_query();
    //     // die();
    //     return $id;
    // }
    public function form_validation_event()
    {
        $id = $this->uri->segment(2);
        $this->load->model("Admin_model");
        $this->db->where('package_id', $id);
        $temp = $this->db->get('packages');
        $data['package'] = $temp->row_array();
        $data["fetch_data_client"] = $this->Admin_model->fetch_data_client();
        $this->load->view('admin/addevent', $data);

    }
    public function booking_attempt()
    {
        $id = $this->uri->segment(2);
        $this->db->where('package_id', $id);
        $this->db->join('users', 'users.user_id = packages.owner');
        $this->db->select('packages.*, users.*');
        $temp = $this->db->get('packages');
        $data['package'] = $temp->row_array();

        $this->form_validation->set_rules('client', '', 'required', array('required' => 'Please Select a client'));
        $this->form_validation->set_rules('event_name', '', 'required', array('required' => 'Please Input Event Name'));
        $this->form_validation->set_rules('event_date', '', 'required', array('required' => 'No Date Selected'));
        $this->form_validation->set_rules('event_time', '', 'required', array('required' => 'No Time Selected'));
        $this->form_validation->set_rules('duration', '', 'required', array('required' => 'No Time Selected'));
        // $this->form_validation->set_rules('full_payment', '', 'required|numeric', array('required'=>'Please Input Payment', 'numeric'=> 'Please Input a valid amount'));
        $this->form_validation->set_rules('down_payment', '', 'numeric|greater_than[0]', array('required' => 'Please Input Payment', 'numeric' => 'Please Input a valid amount'));
        $this->form_validation->set_rules('location', '', 'required', array('required' => 'Location is required'));
     

        $data['client_id'] = $this->input->post('client');
        $data['event_name'] = $this->input->post('event_name');
        $data['event_date'] = $this->input->post('event_date');
        $data['event_time'] = $this->input->post('event_time');
        $data['duration'] = $this->input->post('duration');
        $data['down_payment'] = $this->input->post('down_payment');
        $data['location'] = $this->input->post('location');
        $data['notes'] = $this->input->post('notes');
//         echo '<pre>';
// print_r($data);
// echo '</pre>';
//         die;
        $date=date('y-m-d');
        $book_date = date_create($date);
        date_add($book_date, date_interval_create_from_date_string("3 days"));
        if(date_format($book_date,"Y-m-d")>$this->input->post('event_date')){
            echo '<script> alert("Booking date must be on or after '.date_format($book_date,"M d,Y").'. Please try again");</script>';
            $this->load->model("Admin_model");
            $data["fetch_data_client"] = $this->Admin_model->fetch_data_client();
            $this->load->view('admin/addevent', $data);
        }else{
        if ($this->form_validation->run() === false) {
            echo '<script> alert("Booking failed, Try again");</script>';
            $this->load->model("Admin_model");
            $data["fetch_data_client"] = $this->Admin_model->fetch_data_client();
            $this->load->view('admin/addevent', $data);
        } else {
                $book_id = $this->event_insert($data['package']);
                $this->session->set_flashdata('success_message', 'Event ' . $data['event_name'] . ' has been successfully booked!');
                redirect('events');
            }
        }
        }
  
    public function event_insert($package)
    {
        $timestamps = date('Y-m-d');
        if ($this->input->post('down_payment') >= $package['price']) {
            $payment_status = 'paid';
        } else {
            $payment_status = 'dp';
        }

        // echo '<pre>';
        // print_r($package);
        // print_r($this->input->post());
        // echo '</pre>';
        // die;
        
        $data = array(
            'client_id'         => $this->input->post('client'),
            'performer_id'      => $package['owner'],
            'full_amount'       => $package['price'],
            'package_id'        => $package['package_id'],
            'venue_name'        => $this->input->post('location'),
            'event_date'        => $this->input->post('event_date'),
            'event_from'        => $this->input->post('duration'),
            'event_to'          => $this->input->post('event_time'),
            'notes'             => $this->input->post('notes'),
            'full_amount'       => $package['price'],
            'down_payment'      => $this->input->post('down_payment'),
            'payment_status'    => $payment_status,
            'date_booked'       => $timestamps,
            'event_name'        => $this->input->post('event_name'),
            'artist_type'       => $package['artist_type'],
        );
      
        $this->db->insert('bookings', $data);
        $id = $this->db->insert_id();
        // echo $this->db->last_query();
        // die();
        return $id;
    }
    public function get_packages()
    {
        $this->db->join('users', 'user_id = owner');
        $this->db->select('packages.*, artist_type');
        $query = $this->db->get_where('packages', array('booked' => 0));
        return $query->result_array();
    }
    public function check_date()
    {
        if ($this->input->post('event_date') < date('Y-m-d')) {
            return $data['date_error'] = 'Date selected is invalid';
        } else {
            return null;
        }
    }
    public function check_time()
    {
        if ($this->input->post('event_date') <= date('Y-m-d')) {
            if ($this->input->post('duration') < date('H:i')) {
                return $data['time_error'] = 'Time selected is already passed';
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
// search start
    public function search_results($page = 0)
    {
        $this->load->model("Admin_model");
		$where = array();
		if ($this->input->get('user_type') != '') {
			$where['user_type'] = $this->input->get('user_type'); 
		}
		if ($this->input->get('status') != '') {
            $where['status'] = $this->input->get('status'); 
            
        }

        $total_rows = $this->Admin_model->count_results_user($where);
        $rpg = 5;
		$config['base_url'] = site_url('users');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $rpg;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 2;
		
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data["query_results_user"] = $this->Admin_model->query_results_user($where, $rpg, $page);
        $data['where'] = $where;
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/users', $data);
    }

    public function search_results_events($page = 0)
    {
        $this->load->model("Admin_model");

        $date='*';
        $name='*';
		if ($this->input->get('date') != '') {
			$date = $this->input->get('date'); 
		}
		if ($this->input->get('name') != '') {
           $name = $this->input->get('name'); 
        }

        $total_rows = $this->Admin_model->count_results_events($date, $name);		
		$rpg = 10;

		$config['base_url'] = base_url('events_page');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $rpg;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 2;
		
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data["query_data_event"] = $this->Admin_model->query_data_event($date, $name, $rpg, $page);
        // $data['where'] = $date;
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/events', $data);
    }
    public function search_results_package($page = 0)
    {
		$this->load->model("Admin_model");
        $where=array();
        $name='*';
		if ($this->input->get("user_id")) {
			$where['owner'] = $this->input->get("user_id");
        }
        if ($this->input->get('name') != '') {
            $name = $this->input->get('name'); 
         }
        
        $total_rows = $this->Admin_model->count_results_package($where);		
		$rpg = 3;

		$config['base_url'] = base_url('services');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $rpg;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 2;
		
		$this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        // $data["query_results_package_check"] = $this->Admin_model->query_results_package_check();
		$data["query_results_package"] = $this->Admin_model->query_results_package($where, $rpg, $page, $name);
        $data["fetch_data_perf"] = $this->Admin_model->fetch_data_perf();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/services', $data);
    }
    public function search_results_history($page = 0)
    {
        $this->load->model("Admin_model");

        $date='*';
        $name='*';
		if ($this->input->get('date') != '') {
			$date = $this->input->get('date'); 
		}
		if ($this->input->get('name') != '') {
           $name = $this->input->get('name'); 
        }

        $total_rows = $this->Admin_model->count_results_history($date, $name);		
		$rpg = 10;

		$config['base_url'] = base_url('history');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $rpg;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 2;
		
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
        $data["query_data_event_history"] = $this->Admin_model->query_data_event_history($date, $name, $rpg, $page);
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/history', $data);
    }
    public function search_results_report($page = 0)
    {
        $this->load->model("Admin_model");
        if ($this->input->post('user_id') == '') {
            $user_id = "*";
        } else {
            $user_id = $this->input->post('user_id');
        }
        if ($this->input->post('name') == '') {
            $name = "*";
        } else {
            $name = $this->input->post('name');
        }

        $total_rows = $this->Admin_model->count_results_report($user_id, $name);		
		$rpg = 3;

		$config['base_url'] = base_url('reports');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $rpg;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 2;
		
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data["query_results_report"] = $this->Admin_model->query_results_report($user_id, $rpg, $page, $name);
        $data["fetch_data_user_report"] = $this->Admin_model->fetch_data_user_report();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $data["fetch_data_history"] = $this->Admin_model->fetch_data_history();
        $this->load->view('/admin/reports', $data);
    }

   
   
// search_end
    public function services()
    {
		$this->load->model("Admin_model");
		$this->load->library('pagination');

		$config['base_url']=site_url('services');
		// $config['total_rows']=$total_rows;
		$config['per_page']="10";

		$config['reuse_query_string']='true';
		$this->pagination->initialize($config);
		// $data['pagination']=$this->pagination->create_links();
        $data["fetch_data_packages"] = $this->Admin_model->fetch_data_packages();
        $data["fetch_data_perf"] = $this->Admin_model->fetch_data_perf();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/services', $data);
    }
    public function history()
    {
        $this->load->model("Admin_model");
        $data["fetch_data_history"] = $this->Admin_model->fetch_data_history();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/history', $data);
    }
    public function histview($id)
    {
        $this->load->model("Admin_model");
        $data["fetch_data_histview"] = $this->Admin_model->fetch_data_histview();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/histview', $data);
    }
    public function reports()
    {
        $this->load->model("Admin_model");
        $data["fetch_data_user"] = $this->Admin_model->fetch_data_user();
        $data["fetch_data_event"] = $this->Admin_model->fetch_data_event();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $data["fetch_data_report"] = $this->Admin_model->fetch_data_report();
        $this->load->view('/admin/reports', $data);
    }
    public function notifications()
    {
        $this->load->model("Admin_model");
        $date='*';
    
		if ($this->input->get('date') != '') {
			$date = $this->input->get('date'); 
		}
        $data["fetch_data_notifications"] = $this->Admin_model->fetch_data_notifications($date);
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/notifications', $data);
    }
    public function profile($id)
    {
        $this->load->model("Admin_model");
        $data["fetch_data_profile"] = $this->Admin_model->fetch_data_profile();
        $data["fetch_data_user_rating"] = $this->Admin_model->fetch_data_user_rating($id);
		$data["fetch_data_user_galleries"] = $this->Admin_model->fetch_data_user_galleries();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/profile', $data);
    }
    public function eventview($id)
    {
        $this->load->model("Admin_model");
        $data["fetch_data_event_detail"] = $this->Admin_model->fetch_data_event_detail();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/eventview', $data);
    }

    public function events()
    {
        $this->load->model("Admin_model");
        $data["fetch_data_event"] = $this->Admin_model->fetch_data_event();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/events', $data);
    }
    public function users()
    {
		$this->load->model("Admin_model");
		
        $data["fetch_data_user"] = $this->Admin_model->fetch_data_user();
        $data["fetch_data_notifications_count"] = $this->Admin_model->fetch_data_notifications_count();
        $this->load->view('/admin/users', $data);
    }
    public function logout()
    {
        $this->load->view('/admin/logout');
    }

    public function file_check()
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['userfile']['name']);
        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {
            if ($_FILES['userfile']['error'] != 0) {
                $this->form_validation->set_message('file_check', 'Image File Exceed 2MB');
                return false;
            }
            // if($width > 5000 && $height > 5000){
            //     $this->form_validation->set_message('file_check', 'Image Dimension Exceed 5000 x 5000');
            //     return false;
            // }
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file image to upload.');
            return false;
        }
    }
    public function file_check_video(){
        $allowed_mime_type_arr = array('video/mp4');
        // echo '<pre>';
        // print_r($this->input->post('userfile'));
        // echo '</pre>';
        // die;
        $mime = get_mime_by_extension($_FILES['userfile']['name']);
        if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
            if($_FILES['userfile']['error'] != 0){
                echo '<script>alert("Error Video is Corrupted, try again");</script>';
                echo '<script> history.go(-1);</script>';
                return false;

            }
            if(in_array($mime, $allowed_mime_type_arr)){
                if($_FILES['video1']['size'] <= 200000000){
                    return true;
                }else{
                    echo '<script>alert("Video exceeds 200mb, Please try again");</script>';
                    echo '<script> history.go(-1);</script>';
                    return false;
                }
            }else{
                echo '<script>alert("Mp4 file are only acceptable");</script>';
                echo '<script> history.go(-1);</script>';
                return false;
            }
        }else{
            return true;
        }
    }	

}
