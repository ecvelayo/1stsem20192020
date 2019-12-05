<?php echo form_open('p_package_update'); ?>
<div class="container">
    <div class="row">
        <div class="container col-md-6 mt-3">
        <?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : ''  ?>
        <?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : ''  ?>
            <div class="card mb-5" >
                <div class="card-header">
                    <div class="row"> 
                        <div class="col-md-5">
                            Package Name:
                        </div>
                        <div class="col-md-7">
                            <?php echo $package_name ?>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">
                                <p> Description: </p>
                            </div>
                            <div class="col-md-7">
                                <?php echo $details ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">
                                Price:
                            </div>
                            <div class="col-md-7">
                                ₱ <?php echo number_format($price, 2) ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">
                                Action:
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                <a href="<?php echo base_url() ?>p_package" class="btn btn-secondary mr-3">Cancel</a>
                                <?php if($booked == 0): ?>
                                    <a data-toggle="modal" data-target="#alertDelete"  class="btn btn-danger text-white mr-3" data-toggle="tooltip" data-placement="top" title="Delete Package"><i class="fas fa-trash"></i></a>
                                    <a href="<?php echo base_url(); ?>p_package_edit_page/<?php echo $this->uri->segment(2) ?>" class="btn btn-primary">Update</a>                                
                                <?php endif; ?>                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <img src="<?php echo base_url(); ?>assets/img/website/content.svg" width="100%" alt="">
        </div>
    </div>
</div>
<?php form_close(); ?>

<!-- Modal -->
<div class="modal fade" id="alertDelete" tabindex="-1" role="dialog" aria-labelledby="deleteAlert" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAlert">Are you sure you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-around">
			<div class="row">
				<div class="col-md-6">                
					<a href="<?php echo base_url();?>p_package_delete/<?php echo $this->uri->segment(2) ?>" class="btn btn-danger">Yes</a>
				</div>
				<div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>