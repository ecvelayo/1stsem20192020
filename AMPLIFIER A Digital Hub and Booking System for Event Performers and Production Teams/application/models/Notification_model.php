<?php
    class Notification_Model extends CI_Model {
        public function index($notif){

            if(isset($notif['target_message'])){
                $notif_1 = $notif['target_message'];
            }else{
                $notif_1 = NULL;
            }
            if(isset($notif['target_links'])){
                $notif_2 = $notif['target_links'];
            }else{
                $notif_2 = NULL;
            }
            if(isset($notif['target_user_id'])){
                $notif_3 = $notif['target_user_id'];
            }else{
                $notif_3 = NULL;
            }
            if(isset($notif['notif_status'])){
                $notif_status = $notif['notif_status'];
            }else{
                $notif_status = NULL;
            }
            if(isset($notif['notif_type'])){
                $notif_type = $notif['notif_type'];
            }else{
                $notif_type = NULL;
            }

            $date = date('Y-m-d H:i:s');
            $array = array (
                'id' => null,
                'user_id' => $this->session->userdata('user_id'),
                'target_user_id' => $notif_3,
                'notif_type' => $notif_type,
                'notif_status' => $notif_status,
                'status' => 'notified',
                'created_at' => $date,
                'notif_name' => $notif['message'],
                'target_notif_name' => $notif_1,
                'links' => $notif['links'],
                'target_links' => $notif_2
            );
            
            $this->db->insert('notifications', $array);
            return $this->db->insert_id();
        }
        public function get_notifications ($limit, $offset){

            if($limit){
                $this->db->limit($limit, $offset);
            }              
            $this->db->order_by('id', 'DESC');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->or_where('target_user_id', $this->session->userdata('user_id'));
            $query = $this->db->get('notifications');
            $temp = $query->result_array();            
            return $temp;

        }
        public function count_notifications (){
            $this->db->order_by('id', 'DESC');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->or_where('target_user_id', $this->session->userdata('user_id'));
            $query = $this->db->count_all_results('notifications');
            return $query;
        }
        public function notification_badge (){
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->where('status', 'notified');
            $this->db->or_where('target_user_id', $this->session->userdata('user_id'));
            $this->db->where('target_status', 'notified');
            $query = $this->db->get('notifications');
            $data = $query->result_array();
            return  count($data);
        }
        public function notified_to_seen ($notifications){
            foreach($notifications as $n){
                if($n['status'] == 'notified'){
                    $this->db->set('status', 'seen');
                    $this->db->where(array('status'=>'notified', 'user_id'=>$this->session->userdata('user_id'), 'created_at'=>$n['created_at']));
                    $this->db->update('notifications');
                }else if($n['target_status'] == 'notified'){
                    $this->db->set('target_status', 'seen');
                    $this->db->where(array('target_status'=>'notified', 'user_id'=>$this->session->userdata('user_id'), 'created_at'=>$n['created_at']));
                    $this->db->update('notifications');
                }
            }
        }
        public function check_event_reminder_trigger($event_message){
            $query = $this->db->get_where('notifications', array('notif_name'=>$event_message, 'user_id'=>$this->session->userdata('user_id')));
            $data = $query->row_array();

            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }