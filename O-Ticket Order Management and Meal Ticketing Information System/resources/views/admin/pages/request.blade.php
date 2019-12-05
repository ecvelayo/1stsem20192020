@extends('layouts.admin')
@section('content')
<div style="left:8%;right:2%;top:0%;bottom:0;position:relative;">
    <br>
        <h4>Pending Registrations and Deactivated Accounts</h4>
    <br>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width: 250px" >Name</th>
                <th scope="col" style="width: 150px" >Patron Type</th>
                <th scope="col" style="width: 300px" >Date Registered</th>
                <th scope="col" >... </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if($user->user_type == '1')
                    <tr>
                        @foreach ($employee as $emp)
                        @if($user->user_id == $emp->employee_id)
                            @if($user->status == '0')
                                <td scope="col" > {{$user->firstname.' '.$user->middlename.' '.$user->lastname}}</td>
                                
                                <td scope="col" >
                                    @if($emp->emp_type == '1')
                                        Cashier
                                    @elseif($emp->emp_type == '2')
                                        Marketing
                                    @else
                                        Eatery
                                    @endif
                                </td>
                                
                                <td scope="col" > {{ $user->date_registered }} </td>
                                <td scope="col" >   
                                    <a class="btn btn-outline-primary" href="{{ url('/activate_request/'.$user->user_id) }}"> Accept </a>
                                    <a class="btn btn-outline-danger" href="{{ url('/delete_request/'.$user->user_id) }}"> Delete </a> 
                                </td>
                            @endif
                        @endif
                        @endforeach
                    </tr>
                @else
                    <tr>
                        @foreach ($patrons as $patron)
                        @if($user->user_id == $patron->patron_id)
                            @if($user->status == '0')
                                <td scope="col" > {{$user->firstname.' '.$user->middlename.' '.$user->lastname}}</td>
                                
                                <td scope="col" >
                                    @if($patron->patron_type == '1')
                                        Driver
                                    @else
                                        Conductor
                                    @endif
                                </td>
                                
                                <td scope="col" > {{ $user->date_registered }} </td>
                                <td scope="col" >   
                                    <a class="btn btn-outline-primary" href="{{ url('/activate_request/'.$user->user_id) }}"> Accept </a>
                                    <a class="btn btn-outline-danger" href="{{ url('/delete_request/'.$user->user_id) }}"> Delete </a> 
                                </td>
                            @endif
                        @endif
                        @endforeach    
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection