<?php echo form_open_multipart('p_report_attempt/'.$this->uri->segment(2)); ?>
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Report Event: <span class="font-weight-bold"><?php echo $report['event_name'] ?></span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item ">1. State your reason why you report this event.</li>
                    <li class="list-group-item">
                        <div class="form-group">
                            <textarea name="desc" id="ckeditor" cols="1" rows="1" class="form-control <?php echo form_error('desc') ? 'is-invalid' : '' ?>"><?php echo isset($desc) ? $desc : ''  ?></textarea>
                            <div class="invalid-feedback"><?php echo form_error('desc') ? form_error('desc') : '' ?></div>                            
                        </div>
                    </li>
                    <li class="list-group-item ">2. Additional Information if needed <small>(Optional)</small>.</li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Photo:  <small>(Limit to 2mb)</small></label>    
                                    </div>
                                    <div class="col-md-12">                                        
                                        <div class="form-group">                        
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : ''; ?>"  name="userfile" id="customFile">
                                                <label  class="custom-file-label" for="customFile">Choose Photo</label>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('userfile'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Video:  <small>(Limit to 200mb)</small></label>    
                                    </div>
                                    <div class="col-md-12">                                        
                                        <div class="form-group">                        
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?php echo form_error('uservideo') ? 'is-invalid' : ''; ?>"  name="uservideo" id="customFile">
                                                <label  class="custom-file-label" for="customFile">Choose Video</label>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('uservideo'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                </ul>
                <div class="card-footer d-flex justify-content-end">
                    <a href="<?php echo base_url() ?>history_client/<?php echo $this->uri->segment(2) ?>" class="btn btn-primary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-danger" name="submit">Submit Report <i class="fas fa-exclamation"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-5 text-center mt-3" style="background-image: url('<?php echo base_url(); ?>assets/img/website/warning.svg'); background-size: contain; background-repeat: no-repeat;">
            <!-- <img src="<?php echo base_url(); ?>assets/img/website/judge.svg" class="ml-5" width="100%" alt=""> -->
        </div>
    </div>
</div>
<?php form_close(); ?>