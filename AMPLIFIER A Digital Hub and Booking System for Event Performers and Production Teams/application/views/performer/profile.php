
<div class="container">
	<?php $this->session->flashdata('success_message') ? $this->message_model->success_message() : '';  ?>
	<?php $this->session->flashdata('danger_message') ? $this->message_model->danger_message() : '';  ?>

	<div class="row py-3">
		<div class="col-sm-8">
			<img src="<?php echo base_url(); ?>assets/img/artist.png" height="100%" width="100%" alt="">	
		</div>
		<div class="col-sm-4">
			<p class="h1 yellow-brown">LASTIKO/BAND</p>
			<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown p</p>
			<p class="text-muted py-3">Source Link</p>
		</div>
	</div>

	<div class="row py-3">
		<div class="col-sm">
			<p class="h3 d-flex justify-content-center">BAND NEEDED!</p>
			<div class="row">
				<div class="col-sm">
					<img src="<?php echo base_url(); ?>assets/img/artist.png" height="150" width="100%" alt="">
				</div>
				<div class="col-sm">
					<p class="text-muted">DYNACOM/CLIENT</p>
					<p class="yellow-brown">g established fact that a reader will be distracted by the readable content of a page </p>
					<div class="d-flex justify-content-center">
						<a href="" class="btn btn-outline-primary">View</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm">
			<p class="h3 d-flex justify-content-center">WE ARE LOOKING FOR BANDS</p>
			<div class="row">
				<div class="col-sm">
					<img src="<?php echo base_url(); ?>assets/img/artist.png" height="150" width="100%" alt="">
				</div>
				<div class="col-sm">
					<p class="text-muted">LOREM IPSUM DOLOR</p>
					<p class="yellow-brown">g established fact that a reader will be distracted by the readable content of a page </p>
					<div class="d-flex justify-content-center">
						<a href="" class="btn btn-outline-primary">View</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
