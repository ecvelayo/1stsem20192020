<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->


    <title>Cashier</title>
    </head>


    <nav class="navbar navbar-expand-lg navbar-info bg-info pl-5">

    <a class=" text-white navbar-brand" href="/cashier/home">Home</a>
	  <a class=" text-white navbar-brand" href="/cashier/registerDriver">Driver Registration</a>
    <a class=" text-white navbar-brand" href="/cashier/registerConductor">Conductor Registration</a>
    <a class=" text-white navbar-brand" href="#">Registration Request</a>
    <a class=" text-white navbar-brand" href="/cashier/redeemMeal">Redeem Meal</a>
    
  
  


  
     
    <ul class="nav navbar-nav navbar-right">  
    <button type="submit" class="btn btn-default btn-sm" style="margin-top: 5px; margin-right:30px; height:40px;"> 
    <a class="navbar-nav mr-4 text-white" href="{{ url('cashier') }}">Logout</a>
      
    </ul>
  </nav>
  
  <body class="bg-light">
      <div class="container">
    @yield('content')
      </div>
  </body>
</html>

