		
<div class="container" id="usertable-container">
	<div class="row"><h2>Crop Specifications</h2>
		<?php  if(isset($_SESSION['userType'])&& $_SESSION['userType'] == 'admin'){ ?>
		<button type="button" class="btn btn-success" id="add-new-user-button" data-toggle="modal" data-target="#exampleModal" style="margin-left: 1em;">
  		+ Add New
		</button>
		<?php } ?>
</div>

	<div id="user-table-div">
		<table class="display nowrap" id="crop-specification-table" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Soil Moisture</th>
						<th>Temperature</th>
						<th>Carbon Dioxide</th>
						<?php if(isset($_SESSION['userType'])&& $_SESSION['userType'] == 'admin'){?>
						<th>Edit</th>
						<th>Delete</th>
					<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$x = 0;
						while($x < count($crop_specifications)){
							echo "<tr>";
						  	echo "<td>{$crop_specifications[$x]->crop_id}</td>";
						  	echo "<td>{$crop_specifications[$x]->crop_name}</td>";
							echo "<td>{$crop_specifications[$x]->soilmoisture_min}-{$crop_specifications[$x]->soilmoisture_max}</td>";
							echo "<td>{$crop_specifications[$x]->temperature_min}-{$crop_specifications[$x]->temperature_max}</td>";
							echo "<td>{$crop_specifications[$x]->min_carbon_dioxide}-{$crop_specifications[$x]->max_carbon_dioxide}</td>";
							if(isset($_SESSION['userType'])&& $_SESSION['userType'] == 'admin'){
							echo "<td><button class='btn btn-info' id='{$crop_specifications[$x]->crop_id}' data-toggle='modal' data-target='#edit-crop-data-modal' onClick='append_crop_data(this.id)'><span class='oi oi-pencil' ></span></button></td>";
							
							echo "<td><button class='btn btn-danger' id='{$crop_specifications[$x]->crop_id}' onclick='delete_crop_function(this.id)'><span class='oi oi-trash'></span></button></td>";
							}
							
							echo "</tr>";
							$x++;
						}
					?>
				</tbody>
			</table>
	</div>
</div>
<!--									add new crop 									-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new crop.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--	Modal Content bruh	-->
        <form method="POST" action="<?php echo base_url('Pages/add_new_crop'); ?>" id="add-crop-form" style = "padding: 1em">
		  <div class="form-group " >
		    <label for="exampleFormControlInput1">Name</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""  name="crop_name">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Minimum Soil Moisture</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="min_soil">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Maximum Soil Moisture</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="max_soil">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Minimum Temperature</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="min_temp">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Maximum Temperature</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="max_temp">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Minimum Carbon Dioxide</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="min_carbon">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Maximum Carbon Dioxide</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1"  placeholder=""  name="max_carbon">
		  </div>
		  <div class="form-group" style="margin-left : 40%">
		  	<input type="submit" name="submit" class="btn btn-success">
		  </div>
		</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--									edit crop modal 								-->
<div id="edit-crop-data-modal-div">
	<div class="modal fade" id="edit-crop-data-modal" tabindex="-1" role="dialog" aria-labelledby="edit-crop-data-modal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="edit-crop-data-modal">Edit Crop Specifications</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div align="right " class="my-0">
	    	<button type="button" id="editbtn" class="btn btn-info" data-toggle="collapse" data-target="#collapseconfirm">Edit</button>
	    </div>
	    <form method="POST" action="<?php echo base_url('Pages/update_crop_info');?>" id="edit-crop-form">
		  <div class="form-group " >
		    <label for="edit-crop-name">Name</label>
		    <input type="text" class="form-control" id="crop-name" placeholder=""  name="crop-name" value="" maxlength="48" readonly>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
		    <label for="min-moisture" class="offset-md-2">Min Soil Moisture</label>
		    <input type="text" class="form-control col-md-8  offset-md-3 " id="min-moisture"  placeholder=""  name="min-moisture" value="" maxlength="3" readonly minlength="1" required>
		  </div>
		  <div class="form-group">
		    <label for="max-moisture" class="offset-md-2">Max Soil Moisture</label>
		    <input type="text" class="form-control col-md-8 offset-md-3 " id="max-moisture"  placeholder=""  name="max-moisture" value="" maxlength="3" readonly required>
		  </div>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
		    <label for="min-temp" class="offset-md-2">Min Temperature</label>
		    <input type="text" class="form-control col-md-8 offset-md-3" id="min-temp"  placeholder=""  name="min-temp" value="" readonly required>
		  </div>
		  <div class="form-group">
		    <label for="max-temp" class="offset-md-2">Max Temperature</label>
		    <input type="text" class="form-control col-md-8 offset-md-3" id="max-temp"  placeholder=""  name="max-temp" value="" maxlength="3" readonly required>
		  </div>
		  </div>
		  <div class="form-row">
		  <div class="form-group">
		    <label for="min-carbon" class="offset-md-2">Min Carbon Dioxide</label>
		    <input type="text" class="form-control col-md-8 offset-md-3" id="min-carbon"  placeholder=""  name="min-carbon" value="" maxlength="3" readonly required>
		  </div>
		  <div class="form-group">
		    <label for="max-carbon" class="offset-md-2">Max Carbon Dioxide</label>
		    <input type="text" class="form-control col-md-8 offset-md-3" id="max-carbon"  placeholder=""  name="max-carbon" value="" readonly required>
		  </div>
		    <input type="text" class="form-control" id="crop-id" placeholder=""  name="crop-id" value="" maxlength="3" readonly hidden>
		  </div>
		  <div class="collapse" id="collapseconfirm">
			  <div align="right " class="my-0">
		    	<button type="submit" id="confirmchange" class="btn btn-info" >Confirm changes</button>
		    </div>
		  </div>
		</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit-crop-close-button">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>

<!-- 	End Of Modal	-->
<script>
	jQuery.extend(jQuery.validator.messages, {
	lettersonly: "Please enter letters only.",
    required: "This field is required.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "The values you entered do not match. Please enter the values again",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});
</script>

<script>
	$('document').ready(function(){
		var table = $('#crop-specification-table').DataTable();

	// jQuery('#edit-crop-form').validate({
	// 	rules: {
	// 		crop-name: {
	// 			required: true,
	// 			maxlength:48
	// 		},
	// 		min-moisture: {
	// 			required: true,
	// 			maxlength: 3
	// 		},
	// 		max-moisture: {
	// 			required: true,
	// 			maxlength: 3
	// 		},
	// 		min-temp: {
	// 			required: true,
	// 			maxlength: 3
	// 		}
	// 		max-temp: {
	// 			required: true,
	// 			maxlength: 3
	// 		},
	// 		min-carbon: {
	// 			required: true,
	// 			maxlength: 3
	// 		},
	// 		max-carbon: {
	// 			required: true,
	// 			maxlength: 3
	// 		}
	// 	}
	// });
jQuery('#add-crop-form').validate({
    rules: {
       crop_name: {
       	required : true,
       	maxlength: 30
       },
       min_soil: {
       	required : true,
       	maxlength: 3
       },
       max_soil: {
       	required : true,
       	maxlength: 3
       },
       min_temp: {
       	required : true,
       	maxlength: 3
       },
       max_temp: {
       	required : true,
       	maxlength: 3
       },
       min_carbon: {
       	required : true,
       	maxlength: 3
       },
       max_carbon: {
       	required : true,
       	maxlength: 3
       }
      
    }
});



});

	$(document).on("click", "#editbtn", function(){
	$(this).removeAttr("data-toggle");
	$("#crop-name").attr("readonly", false);
	$("#min-moisture").attr("readonly", false);
	$("#max-moisture").attr("readonly", false);
	$("#min-temp").attr("readonly", false);
	$("#max-temp").attr("readonly", false);
	$("#min-carbon").attr("readonly", false);
	$("#max-carbon").attr("readonly", false);
	});

	$(document).on("click", "#edit-crop-close-button", function(){
	$(this).removeAttr("data-toggle");
	$("#crop-name").attr("readonly", true);
	$("#min-moisture").attr("readonly", true);
	$("#max-moisture").attr("readonly", true);
	$("#min-temp").attr("readonly", true);
	$("#max-temp").attr("readonly", true);
	$("#min-carbon").attr("readonly", true);
	$("#max-carbon").attr("readonly", true);
	});

	$(document).on("click", "#confirmchange", function(){
	$(this).removeAttr("data-toggle");
	$("#crop-name").attr("readonly", true);
	$("#min-moisture").attr("readonly", true);
	$("#max-moisture").attr("readonly", true);
	$("#min-temp").attr("readonly", true);
	$("#max-temp").attr("readonly", true);
	$("#min-carbon").attr("readonly", true);
	$("#max-carbon").attr("readonly", true);
	});




	function delete_crop_function(clicked_id){
		var result = confirm("Are you sure you want to delete this crop");
			if (result) {
			 var base_url = "<?php echo base_url()?>";
			    $.ajax({
			      url : base_url +"Pages/delete_crop", 
			      method : "POST",
			      data : {
			        id : clicked_id
			      }
			  }); 
			     window.setTimeout(function(){location.reload()},300);
		}
	}

	function append_crop_data(clicked_id){
		 var base_url = "<?php echo base_url()?>";
		   $.ajax({
		        method : "POST",
		        url : base_url +"Pages/append_crop_data",
		        data: {
		          id : clicked_id
		        },
		        dataType: "json",
		        success: function(data) {
		          	console.log(data);	
		         	$('input[name=crop-id]').val(data[0].crop_id);
		         	$('input[name=crop-name]').val(data[0].crop_name);
		         	$('input[name=min-moisture]').val(data[0].soilmoisture_min);
		         	$('input[name=max-moisture]').val(data[0].soilmoisture_max);
		         	$('input[name=min-temp]').val(data[0].temperature_min);
		         	$('input[name=max-temp]').val(data[0].temperature_max);
		         	$('input[name=max-carbon]').val(data[0].max_carbon_dioxide);
		         	$('input[name=min-carbon]').val(data[0].min_carbon_dioxide);
		        },
		        error: function(data){
		          alert("Error appending crop data. ");
		        }
		   });
	}
</script>