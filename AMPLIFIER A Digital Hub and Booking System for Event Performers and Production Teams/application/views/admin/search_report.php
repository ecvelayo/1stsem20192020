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

                <!-- Page Heading -->
                <div class="col-md-2 col-lg-6 mx-auto">
                    <div class="card shadow mb-4">
                        <div class="card-body center">
                            <form class="form-inline md-form form-sm mt-0" method="post" action="<?php echo base_url('welcome/search_results_report')?>">
                            <select class="form-control form-control-sm ml-3 w-75" name="user_id" id="user_id" >
                            <option selected disabled>Select Reports that include:</option>
                            <?php
                                if($fetch_data_user->num_rows()>0)
                                    {
                                    foreach($fetch_data_user->result() as $row)
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
                                
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"
                            data-toggle="modal" data-target="#addrep">
                            <i class="fas fa-envelope fa-sm text-white-50"></i> Create Report</a>
                    </div>
                </div>



                <!-- end -->
                <div class="container">
                    <div class="row">
                        <?php 
                            if($query_results_report->num_rows()>0)
                            {
                               foreach($query_results_report->result() as $row)
                                { 
                        ?>
                        <div class=" m-4 col-md-12">

                            <div class="card col-md-12 w-75 mx-auto" style="">
                                <img src="<?php echo base_url(); ?><?php echo $row->report_photo; ?>"
                                    class="card-img-top" alt="...">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="card-text"> Report from:
                                                        <?php echo $row->report_from_fname; ?>
                                                        <?php echo $row->report_from_lname; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn fa fa-list-ul dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <div class="dropdown-header">Action:</div>
                                                        <a class="dropdown-item fas fa-eye fa-fw"
                                                            href="profile/<?php echo $row->report_from; ?>">&nbsp View
                                                            Profile</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item fas fa-exclamation-triangle fa-fw"
                                                            href="#" data-toggle="modal"
                                                            data-target="#addoff<?php echo $row->report_from; ?>">&nbsp
                                                            Select offense</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item fas fa-exclamation-circle fa-fw"
                                                            href="#" data-toggle="modal"
                                                            data-target="#blckuser<?php echo $row->report_from; ?>">&nbsp
                                                            Block</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>Report to:
                                                        <?php echo $row->report_to_fname; ?>&nbsp<?php echo $row->report_to_lname; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn fa fa-list-ul dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <div class="dropdown-header">Action:</div>
                                                        <a class="dropdown-item fas fa-eye fa-fw"
                                                            href="profile/<?php echo $row->report_to; ?>">&nbsp View
                                                            Profile</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item fas fa-exclamation-triangle fa-fw"
                                                            href="#" data-toggle="modal"
                                                            data-target="#addoff<?php echo $row->report_to; ?>">&nbsp
                                                            Select offense</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item fas fa-exclamation-circle fa-fw"
                                                            href="#" data-toggle="modal"
                                                            data-target="#blckuser<?php echo $row->report_to; ?>">&nbsp
                                                            Block</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <h6 class="card-subtitle mb-2 text-muted">Report ID: <?php echo $row->report_id; ?></h6> -->
                                            <a href="eventview/<?php echo $row->booking_id; ?>"> Event ID:
                                                <?php echo $row->booking_id; ?></a>
                                        </li>

                                        <li class="list-group-item">
                                            <p class="card-text"> <b>REPORT DETAILS:</b></p>
                                        </li>

                                        <li class="list-group-item">
                                            <p class="card-text"> <?php echo $row->report_details; ?></p><br><br>
                                        </li>

                                        <li class="list-group-item mx-auto">
                                            <a href="#" class="btn fa fas-trash btn-danger" data-toggle="modal"
                                                data-target="#delreport<?php echo $row->report_id; ?>"><span
                                                    class="fa fa-trash"></span></a>
                                                    <br>
                                        </li>
                                        <small class="text-center "><?php echo date('F j, Y g:i a',strtotime($row->date_reported)); ?></small>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- delete modal -->
                        <div class="modal fade" id="delreport<?php echo $row->report_id; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="delreport" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="deletereport"><b>DELETE REPORT</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <H5>Are you sure you want to delete report from:</H5> 
                                            <br><br><h4 class="text-center"><?php echo $row->report_from_fname;echo " "; echo $row->report_from_lname; ?></h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="delete_report/<?php echo $row->report_id; ?>" type="button">
                                            <button class="btn btn-danger">YES</button>
                                        </a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CANCEL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- Add violator Penalty Modal -->
                        <div class="modal fade" id="addoff<?php echo $row->report_to; ?>" aria-labelledby="addoff"
                            aria-hidden="true" style="width:1000px">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="add_offense/<?php echo $row->report_to; ?>">

                                        <div class="modal-header">
                                            <H5>SELECT OFFENSE </H5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="1"> &nbsp &nbsp 1st offense: Ban account
                                                    for 3 days </label>
                                            </div>
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="2"> &nbsp &nbsp 2nd offense: Ban account
                                                    for 30 days </label>
                                            </div>
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="3"> &nbsp &nbsp 3rd offense: Permanent
                                                    block of account</label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="add_offense/<?php echo $row->report_to; ?>" type="button"> <button
                                                    class="btn btn-danger">YES</button></a>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">CANCEL</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- block violator modal -->
                        <div class="modal fade" id="blckuser<?php echo $row->report_to; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="blckuser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        BLOCK USER
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <H5>Are you sure you want to permanently block
                                            <?php echo $row->report_to_fname; ?>&nbsp<?php echo $row->report_to_lname; ?>?
                                        </H5>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="ban/<?php echo $row->report_to; ?>" type="button">
                                            <button class="btn btn-danger">YES</button>
                                        </a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CANCEL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- Add reporter Penalty Modal -->
                        <div class="modal fade" id="addoff<?php echo $row->report_from; ?>" aria-labelledby="addoff"
                            aria-hidden="true" style="width:1000px">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="add_offense/<?php echo $row->report_from; ?>">

                                        <div class="modal-header">
                                            <H5>SELECT OFFENSE </H5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="1"> &nbsp &nbsp 1st offense: Ban account
                                                    for 3 days </label>
                                            </div>
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="2"> &nbsp &nbsp 2nd offense: Ban account
                                                    for 30 days </label>
                                            </div>
                                            <div class="form-check"> <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="offenseNo"
                                                        id="offenseNo" value="3"> &nbsp &nbsp 3rd offense: Permanent
                                                    block of account</label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="add_offense/<?php echo $row->report_from; ?>" type="button">
                                                <button class="btn btn-danger">YES</button></a>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">CANCEL</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- block reporter modal -->
                        <div class="modal fade" id="blckuser<?php echo $row->report_from; ?>" tabindex="-1"
                            role="dialog" aria-labelledby="blckuser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        BLOCK USER
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <H5>Are you sure you want to Permanently block
                                            <?php echo $row->report_from_fname; ?>&nbsp<?php echo $row->report_from_lname; ?>?
                                        </H5>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="ban/<?php echo $row->report_from; ?>" type="button"> <button
                                                class="btn btn-danger">YES</button></a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CANCEL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->



                        <?php
                         }
                        }
                        else
                        {
                        ?>
                        <h1 align="center">No Data Found</h1>
                        <?php
                        }
                    ?>







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


<!-- add modal -->
<div class="modal fade" id="addrep" tabindex="-1" role="dialog" aria-labelledby="addrep" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewd"><b>REPORT DETAILS</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url()?>welcome/form_validation_report">
                    <div class="form-group row">
                        <label for="report_from" class="col-4 col-form-label">Reporter's Name:</label>
                        <select id="report_from" name="report_from" class="form-control m-3">
                            <?php
                                            if($fetch_data_user->num_rows()>0)
                                            {
                                            foreach($fetch_data_user->result() as $row)
                                                { 
                                            ?>
                            <option value="<?php echo $row->user_id; ?>">
                                <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?></option>
                            <?php
                                            }
                                            }
                                            ?>
                        </select>
                        <?php echo form_error("report_from"); ?>
                    </div>

                    <div class="form-group row">
                        <label for="violator" class="col-4 col-form-label">Violator:</label>
                        <select id="violator" name="violator" class="form-control m-3">
                            <?php
                                            if($fetch_data_user->num_rows()>0)
                                            {
                                            foreach($fetch_data_user->result() as $row)
                                                { 
                                            ?>
                            <option value="<?php echo $row->user_id; ?>">
                                <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?></option>
                            <?php
                                            }
                                            }
                                            ?>
                        </select>
                        <?php echo form_error("report_to"); ?>
                    </div>

                    <div class="form-group row">
                        <label for="booking_id" class="col-4 col-form-label">Event Name:</label>
                        <select id="booking_id" name="booking_id" class="form-control m-3">
                            <?php
                                            if($fetch_data_event->num_rows()>0)
                                            {
                                            foreach($fetch_data_event->result() as $row)
                                                { 
                                            ?>
                            <option value="<?php echo $row->booking_id; ?>"><?php echo $row->event_name; ?></option>
                            <?php
                                            }
                                            }
                                            ?>
                        </select>
                        <?php echo form_error("booking_id"); ?>
                    </div>
                    <div class="form-group">
                        <label for="comment">Additional Info:</label>
                        <input type="text" name="report_info" class="form-control lg" id="comment" \>
                    </div>
                    <label for="userfile">Add Profile Picture</label>
                        <div class="custom-file">
                            <input type="file"
                                class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : ''; ?>"
                                name="userfile" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                            <div class="invalid-feedback">
                                < <div class="form-group"><?php echo form_error('userfile'); ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="custom-file">
                        <input type="submit" name="addreport" class="btn btn-success">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
</div>
<!-- end -->


</html>