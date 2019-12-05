<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class my_model extends CI_Model {

	//create a contructor function
	public function __construct(){
		parent:: __construct();

		//load the database
		$this->load->database();
	}

	//create a model function that will allow to check the username and password for login validation
	public function model_check_username_password($username, $password){

		//add the filter for username and password
		$this->db->where("Username", $username);
		$this->db->where("Password", md5(md5($password)));

		//get the data from the useraccount table
		$query = $this->db->get("useraccount");

		//check if there is an existing account
		if($query->num_rows() > 0){

			//return message
			return "true";

		} else{

			//return message
			return "false";

		}

	}

	//create a function that will get the role of the user
	public function model_get_user_role($username){

		//add a filter for username
		$this->db->where("Username", $username);

		//get the data from the useraccount table
		$query = $this->db->get("useraccount");


		return $query->result_array();

		// //return the user role
		// return gettype($query);

	}

	//create a function that will get the role of the user
	public function model_user_is_deactivated($username){

		//add a filter for username
		$this->db->where("Username", $username);
		$this->db->where("IsActive", 0);

		//get the data from the useraccount table
		$query = $this->db->get("useraccount");

		//check if there is an existing account
		if($query->num_rows() > 0){

			//return message
			return "true";

		} else{

			//return message
			return "false";

		}

	}

	//create a model function for getting the data from user table
	public function model_get_data($table){

		//create a query and get the data
		$query = $this->db->get($table);

		//return the query result into array
		return $query->result_array();
	}

	//create a model function for getting the data from table with id
	public function model_get_data_with_id($table, $condition){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);

		//create a query and get the data
		$query = $this->db->get();

		//return the query result into array
		return $query->result_array();
	}

	//create a model function for getting the user id from table with username
	public function model_get_userid_by_username($table, $username){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("Username", $username);

		//create a query and get the data
		$query = $this->db->get();

		return $query->result_array();
	}

	//create a model function for getting the user id from table with userid
	public function model_get_teacherid_by_userid($userid){

		$this->db->select('*');
		$this->db->from("teacherclass");
		$this->db->join("studentlist", "teacherclass.StudentListId = studentlist.StudentListId", "INNER");
		$this->db->where("studentlist.UserAccountId", $userid);

		//create a query and get the data
		$query = $this->db->get();

		return $query->result_array();
	}

	//create a model function for getting the user id from table with userid
	public function model_get_gradelevel_by_userid($userid){

		$this->db->select('*');
		$this->db->from("studentlist");
		$this->db->where("UserAccountId", $userid);

		//create a query and get the data
		$query = $this->db->get();

		return $query->result_array();
	}

	//create a model function for inserting a data into user table
	public function model_insert_data($table, $data){

		//call the database and do the insertion
		$this->db->insert($table, $data);

		//return the result
		return "Inserted";
	}

	//create a model function for inserting a data into table
	public function model_insert_if_not_exists_or_update($table, $data){

		//let's check the data using these query
		//if there is an existing data 
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where("BookId", $data["BookId"]);
		$result = $this->db->get();

		//if there is an existing data then we have to do nothing to avoid data redundancy
		if($result->num_rows() > 0){

			$this->db->set('TotalViews', 'TotalViews+1', FALSE);
			$this->db->where("BookId", $data["BookId"]);
			$this->db->update($table);

			//return the result
			return "Duplicated";

		}
		else{

			//call the database and do the insertion
			$this->db->insert($table, $data);

			//return the result
			return "Inserted";
		}
	}

	//create a model function for inserting without a duplicated data into user table
	public function model_insert_without_duplicated_data($table, $data){

		//let's check the data using these query
		//if there is an existing data 
		$this->db->select("*");
		$this->db->from("examresult");
		$this->db->where("StudentId", $data["StudentId"]);
		$this->db->where("ExamId", $data["ExamId"]);
		$this->db->where("Date", $data["Date"]);
		$this->db->where("TeacherId", $data["TeacherId"]);
		$this->db->where("GradeLevel", $data["GradeLevel"]);
		$this->db->where("SchoolYear", $data["SchoolYear"]);
		// $this->db->where('DATEDIFF("'.$data["Date"].'", Date) > 7');
		$result = $this->db->get();

		//if there is an existing data then we have to do nothing to avoid data redundancy
		if($result->num_rows() > 0){

			//return the result
			return "Duplicated";

		}
		else{

			//call the database and do the insertion
			$this->db->insert($table, $data);

			//return the result
			return "Inserted";
		}
	}

	//create a model function for inserting without a duplicated data into teacher class table
	public function model_insert_without_duplicated_data_teacher_class($table, $data){

		//let's check the data using these query
		//if there is an existing data 
		$this->db->select("*");
		$this->db->from("teacherclass");
		$this->db->where("StudentListId", $data["StudentListId"]);
		$this->db->where("TeacherId", $data["TeacherId"]);
		$this->db->where("SchoolYear", $data["SchoolYear"]);
		$result = $this->db->get();

		//if there is an existing data then we have to do nothing to avoid data redundancy
		if($result->num_rows() > 0){

			//return the result
			return "Duplicated";

		}
		else{

			//call the database and do the insertion
			$this->db->insert($table, $data);

			//return the result
			return "Inserted";
		}
	}

	//SAM 11-12-2019 I have added another function that will insert a data from 2 table that will avoid duplicated data
	//create a model function for inserting 2 table data into user table
	public function model_insert_2_table_data_without_duplicated_data($table1, $data1, $table2, $data2, $idToChange){

		//let's check the data using these query
		//if there is an existing data 
		$this->db->select("*");
		$this->db->from("useraccount");
		$this->db->where("Username", $data2["Username"]);
		$result = $this->db->get();

		//if there is an existing data then we have to do nothing to avoid data redundancy
		if($result->num_rows() > 0){

			//return the result
			return "Duplicated";

		}
		else{

			// will insert the first table
			$this->db->insert($table1, $data1);

			// will get the last inserted id
			// purpose: to store it to the second table
			$last_id = $this->db->insert_id();

			// assigned the last inserted id from table1
			$data2[''.$idToChange.''] = $last_id;

			// save data to database
			$this->db->insert($table2, $data2);

			return "Inserted";
		}

	}

	//create a model function for inserting 2 table data into user table
	public function model_insert_2_table_data($table1, $data1, $table2, $data2, $idToChange){

		// will insert the first table
		$this->db->insert($table1, $data1);

		// will get the last inserted id
		// purpose: to store it to the second table
		$last_id = $this->db->insert_id();

		// assigned the last inserted id from table1
		$data2[''.$idToChange.''] = $last_id;

		// save data to database
		$this->db->insert($table2, $data2);

		return "Inserted";

	}

	//create a model function for updating a data from user table
	public function model_update_data($table, $data, $condition){

		//make a condition before updating
		$this->db->where($condition);

		//then update the table with the data
		$this->db->update($table, $data);

		//make a query for checking the affected rows
		$result = $this->db->affected_rows();

		//if the result has an affected rows more than 0
		if($result > 0){

			//then return the result
			return "Updated";
		}
		else{

			//return failed result
			return "Failed";
		}
	}

	//create a model function for updating a data from user table
	public function model_activate_deactivate_data($table, $data, $condition){

		//make a condition before updating
		$this->db->where($condition);

		//then update the table with the data
		$this->db->update($table, $data);

		//make a query for checking the affected rows
		$result = $this->db->affected_rows();

		//if the result has an affected rows more than 0
		if($result > 0){

			//then return the result
			return "Deactivated";
		}
		else{

			//return failed result
			return "Failed";
		}
	}

	//create a model function that will get data from 2 table with specific selection and condition
	public function model_get_data_from_2_table_w_selection_and_condition($table, $table_to_join, $table_to_join_params, $condition, $join_option, $selection){
		$this->db->select($selection);
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a model function that will get data from 2 table with condition
	public function model_get_data_from_2_table_w_condition($table, $table_to_join, $table_to_join_params, $condition, $join_option){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a model function that will get data from 3 table with condition
	public function model_get_data_from_3_table_w_distinct_and_condition($distinct, $table, $table_to_join, $table_to_join2, $table_to_join_params,$table_to_join_params2, $condition, $join_option){
		$this->db->select($distinct);
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->join($table_to_join2,$table_to_join_params2,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a model function that will get data from 3 table with condition
	public function model_get_data_from_3_table_w_condition($table, $table_to_join, $table_to_join2, $table_to_join_params,$table_to_join_params2, $condition, $join_option){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->join($table_to_join2,$table_to_join_params2,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a model function that will get data from 4 table with condition
	public function model_get_data_from_4_table_w_condition($table, $table_to_join, $table_to_join2, $table_to_join3, $table_to_join_params,$table_to_join_params2,$table_to_join_params3, $condition, $join_option){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->join($table_to_join2,$table_to_join_params2,$join_option);
		$this->db->join($table_to_join3,$table_to_join_params3,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a model function that will get data from 6 table with condition
	public function model_get_data_from_6_table_w_condition($table, $table_to_join, $table_to_join2, $table_to_join3, $table_to_join4, $table_to_join5, $table_to_join_params,$table_to_join_params2,$table_to_join_params3,$table_to_join_params4,$table_to_join_params5, $condition, $join_option){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table_to_join,$table_to_join_params,$join_option);
		$this->db->join($table_to_join2,$table_to_join_params2,$join_option);
		$this->db->join($table_to_join3,$table_to_join_params3,$join_option);
		$this->db->join($table_to_join4,$table_to_join_params4,$join_option);
		$this->db->join($table_to_join5,$table_to_join_params5,$join_option);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	//create a function that will insert a data by batch
	function upload_student($table1, $table2, $table3, $data, $data2, $data3, $idToChange, $idToChange1){

		//create a clean array of the data
		$item = array();

		//create a variable that will holds the error
		$isInserted = false;

		for($i = 0 ; $i < count($data); $i++){

			//let's check the data using these query
			//if there is an existing data 
			$this->db->select("*");
			$this->db->from("userdetail");
			$this->db->where("LastName", $data[$i]["LastName"]);
			$this->db->where("FirstName", $data[$i]["FirstName"]);
			$this->db->where("MiddleInitial", $data[$i]["MiddleInitial"]);
			$this->db->where("Gender", $data[$i]["Gender"]);
			$result = $this->db->get();

			//if there is an existing data then we have to do nothing to avoid data redundancy
			if($result->num_rows() > 0){

				//do nothing here...
				$isInserted = false;

			}
			else{

				//insert the data
				$this->db->insert($table1, $data[$i]);

				//get the last inserted id
				$last_id = $this->db->insert_id();

				//assigned the last inserted id from table1
				$data2[$i][''.$idToChange.''] = $last_id;

				//assigned the last inserted id from table1
				$data3[$i][''.$idToChange1.''] = $last_id;

				//save data to database
				$this->db->insert($table2, $data2[$i]);

				//save data to database
				$this->db->insert($table3, $data3[$i]);

				//set the value into true
				$isInserted = true;
			}

		}

		//if the data were inserted
		if($isInserted){

			//return a message
			echo "Successfully uploaded!";

		}else{

			//return a message
			echo "There are some data from this file were already existed!";

		}

	}

	//create a function that will insert a data by batch
	function upload_exam($table, $data){

		//create a clean array of the data
		$item = array();

		//create a variable that will holds the error
		$isInserted = false;

		for($i = 0 ; $i < count($data); $i++){

			//let's check the data using these query
			//if there is an existing data 
			$this->db->select("*");
			$this->db->from("exam");
			$this->db->where("BookId", $data[$i]["BookId"]);
			$this->db->where("Question", $data[$i]["Question"]);
			$this->db->where("Option1", $data[$i]["Option1"]);
			$this->db->where("Option2", $data[$i]["Option2"]);
			$this->db->where("Option3", $data[$i]["Option3"]);
			$this->db->where("Option4", $data[$i]["Option4"]);
			$this->db->where("CorrectAnswer", $data[$i]["CorrectAnswer"]);
			$result = $this->db->get();

			//if there is an existing data then we have to do nothing to avoid data redundancy
			if($result->num_rows() > 0){

				//do nothing here...
				$isInserted = false;

			}
			else{

				//insert the data
				$this->db->insert($table, $data[$i]);

				//set the value into true
				$isInserted = true;
			}

		}

		//if the data were inserted
		if($isInserted){

			//return a message
			echo "Successfully uploaded!";

		}else{

			//return a message
			echo "Successfully uploaded! There are some data from this file were already existed!";

		}

	}

	//create a model function for getting the data from table with id
	public function model_get_data_with_id_result_only($table, $condition){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);

		//create a query and get the data
		$query = $this->db->get();

		//return the query result into array
		return $query->result();
	}
}
