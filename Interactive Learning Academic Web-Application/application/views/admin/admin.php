<!-- include header -->
<?php $this->load->view("inc/header"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav"); ?>

	<div class="container">

		<!-- first main division of card -->
		<div class="">

			<div id="card-useraccount" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<!-- manage users content -->
	        	<div class="margin_all_10px">

			        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

		        		<ul uk-tab>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>Administrator</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>Teacher</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>Student</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: database"></span>Archive</a></li>
						</ul>

						<ul class="uk-switcher uk-margin">

							<!-- content for manage administrator -->
						    <li>
						    	<h3 class="font_white">Manage Administrator</h3>

						    	<!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
							        <div class="uk-form-controls uk-width-1-2">
							        	<label class="uk-form-label font_white" for="txt_admin_search">Search:</label>
							            <input class="uk-input uk-input" id="txt_admin_search" type="text">
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_admin_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_admin_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 82%;" class="uk-button uk-button-primary" href="#modal-admin" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Administrator</a>
								<br>
								<br>
								<div id="tbl_manage_admin"></div>
						    </li>

							<!-- content for manage teacher -->
						    <li>
						    	<h3 class="font_white">Manage Teacher</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
							        <div class="uk-form-controls  uk-width-1-2">
							        	<label class="uk-form-label font_white" for="txt_teacher_search">Search:</label>
							            <input class="uk-input uk-input" id="txt_teacher_search" type="text">
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_teacher_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_teacher_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 85%;" class="uk-button uk-button-primary" href="#modal-teacher" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Teacher</a>
								<br>
								<br>
								<div id="tbl_manage_teacher"></div>
						    </li>

							<!-- content for manage teacher -->
						    <li>
						    	<h3 class="font_white">Manage Student</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
							        <div class="uk-form-controls  uk-width-1-2">
							        	<label class="uk-form-label font_white" for="txt_student_search">Search:</label>
							            <input class="uk-input uk-input" id="txt_student_search" type="text">
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_student_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_student_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

						    	<div class="uk-grid-collapse" uk-grid>
						    		<div class="uk-width-1-2"></div>
						    		<div class="uk-width-auto" style="margin-left: 15%;">
			        					<button id="btnUpgradeAllLevel" uk-tooltip="Upgrade All Student Grade Level" class="uk-button uk-button-primary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span>Upgrade Grade Level</button>
						    		</div>
						    		<div class="uk-width-auto">
						    			&nbsp;
			        					<a uk-tooltip="Upload Excel file" class="uk-button uk-button-primary" href="#modal-student" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Student</a>
						    		</div>
						    	</div>

								<br>
								<br>
								<div id="tbl_manage_student"></div>
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

			<div id="card-travel" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<!-- manage travels content -->
	        	<div class="margin_all_10px">

			        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

		        		<ul uk-tab>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>Travel Category</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: world"></span>Travel</a></li>
						</ul>

						<ul class="uk-switcher uk-margin">

							<!-- content for manage travel category -->
						    <li>
						    	<h3 class="font_white">Manage Travel Category</h3>

						    	<!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_travel_category_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_travel_category_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_travel_category_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_travel_category_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 80%;" class="uk-button uk-button-primary" href="#modal-travel-category" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Travel Category</a>

								<br>
								<br>
								<div id="tbl_manage_travel_category"></div>
						    </li>

							<!-- content for manage travel -->
						    <li>
						    	<h3 class="font_white">Manage Travel</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_travel_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_travel_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_travel_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_travel_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 85%;" class="uk-button uk-button-primary" href="#modal-travel" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Travel</a>

								<br>
								<br>
								<div id="tbl_manage_travel"></div>
						    </li>
						</ul>
			        </div>
			    </div>
			</div>

			<div id="card-book" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<!-- manage books content -->
	        	<div class="margin_all_10px">

			        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

		        		<ul uk-tab>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>Book Category</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: world"></span>Book</a></li>
						</ul>

						<ul class="uk-switcher uk-margin">

							<!-- content for manage book category -->
						    <li>
						    	<h3 class="font_white">Manage Book Category</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_book_category_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_book_category_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_book_category_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_book_category_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 80%;" class="uk-button uk-button-primary" href="#modal-book-category" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Book Category</a>

								<br>
								<br>
								<div id="tbl_manage_book_category"></div>
						    </li>

							<!-- content for manage book -->
						    <li>
						    	<h3 class="font_white">Manage Book</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_book_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_book_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_book_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_book_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 85%;" class="uk-button uk-button-primary" href="#modal-book" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Book</a>

								<br>
								<br>
								<div id="tbl_manage_book"></div>
						    </li>
						</ul>
			        </div>
			    </div>
			</div>

			<div id="card-game" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<!-- manage games content -->
	        	<div class="margin_all_10px">

			        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

		        		<ul uk-tab>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>Game Category</a></li>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: world"></span>Game</a></li>
						</ul>

						<ul class="uk-switcher uk-margin">

							<!-- content for manage game category -->
						    <li>
						    	<h3 class="font_white">Manage Game Category</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_game_category_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_game_category_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_game_category_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_game_category_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 80%;" class="uk-button uk-button-primary" href="#modal-game-category" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Game Category</a>

								<br>
								<br>
								<div id="tbl_manage_game_category"></div>
						    </li>

							<!-- content for manage game -->
						    <li>
						    	<h3 class="font_white">Manage Game</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_game_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_game_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_game_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_game_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 85%;" class="uk-button uk-button-primary" href="#modal-game" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Game</a>

								<br>
								<br>
								<div id="tbl_manage_game"></div>
						    </li>
						</ul>
			        </div>
			    </div>
			</div>

			<div id="card-exam" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<!-- manage games content -->
	        	<div class="margin_all_10px">

			        <div class="uk-card uk-card-duodenary uk-card-body main_card_height_auto uk-animation-toggle" tabindex="0">

		        		<ul uk-tab>
						    <li><a href="#" class="font_white"><span class="uk-icon uk-margin-small-right" uk-icon="icon: menu"></span>Exam</a></li>
						</ul>

						<ul class="uk-switcher uk-margin">

							<!-- content for manage exam category -->
						    <li>
						    	<h3 class="font_white">Manage Exam</h3>

						        <!-- search -->
						    	<div class="uk-grid-collapse" uk-grid>
									<div class="uk-form-controls  uk-width-1-2">
										<label class="uk-form-label font_white" for="txt_exam_search">Search:</label>
									    <input class="uk-input uk-input" id="txt_exam_search" type="text">
									</div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Search" id="btn_exam_search" style="margin-top: 23px" class="uk-button uk-button-secondary"><span class="uk-icon uk-margin-small-right" uk-icon="icon: search"></span></button>
							        </div>
							        <div class="uk-form-controls uk-width-auto">
							        	&nbsp;
							        	<button uk-tooltip="Refresh" id="btn_exam_refresh" style="margin-top: 23px" class="uk-button uk-button-danger"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>
							        </div>
						    	</div>

			        			<a style="margin-left: 87%;" class="uk-button uk-button-primary" href="#modal-exam" uk-toggle><span class="uk-icon uk-margin-small-right" uk-icon="icon: plus"></span>Add Exam</a>

								<br>
								<br>
								<div id="tbl_manage_exam"></div>
						    </li>
						</ul>
			        </div>
			    </div>
			</div>

		</div>
	</div>

	<!-- modal for adding administrator -->
	<div id="modal-admin" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Administrator</h2>
	        </div>
	        <div class="uk-modal-body">
				
	        	<h4>Admin Information:</h4>

	        	<div class="uk-margin">
	        		<!-- firstname -->
			        <label class="uk-form-label" for="txt_add_admin_fname">Firstname:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_admin_fname" type="text" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>

			        <!-- middle initial -->
			        <label class="uk-form-label" for="txt_add_teacher_minitial">Middle Initial:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input uk-width-1-16" id="txt_add_admin_minitial" type="text" value="-" maxlength="1" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>

			        <!-- lastname -->
			        <label class="uk-form-label" for="txt_add_admin_lname">Lastname:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_admin_lname" type="text" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>
			    </div>

	        	<h4>Account Information:</h4>

	        	<div class="uk-margin">
	        		<!-- username -->
			        <label class="uk-form-label" for="txt_add_admin_username">Username:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_admin_username" type="text" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>

			        <!-- password -->
			        <label class="uk-form-label" for="txt_add_admin_password">Password:</label>
			        <span class="uk-form-label" id="span_add_admin_password"></span>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_admin_password" type="password" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>

			        <!-- confirm password -->
			        <label class="uk-form-label" for="txt_add_admin_confirm_password">Confirm Password:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_admin_confirm_password" type="password" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	        	<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_admin_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding teacher -->
	<div id="modal-teacher" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Teacher</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<h4>Teacher Information:</h4>

	        	<div class="uk-margin">
	        		<!-- firstname -->
			        <label class="uk-form-label" for="txt_add_teacher_fname">Firstname:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_teacher_fname" type="text" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>

			        <!-- middle initial -->
			        <label class="uk-form-label" for="txt_add_teacher_minitial">Middle Initial:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input uk-width-1-16" id="txt_add_teacher_minitial" type="text" value="-" maxlength="1" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>

			        <!-- lastname -->
			        <label class="uk-form-label" for="txt_add_teacher_lname">Lastname:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_teacher_lname" type="text" onkeypress="return allowOnlyAplhabet(event)" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
			        </div>
			    </div>

	        	<h4>Account Information:</h4>

	        	<div class="uk-margin">
	        		<!-- username -->
			        <label class="uk-form-label" for="txt_add_teacher_username">Username:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_teacher_username" type="text" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>

			        <!-- password -->
			        <label class="uk-form-label" for="txt_add_teacher_password">Password:</label>
			        <span class="uk-form-label" id="span_add_teacher_password"></span>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_teacher_password" type="password" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>

			        <!-- confirm password -->
			        <label class="uk-form-label" for="txt_add_teacher_confirm_password">Confirm Password:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_teacher_confirm_password" type="password" onkeypress="return allowOnlyAlphaNumeric(event)">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_teacher_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding student -->
	<div id="modal-student" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Student</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- excel file -->
			        <label class="uk-form-label" for="cmb_add_student_grade_level">Grade Level: </label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_student_grade_level">
			            	<option value="1">Grade 1</option>
			            	<option value="2">Grade 2</option>
			            	<option value="3">Grade 3</option>
			            </select>
			        </div>
			    </div>

	        	<div class="uk-margin">
	        		<!-- excel file -->
			        <label class="uk-form-label" for="txt_add_student_file">Import Student Excel File:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_student_file" type="file" accept=".xls, .xlsx, .csv">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_student_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding travel category -->
	<div id="modal-travel-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Travel Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- travel category name -->
			        <label class="uk-form-label" for="txt_add_travel_category_name">Travel Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_travel_category_name" type="text">
			        </div>

	        		<!-- travel category file -->
			        <label class="uk-form-label" for="txt_add_travel_category_image">Travel Category Image:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_travel_category_image" id="txt_add_travel_category_image" type="file" accept="image/*">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_travel_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing travel category -->
	<div id="modal-edit-travel-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Travel Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- travel category name -->
			        <label class="uk-form-label" for="txt_edit_travel_category_name">Travel Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_travel_category_name" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_travel_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding travel -->
	<div id="modal-travel" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Travel</h2>
	        </div>

        	<div class="uk-modal-body">
	        	<div class="uk-margin">

	        		<!-- travel category -->
	        		<label class="uk-form-label" for="cmb_add_travel_category">Select Travel Category</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_travel_category"></select>
			        </div>

	        		<!-- travel name -->
			        <label class="uk-form-label" for="txt_add_travel_name">Travel Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_travel_name" id="txt_add_travel_name" type="text">
			        </div>

	        		<!-- travel description -->
			        <label class="uk-form-label" for="txt_add_travel_description">Travel Description:</label>
			        <div class="uk-form-controls">
			        	<textarea class="uk-input uk-input" name="txt_add_travel_description" id="txt_add_travel_description" style="height: 200px;"></textarea>
			        </div>

	        		<!-- travel file -->
			        <label class="uk-form-label" for="txt_add_travel_image">Travel Image:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_travel_image" id="txt_add_travel_image" type="file" accept="image/*">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_travel_submit">Submit</button>
	        </div>
	        
	    </div>
	</div>

	<!-- modal for editing travel -->
	<div id="modal-edit-travel" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Travel</h2>
	        </div>
	        <div class="uk-modal-body">
	        		
        		<!-- travel name -->
		        <label class="uk-form-label" for="txt_edit_travel_name">Travel Name:</label>
		        <div class="uk-form-controls">
		            <input class="uk-input uk-input" name="txt_edit_travel_name" id="txt_edit_travel_name" type="text">
		        </div>

        		<!-- travel description -->
		        <label class="uk-form-label" for="txt_edit_travel_description">Travel Description:</label>
		        <div class="uk-form-controls">
		        	<textarea class="uk-input uk-input" name="txt_edit_travel_description" id="txt_edit_travel_description" style="height: 200px;"></textarea>
		        </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_travel_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding book category -->
	<div id="modal-book-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Book Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- book category name -->
			        <label class="uk-form-label" for="txt_add_book_category_name">Book Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_book_category_name" type="text">
			        </div>

	        		<!-- book category file -->
			        <label class="uk-form-label" for="txt_add_book_category_image">Book Category Image:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_book_category_image" id="txt_add_book_category_image" type="file" accept="image/*">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_book_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing book category -->
	<div id="modal-edit-book-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Book Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- book category name -->
			        <label class="uk-form-label" for="txt_edit_book_category_name">Book Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_book_category_name" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_book_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding book -->
	<div id="modal-book" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Book</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- book category -->
	        		<label class="uk-form-label" for="cmb_add_book_category">Select Book Category</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_book_category"></select>
			        </div>

	        		<!-- book name -->
			        <label class="uk-form-label" for="txt_add_book_name">Book Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_book_name" type="text">
			        </div>

	        		<!-- book description -->
			        <label class="uk-form-label" for="txt_add_book_description">Book Description:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_book_description" type="text">
			        </div>

	        		<!-- book file -->
			        <label class="uk-form-label" for="txt_add_book_video">Book Video:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_book_video" id="txt_add_book_video" type="file" accept="video/*">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_book_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing book -->
	<div id="modal-edit-book" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Book</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">

	        		<!-- book name -->
			        <label class="uk-form-label" for="txt_edit_book_name">Book Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_book_name" type="text">
			        </div>

	        		<!-- book description -->
			        <label class="uk-form-label" for="txt_edit_book_description">Book Description:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_book_description" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_book_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding game category -->
	<div id="modal-game-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Game Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- game category name -->
			        <label class="uk-form-label" for="txt_add_game_category_name">Game Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_game_category_name" type="text">
			        </div>

	        		<!-- game category file -->
			        <label class="uk-form-label" for="txt_add_game_category_image">Game Category Image:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_game_category_image" id="txt_add_game_category_image" type="file" accept="image/*">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_game_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing game category -->
	<div id="modal-edit-game-category" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Game Category</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">
	        		<!-- game category name -->
			        <label class="uk-form-label" for="txt_edit_game_category_name">Game Category Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_game_category_name" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_game_category_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding game -->
	<div id="modal-game" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Game</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">

	        		<!-- game category -->
	        		<label class="uk-form-label" for="cmb_add_game_category">Select Game Category</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_game_category"></select>
			        </div>

	        		<!-- game name -->
			        <label class="uk-form-label" for="txt_add_game_name">Game Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_game_name" type="text">
			        </div>

	        		<!-- game file -->
			        <label class="uk-form-label" for="txt_add_game_image">Game Image:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" name="txt_add_game_image" id="txt_add_game_image" type="file" accept="image/*">
			        </div>

	        		<!-- game link -->
			        <label class="uk-form-label" for="txt_add_game_link">Game Link:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_add_game_link" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_game_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing game -->
	<div id="modal-edit-game" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Game</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">

	        		<!-- game name -->
			        <label class="uk-form-label" for="txt_edit_game_name">Game Name:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_game_name" type="text">
			        </div>

	        		<!-- game link -->
			        <label class="uk-form-label" for="txt_edit_game_link">Game Link:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_game_link" type="text">
			        </div>
			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_game_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for adding exam -->
	<div id="modal-exam" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Add Exam</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">

	        		<!-- book category-->
	        		<label class="uk-form-label" for="cmb_add_exam_book_category">Select Book Category</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_exam_book_category"></select>
			        </div>

	        		<!-- book -->
	        		<label class="uk-form-label" for="cmb_add_exam_book">Select Book</label>
			        <div class="uk-form-controls">
			            <select class="uk-select" id="cmb_add_exam_book"></select>
			        </div>

	        		<div class="uk-margin">
		        		<!-- excel file -->
				        <label class="uk-form-label" for="txt_add_exam_file">Impot Exam Excel File:</label>
				        <div class="uk-form-controls">
				            <input class="uk-input uk-input" id="txt_add_exam_file" type="file" accept=".xls, .xlsx, .csv">
				        </div>
				    </div>

			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_add_exam_submit">Submit</button>
	        </div>
	    </div>
	</div>

	<!-- modal for editing exam -->
	<div id="modal-edit-exam" uk-modal>
	    <div class="uk-modal-dialog uk-width-1-2">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <div class="uk-modal-header">
	            <h2 class="uk-modal-title">Edit Exam</h2>
	        </div>
	        <div class="uk-modal-body">

	        	<div class="uk-margin">

	        		<!-- question -->
			        <label class="uk-form-label" for="txt_edit_question">Question:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_question" type="text">
			        </div>

	        		<!-- first option -->
			        <label class="uk-form-label" for="txt_edit_option1">First option:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_option1" type="text">
			        </div>

	        		<!-- second option -->
			        <label class="uk-form-label" for="txt_edit_option2">Second option:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_option2" type="text">
			        </div>

	        		<!-- third option -->
			        <label class="uk-form-label" for="txt_edit_option3">Third option:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_option3" type="text">
			        </div>

	        		<!-- fourth option -->
			        <label class="uk-form-label" for="txt_edit_option4">Fourth option:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_option4" type="text">
			        </div>

	        		<!-- correct option -->
			        <label class="uk-form-label" for="txt_edit_correct_option">Correct option:</label>
			        <div class="uk-form-controls">
			            <input class="uk-input uk-input" id="txt_edit_correct_option" type="text">
			        </div>

			    </div>

			    <div class="uk-margin">
			    	
			    	<div uk-grid>

			    		<div class="uk-width-1-2">
			        		<!-- exam type option -->
					        <label class="uk-form-label" for="cmb_edit_exam_type">Exam Type:</label>
					        <div class="uk-form-controls">
					            <select class="uk-select" id="cmb_edit_exam_type">
					            	<option value="0">Choose an option</option>
					            	<option value="1">Written Exam</option>
					            	<option value="2">Visual/Audio Exam</option>
					            </select>
					        </div>
			    		</div>

			    		<div class="uk-width-1-2">
			    			<div class="txt_edit_exam_file">
				        		<!-- exam file option -->
						        <label class="uk-form-label" for="txt_edit_exam_file">Exam File:</label>
						        <div class="uk-form-controls">
						        	<input class="uk-input uk-input" type="file" id="txt_edit_exam_file">
						        </div>
			    			</div>
			    		</div>

			    	</div>

			    </div>

	        </div>
	        <div class="uk-modal-footer uk-text-right">
	            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
	            <button class="uk-button uk-button-primary" id="btn_edit_exam_submit">Submit</button>
	        </div>
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

<!-- include footer -->
<?php $this->load->view("inc/footer"); ?>

<script type="text/javascript">

	//create a function that will only allow the user to input alpha numeric
	function allowOnlyAlphaNumeric(e) {
	    var k;
	    document.all ? k = e.keyCode : k = e.which;
	    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
	}

	//create a function that will only allow the user to input alphabets
	function allowOnlyAplhabet(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }

	//restrictions for creating admin and teacher where there should be no spaces on first input

	//admin firstname validation
	document.getElementById("txt_add_admin_fname").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//admin lastname validation
	document.getElementById("txt_add_admin_lname").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//admin username validation
	document.getElementById("txt_add_admin_username").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//admin password validation
	document.getElementById("txt_add_admin_password").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//admin confirm password validation
	document.getElementById("txt_add_admin_confirm_password").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//teacher firstname validation
	document.getElementById("txt_add_teacher_fname").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//teacher lastname validation
	document.getElementById("txt_add_teacher_lname").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//teacher username validation
	document.getElementById("txt_add_teacher_username").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//teacher password validation
	document.getElementById("txt_add_teacher_password").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	//teacher confirm password validation
	document.getElementById("txt_add_teacher_confirm_password").addEventListener('keydown', function (e) {
		if (this.value.length === 0 && e.which === 32) e.preventDefault();
	});

	$(document).ready(function(){

		//display spinner modal
		globalDisplaySpinnerModal(1000);

		//when upgrade level button is clicked
		$("#btnUpgradeAllLevel").click(function(){

			UIkit.modal.confirm("Are you sure you want to Upgrade All Grade Level?").then(function() {

				//create a promise variable that will identify if the main task were complete
				var promiseResult = new Promise((resolve, reject) =>{

					//get all the student
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('cn/display_studentlist_data'); ?>",
						data: {},
						success: function(item){

							//parse the data into JSON format
							item = JSON.parse(item);

							//let us sort the item by username
							item = _.sortBy(item, "Username");

							// console.log("printing student list item");
							// console.log(item);

							//return resolve response by passing the data from our ajax call
							resolve(item);


						},
						error: function(response){

							//return reject response
							reject(response);

						}
					});
				});

				promiseResult.then(data => {

					// console.log("printing data");
					// console.log(data);

					var secondPromiseResult = new Promise((resolve, reject) => {

						//let us loop the data
						for(var i = 0 ; i < data.length; i++){

							//get the current grade level of the student and the user account id
							var current_user_account_id = data[i].UserAccountId;
							var current_grade_level = data[i].GradeLevel;

							//check if the current grade level of the student is less than grade 4
							if(parseInt(current_grade_level) <= 3){

								//declare parameters
								var params = {};

								//set parameters
								params.UserAccountId = current_user_account_id;
								params.GradeLevel = parseInt(current_grade_level) + 1;

								// console.log("printing params");
								// console.log(params);

								//update the student grade level by adding 1//get all the student
								$.ajax({
									type: "POST",
									url: "<?php echo base_url('cn/update_grade_level'); ?>",
									data: params,
									success: function(item){

										//return a resolve response
										resolve("Upgraded");

									},
									error: function(response){

										//return a reject response
										reject(response);

									}
								});

							}else{ //means the student were already grade 4 and needs to be deactivated

								//declare parameters
								var params = {};

								//set parameters
								params.id = current_user_account_id;
								params.IsActive = 0; //means deactivated

								// console.log("printing params");
								// console.log(params);

								//update the student where grade level is 4 then deactivate
								$.ajax({
									type: "POST",
									url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
									data: params,
									success: function(item){

										//return a resolve response
										resolve("Deactivated");

									},
									error: function(response){

										//return a reject response
										reject(response);

									}
								});
							}
						}
					});

					//get the result from the second promise
					secondPromiseResult.then(data =>{

						if(data == "Upgraded"){
							//call the function for displaying the alert
							globalDisplayAlert("All Grade Level were now Successfully Upgraded!");
						}else if(data == "Deactivated"){
							//call the function for displaying the alert
							globalDisplayAlert("There are some students were deactivated!");
						}

					}).catch(response => {

						alert(response);

						console.log("printing second promise response");
						console.log(response);

					});

				}).catch(response => {

					alert(response);
						
					console.log("printing first promise response");
					console.log(response);
					
				});

			}, function () {

				//do nothing just let the log tracker knows the event
			    console.log('Rejected.');

			});

			

		});



		//-----------------------------------------------------ADMIN FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the data
		displayAdmins();

		//remove the span if the password is focused and clear the password and confirm password
		$("#txt_add_admin_password").focus(function(){
			$("#span_add_admin_password").html("").css("color", "red");
			$("#txt_add_admin_password").val('');
			$("#txt_add_admin_confirm_password").val('');
		});

		//if button btn_add_admin_submit is clicked
		$("#btn_add_admin_submit").click(function() {

			//declare the inputs
			var Firstname = $("#txt_add_admin_fname").val();
			var Middleinitial = $("#txt_add_admin_minitial").val();
			var Lastname = $("#txt_add_admin_lname").val();
			var Username = $("#txt_add_admin_username").val();
			var Password = $("#txt_add_admin_password").val();
			var ConfirmPassword = $("#txt_add_admin_confirm_password").val();

			if(Firstname == ""){
				$("#txt_add_admin_fname").addClass("uk-form-danger").attr("placeholder", "Please fill in Firstname!");
			}else if(Middleinitial == ""){
				$("#txt_add_admin_minitial").addClass("uk-form-danger").attr("placeholder", "Please fill in Middleinitial!");
			}else if(Lastname == ""){
				$("#txt_add_admin_lname").addClass("uk-form-danger").attr("placeholder", "Please fill in Lastname!");
			}else if(Username == ""){
				$("#txt_add_admin_username").addClass("uk-form-danger").attr("placeholder", "Please fill in Username!");
			}else if(Password == ""){
				$("#txt_add_admin_password").addClass("uk-form-danger").attr("placeholder", "Please fill in Password!");
			}else if(Password.length < 8){
				$("#span_add_admin_password").html("Password should be 8 characters and above!").css("color", "red");
			}else if(ConfirmPassword != Password){
				$("#txt_add_admin_confirm_password").addClass("uk-form-danger").val("").attr("placeholder", "Password mismatched!");
			}else{

				//declare parameter
				var params = {};

				//user detail parameters
				params.Firstname = Firstname;
				params.Middleinitial = Middleinitial;
				params.Lastname = Lastname;
				params.DateOfBirth = "";
				params.Age = "";
				params.Gender = "";
				params.IsDeleted = 0;

				//user account parameters
				params.Username = Username;
				params.Password = Password;
				params.IsActive = 1;
				params.UserRole = "Administrator";

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_user'); ?>",
					data: params,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetAdminTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_deactivate_admin is clicked
		$(document).on('click','.btn_deactivate_admin', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetAdminTable();
					}
				}
			});

		});

		//if button btn_deactivate_admin is clicked
		$(document).on('click','.btn_activate_admin', function(){

			//get the id of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 1; //means activate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetAdminTable();
					}
				}
			});

		});

		//when the text btn_admin_search is clicked
		$("#btn_admin_search").click(function(){

			//get the current value
			var search_value = $("#txt_admin_search").val();

			//get the current data from the grid
			var grid_data = $("#tbl_manage_admin").jsGrid("option", "data");

			//then filter the data
			var filtered_data = _.filter(grid_data, function(i){
				return i.Lastname.toLowerCase().includes(search_value.toLowerCase()) || i.Firstname.toLowerCase().includes(search_value.toLowerCase()) || i.Middleinitial.toLowerCase().includes(search_value.toLowerCase());
			});

			//call the function for filtering the grid
			resetGridAndFilterData("tbl_manage_admin", filtered_data);

		});

		//when button refresh is clicked
		$("#btn_admin_refresh").click(function(){

			$("#txt_admin_search").val('');

			//display all the data for admin
			displayAdmins();

		});




		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayAdmins(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_admin_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					// console.log("printing item");
					// console.log(item);

					//let us sort the item by username
					item = _.sortBy(item, "Username");

					//call the function that will display the table
					displayTable("tbl_manage_admin", item, "admin");
				}
			});
		}

		//create a function that will reset the table and display the admin
		function resetAdminTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_admin tr').remove();

			//display the updated admin table
			displayAdmins();
		}



		//-----------------------------------------------------ADMIN GLOBAL FUNCTIONALITY-----------------------------------//

		//create a global function that will display table for admin, teacher and student
		function displayTable(tablename, data, type){

			//declare the grid
			$("#" + tablename).jsGrid({

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
                        name: "Firstname",
                        title: "Firstname",
                        type: "text",
                    },
                    {
                        name: "Middleinitial",
                        title: "Middleinitial",
                        type: "text",
                    },
                    {
                        name: "Lastname",
                        title: "Lastname",
                        type: "text",
                    },
                    {
                        name: "IsActive",
                        title: "Status",
                        type: "text",
                        itemTemplate: function(value, item){

                        	var output = "";

                        	//if the value is 0 - means deactivated
                        	if(value == 0){

                        		output = "Deactivated";

                        	}else{ //if the value is 1 - means activated

                        		output = "Activated";
                        	}

                        	return output;

                        }
                    },
                    {
                        name: "IsActive",
                        title: "Action",
                        itemTemplate: function (value, item) {

                            var output = "";

                            //if the value is 0 - means deactivated
                            if(value == 0){

                            	output = '<button uk-tooltip="Activate" class="uk-icon uk-margin-small-right btn_activate_'+ type +'" data-id="'+item.UserDetailId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';

                            }else{ //if the value is 1 - means activated

                            	output = '<button uk-tooltip="Deactivate" class="uk-icon uk-margin-small-right btn_deactivate_'+ type +'" data-id="'+item.UserDetailId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

                            }

                            
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






		//-----------------------------------------------------TEACHER FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the data
		displayTeachers();

		//remove the span if the password is focused and clear the password and confirm password
		$("#txt_add_teacher_password").focus(function(){
			$("#span_add_teacher_password").html("").css("color", "red");
			$("#txt_add_teacher_password").val('');
			$("#txt_add_teacher_confirm_password").val('');
		});

		//if button btn_add_teacher_submit is clicked
		$("#btn_add_teacher_submit").click(function() {

			//declare the inputs
			var Firstname = $("#txt_add_teacher_fname").val();
			var Middleinitial = $("#txt_add_teacher_minitial").val();
			var Lastname = $("#txt_add_teacher_lname").val();
			var Username = $("#txt_add_teacher_username").val();
			var Password = $("#txt_add_teacher_password").val();
			var ConfirmPassword = $("#txt_add_teacher_confirm_password").val();

			if(Firstname == ""){
				$("#txt_add_teacher_fname").addClass("uk-form-danger").attr("placeholder", "Please fill in Firstname!");
			}else if(Middleinitial == ""){
				$("#txt_add_teacher_minitial").addClass("uk-form-danger").attr("placeholder", "Please fill in Middleinitial!");
			}else if(Lastname == ""){
				$("#txt_add_teacher_lname").addClass("uk-form-danger").attr("placeholder", "Please fill in Lastname!");
			}else if(Username == ""){
				$("#txt_add_teacher_username").addClass("uk-form-danger").attr("placeholder", "Please fill in Username!");
			}else if(Password == ""){
				$("#txt_add_teacher_password").addClass("uk-form-danger").attr("placeholder", "Please fill in Password!");
			}else if(Password.length < 8){
				$("#span_add_teacher_password").html("Password should be 8 characters and above!").css("color", "red");
			}else if(ConfirmPassword != Password){
				$("#txt_add_teacher_confirm_password").addClass("uk-form-danger").val("").attr("placeholder", "Password mismatched!");
			}else{

				//declare parameter
				var params = {};

				//user detail parameters
				params.Firstname = Firstname;
				params.Middleinitial = Middleinitial;
				params.Lastname = Lastname;
				params.DateOfBirth = "";
				params.Age = "";
				params.Gender = "";
				params.IsDeleted = 0;

				//user account parameters
				params.Username = Username;
				params.Password = Password;
				params.IsActive = 1;
				params.UserRole = "Teacher";

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_user'); ?>",
					data: params,
					success: function(data){

						console.log("printing data");
						console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetTeacherTable();

							//clear the textbox
							clearAllTextBoxes();

						}else if(data == "Duplicated"){

							//call the function for displaying the alert
							globalDisplayAlert("There is already an existing account for this username!");

							//call the function for resetting the data 
							//table and display the updated data
							resetTeacherTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_deactivate_admin is clicked
		$(document).on('click','.btn_deactivate_teacher', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTeacherTable();
					}
				}
			});

		});

		//if button btn_deactivate_teacher is clicked
		$(document).on('click','.btn_activate_teacher', function(){

			//get the id of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 1; //means activate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTeacherTable();
					}
				}
			});

		});

		//when the text btn_teacher_search is clicked
		$("#btn_teacher_search").click(function(){

			//get the current value
			var search_value = $("#txt_teacher_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying all the admin
				displayTeachers();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_teacher").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.Lastname.toLowerCase().includes(search_value.toLowerCase()) || i.Firstname.toLowerCase().includes(search_value.toLowerCase()) || i.Middleinitial.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_teacher", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_teacher_refresh").click(function(){

			$("#txt_teacher_refresh").val('');

			//display all the data for teachers
			displayTeachers();

		});




		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayTeachers(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_teacher_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//let us sort the item by username
					item = _.sortBy(item, "Username");

					//call the function that will display the table
					displayTable("tbl_manage_teacher", item, "teacher");
				}
			});
		}

		//create a function that will reset the table and display the teacher
		function resetTeacherTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_teacher tr').remove();

			//display the updated teacher table
			displayTeachers();
		}




		//-----------------------------------------------------STUDENT FUNCTIONALITY-----------------------------------//

		//display student data
		displayStudent();

		//--------------------------EVENTS-----------------------------//
		$("#btn_add_student_submit").click(function(){

			//get the value of the grade level option
			var gradelevel = $("#cmb_add_student_grade_level").val();

			//get the value from the selected excel file
			var excelfile = document.getElementById("txt_add_student_file").files[0];

			//check if there is no selected file
			if($("#txt_add_student_file").val() == ""){
				$("#txt_add_student_file").addClass("uk-form-danger").attr("placeholder", "Please select an excel file!");
			} else {

				//create a parameter for our form data
				var params = new FormData();

				//let us set the parameters that will be passed in our ajax call
				params.append("gradelevel", gradelevel);
				params.append("excelfile", excelfile);

				$.ajax({
					url: "<?php echo base_url(); ?>cn/upload_student_file",
					method: "POST",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						//call the function for displaying the alert
						globalDisplayAlert(data);

						//call the function for resetting the data 
						//table and display the updated data
						resetStudentTable();

						//clear the textbox
						clearAllTextBoxes();
					}
				});
			}

		});

		//if button btn_deactivate_admin is clicked
		$(document).on('click','.btn_deactivate_student', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetStudentTable();
					}
				}
			});

		});

		//if button btn_deactivate_admin is clicked
		$(document).on('click','.btn_activate_student', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsActive = 1; //means activate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_user'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetStudentTable();
					}
				}
			});

		});

		//when the text btn_student_search is clicked
		$("#btn_student_search").click(function(){

			//get the current value
			var search_value = $("#txt_student_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying all the admin
				displayStudent();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_student").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.Lastname.toLowerCase().includes(search_value.toLowerCase()) || i.Firstname.toLowerCase().includes(search_value.toLowerCase()) || i.Middleinitial.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_student", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_student_refresh").click(function(){

			$("#txt_student_search").val('');

			//display all the data for admin
			displayStudent();

		});

		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayStudent(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_student_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//let us sort the item by username
					item = _.sortBy(item, "Username");

					//call the function that will display the table
					displayTable("tbl_manage_student", item, "student");
				}
			});
		}

		//create a function that will reset the table and display the travel category
		function resetStudentTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_student tr').remove();

			//display the updated travel category table
			displayStudent();
		}



		//-----------------------------------------------------STUDENT FUNCTIONALITY-----------------------------------//

		//call the function for displaying the archive
		displayArchiveClassStudents();

		//call the function for displaying the dropdown for school year
		displayDropdownSchoolYear();

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

		//---------------------------------------FUNCTIONS------------------------------------
		//populate the data
		function displayArchiveClassStudents(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_class_student_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//sort by lastname
					item = _.sortBy(item, "Lastname");

					//avoid duplicated data
					item = _.uniq(item, "Lastname");

					// //do the filtering for the data that should only display a student for that assigned teacher
					// item = _.where(item, { TeacherId: localStorage["uid"] });

					// console.log("printing item");
					// console.log(item);

					//call the function for displaying the class student grid
					displayArchiveClassStudentsTable(item, "class");
				}
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



		//-----------------------------------------TRAVEL CATEGORY FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the data
		displayTravelCategory();

		//if button btn_add_travel_category_submit is clicked
		$("#btn_add_travel_category_submit").click(function() {

			//declare the inputs
			var TravelCategoryName = $("#txt_add_travel_category_name").val();
			var TravelCategoryPictureFileName = document.getElementById("txt_add_travel_category_image").files[0];

			if(TravelCategoryName == ""){
				$("#txt_add_travel_category_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Travel Category Name!");
			}else if($("#txt_add_travel_category_image").val() == ""){
				$("#txt_add_travel_category_image").addClass("uk-form-danger").attr("placeholder", "Please fill in Travel Category Image!");
			}else{

				//declare parameter
				var params = new FormData();

				//user detail parameters
				params.append("TravelCategoryName", TravelCategoryName);
				params.append("TravelCategoryPictureFileName", TravelCategoryPictureFileName);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_travel_category'); ?>",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetTravelCategoryTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_disable_travel_category is clicked
		$(document).on('click','.btn_disable_travel_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_travel_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelCategoryTable();
					}
				}
			});

		});

		//if button btn_enable_travel_category is clicked
		$(document).on('click','.btn_enable_travel_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_travel_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelCategoryTable();
					}
				}
			});

		});

		//if button btn_edit_travel_category is clicked
		$(document).on('click','.btn_edit_travel_category', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");

			//show the modal for editing
			UIkit.modal("#modal-edit-travel-category").show();

			//set values to these html tags and attributes
			$("#txt_edit_travel_category_name").val(name);
			$("#btn_edit_travel_category_submit").attr("data-id", id);

		});

		//if button btn_edit_travel_category_submit is clicked
		$("#btn_edit_travel_category_submit").click(function(){

			//declare variables
			var category_id = $(this).attr("data-id");
			var category_name = $("#txt_edit_travel_category_name").val();

			//declare parameter
			var params = {};
			params.TravelCategoryId = category_id;
			params.TravelCategoryName = category_name;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_travel_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelCategoryTable();
					}
				}
			});
		});

		//when the text btn_travel_category_search is click
		$("#btn_travel_category_search").click(function(){

			//get the current value
			var search_value = $("#txt_travel_category_search").val();

			//get the current data from the grid
			var grid_data = $("#tbl_manage_travel_category").jsGrid("option", "data");

			//then filter the data
			var filtered_data = _.filter(grid_data, function(i){
				return i.TravelCategoryName.toLowerCase().includes(search_value.toLowerCase());
			});

			//call the function for filtering the grid
			resetGridAndFilterData("tbl_manage_travel_category", filtered_data);

		});

		//when button refresh is clicked
		$("#btn_travel_category_refresh").click(function(){

			$("#txt_travel_category_search").val('');

			//display all the data for admin
			displayTravelCategory();

		});


		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayTravelCategory(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_travel_category_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//display travel category table
					displayTravelCategoryTable(item, "travel_category");

				}
			});
		}

		//create a function that will reset the table and display the travel category
		function resetTravelCategoryTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_travel_category tr').remove();

			//display the updated travel category table
			displayTravelCategory();
		}

		//create a function that will display grid table for travel category
		function displayTravelCategoryTable(data, type){

			//declare the grid
			$("#tbl_manage_travel_category").jsGrid({

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
		                name: "TravelCategoryName",
		                title: "Travel Category Name",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_travel_category" data-id="'+item.TravelCategoryId+'" data-name="'+item.TravelCategoryName+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_travel_category" data-id="'+item.TravelCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_travel_category" data-id="'+item.TravelCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}











		//-----------------------------------------------------TRAVEL FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the travel category
		displayDropdownTravelCategory();

		//call the function for displaying the data
		displayTravel();

		//if button btn_add_travel_category_submit is clicked
		$("#btn_add_travel_submit").click(function(e){

			//variable declarations
			var travel_category_id = $("#cmb_add_travel_category option:selected").val();
			var txt_add_travel_name = $('#txt_add_travel_name').val();
			var txt_add_travel_description = $('#txt_add_travel_description').val();
			var txt_add_travel_image = document.getElementById("txt_add_travel_image").files[0];

			if(txt_add_travel_name == ""){
				$("#txt_add_travel_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Travel Name!");
			} else if(txt_add_travel_description == ""){
				$("#txt_add_travel_description").addClass("uk-form-danger").attr("placeholder", "Please fill in Travel Description!");
			} else if($("#txt_add_travel_image").val() == ""){
				$("#txt_add_travel_image").addClass("uk-form-danger").attr("placeholder", "Please select an Image!");
			}

			//declare parameters
			var params = new FormData();

			//assign parameters
			params.append("TravelCategoryId", travel_category_id);
			params.append("TravelName", txt_add_travel_name);
			params.append("TravelDescription", txt_add_travel_description);
			params.append("TravelPictureFileName", txt_add_travel_image);
			params.append("IsDeleted", 0);

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				url: "<?php echo base_url('cn/create_new_travel'); ?>",
				method: "POST",
				data: params,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data){

					console.log("printing data");
					console.log(data);

					if(data == "Inserted"){

						//call the function for displaying the alert
						globalDisplayAlert("Successfully inserted!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelTable();

						//clear the textbox
						clearAllTextBoxes();
					}
					else{

						//call the function for displaying the alert
						globalDisplayAlert(data);

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelTable();
					}
				}
			});


		});

		//if button btn_disable_travel is clicked
		$(document).on('click','.btn_disable_travel', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_travel'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelTable();
					}
				}
			});

		});

		//if button btn_enable_travel is clicked
		$(document).on('click','.btn_enable_travel', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means activate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_travel'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelTable();
					}
				}
			});

		});

		//if button btn_edit_travel_category is clicked
		$(document).on('click','.btn_edit_travel', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");
			var desc = $(this).data("desc");

			//show the modal for editing
			UIkit.modal("#modal-edit-travel").show();

			//set values to these html tags and attributes
			$("#txt_edit_travel_name").val(name);
			$("#txt_edit_travel_description").val(desc);
			$("#btn_edit_travel_submit").attr("data-id", id);

		});

		//if button btn_edit_travel_submit is clicked
		$("#btn_edit_travel_submit").click(function(){

			//declare variables
			var travel_id = $(this).attr("data-id");
			var travel_name = $("#txt_edit_travel_name").val();
			var travel_desc = $("#txt_edit_travel_description").val();

			//declare parameter
			var params = {};
			params.TravelId = travel_id;
			params.TravelName = travel_name;
			params.TravelDescription = travel_desc;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_travel'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetTravelTable();
					}
				}
			});
		});

		//when the text btn_travel_search is clicked
		$("#btn_travel_search").click(function(){

			//get the current value
			var search_value = $("#txt_travel_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayTravel();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_travel").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.TravelName.toLowerCase().includes(search_value.toLowerCase()) || i.TravelDescription.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_travel", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_travel_refresh").click(function(){

			$("#txt_travel_search").val('');

			//display all the data for travel
			displayTravel();

		});

		//--------------------------FUNCTIONS-----------------------------//
		
		//populate the data
		function displayTravel(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_travel_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//call the function for displaying the grid for travel
					displayTravelTable(item, "travel");
				}
			});
		}

		//create a function that will display the dropdown for book category
		function displayDropdownTravelCategory(){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_travel_category_data'); ?>",
				success: function(data){

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].TravelCategoryId +'">'+ data[i].TravelCategoryName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb_add_travel_category").html(output);

				}
			});
			
		}

		//create a function that will reset the table and display the travel category
		function resetTravelTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_travel tr').remove();

			//display the updated travel category table
			displayTravel();
		}

		//create a function that will display grid table for travel
		function displayTravelTable(data, type){

			//declare the grid
			$("#tbl_manage_travel").jsGrid({

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
		                name: "TravelName",
		                title: "Travel Name",
		                type: "text",
		            },
		            {
		                name: "TravelDescription",
		                title: "Travel Description",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_travel" data-id="'+item.TravelId+'" data-name="'+item.TravelName+'" data-desc="'+item.TravelDescription+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_travel" data-id="'+item.TravelId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_travel" data-id="'+item.TravelId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}



		//-----------------------------------------BOOK FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//
		
		//call the function that will display the drop for book category
		displayDropdownBookCategory();

		//call the function for displaying the data
		displayBook();

		//if button btn_add_book_submit is clicked
		$("#btn_add_book_submit").click(function() {

			//declare the inputs
			var BookName = $("#txt_add_book_name").val();
			var BookDescription = $("#txt_add_book_description").val();
			var BookCategoryId = $("#cmb_add_book_category option:selected").val();
			var BookVideoFileName = document.getElementById("txt_add_book_video").files[0];

			if(BookName == ""){
				$("#txt_add_book_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Book  Name!");
			}else if(BookDescription == ""){
				$("#txt_add_book_description").addClass("uk-form-danger").attr("placeholder", "Please fill in Book  Description!");
			}else if($("#txt_add_book_video").val() == ""){
				$("#txt_add_book_video").addClass("uk-form-danger").attr("placeholder", "Please fill in Book  Video!");
			}else{

				//declare parameter
				var params = new FormData();

				//user detail parameters
				params.append("BookCategoryId", BookCategoryId);
				params.append("BookName", BookName);
				params.append("BookDescription", BookDescription);
				params.append("BookVideoFileName", BookVideoFileName);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_book'); ?>",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						console.log("printing data");
						console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetBookTable();

							//clear the textbox
							clearAllTextBoxes();

						}else{

							var modal_output = (data == "<p>The file you are attempting to upload is larger than the permitted size.</p>") ? "The file should only be 1 GB and below." : data;

							//call the function for displaying the alert
							globalDisplayAlert(modal_output);

							//call the function for resetting the data 
							//table and display the updated data
							resetBookTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_disable_book is clicked
		$(document).on('click','.btn_disable_book', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_book'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookTable();
					}
				}
			});

		});

		//if button btn_enable_book is clicked
		$(document).on('click','.btn_enable_book', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_book'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookTable();
					}
				}
			});

		});

		//if button btn_edit_book is clicked
		$(document).on('click','.btn_edit_book', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");
			var description = $(this).data("description");

			//show the modal for editing
			UIkit.modal("#modal-edit-book").show();

			//set values to these html tags and attributes
			$("#txt_edit_book_name").val(name);
			$("#txt_edit_book_description").val(description);
			$("#btn_edit_book_submit").attr("data-id", id);

		});

		//if button btn_edit_book_submit is clicked
		$("#btn_edit_book_submit").click(function(){

			//declare variables
			var id = $(this).attr("data-id");
			var name = $("#txt_edit_book_name").val();
			var description = $("#txt_edit_book_description").val();

			//declare parameter
			var params = {};
			params.BookId = id;
			params.BookName = name;
			params.BookDescription = description;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_book'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookTable();
					}
				}
			});
		});

		//when the text btn_book_search is clicked
		$("#btn_book_search").click(function(){

			//get the current value
			var search_value = $("#txt_book_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayBook();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_book").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.BookName.toLowerCase().includes(search_value.toLowerCase()) || i.BookDescription.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_book", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_book_refresh").click(function(){

			$("#txt_book_search").val('');

			//display all the data for admin
			displayBook();

		});


		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayBook(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_book_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//call the function for displaying the grid for book
					displayBookTable(item, "book");
				}
			});
		}

		//create a function that will display the dropdown for book category
		function displayDropdownBookCategory(){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_book_category_data'); ?>",
				success: function(data){

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].BookCategoryId +'">'+ data[i].BookCategoryName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb_add_book_category").html(output);

				}
			});
			
		}

		//create a function that will reset the table and display the book 
		function resetBookTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_book tr').remove();

			//display the updated book  table
			displayBook();
		}

		//create a function that will display grid table for travel category
		function displayBookTable(data, type){

			//declare the grid
			$("#tbl_manage_book").jsGrid({

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
		                name: "BookName",
		                title: "Book Name",
		                type: "text",
		            },
		            {
		                name: "BookDescription",
		                title: "Book Description",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_book" data-id="'+item.BookId+'" data-name="'+item.BookName+'" data-description="'+item.BookDescription+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_book" data-id="'+item.BookId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_book" data-id="'+item.BookId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}








		//-----------------------------------------BOOK CATEGORY FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the data
		displayBookCategory();

		//if button btn_add_book_category_submit is clicked
		$("#btn_add_book_category_submit").click(function() {

			//declare the inputs
			var BookCategoryName = $("#txt_add_book_category_name").val();
			var BookCategoryPictureFileName = document.getElementById("txt_add_book_category_image").files[0];

			if(BookCategoryName == ""){
				$("#txt_add_book_category_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Book Category Name!");
			}else if($("#txt_add_book_category_image").val() == ""){
				$("#txt_add_book_category_image").addClass("uk-form-danger").attr("placeholder", "Please fill in Book Category Image!");
			}else{

				//declare parameter
				var params = new FormData();

				//user detail parameters
				params.append("BookCategoryName", BookCategoryName);
				params.append("BookCategoryPictureFileName", BookCategoryPictureFileName);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_book_category'); ?>",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetBookCategoryTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_disable_book_category is clicked
		$(document).on('click','.btn_disable_book_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_book_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookCategoryTable();
					}
				}
			});

		});

		//if button btn_enable_book_category is clicked
		$(document).on('click','.btn_enable_book_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_book_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookCategoryTable();
					}
				}
			});

		});

		//if button btn_edit_book_category is clicked
		$(document).on('click','.btn_edit_book_category', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");

			//show the modal for editing
			UIkit.modal("#modal-edit-book-category").show();

			//set values to these html tags and attributes
			$("#txt_edit_book_category_name").val(name);
			$("#btn_edit_book_category_submit").attr("data-id", id);

		});

		//if button btn_edit_book_category_submit is clicked
		$("#btn_edit_book_category_submit").click(function(){

			//declare variables
			var category_id = $(this).attr("data-id");
			var category_name = $("#txt_edit_book_category_name").val();

			//declare parameter
			var params = {};
			params.BookCategoryId = category_id;
			params.BookCategoryName = category_name;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_book_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetBookCategoryTable();
					}
				}
			});
		});

		//when the text btn_book_category_search is clicked
		$("#btn_book_category_search").click(function(){

			//get the current value
			var search_value = $("#txt_book_category_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayBookCategory();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_book_category").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.BookCategoryName.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_book_category", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_book_category_refresh").click(function(){

			$("#txt_book_category_search").val('');

			//display all the data for admin
			displayBookCategory();

		});


		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayBookCategory(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_book_category_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//call the function for displaying book category grid
					displayBookCategoryTable(item, "book_category");
				}
			});
		}

		//create a function that will reset the table and display the book category
		function resetBookCategoryTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_book_category tr').remove();

			//display the updated book category table
			displayBookCategory();
		}

		//create a function that will display grid table for travel category
		function displayBookCategoryTable(data, type){

			//declare the grid
			$("#tbl_manage_book_category").jsGrid({

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
		                name: "BookCategoryName",
		                title: "Book Category Name",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_book_category" data-id="'+item.BookCategoryId+'" data-name="'+item.BookCategoryName+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_book_category" data-id="'+item.BookCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_book_category" data-id="'+item.BookCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}















		//-----------------------------------------GAME CATEGORY FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function for displaying the data
		displayGameCategory();

		//if button btn_add_game_category_submit is clicked
		$("#btn_add_game_category_submit").click(function() {

			//declare the inputs
			var GameCategoryName = $("#txt_add_game_category_name").val();
			var GameCategoryPictureFileName = document.getElementById("txt_add_game_category_image").files[0];

			if(GameCategoryName == ""){
				$("#txt_add_game_category_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Game Category Name!");
			}else if($("#txt_add_game_category_image").val() == ""){
				$("#txt_add_game_category_image").addClass("uk-form-danger").attr("placeholder", "Please fill in Game Category Image!");
			}else{

				//declare parameter
				var params = new FormData();

				//user detail parameters
				params.append("GameCategoryName", GameCategoryName);
				params.append("GameCategoryPictureFileName", GameCategoryPictureFileName);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_game_category'); ?>",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetGameCategoryTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_disable_game_category is clicked
		$(document).on('click','.btn_disable_game_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_game_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameCategoryTable();
					}
				}
			});

		});

		//if button btn_enable_game_category is clicked
		$(document).on('click','.btn_enable_game_category', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_game_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameCategoryTable();
					}
				}
			});

		});

		//if button btn_edit_game_category is clicked
		$(document).on('click','.btn_edit_game_category', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");

			//show the modal for editing
			UIkit.modal("#modal-edit-game-category").show();

			//set values to these html tags and attributes
			$("#txt_edit_game_category_name").val(name);
			$("#btn_edit_game_category_submit").attr("data-id", id);

		});

		//if button btn_edit_game_category_submit is clicked
		$("#btn_edit_game_category_submit").click(function(){

			//declare variables
			var category_id = $(this).attr("data-id");
			var category_name = $("#txt_edit_game_category_name").val();

			//declare parameter
			var params = {};
			params.GameCategoryId = category_id;
			params.GameCategoryName = category_name;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_game_category'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameCategoryTable();
					}
				}
			});
		});

		//when the text btn_game_category_search is click
		$("#btn_game_category_search").click(function(){

			//get the current value
			var search_value = $("#txt_game_category_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayGameCategory();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_game_category").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.GameCategoryName.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_game_category", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_game_category_refresh").click(function(){

			$("#txt_game_category_search").val('');

			//display all the data for admin
			displayGameCategory();

		});


		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayGameCategory(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_game_category_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//call the function for displaying game category grid
					displayGameCategoryTable(item, "game_category");
				}
			});
		}

		//create a function that will reset the table and display the game category
		function resetGameCategoryTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_game_category tr').remove();

			//display the updated game category table
			displayGameCategory();
		}

		//create a function that will display grid table for game category
		function displayGameCategoryTable(data, type){

			//declare the grid
			$("#tbl_manage_game_category").jsGrid({

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
		                name: "GameCategoryName",
		                title: "Game Category Name",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_game_category" data-id="'+item.GameCategoryId+'" data-name="'+item.GameCategoryName+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_game_category" data-id="'+item.GameCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_game_category" data-id="'+item.GameCategoryId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}






		//-----------------------------------------GAME FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//
		
		//call the function that will display the drop for game category
		displayDropdownGameCategory();

		//call the function for displaying the data
		displayGame();

		//if button btn_add_game_submit is clicked
		$("#btn_add_game_submit").click(function() {

			//declare the inputs
			var GameCategoryId = $("#cmb_add_game_category option:selected").val();
			var GameName = $("#txt_add_game_name").val();
			var GameLink = $("#txt_add_game_link").val();
			var GamePictureFileName = document.getElementById("txt_add_game_image").files[0];

			if(GameName == ""){
				$("#txt_add_game_name").addClass("uk-form-danger").attr("placeholder", "Please fill in Game  Name!");
			}else if($("#txt_add_game_image").val() == ""){
				$("#txt_add_game_image").addClass("uk-form-danger").attr("placeholder", "Please fill in Game Image!");
			}else if(GameLink == ""){
				$("#txt_add_game_link").addClass("uk-form-danger").attr("placeholder", "Please fill in Game  Link!");
			}else{

				//declare parameter
				var params = new FormData();

				//user detail parameters
				params.append("GameCategoryId", GameCategoryId);
				params.append("GameName", GameName);
				params.append("GameLink", GameLink);
				params.append("GamePictureFileName", GamePictureFileName);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/create_new_game'); ?>",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						if(data == "Inserted"){

							//call the function for displaying the alert
							globalDisplayAlert("Successfully inserted!");

							//call the function for resetting the data 
							//table and display the updated data
							resetGameTable();

							//clear the textbox
							clearAllTextBoxes();
						}
					}
				});
			}

		});

		//if button btn_disable_game is clicked
		$(document).on('click','.btn_disable_game', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_game'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameTable();
					}
				}
			});

		});

		//if button btn_enable_game is clicked
		$(document).on('click','.btn_enable_game', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means deactivate

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_game'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameTable();
					}
				}
			});

		});

		//if button btn_edit_game is clicked
		$(document).on('click','.btn_edit_game', function(){

			//get the data of selected row
			var id = $(this).data("id");
			var name = $(this).data("name");
			var link = $(this).data("link");

			//show the modal for editing
			UIkit.modal("#modal-edit-game").show();

			//set values to these html tags and attributes
			$("#txt_edit_game_name").val(name);
			$("#txt_edit_game_link").val(link);
			$("#btn_edit_game_submit").attr("data-id", id);

		});

		//if button btn_edit_game_submit is clicked
		$("#btn_edit_game_submit").click(function(){

			//declare variables
			var id = $(this).attr("data-id");
			var name = $("#txt_edit_game_name").val();
			var link = $("#txt_edit_game_link").val();

			//declare parameter
			var params = {};
			params.GameId = id;
			params.GameName = name;
			params.GameLink = link;

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/update_game'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Updated"){
						globalDisplayAlert("Successfully Updated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetGameTable();
					}
				}
			});
		});

		//when the text btn_game_search is clicked
		$("#btn_game_search").click(function(){

			//get the current value
			var search_value = $("#txt_game_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayGame();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_game").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.GameName.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_game", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_game_refresh").click(function(){

			$("#txt_game_search").val('');

			//display all the data for admin
			displayGame();

		});


		//--------------------------FUNCTIONS-----------------------------//

		//populate the data
		function displayGame(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_game_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					//call the function for displaying the game
					displayGameTable(item, "game");
				}
			});
		}

		//create a function that will display the dropdown for game category
		function displayDropdownGameCategory(){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_game_category_data'); ?>",
				success: function(data){

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].GameCategoryId +'">'+ data[i].GameCategoryName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb_add_game_category").html(output);

				}
			});
			
		}

		//create a function that will reset the table and display the game 
		function resetGameTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_game tr').remove();

			//display the updated game  table
			displayGame();
		}

		//create a function that will display grid table for game
		function displayGameTable(data, type){

			//declare the grid
			$("#tbl_manage_game").jsGrid({

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
		                name: "GameName",
		                title: "Game Name",
		                type: "text",
		            },
		            {
		                name: "GameLink",
		                title: "Game Link",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_game" data-id="'+item.GameId+'" data-name="'+item.GameName+'" data-link="'+item.GameLink+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_game" data-id="'+item.GameId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_game" data-id="'+item.GameId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}








		//-----------------------------------------EXAM FUNCTIONALITY-----------------------------------//

		//--------------------------EVENTS-----------------------------//

		//call the function that will display the data for the exam
		displayExam();

		//call the function that will display the data for book category
		displayDropdownExamBookCategory();

		//when the dropdown for book category is changed
		$("#cmb_add_exam_book_category").change(function(){

			//get the id for the book category
			var book_category_id = $(this).val();

			//call the function that will display the data for book
			displayDropdownExamBooks(book_category_id);

		});

		//when submit button for exam questionaire is clicked
		$("#btn_add_exam_submit").click(function(){

			//get the value from the selected excel file
			var excelfileexam = document.getElementById("txt_add_exam_file").files[0];
			var book_id = $("#cmb_add_exam_book").val();

			//check if there is no selected file
			if($("#cmb_add_exam_book_category").val() == "0"){
				$("#cmb_add_exam_book_category").addClass("uk-form-danger").attr("placeholder", "Please select book category!");
			}else if($("#cmb_add_exam_book").val() == "0"){
				$("#cmb_add_exam_book").addClass("uk-form-danger").attr("placeholder", "Please select a book!");
			}else if($("#txt_add_exam_file").val() == ""){
				$("#txt_add_exam_file").addClass("uk-form-danger").attr("placeholder", "Please select an excel file!");
			} else {

				//create a parameter for our form data
				var params = new FormData();

				//let us set the parameters that will be passed in our ajax call
				params.append("bookid", book_id);
				params.append("excelfileexam", excelfileexam);

				// console.log("printing book_id");
				// console.log(book_id);

				$.ajax({
					url: "<?php echo base_url(); ?>cn/upload_exam_file",
					method: "POST",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						//call the function for displaying the alert
						globalDisplayAlert(data);

						//call the function for resetting the data 
						//table and display the updated data
						resetExamTable();

						//clear the textbox
						clearAllTextBoxes();
					}
				});
			}

		});

		//if button btn_edit_exam is clicked
		$(document).on('click','.btn_edit_exam', function(){

			//get the data of selected row
			var id = $(this).attr("data-id");
			var question = $(this).attr("data-question");
			var option1 = $(this).attr("data-opt");
			var option2 = $(this).attr("data-opt2");
			var option3 = $(this).attr("data-opt3");
			var option4 = $(this).attr("data-opt4");
			var correctanswer = $(this).attr("data-corranswer");

			//show the modal for editing
			UIkit.modal("#modal-edit-exam").show();

			//set values to these html tags and attributes
			$("#txt_edit_question").val(question);
			$("#txt_edit_option1").val(option1);
			$("#txt_edit_option2").val(option2);
			$("#txt_edit_option3").val(option3);
			$("#txt_edit_option4").val(option4);
			$("#txt_edit_correct_option").val(correctanswer);
			$("#btn_edit_exam_submit").attr("data-id", id);

		});

		//hide first the exam file
		$(".txt_edit_exam_file").hide();

		//when the exam type option is changed
		$("#cmb_edit_exam_type").change(function(){

			//get the current option of the user
			var currentOption = $(this).val();

			//if the user selected visual/audio exam
			if(currentOption == 2){

				//then show the editing for exam file
				$(".txt_edit_exam_file").show();
			}else{

				//then hide the editing for exam file
				$(".txt_edit_exam_file").hide();
			}


		});

		//if button btn_edit_game_submit is clicked
		$("#btn_edit_exam_submit").click(function(){

			if($("#txt_edit_question").val() == ""){
				$("#txt_edit_question").addClass("uk-form-danger").attr("placeholder", "Please input a question!");
			}else if($("#txt_edit_option1").val() == ""){
				$("#txt_edit_option1").addClass("uk-form-danger").attr("placeholder", "Please input a first option!");
			}else if($("#txt_edit_option2").val() == ""){
				$("#txt_edit_option2").addClass("uk-form-danger").attr("placeholder", "Please input a second option!");
			}else if($("#txt_edit_option3").val() == ""){
				$("#txt_edit_option3").addClass("uk-form-danger").attr("placeholder", "Please input a third option!");
			}else if($("#txt_edit_option4").val() == ""){
				$("#txt_edit_option4").addClass("uk-form-danger").attr("placeholder", "Please input a fourth option!");
			}else if($("#txt_edit_correct_option").val() == ""){
				$("#txt_edit_correct_option").addClass("uk-form-danger").attr("placeholder", "Please input a correct option!");
			}else if($("#cmb_edit_exam_type").val() == "2"){
				if($("#txt_edit_exam_file").val() == ""){
					$("#txt_edit_exam_file").addClass("uk-form-danger").attr("placeholder", "Please select an excel file!");
				}else{

					//declare variables
					var id = $(this).attr("data-id");
					var question = $("#txt_edit_question").val();
					var option1 = $("#txt_edit_option1").val();
					var option2 = $("#txt_edit_option2").val();
					var option3 = $("#txt_edit_option3").val();
					var option4 = $("#txt_edit_option4").val();
					var correctanswer = $("#txt_edit_correct_option").val();
					var excelfileforexam = ($("#txt_edit_exam_file").val() == "") ? "" : document.getElementById("txt_edit_exam_file").files[0];

					//create a parameter for our form data
					var params = new FormData();

					//let us set the parameters that will be passed in our ajax call
					params.append("id", id);
					params.append("Question", question);
					params.append("Option1", option1);
					params.append("Option2", option2);
					params.append("Option3", option3);
					params.append("Option4", option4);
					params.append("CorrectAnswer", correctanswer);
					params.append("excelfileforexam", excelfileforexam);
					params.append("IsDeleted", 0);

					// console.log("printing params");
					// console.log(params);

					$.ajax({
						url: "<?php echo base_url(); ?>cn/update_exam_file",
						method: "POST",
						data: params,
						contentType: false,
						cache: false,
						processData: false,
						success: function(data){

							// console.log("printing data");
							// console.log(data);

							//call the function for displaying the alert
							globalDisplayAlert(data);

							//call the function for resetting the data 
							//table and display the updated data
							resetExamTable();
						}
					});

				}
			}else{

				//declare variables
				var id = $(this).attr("data-id");
				var question = $("#txt_edit_question").val();
				var option1 = $("#txt_edit_option1").val();
				var option2 = $("#txt_edit_option2").val();
				var option3 = $("#txt_edit_option3").val();
				var option4 = $("#txt_edit_option4").val();
				var correctanswer = $("#txt_edit_correct_option").val();
				var excelfileforexam = ($("#txt_edit_exam_file").val() == "") ? "" : document.getElementById("txt_edit_exam_file").files[0];

				//create a parameter for our form data
				var params = new FormData();

				//let us set the parameters that will be passed in our ajax call
				params.append("id", id);
				params.append("Question", question);
				params.append("Option1", option1);
				params.append("Option2", option2);
				params.append("Option3", option3);
				params.append("Option4", option4);
				params.append("CorrectAnswer", correctanswer);
				params.append("excelfileforexam", excelfileforexam);
				params.append("IsDeleted", 0);

				// console.log("printing params");
				// console.log(params);

				$.ajax({
					url: "<?php echo base_url(); ?>cn/update_exam_file",
					method: "POST",
					data: params,
					contentType: false,
					cache: false,
					processData: false,
					success: function(data){

						// console.log("printing data");
						// console.log(data);

						//call the function for displaying the alert
						globalDisplayAlert(data);

						//call the function for resetting the data 
						//table and display the updated data
						resetExamTable();
					}
				});
			}

		});

		//if button btn_disable_game is clicked
		$(document).on('click','.btn_disable_exam', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 1; //means disable

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_exam'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Deactivated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetExamTable();
					}
				}
			});

		});

		//if button btn_disable_game is clicked
		$(document).on('click','.btn_enable_exam', function(){

			//get the data of selected row
			var id = $(this).data("id");

			//declare parameter
			var params = {};
			params.id = id;
			params.IsDeleted = 0; //means enable

			// console.log("printing params");
			// console.log(params);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/activate_deactivate_exam'); ?>",
				data: params,
				success: function(data){

					// console.log("printing data");
					// console.log(data);

					if(data == "Deactivated"){
						globalDisplayAlert("Successfully Activated!");

						//call the function for resetting the data 
						//table and display the updated data
						resetExamTable();
					}
				}
			});

		});

		//when the text btn_game_search is clicked
		$("#btn_exam_search").click(function(){

			//get the current value
			var search_value = $("#txt_exam_search").val();

			//if there is no value for search
			if(search_value == ""){

				//call the function for displaying specified table
				displayExam();

			}else{
				
				//get the current data from the grid
				var grid_data = $("#tbl_manage_exam").jsGrid("option", "data");

				//then filter the data
				var filtered_data = _.filter(grid_data, function(i){
					return i.Question.toLowerCase().includes(search_value.toLowerCase()) || i.BookName.toLowerCase().includes(search_value.toLowerCase());
				});

				//call the function for filtering the grid
				resetGridAndFilterData("tbl_manage_exam", filtered_data);
			}

		});

		//when button refresh is clicked
		$("#btn_exam_refresh").click(function(){

			$("#txt_exam_search").val('');

			//display all the data for admin
			displayExam();

		});



		//--------------------------FUNCTIONS-----------------------------//


		//create a function that will display the dropdown for book category
		function displayDropdownExamBookCategory(){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_book_category_data'); ?>",
				success: function(data){

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '<option value="0"> ------------------------ Choose a Book Category ------------------------ </option>';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].BookCategoryId +'">'+ data[i].BookCategoryName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb_add_exam_book_category").html(output);

				}
			});
			
		}


		//create a function that will display the dropdown for book
		function displayDropdownExamBooks(id){

			//call the controller function using ajax call
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/display_admin_book_data_by_category_id'); ?>/" + id,
				success: function(data){

					console.log("printing data");
					console.log(data);

					//parse the data into JSON format
					data = JSON.parse(data);

					//declare a variable to be displayed
					var output = '<option value="0"> ------------------------ Choose a Book ------------------------ </option>';

					//loop the data and assign it to data table
					for(var i = 0 ; i < data.length; i++){

						//set the output to be displayed
						output += '<option value="'+ data[i].BookId +'">'+ data[i].BookName +'</option>';

					}

					//display the data into our dropdown
					$("#cmb_add_exam_book").html(output);

				}
			});
			
		}

		//populate the data
		function displayExam(){

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_exam_data'); ?>",
				data: {},
				success: function(item){

					//parse the data into JSON format
					item = JSON.parse(item);

					// console.log("printing item");
					// console.log(item);

					//call the function for displaying the exam grid
					displayExamTable(item, "exam");
				}
			});
		}

		//create a function that will reset the table and display the exam
		function resetExamTable(){

			//clear the table first before displaying the updated table
			$('#tbl_manage_exam tr').remove();

			//display the updated exam table
			displayExam();
		}

		//create a function that will display grid table for travel category
		function displayExamTable(data, type){

			//declare the grid
			$("#tbl_manage_exam").jsGrid({

				//set width and height of the grid
		        width: "100%",
		        height: "auto",

		        //set the sorting configurations
		        sorting: true,
		        paging: true,

		        pageSize: 6,

		        //set the data
		        data: data,

		        //set the fields of the table
		        fields: [
		            {
		                name: "BookName",
		                title: "Book Name",
		                type: "text",
		            },
		            {
		                name: "Question",
		                title: "Question",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//check if the exam file name is not null
		                	if(item.ExamFileName != ""){

		                		//set value to output
		                		output = "(W/ Audio Exam)";

		                	}else{ // if it doesnt have an audio exam

		                		//set value to output
		                		output = value;
		                		
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "Option1",
		                title: "First Option",
		                type: "text",
		            },
		            {
		                name: "Option2",
		                title: "Second Option",
		                type: "text",
		            },
		            {
		                name: "Option3",
		                title: "Third Option",
		                type: "text",
		            },
		            {
		                name: "Option4",
		                title: "Fourth Option",
		                type: "text",
		            },
		            {
		                name: "CorrectAnswer",
		                title: "Correct Answer",
		                type: "text",
		            },
		            {
		                name: "IsDeleted",
		                title: "Status",
		                type: "text",
		                itemTemplate: function(value, item){

		                	var output = "";

		                	//if the value is 0 - means enabled
		                	if(value == 0){

		                		output = "Enabled";

		                	}else{ //if the value is 1 - means disabled

		                		output = "Disabled";
		                	}

		                	return output;

		                }
		            },
		            {
		                name: "IsDeleted",
		                title: "Action",
		                itemTemplate: function (value, item) {

							var output = '<button uk-tooltip="Edit" class="uk-icon uk-margin-small-right btn_edit_exam" data-id="'+item.ExamId+'" data-question="'+ item.Question +'" data-opt="'+item.Option1+'" data-opt2="'+item.Option2+'" data-opt3="'+item.Option3+'" data-opt4="'+item.Option4+'" data-corrAnswer="'+item.CorrectAnswer+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: pencil"></span></button>';

		                    //if the value is 0 - means enabled
		                    if(value == 0){

		                    	output += '<button uk-tooltip="Disable" class="uk-icon uk-margin-small-right btn_disable_exam" data-id="'+item.ExamId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: ban"></span></button>';

		                    }else{ //if the value is 1 - means disabled

		                    	output += '<button uk-tooltip="Enable" class="uk-icon uk-margin-small-right btn_enable_exam" data-id="'+item.ExamId+'"><span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span></button>';
		                    }

		                    
		                    //return the output
		                    return output;

		                }
		            },
		        ],
		    });
		}









		//--------------------GLOBAL FUNCTION-----------------
		//create a function that will clear all the texboxes after submit button is clicked
		function clearAllTextBoxes(){

			//clear all the textbox after submit button is executed 
			//admin side
			$("#txt_add_admin_fname").val('');
			$("#txt_add_admin_minitial").val('-');
			$("#txt_add_admin_lname").val('');
			$("#txt_add_admin_username").val('');
			$("#txt_add_admin_password").val('');
			$("#txt_add_admin_confirm_password").val('');

			//remove all validations
			$("#txt_add_admin_fname").removeClass("uk-form-danger");
			$("#txt_add_admin_minitial").removeClass("uk-form-danger");
			$("#txt_add_admin_lname").removeClass("uk-form-danger");
			$("#txt_add_admin_username").removeClass("uk-form-danger");
			$("#txt_add_admin_password").removeClass("uk-form-danger");
			$("#txt_add_admin_confirm_password").removeClass("uk-form-danger");

			//teacher side
			$("#txt_add_teacher_fname").val('');
			$("#txt_add_teacher_minitial").val('-');
			$("#txt_add_teacher_lname").val('');
			$("#txt_add_teacher_username").val('');
			$("#txt_add_teacher_password").val('');
			$("#txt_add_teacher_confirm_password").val('');

			//remove all validations
			$("#txt_add_teacher_fname").removeClass("uk-form-danger");
			$("#txt_add_teacher_minitial").removeClass("uk-form-danger");
			$("#txt_add_teacher_lname").removeClass("uk-form-danger");
			$("#txt_add_teacher_username").removeClass("uk-form-danger");
			$("#txt_add_teacher_password").removeClass("uk-form-danger");
			$("#txt_add_teacher_confirm_password").removeClass("uk-form-danger");

			//travel category side
			$("#txt_add_travel_category_name").val('');

			//remove all validations
			$("#txt_add_travel_category_name").removeClass("uk-form-danger");

			//travel side
			$("#txt_add_travel_name").val('');
			$("#txt_add_travel_description").val('');
			
			//remove all validations
			$("#txt_add_travel_name").removeClass("uk-form-danger");
			$("#txt_add_travel_description").removeClass("uk-form-danger");

			//book category side
			$("#txt_add_book_category_name").val('');
			
			//remove all validations
			$("#txt_add_book_category_name").removeClass("uk-form-danger");

			//book side
			$("#txt_add_book_name").val('');
			$("#txt_add_book_description").val('');
			
			//remove all validations
			$("#txt_add_book_name").removeClass("uk-form-danger");
			$("#txt_add_book_description").removeClass("uk-form-danger");

			//game category side
			$("#txt_add_game_category_name").val('');
			
			//remove all validations
			$("#txt_add_game_category_name").removeClass("uk-form-danger");

			//game side
			$("#txt_add_game_name").val('');
			$("#txt_add_game_link").val('');
			
			//remove all validations
			$("#txt_add_game_name").removeClass("uk-form-danger");
			$("#txt_add_game_link").removeClass("uk-form-danger");
		}


	});
</script>