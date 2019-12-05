@extends('layouts.app')

@section('content')
<div class="wrapper ">
    @include('pages.patient.include.sidebar')
    <div class="main-panel">
        @include('pages.patient.include.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="d-flex justify-content-between">
                                    <div>APPOINTMENT HISTORY</div>
                                    <div>
                                        <a href="#" class="btn btn-secondary btn-sm m-0" data-toggle="modal" data-target="#RequestAppointment">REQUEST APPOINTMENT</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="AppHistory" class="table display nowrap">
                                        <thead class="text-primary">
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Doctor</th>
                                            <th>Status</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div id="ApprovedList" style="overflow:auto; height:450px;">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Request Appointment Modal -->
<div class="modal fade" id="RequestAppointment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="RequestAppForm" method="POST">
                <div class="modal-body p-5">
                    <div class="form-group">
                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Doctor's Name</label>
                        <select id="mdl_doctor_id" class="form-control dynamic-add">
                            <option value="" disabled selected>Select a doctor...</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="position: static !important; margin-bottom: 0.9rem;"><i class="fa fa-calendar pr-2" aria-hidden="true"></i>Appointment Date</label>
                        <input id="mdl_appointment_date" type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}" class="form-control dynamic-add">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-clock pr-2" aria-hidden="true"></i>Appointment Time</label>
                        <select id="mdl_doctor_schedule_id" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-pen pr-2"></i>Remarks</label>
                        <input type="text" id="mdl_remarks" name="mdl_remarks" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script> --}}
<script>
    $( document ).ready(function() {

        LoadNotification();
        PusherListener();
        $.fn.dataTable.ext.errMode = 'none';

        function PusherListener() {
            Pusher.logToConsole = true;

            var pusher = new Pusher('89973cf8f98acc38053a', {
                cluster: 'ap1',
                'useTLS': false,
            });
            
            var channel = pusher.subscribe('AppointmentStatus.'+{{Auth::user()->role_id}}+'.'+{{Auth::user()->id}});
            channel.bind('AppointmentStatus', function(data) {
                if (data.type == 'success') {
                    toastr.success(data.message, data.title);
                } else if (data.type == 'info') {
                    toastr.info(data.message, data.title);
                } else if (data.type == 'warning') {
                    toastr.warning(data.message, data.title);
                } else if (data.type == 'error') {
                    toastr.error(data.message, data.title);
                }
                AppHistory.ajax.reload(null, false);
                getApprovedAppointments();
                LoadNotification();
            });
        }

        var AppHistory = $('#AppHistory').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('patient.getPatientAppointments') }}",
            },
            columns: [
                { data: "date", name: "date"},
                { data: "time", name: "time"},
                { data: "doctor", name: "doctor"},
                { data: "Status", name: "Status"}
            ]
        });

        function getApprovedAppointments(){
            $.ajax({
                type: "GET",
                url: "{{ route('patient.getPatientApproved') }}",
                success: function(response){
                    
                    $('#ApprovedList').empty();
                    
                    for(var x = 0; response.appointments.length > 0; x++){
                        var html = "<div class='card bg-primary'>";
                        html += "<div class='card-body'><table><tbody>";
                        html += "<tr><td><h4>"+response.appointments[x].doctor+"</h4></td></tr>";
                        html += "<tr><td>Date:&nbsp;&nbsp;&nbsp;&nbsp;"+response.appointments[x].date+"</td></tr>";
                        html += "<tr><td>Time:&nbsp;&nbsp;&nbsp;&nbsp;"+response.appointments[x].time+"</td></tr>";
                        $('#ApprovedList').prepend(html);
                    }

                }
            });
        }
        
        $('.dynamic-add').change(function(){
            if($(this).val() != ''){
                var doctor_id = $('#mdl_doctor_id').val();
                var appointment_date = $('#mdl_appointment_date').val();

                if( doctor_id != '' && appointment_date != ''){
                    $.ajax({
                        url: "{{ route('appointment.getDocSchedules') }}",
                        method: "POST",
                        data: {
                            doctor_id: doctor_id,
                            appointment_date: appointment_date, 
                            '_token' : "{{csrf_token() }}"
                        },
                        success: function(output){
                            $('#mdl_doctor_schedule_id').html(output);
                        }
                    });
                }
            }
        });

        $('#RequestAppForm').submit(function(e){
            e.preventDefault();

            var doctor_schedule_id = $('#mdl_doctor_schedule_id').val();
            var appointment_date = $('#mdl_appointment_date').val();
            var remarks = $('#mdl_remarks').val();
            
            $.ajax({
                type: "POST",
                url: "{{ route('patient.requestAppointment') }}",
                data: {
                    doctor_schedule_id: doctor_schedule_id,
                    appointment_date: appointment_date,
                    remarks: remarks,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(response){
                    $('#RequestAppointment').modal('hide');
                    if(response.type == 'success'){
                        toastr.info('Appointment Request Sent!');
                    }else if(response.type == 'error'){
                        toastr.error(response.message);
                    }else if(response.type == 'warning'){
                        toastr.warning(response.message);
                    }
                },
                error: function(){
                    $('#RequestAppointment').modal('hide');
                    // toastr.error('Something went wrong :/', 'Error!');
                }
            });
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