@extends('layouts.admin')  
@section('content')
<div class="container">

    <br>
    <h4>Edit Information - Driver</h4>
    <br>                    
    {!! Form::open(['action' => ['RegistrationsController@editProfileDriver', $user->user_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
    <div class="col-md-4">
        {{Form::label('firstname', 'First Name *')}}
        {{Form::text('firstname', $user->firstname, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('middlename', 'Middle Name')}}
        {{Form::text('middlename', $user->middlename, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('lastname', 'Last Name *')}}
        {{Form::text('lastname', $user->lastname, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
    </div>

    <div class="col-md-4">
        {{Form::label('birthday', 'Date of Birth *')}}
        {{Form::date('birthday', $user->birthdate, ['class' => 'form-control', 'required' => 'required'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('phone_number', 'Mobile Number')}}
    <div class="row">
    <div class="col-sm-3">
        {{Form::text('', '', ['class' => 'form-control', 'placeholder' => '+63' ,'value' => '+63' , 'readonly','color' => 'black'])}}
    </div>
    <div class="col-sm-9">
        {{Form::text('phone_number', $patron->phone_number, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '10', /*'required' => 'required'*/])}}
    </div>  
    </div>
    </div>
    <div class="col-md-4">
        {{Form::label('email', 'Email')}}
        {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('license', 'License')}}
        {{Form::text('license', $driver->license,['class' => 'form-control', 'placeholder' => 'Drivers License'])}}
    </div>
    </div>
    <br>
    {{-- <h4>Vehicle Information</h4>
    <div class="row">
        <div class="col-md-4">
            <label for="vehicle_type">Vehicle *</label>
            <select class="form-control" name="vehicle_type">
                <option value="V-Hire">V-Hire</option>
                <option value="Bus">Bus</option>
            </select>
        </div>
        <div class="col-md-4">
            {{Form::label('plate_number', 'Plate Number')}}
            {{Form::text('plate_number', '',['class' => 'form-control', 'placeholder' => 'Plate Number'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('owner_name', 'Owner Name')}}
            {{Form::text('owner_name', '',['class' => 'form-control', 'placeholder' => 'Operator Name'])}}
        </div>
    </div>
    <br>
    <br> --}}
    <div class="col text-center">
    <a href="{{ url('/user/profile/'.$user->user_id) }}" role="button" class="btn btn-outline-danger">Cancel</a>
        {{csrf_field()}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Update', ['class'=>'btn btn-outline-primary'])}}
        {!! Form::close() !!}
    </div>
     
</div>   
@endsection