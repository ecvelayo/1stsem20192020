<!-- <?php// echo '<pre>'; print_r($package); echo '</pre>'; echo rand(999999999,9); ?> -->

<div class="container my-3">

	<?php $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '';  ?>
	<?php $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '';  ?>
	
	<?php if(array_key_exists(0, $package)): ?>
		<div class="row">
			<div class="col-md-7">
				<img src="<?php echo base_url(); echo $package[0]['band_photo'] ?>" class="border-black-3" width="100%" alt="">	
			</div>
			<div class="col-md-5">
				<p class="h1 red-brown"><?php echo $package[0]['package_name'] ?></p>
				<p class=""><?php echo $package[0]['details'] ?></p>
				<small>Date Added: <?php echo date('m/d/y', strtotime($package[0]['p_created_at'])) ?></small>
				<p class="text-muted py-3"></p>
				<a href="<?php echo base_url(); ?>c_gallery/<?php echo $package[0]['package_id'] ?>" class="btn btn-info" data-placement="top" title="" data-toggle="tooltip"><span class="fas fa-photo-video"></span> Preview</a>
				<a href="<?php echo base_url(); ?>booking_book_event/<?php echo $package[0]['package_id'] ?>" class="btn btn-primary ml-2" data-placement="top" title="Book <?php echo $package[0]['package_name'] ?>" data-toggle="tooltip"><span class="fas fa-book"></span> Book</a>
			</div>
		</div>
	<?php endif; ?>

	<div class="row mt-3">
		<?php if(array_key_exists(1, $package)): ?>
			<div class="col-md-6">
				<p class="h2 d-flex justify-content-center"><?php echo $package[1]['package_name'] ?></p>
				<div class="row">
					<div class="col-md-7">
						<img src="<?php echo base_url(); echo $package[1]['band_photo']; ?>" class="border-black-3	" width="100%" alt="">
					</div>
					<div class="col-md-5">
						<p class="red-brown"><?php echo $package[1]['details'] ?></p>
						<small>Date Added: <?php echo date('m/d/y', strtotime($package[1]['p_created_at'])) ?></small>
						<div class="d-flex justify-content-center">
							<a href="<?php echo base_url(); ?>c_gallery/<?php echo $package[0]['package_id'] ?>" class="btn btn-info mr-2" data-placement="top" title="" data-toggle="tooltip"><span class="fas fa-photo-video"></span> Preview</a>
							<a href="<?php echo base_url(); ?>booking_book_event/<?php echo $package[1]['package_id'] ?>" class="btn btn-primary" data-placement="top" title="Book <?php echo $package[1]['package_name'] ?>" data-toggle="tooltip"><span class="fas fa-book"></span> Book</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if(array_key_exists(2, $package)): ?>
			<div class="col-md-6">
				<p class="h2 d-flex justify-content-center"><?php echo $package[2]['package_name'] ?></p>
				<div class="row">
					<div class="col-md">
						<img src="<?php echo base_url(); echo $package[2]['band_photo']?>" class="border-black-3" width="100%" alt="">
					</div>
					<div class="col-md">
						<p class="red-brown font-weight-bold"><?php echo $package[2]['details'] ?> </p>
						<small>Date Added: <?php echo date('m/d/y', strtotime($package[2]['p_created_at'])) ?></small>
						<div class="d-flex justify-content-center">
							<a href="<?php echo base_url(); ?>c_gallery/<?php echo $package[0]['package_id'] ?>" class="btn btn-info mr-2" data-placement="top" title="" data-toggle="tooltip"><span class="fas fa-photo-video"></span> Preview</a>
							<a href="<?php echo base_url(); ?>booking_book_event/<?php echo $package[2]['package_id'] ?>" class="btn btn-primary" data-placement="top" title="Book <?php echo $package[2]['package_name'] ?>" data-toggle="tooltip"><span class="fas fa-book"></span> Book</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php if(!$package): ?>
		<div class="mt-3 text-center">
			<p class="red-brown h4">Cleaned up! <span class="h5">No available packages at this time</span></p>
			<img src="<?php echo base_url() ?>assets/img/website/clean_up.svg" class="mt-3" width="50%" alt="">
		</div>
	<?php endif; ?>
</div>
