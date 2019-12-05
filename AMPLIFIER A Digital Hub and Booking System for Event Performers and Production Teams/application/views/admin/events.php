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

                <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-sort"></i>
                        <span>Filter</span>
                    </a>
                    <div class="card" style="width:50%; margin:10px;">
                        <div class="card-block">
                            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                                data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">

                                    <div class="container-fluid">
                                        <form method="GET" action="<?php echo base_url('events')?>">
                                            <label for="date">Date of event
                                            <input class="form-control mr-sm-2" style="width:300px" type="date" name="date"  value="<?php echo (isset($where['date'])); ?>"
                                                    placeholder="Search by Date"></label>
                                                    <br>
                                            <label for="date">Name
                                            <input class="form-control" type="text" name="name" placeholder="E.g event name, client/performer name" value="<?php echo (isset($where['name'])); ?>"></label>
                                                   <br>
                                                <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>&nbsp Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="<?php echo base_url('services')?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-music fa-sm text-white-50"></i> Add Event</a>
                    </div>
                    <div class="card mb-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>

                                    <tr>
                                        <th scope="col">EVENT NAME</th>
                                        <th scope="col">VENUE</th>
                                        <th scope="col">CLIENT NAME</th>
                                        <th scope="col">PERFORMER NAME</th>
                                        <th scope="col">DATE OF EVENT</th>
                                        <th scope="col">TIME OF EVENT </th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                            if($query_data_event->num_rows()>0)
                            {
                               foreach($query_data_event->result() as $row)
                                { 
                    
                            ?>
                                    <tr>
                
                                        <td> <?php echo $row->event_name; ?></td>
                                        <td> <?php echo $row->venue_name; ?></td>
                                        <td> <?php echo $row->client_fname; ?>&nbsp<?php echo $row->client_lname; ?>
                                        </td>
                                        <td> <?php echo $row->performer_fname; ?>&nbsp<?php echo $row->performer_lname; ?>
                                        </td>
                                        <td> <?php echo  date('F d, Y', strtotime($row->event_date)); ?></td>
                                        <td> <?php echo date("h:i A",strtotime($row->event_from)); ?> - <?php echo date("h:i A",strtotime($row->event_to)); ?></td>
                                        <td> <?php echo $row->status; ?></td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-list-alt fa-lg fa-fw text-blue-400 pl-3"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-down shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink">
                        
                                                   <label class="ml-3">Action:</label>
                                                   <br>
                                                    <a class="dropdown-item fas fa-eye fa-fw"
                                                        href="<?php echo base_url('eventview/'); echo $row->booking_id; ?>">&nbsp More
                                                        Details</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item fas fa-ban fa-fw" href="#"
                                                        data-toggle="modal"
                                                        data-target="#delevent<?php echo $row->booking_id; ?>">&nbsp
                                                        Cancel Event</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- event delete modal -->
                                <div class="modal fade" id="delevent<?php echo $row->booking_id; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="delevent" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                CANCEL EVENT
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <H5>Are you sure you want to cancel event:<br>
                                                    <?php echo $row->event_name; ?></H5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo base_url('delete_event/'); echo $row->booking_id; ?>" type="button">
                                                    <button class="btn btn-danger">YES</button></a>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">CANCEL</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end -->
                                    <?php
                       }
                        ?>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="row"> 
                        <div class="col-sm-12 col-md-12 offset-5">
                                <ul class="pagination">
                            <?php echo $pagination; ?></ul>
                     
                        </div>
                    </div>
                    
            </div>
            <?php
          }
          else
          {
          ?>
          <center>
        <img src="<?php echo base_url(); ?>/assets/img/nodata-found.png"
                            class="m-3 w-50 h-50"/></center>
        <?php
          }
          ?>

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
    <?php include('footer-script.php'); ?>
  
    <!-- end -->



</body>

</html>