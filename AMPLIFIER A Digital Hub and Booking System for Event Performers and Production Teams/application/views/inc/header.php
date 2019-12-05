<?php
	//session_start();
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
	// unset($_SESSION['theme']);
	// print_r($_SESSION);

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
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/website/logo.png">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/api/DataTables/datatables.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-flatly.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-<?php echo $theme == 'darkly' ? 'darkly' : 'flatly'; ?>.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/api/css/fontawesome/all.css">
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
		        <a class="navbar-brand" href="profile">AMPLIFIER</a>
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		        </button>

		        <div class="collapse navbar-collapse" id="navbarSupportedContent">
			        <ul class="navbar-nav mr-auto">
			            <li class="nav-item active">
				            <a class="nav-link" href="profile">Profile <span class="sr-only">(current)</span></a>
			            </li>
			            <li class="nav-item">
				            <a class="nav-link" href="#">Notifications</a>
			            </li>
			            <li class="nav-item">
				            <a class="nav-link" href="#">Bookings</a>
			            </li>
			            <li class="nav-item">
				            <a class="nav-link" href="history">History</a>
			            </li>
			            <li class="nav-item">
				            <a href="pricing" class="nav-link">Pricing</a>
			            </li>
			            <li class="nav-item">
				            <a href="package" class="nav-link">Packages</a>
			            </li>
			            <li class="nav-item">
				            <a href="chat" class="nav-link">Chat</a>

			            </li>
			        </ul>
			        <form class="form-inline my-2 my-lg-0" method="POST" action="#">
			            <ul class="navbar-nav mr-auto">
				            <li class="nav-item mr-3">
					            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="No new messages"><i class="far fa-envelope h4"></i></a>
				            </li>
				            <li class="nav-item">
					            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Search Bands/Performers"><i class="fas fa-search h4"></i></a>
				            </li>
				            <li class="nav-item">
					            <a href="<?php echo $page ?> " class="nav-link"  data-toggle="tooltip" data-placement="bottom" title="Dark Mode: <?php echo $theme == 'flatly' ? 'OFF' : 'ON' ?>"><i class="fas fa-toggle-<?php echo $theme == 'flatly' ? 'off' : 'on' ?> h4"></i></a>
				            </li>
			        	</ul>
			        </form>
		        </div>


		    </div>
		  </nav>
		  <!-- <?php// require '../../inc/user.php'; ?> -->

