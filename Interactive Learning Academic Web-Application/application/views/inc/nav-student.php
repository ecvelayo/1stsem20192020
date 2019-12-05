
	<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky;">
	    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
	        <div class="uk-navbar-left">
	            <ul class="uk-navbar-nav">
	                <li class="uk-active">
	                	<a href="<?php echo base_url() ?>cn/student">
			            	<span class="uk-icon uk-margin-small-right">
			            		<img src="<?php echo base_url(); ?>assets/image/logo.png" style="width: 50px">
			            	</span>
			            	Ilaw
	                	</a>
	                </li>
	            </ul>
	        </div>

	        
	        <?php 

				//get the value for testing purpose
				$testing = $this->session->userdata("usertesting");

				//if the testing is true then display this button
				if($testing == true){
					echo '<div class="uk-navbar-right">
				        	<ul class="uk-navbar-nav">
				        		<li>
					        		<a href="'.base_url().'cn/reset_preview">
				                		<span class="uk-icon uk-margin-small-right" uk-icon="icon: refresh"></span>Go back to Admin
					        		</a>
				        		</li>
				        	</ul>
				        </div>';
				}


	         ?>

	        <div class="uk-navbar-right">
	            <ul class="uk-navbar-nav">
	                <li>
	                    <a href="#">
	                		<span class="uk-icon uk-margin-small-right" uk-icon="icon: list"></span>Categories
	                    </a>
	                    <div class="uk-navbar-dropdown">
	                        <ul class="uk-nav uk-navbar-dropdown-nav">
	                            <li><a href="<?php base_url(); ?>travel">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: world"></span>Travel
	                        		</a>
	                        	</li>
	                            <li>
	                            	<a href="<?php base_url(); ?>book">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: file-text"></span>Books
	                            	</a>
	                            </li>
	                            <li>
	                            	<a href="<?php base_url(); ?>game">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: happy"></span>Games
	                            	</a>
	                            </li>
	                        </ul>
	                    </div>
	                </li>
	                <li>
	                    <a href="#">
	                		<span class="uk-icon uk-margin-small-right" uk-icon="icon: cog"></span>Settings
	                    </a>
	                    <div class="uk-navbar-dropdown">
	                        <ul class="uk-nav uk-navbar-dropdown-nav">
	                            <li>
	                            	<a href="#" id="btn_view_record">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>View Profile
	                            	</a>
	                            </li>
	                            <hr>
	                            <li>
	                            	<a href="<?php base_url(); ?>logout">
			                			<span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-out"></span>Logout
	                            	</a>
	                            </li>
	                        </ul>
	                    </div>
	                </li>
	            </ul>
	        </div>
	    </nav>
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
					        </div>
					        <div>
					        	<h4 id="lbl-student-id">(Student ID)</h4>
					        	<h4 id="lbl-lastname">(Last Name)</h4>
					        	<h4 id="lbl-firstname">(First Name)</h4>
					        	<h4 id="lbl-mi">(Middle Initial)</h4>
					        	<h4 id="lbl-gender">(Gender)</h4>
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