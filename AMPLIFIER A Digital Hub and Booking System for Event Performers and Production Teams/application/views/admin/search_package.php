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
                <div class="container-fluid">
                    <!-- Header Start -->
                    <div class="col-md-2 col-lg-6 mx-auto">
                        <div class="card shadow mb-4">
                            <div class="card-body center">
                                <form class="form-inline md-form form-sm mt-0" method="post" action="<?php echo base_url('search_results_package')?>">
                                <select class="form-control form-control-sm ml-3 w-75" name="user_id" id="user_id" >
                                <option selected disabled>Select Packages from:</option>
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
                                </select>
                                <button class="btn btn-outline-success btn-sm" type="submit"><i class="fas fa-search"></i></button>
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
                                            <a href="profile/<?php echo $row->user_id; ?>" class="text-secondary text-center">
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
                                            <a href="#" class="btn fa fas-trash btn-danger" data-toggle="modal"
                                                data-target="#delpack<?php echo $row->package_id; ?>"><span
                                                    class="fa fa-trash"></span></a>
                                         <a href="<?php echo base_url('addevents/'); echo $row->package_id ?>" class="btn btn-primary text-white"><i class="fas fa-book"></i></a>
                                        </div>
                                        <div class="text-center font-weight-light font-italic">Date Created:
                                            <?php echo  date('F d, Y', strtotime($row->date_created)); ?><br></div>
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
                                            <a href="delete_package/<?php echo $row->package_id; ?>" type="button">
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
                    </div>

                    <br>
                    <!-- pagination Start -->
                    <div class="row">



                        <div class="col-sm-12 col-md-12 offset-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1
                                to 3 of 57 entries</div>
                        </div>

                        <div class="col-sm-12 col-md-12 offset-4">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                        <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="dataTable"
                                            data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="dataTable_next"><a href="#"
                                            aria-controls="dataTable" data-dt-idx="7" tabindex="0"
                                            class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php
            }
            else
            {
            ?>
                    <h1 align="center">No Data Found</h1>
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

</html>