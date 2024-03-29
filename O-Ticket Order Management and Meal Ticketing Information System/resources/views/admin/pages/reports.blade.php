@extends('layouts.admin')
@section('content')
    <div style="left:8%;right:2%;top:0%;bottom:0;position:relative;">
        @php
        $date = Carbon\Carbon::today('Asia/Singapore')->toDateString();
        @endphp
        <br>

        <h4>Transactions
        {{-- @foreach ($users as $user)
        @if (!empty($users->all() && $user->order_datetime == $date)) --}}
        {{-- <a href="{{ route('admin_export') }}" class="btn btn-sm btn-primary">Export</a> --}}
        {{-- @endif
        @endforeach --}}
        </h4>
        <br> 
        <table class="table table-responsive" style="width: 1000px">
            <thead>
                <tr>
                    <th scope="col" style="width:200px">Name</th>
                    <th scope="col" style="width:200px">Patron Type</th>
                    <th scope="col" style="width:200px">Meal Type</th>
                    <th scope="col" style="width:100px">No. of Passenger</th>
                    <th scope="col" style="width:200px">Cashier</th>
                    <th scope="col" style="width:200px">Date Redeemed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    {{-- @if($user->date_redeemed == $date) --}}
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
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
    </div>
@endsection