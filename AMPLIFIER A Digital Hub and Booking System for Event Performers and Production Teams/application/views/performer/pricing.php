<?php echo form_open_multipart('p_pricing_validate');?>
	<div class="container">
		<?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '' ?>
		<?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '' ?>
		<div class="py-3">
			<p class="h4 yellow-brown text-center">Add Package</p>
			<div class="row">
				<div class="col-md-6">
					<label for="" class="text-muted">Place description and what the package consists of</label>
					<textarea name="desc" id="ckeditor" class="form-group form-control <?php echo form_error('desc') ? 'is-invalid' : '' ?>"><?php echo isset($desc) ? $desc : '' ?></textarea>
					<div class="invalid-feedback">
						<?php echo form_error('desc'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Service Type</label>
						<input readonly value="<?php echo $this->session->userdata('artist_type'); ?>" class="form-control is-valid text-capitalize">
					</div>
					<div class="form-group">
						<label for="">Package Name</label>
						<input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>">
						<div class="invalid-feedback">
							<?php echo form_error('name'); ?>
						</div>				
					</div>
					<div class="form-group">
						<label for="">Price Offer <small>(Minimum Price is ₱ 500)</small></label>
						<input type="number" name="price" value="<?php echo isset($price) ? $price : '' ?>" required min="500" max="100000000000" class="form-control <?php echo form_error('price') ? 'is-invalid' : '' ?>">
						<div class="invalid-feedback">
							<?php echo form_error('price'); ?>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="">Add Band Picture</label>                            
						<div class="custom-file">
							<input type="file" name="userfile" class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : '' ?>" id="customFile">
							<label  class="custom-file-label" for="customFile">Choose Photo</label>
							<div class="invalid-feedback">
								<?php echo form_error('userfile') ?>
							</div>
						</div>
					</div> -->
					<div class="row pt-2">
						<div class="col-md-10">
							<img src="<?php echo base_url(); ?>assets/img/website/forming_ideas.svg" width="100%" alt="">
						</div>
						<div class="col-md-2 pl-1">
							<button class="btn btn-primary" type="submit" name="submit">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php form_close(); ?>