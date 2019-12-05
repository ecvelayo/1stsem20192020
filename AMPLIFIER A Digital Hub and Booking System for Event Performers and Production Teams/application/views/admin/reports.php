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
                            <form class="form-inline md-form form-sm mt-0" method="post" action="<?php echo base_url('reports')?>">
                            <input class="form-control form-control-sm ml-3 mb-5 w-75" name="name" id="name" placeholder="Input Event Name or Reporter Name" ></input>
                            <select class="form-control form-control-sm ml-3 w-75" name="user_id" id="user_id" >
                            <option selected disabled>Select Reports that include:</option>
                            <option value="*">All Reports</option>
                            <?php
                                if($fetch_data_user_report->num_rows()>0)
                                    {
                                    foreach($fetch_data_user_report->result() as $row)
                                        { 
                        
                            ?>
                            <option class="text-uppercase" value="<?php echo $row->user_id; ?>"> <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?>&nbsp <Label class="font-bold font-italic">(<?php echo $row->user_type; ?>)</Label></option>
                            <?php }
                                }
                                ?>
                            </select>
                            <button class="btn btn-outline-success btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                                
                      
                    </div>
                </div>



                <!-- end -->
                <div class="row"> 
                        <div class="col-sm-12 col-md-12 offset-5">
                                <ul class="pagination">
                            <?php echo $pagination; ?></ul>
                     
                        </div>
                    </div>       
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
                        <?php if($row->report_photo!=''){ ?>
                                <img width="800" height="400">
                                        <source src="<?php echo base_url(); ?><?php echo $row->report_photo; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </img>
                        <? }else if($row->report_video!=''){ ?>
                            <video width="800" height="400" controls>
                                        <source src="<?php echo base_url(); ?><?php echo $row->report_photo; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                            <?php } ?>
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="card-text"> Report from: <br>
                                                        <label class="text-uppercase">
                                                        <?php echo $row->report_from_fname; ?>
                                                        <?php echo $row->report_from_lname; ?>
                                                        <label class="font-italic font-weight-bold">&nbsp (<?php echo $row->report_from_usertype; ?>)</label></label></p>
                                                </div>
                                                <?php if($row->report_from_usertype!='admin'){ ?>
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
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>Report to: <br>
                                                        <label class="text-uppercase">
                                                        <?php echo $row->report_to_fname; ?>&nbsp<?php echo $row->report_to_lname; ?>
                                                        <label class="font-italic font-weight-bold">&nbsp (<?php echo $row->report_to_usertype; ?>)</label></label>
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
                                                </div>
                                            </div>
                                            <!-- <h6 class="card-subtitle mb-2 text-muted">Report ID: <?php echo $row->report_id; ?></h6> -->
                                            <a href="<?php echo base_url('eventview/'); echo $row->booking_id; ?>"> Event Name:
                                                <?php echo $row->event_name; ?></a>
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
                         <center>
                            <img src="<?php echo base_url(); ?>/assets/img/nodata-found.png" class="m-3 w-50 h-75"/>
                         </center>
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
                <form method="post" action="<?php echo base_url('welcome/form_validation_report')?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="booking_id" class="col-4 col-form-label">Event Name <label class="text-danger">
                                *</label></label>
                        <select id="booking_id" name="booking_id" class="form-control ml-3 mr-3">
                            <?php
                                            if($fetch_data_history->num_rows()>0)
                                            {
                                            foreach($fetch_data_history->result() as $row)
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

                    <div class="form-group row">
                        <label for="report_to" class="col-4 col-form-label">Violator <label class="text-danger">
                                *</label></label>
                        <select id="report_to" name="report_to" class="form-control ml-3 mr-3">
                            <option value="" selected disabled>Select Violator</option>
                            <option value="client">CLIENT</option>
                            <option value="performer">PERFORMER</option>
                        </select>
                        <?php echo form_error("report_to"); ?>
                    </div>

                    <div class="form-group">
                        <label for="comment">Additional Info <label class="text-danger"> *</label></label>
                        <textarea type="text" name="report_info" class="form-control lg" id="comment" required \></textarea>
                    </div>
                    <!-- <label for="">Attach Evidence <label class="font-italic"> (Optional):</label></label>
                    <div class="custom-file">
                        <input type="file"
                            class="form-control-file <?php echo form_error('userfile') ? 'is-invalid' : ''; ?>"
                            name="userfile" id="customFile">
                        <small class="form-text text-muted font-italic">(File size must not exceed 20MB)</small>
                        <div class="invalid-feedback">
                            <div class="form-group"><?php echo form_error('userfile'); ?>
                            </div>
                        </div>
                        <br>


                    </div> -->
                    <div class="modal-footer">
                        <div class="custom-file">
                            <center>
                                <input type="submit" name="addreport" class="btn btn-success">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                            </center>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end -->


</html>