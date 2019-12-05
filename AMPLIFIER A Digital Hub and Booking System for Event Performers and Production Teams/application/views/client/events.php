<div class="container my-3">
<?php echo $this->session->flashdata('success_message') ? $this->Message_model->success_message() : '' ?>
<?php echo $this->session->flashdata('danger_message') ? $this->Message_model->danger_message() : '' ?>
<!-- <?php// echo '<pre>'; print_r($bookings[0]); echo '</pre>' ?> -->
    <?php if($bookings): ?>        
        <p class="h4 text-center red-brown">Booked Events</p>
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>              
                <?php foreach($bookings as $b): ?>
                    <tr>
                        <td><?php echo $b['event_name'] ?></td>
                        <td><?php echo $b['venue_name'] ?></td>
                        <td><?php echo date('F d, Y', strtotime($b['event_date'])) ?> <?php echo date('h:i a', strtotime($b['event_from'])) ?></td>
                        <td>
                            <p class="text-capitalize <?php echo $b['status'] == 'approve' ? ' text-success' : ''; echo $b['status'] == 'cancel' ? ' text-danger' : ''; echo $b['status'] == 'block' ? ' text-warning' : ''; echo $b['status'] == 'pending' ? ' text-muted' : ''; ?>"><?php echo $b['status'] ?></p>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); echo 'events/'; echo $b['booking_id']?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="More Details"><i class="fas fa-external-link-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <div class="mt-3 text-center">
            <p class="h4 mb-3 red-brown">No Booked Events</p>
            <img src="<?php echo base_url() ?>assets/img/website/void.svg" height="50%" width="50%" alt="">
        </div>
    <?php endif; ?>
</div>