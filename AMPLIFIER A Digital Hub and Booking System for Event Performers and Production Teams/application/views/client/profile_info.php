<div class="container py-3">
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo base_url(); echo $this->session->userdata('photo'); ?>" class="img-thumbnail" alt="">
        </div>
        <div class="col-md-8">
        <?php $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '' ?>
        <?php $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '' ?>
            <?php if($this->session->flashdata('user_updated')): ?>
                <div class="alert alert-success alert-block">
                    <?php echo $this->session->flashdata('user_updated'); ?>
                </div>
            <?php endif; ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="header">User information</h5>
                        <div class="px-2">
                            <?php if($this->session->userdata('user_type') == 'performer'): ?>
                                <a href="<?php echo base_url(); ?>p_gallery" data-toggle="tooltip" data-placement="top" title="Photo-Video" class="btn btn-success"><i class="fas fa-photo-video fa-lg"></i></a>
                            <?php endif;?>
                            <a href="<?php echo base_url(); ?>profile_password_edit_page" data-toggle="tooltip" data-placement="top" title="Update Password" class="btn btn-info"><i class="fas fa-cog fa-lg"></i></a>
                            <a href="<?php echo base_url(); ?>profile_edit_info" data-toggle="tooltip" data-placement="top" title="Edit Information" class="btn btn-primary"><i class="fas fa-user-edit fa-lg"></i></a>
                        </div>
                    </div>                        
                        
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Username</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('username'); ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Name</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('fname'); ?>  <?php echo $this->session->userdata('lname'); ?></div>
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
                                <div class="col font-weight-bold">09<?php echo $this->session->userdata('telephone_1'); ?></div>
                            </div>
                        </li>
                        <?php if($this->session->userdata('telephone_2')): ?>                        
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Phone Number 2</div>
                                    <div class="col font-weight-bold">09<?php echo $this->session->userdata('telephone_2'); ?></div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Address</div>
                                <div class="col font-weight-bold"><?php echo $this->session->userdata('address'); ?></div>
                            </div>
                        </li>
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
                        <?php if($this->session->userdata('user_type') == 'performer' && 1==0): ?>                            
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Average Rating</div>
                                    <div class="col font-weight-bold"><?php echo $average ; ?></div>
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