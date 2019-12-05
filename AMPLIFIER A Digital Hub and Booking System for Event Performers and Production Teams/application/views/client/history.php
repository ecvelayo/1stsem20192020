<div class="container">
<?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '' ?>
<?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '' ?>
	<?php if($history): ?>
		<p class="h3 red-brown py-3 text-center">Event History</p>
			
		<table id="datatable" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>Schedule</th>
					<th>Event Venue</th>
					<th>Status</th>
					<th>Event Type</th>
					<th>Service</th>
					<th>Action</th>
				</tr>
			</thead>
			<?php 
				// echo '<pre>';
				// print_r($history[0]['username']);
				// echo '</pre>';
				// die();
			?>
			<tbody>
				<?php foreach($history as $b): ?>

				<tr>
					<td class="">
						<?php echo date('F d, Y', strtotime($b['event_date'])) ?>             	
					</td>
					<td>
						<p class="text-capitalize"><?php echo $b['venue_name'] ?></p>
					</td>
					<td>
					<p class="text-capitalize <?php echo $b['status'] == 'approve' ? ' text-success' : ''; echo $b['status'] == 'cancel' ? ' text-danger' : ''; echo $b['status'] == 'block' ? ' text-warning' : ''; echo $b['status'] == 'pending' ? ' text-muted' : ''; ?>"><?php echo $b['status'] ?></p>
					</td>
					<td>
						<p class="text-capitalize"><?php echo $b['event_name'] ?></p>
					</td>
					<td>
						<p class="text-capitalize"><?php echo $b['artist_type'] ?></p>
					</td>
					<td>
						<?php if($b['status'] == 'approve'): ?>
							<a href="<?php base_url(); ?>history_client/<?php echo $b['booking_id'] ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="More Details"><i class="fas fa-external-link-alt "></i></a>
						<?php else: ?>
							
						<?php endif; ?>
					</td>
				</tr>
				
					

				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<th>Schedule</th>
					<th>Venue</th>
					<th>Status</th>
					<th>Event Type</th>
					<th>Service</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	<?php else: ?>
		<div class="mt-3 text-center">
			<p class="h4 mb-3 red-brown">Nothing Found</p>
			<img src="<?php echo base_url(); ?>assets/img/website/in_thought.svg" class="" width="50%" height="50%" alt="">
		</div>
	<?php endif; ?>
</div>