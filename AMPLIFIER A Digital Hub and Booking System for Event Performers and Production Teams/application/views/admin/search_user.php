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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Filter Results</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                            data-toggle="modal" data-target="#adduser">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i> Add Users</a>
                    </div>

                    <!-- Page Heading -->
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
                                        <form method="post" action="<?php echo base_url('search_results')?>">
                                            <select name="usertype" class="btn btn-outline-info dropdown-toggle">
                                            <option selected disabled>Usertype</option>
                                                <option value="admin" <?php echo (isset($where['user_type']) && $where['user_type'] == 'admin') ? "selected" : ""; ?>>Admin</option>
                                                <option value="performer" <?php echo (isset($where['user_type']) && $where['user_type'] == 'performer') ? "selected" : ""; ?>>Performer</option>
                                                <option value="client" <?php echo (isset($where['user_type']) && $where['user_type'] == 'client') ? "selected" : ""; ?>>Client</option>
                                            </select>


                                            <select name="status" class="btn btn-outline-info dropdown-toggle">
                                            <option selected disabled>Status</option>
                                                <option value="verified" <?php echo (isset($where['status']) && $where['status'] == 'verified') ? "selected" : ""; ?>>Verified</option>
                                                <option value="block" <?php echo (isset($where['status']) && $where['status'] == 'block') ? "selected" : ""; ?>>Blocked</option>
                                                <option value="banned" <?php echo (isset($where['status']) && $where['status'] == 'banned') ? "selected" : ""; ?>>Banned</option>

                                            </select>

                                            <button class="btn btn-outline-success" type="submit"><i class="fas fa-arrow-right"></i>Sort</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
        if($query_results_user->num_rows()>0)
        {
          foreach($query_results_user->result() as $row)
          {
        ?>
                    <!--User Dropdown Card-->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                            style="margin-top:-10px">
                            <h6 class="m-0 font-weight-bold text-primary">ID: <?php echo $row->user_id; ?></h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelle
                                    dby="dropdownMenuLink">
                                    <div class="dropdown-header">Action:</div>
                                    <a class="dropdown-item fas fa-eye fa-fw"
                                        href="profile/<?php echo $row->user_id; ?>">&nbsp View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fas fa-exclamation-triangle fa-fw" href="#"
                                        data-toggle="modal" data-target="#addoff<?php echo $row->user_id; ?>">&nbsp Add
                                        offense</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fas fa-exclamation-circle fa-fw" href="#"
                                        data-toggle="modal" data-target="#blckuser<?php echo $row->user_id; ?>">&nbsp
                                        Block</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fas fa-trash-alt fa-fw" href="#" data-toggle="modal"
                                        data-target="#deluser<?php echo $row->user_id; ?>">&nbsp Delete</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="table responsive">
                                    <Table id="datatable" class="table table-reflow">
                                        <tr role="row" class="odd">
                                            <td><img src="<?php echo base_url(); ?><?php echo $row->photo; ?>"
                                                    style="height:150px; width:180px; border-radius:100px"></a></td>

                                            <td class="table-bordered">
                                                Name: <br>
                                                Username: <br>
                                                Usertype: <br>
                                                Offense number:<br>
                                                Current Status:<br>
                                                Date registered: <br>
                                                Last update: <br>
                                            </td>

                                            <td class="table-bordered">
                                                <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?><br>
                                                <?php echo $row->username; ?> <br>
                                                <?php echo $row->user_type; ?> <br>
                                                <?php echo $row->offense; ?> <br>
                                                <?php echo $row->status; ?> <br>
                                                <?php echo  date('F d, Y', strtotime($row->created_at)); ?> <br>
                                                <?php echo  date('F d, Y', strtotime($row->updated_at)); ?> <br>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- del user modal -->
                        <div class="modal fade" id="deluser<?php echo $row->user_id; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="deluser" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    DELETE USER
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <H5>Are you sure you want to delete
                                        <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?>?</H5>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo base_url('delete_user/'); echo $row->user_id; ?>" type="button"> <button
                                            class="btn btn-danger">YES</button></a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                    <!-- Add Penalty Modal -->
                    <div class="modal fade" id="addoff<?php echo $row->user_id; ?>" aria-labelledby="addoff"
                        aria-hidden="true" style="width:1000px">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="<?php echo base_url('add_offense/'); echo $row->user_id; ?>">

                                    <div class="modal-header">
                                        <H5>SELECT OFFENSE </H5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-check"> <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="offenseNo"
                                                    id="offenseNo" value="1"> &nbsp &nbsp 1st offense: Ban account for 3
                                                days </label>
                                        </div>
                                        <div class="form-check"> <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="offenseNo"
                                                    id="offenseNo" value="2"> &nbsp &nbsp 2nd offense: Ban account for
                                                30 days </label>
                                        </div>
                                        <div class="form-check"> <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="offenseNo"
                                                    id="offenseNo" value="3"> &nbsp &nbsp 3rd offense: Permanent block
                                                of account</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="<?php echo base_url('add_offense/'); echo $row->user_id; ?>" type="button"> <button
                                                class="btn btn-danger">YES</button></a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CANCEL</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end -->

                    <!-- block user modal -->
                    <div class="modal fade" id="blckuser<?php echo $row->user_id; ?>" tabindex="-1" role="dialog"
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
                                    <H5>Are you sure you want to Permanently block
                                        <?php echo $row->fname; ?>&nbsp<?php echo $row->lname; ?>?</H5>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo base_url('ban/'); echo $row->user_id; ?>" type="button"> <button
                                            class="btn btn-danger">YES</button></a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                    <?php
            }
            ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      
        </div>
        

        <?php
          }
          else
          {
          ?>
        <h1 align="center">No Data Found</h1>
        <?php
          }
          ?>
        <!-- end -->





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
</div>
<!-- Add User Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="ADDUSER" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-basic">
                <h5 class="modal-title" id="adduser">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url()?>welcome/form_validation" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="First Name">First Name:</label>
                        <input type="text" name="fname" class="form-control" id="fname">
                        <span class="text-danger"><?php echo form_error("fname"); ?></span>
                    </div>
                    <div>
                        <label for="Last Name">Last Name:</label>
                        <input type="text" name="lname" class="form-control" id="lname">
                        <span class="text-danger"><?php echo form_error("lname"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" name="password" class="form-control" id="Password">
                        <span class="text-danger"><?php echo form_error("password"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" id="username">
                        <span class="text-danger"><?php echo form_error("username"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="Contact_number1">Contact Numer (1):</label>
                        <input type="number" name="contact_number" class="form-control" id="contact_number">
                        <span class="text-danger"><?php echo form_error("contact_number"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="Contact_number1">Optional Contact Numer (2):</label>
                        <input type="number" name="contact_number1" class="form-control" id="contact_number1">
                        <span class="text-danger"><?php echo form_error("contact_number1"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="Contact_number1">Address:</label>
                        <input type="text" name="address" class="form-control" id="address">
                        <span class="text-danger"><?php echo form_error("address"); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <span class="text-danger"><?php echo form_error("email"); ?></span>
                    </div>
                   
                        <label for="">Add Profile Picture</label>
                        <div class="custom-file">
                            <input type="file"
                                class="custom-file-input <?php echo form_error('userfile') ? 'is-invalid' : ''; ?>"
                                name="userfile" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                            <div class="invalid-feedback">
                                 <div class="form-group"><?php echo form_error('userfile'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Usertype">Usertype:</label><br>
                        <select class="form-control" name="usertype" id="usertype" style="max-width:200px;">
                            <option value=""> </option>
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                            <option value="performer">Performer</option>
                        </select>
                        <span class="text-danger"><?php echo form_error("usertype"); ?></span>
                    </div>
                   

                    <div class="modal-footer">
                        <input type="submit" name="adduser" class="btn btn-success" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end -->




</html>