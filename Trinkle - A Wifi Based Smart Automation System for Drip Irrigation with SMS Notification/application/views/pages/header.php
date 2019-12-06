<!DOCTYPE html>
<html>

	<head>
		<title>Trinkle: A WIFI Based SMART Automation System for Plant Irrigation With SMS Notification</title>
		
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/simple-sidebar.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/open-iconic-bootstrap.css');?>">
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datatables.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.dataTables.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/rowReorder.dataTables.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/open-iconic-bootstrap.css');?>">

	<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
  	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/datatables.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.js');?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.responsive.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.rowReorder.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>



	<meta content="width=device-width, initial-scale=1" name="viewport" />

	</head>
	<body>
		<?php
			if(!isset($_SESSION)){
				session_start();
			}

			
		?>