<?php echo form_open('p_rating_attempt/'.$this->uri->segment(2)); ?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Rate Event: <span class="font-weight-bold"><?php echo $rate['event_name'] ?></span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item ">Rate the event from 1 to 5.</li>
                    <?php if(form_error('rate1')): ?>                        
                        <li class="list-group-item">
                            <div class="text-danger"><?php echo form_error('rate1') ?></div> 
                        </li>
                    <?php endif; ?>
                    <!-- <?php print_r($rate2) ?> -->
                    <li class="list-group-item text-center">                              
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="rate1" value="1" <?php echo isset($rate1)  ? $rate1 == 1 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="rate1" value="2" <?php echo isset($rate1)  ? $rate1 == 2 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="rate1" value="3" <?php echo isset($rate1)  ? $rate1 == 3 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="rate1" value="4" <?php echo isset($rate1)  ? $rate1 == 4 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline4"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline5" name="rate1" value="5" <?php echo isset($rate1)  ? $rate1 == 5 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline5"></label>
                        </div>
                    </li>
                    <li class="list-group-item">               
                        Write A Review <small></small>
                        <textarea class="form-group form-control" name="review" id="" row="100%" col="3"><?php echo isset($review) ? $review ? $review : '' : '' ?></textarea>
                    </li>
                </ul>
                
                <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item ">2. Rate your satisfaction of the artist.</li>
                    <?php if(form_error('rate2')): ?>                        
                        <li class="list-group-item">
                            <div class="text-danger">This number is required rating.</div> 
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item text-center">                              
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline6" name="rate2" value="1" <?php echo isset($rate2)  ? $rate2 == 1 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline6"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline7" name="rate2" value="2" <?php echo isset($rate2)  ? $rate2 == 2 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline7"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline8" name="rate2" value="3" <?php echo isset($rate2)  ? $rate2 == 3 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline8"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline9" name="rate2" value="4" <?php echo isset($rate2)  ? $rate2 == 4 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline9"></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline10" name="rate2" value="5" <?php echo isset($rate2)  ? $rate2 == 5 ? 'checked' : '' : '' ?> class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline10"></label>
                        </div>
                    </li>
                </ul> -->
                <div class="card-footer d-flex justify-content-end">
                    <a href="<?php echo base_url() ?>p_event_info/<?php echo $this->uri->segment(2) ?>" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="submit">Submit Rate</button>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="background-image: url('<?php echo base_url(); ?>assets/img/website/judge.svg'); background-size: contain; background-repeat: no-repeat;">
            <!-- <img src="<?php echo base_url(); ?>assets/img/website/judge.svg" class="ml-5" width="100%" alt=""> -->
        </div>
    </div>
</div>
<?php form_close(); ?>