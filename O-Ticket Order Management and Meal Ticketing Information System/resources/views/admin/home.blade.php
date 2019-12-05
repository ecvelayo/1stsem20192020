@extends('layout.app')
<nav class="navbar navbar-expand-lg navbar-info bg-info pl-5">
    <h2 class=" text-white navbar-brand">O-Ticket Administrator</h2>
    <div class="collapse navbar-collapse justify-content-end">    
    {{-- <p class="navbar-nav pr-2 text-white">Welcome Admin</p>  --}}
    {{-- <p class="navbar-nav mr-4 text-white">Logout<p> --}}
        <a href="{{ url('home') }}">Homepage</a>
    </div>
</nav>

@section('content')
<p class="mt-5">Site Administration</p>
    <div class="bg-white border border-white w-75">
        <div class="bg-info p-2">
            Manage Accounts
        </div>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">Driver and Conductor Accounts</a>
            <a href="#" class="list-group-item list-group-item-action">Company Accounts</a>
        </div>
    </div>
    <div class="bg-white border border-white w-75 mt-5">
            <div class="bg-info p-2">
                Manage Meals
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Add Meal</a>
                <a href="#" class="list-group-item list-group-item-action">View Meal</a>
            </div>
        </div>
        <div class="bg-white border border-white w-75 mt-5 mb-5">
                <div class="bg-info p-2">
                    Other options
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Manage Stablishment</a>
                    <a href="#" class="list-group-item list-group-item-action">View Transaction</a>
                    <a href="#" class="list-group-item list-group-item-action">Back up database</a>
                </div>
            </div>
@endsection