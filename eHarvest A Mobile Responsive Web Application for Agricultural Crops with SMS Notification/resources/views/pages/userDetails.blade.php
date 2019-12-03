@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container">
   <div class="row">
        <div class="col-sm-10 ml-5 ml-sm-auto mr-sm-auto">
        <div class="d-block row">
            <div class="backbtndiv">
                <a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" id="backButton" ></i></a>
            <div>
            <div class="cardprofile">
                @foreach($det as $res)
 
                <div class="d-block profiletop">
                    <img src="/storage/{{ $res->photo }}" id="prof_pic">
                    {{-- <h2>{{ $res->username }}</h2> --}}
                    <p> <h5>{{$res->type}}</h5> 
 
                    <u>User Type</u></p>
                    <button class="btn btn-success" data-toggle="modal" data-target="#productModal">Change User Type</button>

                </div>

 
                <div class="userinfo">

                            <p> <b>First Name:</b></p>
                            <p> <b>Last Name:</b></p>
                            <p> <b>Email:</b></p>
                            <p> <b>Birthdate:</b></p>
                            <p> <b>Contact Number:</b></p>
                            <p> <b>Address:</b></p>
                        </div>
                        <div class="vl d-none d-lg-block"></div>
                        <div class="userinfo2">
                            <p> <b></b> {{ $res->firstname }} </p>
                            {{-- <p> <b></b> {{ $res->middlename }} </p> --}}
                            <p> <b></b> {{ $res->lastname }} </p>
                            <p> <b></b> {{ $res->email }} </p>
                            <p> <b></b> {{ Carbon\Carbon::parse($res->birthdate)->format('M d, Y') }} </p>
                            <p> <b></b> {{ $res->contact }} </p>
                            <p> <b></b> {{ $res->address }} </p>

                        </div>
 
                @endforeach



            </div>
        </div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" id="productModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="mowdal">
            <div class="modal-header">
                <h4 class="modal-title" id="productModalLabel">Edit User Type</h4>

                <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>




            <div class="modal-body">
                <form method="POST" action="{{ route('updateType', $res->id) }}" role="form"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">User Type</label>

                        <div class="dropdown col-md-6">
                            <select id="user_type" class="form-control @error('user_type') is-invalid @enderror" name="user_type"
                                    value="{{ old('unit') }}" required autocomplete="unit" autofocus>
                                    <option selected disabled>Choose...</option>
                                    <!-- <option value="consumer">Consumer</option> -->
                                    <option value="consumer">Consumer</option>
                                    <option value="farmer">Farmer</option>
                                    <option value="admin">Admin</option>
                            </select>
                        </div>



                    </div>

<!--                     <div class="form-group row">
                        <label for="valid_id" class="col-md-4 col-form-label text-md-right">Valid ID</label>

                        <div class="col-md-6">
                            <input id="valid_id" type="file"
                                class="form-control-file {{$errors->has('valid_id') ? ' is-invalid ' : ''}}"
                                name="valid_id" autofocus>

                            @if ($errors->has('valid_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('valid_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> -->


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>







            </div>

        </div>
    </div>
</div>
      </div>
   </div>
</div>
@endsection
