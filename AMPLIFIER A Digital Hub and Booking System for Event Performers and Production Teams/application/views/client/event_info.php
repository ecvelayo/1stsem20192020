<!-- <?php// echo '<pre>'; print_r($event); echo '</pre>'; ?> -->
<div class="container my-3">
    <div class="col-md-8 offset-md-2 ">
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
                                    <p class="font-weight-bold">Performer Price Offered: </p>
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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Package Name: </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-capitalize"><?php echo $event['package_name']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Client Notes: </p>
                                </div>
                                <div class="col-md-6">
                                    <p class=""><?php echo $event['notes'] ?></p>
                                </div>
                            </div>
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
            <a href="<?php echo base_url(); ?>performer_profile_info/<?php echo $this->uri->segment(2) ?>"  class="btn btn-primary col-md-1 mr-2" data-toggle="tooltip" data-placement="top" title="Performer Info"><i class="fas fa-user"></i></a>
            <?php if($event['status'] == 'pending'): ?>
                <a data-toggle="modal" data-target="#alertDelete" href="#" class="text-white btn btn-danger col-md-1 mr-2" data-toggle="tooltip" data-placement="top" title="Delete Event"><i class="fas fa-trash-alt"></i></a>
            <?php endif; ?>
            
            <a href="<?php echo base_url(); ?>print_event/<?php echo $this->uri->segment(2) ?>" target="_blank"  class="btn btn-info col-md-1 mr-2" data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print"></i></a>
            <a href="<?php echo base_url(); ?>c_events"  class="btn btn-secondary col-md-1" data-toggle="tooltip" data-placement="top" title="Return"><i class="fas fa-arrow-left"></i></a>
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
