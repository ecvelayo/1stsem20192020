<?php
    class Search_model extends CI_Model {
        public function index (){
			function query_results_package($where,$rpg, $page)
			{
			 
			   $this->db->select("*");
			   $this->db->from("packages");
			  // if($user_id!="*")
			  // {
			  //  $this->db->where("owner",$user_id);
			  // }      
			  // $this->db->where("package_status!=","hide");
			  $where["package_status!="] = "hide";
			  $this->db->where($where);
			  $this->db->join("users",'packages.owner=users.user_id');
			  $this->db->order_by('booked');
			  $this->db->limit($rpg, $page);
			   $query = $this->db->get();
			   return $query;
			}
        
            }
        }