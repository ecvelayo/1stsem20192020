
<link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">

<div class="login-container">
  <section class="login" id="login">
    <header>
      <h2>Trinkle  </h2>
      <h4>Login</h4>
    </header>
    <form class="login-form" action="<?php echo base_url('Pages/logincheck'); ?>" method="post" id="login-form">
      <input name="username" type="text" class="login-input" placeholder="Username" required autofocus/>
      <input name="password" type="password" class="login-input" placeholder="Password" required/>
      <div class="submit-container">
        <button type="submit" class="login-button">LOG IN</button>
      </div>
    </form>
  </section>
</div>

<script>
  $(document).ready(function(){
    console.log("ready");
    // $("#login-form").validate({
    //     rules: {
    //       username: {
    //         required: true,
    //         minlength: 5
    //       }
          
    //     }
    // });

  });

	// script for invalid login attempt 
	var form = document.getElementById('login');
	<?php
		if(isset($_SESSION['loginError']) && $_SESSION['loginError'] == TRUE){
			echo " form.classList.add('error_1');";
			echo "setTimeout(function () {";
			echo "form.classList.remove('error_1');";
			echo " }, 3000);";
			session_unset();
			echo "console.log('sessions unset after invalid login attempt');";
		}
		
	?>
</script>
