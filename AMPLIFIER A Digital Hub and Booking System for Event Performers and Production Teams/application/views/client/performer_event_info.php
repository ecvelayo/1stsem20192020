<div class="container py-3">
    <?php $this->session->flashdata('success_message') ? $this->message_model->success_message() : '' ?>
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo base_url(); echo $photo; ?>" class="img-thumbnail" alt="">
        </div>
        <div class="col-md-8">
            <?php if($this->session->flashdata('user_updated')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo $this->session->flashdata('user_updated'); ?>
                </div>
            <?php endif; ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="header">Performer information</h5>
                        <div class="px-2">
                            <a href="<?php echo base_url(); ?>c_performer_gallery/<?php echo $this->uri->segment(2) ?>" data-toggle="tooltip" data-placement="top" title="Photo-Video" class="btn btn-success mr-2"><i class="fas fa-photo-video fa-lg"></i></a>
                            <a href="<?php echo base_url(); ?>events/<?php echo $this->uri->segment(2) ?>" data-toggle="tooltip" data-placement="top" title="Back" class="btn btn-primary"><i class="fas fa-arrow-left fa-lg"></i> Back</a>
                        </div>
                    </div>                        
                        
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Username</div>
                                <div class="col font-weight-bold"><?php echo $username; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Name</div>
                                <div class="col font-weight-bold"><?php echo $fname; ?>  <?php echo $lname; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Email Address</div>
                                <div class="col font-weight-bold"><?php echo $email; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Phone Number 1</div>
                                <div class="col font-weight-bold"><?php echo $telephone_1; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Phone Number 2</div>
                                <div class="col font-weight-bold"><?php echo $telephone_2; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Address</div>
                                <div class="col font-weight-bold"><?php echo $address; ?></div>
                            </div>
                        </li>
                        <?php if($this->session->userdata('artist_type') != null): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Service</div>
                                    <div class="col font-weight-bold text-capitalize"><?php echo $artist_type; ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Service Description</div>
                                    <div class="col font-weight-bold"><?php echo $artist_desc; ?></div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Offense</div>
                                <div class="col font-weight-bold"><?php echo $offense ? $offense : 'None' ; ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Report Count</div>
                                <div class="col font-weight-bold"><?php echo $report_count ? $report_count : 'None' ; ?></div>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>