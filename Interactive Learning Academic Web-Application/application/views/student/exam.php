<!-- include header -->
<?php $this->load->view("inc/header-student-main"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-student"); ?>


	<div class="container">
		<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/e.jpg);">
		<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>

			<div class="margin_all_10px">
				<div class="uk-card uk-card-mute uk-card-body main_card_height_650px">
					<h3 id="lbl-exam-title" class="font_black">Exam</h3>
					<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>
						<div class="uk-card uk-card-quaternary uk-card-body main_card_height_500px">
							<h3>Question: <span id="lbl-exam-question-number">1</span></h3>
							<h4 id="lbl-exam-question">
								What does the name of the story?
							</h4>

    						<button style="position: absolute; top: 90%; left: 35%;" class="uk-button uk-button-secondary" id="btnPrevious"><span class="uk-icon uk-margin-small-right" uk-icon="icon: chevron-left"></span>&nbsp;&nbsp;&nbsp;Previous</button>

						</div>
						<div class="uk-card uk-card-senary uk-card-body main_card_height_500px">
							<h3>Options</h3>
							<h4>
								<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
						            <label class="hovered_pointer"><input class="uk-radio" type="radio" id="rdb-option-1" name="radio">&nbsp;&nbsp;<span id="lbl-exam-option-1">Option 1</span></label><br>
						        </div>
								<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
						            <label class="hovered_pointer"><input class="uk-radio" type="radio" id="rdb-option-2" name="radio">&nbsp;&nbsp;<span id="lbl-exam-option-2">Option 2</span></label><br>
						        </div>
								<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
						            <label class="hovered_pointer"><input class="uk-radio" type="radio" id="rdb-option-3" name="radio">&nbsp;&nbsp;<span id="lbl-exam-option-3">Option 3</span></label><br>
						        </div>
								<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
						            <label class="hovered_pointer"><input class="uk-radio" type="radio" id="rdb-option-4" name="radio">&nbsp;&nbsp;<span id="lbl-exam-option-4">Option 4</span></label><br>
						        </div>
							</h4>

    						<button style="position: absolute; top: 90%; right: 35%;" class="uk-button uk-button-primary" id="btnNext">Next&nbsp;&nbsp;&nbsp;<span class="uk-icon uk-margin-small-right" uk-icon="icon: chevron-right"></span></button>
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

	<!-- modal for banner -->
	<div id="modal-banner" class="uk-flex-top" uk-modal uk-sticky="esc-close: false">
	    <div class="uk-modal-dialog uk-modal-body uk-width-1-1 uk-margin-auto-vertical uk-text-center" >

	    	<!-- data for banner here -->
	    	<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/4.jpg);">
	    	<div id="div-banner-data"></div>
	    	<br>
	    	<br>


	    	<!-- buttons -->
	    	<div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
	    		<div>
	    			<button class="uk-button uk-button-secondary" id="btnRetakeExam">TAKE EXAM AGAIN</button>
	    		</div>
	    		<div>
	    			<button class="uk-button uk-button-secondary" id="btnReadMoreBooks">READ MORE BOOKS</button>
	    		</div>
	    	</div>

	    </div>
	</div>




<!-- include footer -->
<?php $this->load->view("inc/footer"); ?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//----------------------------------------EVENTS--------------------------------------------//

		//display spinner modal
		globalDisplaySpinnerModal(1000);

		//call the function for processing the exam list
		processExamList();

		//call the function for displaying the set of exam
		//by default let us set 1 as a parameter
		displayExams(1);

		//when the next button is clicked
		$("#btnNext").click(function(){

			//get the returned boolean values for these radio buttons
			var option1 = $("#rdb-option-1").prop("checked");
			var option2 = $("#rdb-option-2").prop("checked");
			var option3 = $("#rdb-option-3").prop("checked");
			var option4 = $("#rdb-option-4").prop("checked");

			if(option1 == false && option2 == false && option3 == false && option4 == false){
				UIkit.modal.alert('Please select an option!');
			}else{

				// PROCESS THE USER'S SELECTED OPTION --------------------//
				
				//get the current data sequence of the button
				var currentSequence = $(this).attr("data-sequence");

				//get the exam from localstorage
				var currentExam = JSON.parse(localStorage["Exam_" + (parseInt(currentSequence) - 1)]);

				//create a variable that will store the checked option and it's value
				var checkedOption = "";
				var checkedOptionValue = "";

				//check if option 1 is checked
				if(option1 == true){ 
					checkedOption = "rdb-option-1"; 
					checkedOptionValue = $("#rdb-option-1").attr("data-val"); 
				}else if(option2 == true){ 
					checkedOption = "rdb-option-2"; 
					checkedOptionValue = $("#rdb-option-2").attr("data-val");
				}else if(option3 == true){ 
					checkedOption = "rdb-option-3"; 
					checkedOptionValue = $("#rdb-option-3").attr("data-val");
				}else if(option4 == true){ 
					checkedOption = "rdb-option-4"; 
					checkedOptionValue = $("#rdb-option-4").attr("data-val");
				}

				// UPDATE THE LOCAL STORAGE --------------------//

				//update the localstorage
				currentExam.Picked_Radio_Option = checkedOption;

				//check if the user got the right answer | add 1 if correct | set 0 if incorrect
				currentExam.Points = (currentExam.Correct_Option == checkedOptionValue) ? 1 : 0;

				//then update the whole data of the localstorage
				localStorage.setItem("Exam_" + (parseInt(currentSequence) - 1), JSON.stringify(currentExam));


				// REDIRECT THE USER TO ANOTHER QUESTION --------------------//

				//display spinner modal
				globalDisplaySpinnerModal(300);

				//clear all the checked radio button
				$("#rdb-option-1").attr("checked", false);
				$("#rdb-option-2").attr("checked", false);
				$("#rdb-option-3").attr("checked", false);
				$("#rdb-option-4").attr("checked", false);

				//if the current sequence is not greater than 10
				if(currentSequence <= 10){

					//call the function for displaying the set of exam
					displayExams(currentSequence);

					//check if this is the last question
					if(currentSequence == 10){
						$("#btnNext").html('Submit&nbsp;&nbsp;&nbsp;<span class="uk-icon uk-margin-small-right" uk-icon="icon: chevron-right">').removeClass().addClass("uk-button uk-button-danger");
					}
				}else{ //when the exam is submitted/finished

					//create a variable that will holds the score of the user
					var score = 0;

					//COMPUTE THE GRADES
					for(var i = 1 ; i < 11; i++){

						//get the points on each questions
						var examPoints = JSON.parse(localStorage["Exam_" + i]).Points;

						//add the updated exam points
						score += examPoints;

					}

					//create a variable that will holds all the parameters
					var params = {};

					//set value to our parameter
					params.StudentId = parseInt(localStorage["uid"]);
					params.ExamId = JSON.parse(localStorage["exams"])[0].ExamId;
					params.BookId = JSON.parse(localStorage["exams"])[0].BookId;
					params.TeacherId = localStorage["tid"];
					params.GradeLevel = localStorage["glevel"];
					params.SchoolYear = moment().format("L").split("/")[2];
					params.TotalScore = score;
					params.PerfectScore = 10;
					params.Date = moment().format("L");
					params.IsDeleted = 0;

					// console.log("printing params");
					// console.log(params);

					//AJAX CALL FOR INSERTING THE DATA --------------------//
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('cn/create_exam_result'); ?>",
						data: params,
						success: function(data){

							// console.log("printing data");
							// console.log(data);

							if(data == "Inserted" || data == "Duplicated"){

								//display header text based on the total score
								// var headerText = (params.TotalScore >= 8) ? "Congratulations! You made it." : "Great Job! You can do better next time.";

								var headerText = "";
								if(params.TotalScore <= 3){
									headerText = "Need more practice!";
								}
								else if(params.TotalScore >=4 && params.TotalScore <= 6){
									headerText = "Good job!";
								}
								else if(params.TotalScore >=7 && params.TotalScore <= 10){
									headerText = "Congratulations!";
								}

								//display the score text
								var scoreText = params.TotalScore +'/'+ params.PerfectScore;

								var starOutput = '';
								var xOutput = '';

								for(var i = 0 ; i < params.TotalScore; i++){
									starOutput += '<span uk-icon="icon: star; ratio: 3"></span>';
								}

								for(var i = 0 ; i < parseInt(params.PerfectScore - params.TotalScore); i++){
									xOutput += '<span uk-icon="icon: close; ratio: 3"></span>';
								}

								var bannerOutput = 	'<h1 class="uk-heading-medium">'+ headerText +'</h1>' +
										    	'<h2 class="uk-heading-large">'+ scoreText +'</span></h2>' +
										    	starOutput + xOutput;


								//display the data for our banner
								$("#div-banner-data").html(bannerOutput);

								setTimeout(function(){

									//DISPLAY MODAL --------------------//

									//display the modal for banner
									UIkit.modal("#modal-banner").show();
									
								}, 500);
							}
						}
					});


				}
			}

		});

		//when the previous button is clicked
		$("#btnPrevious").click(function(){

			// REDIRECT THE USER TO ANOTHER QUESTION --------------------//

			//get the current data sequence of the button
			var currentSequence = $(this).attr("data-sequence");

			if(currentSequence > 0){

				//display spinner modal
				globalDisplaySpinnerModal(300);

				//call the function for displaying the set of exam
				displayExams(currentSequence);


				// SET THE LAST SELECTED ANSWER OF THE USER --------------------//
				
				//get the previous exam
				var previousExam = JSON.parse(localStorage["Exam_" + currentSequence]);
				var pickedOption = previousExam.Picked_Radio_Option;

				//then set the selected radio button from the previous
				$("#" + pickedOption).prop("checked", true);
			}


		});

		//when the retake exam button is clicked
		$("#btnRetakeExam").click(function(){

			// REFRESH THE PAGE --------------------//
			location.reload();

		});

		//when the previous button is clicked
		$("#btnReadMoreBooks").click(function(){

			// REDIRECT THE USER TO BOOKS PAGE --------------------//
			window.location = "<?php echo base_url() ?>cn/books";

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

		//----------------------------------------FUNCTIONS--------------------------------------------//

		//create a function that will display the set of exam sequencially
		function displayExams(sequence){

			//get the localstorage of the specified sequence
			var items = JSON.parse(localStorage["Exam_" + sequence]);

			//get all the values from this item
			var quest_number = items.QuestionNum;
			var question = (items.Question == "-") ? '<audio controls><source src="horse.ogg" type="audio/ogg"><source src="<?php echo base_url() ?>'+ items.URL +'" type="audio/mpeg"></audio>' : items.Question;
			var option1 = items.Option_1;
			var option2 = items.Option_2;
			var option3 = items.Option_3;
			var option4 = items.Option_4;

			//set these values into our html
			$("#lbl-exam-question-number").html(quest_number);
			$("#lbl-exam-question").html(question);
			$("#lbl-exam-option-1").html(option1);
			$("#lbl-exam-option-2").html(option2);
			$("#lbl-exam-option-3").html(option3);
			$("#lbl-exam-option-4").html(option4);
			$("#rdb-option-1").attr("data-val", option1);
			$("#rdb-option-2").attr("data-val", option2);
			$("#rdb-option-3").attr("data-val", option3);
			$("#rdb-option-4").attr("data-val", option4);

			//set an attribute value for these buttons
			$("#btnPrevious").attr("data-sequence", parseInt(sequence) - 1);
			$("#btnNext").attr("data-sequence", parseInt(sequence) + 1);

		}
		

		//create a function that will process the examList
		function processExamList(){

			//get all written exam by filtering the data using underscore js
			var writtenExamList = _.where(JSON.parse(localStorage["exams"]), { IsFileExam : "0" });

			//get all visual/audio exam by filtering the data using underscore js
			var visualAudioExamList = _.where(JSON.parse(localStorage["exams"]), { IsFileExam : "1" });

			//then we have to get 5 randomize list of written exam
			var randomizeWrittenExamList = _.sample(writtenExamList, 5);

			//then we have to get 5 randomize list of visual/audio exam
			var randomizeVisualAudioExamList = _.sample(visualAudioExamList, 5);

			console.log("printing randomizeWrittenExamList");
			console.log(randomizeWrittenExamList);
			

			//let us loop the data for written exam lists
			for(var i = 0; i < randomizeWrittenExamList.length; i++){

				//create an array that will holds each properties
				var items = {
					QuestionNum: (i + 1),
					Question: randomizeWrittenExamList[i].Question,
					URL: "",
					Option_1: randomizeWrittenExamList[i].Option1,
					Option_2: randomizeWrittenExamList[i].Option2,
					Option_3: randomizeWrittenExamList[i].Option3,
					Option_4: randomizeWrittenExamList[i].Option4,
					Correct_Option: randomizeWrittenExamList[i].CorrectAnswer,
					Picked_Radio_Option: "",
					Points: 0
				};

				// console.log("printing items");
				// console.log(items);

				//remove all the these items first
				localStorage.removeItem("Exam_" + (i + 1));

				//create a local storage for each items
				localStorage.setItem("Exam_" + (i + 1), JSON.stringify(items));

			}

			//let us loop the data for visual audio exam lists
			for(var i = 0; i < randomizeVisualAudioExamList.length; i++){

				//create a variable that will count the number starting from 5
				var counter = i + 5;

				//create an array that will holds each properties
				var items = {
					QuestionNum: (counter + 1),
					Question: randomizeVisualAudioExamList[i].Question,
					URL: randomizeVisualAudioExamList[i].ExamFileName,
					Option_1: randomizeVisualAudioExamList[i].Option1,
					Option_2: randomizeVisualAudioExamList[i].Option2,
					Option_3: randomizeVisualAudioExamList[i].Option3,
					Option_4: randomizeVisualAudioExamList[i].Option4,
					Correct_Option: randomizeVisualAudioExamList[i].CorrectAnswer,
					Picked_Radio_Option: "",
					Points: 0
				};

				// console.log("printing items");
				// console.log(items);

				//remove all the these items first
				localStorage.removeItem("Exam_" + (counter + 1));

				//create a local storage for each items
				localStorage.setItem("Exam_" + (counter + 1), JSON.stringify(items));

			}

		}


	});

</script>