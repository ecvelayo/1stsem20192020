@extends('layouts.employee')
@section('content')
@include('inc.message')
    <div class="container">
    <br>
        <h4>Registration Request List</h4>
    <br>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col" style="width: 200px" >Name</th>
                    <th scope="col" style="width: 150px" >Patron Type</th>
                    <th scope="col" style="width: 200px" >Date Registered</th>
                    <th scope="col" >... </th>
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

@endsection