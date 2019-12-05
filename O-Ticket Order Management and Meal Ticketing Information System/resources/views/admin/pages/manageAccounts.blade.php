@extends('layouts.admin')
@section('content')
    <div style="left:8%;right:2%;top:0%;bottom:0;position:relative;">
        <br>
        <h4>Account List</h4>
        <br>
        <table class="table table-responsive" style="width: 1000px">
            <thead>
                <tr>
                    <th scope="col" style="width: 250px" > Name </th>
                    <th scope="col" style="width: 200px" > Type </th>
                    <th scope="col" style="width: 200px" > Status </th>
                    <th scope="col"> ... </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->user_type == '0' || $user->status == '0')
                    @else
                    <tr>
                        <td scope="col" > {{$user->firstname.' '.$user->middlename.' '.$user->lastname}} </td>
                        <td scope="col" >
                            @if ($user->user_type == '1')
                                @foreach ($emp as $e)
                                    @if($user->user_id == $e->employee_id)
                                        @if ($e->emp_type == '1')
                                            Cashier
                                        @elseif($e->emp_type == '2')
                                            Marketing
                                        @elseif($e->emp_type == '3')
                                            Accounting
                                        @elseif($e->emp_type == NULL)
                                            
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @foreach ($pat as $p)
                                    @if($user->user_id == $p->patron_id)
                                        @if($p->patron_type == '1')
                                            Driver
                                        @elseif($p->patron_type == '2')
                                            Conductor
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td scope="col" > 
                            @if($user->status == '1')
                                Active
                            @endif    
                        </td>
                        <td scope="col" >
                        <a class="btn btn-outline-info" href="{{ url('/user/profile/'.$user->user_id) }}"> Profile </a>
                            <a class="btn btn-outline-danger" href="{{ url('/deactivate_account/'.$user->user_id) }}"> Deactivate </a> 
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection