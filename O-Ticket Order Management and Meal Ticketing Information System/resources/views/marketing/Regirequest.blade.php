<html>
    <head>
        <title>Account Request</title>
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



 <body style="background-color:white">
                 
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
@extends('layouts.employee')
@section('content')


            
<div class="container mb-5 mt-3" style="background-color:#badfdb;border-radius:10px">
    <br>
    <h1 class="lead" style="font-size: 30px;color: #555555;">Account Request</h1>
                     
                     <table class="table table-striped table-bordered mydataTable" style="width: 100%">
                     
                       <table id="mydataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        
            <thead>
                <tr>
                    <th scope="col" style="width: 200px;text-align:center;" >Name</th>
                    <th scope="col" style="width: 150px;text-align:center;" >Patron Type</th>
                    <th scope="col" style="width: 200px;text-align:center;" >Date Registered</th>
                    <th scope="col" style="width: 200px;text-align:center;" >Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    @foreach ($patrons as $patron)
                    @if($user->user_id == $patron->patron_id)
                        @if($user->status == '0')
                            <td scope="col" > {{$user->firstname}}{{$user->middlename}}{{$user->lastname}} </td>
                            
                            <td scope="col" >
                                @if($patron->patron_type == '1')
                                    Driver
                                @else
                                    Conductor
                                @endif
                            </td>
                            
                            <td scope="col" > {{ $user->date_registered }} </td>
                            <td scope="col" >   
                                <a class="btn btn-primary" href="{{ url('/cashier/cashier_activate_request/'.$user->user_id) }}"> Accept </a>
                                <a class="btn btn-danger" href="{{ url('/cashier/cashier_delete_request/'.$user->user_id) }}"> Delete </a> 
                            </td>
                        @endif
                    @endif
                    @endforeach    
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script>
  // Basic example
$(document).ready(function () {
  $('#mydataTable').DataTable({
    "pagingType": "simple_numbers"
  });
  $('.dataTables_length').addClass('bs-select');
});

    </script>

@endsection