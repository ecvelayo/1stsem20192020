@extends('layouts.admin')
@section('content')
<div class="container">
    <br>
        <h4>Registration - Branch</h4>
    <br>                    
    {!! Form::open(['action' => 'RegistrationsController@storeBranch', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        <div class="col-md-4">
            {{Form::label('firstname', 'First Name *')}}
            {{Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('middlename', 'Middle Name')}}
            {{Form::text('middlename', '', ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('lastname', 'Last Name *')}}
            {{Form::text('lastname', '', ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
        </div>

        <div class="col-md-4">
            {{Form::label('birthday', 'Date of Birth *')}}
            {{Form::date('birthday', date('d-M-y'), ['class' => 'form-control', 'required' => 'required'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('phone_number', 'Mobile Number')}}
        <div class="row">
        <div class="col-sm-3">
            {{Form::text('', '', ['class' => 'form-control', 'placeholder' => '+63' ,'value' => '+63' , 'readonly','color' => 'black'])}}
        </div>
        <div class="col-sm-9">
            {{Form::text('phone_number', '', ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '10', /*'required' => 'required'*/])}}
        </div>  
        </div>
        </div>
        <div class="col-md-4">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('password', 'Password')}}
            {{Form::input('password', 'password', '',['class' => 'form-control', 'placeholder' => 'Password'])}}
        </div>
    </div>
    <br>
    <h4>Store Information</h4>
    <div class="row">
        <div class="col-md-4">
            <label for="type">What type of store? *</label>
            <select class="form-control" name="type">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </div>
        <div class="col-md-4">
            {{Form::label('business_permit', 'Business Permit')}}
            {{Form::text('business_permit', '',['class' => 'form-control', 'placeholder' => 'Business Permit'])}}
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col text-center">
        <a href="/admin" role="button" class="btn btn-outline-danger">Cancel</a>
        {{csrf_field()}}
        {{Form::submit('Register', ['class'=>'btn btn-outline-primary'])}}
        {!! Form::close() !!}
    </div>
</div>  
@endsection