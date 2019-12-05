<!-- include header -->
<?php $this->load->view("inc/header"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-login"); ?>

	<div class="container">

		<div>
	        <div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/login/login_bg.jpg);">

	        	<!-- first main division of card -->
				<div class="">
					<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>

						<div class="margin_all_10px">
					        <div class="uk-card uk-card-muted uk-card-body main_card_height_650px">
					        	<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
			        				<!-- card content -->
						        	<div class="margin_all_10px">
								        <div class="uk-card uk-card-muted uk-card-body main_card_height_550px uk-animation-toggle" tabindex="0" style="padding-top: 120px;">
							        		<br>
								        	<h3 class="font_black">User Authentication</h3>

							        		<div class="uk-margin">
									        	<div class="uk-inline">
										            <span class="uk-form-icon" uk-icon="icon: user"></span>
										            <input class="uk-input uk-form-large input_width_600px" id="uname" placeholder="Username" type="text">
										        </div>
										    </div>

										    <div class="uk-margin">
										        <div class="uk-inline">
										            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
										            <input class="uk-input uk-form-large input_width_600px" id="pword" placeholder="Password" type="password">
										        </div>
										    </div>
							        		
										    
										    <button id="btnLogin" class="uk-button uk-button-primary uk-button-large input_width_600px">
									    		<span uk-icon="sign-in"></span>&nbsp;&nbsp;Submit
									    	</button>

								        </div>
								    </div>
					        	</div>
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

	<!-- modal for alerts -->
	<div id="modal-spinner" class="uk-flex-top" uk-modal>
	    <div class="uk-modal-dialog uk-modal-body uk-width-1-6 uk-margin-auto-vertical uk-text-center">

	    	<span class="uk-margin-small-right" uk-spinner="ratio: 3"></span>
	    	<h4>Please wait</h4>

	    </div>
	</div>


<!-- include footer -->
<?php $this->load->view("inc/footer"); ?>

<script type="text/javascript">

	$(document).ready(function(){

		//clear all the localstorage
		localStorage.clear();
		
		//if the login button is clicked
		$("#btnLogin").click(function(){

			//declare variable
			var username = $("#uname").val();
			var password = $("#pword").val();

			//perform validations
			if(username == ""){
				$("#uname").addClass("uk-form-danger").attr("placeholder", "Please fill in Username!");
			} else if(password == ""){
				$("#pword").addClass("uk-form-danger").attr("placeholder", "Please fill in Password!");
			} else{

				//declare parameter
				var params = {};

				//set parameters
				params.username = username;
				params.password = password;

				// console.log("printing params");
				// console.log(params);

				//call the function for controller using ajax call
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('cn/login_authentication'); ?>",
					data: params,
					success: function(result){

						// console.log("printing result");
						// console.log(result);

						//if the user is an administrator
						if(result == "Admin"){

							//display alert message
							globalDisplayAlert("Successfully Login!");

							setTimeout(function(){
							//then redirect to admin page
							window.location = '<?php base_url();?>cn/admin';
							}, 1000);


						} else if(result == "Teacher"){

							//display alert message
							globalDisplayAlert("Successfully Login!");

							setTimeout(function(){
								//then redirect to teacher page
								window.location = '<?php base_url();?>cn/teacher';
							}, 1000);

						} else if(result == "Student"){

							//display alert message
							globalDisplayAlert("Successfully Login!");

							setTimeout(function(){
								//then redirect to student page
								window.location = '<?php base_url();?>cn/student';
							}, 1000);

						} else{

							//display error message
							globalDisplayAlert(result);

							setTimeout(function(){
								//refresh the page
								location.reload();
							}, 1000);
						}
					}
				});
			}

			


		});

	});
	
</script>