<?php
    $raw_date = $this->uri->segment(2).'-'.$this->uri->segment(3).'-'.$this->uri->segment(4);
    $header_date = date('F d, Y', strtotime($raw_date));
?>

<div class="container my-3">

    <?php if($booked_events): ?>
    <!-- <div><?php echo '<pre>'; print_r($booked_events); echo '</pre>'; ?></div> -->
    
  <div class="row">  
    <div class="col-md-7">    
        <div class="row">
            <div class="col-md-10">
                <p class="h4 text-center">Events of <?php echo $header_date ?></p>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $this->session->userdata('previous_calendar_link') ?>" class="btn btn-block btn-primary">Back</a>
            </div>
        </div>
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Event Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($booked_events as $b): ?>
                    <tr>
                        <th><?php echo date('h:i a', strtotime($b['event_from']))  ?> - <?php echo date('h:i a', strtotime($b['event_to'])) ?></th>
                        <td ><p class="font-weight-bold text-capitalize"><?php echo $b['event_name'] ?></p></td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    </div>
    <div class="col-md-5">
        <div class="text-center">
			<p class="h4"><br></p>
			<img src="<?php echo base_url() ?>assets/img/website/time_management.svg" class="mt-3" width="100%" alt="">
		</div>
    </div>
  </div>

    <?php else: ?>
		<div class="text-center">
			<p class="h4">No Events Found on <?php echo $header_date ?></p>
			<img src="<?php echo base_url() ?>assets/img/website/events.svg" class="mt-3" width="50%" alt="">
		</div>
    <?php endif; ?>
</div>