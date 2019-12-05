
<!DOCTYPE html>
<div lang="en">


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
                <div class="container-fluid">
                    <!-- Header Start -->
                    <div class="col-md-2 col-lg-6 mx-auto">
                        <div class="card shadow mb-4">
                            <div class="card-body center">
                                <form method="get" action="<?php echo base_url('services')?>">
                                <label for="date">Input Name: <br>
                                            <input class="form-control ml-3" style="width:500px" type="text" name="name" placeholder="E.g Package Name, performer name, package details" value="<?php echo (isset($where['name'])); ?>"></label>
                               <hr>
                                <label for="date">Select Performer: <br>         
                                <select class="form-control ml-3" style="width:500px" name="user_id" id="user_id" >
                                <option selected value=''>Select All Packages</option>
                                <?php
                                    if($fetch_data_perf->num_rows()>0)
                                        {
                                        foreach($fetch_data_perf->result() as $row)
                                            { 
                            
                                ?>
                                <option value="<?php echo $row->user_id; ?>"> <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?></option>
                                <?php }
                                    }
                                    ?>
                                </select></label>
                                <hr>
                                <br>
                                <button class="btn btn-outline-success btn-sm ml-3" type="submit"><i class="fas fa-search"></i>Search</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of header -->
                    <!-- content Start -->
                    <div class="container">
                        <div class="row mx-auto">

                            <?php 
                    if($query_results_package->num_rows()>0)
                    {
                        foreach($query_results_package->result() as $row)
                        {
                    ?>
                            <div class="col-sm-4 mb-3 col-md-4">
                                <div class="card border-secondary">
                                    <div class="card-body ">
                                        <h3 class="card-title">
                                            <img src="<?php echo base_url(); ?><?php echo $row->photo; ?>" alt="none"
                                                style="width:50px;height:50px; border-radius:30px">
                                            <a href="<?php echo base_url('profile/'); echo $row->user_id; ?>" class="text-secondary text-center">
                                                <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?><br></a>
                                        </h3>
                                        <hr>
                                        <p class="lead text-center">
                                            <b><?php echo $row->package_name; ?></b>
                                            <br><?php echo $row->price; ?><br><br>
                                        </p>
                                        <p class="card-text text-center"><?php echo $row->details; ?><br></p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center ">
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delpack<?php echo $row->package_id; ?>">
                                                <i class="fa fa-trash"></i></a>
                                        <?php if($row->booked=="1"){ ?>
                                            <a class="btn btn-secondary text-white disabled" disabled>
                                            <i class="fas fa-window-close" disabled></i></a>
                                            </div>
                                        
                                        <?php }else{ ?>
                                         <a href="<?php echo base_url('addevents/'); echo $row->package_id ?>" class="btn btn-primary text-white">
                                            <i class="fas fa-book"></i></a>
                                            </div>
                                        <?php } ?>
                                       
                                        
                                        <div class="text-center font-weight-light font-italic">Date Created:
                                            <?php echo  date('F d, Y h:', strtotime($row->date_created)); ?><br></div>
                                    </div>
                                </div>
                            </div>
                            <!-- event delete modal -->
                            <div class="modal fade" id="delpack<?php echo $row->package_id; ?>" tabindex="-1"
                                role="dialog" aria-labelledby="delpack" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            DELETE PACKAGE
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <H5>Are you sure you want to delete package by?</H5>
                                            <H4 class="text-center">
                                                <img src="<?php echo base_url(); ?><?php echo $row->photo; ?>"
                                                    alt="none" style="width:50px;height:50px; border-radius:30px">
                                                <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?>
                                            </H4>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo base_url('delete_package/'); echo $row->package_id; ?>" type="button">
                                                <button class="btn btn-danger">YES</button>
                                            </a>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">CANCEL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end -->
                            <?php
                    }
                ?>
                           
                        </div>
                        <div class="row"> 
                                <div class="col-sm-12 col-md-12 offset-5">
                                    <ul class="pagination">
                                    <?php echo $pagination; ?></ul>
                                </div>
                            </div>
                    </div>

                    <br>
                    <!-- pagination Start -->
                    <div class="row">

                    </div>
                    <br>
                    <?php
            }
            else
            {
            ?>
                    <center>
                        <img src="<?php echo base_url(); ?>/assets/img/nodata-found.png"class="m-3 w-75 h-100"/>
                    </center>
                    <?php
            }
            ?>




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

</div>