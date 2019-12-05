<?php
    class Booking_Model extends CI_Model {
        public function index (){
			$data = $this->Booking_model->get_packages();

			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';	
			// die;
			
			$templates['title'] = 'Booking';
			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/booking', $data);
			$this->load->view('inc/footer');            
		}        
		public function booking_book_event(){
			$id = $this->uri->segment(2);
			
			$this->db->select('packages.*, users.*, users.created_at as u_created_at, users.updated_at as u_updated_at');
			$this->db->join('users', 'users.user_id = packages.owner');
			$temp = $this->db->get_where('packages', array('package_id'=>$id));
			$data['package'] = $temp->row_array();

			$this->db->order_by('created_at', 'ASC');
			$query = $this->db->get_where('rating', array('package_id'=>$this->uri->segment(2)));
			$data['rating'] = $query->result_array();
			
			// echo '<pre>';
			// print_r($data['rating']);
			// echo '</pre>';
			
			// testing
			$sum = 0;
			$i = 0;
			foreach($data['rating'] as $r){
				$sum = $sum + $r['rate'];
				$i++;
			}
			if($sum != 0){
				$data['average'] = $sum/$i;
			}

			
			$templates['title'] = 'Booking';
			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/booking_add_event', $data);
			$this->load->view('inc/footer');
		}
		public function booking_attempt(){
			$templates['title'] = 'Book Event';
			$id = $this->uri->segment(2);			
			$this->db->where('package_id', $id);
			$this->db->join('users', 'users.user_id = packages.owner');
			$this->db->select('packages.*, users.*');
			$temp = $this->db->get('packages');
			$data['package'] = $temp->row_array();
			$limit_price = $data['package']['price'];

			// echo '<pre>';
			// print_r($data['package']);
			// echo '</pre>';
			// die;

			$this->form_validation->set_rules('event_name', '', 'required', array('required'=>'Please Input Event Name'));
			$this->form_validation->set_rules('event_date', '', 'required|callback_check_date', array('required'=>'No Date Selected'));
			$this->form_validation->set_rules('duration', '', 'required', array('required'=>'No Time Selected'));
			$this->form_validation->set_rules('event_time', '', 'callback_check_to_time', array('required'=>'No Time Selected'));
			// $this->form_validation->set_rules('full_payment', '', 'required|numeric', array('required'=>'Please Input Payment', 'numeric'=> 'Please Input a valid amount'));
			$this->form_validation->set_rules('down_payment', '', 'required|numeric', array('required'=>'Please Input Payment', 'numeric'=> 'Please Input a valid amount'));
			$this->form_validation->set_rules('location', '', 'required', array('required'=>'Location is required'));
			$this->form_validation->set_rules('notes', '', 'required', array('required'=>'Notes is required'));

			$data['event_name'] = $this->input->post('event_name');
			$data['event_date'] = $this->input->post('event_date');
			$data['event_time'] = $this->input->post('event_time');
			$data['duration'] = $this->input->post('duration');
			$data['full_payment'] = $this->input->post('full_payment');
			$data['down_payment'] = $this->input->post('down_payment');
			$data['location'] = $this->input->post('location');
			$data['notes'] = $this->input->post('notes');

			// die($data['event_time']);

			if($this->form_validation->run() === FALSE){

				$this->load->view('inc/header-client', $templates);
				$this->load->view('client/booking_add_event', $data);
				$this->load->view('inc/footer');
			}else{
				$data['date_error'] = $this->Booking_model->check_date($data); 
				$data['time_error'] = $this->Booking_model->check_time($data);

				if($data['date_error'] || $data['time_error']){
					$this->load->view('inc/header-client', $templates);
					$this->load->view('client/booking_add_event', $data);
					$this->load->view('inc/footer');				
				}else{	
					$book_id = $this->Booking_model->event_insert($data['package']);
					// echo '<pre>';
					// print_r($data['package']);
					// echo '</pre>';
					// die;
					$notif['message'] = 'Event: '.$data['event_name'].' successfully book! Click here to view.';
					$notif['links'] = base_url().'events/'.$book_id;
					$notif['target_user_id'] = $data['package']['user_id'];
					$notif['target_message'] = 'Someone has been booked to your package! Check it out!';
					$notif['target_links'] = base_url().'p_bookings';
					$notif['notif_status'] = 'created' ;
					$notif['notif_type'] = 'event' ;
					$this->Notification_model->index($notif);					

					$this->session->set_flashdata('success_message', 'Event '.$data['event_name'].' has been successfully booked!');
					// $this->session->set_flashdata('warning_message', 'Note: Your payment has been changed to '.);
					redirect('booking');			
				}		
			}
		}
		public function event_insert($package){
			$timestamps = date('Y-m-d');
			if($this->input->post('down_payment') >= $package['price']){
				$payment_status = 'paid';
			}else{
				$payment_status = 'dp';
			}

			// echo '<pre>';
			// print_r($package);
			// print_r($this->input->post());
			// echo '</pre>';
			// die;

			$data = array(
				'client_id'=> $this->session->userdata('user_id'),
				'performer_id'=> $package['owner'],
				'package_id'=> $package['package_id'],
				'venue_name'=> $this->input->post('location'),
				'event_date'=> $this->input->post('event_date'),
				'event_from'=> $this->input->post('duration'),
				'event_to'=> $this->input->post('event_time'),
				'notes'=> $this->input->post('notes'),
				'full_amount'=> 0,
				'down_payment'=> $this->input->post('down_payment'),
				'payment_status'=> $payment_status,
				'date_booked'=> $timestamps,
				'event_name'=> $this->input->post('event_name'),
				'artist_type' => $package['artist_type']
			
			);
			// die($package['artist_type']);
			$this->db->insert('bookings', $data);
			$id = $this->db->insert_id();
			// echo $this->db->last_query();
			// die();

			// $this->db->set('interested', $this->session->userdata('user_id'));
			// $this->db->where('package_id', $package['package_id']);
			// $this->db->update('packages');
			// return $id;

			// LOGIC CHANGE! REASON: UNYA RA MA BOOKED = 1 IF ANG PERFORMER NAKA ACCEPT OG PENDING REQUEST
			$this->db->set('interested', 1);
			$this->db->where('package_id', $package['package_id']);
			$this->db->update('packages');
			return $id;
		}
		public function get_packages(){
			$this->db->join('users', 'user_id = owner');
			$this->db->select('packages.*, users.artist_type');
			$query = $this->db->get_where('packages', array('booked'=> 0));
			$temp = $query->result_array();		
			
			$query = $this->db->get_where('bookings', array('client_id'=>$this->session->userdata('user_id'), 'status !='=> 'cancel'));
			$temp2 = $query->result_array();

			$data['packages'] = $temp;
			$data['bookings'] = $temp2;
			

			return $data;

			// echo '<pre>';
			// print_r($temp);
			// echo '</pre>';	
			// die;

			// foreach($temp as $temp){
			// 	$query = $this->db->get_where('bookings', array('client_id'=>$this->session->userdata('user_id'), 'on_going'=>1, 'status'=>'pending'));
			// 	$data[] = $query->result_array();
			// }

			// if(isset($data)){
			// 	return $data;
			// }else{
			// 	return FALSE;
			// }

			// $query = $this->db->get_where('bookings', array('on_going' => 1, 'client_id'=>$this->session->userdata('user_id')));
			// $temp2 = $query->result_array();			

			// if($temp && $temp2){
			// 	foreach($temp as $t){
			// 		foreach($temp2 as $t2){
			// 			if($t2['package_id'] != $t['package_id']){
			// 				$temp3[] = $t;
			// 			}
			// 		}
			// 	}
			// 	return $temp3;
			// }else{
			// 	return $temp;
			// }

			// echo '<pre>';
			// print_r($data);
			// // print_r($temp2);
			// print_r($temp3);
			// echo '</pre>';
			// die;
		}
		public function check_date(){
			if($this->input->post('event_date') < date('Y-m-d')){
				return $data['date_error'] = 'Date selected is invalid';
			}else{			
				return NULL;
			}
		}
		public function check_time(){	
			if($this->input->post('event_date') <= date('Y-m-d')){
				if($this->input->post('duration') < date('H:i')){
					return $data['time_error'] = 'Time selected is already passed';										
				}else{
					return NULL;
				}
			}else{			
				return NULL;
			}			
		}
		public function check_book_package($id){
			$this->db->join('bookings', 'bookings.package_id = packages.package_id');
			// $query = $this->db->get_where('packages', array('packages.package_id'=>$this->uri->segment(2)));
			$query = $this->db->get_where('packages', array('packages.package_id'=>$id));
			return $data = $query->row_array();

			print_r($data);
			die;
		}
    }