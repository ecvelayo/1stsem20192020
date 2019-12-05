<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <html>
    <head>
        <title>Cashier Meal Request</title>
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

<a class=" text-white navbar-brand" href="/eatery/home" style="color:white;">Redeem Meal</a>
<a class=" text-white navbar-brand" href="#" style="color:white;">Meal Request</a>
<a class=" text-white navbar-brand" href="#" style="color:white;">Add Meal</a>
<a class=" text-white navbar-brand" href="#" style="color:white;">Exports</a>

<ul class="nav navbar-nav navbar-right">  

<a href="{{ url('cashier') }}" class="btn btn-danger btn-sm" style="margin-top: 10px; margin-right:30px;">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</ul>
</nav>               

      
<div class="container mb-5 mt-3">
    <br>
    <h1 class="lead" style="font-size: 30px;color: #555555;"><u>Meal Request</u></h1>
                     
                     <table class="table table-striped table-bordered mydataTable" style="width: 100%">
                     
                       <table id="mydataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        
            <thead>
                <tr>
                    <th scope="col" style="width: 200px;text-align:center;" >Name</th>
                    <th scope="col" style="width: 150px;text-align:center;" >Patron Type</th>
                    <th scope="col" style="width: 200px;text-align:center;" >Date Registered</th>
                    <th scope="col" style="width: 200px;text-align:center;" >Meal Type</th>
                    <th scope="col" style="width: 200px;text-align:center;" >Action </th>
                </tr>
            </thead>
@extends('layouts.employee')
@section('content')
   
                
    @php
	$date = Carbon\Carbon::today('Asia/Singapore');
	
	@endphp
            <tbody>
     
	    @foreach($orders as $o)
	        @if($o->status == 0)
             @if($date->isSameDay($o->order_datetime) == 1)
	        <tr>

			        @foreach($user as $u)
				        @if($o->patron_id == $u->user_id)
					    <td>{{$u->firstname}}</td>
					    @if($u->patron_type == 1)
					    <td>Driver</td>
					    @else
					    <td>Coductor</td>
					    @endif
				        @endif
			        @endforeach
			<td>{{$o->order_datetime}}</td>
            <td scope="col" >   
                                <a class="btn btn-primary" href="{{ url('/cashier/redeem_accept/'.$o->order_id) }}"> Accept </a>
                                <a class="btn btn-danger" href="{{ url('/cashier/redeem_delete/'.$o->order_id) }}"> Delete </a> 
                            </td>
		        @endif
		    </tr>
	        @endif
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