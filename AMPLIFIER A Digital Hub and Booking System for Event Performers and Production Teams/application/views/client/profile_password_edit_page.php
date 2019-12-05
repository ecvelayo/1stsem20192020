<?php echo form_open('profile_password_update'); ?>

    <div class="container mt-3">        
        <div class="row">
            <div class="col-md-6 bg-white">
                <?php $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '';  ?>
                <?php $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '';  ?>
                
                <p class="h2">Change Password</p>     
                <input type="hidden" value="<?php echo $this->session->userdata('password'); ?>" name="passOld1">       
                <div class="form-group pt-2">
                    <label for="exampleInputPassword1">Old Password <span class="font-weight-bold text-danger">*</span></label>
                    <input type="password" value="<?php echo isset($passOld) ? $passOld : $this->session->userdata('passOld'); ?>" required class="form-control <?php echo form_error('passOld') || $this->session->flashdata('pass_old_not_matched') ? 'is-invalid' : '' ?>" name="passOld">
                    <div class="invalid-feedback">
                        <?php echo form_error('passOld'); ?>
                        <?php echo $this->session->flashdata('pass_old_not_matched'); ?>
                    </div>
                </div>          
                <div class="form-group pt-2">
                    <label for="exampleInputPassword1">New Password <span class="font-weight-bold text-danger">*</span></label>
                    <input type="password" value="<?php echo isset($pass) ? $pass : $this->session->userdata('pass'); ?>" minlength="8" required class="form-control <?php echo form_error('pass') || $this->session->flashdata('pass_not_matched') ? 'is-invalid' : '' ?>" name="pass">
                    <div class="invalid-feedback">
                        <?php echo form_error('pass'); ?>
                        <?php echo $this->session->flashdata('pass_not_matched'); ?>
                    </div>
                </div>          
                <div class="form-group pt-2">
                    <label for="exampleInputPassword1">Confirm Password <span class="font-weight-bold text-danger">*</span></label>
                    <input type="password" value="<?php echo isset($passConf) ? $passConf : $this->session->userdata('passConf'); ?>" minlength="8" required class="form-control <?php echo form_error('passConf') || $this->session->flashdata('pass_not_matched') ? 'is-invalid' : '' ?>" name="passConf">
                    <div class="invalid-feedback">
                        <?php echo form_error('passConf'); ?>
                        <?php echo $this->session->flashdata('pass_not_matched'); ?>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="profile_info" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Discard Changes"><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url(); ?>assets/img/website/authentication.svg" width="100%" alt="">
            </div>
        </div>
  </div> 
<?php form_close(); ?>