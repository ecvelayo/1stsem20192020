<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cn extends CI_Controller {

	//function for the contructor
	public function __construct(){
		parent:: __construct();

		//let's load our database model
		$this->load->model("my_model", "md");
		$this->load->library("excel");
	}

	//------------------------------------- FUNCTIONS FOR REDIRECTION ----------------------------------//

	//function for displaying the login page
	public function index(){

		//get the current username of the user
		$username = $this->session->userdata("username");

		//get the current role of the user
		$role = $this->session->userdata("userrole");

		//check if the username is not null
		if($username != ""){

			//check if the current role is administrator
			if($role == "Administrator"){

				//then redirect to admin page
				redirect(base_url()."cn/admin");

			}else if($role == "Teacher"){

				//then redirect to teacher page
				redirect(base_url()."cn/teacher");

			}else if($role == "Student"){

				//then redirect to student page
				redirect(base_url()."cn/student");

			}
			

		}else{

			//then redirect to student page
			$this->load->view('index');

		}
	}

	//function for displaying the admin page
	public function admin(){

		//----------for testing case only-----------//
		//set $isTest value into "true" if we accidentally truncate our users
		//and removed our Super Administrator
		$isTest = false;

		//if test is false then do the restrictions
		if($isTest == false){

			//call the global function for the user redirections
			$this->user_redirector("main", "");

		}else{//if test is true then remove the restrictions

			//redirect the user to admin page
			$this->load->view('admin/admin');
		}

	}

	//function for displaying the teacher page
	public function teacher(){

		//call the global function for the user redirections
		$this->user_redirector("main", "");
	}

	//function for displaying the student page
	public function student(){

		//call the global function for the user redirections
		$this->user_redirector("main", "");
	}

	//function for displaying the student page
	public function travel(){

		//call the global function for the user redirections
		$this->user_redirector("travel", "");
	}

	//function for displaying the student page
	public function travels($travelCategoryId){

		//get the travel data and store it to a clean array
		$data['result'] = $this->md->model_get_data_with_id_result_only("travel", "TravelCategoryId=".$travelCategoryId);

		//call the global function for the user redirections
		$this->user_redirector("travel-list", $data);
	}

	//function for displaying the student page
	public function book(){

		//call the global function for the user redirections
		$this->user_redirector("book", "");
	}

	//function for displaying the student page
	public function books(){

		//call the global function for the user redirections
		$this->user_redirector("book-list", "");
	}

	//function for displaying the student page
	public function game(){

		//call the global function for the user redirections
		$this->user_redirector("game", "");
	}

	//function for displaying the student page
	public function games(){

		//call the global function for the user redirections
		$this->user_redirector("game-list", "");
	}

	//function for displaying the student page
	public function exam(){

		//call the global function for the user redirections
		$this->user_redirector("exam", "");
	}

	//function for displaying the student page
	public function student_preview(){

		//let us set first the usertesting data
		$usertesting = true;

		//set a variable to be sessioned
		$session_data = array(
			'usertesting' 	=> $usertesting
		);
		
		//do the sessioning of the user data
		$this->session->set_userdata($session_data);

		//call the global function for the user redirections
		$this->user_redirector("main", "");

	}

	//function for displaying the resetting the page
	public function reset_preview(){

		//let us set first the usertesting data
		$usertesting = false;

		//set a variable to be sessioned
		$session_data = array(
			'usertesting' 	=> $usertesting
		);

		//do the sessioning of the user data
		$this->session->set_userdata($session_data);

		//call the global function for the user redirections
		$this->user_redirector("main", "");
	}

	//create a global function that will redirect the user to its assigned page
	public function user_redirector($page, $data){

		//get the current username of the user
		$username = $this->session->userdata("username");

		//get the current role of the user
		$role = $this->session->userdata("userrole");

		//get the value for testing purpose
		$testing = $this->session->userdata("usertesting");

		//check if the username is null
		if($username == ""){

			//then redirect the user to the login page
			redirect(base_url());

		}else{

			//check if testing is true
			if($testing == true){

				//check if there is no data added
				if($data == ""){

					//then redirect the user to the its page
					$this->load->view('student/'.$page);

				}else{//if there is a data then add the data

					//then redirect the user to the its page with data
					$this->load->view('student/'.$page, $data);

				}

			}else{
				//check if the current role is administrator
				if($role == "Administrator"){

					// then redirect the user to the admin page
					$this->load->view('admin/admin');

				}else if($role == "Teacher"){

					// then redirect the user to the teacher page
					$this->load->view('teacher/teacher');

				}else if($role == "Student"){

					//check if there is no data added
					if($data == ""){

						//then redirect the user to the its page
						$this->load->view('student/'.$page);

					}else{//if there is a data then add the data

						//then redirect the user to the its page with data
						$this->load->view('student/'.$page, $data);

					}

				}
			}

		}
	}





	


	//-------------------------- FUNCTIONALITY FOR LOGIN AND LOGOUT ----------------------------//

	//function for login authentication
	public function login_authentication(){

		//get the username and password
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//get the result of the login validation
		$result = $this->md->model_check_username_password($username, $password);

		//call the model for login authentication and check if it's has a current user
		if($result == "true"){

			//call the model to get the user role of the user
			$get_user_role = $this->md->model_get_user_role($username);
			$user_role = $get_user_role[0]["UserRole"];
			$usertesting = false;

			//check if the user is currently deactivated
			$user_is_deactivated = $this->md->model_user_is_deactivated($username);

			if($user_is_deactivated == "true"){

				echo "Your account is currently deactivated! Please contact your IT Administrator!";

			} else{

				//set a variable to be sessioned
				$session_data = array(
					'username' 	=> $username,
					'userrole' 	=> $user_role,
					'usertesting' 	=> $usertesting
				);

				//do the sessioning of the user data
				$this->session->set_userdata($session_data);

				if($user_role == "Administrator"){
					echo "Admin";
				}
				else if($user_role == "Teacher"){
					echo "Teacher";
				}
				else if($user_role == "Student"){
					echo "Student";
				}
			}

			

		}
		else{ //if the username and password is incorrect

			//return the error message
			echo "Invalid Username or Password!";
		}
	}

	//create a function for logout and clear the session
	public function logout(){

		//clear all the session that we're made during login
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('userrole');

		//redirect the user to login page
		redirect(base_url());

	}








	//------------------------------------- FUNCTIONALITY FOR ADMIN AND TEACHER ----------------------------------//


	//------VIEW

	//function for displaying the data for user table
	public function display_admin_data(){
		$data = json_encode($this->md->model_get_data_from_2_table_w_condition("useraccount", "userdetail", "useraccount.UserDetailId = userdetail.UserDetailId", "useraccount.IsDeleted = 0 AND useraccount.UserRole ='Administrator' AND useraccount.UserAccountId > 1", "INNER"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for user table
	public function display_teacher_data(){
		$data = json_encode($this->md->model_get_data_from_2_table_w_condition("useraccount", "userdetail", "useraccount.UserDetailId = userdetail.UserDetailId", "useraccount.IsDeleted = 0 AND useraccount.UserRole ='Teacher'", "INNER"));

		//echo the result
		echo $data;
	}


	//------CREATE

	//function for inserting a data into user table
	public function create_new_user(){

		//declare inputs into array
		$data = array(
			"Firstname"			=>		$this->input->post("Firstname"),
			"Middleinitial"		=>		$this->input->post("Middleinitial"),
			"Lastname"			=>		$this->input->post("Lastname"),
			"DateOfBirth"		=>		$this->input->post("DateOfBirth"),
			"Age"				=>		$this->input->post("Age"),
			"Gender"			=>		$this->input->post("Gender"),
			"IsDeleted"			=>		$this->input->post("IsDeleted"),
		);

		//declare inputs into array
		$data2 = array(
			"Username"			=>		$this->input->post("Username"),
			"Password"			=>		md5(md5($this->input->post("Password"))),
			"IsActive"			=>		$this->input->post("IsActive"),
			"UserRole"			=>		$this->input->post("UserRole"),
			"IsDeleted"			=>		$this->input->post("IsDeleted"),
		);

		//call the model function for insertion
		$result = $this->md->model_insert_2_table_data_without_duplicated_data("userdetail", $data, "useraccount", $data2, "UserDetailId");

		//echo the result
		echo $result;
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_user(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsActive"		=> $this->input->post("IsActive"),
		);

		//call the model function for deactivating the useraccount table
		$result = $this->md->model_activate_deactivate_data("useraccount", $data, "UserAccountId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE GRADE LEVEL

	//function for updating the user table
	public function update_grade_level(){

		//declare the id
		$id = $this->input->post("UserAccountId");

		//declare the inputs into array
		$data = array(
			"GradeLevel"		=> $this->input->post("GradeLevel")
		);

		//call the model function for deactivating the useraccount table
		$result = $this->md->model_update_data("studentlist", $data, "UserAccountId=$id");

		//echo the result
		echo $result;
	}


	//------------------------------------- FUNCTIONALITY FOR STUDENT ----------------------------------//

	//------VIEW

	//function for displaying the data for user table
	public function display_student_data(){
		$data = json_encode($this->md->model_get_data_from_2_table_w_condition("useraccount", "userdetail", "useraccount.UserDetailId = userdetail.UserDetailId", "useraccount.IsDeleted = 0 AND useraccount.UserRole ='Student'", "INNER"));

		//echo the result
		echo $data;
	}

	//------CREATE

	//create a function that will upload the excel file for the list of students
	public function upload_student_file(){

		//check if the excel file were set
		if(isset($_FILES["excelfile"]["name"])){

			//get the path of the excel excelfile
			$path = $_FILES["excelfile"]["tmp_name"];

			//load the object data
			$object = PHPExcel_IOFactory::load($path);

			//loop the object data to assign it to another array
			foreach($object->getWorksheetIterator() as $worksheet){

				//get the highest row and column of the excel file
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				//loop the object with based on the highest row
				for($row = 2; $row <= $highestRow; $row++){

					//get the object value from the excel and assign it to other variable
					$id_number = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$lastname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$firstname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$middleinitial = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$gender = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$gradelevel = $this->input->post("gradelevel");

					//create a data that will holds the data for the first table
					$data[] = array(
						"LastName"		=> $lastname,
						"FirstName"		=> $firstname,
						"MiddleInitial"	=> $middleinitial,
						"Gender"		=> $gender,
					);

					//create a data that will holds the data for the second table
					$data2[] = array(
						"Username"		=> $id_number,
						"Password"		=> md5(md5($id_number)),
						"IsActive"		=> 1,
						"UserRole"		=> "Student",
					);

					//create a data that will holds the data for the second table
					$data3[] = array(
						"GradeLevel"	=> $gradelevel,
						"Status"		=> "UnAssigned"
					);
				}

			}

			//call the model function for uploading the students
			$result = $this->md->upload_student("userdetail", "useraccount","studentlist", $data, $data2, $data3, "UserDetailId", "UserAccountId");

			//return the result
			echo $result;

		}

	}







	//------------------------------------- FUNCTIONALITY FOR TRAVEL AND CATEGORY ----------------------------------//

	//------VIEW

	//function for displaying the data for travel category table
	public function display_travel_category_data(){
		$data = json_encode($this->md->model_get_data("travelcategory"));

		//echo the result
		echo $data;
	}


	//------CREATE

	//function for inserting a data into travel category table
	public function create_new_travel_category(){

		//check if the uploading of picture has been set
		if(isset($_FILES["TravelCategoryPictureFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/travel_category/";
			$config["allowed_types"] = "jpg|jpeg|png|gif";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('TravelCategoryPictureFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/travel_category/'.$data["file_name"];

				//declare inputs into array
				$data = array(
					"TravelCategoryName"			=>		$this->input->post("TravelCategoryName"),
					"TravelCategoryPictureFileName"	=>		$picture_file_name,
					"IsDeleted"						=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("travelcategory", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_travel_category(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the travelcategory table
		$result = $this->md->model_activate_deactivate_data("travelcategory", $data, "TravelCategoryId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_travel_category(){

		//declare the id
		$id = $this->input->post("TravelCategoryId");

		//declare the inputs into array
		$data = array(
			"TravelCategoryName"		=> $this->input->post("TravelCategoryName"),
		);

		//call the model function for deactivating the travelcategory table
		$result = $this->md->model_update_data("travelcategory", $data, "TravelCategoryId=$id");

		//echo the result
		echo $result;
	}








	//------------------------------------- FUNCTIONALITY FOR TRAVEL ----------------------------------//

	//------VIEW

	//function for displaying the data for travel table
	public function display_travel_data(){
		$data = json_encode($this->md->model_get_data("travel"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_travel_data_by_category_id($id){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data_with_id("travel", "TravelCategoryId=".$id));

		//echo the result
		echo $data;
	}

	//------CREATE AND UPLOAD PICTURE

	//create a function that will create and upload a picture
	public function create_new_travel(){

		//check if the uploading of picture has been set
		if(isset($_FILES["TravelPictureFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/travel/";
			$config["allowed_types"] = "jpg|jpeg|png|gif";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('TravelPictureFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/travel/'.$data["file_name"];

				//set a data to be inserted into our database
				$data = array(
					"TravelCategoryId"			=>		$this->input->post("TravelCategoryId"),
					"TravelName"				=>	$this->input->post("TravelName"),
					"TravelDescription"			=>	$this->input->post("TravelDescription"),
					"TravelPictureFileName"		=>	$picture_file_name,
					"IsDeleted"					=>	$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("travel", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_travel(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the travelcategory table
		$result = $this->md->model_activate_deactivate_data("travel", $data, "TravelId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_travel(){

		//declare the id
		$id = $this->input->post("TravelId");

		//declare the inputs into array
		$data = array(
			"TravelName"		=> $this->input->post("TravelName"),
			"TravelDescription"		=> $this->input->post("TravelDescription"),
		);

		//call the model function for deactivating the travel table
		$result = $this->md->model_update_data("travel", $data, "TravelId=$id");

		//echo the result
		echo $result;
	}









	//------------------------------------- FUNCTIONALITY FOR BOOK CATEGORY ----------------------------------//

	//------VIEW

	//function for displaying the data for book category table
	public function display_book_category_data(){
		$data = json_encode($this->md->model_get_data("bookcategory"));

		//echo the result
		echo $data;
	}


	//------CREATE

	//function for inserting a data into book category table
	public function create_new_book_category(){

		//check if the uploading of picture has been set
		if(isset($_FILES["BookCategoryPictureFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/book_category/";
			$config["allowed_types"] = "jpg|jpeg|png|gif";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('BookCategoryPictureFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/book_category/'.$data["file_name"];

				//declare inputs into array
				$data = array(
					"BookCategoryName"			=>		$this->input->post("BookCategoryName"),
					"BookCategoryPictureFileName"	=>		$picture_file_name,
					"IsDeleted"						=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("bookcategory", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_book_category(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the bookcategory table
		$result = $this->md->model_activate_deactivate_data("bookcategory", $data, "BookCategoryId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_book_category(){

		//declare the id
		$id = $this->input->post("BookCategoryId");

		//declare the inputs into array
		$data = array(
			"BookCategoryName"		=> $this->input->post("BookCategoryName"),
		);

		//call the model function for deactivating the bookcategory table
		$result = $this->md->model_update_data("bookcategory", $data, "BookCategoryId=$id");

		//echo the result
		echo $result;
	}







	//------------------------------------- FUNCTIONALITY FOR BOOK ----------------------------------//

	//------VIEW

	//function for displaying the data for book  table
	public function display_book_data(){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data("book"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_admin_book_data_by_category_id($id){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data_from_2_table_w_condition("book", "bookcategory", "book.BookCategoryId = bookcategory.BookCategoryId", "bookcategory.BookCategoryId=".$id, "INNER"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_book_data_by_category_id_for_books($id){

		//get the data and decode it into json format
		//CARLA 11-12-2019 I have added a filter that will only display books that are not deleted from the admin
		$data = json_encode($this->md->model_get_data_from_3_table_w_distinct_and_condition("bookcategory.BookCategoryId, bookcategory.BookCategoryName, bookcategory.BookCategoryPictureFileName, book.BookDescription, book.BookId, book.BookName, book.BookVideoFileName, book.IsDeleted, report.ReportId, report.TotalViews", "book", "bookcategory", "report", "book.BookCategoryId = bookcategory.BookCategoryId", "book.BookId = report.BookId", "book.IsDeleted = 0 AND bookcategory.BookCategoryId=".$id, "LEFT"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_book_data_by_category_id($id){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data_from_3_table_w_condition("book", "bookcategory", "report", "book.BookCategoryId = bookcategory.BookCategoryId", "book.BookId = report.BookId", "bookcategory.BookCategoryId=".$id, "LEFT"));

		//echo the result
		echo $data;
	}


	//------CREATE
	//function for inserting a data into report table
	public function insert_book_viewed(){

		//declare inputs into array
		$data = array(
			"BookId"		=>		$this->input->post("BookId"),
			"TotalViews"	=>		$this->input->post("TotalViews"),
			"IsDeleted"		=>		$this->input->post("IsDeleted"),
		);

		//call the model function for insertion
		$result = $this->md->model_insert_if_not_exists_or_update("report", $data);

		//echo the result
		echo $result;


	}



	//------CREATE

	//function for inserting a data into book  table
	public function create_new_book(){

		//check if the uploading of picture has been set
		if(isset($_FILES["BookVideoFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/book/";
			$config["allowed_types"] = "mp4|3gp|wmv|flv";
        	$config['max_size'] = 1000000; //1GB

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('BookVideoFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/book/'.$data["file_name"];

				//declare inputs into array
				$data = array(
					"BookCategoryId"		=>		$this->input->post("BookCategoryId"),
					"BookName"				=>		$this->input->post("BookName"),
					"BookDescription"		=>		$this->input->post("BookDescription"),
					"BookVideoFileName"		=>		$picture_file_name,
					"IsDeleted"				=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("book", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_book(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the book table
		$result = $this->md->model_activate_deactivate_data("book", $data, "BookId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_book(){

		//declare the id
		$id = $this->input->post("BookId");

		//declare the inputs into array
		$data = array(
			"BookName"				=> $this->input->post("BookName"),
			"BookDescription"		=> $this->input->post("BookDescription"),
		);

		//call the model function for deactivating the book table
		$result = $this->md->model_update_data("book", $data, "BookId=$id");

		//echo the result
		echo $result;
	}








	//------------------------------------- FUNCTIONALITY FOR GAME CATEGORY ----------------------------------//

	//------VIEW

	//function for displaying the data for game category table
	public function display_game_category_data(){
		$data = json_encode($this->md->model_get_data("gamecategory"));

		//echo the result
		echo $data;
	}


	//------CREATE

	//function for inserting a data into game category table
	public function create_new_game_category(){

		//check if the uploading of picture has been set
		if(isset($_FILES["GameCategoryPictureFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/game_category/";
			$config["allowed_types"] = "jpg|jpeg|png|gif";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('GameCategoryPictureFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/game_category/'.$data["file_name"];

				//declare inputs into array
				$data = array(
					"GameCategoryName"				=>		$this->input->post("GameCategoryName"),
					"GameCategoryPictureFileName"	=>		$picture_file_name,
					"IsDeleted"						=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("gamecategory", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_game_category(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the gamecategory table
		$result = $this->md->model_activate_deactivate_data("gamecategory", $data, "GameCategoryId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_game_category(){

		//declare the id
		$id = $this->input->post("GameCategoryId");

		//declare the inputs into array
		$data = array(
			"GameCategoryName"		=> $this->input->post("GameCategoryName"),
		);

		//call the model function for deactivating the gamecategory table
		$result = $this->md->model_update_data("gamecategory", $data, "GameCategoryId=$id");

		//echo the result
		echo $result;
	}









	//------------------------------------- FUNCTIONALITY FOR GAME ----------------------------------//

	//------VIEW

	//function for displaying the data for game table
	public function display_game_data(){
		$data = json_encode($this->md->model_get_data("game"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_game_data_by_category_id($id){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data_from_2_table_w_condition("game", "gamecategory", "game.GameCategoryId = gamecategory.GameCategoryId", "gamecategory.GameCategoryId=".$id, "INNER"));

		//echo the result
		echo $data;
	}


	//------CREATE

	//function for inserting a data into game table
	public function create_new_game(){

		//check if the uploading of picture has been set
		if(isset($_FILES["GamePictureFileName"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/game/";
			$config["allowed_types"] = "jpg|jpeg|png|gif";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('GamePictureFileName')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$picture_file_name = 'upload/game/'.$data["file_name"];

				//declare inputs into array
				$data = array(
					"GameCategoryId"				=>		$this->input->post("GameCategoryId"),
					"GameName"						=>		$this->input->post("GameName"),
					"GameLink"						=>		$this->input->post("GameLink"),
					"GamePictureFileName"			=>		$picture_file_name,
					"IsDeleted"						=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_insert_data("game", $data);

				//echo the result
				echo $result;

			}
		}
	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_game(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the game table
		$result = $this->md->model_activate_deactivate_data("game", $data, "GameId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE (EDIT)

	//function for updating the user table
	public function update_game(){

		//declare the id
		$id = $this->input->post("GameId");

		//declare the inputs into array
		$data = array(
			"GameName"		=> $this->input->post("GameName"),
			"GameLink"		=> $this->input->post("GameLink"),
		);

		//call the model function for deactivating the game table
		$result = $this->md->model_update_data("game", $data, "GameId=$id");

		//echo the result
		echo $result;
	}









	//------------------------------------- FUNCTIONALITY FOR EXAM ----------------------------------//

	//------VIEW

	//function for displaying the data for user table
	public function display_exam_data(){
		$data = json_encode($this->md->model_get_data_from_2_table_w_selection_and_condition("exam", "book", "exam.BookId = book.BookId", "exam.BookId = book.BookId", "RIGHT", "Book.BookName, Book.BookCategoryId, Book.BookDescription, Book.BookId, Book.BookVideoFileName, Exam.CorrectAnswer, Exam.ExamFileName, Exam.ExamId, Exam.IsDeleted, Exam.IsFileExam, Exam.Option1, Exam.Option2, Exam.Option3, Exam.Option4, Exam.Question"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for book category table
	public function display_exam_data_by_book_id($id){

		//get the data and decode it into json format
		$data = json_encode($this->md->model_get_data_with_id("exam", "exam.BookId=".$id));

		//echo the result
		echo $data;
	}

	//------CREATE

	//function for displaying the data for book category table
	public function create_exam_result(){

		$data = array(
			"StudentId"			=>		$this->input->post("StudentId"),
			"ExamId"			=>		$this->input->post("ExamId"),
			"BookId"			=>		$this->input->post("BookId"),
			"TeacherId"			=>		$this->input->post("TeacherId"),
			"GradeLevel"		=>		$this->input->post("GradeLevel"),
			"SchoolYear"		=>		$this->input->post("SchoolYear"),
			"TotalScore"		=>		$this->input->post("TotalScore"),
			"PerfectScore"		=>		$this->input->post("PerfectScore"),
			"Date"				=>		$this->input->post("Date"),
			"IsDeleted"			=>		$this->input->post("IsDeleted"),
		);

		//call the model function for inserting exam result
		$result = $this->md->model_insert_without_duplicated_data("examresult", $data);

		//return the result
		echo $result;


	}

	//------CREATE

	//create a function that will upload the excel file for the list of students
	public function upload_exam_file(){

		//check if the excel file were set
		if(isset($_FILES["excelfileexam"]["name"])){

			//get the path of the excel excelfile
			$path = $_FILES["excelfileexam"]["tmp_name"];

			//get the id of the book
			$book_id = $_POST["bookid"];

			//load the object data
			$object = PHPExcel_IOFactory::load($path);

			//loop the object data to assign it to another array
			foreach($object->getWorksheetIterator() as $worksheet){

				//get the highest row and column of the excel file
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				//loop the object with based on the highest row
				for($row = 2; $row <= $highestRow; $row++){

					//get the object value from the excel and assign it to other variable
					$question = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$option1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$option2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$option3 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$option4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$correctanswer = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

					//create a data that will holds the data for the first table
					$data[] = array(
						"BookId"			=> $book_id,
						"Question"			=> $question,
						"Option1"			=> $option1,
						"Option2"			=> $option2,
						"Option3"			=> $option3,
						"Option4"			=> $option4,
						"CorrectAnswer"		=> $correctanswer,
						"IsFileExam"		=> 0,
						"ExamFileName"		=> "",
						"IsDeleted"			=> 0,
					);
				}

			}

			// var_dump($data);

			//call the model function for uploading the students
			$result = $this->md->upload_exam("exam", $data);

			//return the result
			echo $result;

		}

	}

	//------UPDATE (ACTIVATION AND DEACTIVATION)

	//function for updating the user table
	public function activate_deactivate_exam(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//call the model function for deactivating the gamecategory table
		$result = $this->md->model_activate_deactivate_data("exam", $data, "ExamId=$id");

		//echo the result
		echo $result;
	}

	//------UPDATE

	//create a function that will upload the excel file for the list of students
	public function update_exam_file(){

		//check if the uploading of picture has been set
		if(isset($_FILES["excelfileforexam"]["name"])){

			//declare our configurations
			$config["upload_path"] = "./upload/exam_visual_audio/";
			$config["allowed_types"] = "mp4|3gp|wmv|flv|mp3";

			//update the configurations into our system
			$this->load->library('upload', $config);

			//if there is an error while uploading the file, then display an error message
			if(!$this->upload->do_upload('excelfileforexam')){

				//display the error message
				echo $this->upload->display_errors();
			}
			else{

				//upload the file into our upload folder
				$data = $this->upload->data();

				//store the file name that were added into our upload folder
				$file_name = 'upload/exam_visual_audio/'.$data["file_name"];

				//declare the exam id
				$exam_id = $this->input->post("id");

				//declare inputs into array
				$data = array(
					"Question"						=>		$this->input->post("Question"),
					"Option1"						=>		$this->input->post("Option1"),
					"Option2"						=>		$this->input->post("Option2"),
					"Option3"						=>		$this->input->post("Option3"),
					"Option4"						=>		$this->input->post("Option4"),
					"CorrectAnswer"					=>		$this->input->post("CorrectAnswer"),
					"IsFileExam"					=>		1,
					"ExamFileName"					=>		$file_name,
					"IsDeleted"						=>		$this->input->post("IsDeleted"),
				);

				//call the model function for insertion
				$result = $this->md->model_update_data("exam", $data, "ExamId=".$exam_id);

				if($result == "Updated"){

					//echo the result
					echo "Successfully Updated!";
				}

			}
		}else{

			//declare the exam id
			$exam_id = $this->input->post("id");

			//declare inputs into array
			$data = array(
				"Question"						=>		$this->input->post("Question"),
				"Option1"						=>		$this->input->post("Option1"),
				"Option2"						=>		$this->input->post("Option2"),
				"Option3"						=>		$this->input->post("Option3"),
				"Option4"						=>		$this->input->post("Option4"),
				"CorrectAnswer"					=>		$this->input->post("CorrectAnswer"),
				"IsFileExam"					=>		0,
				"ExamFileName"					=>		"",
				"IsDeleted"						=>		$this->input->post("IsDeleted"),
			);

			//call the model function for insertion
			$result = $this->md->model_update_data("exam", $data, "ExamId=".$exam_id);

			if($result == "Updated"){

				//echo the result
				echo "Successfully Updated!";
			}
		}

	}










	//------------------------------------- FUNCTIONALITY FOR TEACHER PAGE ----------------------------------//


	//------VIEW

	//function for displaying the data for user table
	public function display_class_student_data(){
		$data = json_encode($this->md->model_get_data_from_4_table_w_condition("teacherclass","studentlist","useraccount", "userdetail", "teacherclass.StudentListId = StudentList.StudentListId", "studentlist.UserAccountId = useraccount.UserAccountId", "useraccount.UserDetailId = userdetail.UserDetailId", "teacherclass.IsDeleted = 0", "INNER"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for user table
	public function display_studentlist_data(){
		$data = json_encode($this->md->model_get_data_from_3_table_w_condition("studentlist","useraccount", "userdetail", "studentlist.UserAccountId = useraccount.UserAccountId", "useraccount.UserDetailId = userdetail.UserDetailId", "studentlist.IsDeleted = '0'", "INNER"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for user table
	public function get_student_record(){

		//get the current id
		$studentid = $this->input->get("id");

		$data = json_encode($this->md->model_get_data_from_4_table_w_condition("examresult","useraccount", "userdetail", "book", "examresult.StudentId = useraccount.UserAccountId", "useraccount.UserDetailId = userdetail.UserDetailId", "examresult.BookId = book.BookId", "examresult.StudentId=".$studentid, "INNER"));

		//echo the result
		echo $data;
	}

	//------VIEW

	//function for displaying the data for user table
	public function get_all_record(){

		$data = json_encode($this->md->model_get_data_from_6_table_w_condition("examresult", "useraccount", "userdetail", "book", "studentlist", "teacherclass", "examresult.StudentId = useraccount.UserAccountId", "useraccount.UserDetailId = userdetail.UserDetailId", "examresult.BookId = book.BookId", "useraccount.UserAccountId = studentlist.UserAccountId", "teacherclass.StudentListId = studentlist.StudentListId", "examresult.IsDeleted = 0", "INNER"));

		//echo the result
		echo $data;
	}

	//------CREATE

	//function for updating the user table
	public function create_teacher_class(){

		//declare the id
		$id = $this->input->post("id");

		//declare the inputs into array
		$data = array(
			"StudentListId"		=> $this->input->post("StudentListId"),
			"TeacherId"			=> $this->input->post("TeacherId"),
			"SchoolYear"		=> $this->input->post("SchoolYear"),
		);

		//call the model function for deactivating the game table
		$result = $this->md->model_insert_without_duplicated_data_teacher_class("teacherclass", $data);

		//echo the result
		echo $result;
	}

	//------UPDATE

	//function for updating the user table
	public function update_student_list(){

		//declare the id
		$id = $this->input->post("StudentListId");

		//declare the inputs into array
		$data = array(
			"Status"		=> $this->input->post("Status"),
		);

		//call the model function for deactivating the game table
		$result = $this->md->model_update_data("studentlist", $data, "StudentListId=".$id);

		//echo the result
		echo $result;
	}

	//------UPDATE

	//LLOYD 11-12-2019 create another function that will remove the student from the list
	public function remove_student_from_list(){

		//declare the id for teacher class and student list
		$TeacherClassId = $this->input->post("TeacherClassId");
		$StudentListId = $this->input->post("StudentListId");

		//declare the inputs into array
		$data = array(
			"IsDeleted"		=> $this->input->post("IsDeleted"),
		);

		//declare the inputs into array
		$data2 = array(
			"Status"		=> $this->input->post("Status"),
		);

		//call the model function for deactivating the game table
		$teacherClassResult = $this->md->model_update_data("teacherclass", $data, "TeacherClassId=".$TeacherClassId);

		//check if the teacher class were updated
		if($teacherClassResult == "Updated"){

			//then execute the second query for setting the student from student list as unassigned
			$studentListResult = $this->md->model_update_data("studentlist", $data2, "StudentListId=".$StudentListId);

			//echo the result
			echo $studentListResult;

		}
	}





















	//----------------------------GLOBAL FUNCTIONS------------------------------------//


	//create a global function that will get the id of the current loggged in user
	public function globalGetUserId(){

		//get the username
		$username = $this->input->post("Username");

		//call the model function for deactivating the game table
		$result = $this->md->model_get_userid_by_username("useraccount", $username);

		//echo the user account id
		echo $result[0]["UserAccountId"];

	}

	//create a global function that will get the id of the current loggged in user
	public function globalGetTeacherId(){

		//get the username
		$userid = $this->input->post("UserId");

		//call the model function for deactivating the game table
		$result = $this->md->model_get_teacherid_by_userid($userid);

		//echo the user account id
		echo $result[0]["TeacherId"];

	}

	//create a global function that will get the id of the current loggged in user
	public function globalGetGradeLevel(){

		//get the username
		$userid = $this->input->post("UserId");

		//call the model function for deactivating the game table
		$result = $this->md->model_get_gradelevel_by_userid($userid);

		//echo the user account id
		echo $result[0]["GradeLevel"];

	}


}
