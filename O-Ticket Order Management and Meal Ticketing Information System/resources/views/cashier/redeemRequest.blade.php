@extends('layouts.employee')
@section('content')
@include('inc.message')
    <div class="container">
    <br>
        <h4>Redeem Request List</h4>
    <br>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col" style="width: 200px" >Name</th>
                    <th scope="col" style="width: 150px" >Patron Type</th>
                    <th scope="col" style="width: 200px" >Passenger Count</th>
                    <th scope="col" >... </th>
                </tr>
            </thead>
    @php
	$date = Carbon\Carbon::today('Asia/Singapore');
	
	@endphp
            <tbody>
     
	    @foreach($orders as $o)
        {!! Form::open(['action' => ['CashierPagesController@redeemAccept', $o->order_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

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
			<td>{{Form::text('no_of_passenger', '', ['class' => 'form-control', 'placeholder' => 'Passenger Count', 'required' => 'required'])}}</td>
            <td scope="col" >
                
                 {{Form::submit('Add', ['class'=>'btn btn-outline-primary'])}}
                 {!! Form::close() !!}
                 <a class="btn btn-danger" href="{{ url('/cashier/redeem_delete/'.$o->order_id) }}"> Delete </a> 
                            </td>
		        @endif
		    </tr>
	        @endif
        @endforeach
            </tbody>
        </table>

    </div>

@endsection