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
                    <div class="card mb-4">
                    <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="75%">
                                <thead>
                                    <tr>
                                        <th class="th-sm">VENUE</th>
                                        <th class="th-sm">EVENT_NAME</th>
                                        <th class="th-sm">PERFORMER NAME</th>
                                        <th class="th-sm">ARTIST RATING</th>
                                        <th class="th-sm">DATE</th>
                                        <th class="th-sm">STATUS</th>
                                        <th class="th-sm">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                            if($query_data_transaction->num_rows()>0)
                            {
                               foreach($query_data_transaction->result() as $row)
                                { 
                        ?>
                                    <tr>
                                        <th><?php echo $row->venue_name; ?></th>
                                        <td><?php echo $row->event_name; ?></td>
                                        <td><?php echo $row->performer_fname; ?>&nbsp<?php echo $row->performer_lname; ?>
                                        </td>
                                        <td>
                                        <?php
                                            if($row->client_rating==''){ ?>
                                                No ratings yet </td>
                                            <?php
                                            }else{
                                            for($i=0;$i<$row->client_rating; $i++)
                                            { 
                                            ?>
                                                        <div class="fa fa-star"></div>
                                                        <?php
                                            }
                                        }
                                            ?>
                                            </td>
                                        <td><?php echo  date('F d, Y', strtotime($row->event_date)); ?></td>
                                       
                                       
                             
                                        <th><?php echo $row->status; ?></th>
                                        <td>
                                            <a href="<?php echo base_url('eventview/'); echo $row->booking_id; ?>"><button
                                                    class="btn btn-outline-info fa fa-eye"></button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
                            </div>


                </div>
                <?php
         
        }else{
      
        ?>
          <center>
            <img src="<?php echo base_url(); ?>/assets/img/nodata-found.png"
                                class="m-3 w-50 h-50"/></center>
            <?php
              }
              ?>
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

</html>