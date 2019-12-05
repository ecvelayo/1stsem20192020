<!-- include header -->
<?php $this->load->view("inc/header-student-book"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-student"); ?>


	<div class="container">

		<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
			<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/aa.jpg);">
			<div class="margin_all_10px">
				<div class="uk-card uk-card-mute uk-card-body main_card_height_auto">
					<h3>Books</h3>
					<div class="uk-child-width-expand@s uk-text-center" uk-grid>
						<div class="uk-child-width-1-1@s uk-grid-small uk-grid-match" uk-grid id="div_display_book_data" >

							<!-- will display the data here with the use of ajax calls -->
							
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

	<!-- modal for questionaire confirmation -->
	<div id="modal-questionaire-confirm" class="uk-flex-top" uk-modal>
	    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

	        <button class="uk-modal-close-default" type="button" uk-close></button>

	        <h3 class="uk-text-center">The End</h3><br>

	        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
		        <div>
		        	<button class="uk-button uk-button-primary" type="button" id="btnTakeExam">Take Exam?</button>
		        </div>
		        <div>
		        	or
		        </div>
		        <div>
		        	<button class="uk-button uk-button-primary uk-modal-close" type="button">Read books</button>
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

		//call the function to display the travel data
		displayBookData();

		//call the global function for setting the video into full screen mode when clicked
		globalFullScreenMode("booksVideo");

		//when the user clicked the video
		$(document).on('click', '.booksVideo', function(){

			//get the id of the book
			var id = $(this).attr("data-id");

			//set a book id to the button attribute
        	$("#btnTakeExam").attr("data-id", id);

		});

		//if the button for take exam is clicked
		$("#btnTakeExam").click(function(){

			//get the id of the book
			var bookId = $(this).attr("data-id");

			//do the ajax call to get the data for book within its category id
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('cn/display_exam_data_by_book_id/'); ?>" + bookId,
				data: {},
				success: function(data){

					//parse the data into json format
					data = JSON.parse(data);

					// console.log("printing data");
					// console.log(data);

					//check if greater than 0 books which means it has a data
					if(data.length > 0){

						//first we need to clear our localstorage
						localStorage.removeItem("exams");

						//then we need to create our localstorage
						localStorage.setItem("exams", JSON.stringify(data));

						//display spinner modal
						globalDisplaySpinnerModal(5000);

						setTimeout(function(){

							window.location = '<?php echo base_url() ?>cn/exam';

						}, 1500);

					}else{
						//call the function to display a notifications
						globalDisplayAlert("Sorry, there is no exam in this books. Please try again later.");
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

			//get the current data in our local storage and parse it into json
			var bookItem = JSON.parse(localStorage["books"]);

			//create a clean variable to store our html output 
			var output = "";

			//let us loop the bookItem
			for(var i = 0 ; i < bookItem.length; i++){

				// console.log("printing data");
				// console.log(bookItem[i]);

				//get the totalviews
				var totalViews = (bookItem[i].TotalViews == null) ? 0 : bookItem[i].TotalViews;

				output += '<div class="margin_all_10px">' +
						'		<div class="uk-card uk-card-mute uk-card-body main_card_height_auto">' +
						'			<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid id="div_display_book_data">' +
						'		        <div class="uk-card uk-card-default uk-card-body">' +
						'		            <video src="<?php echo base_url() ?>'+ bookItem[i].BookVideoFileName +'" controls playsinline class="booksVideo" data-id="'+ bookItem[i].BookId +'"></video>' +
						'		        </div>' +
						'		        <div class="uk-card uk-card-primary uk-card-body">' +
						'		            <h3 class="uk-card-title font_black uk-button uk-button-text">'+ bookItem[i].BookName +'</h3>' +
						'		            <br><br><br>' +
						'		            <p class="font_black">'+ bookItem[i].BookDescription +'</p>' +
						'		            <br><br>' +
						'		            <p class="font_black" style="margin-right: 80%;">Total Views: '+ totalViews +'</p>' +
						'		        </div>' +
						'			</div>' +
						'		</div>' +
						'</div>';
			}

			//update the html output into division 
			$("#div_display_book_data").html(output);

		}

	});

</script>