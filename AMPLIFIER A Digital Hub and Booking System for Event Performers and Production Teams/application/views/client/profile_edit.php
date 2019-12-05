<?php echo form_open_multipart('profile_edit_info'); ?>
<div class="container py-3 mb-5">
    <div class="row">
        <div class="col-md-4">
            <?php 
                // echo '<pre>';
                // print_r($this->session->userdata());
                // echo '</pre>';
            ?>
            <img src="<?php echo base_url(); echo $this->session->userdata('photo'); ?>" class="img-thumbnail" alt="">
            <div class="form-group mt-2">
                <label for="" class="d-flex justify-content-center">Edit Profile Photo</label>                  
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : ''; ?>" name="userfile" id="customFile">
                    <label  class="custom-file-label" for="customFile">Choose Photo</label>
                    <div class="invalid-feedback">
                        <?php echo form_error('userfile'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="header">Edit User information</h5>
                        <div class="px-2">
                            <a href="profile_info" data-toggle="tooltip" data-placement="top" title="Cancel" class="btn btn-danger mr-2"><i class="fas fa-times "></i></a>
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="top" title="Save Changes"><i class="fas fa-save fa-lg"></i></button>                      
                        </div>
                    </div>                        
                        
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Username</div>
                                <div class="col font-weight-bold"><input type="text" value="<?php echo isset($uname) ? $uname : $this->session->userdata('username'); ?>" required class="form-control <?php echo form_error('uname') ? 'is-invalid' : '' ?>" name="uname">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('uname'); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">First Name</div>
                                <div class="col font-weight-bold"><input type="text" value="<?php echo isset($fname) ? $fname : $this->session->userdata('fname'); ?>" class="form-control <?php echo form_error('fname') ? 'is-invalid' : '' ?>" required name="fname">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('fname'); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Last Name</div>
                                <div class="col font-weight-bold"><input type="text" value="<?php echo isset($lname) ? $lname : $this->session->userdata('lname'); ?>" class="form-control <?php echo form_error('lname') ? 'is-invalid' : '' ?>" required name="lname">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('lname'); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Email Address</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('email'); ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Phone Number 1</div>
                                <div class="col font-weight-bold">                                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">09</div>
                                        </div>
                                        <input type="text" value="<?php echo isset($number1) ? $number1 : $this->session->userdata('telephone_1'); ?>"  class="form-control <?php echo form_error('number1') ? 'is-invalid' : '' ?>" required maxlength="9"  name="number1">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('number1'); ?>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Phone Number 2 <small>(Optional)</small></div>
                                <div class="col font-weight-bold">                                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">09</div>
                                        </div>
                                        <input type="text" value="<?php echo isset($number2) ? $number2 : $this->session->userdata('telephone_2'); ?>" class="form-control <?php echo form_error('number2') ? 'is-invalid' : '' ?>" maxlength="9" name="number2">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('number2'); ?>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Address</div>
                                <div class="col font-weight-bold"><textarea required name="address" id="" value="" class="form-control <?php echo form_error('address') ? 'is-invalid' : '' ?>" rows="1"><?php echo isset($address)  ? $address   : $this->session->userdata('address'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php if($this->session->userdata('artist_type') != null): ?>                            
                            <li class="list-group-item sr-only">
                                <div class="row">
                                    <div class="col">Phone Number 2</div>
                                    <div class="col font-weight-bold">
                                        <select class="form-control <?php echo form_error('service') ? 'is-invalid' : ''; ?>" required name="service">
                                            <option  selected hidden disabled value=""> PLease Select Type of Service</option>
                                            <option value="photographer" <?php echo isset($service) == 'photographer' ? 'selected' : $this->session->userdata('artist_type') == 'photographer' ? 'selected' : '' ?>>Photographer</option>
                                            <option value="videographer" <?php echo isset($service) == 'videographer' ? 'selected' : $this->session->userdata('artist_type') == 'videographer' ? 'selected' : '' ?>>videographer</option>
                                            <option value="host" <?php echo isset($service) == 'host' ? 'selected' : $this->session->userdata('artist_type') == 'host' ? 'selected' : '' ?>>Host</option>
                                            <option value="restaurant gig" <?php echo isset($service) == 'restaurant gig' ? 'selected' : $this->session->userdata('artist_type') == 'restaurant gig' ? 'selected' : '' ?>>Restaurant Gig</option>
                                            <option value="graduation ball" <?php echo isset($service) == 'graduation ball' ? 'selected' : $this->session->userdata('artist_type') == 'graduation ball' ? 'selected' : '' ?>>Graduation Ball</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('service') ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item sr-only">
                                <div class="row">
                                    <div class="col">Service Description</div>
                                    <div class="col font-weight-bold"><textarea name="desc" id="ckeditor" value="" class="form-control <?php echo form_error('desc') ? 'is-invalid' : '' ?>" required rows="1"><?php echo isset($desc)  ? $desc   : $this->session->userdata('artist_desc'); ?></textarea>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('desc'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($this->session->userdata('artist_type') != null): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Service</div>
                                    <div class="col font-weight-bold text-capitalize"><?php echo $this->session->userdata('artist_type'); ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Service Description</div>
                                    <div class="col font-weight-bold"><?php echo $this->session->userdata('artist_desc'); ?></div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Offense</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('offense') ? $this->session->userdata('offense') : 'None' ; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Report Count</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('report_count') ? $this->session->userdata('report_count') : 'None' ; ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="card-footer">
                        <small class="text-muted">Account Registered: <?php echo date('F d, Y', strtotime($this->session->userdata('created_at'))); ?> Time: <?php echo date('h:i:s A', strtotime($this->session->userdata('created_at'))) ?></small><br>
                        <small class="text-muted">Account Updated: <?php echo date('F d, Y', strtotime($this->session->userdata('updated_at'))); ?> Time: <?php echo date('h:i:s A', strtotime($this->session->userdata('updated_at'))) ?></small>
                    </div>  
            </div>
        </div>
    </div>
</div>
<?php form_close(); ?>