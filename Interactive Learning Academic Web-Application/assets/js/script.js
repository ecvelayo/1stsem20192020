//------------------------------------------GLOBAL FUNCTIONS---------------------------------//

//create a function that will display the modal alert
function globalDisplayAlert(content){

	//show the modal
	UIkit.modal("#alert-modal").show();

	//display the content of the alert
	$("#alert-custom-content").html(content);
	
}

//create a function that will display the spinner modal
function globalDisplaySpinnerModal(end){

	//display spinner modal
	UIkit.modal("#modal-spinner").show();
	
	//hide the modal
	setTimeout(function(){
		//hide spinner modal
		UIkit.modal("#modal-spinner").hide();
	}, end);
}

//create a function that will full screen a video when clicked
function globalFullScreenMode(classname){

	//declare our promise
	const promiseResult = new Promise((resolve, reject) => {

		//get the element of the video by class name
		var video_element = document.getElementsByClassName(classname);

		//create an anonymous function to make the video into fullscreen mode
		var fullScreenFunction = function(){

			if(this.requestFullscreen){
	            this.requestFullscreen();
	        } 
	        else if(this.webkitRequestFullscreen){
	            this.webkitRequestFullscreen();
	        }
	        else if(this.mozRequestFullScreen){
	            this.mozRequestFullScreen();
	        }
	        else if(this.msRequestFullscreen){
	            this.msRequestFullscreen();
	        }
		}

		//create an anonymous function to show a modal when the video ends
		var showModalWhenEnd = function(){

			//close the screen
			if (this.exitFullscreen) {
	        } else if (this.webkitExitFullscreen) {
	            this.webkitExitFullscreen();
	        } else if (this.mozCancelFullScreen) {
	            this.mozCancelFullScreen();
	        } else if (this.msExitFullscreen) {
	            this.msExitFullscreen();
	        }


			//show the modal
			UIkit.modal("#modal-questionaire-confirm").show();

			resolve(this);
		}

		//loop the element of the video to check if it is currently checked
		for (var i = 0; i < video_element.length; i++) {

			// console.log(video_element[i]);

			//check if the element is clicked then call the function to make the video into full screen mode
		    video_element[i].addEventListener('click', fullScreenFunction, false);

			//check if the element is clicked then call the function to show a modal when the video ended
		    video_element[i].addEventListener('ended', showModalWhenEnd, false);

		    
		}

	});
        	
	//get the result of the promise
	promiseResult.then(data => {

		//convert the data into string
		data = data.outerHTML;

		//get the book id from the data
		var bookId = data.split(" ")[5].slice(9,-10);

		//get the id of the user
		var userid = localStorage["uid"];

		//get the current date
		var currentDate = moment().format("L");

		//declare parameter
		var params = {};

		//set parameter
		params.BookId = bookId;
		params.TotalViews = 1;
		params.IsDeleted = 0;

		// console.log("printing params");
		// console.log(params);

    	//do the ajax call to get the data for book within its category id
		$.ajax({
			type: "POST",
			url: "http://localhost/ilaw/cn/insert_book_viewed",
			data: params,
			success: function(data){

				console.log("printing data");
				console.log(data);
			}
		});

	}).catch(error =>{

		console.log("printing promise failed result");
		console.log(error);
	});

}