@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card" style="width:600px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="header">User information</h5>
                    <div class="px-2">

                    </div>
                </div>                        
                    
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">Name</div>
                            <div class="col font-weight-bold"> {{$user->firstname.' '.$user->middlename.' '.$user->lastname}} </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">Birthdate</div>
                            <div class="col font-weight-bold">{{$user->birthdate}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">Email Address</div>
                            <div class="col font-weight-bold"> {{$user->email}}</div>
                        </div>
                    </li>
                    @if ($user->user_type == '1')
                        @if ($emp->emp_type == '1')
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Role</div>
                                    <div class="col font-weight-bold">Cashier</div>
                                </div>
                            </li>
                            
                        @elseif($emp->emp_type == '2')
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Role</div>
                                    <div class="col font-weight-bold">Marketing</div>
                                </div>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Date hired</div>
                                <div class="col font-weight-bold">{{ $emp->date_hired }}</div>
                            </div>
                        </li>
                    @elseif($user->user_type == '2')
                    
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">Phone Number</div>
                                <div class="col font-weight-bold">{{ $pat->phone_number }}</div>
                            </div>
                        </li>

                        @if ($pat->patron_type == '1')
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Role</div>
                                    <div class="col font-weight-bold">Driver</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Points</div>
                                    <div class="col font-weight-bold">

                                            @php
                                            $temp = '0';   
                                            @endphp
                                            
                                            @foreach ($credits as $c)
                                                @php
                                                    $temp = $temp + $c->points_earned;
                                                    echo $temp;
                                                @endphp
                                            @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">License</div>
                                    <div class="col font-weight-bold">
                                        @foreach ($driver as $d)
                                        @if ($d->driver_id == $user->user_id)
                                            {{ $d->license }}
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @elseif($pat->patron_type == '2')
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Role</div>
                                    <div class="col font-weight-bold">Conductor</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Experience</div>
                                    <div class="col font-weight-bold">
                                            @foreach ($cond as $c)
                                            @if($c->conductor_id == $user->user_id)
                                                
                                                    {{ $c->cond_experience }}
                                                
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">Assigned to</div>
                                    <div class="col font-weight-bold">
                                            @foreach ($conAs as $assign)
                                            @if ($assign->conductor_id == $pat->patron_id && $assign->status == '1')
                                                @php
                                                    $driver = $assign->driver_id;
                                                    $driver_name = $assTo->find($driver);
                                                    echo $driver_name->firstname.' '.$driver_name->middlename.' '.$driver_name->lastname;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endif
                </ul>
                <div class="card-footer">
                    <div class="row" style="margin-left:50px;padding:20px;">
                        <center>
                        <a href={{ url('/user/edit/'.$user->user_id) }} class="btn btn-primary" role="button" aria-pressed="true" style="width:150px;margin-right:40px;" >Edit</a>
                        <a href={{ url('/admin/changePassword/'.$user->user_id) }} class="btn btn-danger" role="button" aria-pressed="true" style="width:150px">Change Password</a>
                        </center>
                    </div>
                </div>
        </div>
    </div>
@endsection