
<div class="container py-3 form-signin">
    <?php echo form_open('login_attempt'); ?>
      <div class="text-center mb-4">
        <h1 class="h3 font-weight-normal">Login To</h1>
        <img class="" src="<?php echo base_url(); ?>assets/img/website/logo.png" alt="" width="72" height="72">
    </div>

    <?php $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '';  ?>
    <?php $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '';  ?>

      <div class="form-label-group">
        <input type="email" id="inputEmail" value="<?php echo $this->session->flashdata('email') ? $this->session->flashdata('email') : '' ?>" name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control <?php echo form_error('email') ? 'is-invalid' : '' ?>" placeholder="Email address" autofocus>
        <label for="inputEmail">Email address</label>
        <div class="invalid-feedback">
            <?php echo form_error('email'); ?>
        </div>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" value="" name="pass" class="form-control <?php echo form_error('pass') ? 'is-invalid' : '' ?>" placeholder="Password">
        <label for="inputPassword">Password</label>
        <div class="invalid-feedback">
            <?php echo form_error('pass'); ?>
        </div>
      </div>

        <a href="profile" class="">Cancel</a>
        <p class="float-right">Don't have account? <a href="register" data-toggle="modal" data-target="#registerModal">Register here</a></p>        

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">AMPLIFIER &copy; 2019</p>
    <?php form_close(); ?>
</div>


<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register, switch one?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-around">
			<div class="row">
				<div class="col-md-6">
					<a href="register" class="btn btn-info">Client</a>
				</div>
				<div class="col-md-6">
					<a href="p_register" class="btn btn-primary">Performer</a>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>