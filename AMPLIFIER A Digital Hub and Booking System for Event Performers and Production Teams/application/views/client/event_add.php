<?php echo form_open('c_event_add_attempt') ?>
<div class="container my-3">
    <div class="row">
        <div class="col-md-6">
            <p class="h3 text-center">Book a Package</p>
            <div class="form-group">
                <label for="">Event Name</label>
                <input type="text" class="form-control <?php echo form_error('event_name') ? 'is-invalid' : '' ?>" name="event_name" value="<?php echo isset($event_name) ? $event_name : '' ?>">
                <div class="invalid-feedback">
                    <?php echo form_error('event_name') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                       <div class="form-group">
                        <label for="">Event Date</label>
                        <input type="date" name="event_date" class="form-control <?php echo form_error('event_date') ? 'is-invalid' : '' ?>" value="<?php echo isset($event_date) ? $event_date : '' ?>" >
                        <div class="invalid-feedback">
                            <?php echo form_error('event_date') ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Package Name</label>
                        <input class="form-control text-capitalize" disabled value="<?php echo $package['package_name'] ?>" >
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-6">
                       <div class="form-group">
                        <label for="">From</label>
                        <input type="time" name="from" class="form-control <?php echo form_error('from') ? 'is-invalid' : '' ?>" value="<?php echo isset($from) ? $from : '' ?>" >
                        <div class="invalid-feedback">
                            <?php echo form_error('from') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="time" name="to" class="form-control <?php echo form_error('to') ? 'is-invalid' : '' ?>" value="<?php echo isset($to) ? $to : '' ?>" >
                        <div class="invalid-feedback">
                            <?php echo form_error('to') ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                       <div class="form-group">
                        <label for="">Expected Payment/Full Payment</label>
                        <input type="number" name="full_payment" class="form-control <?php echo form_error('full_payment') ? 'is-invalid' : '' ?>" value="<?php echo isset($full_payment) ? $full_payment : '' ?>" >
                        <div class="invalid-feedback">
                            <?php echo form_error('full_payment') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Partial Payment/Downpayment</label>
                        <input type="number" name="down_payment" class="form-control <?php echo form_error('down_payment') ? 'is-invalid' : '' ?>" value="<?php echo isset($down_payment) ? $down_payment : '' ?>" >
                        <div class="invalid-feedback">
                            <?php echo form_error('down_payment') ?>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <label for="">Payment</label>
                <input type="number" name="down_payment" class="form-control <?php echo form_error('down_payment') ? 'is-invalid' : '' ?>" value="<?php echo isset($down_payment) ? $down_payment : '' ?>" >
                <div class="invalid-feedback">
                    <?php echo form_error('down_payment') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="">Venue Location</label>
                <input type="text" class="form-control <?php echo form_error('location') ? 'is-invalid' : '' ?>" name="location" value="<?php echo isset($location) ? $location : '' ?>">
                <div class="invalid-feedback">
                    <?php echo form_error('location') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 my-3">
            <div class="form-group">
                <label class="my-3">Notes</label>
                <textarea name="notes" id="ckeditor" class="form-control <?php echo form_error('notes') ? 'is-invalid' : '' ?>"><?php echo isset($notes) ? $notes : '' ?></textarea>
                <div class="invalid-feedback">
                    <?php echo form_error('notes') ?>
                </div>
            </div>
            <div class="row my-3 d-flex justify-content-center">
                <div class="col-md-3 ">
                    <button class="btn btn-primary btn-block" type="submit">Book</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php form_close() ?>