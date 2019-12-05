<!-- include header -->
<?php $this->load->view("inc/header-student-game"); ?>

<!-- include nav -->
<?php $this->load->view("inc/nav-student"); ?>


	<div class="container">
		<div class="uk-background-cover" style="background-image: url(<?php echo base_url(); ?>assets/image/as.jpg);">
		<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid>

			<div class="margin_all_10px">
				<div class="uk-card uk-card-mute uk-card-body main_card_height_auto">
					<h3>Games</h3>
					<div class="uk-child-width-expand@s uk-text-center" uk-grid>
						<div class="uk-child-width-1-1@s uk-grid-small uk-grid-match" uk-grid id="div_display_game_data">

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

	<!-- modal for game -->
	<div id="modal-game" class="uk-modal-full" uk-modal>
	    <div class="uk-modal-dialog">
	        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
	        <div class="uk-grid-collapse uk-child-width-1-1@s uk-flex-middle" uk-grid>
	            <div id="div-game-data-here">
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
		displayGameData();

		//when the btnGoToGame is clicked
		$(document).on('click', '.btnGoToGame', function(){

			//get the current game id
			var gameId = $(this).attr("data-id");

			//get all the game list from our local storage
			var game_list = JSON.parse(localStorage["games"]);

			//get the game where gameId exists
			var currentGameData = _.where(game_list, { GameId: gameId });

			var game_output = 	'<object width="100%" height="760px">' +
								'        <param name="movie" value="'+ currentGameData[0].GameLink +'">' +
								'        <embed src="'+ currentGameData[0].GameLink +'"></embed>' +
								'</object>';

			//then let us set the game output here.
			$("#div-game-data-here").html(game_output);
			
			//display the modal
			UIkit.modal("#modal-game").show();

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
		function displayGameData(){

			//get the current data in our local storage and parse it into json
			var gameItem = JSON.parse(localStorage["games"]);

			//create a clean variable to store our html output 
			var output = "";

			//let us loop the gameItem
			for(var i = 0 ; i < gameItem.length; i++){

				// console.log("printing data");
				// console.log(gameItem[i]);

				output += '<div class="margin_all_10px">' +
						'		<div class="uk-card uk-card-mute uk-card-body main_card_height_auto">' +
						'			<div class="uk-child-width-expand@s uk-text-center uk-grid-collapse" uk-grid id="div_display_game_data">' +
						'		        <div class="uk-card uk-card-default uk-card-body">' +
						'		            <img class="btnGoToGame hovered_pointer" src="<?php echo base_url() ?>'+ gameItem[i].GamePictureFileName +'" data-id="'+ gameItem[i].GameId +'"/>' +
						'		        </div>' +
						'		        <div class="uk-card uk-card-denary uk-card-body">' +
						'		            <br><br><br>' +
						'		            <h3 class="uk-heading-medium font_white uk-button-text">'+ gameItem[i].GameName +'</h3>' +
						'		            <br><br><br>' +
						'		        </div>' +
						'			</div>' +
						'		</div>' +
						'</div>';
			}

			//update the html output into division 
			$("#div_display_game_data").html(output);

		}

	});

</script>