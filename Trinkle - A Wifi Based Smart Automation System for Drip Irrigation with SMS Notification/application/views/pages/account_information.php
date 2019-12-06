 <?php
//used for redirecting the user after a change in account information
$_SESSION["account_change_page"] = "account_information";
?>
<div class="container" id="account-info-div">
	<?php if(isset($_SESSION['userID'])){?>
	<div>
		<h3>Account Information</h3>
		<div align="right " class="my-0">
	    	<button type="button" id="editbtn" class="btn btn-info" data-toggle="collapse" data-target="#collapseconfirm">Edit</button>
	    </div>
		<hr class="mt-1">
		
		<form class="mt-0 mb-2" method="POST" action="<?php echo base_url('Pages/account_update');?>"  onsubmit="return confirm('Are you sure you want to submit?');" id="edit-account-form">

		   <div class="form-row">
		    <div class="form-group col-md-3">
		      <label for="id">ID</label>
		      <input type="text" readonly class="form-control" id="account_id" value="<?php echo $_SESSION['userID']?>" name="account_id" required="required" >
		    </div>
		    <div class="form-group col-md-3 offset-md-3">
		      <label for="account_username">User Type</label>
		      <input type="text" readonly class="form-control" id="account_type" value="<?php echo $_SESSION['userType']?>" name="account_username" required="required" >
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="account_contact">Contact Number</label>
		      <input type="text" readonly class="form-control" id="account_contact" value="<?php echo $_SESSION['phoneNumber']?>" name="account_contact"  required="required">
		  	</div>
		    <div class="form-group col-md-6">
		      <label for="account_type"  title="This field may contain letters and numbers">Username</label>
		      <input type="text" readonly class="form-control" id="account_username" value="<?php echo $_SESSION['username']?>" name="account_type"  required="required">
		    </div>
		  </div>
		  <div class="form-row">
		   <div class="form-group col-md-6">
		      <label for="account_type"  title="This field can only contain letters">First Name</label>
		      <input type="text" readonly class="form-control" id="account_fname" value="<?php echo $_SESSION['first_name']?>" name="account_fname"  required="required">
		    </div>
		   <div class="form-group col-md-6">
		      <label for="account_type" title="This field can only contain letters">Last Name</label>
		      <input type="text" readonly class="form-control" id="account_lname" value="<?php echo $_SESSION['last_name']?>" name="account_lname" required="required">
		    </div>
		  </div>
			<div>
				
				<?php 
					if($_SESSION['receiveSMS'] == TRUE){
						echo '<b style="color: green">You will receive SMS Notifications</b>';
					}else{
						echo '<b style="color: red">You will receive SMS Notifications</b>';
					}
				?> 
			</div>
		  <div class="collapse" id="collapseconfirm">
			  <div align="right " class="my-0">
		    	<button type="submit" id="confirmchange" class="btn btn-info" >Confirm changes</button>
		    </div>	
		  </div>
		</form>
		<button class="btn btn-info" id="changePass"  data-toggle="modal" data-target="#change-password-modal">Change Password</button>
	</div>
	<?php 
	}	
	?>

	</div>


<div id="change-password-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Change Password</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form method="POST" action="<?php echo base_url("Pages/update_password_account");?>" id="change-password-form">
		<div class="form-group">
		    <label for="password"><span class="oi oi-key"></span>  Enter your current password</label>
		    <input type="password" class="form-control" id="currentPassword" placeholder="Password" name="currentPassword">
		</div>
		 <div class="form-group">
		    <label for="password"><span class="oi oi-key"></span>  Enter your new password</label>
		    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
		 <div class="form-group">
		    <label for="password"><span class="oi oi-key"></span>  Confirm your new password</label>
		    <input type="password" class="form-control" id="password_confirm" placeholder="Password" name="password_confirm">
		</div>
		<div style="text-align: center">
			<input type="submit" class="btn btn-success" name="">
		</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
	jQuery.extend(jQuery.validator.messages, {
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
<script type="text/javascript">
$(document).ready(function(){
	<?php
		if(isset($_SESSION['wrong_password']) && $_SESSION['wrong_password'] == true){
			echo "alert('Incorrect Password.');";
			echo "$('#change-password-modal').modal('show');";
			$_SESSION['wrong_password'] = false;
		}
	?>
jQuery('#change-password-form').validate({
    rules: {
        password: {
            required: true,
            minlength: 5,
            maxlength: 13
        },
        password_confirm: {
            required: true,
            minlength: 5,
            maxlength: 13,
            equalTo: "#password"
        }
    }
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 

jQuery('#edit-account-form').validate({
	rules: {
		account_contact: {
			required: true,
			minlength: 7,
			maxlength: 15,
		},
		account_fname:{
			required: true,
			lettersonly: true,
			minlength: 1
		},
		account_lname:{
			required: true,
			lettersonly: true,
			minlength: 1
		}
	}
});

  });
  $(document).on("click", "#editbtn", function(){
  	$(this).removeAttr('data-toggle');
  	$("#account_fname").attr("readonly", false);
  	$("#account_lname").attr("readonly", false);
  	$("#account_contact").attr("readonly", false);
  	$("#account_username").attr("readonly", false);
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
  	$("#account_id").attr("disabled", false);
  	$(".input_label").attr("hidden", true);
  

$("#change-password-form").validate();

});
</script>