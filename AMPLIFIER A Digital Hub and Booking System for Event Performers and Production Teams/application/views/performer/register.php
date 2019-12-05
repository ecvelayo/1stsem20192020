<?php echo form_open_multipart('p_register_attempt'); ?>
    <div class="container py-3">
        <p class="h2"><?=$title ?></p>        
        <div class="row mt-5">
            <div class="col-md">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username <span class="font-weight-bold text-danger">*</span></label>
                    <input type="text" class="form-control <?php echo form_error('uname') ? 'is-invalid' : '' ?>" value="<?php echo isset($uname) ? $uname : '' ?>" required name="uname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    <div class="invalid-feedback">
                        <?php echo form_error('uname') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">First Name <span class="font-weight-bold text-danger">*</span></label>
                    <input type="text" class="form-control <?php echo form_error('fname') ? 'is-invalid' : '' ?>" value="<?php echo isset($fname) ? $fname : '' ?>" required name="fname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    <div class="invalid-feedback">
                        <?php echo form_error('fname') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name <span class="font-weight-bold text-danger">*</span></label>
                    <input type="text"  class="form-control <?php echo form_error('lname') ? 'is-invalid' : '' ?>" value="<?php echo isset($lname) ? $lname : '' ?>" required name="lname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    <div class="invalid-feedback">
                        <?php echo form_error('lname') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span class="font-weight-bold text-danger">*</span></label>
                    <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : '' ?>" value="<?php echo isset($email) ? $email : '' ?>" required name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    <div class="invalid-feedback">
                        <?php echo form_error('email') ?>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="row">                     
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Address <span class="font-weight-bold text-danger">*</span></label>
                        <textarea class="form-control <?php echo form_error('address') ? 'is-invalid' : '' ?>" required name="address" id="" rows="1"><?php echo isset($address) ? $address : '' ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo form_error('address') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">      
                        <label for="exampleInputEmail1">Contact Number 1 <span class="font-weight-bold text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">09</span>
                            </div>
                            <input type="text" class="form-control <?php echo form_error('number1') ? 'is-invalid' : '' ?>" maxlength="9" value="<?php echo isset($number1) ? $number1 : '' ?>" required name="number1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            <div class="invalid-feedback">
                                <?php echo form_error('number1') ?>
                            </div>
                        </div>                                          
                    </div>
                    <div class="col-md-6">      
                            <label for="exampleInputEmail1">Contact Number 2 <small>(Optional)</small></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">09</span>
                            </div>
                            <input type="text" class="form-control <?php echo form_error('number2') ? 'is-invalid' : '' ?>" maxlength="9" value="<?php echo isset($number2) ? $number2 : '' ?>" name="number2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            <div class="invalid-feedback">
                                <?php echo form_error('number2') ?>
                            </div>
                        </div>                                          
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Type of Service <span class="font-weight-bold text-danger">*</span></label>
                            <select class="form-control <?php echo form_error('service') ? 'is-invalid' : ''; ?>" name="service" required>
                                <option  selected hidden disabled value=""> PLease Select Type of Service</option>
                                <option value="photographer" <?php echo isset($service) ? $service == 'photographer' ? 'selected' : '' : '' ?>>Photographer</option>
                                <option value="videographer" <?php echo isset($service) ? $service == 'videographer' ? 'selected' : '' : '' ?>>videographer</option>
                                <option value="host" <?php echo isset($service) ? $service == 'host' ? 'selected' : '' : '' ?>>Host</option>
                                <option value="restaurant gig" <?php echo isset($service) ? $service == 'restaurant gig' ? 'selected' : '' : '' ?>>Restaurant Gig</option>
                                <option value="graduation ball" <?php echo isset($service) ? $service == 'graduation ball' ? 'selected' : '' : '' ?>>Graduation Ball</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo form_error('service') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" form-group">
                            <label for="">Add Profile Picture <span class="font-weight-bold text-danger">*</span> <small>(Limit to 2mb)</small></label>                            
                            <div class="custom-file">
                                <input type="file" name="userfile" required class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : '' ?>" id="customFile">
                                <label  class="custom-file-label" for="customFile">Choose Photo</label>
                                <div class="invalid-feedback">
                                    <?php echo form_error('userfile') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password <span class="font-weight-bold text-danger">*</span> <small>(At least 8 string long)</small></label>
                            <input type="password" class="form-control <?php echo form_error('pass') ? 'is-invalid' : '' ?>" required minlength="8" value="<?php echo isset($pass) ? $pass : '' ?>" name="pass" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            <div class="invalid-feedback">
                                <?php echo form_error('pass') ?>
                            </div>
                        </div>                            
                    </div>
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password <span class="font-weight-bold text-danger">*</span><small>(At least 8 string long)</small></label>
                            <input type="password" class="form-control <?php echo form_error('con_pass') ? 'is-invalid' : '' ?>" required minlength="8" value="<?php echo isset($con_pass) ? $con_pass : '' ?>" name="con_pass" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            <div class="invalid-feedback">
                                <?php echo form_error('con_pass') ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="card bg-light" style="max-width: 100%;">
                    <div class="card-header">Add Group Video <span class="font-weight-bold text-danger">*</span> <small>(All group video are required, must be mp4 file and the file size is less than 200mb)</small></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">                                
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input <?php echo form_error('video1') ? 'is-invalid' : '' ?>" required name="video1" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('video1') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">                                
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input <?php echo form_error('video2') ? 'is-invalid' : '' ?>" required name="video2" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('video2') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">                                
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input <?php echo form_error('video3') ? 'is-invalid' : '' ?>" required name="video3" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('video3') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div class="col-md-3">
                <div class="card bg-light" style="max-width: 100%;">
                    <div class="card-header">Add Band Photo <span class="font-weight-bold text-danger">*</span> <small>(Limit to 2mb)</small></div>
                    <div class="card-body">
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input <?php echo form_error('group_photo') ? 'is-invalid' : '' ?>" required name="group_photo" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                            <div class="invalid-feedback">
                                <?php echo form_error('group_photo') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="row mt-3">
			<div class="col-md">
				<label for="ckeditor" class="font-weight-bold">Input Service Description <span class="font-weight-bold text-danger">*</span> </label>
				<textarea name="desc" class="form-control <?php echo form_error('desc') ? 'is-invalid' : '' ?>" id="ckeditor" cols="30" rows="10" ><?php echo isset($desc) ? $desc : '' ?></textarea>
                <div class="invalid-feedback">
                    <?php echo form_error('desc') ?>
                </div>
			</div>
		</div>
        <div class="row mt-3 d-flex justify-content-end">
             <a href="profile" class="btn btn-secondary mr-5" data-toggle="tooltip" data-placement="top" title="All data will be lost. Procceed?">Cancel</a>
             <button type="submit" class="btn btn-primary mr-3" name="submit">Submit</button>
	    </div>
    </div>

    <input type="hidden" value="<?php echo isset($dup_fname) ? $dup_fname : '' ?>" name="dup_fname">
    <input type="hidden" value="<?php echo isset($dup_lname) ? $dup_lname : '' ?>" name="dup_lname">
    <input type="hidden" value="<?php echo isset($dup_number1) ? $dup_number1 : '' ?>" name="dup_number1">
    <input type="hidden" value="<?php echo isset($dup_number2) ? $dup_number2 : '' ?>" name="dup_number2">
<?php form_close(); ?>