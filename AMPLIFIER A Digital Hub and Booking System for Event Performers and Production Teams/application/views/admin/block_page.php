<?php if($this->session->userdata('status') == 'block' || $this->session->userdata('status') == 'banned'|| $this->session->userdata('status') == 'hide'){
    
    }else{
       echo '<script> history.go(-1); </script>';
    
    } 
    
      
        $date_block =date("Y-m-d",strtotime($this->session->userdata('block_end')));
        $date_today = date("Y-m-d");

        if($this->session->userdata('status') != 'banned' ){

            if($date_block <= $date_today){
             //    echo $date_block <= $date_today;
             //     echo $date_block;
             //    echo $date_today;
             //    die;
             redirect('changeoff');
             }
        }  

   
     ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,autocorrect=off , shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link
        href="http://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">
    <script src="http://kit.fontawesome.com/ea7b3107fe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
</head>
<!-- Topbar Navbar -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/api/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-flatly.css"> -->

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


<nav class="navbar  m-1 navbar-expand-lg navbar-dark bg-dark rounded-bottom">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url()?>login">AMPLIFIER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" style="font-color:white" data-toggle="tooltip"
                    data-placement="bottom"><?php echo $this->session->userdata('fname'); echo ' '.$this->session->userdata('lname');?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tooltip" data-placement="bottom"
                    title="<?php echo $this->session->userdata('fname'); echo ' '.$this->session->userdata('lname'); ?>"><img
                        src="<?php echo base_url(); ?><?php echo $this->session->userdata('photo')?>" width="25"
                        height="25" class="rounded-circle" alt=""></a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url()?>logout_user" class="nav-link text-white" data-toggle="tooltip"
                    data-placement="bottom" title="Logout"><i class="fas fa-sign-in-alt fa-lg"></i>&nbsp Logout</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <img src="<?php echo base_url(); ?>assets/img/block.png" alt="image"
        class="h-25 w-10 mt-5 rounded mx-auto d-block"></a>
    <?php 
        if($this->session->userdata('status')=="banned"){ 
    ?>
    <h3 class="text-center text-dark font-weight-bold" style="font-family:helvetica">Your account has been terminated</h3>
    <?php }
        else if($this->session->userdata('status')=="hide"){ 
    ?>
    <h3 class="text-center text-dark font-weight-bold" style="font-family:helvetica">Your account has been deleted</h3>
        <?php }else{ ?>
        <br>
        <br>
        <h3 class="text-center text-dark font-weight-bold" style="font-family:helvetica">Your account has been suspended
            from amplifier until</h3>
        <h4 class="text-center text-info ">
            <?php echo date("F d, Y",strtotime($this->session->userdata('block_end'))); ?></h4>
        <?php } ?>
        <br>
        <center> <a href="<?php echo base_url()?>logout_user" class=" btn btn-outline-secondary btn-lg active" role="button" aria-pressed="true"><i
                    class="fas fa-sign-in-alt fa-lg"></i> LOGOUT</a></center>
</body>
<br>
    <br>
    <br>
        <br>

<?php include('logout_modal.php'); ?>
</nav>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/sb-admin-2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/popper.js"></script>

<!-- Footer -->
<br>
    <br>
    <br>
        <br>
   
    
<footer class="bg-dark text-white-50  ">
    <div class="container text-center">
    <br>
        <br>
        <div class="form-group ">
            <h5>CONTACT US</h5>
            <br>
            <p class="text-center ">Email : Amplifier-repo@gmail.com/ gshockxd0@gmail.com
                <br> Contact Number : &emsp; 0950-560-7709/ 0912-705-5497</p>

            <br>
            <small class="text-center">Copyright &copy; AMPLIFIER 2019</small>
        </div>
    </div>
    <br>
        <br>



</footer>
</body>
<!-- End of Footer -->