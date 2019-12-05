
@include('auth.include.navbar')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="d-flex justify-content-between">
                        <div>
                            @if(Auth::user()->role_id == 1)
                                <a href="{{ route('admin.user_mgt', ['name' => Auth::user()->username]) }}" data-toggle="tooltip" data-placement="top" title="Go back"><i class="fa fa-chevron-left text-white d-flex align-items-center h-100" aria-hidden="true"></i></a>
                            @elseif(Auth::user()->role_id == 4)
                                <a href="{{ route('nurse.dashboard', ['name' => Auth::user()->username]) }}" data-toggle="tooltip" data-placement="top" title="Go back"><i class="fa fa-chevron-left text-white d-flex align-items-center h-100" aria-hidden="true"></i></a>
                            @endif
                        </div>
                        <div>{{ __('Registration Form') }}</div>
                        <div></div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" autocomplete="off" class="px-5 pt-5">
                        @csrf

                        @if(Auth::user()->role_id == 1)
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                            @if(count($roles) > 1)
                                                @foreach($roles as $role)
                                                    <option value="{{$role->role_id}}">{{$role->description}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" required>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->role_id == 4)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" required>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                 
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" required>
                                    
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input name="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" required>
                                    
                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" required>
                                    
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <input name="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" required>

                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Sex</label>
                                    <select name="sex" class="form-control @error('sex') is-invalid @enderror" required>
                                        @foreach ($items_2 as $item_2)
                                            <option value="{{ $item_2 }}">{{ $item_2 }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="form-control @error('civil_status') is-invalid @enderror" required>
                                        @foreach ($items_1 as $item_1)
                                            <option value="{{ $item_1 }}">{{ $item_1 }}</option>
                                        @endforeach
                                    </select>

                                    @error('civil_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Bloodtype</label>
                                    <select name="bloodtype_id" class="form-control @error('bloodtype_id') is-invalid @enderror" required>
                                        @foreach ($bloodtypes as $bloodtype)
                                            <option value="{{ $bloodtype->bloodtype_id }}">{{ $bloodtype->description }}</option>
                                        @endforeach
                                    </select>

                                    @error('bloodtype_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Birthday</label>
                                    <input name="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" required>

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <input name="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror" required>

                                    @error('citizenship')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label >Adress Line 1</label>
                                    <input name="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" required>

                                    @error('address_line_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Adress Line 2</label>
                                    <input name="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" required>

                                    @error('address_line_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
