@extends('layouts.admin')  
@section('content')
<div class="container">
    <br>
    <h4>Registrant's Information - Employee</h4>
    <br>                   
    {!! Form::open(['action' => 'RegistrationsController@storeEmployee', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
            {{Form::label('email', 'Email Address *')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        <div class="col-md-4">
            <label for="type">Are you a? *</label>
            <select class="form-control" name="type">
                <option value="1">Cashier</option>
                <option value="2">Marketing</option>
                <option value="3">Eatery</option>
            </select>
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