@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.nurse.include.sidebar')
    <div class="main-panel">
        @include('pages.nurse.include.navbar')
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header card-header-primary">EDIT PROFILE</div>
                            <div class="card-body">
                                <form action="{{ route('nurse.UpdateSettings') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" type="text" class="form-control" value="{{ $user->username }}">

                                                @if(is_null($user->username))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input name="email" type="email" class="form-control" value="{{ $user->email }}">

                                                @if(is_null($user->email))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Contact No.</label>
                                                <input name="contact_no" type="text" class="form-control" value="{{ $user->contact_no }}">

                                                @if(is_null($user->contact_no))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="first_name" type="text" class="form-control" value="{{ $user->first_name }}">
                                                
                                                @if(is_null($user->first_name))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input name="middle_name" type="text" class="form-control" value="{{ $user->middle_name }}">
                                                
                                                @if(is_null($user->middle_name))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="last_name" type="text" class="form-control" value="{{ $user->last_name }}">
                                                
                                                @if(is_null($user->last_name))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <select name="sex" class="form-control">
                                                    @foreach ($items_2 as $item_2)
                                                        @if($user->sex == $item_2)
                                                            <option value="{{ $item_2 }}" selected>{{ $item_2 }}</option>
                                                        @elseif($user->sex != $item_2)
                                                            <option value="{{ $item_2 }}">{{ $item_2 }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                
                                                @if(is_null($user->sex))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Birthday</label>
                                                <input name="birthday" type="date" class="form-control" value="{{ $user->birthday }}">

                                                @if(is_null($user->birthday))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Citizenship</label>
                                                <input name="citizenship" type="text" class="form-control" value="{{ $user->citizenship }}">

                                                @if(is_null($user->citizenship))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Civil Status</label>
                                                <select name="civil_status" class="form-control">
                                                    @foreach ($items_1 as $item_1)
                                                        @if($user->civil_status == $item_1)
                                                            <option value="{{ $item_1 }}" selected>{{ $item_1 }}</option>
                                                        @elseif($user->civil_status != $item_1)
                                                            <option value="{{ $item_1 }}">{{ $item_1 }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @if(is_null($user->civil_status))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label >Adress Line 1</label>
                                                <input name="address_line_1" type="text" class="form-control" value="{{ $user->address_line_1 }}">

                                                @if(is_null($user->address_line_1))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label >Adress Line 2</label>
                                                <input name="address_line_2" type="text" class="form-control" value="{{ $user->address_line_2 }}">

                                                @if(is_null($user->address_line_2))
                                                    <small class="text-danger">Missing entry</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header card-header-primary">CHANGE PASSWORD</div>
                            <div class="card-body">
                                <form action="{{ route('ChangePassword') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('CurrentPassword') ? ' has-error' : '' }}">
                                                <label >Current Password</label>
                                                <input name="CurrentPassword" type="password" class="form-control">
                                                
                                                @if ($errors->has('CurrentPassword'))
                                                    <small class="text-danger">{{ $errors->first('CurrentPassword') }}</small>
                                                @endif

                                                @if (session('CurrentPassword'))
                                                    <small class="text-danger">
                                                        {{ session('CurrentPassword') }}
                                                    </small>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('NewPassword') ? ' has-error' : '' }}">
                                                <label >New Password</label>
                                                <input name="NewPassword" type="password" class="form-control">
                                                
                                                @if ($errors->has('NewPassword'))
                                                    <small class="text-danger">{{ $errors->first('NewPassword') }}</small>
                                                @endif

                                                @if (session('NewPassword'))
                                                    <small class="text-danger">
                                                        {{ session('NewPassword') }}
                                                    </small>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label >Confirm Password</label>
                                                <input name="password_confirmation" type="password" class="form-control">
                                                
                                                @if ($errors->has('password_confirmation'))
                                                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                @endif

                                                @if (session('password_confirmation'))
                                                    <small class="text-danger">
                                                        {{ session('password_confirmation') }}
                                                    </small>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">UPDATE PASSWORD</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $( document ).ready(function(){
        
        LoadNotification();
        PusherListener();
        $.fn.dataTable.ext.errMode = 'none';

        function PusherListener() {
            Pusher.logToConsole = true;

            var pusher = new Pusher('89973cf8f98acc38053a', {
                cluster: 'ap1',
                'useTLS': false,
            });
            
            var channel = pusher.subscribe('PatientStaff.2');
            channel.bind('PatientStaff', function(data) {
                if (data.type == 'success') {
                    toastr.success(data.message, data.title);
                } else if (data.type == 'info') {
                    toastr.info(data.message, data.title);
                } else if (data.type == 'warning') {
                    toastr.warning(data.message, data.title);
                } else if (data.type == 'error') {
                    toastr.error(data.message, data.title);
                }
                LoadNotification();
            });
        }

        function LoadNotification(){
            $.ajax({
                type: "POST",
                url: "{{ route('notify.getNotifications') }}",
                data: {
                    user_id: "{{ Auth::user()->id }}",
                    '_token' : "{{csrf_token() }}"
                },
                success: function(data){
                    console.log(data.notifications.length);
                    $('#notifications').empty();
                    $('#ctr').empty();

                    for(var x = 0; x < data.notifications.length; x++){
                        $('#notifications').append("<a class='dropdown-item'> "+data.notifications[x].message+"&nbsp<small class='text-muted'>("+moment(data.notifications[x].created_at).fromNow()+")</small></a>");
                    }
                    if(data.ctr != 0){
                        $('#ctr').append("<span class='notification'>"+data.ctr+"</span>");
                    }else{
                        $('#ctr').append();
                    }
                    
                }

            });
        }

        $('#notifDropdown').click(function(){
            $.ajax({
                type: "GET",
                url: "{{ route('notify.seenNotifications') }}",
                success: function(){
                    LoadNotification();
                }
            });
        });
    });
</script>
@endsection