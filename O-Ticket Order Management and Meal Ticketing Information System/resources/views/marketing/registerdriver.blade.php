<head>
        <title> Driver Registration</title>
        <link rel="stylesheet" type="text/css" href="cashier_style.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../bootstrap-3.4.1-dist/bootstrap-sweetalert-master/dist/sweetalert.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.bootstrap4.min.js"></script>
        </head>
      
    <nav class="navbar navbar-dark" style="background-color:#5eb7b7;-webkit-box-shadow: 0 8px 6px -6px #999;-moz-box-shadow: 0 8px 6px -6px #999;
box-shadow: 0 8px 6px -6px #999;">

<a class="navbar-brand" href="#"><img class="logo" src="imgs/logo.png" width="80px" height="70px"></a>

<a class=" text-white navbar-brand" href="/cashier/home" style="color:white">Home</a>
  <a class=" text-white navbar-brand" href="/cashier/registerDriver" style="color:white">Driver Registration</a>
<a class=" text-white navbar-brand" href="/cashier/registerConductor" style="color:white">Conductor Registration</a>
<a class=" text-white navbar-brand" href="#" style="color:white">Registration Request</a>
<a class=" text-white navbar-brand" href="/cashier/redeemMeal" style="color:white">Exports</a> 
<ul class="nav navbar-nav navbar-right">  

<a href="{{ url('cashier') }}" class="btn btn-danger btn-sm" style="margin-top: 10px; margin-right:30px;">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</ul>
</nav>
<body style="background-color:white">
<div class="container mb-5 mt-3">
                  
                  <h1 class="lead" style="font-size: 30px;color:#5f6769;"><u>Registrant's Information- Driver</u></h1>

    
                  <div class="form-group col-md-4">
      <label for="inputFname" style="color:#5f6769;">First Name</label>
      <input type="text" class="form-control" id="fname" placeholder="First Name">
    </div>
    <div class="form-group col-lg-4">
      <label for="inputLname" style="color:#5f6769;">Last Name</label>
      <input type="text" class="form-control" id="lname" placeholder="Last Name">
    </div>
    <div class="form-group col-lg-4">
          <label for="inputMname" style="color:#5f6769;">Middle Name</label>
          <input type="text" class="form-control" id="mname" placeholder="Middle Name">
        </div>
        <div class="form-group col-md-2">
              <label for="inputbdat" style="color:#5f6769;">Date of Birth</label>
              <input type="date" class="form-control" id="bday" placeholder="MM-DD-YY">
            </div>
            <div class="form-group col-lg-3">
      <label for="inputLname" style="color:#5f6769;">Mobile Number</label>
      <input type="tel" class="form-control" id="num"  placeholder="Active Mobile Number">
    </div>
    
    <div class="form-group col-lg-4">
      <label for="inputLname" style="color:#5f6769;">License Number</label>
      <input type="text" class="form-control" id="num" placeholder="License Number">
    </div>
            <div class="form-group col-md-4">
                  <label for="inputAddress" style="color:#5f6769;">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="Street,Municipality,City">
                </div>
               
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputemail" style="color:#5f6769;">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="titay@example.com">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputPass" style="color:#5f6769;">Password</label>
                    <input id="password" type="password" class="form-control">
                     
                  </div>
                      
                  <div class="input-group id">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputphoto"><b>Upload ID picture:</b></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputphoto"
                        aria-describedby="inputphoto">
                     
                    </div>
                
                    <h1 class="lead" style="font-size: 30px;color:#5f6769;"><u>Vehicle Information</u></h1>

                    <div class="form-group col-md-2">
                    <label for="inputPass" style="color:#5f6769;">Vehicle Type</label>
                    <select class="form-control">
                        <option value="Ceres Bus">Ceres Bus</option>
                        <option value="Bus">Bus</option>
                        <option value="V-hire">V-hire</option>
                        <option value="jeep">Jeepney</option>
                        </select> </div>
                    
                <div class="form-group col-md-4">
                  <label for="platenumber" style="color:#5f6769;">Plate Number</label>
                  <input type="text" class="form-control" id="pnumber" placeholder="Vehicle Plate Number">
                </div>
                <div class="form-group col-md-4">
                  <label for="owner" style="color:#5f6769;">Vehicle Owner's Name</label>
                  <input type="text" class="form-control" id="ownername" placeholder="Owner's Name">
                </div>
                  </div>
                 
          
                      <div class="form-group col-lg-12" style="margin-top: 40px; left: 65vh;">
                          <a href="#" class="btn btn-danger" onclick="validation();">Submit</a>
                          <a href="cashier_home.html" class="btn btn-danger">Cancel </a>
                      </div> 
                      
  
</form>
</section>
</section>
</div>
</div>
</div>
