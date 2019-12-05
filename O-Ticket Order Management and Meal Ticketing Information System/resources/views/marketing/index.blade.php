<html>
    <head>
        <title>Marketing Homepage</title>
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



<!--
<nav class="navbar navbar-dark" style="background-color:#5eb7b7;-webkit-box-shadow: 0 8px 6px -6px #999;-moz-box-shadow: 0 8px 6px -6px #999;
box-shadow: 0 8px 6px -6px #999;">
 
 
<a class="navbar-brand" href="#"><img class="logo" src="../imgs/final.png" width="80px" height="70px"></a> 


<a class=" text-white navbar-brand" href="/cashier/home" style="color:white;">Home</a>
  <a class=" text-white navbar-brand" href="/cashier/registerDriver" style="color:white;" >Driver Registration</a>
<a class=" text-white navbar-brand" href="/cashier/registerConductor" style="color:white;">Conductor Registration</a>
<a class=" text-white navbar-brand" href="#" style="color:white;">Registration Request</a>
<a class=" text-white navbar-brand" href="/cashier/redeemMeal" style="color:white;">Exports</a> 


 
<ul class="nav navbar-nav navbar-right">  

<a href="{{ url('cashier') }}" class="btn btn-danger btn-md" style="margin-top: 10px; margin-right:30px;">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</ul>-->
</nav><!--
<body style="background-color:white">
<div class="container mb-5 mt-3" style="background-color:#badfdb;border-radius:10px">
        <h1 class="lead" style="font-size: 30px;color: #555555;">Today's Patron</h1>
                        <table class="table table-striped table-bordered mydataTable" style="width: 100%" >
                        
                        <thead>
                               
                                 
                                    <table id="mydataTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead>
                                              <tr>
                                                <th class="th-sm">Name</th>
                                                <th class="th-sm">Patron Type</th>
                                                <th class="th-sm">Meal Type</th>
                                                <th class="th-sm">Number of passengers</th>
                                                <th class="th-sm">Cashier</th>
                                                <th class="th-sm">Date Redemmed</th>
                                              </tr>
                                 
                                            </thead>
                                            -->

@extends('layouts.marketing')
@section('content')
<div class="container">
        @php
            $date = Carbon\Carbon::today('Asia/Singapore')->toDateString();
        @endphp
        <br>
        <br>
            <h4>Today's Patron
                    {{-- @foreach ($users as $user)
                        @if (!empty($users->all() && $user->date_redeemed == $date)) --}}
                            <a href="{{ route('admin_export') }}" class="btn btn-sm btn-primary">Export</a>
                        {{-- @endif
                    @endforeach --}}
            </h4>
        <br> 
        <table class="table table-responsive" style="width: 1000px">
            <thead>
                <tr>
                    <th scope="col" >Name</th>
                    <th scope="col" >Patron Type</th>
                    <th scope="col" >Meal Type</th>
                    <th scope="col" >No. of Passenger</th>
                    <th scope="col" >Cashier</th>
                    <th scope="col" >Date Redeemed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    
                    @if($user->date_redeemed == $date)
                        <tr>
                            <td scope="col" > {{$user->firstname.' '.$user->middlename.' '.$user->lastname}} </td>
                            <td scope="col" >
                                @if($user->patron_type == '1')
                                    Driver
                                @else
                                    Conductor
                                @endif
                            </td>
                            <td scope="col" >
                                {{$user->meal_type}}
                            </td>  
                            <td scope="col" > {{$user->no_of_passenger}} </td>  
                            <td scope="col" >
                                @foreach( $emp as $e )
                                    @if($user->employee_id == $e->user_id)
                                        {{$e->firstname}}
                                    @endif
                                @endforeach
                            </td>
                            <td scope="col" > {{$user->date_redeemed}} </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

@endsection