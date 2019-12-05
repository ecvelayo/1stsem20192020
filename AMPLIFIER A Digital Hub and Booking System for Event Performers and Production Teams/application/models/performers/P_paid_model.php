<?php 
    class P_Paid_Model extends CI_Model {
        public function index (){
            $query = $this->db->get_where('bookings', array('booking_id'=>$this->uri->segment(2)));
            $data = $query->row_array();

            $query = $this->db->get_where('packages', array('package_id'=>$data['package_id']));
            $data1 = $query->row_array();

            // echo '<pre>';
            // print_r($data);
            // // prinst_r($data1);
            // echo '</pre>';
            // die;

            $payment = $data1['price'];

            $this->db->set(array('payment_status'=>'paid', 'down_payment'=>$payment));
            $this->db->where(array('booking_id'=>$this->uri->segment(2)));
            $this->db->update('bookings');

            $this->session->set_flashdata('success_message', 'Event: '.$data['event_name'].' successfully paid!');
            redirect('p_bookings');
            // echo $this->db->last_query();
            // die;
        }
    }