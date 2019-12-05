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

                <div class="card" style="width:50%; margin:10px;">
                        <div class="card-block">
                            <div class="container-fluid">
                                <form method="GET" action="<?php echo base_url('notifications')?>">
                                    <label for="date">Select Date
                                    <input class="form-control mr-sm-2" style="width:300px" type="date" name="date"  value="<?php echo (isset($data['date'])); ?>"
                                            placeholder="Search by Date"></label>  
                                        <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                    </div>
</div>


                <?php 
            if($fetch_data_notifications->num_rows()>0)
            {
                foreach($fetch_data_notifications->result() as $row)
                { 
                    if($row->notif_type=="user")
                    {
        ?>
                <?php 
                        if($row->admin_view=="notified")
                        {  
                        ?>
                <div href="#"
                    class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item-secondary flex-column align-items-start">
                    <?php 
                        }else{ 
                    ?>
                    <div href="#"
                        class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item flex-column align-items-start">
                        <?php 
                    } ?>
                        <div class="d-flex w-100 justify-content-between">
                          
                        <br>
                            <a class="btn btn-link btn-outline-info fa fa-eye justify-content-center"
                            onclick="<?php $seen= array("admin_view" => "seen");
                                              $this->db->where("id",$row->id);
                                              $this->db->update("notifications",$seen);
                                              ?>" href="<?php echo base_url('profile/');echo $row->user_id;  ?>"></a></a>

                        </div>
                        <p class="mb-1"><?php echo $row->notif_name; ?> with user ID number:
                            <?php echo  $row->user_id ?>. Click to view more details</p>
                            <br>
                            <small class="text-muted"><?php echo date('F j, Y h:i A',strtotime($row->created_at)); ?></small>
                    </div>
                    <?php } ?>
                    <?php
                    if($row->notif_type=="report")
                    {
                ?>
                    <?php 
                        if($row->admin_view=="notified")
                        {  
                        ?>
                    <div href="#"
                        class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item-secondary flex-column align-items-start">
                        <?php 
                        }else{ 
                    ?>
                        <div href="#"
                            class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item flex-column align-items-start">
                            <?php 
                    } ?>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-2 text-uppercase"></h5>

                                <br>
                                <a class="btn btn-link btn-outline-info fa fa-eye justify-content-center" onclick="<?php $seen= array("admin_view" => "seen");
                                              $this->db->where("id",$row->id);
                                              $this->db->update("notifications",$seen);
                                              ?>" href="<?php echo base_url('reports'); ?>"></a>

                            </div>
                            <p class="mb-1"><?php echo $row->notif_name; ?>. Report id number:
                                <?php echo  $row->report_id ?>. Click to view more details</p>
                                <br>
                                    <small class="text-muted"><?php echo date('F j, Y h:i A',strtotime($row->created_at)); ?></small>
                        </div>
                        <?php } ?>
                        <?php
                    if($row->notif_type=="event")
                    {
                ?>
                        <?php 
                        if($row->admin_view=="notified")
                        {  
                        ?>
                        <div href="#"
                            class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item-secondary flex-column align-items-start">
                            <?php 
                        }else{ 
                    ?>
                            <div href="#"
                                class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item flex-column align-items-start">
                                <?php 
                    } ?>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-2 text-uppercase">
                                      </h5>

                                    <br>
                                    <a class="btn btn-link btn-outline-info fa fa-eye justify-content-center" onclick="<?php $seen= array("admin_view" => "seen");
                                              $this->db->where("id",$row->id);
                                              $this->db->update("notifications",$seen);
                                              ?>" href="<?php echo base_url('eventview/');echo $row->booking_id;  ?>"></a>

                                </div>
                                <p class="mb-1"><?php echo $row->notif_name; ?>, Booking Reference
                                    number <?php echo  $row->booking_id ?>. Click to view more details</p>
                                    <br>
                                    <small class="text-muted"><?php echo date('F j, Y h:i A',strtotime($row->created_at)); ?></small>
                            </div>
                            <?php } ?>

                            <?php
                    if($row->notif_type=="package")
                    {
                ?>
                            <?php 
                        if($row->admin_view=="notified")
                        {  
                        ?>
                            <div href="#"
                                class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item-secondary flex-column align-items-start">
                                <?php 
                        }else{ 
                    ?>
                                <div href="#"
                                    class="list-group-item mr-4 ml-4 mt-2 mb-2 list-group-item flex-column align-items-start">
                                    <?php 
                    } ?>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 text-uppercase"></h5>

                                        <br>
                                        <a class="btn btn-link btn-outline-info fa fa-eye justify-content-center" onclick="<?php $seen= array("admin_view" => "seen");
                                              $this->db->where("id",$row->id);
                                              $this->db->update("notifications",$seen);
                                              ?>" href="<?php echo base_url('services'); $row->package_id;  ?>"></a></a>

                                    </div>
                                    <p class="mb-1"><?php echo $row->notif_name; ?>.
                                        Package Reference number: <?php echo  $row->package_id ?>.</p>
                                    <br>
                                    <small class="text-muted"><?php echo date('F j, Y h:i A',strtotime($row->created_at)); ?></small>
                                </div>
                                <?php } ?>
                                <?php
            }
                }else{
        ?>
             <center>
                <img src="<?php echo base_url(); ?>/assets/img/nodata-found.png"class="m-1 w-50 h-50"/>
            </center>
                    
            <?php } ?>

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


</body>


</html>