@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.admin.include.sidebar')
    <div class="main-panel">
        @include('pages.admin.include.navbar')
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div>USER MANAGEMENT</div>
                                    <div><a href="{{ route('register') }}"><i class="fas fa-user-plus text-white"></i></a></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="user_mgt_table" class="table display table-bordered nowrap compact">
                                        <thead>
                                            <th></th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->contact_no}}</td>
                                                    <td>{{$user->role->description}}</td>
                                                    <td>
                                                        <a href="#" id="View_Button" data-user="{{ $user }}" data-bloodtype="{{ $user->bloodtype->description }}" data-role="{{ $user->role->description }}" data-toggle="modal" data-target="#ViewModal"><i class="fa fa-eye text-primary" aria-hidden="true"></i></a>
                                                        <a href="#" id="Edit_Button" data-user="{{ $user }}" data-toggle="modal" data-target="#EditModal"><i class="fas fa-edit text-warning mx-1"></i></a>
                                                        @if(Auth::user()->id != $user->id)
                                                            @if ($user->deleted_at == NULL)
                                                                <a href="#" id="Delete_Button" data-id="{{ $user->id }}" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                                            @else
                                                                <a href="#" id="Restore_Button" data-id="{{ $user->id }}" data-toggle="modal" data-target="#RestoreModal"><i class="fas fa-trash-restore primary"></i></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditUserForm" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}">{{ $role->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input id="username" name="username" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input id="first_name" name="first_name" type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input id="middle_name" name="middle_name" type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input id="email" name="email" type="email" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Contact No.</label>
                                <input id="contact_no" name="contact_no" type="text" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Sex</label>
                                <select id="sex" name="sex" class="form-control">
                                    @foreach ($sexs as $sex)
                                        <option value="{{$sex}}">{{$sex}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select id="civil_status" name="civil_status" class="form-control">
                                    @foreach ($civil_statuses as $civil_status)
                                        <option value="{{$civil_status}}">{{$civil_status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Bloodtype</label>
                                <select id="bloodtype_id" name="bloodtype_id" class="form-control">
                                    @foreach ($bloodtypes as $bloodtype)
                                        <option value="{{$bloodtype->bloodtype_id}}">{{$bloodtype->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Birthday</label>
                                <input id="birthday" name="birthday" type="date" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Citizenship</label>
                                <input id="citizenship" name="citizenship" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label >Adress Line 1</label>
                                <input id="address_line_1" name="address_line_1" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Adress Line 2</label>
                                <input id="address_line_2" name="address_line_2" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle fa-3x text-danger pt-4" aria-hidden="true"></i>
                <h3>Are you sure?</h3>
                <p></p>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="DeleteUserForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">YES, DELETE IT!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO, KEEP IT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Restore Modal -->
<div class="modal fade" id="RestoreModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle fa-3x text-primary pt-4" aria-hidden="true"></i>
                <h3>Are you sure?</h3>
                <p></p>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="RestoreUserForm" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">YES, RESTORE IT!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO, LEAVE IT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div class="text-center w-100 mb-2">
                    <i class="fas fa-user-circle fa-5x text-primary" aria-hidden="true"></i>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Role</label>
                            <input id="view_role" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input id="view_username" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input id="view_first_name" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input id="view_middle_name" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input id="view_last_name" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="view_email" type="email" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Contact No.</label>
                            <input id="view_contact_no" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Sex</label>
                            <input id="view_sex" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Civil Status</label>
                            <input id="view_civil_status" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Bloodtype</label>
                            <input id="view_bloodtype" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Birthday</label>
                            <input id="view_birthday" type="date" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Citizenship</label>
                            <input id="view_citizenship" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label >Adress Line 1</label>
                            <input id="view_address_line_1" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Adress Line 2</label>
                            <input id="view_address_line_2" type="text" class="form-control disabled" value="" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script>
<script>
    $( document ).ready(function() {
        
        const user_mgt_table = $('#user_mgt_table').DataTable();

        user_mgt_table.on('click', '#Edit_Button', function(){
            var user = $(this).data('user');
            var route = "{{route('admin_usermgt.update', '')}}/"+user.id;
            $('#EditUserForm').attr('action', route);
            $('#role_id').val(user.role_id);
            $('#username').val(user.username);
            $('#email').val(user.email);
            $('#first_name').val(user.first_name);
            $('#last_name').val(user.last_name);
            $('#middle_name').val(user.middle_name);
            $('#contact_no').val(user.contact_no);
            $('#sex').val(user.sex);
            $('#birthday').val(user.birthday);
            $('#citizenship').val(user.citizenship);
            $('#civil_status').val(user.civil_status);
            $('#bloodtype_id').val(user.bloodtype_id);
            $('#address_line_1').val(user.address_line_1);
            $('#address_line_2').val(user.address_line_2);
        });

        user_mgt_table.on('click', '#Delete_Button', function(){
            var id = $(this).data('id');
            var route = "{{ route('admin_usermgt.destroy', '')}}/"+id;
            $('#DeleteUserForm').attr('action', route);
        });

        user_mgt_table.on('click', '#Restore_Button', function(){
            var id = $(this).data('id');
            var route = "{{ route('admin_usermgt.restore', '')}}/"+id;
            $('#RestoreUserForm').attr('action', route);
        });

        user_mgt_table.on('click', '#View_Button', function(){
            var user = $(this).data('user');
            var bloodtype = $(this).data('bloodtype');
            var role = $(this).data('role');
            
            $('#view_role').val(role);
            $('#view_username').val(user.username);
            $('#view_email').val(user.email);
            $('#view_first_name').val(user.first_name);
            $('#view_last_name').val(user.last_name);
            $('#view_middle_name').val(user.middle_name);
            $('#view_contact_no').val('0'+user.contact_no);
            $('#view_sex').val(user.sex);
            $('#view_birthday').val(user.birthday);
            $('#view_citizenship').val(user.citizenship);
            $('#view_civil_status').val(user.civil_status);
            $('#view_bloodtype').val(bloodtype);
            $('#view_address_line_1').val(user.address_line_1);
            $('#view_address_line_2').val(user.address_line_2);
        });
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

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