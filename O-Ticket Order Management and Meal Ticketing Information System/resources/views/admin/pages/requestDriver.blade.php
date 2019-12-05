@extends('layouts.admin')
@section('content')
    <div class="container">
            <br>
            <h4>Please select another driver</h4>
            <br>                    
            {!! Form::open(['action' => ['RegistrationsController@requestDriver', $id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('Assigned', 'Available driver *')}}
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
                    <div class="col text-center">
                        <a href="/admin" role="button" class="btn btn-outline-danger">Cancel</a>
                        {{csrf_field()}}
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Register', ['class'=>'btn btn-outline-primary'])}}
                    </div>
                
            {!! Form::close() !!}
    </div>
@endsection