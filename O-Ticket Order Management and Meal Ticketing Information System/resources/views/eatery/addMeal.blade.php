@extends('layouts.eatery')
@section('content')
    <div class="container">
        <br>
            <h4>Registration - Meal</h4>
        <br>
        {!! Form::open(['action' => 'EateryPagesController@addMealSubmit', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-6">
                {{Form::label('name', 'Meal Name *')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Meal Name', 'required' => 'required'])}}
            </div>
            <div class="col-md-6">
                <label for="category">Select Category *</label>
                <select class="form-control" name="category">
                    <option value="Meal">Meal</option>
                    <option value="Snack">Snack</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Coffee">Coffee</option>
                </select>
            </div>
            
            <div class="col-md-2">
                {{Form::label('price', 'Price *')}}
                {{Form::number('price', '', ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required' => 'required'])}}
            </div>
            <div class="col-md-12">
                {{Form::label('description', 'Description *')}}
                {{Form::textarea('description', '', ['class' => 'form-control','rows' => '5' ,'placeholder' => 'Enter Description', 'required' => 'required'])}}
            </div>
        </div>
        <br>
        <br>
        <div class="col text-center">
            {{csrf_field()}}
            {{Form::submit('Register', ['class'=> 'btn btn-outline-primary', ])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection