<?php 
// print_r($this->session->userdata());
	if(!$this->session->userdata('user_type') && $this->session->userdata('user_id')){
		redirect('block_page');
	}
?>

<?php if($this->session->userdata('user_type') == 'client' || $this->session->userdata('user_type') == null): ?>

<?php
	$notif_badge = $this->Notification_model->notification_badge();
	$reminder = $this->Profile_model->check_event_reminder();

	// session_start();
	if(!isset($_SESSION['theme'])){
		$theme = $_SESSION['theme'] = 'flatly';
	}else{
		if (isset($_GET['f'])){
			if($_GET['f'] == 1){
				$theme = $_SESSION['theme'] = 'darkly';				
			}else{
				$theme = $_SESSION['theme'] = 'flatly';
			}
		}else{
			$theme = $_SESSION['theme'];
		}
	}
	$f = $theme == 'flatly' ? '1' : '0';
	// $page = 'localhost'.$_SERVER['REQUEST_URI'].'?f='.$f;
	$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME).'?f='.$f;
	// echo '<br><br>';
	// print(pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title ?></title>
	<link rel="icon" href="<?php echo base_url();?>assets/img/website/logo.png">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/api/DataTables/datatables.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-flatly.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-<?php echo $theme == 'darkly' ? 'darkly' : 'flatly'; ?>.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/floating-labels.css"> -->
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/api/fontawesome/css/all.css">
	<script defer src="<?php echo base_url(); ?>assets/api/fontawesome/js/all.js"></script>
	<script defer src="<?php echo base_url(); ?>assets/api/fontawesome/js/brands.js"></script>
	<script defer src="<?php echo base_url(); ?>assets/api/fontawesome/js/solid.js"></script>
	<script defer src="<?php echo base_url(); ?>assets/api/fontawesome/js/fontawesome.js"></script>


	<link href="<?php echo base_url(); ?>assets/api/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/api/fontawesome/css/brands.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/api/fontawesome/css/solid.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-materia.css"> -->
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded-bottom">
		    <div class="container">
		        <a class="navbar-brand" href="<?php echo base_url()?>profile">
					<img src="<?php echo base_url(); ?>assets/img/website/logo1.png" height="25" alt=""> 
				</a>
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		        </button>

		        <div class="collapse navbar-collapse" id="navbarSupportedContent">
			        <ul class="navbar-nav mr-auto">
						<?php if($this->session->userdata('user_id')): ?>
							<li class="nav-item <?php echo $this->uri->segment(1) == 'profile' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>profile">Dashboard</a>
							</li>
							<li class="nav-item <?php echo $this->uri->segment(1) == 'c_events' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>c_events">Booked</a>
							</li>
							<!-- <li class="nav-item <?php echo $this->uri->segment(1) == 'c_created_events' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>c_created_events">Events</a>
							</li> -->
							<!-- <li class="nav-item <?php echo $this->uri->segment(1) == 'c_event_add' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>c_event_add">Add Event</a>
							</li> -->
							<li class="nav-item <?php echo $this->uri->segment(1) == 'history_client' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>history_client">History</a>
							</li>
							<li class="nav-item <?php echo $this->uri->segment(1) == 'booking' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>booking">Package</a>
							</li>
							<li class="nav-item <?php echo $this->uri->segment(1) == 'calendar' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>clients/calendar">Calendar</a>
							</li>
							<li class="nav-item <?php echo $this->uri->segment(1) == 'search' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>clients/search">Search</a>
							</li>
							<!-- <li class="nav-item <?php echo $this->uri->segment(1) == 'package' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>package">Package</a>
							</li> -->
							<!-- <li class="nav-item <?php echo $this->uri->segment(1) == 'c_chat' ? 'active' : '' ?>">
								<a class="nav-link" href="<?php echo base_url()?>c_chat">Chat</a>
							</li> -->
						<?php endif; ?>
			        </ul>
			        <form class="form-inline my-2 my-lg-0" method="POST" action="#">
			            <ul class="navbar-nav">
				            <!-- <li class="nav-item">
					            <a href="<?php// echo $page ?> " class="nav-link"  data-toggle="tooltip" data-placement="bottom" title="Dark Mode: <?php// echo $theme == 'flatly' ? 'OFF' : 'ON' ?>"><i class="fas fa-toggle-<?php echo $theme == 'flatly' ? 'off' : 'on' ?> fa-lg"></i></a>
				            </li> -->
							<?php if(!$this->session->userdata('user_id')): ?>
								<li class="nav-item">
									<a href="<?php echo base_url()?>login" class="nav-link">Login</a>
								</li>
								<li class="nav-item">
									<a data-toggle="modal" data-target="#registerModal" class="nav-link">Register</a>
								</li>
							<?php endif; ?>
							<?php if($this->session->userdata('user_id')): ?>
								<li class="nav-item <?php echo $this->uri->segment(1) == 'user_notifications' ? 'active' : '' ?>">
									<a href="<?php echo base_url() ?>notifications/index" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Notifications"><?php if($notif_badge > 0): ?><span class="badge badge-pill badge-light mr-1"><?php echo $notif_badge ?></span><?php endif; ?><i class="far fa-bell fa-lg"></i></a>
								</li>
								<li class="nav-item <?php echo $this->uri->segment(1) == 'c_chat' ? 'active' : '' ?>">
									<a href="<?php echo base_url()?>c_chat" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="far fa-envelope fa-lg"></i></a>
								</li>
								<li class="nav-item ">
									<a href="<?php echo base_url()?>profile_info" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->session->userdata('fname'); echo ' '.$this->session->userdata('lname'); ?>"><img src="<?php echo base_url(); ?><?php echo $this->session->userdata('photo')?>" width="25" height="25" class="rounded-circle" alt=""></a>
								</li>
								<li class="nav-item ">
									<a href="<?php echo base_url()?>logout_user" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fas fa-sign-in-alt fa-lg"></i></a>
								</li>
							<?php endif;?>
			        	</ul>
			        </form>
		        </div>


		    </div>
		  </nav>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register, switch one?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-around">
			<div class="row">
				<div class="col-md-6">
					<a href="<?php echo base_url()?>register" class="btn btn-info">Client</a>
				</div>
				<div class="col-md-6">
					<a href="<?php echo base_url()?>p_register" class="btn btn-primary">Performer</a>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>

<?php elseif($this->session->userdata('user_type') == 'performer'): ?>
	<?php $this->load->view('inc/header-performer'); ?>
<?php endif;?>

<!-- end header -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
                    <!-- Header Start -->
                    <div class="col-md-2 col-lg-6 mx-auto">
                        <div class="card shadow mb-4">
                            <div class="card-body center">
                                <form class="form-inline md-form form-sm mt-0" method="get" action="<?php echo base_url('c_search')?>">
                                <select class="form-control form-control-sm ml-3 w-75" name="user_id" id="user_id" >
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
                                            
                                            <a class="text-secondary text-center">
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
                                        <?php if($row->booked=="1"){ ?>
                                            <a class="btn btn-secondary text-white disabled" disabled>
                                            <i class="fas fa-window-close" disabled></i></a>
                                            </div>
                                        
                                        <?php }else{ ?>
                                         <a href="<?php echo base_url('booking_book_event/'); echo $row->package_id ?>" class="btn btn-primary text-white">
                                            <i class="fas fa-book"></i></a>
                                            </div>
                                        <?php } ?>
                                       
                                        
                                        <div class="text-center font-weight-light font-italic">Date Created:
                                            <?php echo  date('F d, Y h:', strtotime($row->date_created)); ?><br></div>
                                    </div>
                                </div>
                            </div>
                          
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


            <script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/api/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/datatables.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/custom-flatly.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bs-custom-file-input.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>

	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>

	<script>
	    // For dataTable
		$(document).ready(function() {
		    $('#datatable').DataTable( {     
		        // ajax: 'https://api.myjson.com/bins/qgcu',
		        // drawCallback: function(settings){
		        //     var api = this.api();
		            
		        //     /* Add some tooltips for demonstration purposes */
		        //     $('td', api.table().container()).each(function () {
		        //        $(this).attr('title', $(this).text());
		        //     });

		        //     /* Apply the tooltips */
		        //     $('td', api.table().container()).tooltip({
		        //        container: 'body'
		        //     });          
		        // }  
		    });
		} );
	</script>
	<script>
		// File Input
		// Add the following code if you want the name of the file appear on select
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
	<script>
	    // Replace the <textarea id="editor1"> with a CKEditor
	    // instance, using default configuration.
	    CKEDITOR.replace( 'ckeditor' );
	</script>
	<script>
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
				// var url = $(this).data("href");
				// window.open(url);
			});
		});
	</script>

</body>
</html>