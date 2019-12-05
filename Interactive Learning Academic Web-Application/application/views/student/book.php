<!-- include header -->
<?php $this->load->view("inc/header-student-book"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-student"); ?>


	<div class="container">
		<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
			<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/7.png);">
			<div class="margin_all_10px">
				<div class="uk-card uk-card-mute uk-card-body main_card_height_550px">
					<!-- <IMG STYLE="position:absolute; TOP:25px; LEFT:710px; WIDTH:50px;   -->
<!-- HEIGHT:50px" SRC="<?php echo base_url(); ?>assets/image/nTv.gif">  -->
<!-- <IMG STYLE="position:absolute; TOP:100px; LEFT:560px; WIDTH:50px;   -->
<!-- HEIGHT:50px" SRC="<?php echo base_url(); ?>assets/image/tin1.gif">  -->
<!-- <IMG STYLE="position:absolute; TOP:100px; LEFT:880px; WIDTH:50px;   -->
<!-- HEIGHT:50px" SRC="<?php echo base_url(); ?>assets/image/tin2.gif">  -->




					<h3 style="font-size:400%";>BOOKS</h3>
					<div class="uk-child-width-expand@s uk-text-center uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s" uk-grid id="div_display_book_data">
						<!-- will display the data here with the use of ajax calls -->
					</div>
				</div>
				
				<div class="uk-card uk-card-mute uk-card-body main_card_height_555px" >
					<h3 class="font_black" style="font-size:400%">Other Categories</h3>
					<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
						<div class="margin_all_10px">
							<div class="uk-card uk-card-mute uk-card-body card_height_400px" style="background-image: url(<?php echo base_url(); ?>assets/image/tt.jpg);">
					        	<div class="uk-animation-toggle" tabindex="0">
					        		<a href="<?php echo base_url('cn/game'); ?>">
								        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
								            <img src="<?php echo base_url(); ?>assets/image/main/main_game.jpg" alt="">
								            <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
								                <p class="uk-h4 uk-margin-remove">Games</p>
								            </div>
								        </div>
					        		</a>
							    </div>
					        </div>
					    </div>
						<div class="margin_all_10px">
					        <div class="uk-card uk-card-default uk-card-body card_height_400px" style="background-image: url(<?php echo base_url(); ?>assets/image/tt.jpg);">
					        	<div class="uk-animation-toggle" tabindex="0">
					        		<a href="<?php echo base_url('cn/travel'); ?>">
								        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
								            <img src="<?php echo base_url(); ?>assets/image/main/main_travel.jpg" alt="">
								            <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
								                <p class="uk-h4 uk-margin-remove">Travel</p>
								            </div>
								        </div>
					        		</a>
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

		//call the function to display the travel data
		displayBookData();

		//when the book category is clicked
		$(document).on('click', '.btnDisplayBook', function(){

			//get the category id of the selected category book
			var categoryId = $(this).data("id");

			//do the ajax call to get the data for book within its category id
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_book_data_by_category_id_for_books/'); ?>" + categoryId,
				data: {},
				success: function(data){

					//parse the data into json format
					data = JSON.parse(data);

					// console.log("printing data");
					// console.log(data);

					//check if greater than 0 books which means it has a data
					if(data.length > 0){

						//first we need to clear our localstorage
						localStorage.removeItem("books");

						//then we need to create our localstorage
						localStorage.setItem("books", JSON.stringify(data));

						//display spinner modal
						globalDisplaySpinnerModal(5000);

						setTimeout(function(){

							window.location = '<?php echo base_url() ?>cn/books';

						}, 1500);

					}else{
						//call the function to display a notifications
						globalDisplayAlert("Sorry, there is no books in this category. Please select another Category.");
					}
				}
			});


		});

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

		//---------------------------------------------------FUNCTIONS--------------------------------------------//

		//create a function that will dislay all the data for travel
		function displayBookData(){
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_book_category_data'); ?>",
				data: {},
				success: function(data){

					//parse the data into json format
					data = JSON.parse(data);

					//remove books where IsDeleted is 1
					data = _.where(data, { IsDeleted : "0" });

					// console.log("printing data");
					// console.log(data);

					//create a clean variable to store our html output 
					var output = "";

					//let us loop the data
					for(var i = 0; i < data.length; i++){

						output +='<div uk-tooltip="'+ data[i].BookCategoryName +'" class="uk-animation-toggle" tabindex="0">' +
								'		<div class="uk-animation-slide-left-small">' +
								'     		<a class="btnDisplayBook" data-id="'+ data[i].BookCategoryId +'">' +
								'		        <div class="border_radius_15px uk-background-cover-with-radius uk-height-medium uk-width-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(<?php echo base_url() ?>'+ data[i].BookCategoryPictureFileName +');">' +
								'		        </div>' +
								'      		</a>' +
								'  		</div>' +
								' </div>';

					}

					//update the html output into division 
					$("#div_display_book_data").html(output);
				}
			});
		}

	});

</script>