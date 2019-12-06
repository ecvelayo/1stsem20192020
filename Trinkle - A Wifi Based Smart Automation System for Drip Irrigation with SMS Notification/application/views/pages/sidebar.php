
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" >
        <button class="btn btn-primary" id="menu-toggle">Menu</button>
            <div id="sidebar-top-text-div">
                  <b id="sidebar-top-text">Trinkle : A WiFi Based Smart Irrigation System with SMS Notification</b>
            </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
               <b> Hello, <?php  echo $_SESSION['username'];  ?> </b>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                <a class="dropdown-item" href="<?php echo base_url('Pages/load_account_information'); ?>">Account Information</a>
                <a class="dropdown-item">
                  <div class="sms-switch-box" >
                  Allow SMS 
                  <label class="switch">
                    <input type="checkbox" id="allow-sms-switch" onClick="update_receiveSMS();">
                    <span class="slider round"></span>
                  </label>
                </div>
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('Pages/logout'); ?>"><span class="oi oi-account-logout"></span> Log Out</a>
              </div>
            </li>
          </ul>
        </div>
</nav>
<div class="d-flex" id="wrapper">

    <!-- Sidebar bruh -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Trinkle System Menu</div>
      <div class="list-group list-group-flush">
        <a href="<?php echo base_url('Pages/main'); ?>" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="<?php echo base_url('Pages/load_system_logs'); ?>" class="list-group-item list-group-item-action bg-light">Latest Sensor Logs</a>
        <a href="<?php echo base_url('Pages/load_crop_specifications'); ?>" class="list-group-item list-group-item-action bg-light">Crop List and Specifications</a>
        <a href="<?php echo base_url('Pages/load_irrigation_data'); ?>" class="list-group-item list-group-item-action bg-light">Irrigation Data</a>
        <?php
          if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin'){
             
             echo "<a href='".base_url('Pages/load_userList')."' class='list-group-item list-group-item-action bg-light'>Admin User List</a>";

          }
        ?>
      </div>
    </div>

  
<script>
  $('document').ready(function(){
    console.log("bruh");
    

    <?php
      if(isset($_SESSION['receiveSMS'])){
        if($_SESSION['receiveSMS'] == 0){
          echo "$('#allow-sms-switch').prop('checked', false);";
          echo "$('#allow-sms-switch').checked = false;";
        }else{
          echo "$('#allow-sms-switch').prop('checked', 'checked');";
          echo "$('#allow-sms-switch').checked = true;";
        }
      }
    ?>
  });

  $(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
  });

  function update_receiveSMS(){
      var base_url = "<?php echo base_url()?>";
        $.ajax({
          url : base_url +"Pages/receiveSMS_update", 
          success: function() {
            
          },
          error: function(){
            alert("Error Updating SMS Status.");
          }
        }); 
    }
</script>
<!--Change Password Modal end-->
