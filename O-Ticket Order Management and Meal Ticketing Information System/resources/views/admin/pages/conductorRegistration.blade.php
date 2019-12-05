@extends('layouts.admin')  
@section('content')
<div class="container">
    <br>
    <h4>Registrant's Information - Conductor</h4>
    <br>                    
    {!! Form::open(['action' => 'RegistrationsController@storeConductor', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                {{Form::label('cond_experience', 'Experience *')}}
                {{Form::text('cond_experience', '', ['class' => 'form-control', 'placeholder' => 'Experience', 'required' => 'required'])}}
            </div>
            
            <div class="col-md-4">
                {{Form::label('Assigned', 'Assigned *')}}
                <br>
                <select class="form-control" name="driver_id" id="driver_id">
                    @foreach($driver as $d)
                        @if ($d->status == '1' && $d->assigned == '0')   
                            <option value="{{$d->driver_id}}">
                                {{$d->firstname}} {{$d->middlename}} {{$d->lastname}}
                            </option>
                        @endif
                    @endforeach
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
        </div>
    {!! Form::close() !!}
</div> 
@endsection