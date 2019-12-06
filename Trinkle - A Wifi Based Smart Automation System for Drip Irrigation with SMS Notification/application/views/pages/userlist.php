
<?php
//used for redirecting the user after a change in account information
$_SESSION["account_change_page"] = "userlist";
// used for the edit button when admin checks user info
$_SESSION["editClicked"] = 0;
?>


<div class="container" id="usertable-container" style=" padding: 2em;">
	<div class="row">
		

	<h2>All Users</h2> 
	</div>
	<div class="row" id="userlist-buttons-div" style="margin-bottom: 1em; margin-top: 1em; width: 100%;">
		<div class="button-div" style="margin-right: 1em;">
		<button type="button" class="btn btn-success userlist-button" id="add-new-user-button" data-toggle="modal" data-target="#add-new-user-modal" style="width: 13em; float: left">
	  		+ Add New
		</button>	
		</div>
		
		<div class="button-div button-bottom" style="margin-right: 1em;margin-left: 1em;">
		<button type="button" class="btn btn-primary userlist-button" id="change-user-type-button" data-toggle="modal" data-target="#change-user-type-modal" style="width: 13em;">
	  	<span class="oi oi-person"></span>	Change User Type
		</button>	
		</div>
		
		<div class="button-div button-bottom" style="margin-right: 1em;margin-left: 1em;">
		<button type="button" class="btn btn-info userlist-button" id="change-user-password-button" data-toggle="modal" data-target="#change-user-password-modal" style="width: 13em;">
			<span class="oi oi-key"></span>Change User Password
		</button>	
		</div>
</div>
<br>
	<div id="user-table-div" style="">
		<table class="display nowrap" id="usertable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Type</th>
						<th>Phone Number</th>
						<th>Active/Inactive</th>
						<th>SMS Status 
							<!--<div class="help-tip">
							   <p>Shows if the user will receive the system's SMS or not.</p>
							</div>-->
						</th>
            			<th></th>
            			<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$x = 0;
						while($x < count($all_userList)){
							echo "<tr>";
						  	echo "<td>{$all_userList[$x]->user_id}</td>";
							echo "<td align='center'>{$all_userList[$x]->username}</td>";
							echo "<td align='center'>{$all_userList[$x]->first_name}</td>";
							echo "<td align='center'>{$all_userList[$x]->last_name}</td>";
							echo "<td align='center'>{$all_userList[$x]->type}</td>";
							echo "<td align='center'>{$all_userList[$x]->phone_number}</td>";
							if($all_userList[$x]->isActive == 1){
								echo "<td align='center'>Active</td>";
							}else{
								echo "<td align='center'>Inactive</td>";
							}

							if($all_userList[$x]->receiveSMS == 1){
								echo "<td align='center'><span class='oi oi-circle-check' style='color:green;'></span></td>";
							}else{
								echo "<td align='center'><span class='oi oi-circle-x' style='color:red;'></span></td>";
							}
							echo "<td><button class='btn btn-primary' id = '{$all_userList[$x]->user_id}' onClick='append_user_info(this.id)' data-toggle = 'modal' data-target='#user_info_modal'><span class='oi oi-eye'></span> View/Edit</button></td>";
							if($all_userList[$x]->isActive == 1){
							echo "<td><button class='btn btn-danger' id = '{$all_userList[$x]->user_id}' onClick='set_inactive(this.id)'><span class='oi oi-lock-locked'></span> Set as inactive</button></td>";
							}else{
							echo "<td><button class='btn btn-success' id = '{$all_userList[$x]->user_id}' onClick='set_active(this.id)'><span class='oi oi-lock-unlocked'></span> Set as active</button></td>";
							}

						
							echo "</tr>";
							$x++;
						}
					?>
				</tbody>
			</table>
	</div>
</div>
<!--		ADD NEW USER MODAL				-->
<!-- Modal -->
<div class="modal fade" id="add-new-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a new user.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--	Modal Content bruh	-->
        <form method="POST" action="<?php echo base_url('Pages/register_user'); ?>" id="add-user-form" style = "padding: 1em">
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Username</label>
		    <input type="text" class="form-control" id="register_user_username" placeholder="" name="username">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Password</label>
		    <input type="password" class="form-control" id="register_user_password"  placeholder="" name="password">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">First Name</label>
		    <input type="text" class="form-control" id="register_user_fname"  placeholder=""  name="fname">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Last Name</label>
		    <input type="text" class="form-control" id="register_user_lname"  placeholder=""  name="lname">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Phone Number</label>
		    <input type="text" class="form-control" id="register_user_phone"  placeholder=""  name="phone">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">User Type</label>
		    <select class="form-control" id="register_user_user_type" name="userType">
		      <option>user</option>
		      <option>admin</option>
		    </select>
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

<!--					end of add new user modal					-->

</div>
<!--				UPDATE/VIEW USER DATA MODAL						-->
<div class="modal fade" id="user_info_modal" tabindex="-1" role="dialog" aria-labelledby="user_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> Account Information
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- modal body -->
        <div class="container" id="account-info-div">
	<?php if(isset($_SESSION['userID'])){?>
	<div>
		<div align="right " class="my-0">
	    	<button type="button" id="editbtn" class="btn btn-info" data-toggle="collapse" data-target="#collapseconfirm">Edit</button>
	    </div>
		<hr class="mt-1">
		
		<form class="mt-0 mb-2" method="POST" action="<?php echo base_url('Pages/account_update');?>"  onsubmit="return confirm('Are you sure you want to submit?');" id="edit-user-form">

		   <div class="form-row">
		    <div class="form-group col-md-3">
		      <label for="account_id">ID</label>
		      <input type="text" readonly class="form-control" id="account_id" value="<?php echo $_SESSION['userID']?>" name="account_id" required="required" >
		    </div>
		    <div class="form-group col-md-3 col-sm-12 offset-md-3">
		      <label for="account_type">User Type</label>
		      <input type="text" readonly class="form-control" id="account_type" value="<?php echo $_SESSION['userType']?>" name="account_type" required="required" >
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="account_contact">Contact Number</label>
		      <input type="text" readonly class="form-control" id="account_contact" value="<?php echo $_SESSION['phoneNumber']?>" name="account_contact" required="required" >
		    </div>
		    <div class="form-group col-md-6">
		      <label for="account_username"  title="This field may contain letters and numbers">Username</label>
		      <input type="text" readonly class="form-control" id="account_username" value="<?php echo $_SESSION['username']?>" name="account_username" required="required" >
		    </div>
		  </div>
		  <div class="form-row">
		   <div class="form-group col-md-6">
		      <label for="account_fname"  title="This field can only contain letters">First Name</label>
		      <input type="text" readonly class="form-control" id="account_fname" value="<?php echo $_SESSION['first_name']?>" name="account_fname" required="required" >
		    </div>
		   <div class="form-group col-md-6">
		      <label for="account_lname" title="This field can only contain letters">Last Name</label>
		      <input type="text" readonly class="form-control" id="account_lname" value="<?php echo $_SESSION['last_name']?>" name="account_lname" required="required" >
		      <!-- <i class="input_label"  hidden>This field can only contain letters</i> -->
		    </div>
		    <div class="form-group">
		    	<b>Receive SMS status</b>
		    	<p id="receive-sms-message"></p>
		    </div>
		  </div>
	
		  <div class="collapse" id="collapseconfirm">
			  <div align="right " class="my-0">
		    	<button type="submit" id="confirmchange" class="btn btn-info" >Confirm changes</button>
		    </div>
		  </div>
		</form>
		<button class="btn btn-info" id="changePass"  data-toggle="modal" data-target="#passwordmodal">Change Password</button>
	</div>
	<?php 
	}	
	?>

	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="user-data-close-button">Close</button>
      </div>
    </div>
  </div>
</div>
<!--				end of view/edit user data						-->

<!--	CHANGE USER PASSWORD MODAL	-->

<div class="modal fade" id="change-user-password-modal" tabindex="-1" role="dialog" aria-labelledby="change-user-password-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change User Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url("Pages/update_password_admin");?>" id="change-user-password-form" >
       	<div>
       		 <label for="username">Username List:</label>
		      <select class="form-control" id="username" name="username">
		        <?php
        			
						$x = 0;
						while($x < count($all_userList)){
							echo "<option value = '{$all_userList[$x]->username}'>{$all_userList[$x]->username}</option>";
							$x++;
						}
        	?>
		      </select>
		      <br>
       	</div>
        	<br>
        <div class="form-group">
		    <label for="password"><span class="oi oi-key"></span> Enter new password</label>
		    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
        <div class="form-group">
		    <label for="password_confirm"><span class="oi oi-key" ></span> New password confirmation</label>
		    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Password">
		</div>
		<div style="text-align: center">
			<input type="submit" name="" class="btn btn-success">
		</div>
        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--	end of change user password modal	-->

<!--	CHANGE USER TYPE MODAL	-->

<div class="modal fade" id="change-user-type-modal" tabindex="-1" role="dialog" aria-labelledby="change-user-type-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change-user-type-modal-label">Change User Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST" action="<?php echo base_url("Pages/edit_user_type");?>" onSubmit="if(!confirm('Are you sure you want to change this user\'s type?')){return false;}">
       	<div>
       		 <label for="sel1">Username List:</label>
		      <select class="form-control" id="sel1" name="username">
		        <?php
        			
						$x = 0;
						while($x < count($all_userList)){
							echo "<option value = '{$all_userList[$x]->username}'>{$all_userList[$x]->username}</option>";
							$x++;
						}
        	?>
		      </select>
		      <br>
       	</div>
       
       	<div>
       		 <label for="sel2">Type:</label>
		      <select class="form-control" id="sel2" name="type">
		        <option value="admin">Admin</option>
		        <option value="user">User</option>
		      </select>
		      <br>
       	</div>
       	<div style="text-align: center">
       	<input type="submit" name="submit" class="btn btn-success" style="">
       	</div>
       </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--	end of change user type modal	-->
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
		var table = $('#usertable').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );

jQuery('#change-user-password-form').validate({
    rules: {
        password: {
            required: true,
            minlength: 5,
            maxlength: 16
        },
        password_confirm: {
            required: true,
            minlength: 5,
            maxlength: 16,
            equalTo: "#password"
        }
    }
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 

jQuery("#edit-user-form").validate({
	rules: {
		account_contact: {
			required: true,
			minlength: 13,
			maxlength: 15,
		},
			account_username: {
			required: true,
			minlength: 4,
			maxlength: 16	
		},
		account_fname: {
			required: true,
			lettersonly: true,
			minlength: 1
		},
		account_lname: {
			required: true,
			lettersonly: true,
			minlength: 1
		}
	}
});

jQuery("#add-user-form").validate({
	rules: {
		username: {
			required: true,
			minlength: 4,
			maxlength: 16
		},
		password: {
			required: true,
			minlength: 4,
			maxlength: 24
		},
		fname: {
			required: true,
			lettersonly: true,
			minlength:1
		},
		lname: {
			required: true,
			lettersonly: true,
			minlength: 1
		},
		phone: {
			required: true,
			minlength: 7,
			maxlength: 15
		}
	}
});

	});

	function set_inactive(clicked_id){
		var result = confirm("Are you sure you want to set User with ID#"+clicked_id+" as inactive?");
		console.log(clicked_id);
			if (result) {
			 var base_url = "<?php echo base_url()?>";
			    $.ajax({
			      url : base_url +"Pages/set_inactive", 
			      method : "POST",
			      data : {
			        id : clicked_id
			      }
			  }); 
			    location.reload();
			}
	}

	function set_active(clicked_id){
		var result = confirm("Are you sure you want to set User with ID#"+clicked_id+" as active?");
			if (result) {
			 var base_url = "<?php echo base_url()?>";
			    $.ajax({
			      url : base_url +"Pages/set_active", 
			      method : "POST",
			      data : {
			        id : clicked_id
			      }
			  }); 
			    location.reload();
			}
	}
	
	function append_user_info(clicked_id){
	 var base_url = "<?php echo base_url()?>";
	   $.ajax({
	        type: "POST",
	        url : base_url +"Pages/append_user_data",
	        data: {
	          id : clicked_id
	        },
	        dataType: "json",
	        success: function(data) {
	          console.log(data);
	          	
	           $('input[name=account_id]').val(data[0].user_id);
	           $('input[name=account_type]').val(data[0].type);
	           $('input[name=account_fname]').val(data[0].first_name);
	           $('input[name=account_lname]').val(data[0].last_name);
	           $('input[name=account_contact]').val(data[0].phone_number);
	           $('input[name=account_username]').val(data[0].username);
	           $('#receive-sms-message').text("receives");
	           if(data[0].receiveSMS == 1){
	           	$('#receive-sms-message').text("This user chooses to receive SMS notifications");
	           	$('#receive-sms-message').css('color', 'green');
	           }else if(data[0].receiveSMS == 0){
	           	$('#receive-sms-message').text("This user chooses not to receive SMS notifications");
	           	$('#receive-sms-message').css('color', 'red');
	           }
	        },
	        error: function(data){
	          alert("Error appending user data. ");
	        }
	     	});
   	}

	function set_inactive(clicked_id){
		var result = confirm("Are you sure you want to set User with ID#"+clicked_id+" as inactive?");
		console.log(clicked_id);
			if (result) {
			 var base_url = "<?php echo base_url()?>";
			    $.ajax({
			      url : base_url +"Pages/set_inactive", 
			      method : "POST",
			      data : {
			        id : clicked_id
			      }
			  }); 
			    location.reload();
			}
	}

	function set_active(clicked_id){
		var result = confirm("Are you sure you want to set User with ID#"+clicked_id+" as active?");
			if (result) {
			 var base_url = "<?php echo base_url()?>";
			    $.ajax({
			      url : base_url +"Pages/set_active", 
			      method : "POST",
			      data : {
			        id : clicked_id
			      }
			  }); 
			    location.reload();
			}
	}


	

$(document).on("click", "#editbtn", function(){
	$(this).removeAttr("data-toggle");
	$("#account_fname").attr("readonly", false);
	$("#account_lname").attr("readonly", false);
	$("#account_contact").attr("readonly", false);
	$("#account_username").attr("readonly", false);
	$("#receive-sms-radio-off").attr("disabled", false);
	$("#receive-sms-radio-on").attr("disabled", false);
	$("#account_id").attr("disabled", true);
	$(".input_label").attr("hidden", false);
});

$(document).on("click", "#confirmchange", function(){
  	$(this).removeAttr('data-toggle');
  	$("#account_fname").attr("readonly", true);
  	$("#account_lname").attr("readonly", true);
  	$("#account_type").attr("readonly", true);
  	$("#account_contact").attr("readonly", true);
  	$("#account_username").attr("readonly", true);
	$("#receive-sms-radio-off").attr("disabled", true);
	$("#receive-sms-radio-on").attr("disabled", true);
  	$("#account_id").attr("disabled", false);
  	$(".input_label").attr("hidden", true);
});

$(document).on("click", "#user-data-close-button", function(){
  	$(this).removeAttr('data-toggle');
  	$("#account_fname").attr("readonly", true);
  	$("#account_lname").attr("readonly", true);
  	$("#account_type").attr("readonly", true);
  	$("#account_contact").attr("readonly", true);
  	$("#account_username").attr("readonly", true);
	$("#receive-sms-radio-off").attr("disabled", true);
	$("#receive-sms-radio-on").attr("disabled", true);
  	$("#account_id").attr("disabled", false);
  	$(".input_label").attr("hidden", true);
});
	
function show_alert_userType() {
  if(!confirm("Are you sure you want to change this user's type?")) {
    return false;
  }
  this.form.submit();
}
</script>

