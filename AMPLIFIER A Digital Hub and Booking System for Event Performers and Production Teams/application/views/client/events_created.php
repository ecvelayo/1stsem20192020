<div class="container my-3">
<?php echo $this->session->flashdata('success_message') ? $this->message_model->success_message() : '' ?>
<?php echo $this->session->flashdata('danger_message') ? $this->message_model->danger_message() : '' ?>
<!-- <?php// echo '<pre>'; print_r($bookings[0]); echo '</pre>' ?> -->
    <p class="h1 text-center">Created Events</p>
    <table class="table table-hover" id="datatable">
        <thead>
            <tr>
            <th scope="col">Event Name</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($events): ?>                
                <?php foreach($events as $b): ?>
                    <tr>
                        <td><?php echo $b['event_name'] ?></td>
                        <td><?php echo $b['venue_name'] ?></td>
                        <td><?php echo date('F d, Y', strtotime($b['event_date'])) ?></td>
                        <td><?php echo date('h:i a', strtotime($b['event_from'])) ?></td>
                        <td>
                            <a href="<?php echo base_url(); echo 'events/'; echo $b['booking_id']?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="More Details"><i class="fas fa-external-link-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <td class="text-muted h4 text-center" colspan="12">No Entries Found</td>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
            <th scope="col">Event Name</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>
</div>