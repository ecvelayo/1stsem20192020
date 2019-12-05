@extends('layouts.admin')
@section('content')
<div class="container">
    <br>
    <h4>Edit Information - Employee</h4>
    <br>                   
    {!! Form::open(['action' => ['RegistrationsController@editProfileEmployee', $user->user_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                {{Form::label('email', 'Email Address *')}}
                {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="col text-center">
            <a href="{{ url('/user/profile/'.$user->user_id) }}" role="button" class="btn btn-outline-danger">Cancel</a>
            {{csrf_field()}}
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update ', ['class'=>'btn btn-outline-primary'])}}
        </div>
    {!! Form::close() !!}
</div>   
@endsection