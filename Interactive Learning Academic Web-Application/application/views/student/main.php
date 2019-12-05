<!-- include header -->
<?php $this->load->view("inc/header-student-main"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-student"); ?>


	<div class="container">
		
		<!-- first main division of card -->
		<div class="">
			<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/i.jpg);">
			<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
				<div class="margin_all_10px">
			        <div class="uk-card uk-card-mute uk-card-body main_card_height_630px" style="background-image: url(<?php echo base_url(); ?>assets/image/conf.gif);">
			        	<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="autoplay: true; animation: push; min-height: 250; max-height: 550  ">
						    <ul class="uk-slideshow-items">
						        <li>
						            <img data-src="<?php echo base_url(); ?>assets/image/carouseL/2.jpg" width="630" height="275" alt="" uk-cover uk-img="target: !ul > :last-child, !* +*">
						        </li>
						        <li>
						            <img data-src="<?php echo base_url(); ?>assets/image/carouseL/carousel_2.jpg" width="630" height="300" alt="" uk-cover uk-img="target: !* -*, !* +*">
						        </li>
						        <li>
						            <img data-src="<?php echo base_url(); ?>assets/image/carouseL/carousel_3.jpg" width="630" height="300" alt="" uk-cover uk-img="target: !* -*, !ul > :first-child">
						        </li>
						    </ul>

						    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
						    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
						</div>
			        </div>
			    </div>
			</div>
			</div>
		</div>

		<!-- second main division of card -->
		<div class="">
<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/bla.jpg);">
			<div class="uk-grid-collapse uk-child-width-expand@s uk-text-center" uk-grid>
				<div class="margin_all_10px">
			        <div class="uk-card-body card_height_450px" style="background-image: url(<?php echo base_url(); ?>assets/image/i.jpg);">
			        	<div class="uk-animation-toggle" tabindex="0">
			        		<a href="<?php echo base_url('cn/travel'); ?>">
						        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
						            <img src="<?php echo base_url(); ?>assets/image/main/zzz.gif" alt="">
						            <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
						                <p class="uk-h4 uk-margin-remove">Travel</p>
						            </div>
						        </div>
			        		</a>
					    </div>
			        </div>
			    </div>
				<div class="margin_all_10px">
			        <div class="uk-card uk-card-mute uk-card-body card_height_450px" style="background-image: url(<?php echo base_url(); ?>assets/image/i.jpg);">
			        	<div class="uk-animation-toggle" tabindex="0">
			        		<a href="<?php echo base_url('cn/book'); ?>">
						        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
						            <img src="<?php echo base_url(); ?>assets/image/main/123.gif" alt="">
						            <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
						                <p class="uk-h4 uk-margin-remove">Books</p>
						            </div>
						        </div>
			        		</a>
					    </div>
			        </div>
			    </div>
				<div class="margin_all_10px">
			        <div class="uk-card uk-card-mute uk-card-body card_height_450px" style="background-image: url(<?php echo base_url(); ?>assets/image/i.jpg);">
			        	<div class="uk-animation-toggle" tabindex="0">
			        		<a href="<?php echo base_url('cn/game'); ?>">
						        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
						            <img src="<?php echo base_url(); ?>assets/image/main/200.gif" alt="">
						            <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
						                <p class="uk-h4 uk-margin-remove">Games</p>
						            </div>
						        </div>
			        		</a>
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
	
	$(document).ready(function(){

		//---------------------------------------------------EVENTS--------------------------------------------//

		//display spinner modal
		globalDisplaySpinnerModal(1000);

		//call the function for setting a userid
		globalSetUserId();

		//let us set a timout to run first the setting of user id before setting teacher id
		setTimeout(function(){

			//call the function for setting a teacherid
			globalGetTeacherId();

			//call the function for setting a gradelevel
			globalGetGradeLevel();

		}, 500);

		//when the button btn_view_record is clicked
		$(document).on('click', '#btn_view_record', function(){

			//get the current id of the student
			var studentId = localStorage["uid"];

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

					//check first if there is a record for the student
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
						$("#tbl_student_record").html(output);
					}else{

						UIkit.modal.alert("Sorry, you don't have records yet. Please take an exam to have a record!");

					}

				}
			});


		});


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


		//function for getting the current id of the user
		function globalGetTeacherId(){

			//create a parameter
			var params = {};

			//set parameter
			params.UserId = localStorage["uid"];

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/globalGetTeacherId'); ?>",
				data: params,
				success: function(item){

					// console.log("printing item");
					// console.log(item);

					//set default teacher id if the student is not yet enrolled
					if(item.length > 4){
						item = 99999;
					}

					//then let us set locally the userid
					localStorage.setItem("tid", item);
				}
			});
		}

		//function for getting the current id of the user
		function globalGetGradeLevel(){

			//create a parameter
			var params = {};

			//set parameter
			params.UserId = localStorage["uid"];

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('cn/globalGetGradeLevel'); ?>",
				data: params,
				success: function(item){

					// console.log("printing item");
					// console.log(item);

					//then let us set locally the userid
					localStorage.setItem("glevel", item);
				}
			});
		}

	});

</script>