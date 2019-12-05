@extends('layouts.employee')

@section('content')
@include('inc.message')
    @php
        $date = Carbon\Carbon::today('Asia/Singapore')->toDateString();
    @endphp
    <br>
        <h4>Redeem Meal</h4>
    <br>                    
    {!! Form::open(['action' => 'CashierPagesController@submitRedeemed', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        <div class="col-md-4">
            {{Form::label('user_id', 'Name of Patron')}}
            <br>
            <select class="form-control" name="user_id" id="user_id">
                @foreach($users as $u)
                @if ($u->status == '1')
                    
                            <option value="{{$u->patron_id}}">
                                {{$u->lastname}}, {{$u->firstname}} {{ $u->middlename}} 
                            </option>
                        
                @endif
                @endforeach
            </select>
        </div>   

        <div class="col-md-4">
            {{Form::label('no_of_passenger', 'Passenger Count *')}}
            {{Form::text('no_of_passenger', '', ['class' => 'form-control', 'placeholder' => 'Passenger Count', 'required' => 'required'])}}
        </div>

        <div class="col-md-4">
            {{Form::label('food', 'Meal or Snacks')}}
            <br>
            <select class="form-control" name="food" id="food">
                @foreach($item as $i)
                    @if($i->category == 'Meal' || $i->category == 'Snacks')
                        <option value="{{$i->item_id}}">
                            {{$i->name}} - {{$i->category}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            {{Form::label('drink', 'Drinks')}}
            <br>
            <select class="form-control" name="drink" id="drink">
                <option value='None'>None</option>
                    @foreach($item as $i)
                        @if($i->category == 'Drinks')
                            <option value="{{$i->item_id}}">
                                {{$i->name}} - {{$i->category}}
                            </option>
                        @endif
                    @endforeach
            </select>
        </div>
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-12 text-center">
            <a href="/cashier" role="button" class="btn btn-outline-danger">Cancel</a>
            {{csrf_field()}}
            {{Form::submit('Redeem', ['class'=>'btn btn-outline-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>			
@endsection