<?php 

class Admin_model extends CI_Model
{
//  delete start
   function query_data_transaction($id)
    {
       $id = $this->uri->segment(2);
       $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname, u2.photo AS performer_photo,users.photo as client_photo");
       $this->db->from("bookings");
       $this->db->join("users",'bookings.client_id=users.user_id');
       $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
       $this->db->where("client_id",$id);
       $this->db->or_where("performer_id",$id);
       $query = $this->db->get();
       return $query;
    }
    function update_hide_package($offense)
    {
       $status= array("status" 	=> "cancel");
       $id = $this->uri->segment(2);
       $this->db->select("*");
       $this->db->from("packages");
       $this->db->where("package_id",$id);
       $this->db->update("packages",$offense);
       
       $this->db->select("*");
       $this->db->from("bookings");
       $this->db->where("package_id",$id);
       $this->db->update("bookings",$status);
    }
    function update_hide_report($offense)
    {
       $id = $this->uri->segment(2);
       $this->db->select("*");
       $this->db->from("reports");
       $this->db->where("report_id",$id);
       $this->db->update("reports",$offense);
    }
    function update_hide_event()
    {
       $status= array("status" 	=> "cancel");
       $id = $this->uri->segment(2);
       $this->db->select("*");
       $this->db->from("bookings");
       $this->db->where("booking_id",$id);
       $this->db->update("bookings",$status);
    }
    function update_hide_user($offense)
    {
       $id = $this->uri->segment(2);
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("user_id",$id);
       $this->db->update("users",$offense);

       $status1= array("package_status" 	=> "hide");
       $status= array("status" 	=> "cancel");
       $id = $this->uri->segment(2);
       $this->db->select("*");
       $this->db->from("packages");
       $this->db->where("owner",$id);
       $this->db->update("packages",$status1);
      
       $this->db->select("*");
       $this->db->from("bookings");
       $this->db->where("client_id",$id);
       $this->db->update("bookings",$status);
    }
//  delte end
// offense update start
    function update_offense_user($offense)
    {
       $id = $this->uri->segment(2);
       $status = array("status" => "cancel");
       $this->db->select("report_count");
       $this->db->from("users");
       $this->db->where("user_id",$id);
       $this->db->update("users", $offense);

       $this->db->select("*");
       $this->db->from("bookings");
       $this->db->where("client_id",$id);
       $this->db->or_where("performer_id",$id);
       $this->db->update("bookings", $status);
    }
    function update_offense_user1($offense)
    {
       $id = $this->session->userdata('user_id');
       $this->db->select("status");
       $this->db->from("users");
       $this->db->where("user_id",$id);
       $this->db->update("users", $offense);
    }
    function update_recover_user($recover)
    {
       $id = $this->uri->segment(2);
       $this->db->select("status");
       $this->db->from("users");
       $this->db->where("user_id",$id);
       $this->db->update("users", $recover);
    }
// offense update end
// views/choices start
    function fetch_data_event()
    {
       $status = "hide";
       $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
       $this->db->from("bookings");
       $this->db->where("bookings.status!=",$status);
       $this->db->join("users",'bookings.client_id=users.user_id');
       $this->db->join("users as u2",'bookings.performer_id=u2.user_id');

       $query = $this->db->get();
       return $query;
    }
    function fetch_data_client()
    {
      $status = "hide";
      $this->db->select("*");
       $this->db->from("users");
       $this->db->where("user_type=",'client');
       $this->db->where("status!=", $status);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_perf()
    {
      $status = "hide";
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("user_type=",'performer');
       $this->db->where("status !=",$status);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_packages()
    {
      $status = "hide";
       $this->db->select("*");
       $this->db->from("packages");
       $this->db->where("package_status !=",$status);
       $this->db->join("users",'packages.owner=users.user_id');
       $query = $this->db->get();
       return $query;
    }
    
    function fetch_data_history()
    {
       $date = date('y-m-d');
       $status = "pending";
       $status1 = "hide";
       $this->db->select("bookings.*, users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
       $this->db->from("bookings");
       $this->db->join("users",'bookings.client_id=users.user_id');
       $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
       $this->db->where("event_date <",$date);
       $this->db->where("bookings.status !=", $status);
       $this->db->where("bookings.status !=", $status1);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_histview()
    {
       $id = $this->uri->segment(2);
       $this->db->select("feedbacks.*,bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname, u2.photo AS performer_photo,users.photo as client_photo");
       $this->db->from("feedbacks");
       $this->db->join("users",'feedbacks.from_id=users.user_id');
       $this->db->join("users as u2",'feedbacks.to_id=u2.user_id');
       $this->db->join("bookings",'feedbacks.booking_id=bookings.booking_id');
       $this->db->where("feedback_id",$id);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_report()
    {
      $this->db->select("reports.*,bookings.*,users.fname as report_from_fname,u2.fname AS report_to_fname,users.lname as report_from_lname,u2.lname AS report_to_lname, u2.photo AS report_from_photo,users.photo as report_to_photo");
       $this->db->from("reports");
       $this->db->where("reports_status!=","hide");
       $this->db->join("users",'reports.report_from=users.user_id');
       $this->db->join("users as u2",'reports.report_to=u2.user_id');
       $this->db->join("bookings",'reports.booking_id=bookings.booking_id');
       $query = $this->db->get();
       return $query;
    }
//search start
    function query_results_user($where, $rpg, $page)
    {
       $this->db->select("*");
       $this->db->from("users");
      
      $where["user_type!="] = "admin";
      $where["status!="] = "hide";
      $this->db->where($where);
      $this->db->order_by('user_id DESC, fname ASC');
      $this->db->limit($rpg, $page);
      $query = $this->db->get();
    
       return $query;
    }
    function count_results_user($where)
    {
     
       $this->db->from("users");
      
      $where["user_type!="] = "admin";
      $where["status!="] = "hide";
      $this->db->where($where);
      $t = $this->db->count_all_results();
       return $t;
     
    }
    function count_results_package($where)
    {
     
       $this->db->from("packages");
      $where["package_status!="] = "hide";
      $this->db->where($where);
      $t = $this->db->count_all_results();
       return $t;
     
    }
    function query_results_package($where,$rpg, $page, $name)
    {
     
       $this->db->select("*");
       $this->db->from("packages");
      // if($user_id!="*")
      // {
      //  $this->db->where("owner",$user_id);
      // }      
      // $this->db->where("package_status!=","hide");
      $where["package_status!="] = "hide";
      if($name != "*"){
         $this->db->like("package_name",$name,'both');
         $this->db->or_like("details",$name,'both');
         $this->db->or_like("users.fname",$name,'both');
         $this->db->or_like("users.lname",$name,'both');
      }
      $this->db->where($where);
      $this->db->join("users",'packages.owner=users.user_id');
      $this->db->order_by('booked');
      $this->db->limit($rpg, $page);
       $query = $this->db->get();
       return $query;
    }
   //  function query_results_package_check()
   //  {
   //    $date1 = date('y-m-d');
   //    $count = array("booked"=>"1");
   //    $this->db->select("*");
   //    $this->db->from("bookings");
   //    $this->db->where("event_date <",$date1);
   //    $this->db->join("bookings",'packages.package_id=bookings.package_id');
   //    $this->db->update("packages",$count);
   //    $query = $this->db->get();
   //    return $query;
   //  }
    function query_results_report($user_id, $rpg, $page, $name)
    {
     
      $this->db->select("reports.*,bookings.*,users.fname as report_from_fname,u2.user_type as report_to_usertype,users.user_type as report_from_usertype,u2.fname AS report_to_fname,users.lname as report_from_lname,u2.lname AS report_to_lname, u2.photo AS report_from_photo,users.photo as report_to_photo");
      $this->db->from("reports");
      $this->db->where("reports_status!=","hide");
      if($user_id!="*"){
         $this->db->where("report_from=",$user_id);
         $this->db->or_where("report_to=",$user_id);
        }
      $this->db->join("users",'reports.report_from=users.user_id');
      $this->db->join("users as u2",'reports.report_to=u2.user_id');
      $this->db->join("bookings",'reports.booking_id=bookings.booking_id');
      if($name!="*"){
         $this->db->like("event_name",$name,'both');
         $this->db->or_like("users.fname",$name,'both');
         $this->db->or_like("users.lname",$name,'both');
         $this->db->or_like("u2.fname",$name,'both');
         $this->db->or_like("u2.lname",$name,'both');
        }
      $this->db->order_by('date_reported DESC');
      $this->db->limit($rpg, $page);
      $query = $this->db->get();
      return $query;
    }
    function count_results_report($user_id, $name)
    {
     
      $this->db->select("reports.*,bookings.*,users.fname as report_from_fname,u2.user_type as report_to_usertype,users.user_type as report_from_usertype,u2.fname AS report_to_fname,users.lname as report_from_lname,u2.lname AS report_to_lname, u2.photo AS report_from_photo,users.photo as report_to_photo");
      $this->db->from("reports");
      $this->db->where("reports_status!=","hide");
      if($user_id!="*"){
         $this->db->where("report_from=",$user_id);
         $this->db->or_where("report_to=",$user_id);
        }
      $this->db->join("users",'reports.report_from=users.user_id');
      $this->db->join("users as u2",'reports.report_to=u2.user_id');
      $this->db->join("bookings",'reports.booking_id=bookings.booking_id');
      $this->db->order_by('date_reported DESC');

      $t = $this->db->count_all_results();
       return $t;
     
    }
    function query_data_event($date,$name,$rpg,$page)
    {
     
      $status = "hide";
      $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
      $this->db->from("bookings");
      $this->db->where("bookings.status!=",$status);

      if($date != "*"){
         $this->db->where("bookings.event_date",$date);
      }
   
      if($name != "*"){
         $this->db->like("event_name",$name,'both');
         $this->db->or_like("users.fname",$name,'both');
         $this->db->or_like("users.lname",$name,'both');
         $this->db->or_like("u2.fname",$name,'both');
         $this->db->or_like("u2.lname",$name,'both');
      }

      $this->db->join("users",'bookings.client_id=users.user_id');
      $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
      $this->db->order_by('event_date DESC','event_from DESC');
      $this->db->limit($rpg, $page);

      $query = $this->db->get();
      return $query;
    }
    function count_results_events($date, $name)
    {
     
      $status = "hide";
      $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
      $this->db->from("bookings");
      $this->db->where("bookings.status!=",$status);

      if($date != "*"){
         $this->db->where("bookings.event_date",$date);
      }
   
      if($name != "*"){
         $this->db->like("event_name",$name,'both');
         $this->db->or_like("users.fname",$name,'both');
         $this->db->or_like("users.lname",$name,'both');
         $this->db->or_like("u2.fname",$name,'both');
         $this->db->or_like("u2.lname",$name,'both');
      }

      $this->db->join("users",'bookings.client_id=users.user_id');
      $this->db->join("users as u2",'bookings.performer_id=u2.user_id');

      $t = $this->db->count_all_results();
       return $t;
     
    }
    function fetch_data_user_rating ($id)
    {
      $this->db->select_avg("client_rating");
      $this->db->from("bookings");
      $this->db->where("performer_id",$id);

      $t = $this->db->get();
      return $t;
    
     }
     function query_data_event_history($date,$name,$rpg,$page)
     {
        $date1 = date('y-m-d');
        $status = "pending";
        $this->db->select("bookings.*, users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
        $this->db->from("bookings");
        $this->db->join("users",'bookings.client_id=users.user_id');
        $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
        $this->db->where("event_date <",$date1);
        $this->db->where("bookings.status !=", $status);
        $this->db->order_by('event_date DESC','event_from DESC');
        $this->db->limit($rpg, $page);
        
        if($date != "*"){
          $this->db->like("bookings.event_date",$date,'both');
       }
    
       if($name != "*"){
          $this->db->like("event_name",$name,'both');
          $this->db->or_like("users.fname",$name,'both');
          $this->db->or_like("users.lname",$name,'both');
          $this->db->or_like("u2.fname",$name,'both');
          $this->db->or_like("u2.lname",$name,'both');
       }
     
        $query = $this->db->get();
        return $query;
     }
     function count_results_history($date, $name)
     {
      
       $status = "hide";
       $date1 = date('y-m-d');
       $status1 = "pending";
       $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname");
       $this->db->from("bookings");
       if($date != "*"){
          $this->db->where("bookings.event_date",$date);
       }
    
       if($name != "*"){
          $this->db->like("event_name",$name,'both');
          $this->db->or_like("users.fname",$name,'both');
          $this->db->or_like("users.lname",$name,'both');
          $this->db->or_like("u2.fname",$name,'both');
          $this->db->or_like("u2.lname",$name,'both');
       }
       $this->db->where("bookings.status!=",$status1);
       $this->db->where("event_date <",$date1);
       $this->db->where("bookings.status !=", $status);
 
       $this->db->join("users",'bookings.client_id=users.user_id');
       $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
 
       $t = $this->db->count_all_results();
        return $t;
      
     }
//search end
    function fetch_data_user()
    {
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("status!=","hide");
       $this->db->where("user_type!=","admin");
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_user_report()
    {
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("status!=","hide");
       $this->db->where("user_type!=","admin");
       $query = $this->db->get();
       return $query;
    }
     function fetch_data_user_galleries()
    {
       $this->db->select("*");
       $id = $this->uri->segment(2);
       $this->db->from("band_galleries");
       $this->db->where("user_id",$id);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_profile()
    {
       $id = $this->uri->segment(2);
       $this->db->select("users.*, count(report_to) as report_counts");
       $this->db->from("users");
       $this->db->join("reports",'report_to=user_id');
       $this->db->where("user_id",$id);
       $query = $this->db->get();
       return $query;
    }
    function fetch_data_event_detail()
    {
       $id = $this->uri->segment(2);
       $this->db->select("bookings.*,users.fname as client_fname,u2.fname AS performer_fname,users.lname as client_lname,u2.lname AS performer_lname, u2.photo AS performer_photo,users.photo as client_photo");
       $this->db->from("bookings");
       $this->db->join("users",'bookings.client_id=users.user_id');
       $this->db->join("users as u2",'bookings.performer_id=u2.user_id');
       $this->db->where("booking_id",$id);
       $query = $this->db->get();
       return $query;
    }
 
//  views/choices end
//  notifications start
    function fetch_data_notifications($date)
    {
      if($date=="*"){
      $date = date('Y-m-d');
      }
      $this->db->select("*");
      $this->db->from("notifications");
      $this->db->where("date(`created_at`)",$date);
      $this->db->order_by('admin_view ASC, created_at DESC');

      $query = $this->db->get(); 
      return $query;
    }
    function fetch_data_notifications_count()
    {
      $date = date('Y-m-d');
      $this->db->select("*");
      $this->db->from("notifications");
      $notified = "notified";
      $this->db->where("admin_view",$notified);
      $this->db->where("date(`created_at`)",$date);
      $query2 = $this->db->count_all_results();
      $newdata = array(
          'notif_count' => $query2 
      );    
      return $this->session->set_userdata($newdata);;
      }
      function insert_data_notifications($notif_insert)
      {
         $this->db->insert("notifications", $notif_insert);
      }
      function insert_data_notifications2($notif_insert2)
      {
         $this->db->insert("notifications", $notif_insert2);
      }
//  notifications end
//  insert start
    function insert_data_users($data_insert)
    {
       $this->db->insert("users", $data_insert);
    }
    function insert_data_bookings($data_insert)
    {
       $this->db->insert("bookings", $data_insert);
    }
    function insert_data_report($data_insert)
    {
      $this->db->insert("reports", $data_insert);
    }
// insert end

}