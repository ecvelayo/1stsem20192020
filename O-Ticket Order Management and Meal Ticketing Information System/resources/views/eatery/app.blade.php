<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <html>
    <head>
        <title>Eatery Homepage</title>
        <link rel="stylesheet" type="text/css" href="cashier_style.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.bootstrap4.min.js"></script>
        </head>




<body style="background-color: #ebebe3">
<nav class="navbar navbar-dark" style="background-color:#a23131;-webkit-box-shadow: 0 8px 6px -6px #999; -moz-box-shadow: 0 8px 6px -6px #999;
 box-shadow: 0 8px 6px -6px #999;">

<a class="navbar-brand" href="#"><img class="logo" src="imgs/logo.png" width="80px" height="70px"></a>

<a class=" text-white navbar-brand" href="/eatery/home" style="color:white;">Home</a>
  <a class=" text-white navbar-brand" href="/cashier/registerDriver" style="color:white;" >Driver Registration</a>
<a class=" text-white navbar-brand" href="/cashier/registerConductor" style="color:white;">Conductor Registration</a>
<a class=" text-white navbar-brand" href="#" style="color:white;">Registration Request</a>
<a class=" text-white navbar-brand" href="/cashier/redeemMeal" style="color:white;">Redeem Meal</a>






 
<ul class="nav navbar-nav navbar-right">  

<a href="{{ url('cashier') }}" class="btn btn-danger btn-sm" style="margin-top: 10px; margin-right:30px;">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</ul>
</nav>

  
  
  <body class="bg-light">
      <div class="container">
    @yield('content')
      </div>
  </body>
</html>

