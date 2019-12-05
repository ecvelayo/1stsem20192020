
<?php defined('BASEPATH') or exit('No direct script access allowed');
if($this->session->userdata('user_type') == 'admin'){
    $this->session->userdata('user_type') == 'admin';
    }else{
        redirect(base_url() ."profile");
    
} ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,autocorrect=on , shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- <link
        href="http://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
</head>