<div class="container">
	<?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '' ?>
	<?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '' ?>
	<?php if($bookings): ?>	
		<p class="h3 yellow-brown py-3 text-center">Booked Package</p>	
		<table id="datatable" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>Schedule</th>
					<th>Event Venue</th>
					<th>Event Name</th>
					<th>Status</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>			
				<?php $i = 0; foreach($bookings as $b): ?>				
					<tr>
						<td class="">
							<?php echo date('F d, Y', strtotime($b['event_date'])) ?>             	
						</td>
						<td>
							<p class="text-capitalize"><?php echo $b['venue_name'] ?></p>
						</td>
						<td>
							<p class="text-capitalize"><?php echo $b['event_name'] ?></p>
						</td>
						<td>
							<p class="text-capitalize <?php echo $b['status'] == 'approve' ? ' text-success' : ''; echo $b['status'] == 'cancel' ? ' text-danger' : ''; echo $b['status'] == 'block' ? ' text-warning' : ''; echo $b['status'] == 'pending' ? ' text-muted' : ''; ?>"><?php echo $b['status'] ?></p>
						</td>
						<td class="d-flex justify-content-center ">
							<?php if ($b['status'] == 'pending'): ?>
								<a data-toggle="modal" data-target="#alertApprove<?php echo $i ?>" class="btn btn-success mr-2 text-white " data-toggle="tooltip" data-placement="top" title="Accept"><i class="fas fa-check "></i></a>
								<a data-toggle="modal" data-target="#alertDecline<?php echo $i ?>" class="btn btn-danger mr-2 text-white " data-toggle="tooltip" data-placement="top" title="Decline"><i class="fas fa-times "></i></a>
								<a href="<?php echo base_url(); ?>p_event_info/<?php echo $b['booking_id'] ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="More details"><i class="fas fa-external-link-alt "></i></a>
							<?php elseif($b['status'] == 'cancel'): ?>
								
							<?php else: ?>
								<?php if($b['payment_status'] != 'paid'): ?>
									<a href="<?php echo base_url() ?>p_paid/<?php echo $b['booking_id'] ?>" class="btn btn-primary mr-2">Paid</a>
								<?php endif; ?>
								<a href="<?php echo base_url(); ?>p_event_info/<?php echo $b['booking_id'] ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="More details"><i class="fas fa-external-link-alt "></i></a>
							<?php endif; ?>
							
						</td>
					</tr>
					
					<!-- Accept Mdodal -->
					<div class="modal fade" id="alertApprove<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="approveAlert<?php echo $i ?>" aria-hidden="true">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="approveAlert<?php echo $i ?>">Accept Events?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body text-center">
									<div class="bg-warning rounded">
										<p class="text-white">Note: Think carefully, the status is permanent.</p>  
									</div>
									<div class="row">
										<div class="col-md-6">											
											<a href="<?php echo base_url(); ?>p_approve_event/<?php echo $b['booking_id'] ?>" class="btn btn-success">Yes, Accept it.</a>
										</div>
										<div class="col-md-6">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Not Now</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Decline Modal -->
					<div class="modal fade" id="alertDecline<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="declineAlert<?php echo $i ?>" aria-hidden="true">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="declineAlert<?php echo $i ?>">Decline Events?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body text-center">
									<div class="bg-warning rounded">
										<p class="text-white">Note: Think carefully, the status is permanent.</p>  
									</div>
									<div class="row">
										<div class="col-md-6">                
											<a href="<?php echo base_url(); ?>p_decline_event/<?php echo $b['booking_id'] ?>" class="btn btn-danger">Hmm, Yes</a>
										</div>
										<div class="col-md-6">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Not Now</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->
					
				<?php $i++; endforeach; ?>				
			</tbody>
			<tfoot>
				<tr>
					<th>Schedule</th>
					<th>Event Venue</th>
					<th>Event Name</th>
					<th>Status</th>
					<th class="text-center">Action</th>
				</tr>
			</tfoot>
		</table>
	<?php else: ?>
		<div class="text-center mt-3">
			<p class="h4 mb-3 yellow-brown">No Booked Package</p>
			<img src="<?php echo base_url(); ?>assets/img/website/not_found.svg" height="50%" width="50%" alt="">
		</div>
	<?php endif;?>
	</div>
