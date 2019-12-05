<!DOCTYPE html>
<html lang="en">


<?php include('head.php'); ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <?php include('topbar.php'); ?>
                <?php include('navbar.php'); ?>

                <!-- Begin Page Content -->

                <div class="container">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <a href="<?php echo base_url('history');?>"><button type="button" class="btn fas fa-arrow-left"></button></a> -->
                                    <h4 align="center">EVENT DETAILS</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
                                    if($fetch_data_event_detail->num_rows()>0)
                                    {
                                      foreach($fetch_data_event_detail->result() as $row)
                                        { 
                            
                                    ?>

                                    <!-- <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">EVENT ID:</label> 
                                <div class="col-8">
                                  <p class="lead"><?php echo $row->booking_id; ?></p>
                                </div>      
                              </div>
                              <hr> -->
                                    <br>
                                    <div class="form-group row">
                                        <label for="username" class="col-4 col-form-label"> Client Name:</label>
                                        <div class="col-8">
                                            <p class="lead"><img
                                                    src="<?php echo base_url(); ?><?php echo $row->client_photo; ?>"
                                                    alt="none" style="width:50px;height:50px; border-radius:30px">&nbsp
                                            <a class="text-secondary" href="<?php echo base_url('profile/'); echo $row->client_id; ?>">
                                                <?php echo $row->client_fname; ?>&nbsp<?php echo $row->client_lname; ?>
                                            </a>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="username" class="col-4 col-form-label">Performer Name:</label>
                                        <div class="col-8">
                                            <p class="lead"><img
                                                    src="<?php echo base_url(); ?><?php echo $row->performer_photo; ?>"
                                                    alt="none" style="width:50px;height:50px; border-radius:30px">
                                                &nbsp <a class="text-secondary" href="<?php echo base_url('profile/'); echo $row->performer_id; ?>">
                                                        <?php echo $row->performer_fname; ?>&nbsp<?php echo $row->performer_lname; ?>
                                                       </a>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Event Name:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo $row->event_name; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Venue:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo $row->venue_name; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">First Payment:</label>
                                        <div class="col-8">
                                            <p class="lead">₱ <?php echo $row->down_payment; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Total Amount of event:</label>
                                        <div class="col-8">
                                            <p class="lead">₱ <?php echo $row->full_amount; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Payments Offered:</label>
                                        <div class="col-8">
                                            <?php if ($row->payment_status=="dp"){ ?>
                                                <p class="lead text-uppercase">Down Payment</p>
                                            <?php }else{ ?>
                                            <p class="lead text-uppercase"><?php echo $row->payment_status; ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Date of event:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo  date('F d, Y', strtotime($row->event_date)); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Scheduled time:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo date("h:i A",strtotime($row->event_from));?> - <?php echo date("h:i A",strtotime($row->event_to));?></p>
                                        </div>
                                    </div>
                                    <hr>
                                <?php if($row->client_rating!=''){ ?>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Client ratings to
                                            performer:</label>
                                        <div class="col-8">
                                            <?php
                                for($i=0;$i<$row->client_rating; $i++)
                                { 
                                ?>
                                            <div class="fa fa-star"></div>
                                            <?php
                                }
                                ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Client comment:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo $row->notes; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                <?php } ?>
                                <?php if($row->performer_rating!=''){ ?>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Performer ratings to
                                            Client:</label>
                                        <div class="col-8">
                                            <?php
                                for($i=0;$i<$row->performer_rating; $i++)
                                { 
                                ?>
                                            <div class="fa fa-star"></div>
                                            <?php
                                }
                                ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Performer's comment:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo $row->notes; ?></p>
                                        </div>
                                    </div>
                                  
                                    <hr>
                                    <?php } ?>
                                    <div class="form-group row">
                                        <label for="text" class="col-4 col-form-label">Date Booked:</label>
                                        <div class="col-8">
                                            <p class="lead"><?php echo  date('F d, Y', strtotime($row->date_booked)); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                              }
                          }
                        ?>
                       

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end -->




    </div>
    <!-- /.container-fluid -->

    </div>
    </div>
    <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('logout_modal.php'); ?>
    <?php include('footer-script.php'); ?>


</body>
<!-- modal image -->
<div class="modal fade" id="viewfull" tabindex="-1" role="dialog" aria-labelledby="fullview" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-basic">
                <h5 class="modal-title" id="fullview">FULL VIEW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?php echo base_url(); ?>assets/img/1.jpg" class="m-3 rounded"
                    style="height:500px; width:735px">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->

</html>