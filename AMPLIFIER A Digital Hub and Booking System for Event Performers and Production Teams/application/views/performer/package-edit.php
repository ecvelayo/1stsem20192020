<?php echo form_open('p_package_update/'.$this->uri->segment(2)); ?>
    <div class="container col-md-8 py-3">
        <div class="card mb-5" >
            <div class="card-header">
                <div class="row"> 
                    <div class="col-md-3">
                        Package Name:
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(2); ?>">
                        <input type="text" name="package_name" class="form-control <?php echo form_error('package_name') ? 'is-invalid' : '' ?> " required value="<?php echo isset($package_name) ? $package_name : '' ?>">    
                        <div class="invalid-feedback">
                            <?php echo form_error('package_name') ?>
                        </div>   
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <p> Description: </p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control <?php echo form_error('details') ? 'is-invalid' : '' ?>" name="details" id="ckeditor"><?php echo isset($details) ? $details : '' ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo form_error('details') ?>
                            </div>  
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            Price:
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="price" class="form-control <?php echo form_error('price') ? 'is-invalid' : '' ?>" max="1000000000" min="500" required value="<?php echo isset($price) ? $price : '' ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('price') ?>
                            </div>  
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            Action:
                        </div>
                        <div class="col-md-9 d-flex justify-content-end">
                            <a href="<?php echo base_url() ?>p_package_info_page/<?php echo $this->uri->segment(2) ?>" class="btn btn-secondary mr-3">Cancel</a>
                            <a data-toggle="modal" data-target="#alertUpdate"  class="btn btn-primary text-white mr-3" data-toggle="tooltip" data-placement="top" title="Update Package">Submit</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php form_close(); ?>

<!-- Modal -->
<div class="modal fade" id="alertUpdate" tabindex="-1" role="dialog" aria-labelledby="updateAlert" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateAlert">Update ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
			<div class="row col-md-12">
				<div class="col-md-6 col-6 text-center">                
                    <button type="submit" class="btn btn-success ">Hmm, Yes</button>
				</div>
				<div class="col-md-6 col-6 text-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Not Now</button>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>