<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('users') ?>">
        <div class="sidebar-brand-icon">
        <img class="img-profile rounded-circle" style="height:50px; weight:30px;" src="<?php echo base_url(); ?>/assets/img/logo.png">
        </div>
        <div class="sidebar-brand-text mx-3">AMPLIFIER</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Modules
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('users') ?>">
            <i class="fa fa-users"></i>
            <span>Users</span></a>
    </li>

    <!-- Events  -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('events') ?>">
            <i class="fa fa-calendar"></i>
            <span>Events</span></a>
    </li>
    <!-- Services  -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('services') ?>">
            <i class="fa fa-suitcase"></i>
            <span>Packages</span></a>
    </li>
    <!-- History  -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('history') ?>">
            <i class="fa fa-flag"></i>
            <span>History</span></a>
    </li>
    <!-- Reports  -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('reports') ?>">
            <i class="fa fa-exclamation-triangle"></i>
            <span>Reports</span></a>
    </li>
    <!-- Notifications  -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('notifications');?>">
            <i class="fa fa-list-alt"></i>
            <span>Notifications</span></a>
    </li>

    <!-- Messages -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('a_chat');?>">
            <i class="fa fa-envelope"></i>
            <span>Messages</span></a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-share-square"></i>
            <span>Logout</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div> -->

</ul>



<?php include('logout_modal.php'); ?>

<!-- End of Sidebar -->