<!-- <?php// echo '<pre>'; print_r($event); echo '</pre>'; ?> -->
<div class="container my-3">
    <div class="col-md-8 offset-md-2">
            <?php 
                // $datetime = $event['event_date'].' '.$event['event_to'];
                // echo $datetime > date('Y-m-d H:i:s');
                // echo $datetime;echo '<br>';     
                // echo date('Y-m-d H:i:s');  
                // die;
            ?>


        <?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : ''; ?>
        <?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : ''; ?>
        <?php echo $this->session->flashdata('warning_message') ? $this->Message_model->warning_message() : ''; ?>
        <div class="card">
            <div class="card-header"><p class="h4 text-center"><?php echo $event['event_name'] ?></p></div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Event Is On: </p>
                                </div>
                                <div class="col-md-6">        
                                    <?php echo date('F d, Y', strtotime($event['event_date'])); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="font-weight-bold">From: </p>
                                </div>
                                <div class="col-md-7">
                                    <p><?php echo date('h:i a', strtotime($event['event_from'])); ?> - <?php echo date('h:i a', strtotime($event['event_to'])); ?></p>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </li>
                <li class="list-group-item"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Your Price Resquested: </p>
                                </div>
                                <div class="col-md-6">
                                    ₱ <?php echo number_format($event['price'], 2) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">                        
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="font-weight-bold">Location: </p>
                                </div>
                                <div class="col-md-7">
                                    <p class="text-capitalize"><?php echo $event['venue_name'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Payment: </p>
                                </div>
                                <div class="col-md-6">
                                    <p>₱ <?php echo number_format($event['down_payment'], 2) ?></p>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <p class="font-weight-bold">Remaining Balance</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-capitalize"><?php ?></p>
                                </div> -->
                                <div class="col-md-5">
                                    <p class="font-weight-bold">Payment Status: </p>
                                </div>
                                <div class="col-md-7">
                                    <p><?php $s = $event['payment_status']; echo $s == 'dp' ? 'Down Payment' : ''; echo $s == 'paid' ? 'Paid' : ''; echo $s == 'none' ? 'None' : '' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">                
                    <div class="row">     
                        <div class="col-md-6">                                       
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Performer Confirmation: </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-capitalize"><?php echo $event['status'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="font-weight-bold">Service Type: </p>
                                </div>
                                <div class="col-md-7">
                                    <p class="text-capitalize"><?php echo $event['artist_type'] ? $event['artist_type'] : 'None' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="font-weight-bold">Client Notes: </p>
                        </div>
                        <div class="col-md-9">
                            <p class=""><?php echo $event['notes'] ?></p>
                        </div>
                    </div>
                </li>
            </ul> 
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <small class="font-weight-bold">Date Booked: </small>
                    </div>
                    <div class="col-md-6">
                        <small><?php echo date('l, F d, Y', strtotime($event['date_booked'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-end mt-2">
            <?php $datetime = $event['event_date'].' '.$event['event_to']; ?>
            <?php if($datetime < date('Y-m-d H:i:s')): ?>                            
                <?php if($report): ?>          
                    <a href="#"  class="btn btn-success col-md-2 mr-2" data-toggle="tooltip" data-placement="top" title="Reported">Reported <i class="fas fa-check"></i></a>  
                <?php else: ?>      
                    <a href="<?php echo base_url(); ?>p_report_event/<?php echo $this->uri->segment(2) ?>"  class="btn btn-warning col-md-2 mr-2" data-toggle="tooltip" data-placement="top" title="Report Event">Report <i class="fas fa-exclamation"></i></a>  
                <?php endif; ?>       
                
                <?php if($this->History_model->check_performer_rate()): ?>
                    <a href="#"  class="btn btn-success col-md-2 mr-2" data-toggle="tooltip" data-placement="top" title="Rated">Rated <i class="fas fa-check"></i></a>  
                <?php else: ?>
                    <a href="<?php echo base_url(); ?>p_rate_event/<?php echo $this->uri->segment(2) ?>"  class="btn btn-warning col-md-2 mr-2" data-toggle="tooltip" data-placement="top" title="Rate Event">Rate <i class="fas fa-exclamation"></i></a>  
                <?php endif; ?>

            <?php endif; ?>

            <a href="<?php echo base_url(); ?>p_bookings"  class="btn btn-secondary col-md-2" data-toggle="tooltip" data-placement="top" title="Return"><i class="fas fa-arrow-left"></i></a>
        </div>       
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="alertDelete" tabindex="-1" role="dialog" aria-labelledby="deleteAlert" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAlert">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-around">
			<div class="row">
				<div class="col-md-6">
                
					<a href="<?php echo base_url(); ?>c_delete_event/<?php echo $this->uri->segment(2) ?>" class="btn btn-danger">Yes</a>
				</div>
				<div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>
