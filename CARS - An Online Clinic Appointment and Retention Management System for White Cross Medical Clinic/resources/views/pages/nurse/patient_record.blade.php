@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.nurse.include.sidebar')
    <div class="main-panel">      
        @include('pages.nurse.include.navbar') 
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div>PATIENT LIST</div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="patient_record_table" class="table display table-bordered nowrap compact">
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
                                            @foreach($patients as $patient)
                                            <tr>
                                                <td>{{$patient->id}}</td>
                                                <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                                                <td>{{$patient->username}}</td>
                                                <td>{{$patient->email}}</td>
                                                <td>0{{$patient->contact_no}}</td>
                                                <td>{{$patient->role->description}}</td>
                                                <td>
                                                    <a href="#" id="ViewBtn" data-data="{{$patient}}" data-toggle="modal" data-target="#ViewModal"><i class="fas fa-eye text-primary mx-1"></i></a>                                                          
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

<!-- View Modal -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div class="text-center w-100 mb-5">
                    <i class="fas fa-user-circle fa-5x text-primary" aria-hidden="true"></i>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
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

        const patient_record_table = $('#patient_record_table').DataTable({
            "bLengthChange": false,
        });

        patient_record_table.on('click', '#ViewBtn', function(){
            var data = $(this).data('data');
            $('#view_username').val(data.username);
            $('#view_email').val(data.email);
            $('#view_first_name').val(data.first_name);
            $('#view_last_name').val(data.last_name);
            $('#view_middle_name').val(data.middle_name);
            $('#view_contact_no').val('0'+data.contact_no);
            $('#view_sex').val(data.sex);
            $('#view_birthday').val(data.birthday);
            $('#view_citizenship').val(data.citizenship);
            $('#view_civil_status').val(data.civil_status);
            $('#view_bloodtype').val(data.bloodtype);
            $('#view_address_line_1').val(data.address_line_1);
            $('#view_address_line_2').val(data.address_line_2);
        });

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