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
                        <span>Search by:</span>
                    </a>
                    <div class="card" style="width:50%; margin:10px;">
                        <div class="card-block">
                            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                                data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">

                                    <div class="container-fluid">
                                        <form method="GET" action="<?php echo base_url('history')?>">
                                            <label for="date">Date of event
                                            <input class="form-control mr-sm-2" style="width:300px" type="date" name="date"  value="<?php echo (isset($where['date'])); ?>"
                                                    placeholder="Search by Date"></label>
                                                    <br>
                                            <label for="date">Name
                                            <input class="form-control" style="width:300px" type="text" name="name" placeholder="E.g event name, client/performer name" value="<?php echo (isset($where['name'])); ?>"></label>
                                                   <br>
                                                <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i>&nbsp Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                    <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="th-sm">VENUE</th>
                                        <th class="th-sm">EVENT NAME</th>
                                        <th class="th-sm">CLIENT NAME</th>
                                        <th class="th-sm">PERFORMER NAME</th>
                                        <th class="th-sm">DATE</th>
                                        <th class="th-sm">CLIENT RATING</th>
                                        <th class="th-sm">ARTIST RATING</th>
                                        <th class="th-sm">STATUS</th>
                                        <th class="th-sm">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                            if($query_data_event_history->num_rows()>0)
                            {
                               foreach($query_data_event_history->result() as $row)
                                { 
                        ?>
                                    <tr>
                                        <td><?php echo $row->venue_name; ?></td>
                                        <td><?php echo $row->event_name; ?></td>
                                        <td><?php echo $row->client_fname; ?>&nbsp<?php echo $row->client_lname; ?></td>
                                        <td><?php echo $row->performer_fname; ?>&nbsp<?php echo $row->performer_lname; ?>
                                        </td>
                                        <td><?php echo  date('F d, Y', strtotime($row->event_date)); ?></td>
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
                                        <td>
                                <?php
                                if($row->performer_rating==''){ ?>
                                 No ratings yet </td>
                                <?php }else{
                                for($i=0;$i<$row->performer_rating; $i++)
                                { 
                                ?>
                                            <div class="fa fa-star"></div>
                                            <?php
                                }
                            }
                                ?>
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
               
                <div class="row"> 
                        <div class="col-sm-12 col-md-12 offset-5">
                                <ul class="pagination">
                            <?php echo $pagination; ?></ul>
                     
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