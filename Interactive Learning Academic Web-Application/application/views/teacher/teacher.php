<!-- include header -->
<?php $this->load->view("inc/header"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-teacher"); ?>


	<div class="container">
		
		<div id="card-class" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
			<!-- manage class content -->
        	<div class="margin_all_10px">

		        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

	        		<ul uk-tab>
					    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>My Class</a></li>
					    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>Student List</a></li>
					    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: database"></span>Archive</a></li>
					</ul>

					<ul class="uk-switcher uk-margin">

						<!-- content for manage administrator -->
					    <li>
		        			<button style="margin-left: 82%;" class="uk-button uk-button-primary" id="btnPrintClassReport"><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Print Class Report</button>
					    	
					    	<h3 class="font_white">Manage Class</h3>

					    	<!-- search -->
					    	<div class="uk-grid-collapse" uk-grid>
								<div class="uk-form-controls uk-width-1-2">
									<label class="uk-form-label font_white txt_class_student_search" for="txt_class_student_search">Search:</label>
								    <input class="uk-input uk-input txt_class_student_search" id="txt_class_student_search" type="text">
								</div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Search" id="btn_class_student_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
						        </div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Refresh" id="btn_class_student_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
						        </div>
					    	</div>


							<br>
							<br>
							<div id="tbl_manage_class"></div>
					    </li>

						<!-- content for manage teacher -->
					    <li>
					    	<h3 class="font_white">View All Student</h3>

					    	<!-- search -->
					    	<div class="uk-grid-collapse" uk-grid>
								<div class="uk-form-controls  uk-width-1-2">
									<label class="uk-form-label font_white" for="txt_student_list_search">Search:</label>
								    <input class="uk-input uk-input" id="txt_student_list_search" type="text">
								</div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Search" id="btn_student_list_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
						        </div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Refresh" id="btn_student_list_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
						        </div>
					    	</div>

							<br>
							<br>
							<div id="tbl_manage_student_list"></div>
					    </li>

						<!-- content for manage administrator -->
					    <li>
					    	
					    	<h3 class="font_white">Archive Class</h3>

					    	<!-- search -->
					    	<div class="uk-grid-collapse" uk-grid>
								<div class="uk-form-controls uk-width-1-2">
									<label class="uk-form-label font_white txt_archive_class_student_search" for="txt_archive_class_student_search">Search:</label>
								    <input class="uk-input uk-input txt_archive_class_student_search" id="txt_archive_class_student_search" type="text">
								</div>&nbsp;&nbsp;
								<div class="uk-form-controls uk-width-1-4">
									<label class="uk-form-label font_white cmb_archive_class_school_year" for="cmb_archive_class_school_year">School Year:</label>
								    <select class="uk-select" id="cmb_archive_class_school_year"></select>
								</div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Search" id="btn_archive_class_student_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
						        </div>
						        <div class="uk-form-controls uk-width-auto">
						        	&nbsp;
						        	<button uk-tooltip="Refresh" id="btn_archive_class_student_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
						        </div>
					    	</div>


							<br>
							<br>
							<div id="tbl_manage_archive_class"></div>
					    </li>
					</ul>
		        </div>
		    </div>
		</div>
		
		<div id="card-record" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
			<!-- manage users content -->
        	<div class="margin_all_10px">

		        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

	        		<ul uk-tab>
					    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: file-text"></span>Records</a></li>
					</ul>

					<ul class="uk-switcher uk-margin">

						<!-- content for manage administrator -->
					    <li>
		        			<button style="margin-left: 82%;" class="uk-button uk-button-primary" id="btnPrintStudentReport"><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Print Class Report</button>
					    	<h3 class="font_white">Manage Records</h3>

					    	<br>

					    	<div class="uk-child-width-expand@s uk-text-center" uk-grid>
					    		<div>
				       				<label class="uk-form-label font_white cmb-record-book-category-filter" for="cmb-record-book-category-filter">Filter by book: </label>
						    		<select class="uk-select cmb-record-book-category-filter" id="cmb-record-book-category-filter"></select>
					    		</div>
					    		<div>
				       				<label class="uk-form-label font_white cmb-record-book-filter" for="cmb-record-book-filter">Filter by book: </label>
						    		<select class="uk-select cmb-record-book-filter" id="cmb-record-book-filter"></select>
					    		</div>
					    		<div>
				       				<label class="uk-form-label font_white txt-record-date-filter" for="txt-record-date-filter">Filter by Date: </label>
				       				<input class="uk-input uk-input txt-record-date-filter" type="date" id="txt-record-date-filter">
					    		</div>
					    		<div>
				       				<button style="margin-top: 24px;" class="uk-button uk-button-primary btnFilterReport" id="btnFilterReport"><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Filter Report</button>
					    		</div>
					    	</div>
			        		
			        		<!-- <table class="uk-table uk-table-striped data-table"> -->
			        		<table class="uk-table uk-table-striped">
							    <thead>
							        <tr>
							            <td class="font_white">Id Number</td>
							            <td class="font_white">Student Name</td>
							            <td class="font_white">Book Name</td>
							            <td class="font_white">Score / Perfect Score</td>
							            <td class="font_white">Date Taken</td>
							        </tr>
							    </thead>
							    <tbody id="tbl_manage_record"></tbody>
							</table>
					    </li>
					</ul>
		        </div>
		    </div>
		</div>

	</div>

	<!-- modal for alerts -->
	<div id="alert-modal" class="uk-flex-top" uk-modal>
	    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

	        <button class="uk-modal-close-default" type="button" uk-close></button>

	        <p id="alert-custom-content"></p>

	    </div>
	</div>

	<!-- modal for spinner -->
	<div id="modal-spinner" class="uk-flex-top" uk-modal>
	    <div class="uk-modal-dialog uk-modal-body uk-width-1-6 uk-margin-auto-vertical uk-text-center">

	    	<span class="uk-margin-small-right" uk-spinner="ratio: 3"></span>
	    	<h4>Please wait</h4>

	    </div>
	</div>

	<!-- modal for student record -->
	<div id="modal-student-record" class="uk-flex-top" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-1 uk-modal-body uk-margin-auto-vertical uk-text-center">

	    	<div class="uk-grid-column-small uk-grid-row-small uk-child-width-1-2@s uk-text-center" uk-grid>
			    <div>
			        <div class="uk-card uk-card-default uk-card-hover uk-card-body">
			            <h2 class="uk-heading-small">Student Details</h2>

				    	<div class="uk-grid-column-small uk-grid-row-small uk-child-width-1-2@s uk-text-center" uk-grid>
					        <div>
					        	<h4>Student ID:</h4>
					        	<h4>Last Name:</h4>
					        	<h4>First Name:</h4>
					        	<h4>Middle Initial:</h4>
					        	<h4>Gender:</h4>
					        	<h4>Grade Level:</h4>
					        </div>
					        <div>
					        	<h4 id="lbl-student-id">(Student ID)</h4>
					        	<h4 id="lbl-lastname">(Last Name)</h4>
					        	<h4 id="lbl-firstname">(First Name)</h4>
					        	<h4 id="lbl-mi">(Middle Initial)</h4>
					        	<h4 id="lbl-gender">(Gender)</h4>
					        	<h4 id="lbl-gradelevel">(Grade Level)</h4>
				        	</div>
				        </div>
			        </div>
			    </div>
			    <div>
			        <div class="uk-card uk-card-default uk-card-hover uk-card-body">
			            <h2 class="uk-heading-small">Student Record</h2>

				    	<div class="uk-grid-column-small uk-grid-row-small uk-child-width-1-1@s uk-text-center" uk-grid>
				    		<div>
				    			<table class="uk-table uk-table-hover uk-table-divider">
								    <thead>
								        <tr>
								            <td>Book Name</td>
								            <td>Score / Perfect Score</td>
								            <td>Date Taken</td>
								        </tr>
								    </thead>
								    <tbody id="tbl_student_record"></tbody>
								</table>
				    		</div>
				        </div>
			        </div>
			    </div>


			</div>

	    </div>
	</div>




<!-- include footer -->
<?php $this->load->view("inc/footer"); ?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//---------------------------------------------------EVENTS--------------------------------------------//

		//display spinner modal
		globalDisplaySpinnerModal(1000);

		//DT 2019-11-19 let us set a timeout for 0.5 seconds that will execute to display the class students
		setTimeout(function(){

			//call the function for displaying the class students
			displayClassStudents();

			//call the function for displaying the class students
			displayArchiveClassStudents();

		}, 500);

		//call the function for displaying the students
		displayStudents();

		//call the function for displaying the records
		displayRecords("");

		//call the function for populating the dropdown for book category
		displayDropdownExamBookCategory();

		//call the function for populating the dropdown for school year
		displayDropdownSchoolYear();

		//call the function for setting the userid of the current user logged in
		globalSetUserId();

		//set default value to filter by date
		document.getElementById('txt-record-date-filter').valueAsDate = new Date();

		//when the button btn_view_record is clicked
		$(document).on('click', '.btn_view_record', function(){

			//get the current id of the student
			var studentId = $(this).attr("data-id");
			var gradelevel = $(this).attr("data-gradelevel");

			//declare a parameter
			var params = {};

			//set parameter
			params.id = studentId;

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/get_student_record'); ?>",
				data: params,
				success: function(item){

					item = JSON.parse(item);

					// console.log("printing item");
					// console.log(item);

					//check if the item is not null
					if(item.length > 0){

						var studentid = item[0].StudentId;
						var lastname = item[0].Lastname;
						var firstname = item[0].Firstname;
						var mi = item[0].Middleinitial;
						var gender = item[0].Gender;

						var output = '';

						for(var i = 0 ; i < item.length; i++){

							//set the output for our table
							output += '<tr>'+
										'<td>'+item[i].BookName+'</td>'+
										'<td>'+item[i].TotalScore+' / '+item[i].PerfectScore+'</td>'+
										'<td>'+item[i].Date+'</td>'+
									'</tr>';

						}


						//show the modal for student record
						UIkit.modal("#modal-student-record").show();


						//set the value into our student record modal
						$("#lbl-student-id").html(studentId);
						$("#lbl-lastname").html(lastname);
						$("#lbl-firstname").html(firstname);
						$("#lbl-mi").html(mi);
						$("#lbl-gender").html(gender);
						$("#lbl-gradelevel").html(gradelevel);
						$("#tbl_student_record").html(output);
					}else{

						UIkit.modal.alert("No records found!");

					}

				}
			});


		});

		//when the button btn_add_to_class is clicked
		$(document).on('click', '.btn_add_to_class', function(){

			//get the current id of this row
			var currentId = $(this).attr("data-id");

			//create a parameter
			var params = {};

			//set the parameter
			params.StudentListId = currentId;
			params.TeacherId = localStorage["uid"];
			params.SchoolYear = moment().format("L").split("/")[2];

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/create_teacher_class'); ?>",
				data: params,
				success: function(item){

					// console.log("printing item");
					// console.log(item);

					//if inserted
					if(item == "Inserted"){

						//create another parameter for the second ajax call
						var params2 = {};

						//set the parameter
						params.StudentListId = currentId;
						params.Status = "Assigned";

						$.ajax({
							type: "POST",
							url: "<?php echo base_url('cn/update_student_list'); ?>",
							data: params,
							success: function(item){

								// console.log("printing item");
								// console.log(item);

								//call the function for displaying the success information
								globalDisplayAlert("Successfully Inserted!");

								//reset the table
								resetClassStudentTable();

								//reset the table
								resetStudentListTable();

							}
						});
					}else if(item == "Duplicated"){

						//call the function for displaying the success information
						globalDisplayAlert("This student were already enrolled in your class!");
					}

				}
			});

		});


		//when the dropdown for book category is changed
		$("#cmb-record-book-category-filter").change(function(){

			//get the id for the book category
			var book_category_id = $(this).val();

			//call the function that will display the data for book
			displayDropdownExamBooks(book_category_id);

		});

		
		// //when the dropdown for book category is changed
		// $("#cmb-record-book-filter").change(function(){

		// 	//get the id for the book category
		// 	var bookId = $(this).val();

		// 	//call the function to reset the table first
		// 	resetRecordTable();

		// 	//call the function for display the data into the table
		// 	displayRecords(bookId);

		// });
		
		//when the button for btnFilterReport is clicked
		$("#btnFilterReport").click(function(){

			//get the id for the book
			var bookId = $("#cmb-record-book-filter option:selected").val();

			//get the value for the date
			var dateValue = $("#txt-record-date-filter").val();

			//check if the bookid is undefined
			if(bookId == undefined){

				UIkit.modal.alert('Please select a book!');

			}else if(dateValue == ""){

				UIkit.modal.alert('Please select a date!');
			} else{

				//call the function to reset the table first
				resetRecordTable();

				//call the function for display the data into the table
				displayRecords(bookId, moment(dateValue).format("L"));
			}


		});

		
		//when button for btnPrintClassReport is clicked
		$("#btnPrintClassReport").click(function(){

			//call the function for printing the div
			printOnlySpecifiedDiv("card-class", "btnPrintClassReport", "", "", "", "", "txt_class_student_search");

		});

		
		//when button for btnPrintStudentReport is clicked
		$("#btnPrintStudentReport").click(function(){

			//call the function for printing the div
			printOnlySpecifiedDiv("card-record", "btnPrintStudentReport", "cmb-record-book-category-filter", "cmb-record-book-filter", "txt-record-date-filter", "btnFilterReport", "");

		});

		//when the text btn_class_student_search is clicked
		$("#btn_class_student_search").click(function(){

			//get the current value
			var search_value = $("#txt_class_student_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayClassStudents();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_class").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.Username.toLowerCase().includes(search_value.toLowerCase()) || i.Lastname.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_class", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_class_student_refresh").click(function(){

			$("#txt_class_student_search").val('');

			//display all the data for admin
			displayClassStudents();

		});

		//when the text btn_student_list_search is clicked
		$("#btn_student_list_search").click(function(){

			//get the current value
			var search_value = $("#txt_student_list_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayStudents();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_student_list").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.Username.toLowerCase().includes(search_value.toLowerCase()) || i.Lastname.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_student_list", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_student_list_refresh").click(function(){

			$("#txt_student_list_search").val('');

			//display all the data for admin
			displayStudents();

		});


		//LLOYD 11-12-2019 added another function if the button named btn_remove_from_class is clicked then removed it from the class
		$(document).on('click', '.btn_remove_from_class', function(){

			//get the current id of the student
			var TeacherClassId = $(this).attr("data-teacherclassid");
			var StudentListId = $(this).attr("data-studentlistid");

			//declare parameter
			var params = {};

			//set parameter
			params.StudentListId = StudentListId;
			params.TeacherClassId = TeacherClassId;
			params.IsDeleted = 1;
			params.Status = "UnAssigned";

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/remove_student_from_list'); ?>",
				data: params,
				success: function(item){

					// console.log("printing item");
					// console.log(item);

					//if inserted
					if(item == "Updated"){

						//call the function for displaying the success information
						globalDisplayAlert("Successfully Removed!");

						//reset the table
						resetClassStudentTable();

						//reset the table
						resetStudentListTable();
					}

				}
			});

		});

		//when the text btn_class_student_search is clicked
		$("#btn_archive_class_student_search").click(function(){

			//get the current value
			var search_value = $("#txt_archive_class_student_search").val();
			var school_year = $("#cmb_archive_class_school_year").val();

			//get the current data from the grid
			var grid_data = $("#tbl_manage_archive_class").jsGrid("option", "data");

			// console.log("printing grid_data");
			// console.log(grid_data);

			//then filter the data
			var filtered_data = _.filter(grid_data, function(i){
				return i.Username.toLowerCase().includes(search_value.toLowerCase()) || i.Lastname.toLowerCase().includes(search_value.toLowerCase());
			});

			//check if the teacher selected a school year
			if(school_year != 0){
				filtered_data = _.where(filtered_data, { SchoolYear: school_year });
			}


			//call the function for filtering the grid
			resetGridAndFilterData("tbl_manage_archive_class", filtered_data);

		});

		//when button refresh is clicked
		$("#btn_archive_class_student_refresh").click(function(){

			$("#txt_archive_class_student_search").val('');

			//display all the data for admin
			displayArchiveClassStudents();

		});


		//-------------------------------------------------FUNCTIONS--------------------------------------//

		//populate the data
		function displayClassStudents(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_class_student_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					item = _.sortBy(item, "Lastname");

					//do the filtering for the data that should only display a student for that assigned teacher
					item = _.where(item, { TeacherId: localStorage["uid"] });

					//get the current school year
					var current_school_year = moment().format("L").split("/")[2];

					//testing purpose
					// var current_school_year = 2020;

					//do the filter where only student at the current school year will be displayed
					item = _.where(item, { SchoolYear: current_school_year });

					// console.log("printing item");
					// console.log(item);

					//call the function for displaying the class student grid
					displayClassStudentsTable(item, "class");
				}
			});
		}

		//populate the data
		function displayStudents(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_studentlist_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					item = _.sortBy(item, "Lastname");

					// console.log("printing item");
					// console.log(item);

					//call the function for displaying the student list grid
					displayStudentListTable(item, "");
				}
			});
		}

		//populate the data
		function displayArchiveClassStudents(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_class_student_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					item = _.sortBy(item, "Lastname");

					//do the filtering for the data that should only display a student for that assigned teacher
					item = _.where(item, { TeacherId: localStorage["uid"] });

					// console.log("printing item");
					// console.log(item);

					//call the function for displaying the class student grid
					displayArchiveClassStudentsTable(item, "class");
				}
			});
		}

		//create a function that will display grid table for students
		function displayClassStudentsTable(data, type){

			//declare the grid
			$("#tbl_manage_class").jsGrid({

				//set width and height of the grid
		        width: "100%",
		        height: "auto",

		        //set the sorting configurations
		        sorting: true,
		        paging: true,

		        pageSize: 11,

		        //set the data
		        data: data,

		        //set the fields of the table
		        fields: [
		            {
		                name: "Username",
		                title: "Username",
		                type: "text",
		            },
		            {
		                name: "Lastname",
		                title: "Lastname",
		                type: "text",
		                itemTemplate: function (value, item) {

							var output = item.Lastname + ', ' + item.Firstname + ' ' + item.Middleinitial;

		                    
		                    //return the output
		                    return output;

		                }
		            },
		            {
		                name: "GradeLevel",
		                title: "GradeLevel",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="View Record" class="uk-icon uk-margin-small-right btn_view_record" data-id="'+item.UserAccountId+'" data-gradelevel="'+item.GradeLevel+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: file-text"></span></button>';

							output += '<button uk-tooltip="Remove from Class" class="uk-icon uk-margin-small-right btn_remove_from_class" data-studentListId="'+item.StudentListId+'" data-teacherClassId="'+item.TeacherClassId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: trash"></span></button>';

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}

		//create a function that will display grid table for students
		function displayStudentListTable(data, type){

			//declare the grid
			$("#tbl_manage_student_list").jsGrid({

				//set width and height of the grid
		        width: "100%",
		        height: "auto",

		        //set the sorting configurations
		        sorting: true,
		        paging: true,

		        pageSize: 11,

		        //set the data
		        data: data,

		        //set the fields of the table
		        fields: [
		            {
		                name: "Username",
		                title: "Username",
		                type: "text",
		            },
		            {
		                name: "Lastname",
		                title: "Lastname",
		                type: "text",
		                itemTemplate: function (value, item) {

							var output = item.Lastname + ', ' + item.Firstname + ' ' + item.Middleinitial;

		                    
		                    //return the output
		                    return output;

		                }
		            },
		            {
		                name: "GradeLevel",
		                title: "GradeLevel",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Add to my class" class="uk-icon uk-margin-small-right btn_add_to_class" data-id="'+item.StudentListId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span></button>';

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}

		//create a function that will display grid table for students
		function displayArchiveClassStudentsTable(data, type){

			//declare the grid
			$("#tbl_manage_archive_class").jsGrid({

				//set width and height of the grid
		        width: "100%",
		        height: "auto",

		        //set the sorting configurations
		        sorting: true,
		        paging: true,

		        pageSize: 11,

		        //set the data
		        data: data,

		        //set the fields of the table
		        fields: [
		            {
		                name: "Username",
		                title: "Username",
		                type: "text",
		            },
		            {
		                name: "Lastname",
		                title: "Lastname",
		                type: "text",
		                itemTemplate: function (value, item) {

							var output = item.Lastname + ', ' + item.Firstname + ' ' + item.Middleinitial;

		                    
		                    //return the output
		                    return output;

		                }
		            },
		            {
		                name: "GradeLevel",
		                title: "GradeLevel",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="View Record" class="uk-icon uk-margin-small-right btn_view_record" data-id="'+item.UserAccountId+'" data-gradelevel="'+item.GradeLevel+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: file-text"></span></button>';

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}

		//create a function that will filter the data on the grid
		function resetGridAndFilterData(tablename, data) {
		    //clear grid
		    $("#" + tablename).jsGrid("option", "data", []);

		    //refresh the grid with original list
		    $("#" + tablename).jsGrid("option", "data", data);
		}

		//populate the data
		function displayRecords(bookNameFilter, dateFilter){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/get_all_record'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					// console.log("printing item");
					// console.log(item);

					item = _.sortBy(item, "Lastname");

					//filter the data where it should only display a student that are assigned to the signed in teacher
					item = _.where(item, { TeacherId : localStorage["uid"] });

					//check if there is a filter then display the default
					if(bookNameFilter != "" && dateFilter != ""){
						item = _.filter(item, function(i){
							return i.BookId == bookNameFilter && i.Date == dateFilter && i.TeacherId == localStorage["uid"];
						});
					}

					// console.log("printing item");
					// console.log(item);

					var table_output = '';

					//check if there is 1 or more data in the item
					if(item.length > 0){
						//loop the data and assign it to data table
						for(var i = 0 ; i < item.length; i++){

							// console.log("printing item");
							// console.log(item);

							//set the output for our table
							table_output += '<tr class="font_white">'+
												'<td>'+item[i].Username+'</td>'+
												'<td>'+item[i].Lastname+', '+item[i].Firstname+' '+item[i].Middleinitial+'</td>'+
												'<td>'+item[i].BookName + '</td>'+
												'<td>'+item[i].TotalScore+' / '+ item[i].PerfectScore + '</td>'+
												'<td>'+item[i].Date + '</td>'+
											'</tr>';
						}
					}else{

						//set the output for our table
						table_output += '<tr class="font_white">'+
											'<td colspan="5">No records found!</td>'+
										'</tr>';
					}

					//append the output to our table
					$("#tbl_manage_record").append(table_output);

					
				}
			});
		}

		//create a function that will reset the table and display the exam
		function resetClassStudentTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_class tr').remove();

			//display the updated exam table
			displayClassStudents();
		}

		//create a function that will reset the table and display the exam
		function resetStudentListTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_student_list tr').remove();

			//display the updated exam table
			displayStudents();
		}

		//create a function that will reset the table
		function resetRecordTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_record tr').remove();
		}

		//function for getting the current id of the user
		function globalSetUserId(){

			//create a parameter
			var params = {};

			//set parameter
			params.Username = '<?php echo $this->session->userdata("username"); ?>';

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/globalGetUserId'); ?>",
				data: params,
				success: function(item){
					// console.log("printing item");
					// console.log(item);

					//then let us set locally the userid
					localStorage.setItem("uid", item);
				}
			});
		}


		//create a function that will display the dropdown for book name
		function displayDropdownExamBookCategory(){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_book_category_data'); ?>",
				success: function(data){

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '<option value="0"> ----- Choose a Book Category  ----- </option>';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].BookCategoryId +'">'+ data[i].BookCategoryName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb-record-book-category-filter").html(output);

				}
			});
			
		}

		//create a function that will display the dropdown for book
		function displayDropdownExamBooks(id){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_book_data_by_category_id'); ?>/" + id,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '<option value="0">  ----- Choose a Book  ----- </option>';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].BookId +'">'+ data[i].BookName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb-record-book-filter").html(output);

				}
			});
			
		}

		//create a function that will display the dropdown for book name
		function displayDropdownSchoolYear(){

			//declare a variable to be displayed
			var output = '<option value="0"> ----- Choose School Year  ----- </option>';

			var currentYear = moment().format("L").split("/")[2];
			var yearUntil = 2025

			//loop the data and assign it to data table
			for(var i = currentYear ; i <= yearUntil; i++){

				//set the output to be displayed
				output += '<option value="'+ i +'">'+ i +'</option>';

			}

			//display the data into our dropdown
			$("#cmb_archive_class_school_year").html(output);
			
		}
		
		//let us create a function that will only prints the specific area
		function printOnlySpecifiedDiv(divName, removeButtonPrint, removeDropdownPrint1, removeDropdownPrint2, removeDropdownPrint3, removeDropdownPrint4, removeDropdownPrint5) {

			//remove first the print button
			$('#'+removeButtonPrint).empty();
			if(removeDropdownPrint4 == ""){
				$('.'+removeDropdownPrint5).hide();
			}
			if(removeDropdownPrint1 != "" || removeDropdownPrint2 != "" || removeDropdownPrint3 != "" || removeDropdownPrint4 != ""){
				$('.'+removeDropdownPrint1).hide();
				$('.'+removeDropdownPrint2).hide();
				$('.'+removeDropdownPrint3).hide();
				$('.'+removeDropdownPrint4).hide();
			}

			//get the content from the div
			var printContents = document.getElementById(divName).innerHTML;

			//get the original contents from the div
			var originalContents = document.body.innerHTML;

			//set the document body
			document.body.innerHTML = printContents;

			//print the document
			window.print();

			//refresh the orinal content of the document
			document.body.innerHTML = originalContents;

			//then reload the page
			location.reload();
		}

	});

</script>