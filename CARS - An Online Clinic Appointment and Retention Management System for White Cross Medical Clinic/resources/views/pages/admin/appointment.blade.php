@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.admin.include.sidebar')
    <div class="main-panel">
        @include('pages.admin.include.navbar')
        <div class="content mt-5">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#Approved" data-toggle="tab">Approved</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#Pending" data-toggle="tab">Pending</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="height:30rem;">
                                <form id="AppointmentDetails" class="pb-3">
                                    @csrf
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-auto">
                                            <button type="button" data-toggle='modal' data-target='#AddAppointment' class="btn btn-primary btn-sm m-0">+ ADD APPOINTMENT</button>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-user text-secondary pr-2" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <select id="doctor_id" name="doctor_id" class="form-control dynamic">
                                                    <option value="" disabled selected>Select a doctor...</option>
                                                        @foreach ($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar text-secondary pr-2" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <input id="appointment_date" name="appointment_date" type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}" class="form-control dynamic">
                                                <button id="submit_app_details" type="submit" class="btn btn-primary btn-round btn-sm"><i class="fas fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="Approved">
                                        <table id="app_approved_table" class="table display table-bordered nowrap compact" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Time Schedule</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="Pending">
                                        <table id="app_request_table" class="table display table-bordered nowrap compact" style="width:100%">
                                            <thead>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Time Schedule</th>
                                                <th>Action</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#Approved" data-toggle="tab">Approved</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#Pending" data-toggle="tab">Pending</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="height:30rem;">
                                <form id="AppointmentDetails" class="pb-3">
                                    @csrf
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-auto">
                                            <button type="button" data-toggle='modal' data-target='#AddAppointment' class="btn btn-outline-primary btn-sm m-0">+ ADD APPOINTMENT</button>
                                            <button type="button" data-toggle='modal' data-target='#AddBillModal' class="btn btn-outline-success btn-sm m-0">+ ADD PAYMENT</button>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-user text-secondary pr-2" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <select id="doctor_id" name="doctor_id" class="form-control dynamic">
                                                    <option value="" disabled selected>Select a doctor...</option>
                                                        @foreach ($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar text-secondary pr-2" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <input id="appointment_date" name="appointment_date" type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}" class="form-control dynamic">
                                                <button id="submit_app_details" type="submit" class="btn btn-primary btn-round btn-sm"><i class="fas fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="Approved">
                                        <table id="app_approved_table" class="table display table-bordered nowrap compact" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Last Update</th>
                                                    <th>Name</th>
                                                    <th>Remarks</th>
                                                    <th>Time Schedule</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="Pending">
                                        <table id="app_request_table" class="table display table-bordered nowrap compact" style="width:100%">
                                            <thead>
                                                <th>Last Update</th>
                                                <th>Name</th>
                                                <th>Remarks</th>
                                                <th>Time Schedule</th>
                                                <th>Action</th>
                                            </thead>
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
</div>

<!-- Add Appointment Modal -->
<div class="modal fade" id="AddAppointment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="AddAppointmentForm">
                <div class="modal-body p-5">
                    <div class="form-group">
                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Patient's Name</label>
                        <select id="mdl_patient_id" class="form-control">
                            <option value="" disabled selected>Select a patient...</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Doctor's Name</label>
                        <select id="mdl_doctor_id" class="form-control dynamic-modal">
                            <option value="" disabled selected>Select a doctor...</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="position: static !important; margin-bottom: 0.9rem;"><i class="fa fa-calendar pr-2" aria-hidden="true"></i>Appointment Date</label>
                        <input id="mdl_appointment_date" type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}" class="form-control dynamic-modal">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-clock pr-2" aria-hidden="true"></i>Appointment Time</label>
                        <select id="mdl_doctor_schedule_id" class="form-control">
                        </select>
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

<!-- Edit Appointment Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditAppointmentForm">
                @csrf
                <div class="modal-body p-5">
                    <div class="form-group">
                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Patient's Name</label>
                        <input id="edit_patient_name" class="form-control disabled" disabled>
                    </div>
                    <div class="form-group">
                        <label style="position: static !important; margin-bottom: 0.9rem;"><i class="fa fa-calendar pr-2" aria-hidden="true"></i>Appointment Date</label>
                        <input id="edit_appointment_date" type="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}" class="form-control dynamic-edit">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-clock pr-2" aria-hidden="true"></i>Appointment Time</label>
                        <select id="edit_appointment_time" class="form-control">
                        </select>
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

<!-- Approve Modal -->
<div class="modal fade" id="ApproveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-question-circle fa-3x text-primary pt-4" aria-hidden="true"></i>
                <h3>Approve Appointment Request?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="ApproveForm">
                        <button type="submit" class="btn btn-primary">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DONE Modal -->
<div class="modal fade" id="DoneModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-question-circle fa-3x text-success pt-4" aria-hidden="true"></i>
                <h3>Appointment Complete?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="DoneForm">
                        <button type="submit" class="btn btn-success">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ONGOING Modal -->
<div class="modal fade" id="OngoingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-question-circle fa-3x text-info pt-4" aria-hidden="true"></i>
                <h3>Appointment Ongoing?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="OngoingForm">
                        <button type="submit" class="btn btn-info">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CANCEL Modal -->
<div class="modal fade" id="CancelModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-times-circle fa-3x text-danger pt-4"></i>
                <h3>Cancel Appointment?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="CancelForm">
                        <button type="submit" class="btn btn-danger">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD BILL Modal -->
<div class="modal fade" id="AddBillModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Patient's Name</label>
                            <select id="bill_patient_id" class="form-control">
                                <option value="" disabled selected>Select a patient...</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input id="bill_discount" class="form-check-input" type="checkbox" value=".20">
                                Discount
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-end w-100">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <select class='form-control' id='bill_doctor_id'>
                                        <option value=''disabled selected>Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value='{{$doctor->id}}'>{{$doctor->first_name}} {{$doctor->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        </span>
                                    </div>
                                    <select class='form-control' id='medical_service'>
                                        <option value=''disabled selected>Select Medical Service</option>
                                        @foreach($medical_services as $medical_service)
                                            <option data-id='{{$medical_service->medical_service_id}}' value='{{$medical_service->rate}}'>{{$medical_service->description}}</option>
                                        @endforeach
                                    </select>
                                    <button id="add_row" type="button" class="btn btn-outline-primary btn-sm">+</button>
                                </div>
                            </div>   
                        </div>
                        <table id='medical_serv_bill' class="table display table-bordered nowrap compact">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody id="medical_service_list">
                            </tbody>
                            <tr>
                                <th class="text-right">Grand Total</th>
                                <td class="text-success"><input id="GrandTotal" type="text" class="form-control" disabled></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center w-100">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Amount Paid</label>
                                    <input type="number" id="amount_paid" name="amount_paid" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Change</label>
                                    <input type="number" id="change" name="change" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <button id="ClearBtn" type="button" class="btn btn-secondary">Clear</button>
                    <button id="Pay" type="button" class="btn btn-success">Pay</button>
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

        const request_dataTable = $('#app_request_table').DataTable({
            searching: false,
            bLengthChange: false
        });
        const approved_dataTable = $('#app_approved_table').DataTable({
            searching: false,
            bLengthChange: false
        });

        function refresh_dt(){

            $('#app_request_table').DataTable().destroy();
            $('#app_approved_table').DataTable().destroy();
            request_dt(doctor_id, appointment_date);
            approved_dt(doctor_id, appointment_date);
        };

        function request_dt(doctor_id = '', appointment_date = ''){
            $('#app_request_table').DataTable({
                searching: false,
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('appointment.getAppointments') }}",
                    data: {
                        '_token' : "{{csrf_token() }}",
                        doctor_id: doctor_id, 
                        appointment_date: appointment_date
                    }
                },
                columns: [
                    { data: "last_update", name : "last_update"},
                    { data: "fullname", name: "fullname" },
                    { data: "remarks", name: "remarks" },
                    { data: "time_schedule", name: "time_schedule" },
                    { data: "Action", name: "Action" }
                ]
            });
        }

        function approved_dt(doctor_id = '', appointment_date = ''){
            $('#app_approved_table').DataTable({
                searching: false,
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('appointment.getApprovedAppointments') }}",
                    data: {
                        '_token' : "{{csrf_token() }}",
                        doctor_id: doctor_id, 
                        appointment_date: appointment_date
                    }
                },
                columns: [
                    { data: "last_update", name : "last_update"},
                    { data: "fullname", name: "fullname" },
                    { data: "remarks", name: "remarks" },
                    { data: "time_schedule", name: "time_schedule" },
                    { data: "Action", name: "Action" }
                ]
            });
        }

        $('#submit_app_details').click(function(e){
            
            var doctor_id = $('#doctor_id').val();
            var appointment_date = $('#appointment_date').val();

            e.preventDefault();

            if(doctor_id != '' && appointment_date != ''){
                
                $('#app_request_table').DataTable().destroy();
                $('#app_approved_table').DataTable().destroy();

                request_dt(doctor_id, appointment_date);
                approved_dt(doctor_id, appointment_date);
            }else{
                toastr.warning('Kindly fill up all input fields!');
            }
        });

        request_dataTable.on('click', '#ApproveBtn', function(){
            var id = $(this).data('id');
            var route = "{{ route('appointment.approve', '')}}/"+id;
            $('#ApproveForm').submit(function(){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {'_token' : "{{csrf_token() }}"},
                    success: function(){
                        toastr.info('Appointment Approved!');
                        $('#ApproveModal').modal('hide');
                        refresh_dt();
                    }
                });
            })
        });

        request_dataTable.on('click', '#CancelBtn', function(){
            var id = $(this).data('id');
            var route = "{{ route('appointment.cancel', '')}}/"+id;
            var message = $('#message').val();
            $('#CancelForm').submit(function(){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {'_token' : "{{csrf_token() }}", message: message},
                    success: function(){
                        toastr.warning('Appointment Cancelled!');
                        $('#CancelModal').modal('hide');
                        refresh_dt();
                    },
                    error: function(){
                        // toastr.error('Something went wrong :/', 'Error!');
                    }
                });
            })
        });

        approved_dataTable.on('click', '#OngoingBtn', function(){
            var id = $(this).data('id');
            var route = "{{ route('appointment.ongoing', '')}}/"+id;
            $('#OngoingForm').submit(function(){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {'_token' : "{{csrf_token() }}"},
                    success: function(){
                        toastr.success('Appointment Ongoing!');
                        $('#OngoingModal').modal('hide');
                        refresh_dt();
                    },
                    error: function(){
                        // toastr.error('Something went wrong :/', 'Error!');
                    }
                });
            })
        });

        approved_dataTable.on('click', '#DoneBtn', function(){
            var id = $(this).data('id');
            var route = "{{ route('appointment.done', '')}}/"+id;
            $('#DoneForm').submit(function(){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {'_token' : "{{csrf_token() }}"},
                    success: function(){
                        toastr.success('Appointment Complete!');
                        $('#DoneModal').modal('hide');
                        refresh_dt();
                    },
                    error: function(){
                        // toastr.error('Something went wrong :/', 'Error!');
                    }
                });
            })
        });

        approved_dataTable.on('click', '#EditBtn', function(){
            var doctor_id = $('#doctor_id').val();
            var patient = $(this).data('patient');
            var date = $(this).data('date');
            var time = $(this).data('time');

            $('#edit_patient_name').val(patient);
            $('#edit_appointment_date').val(date);

            if( doctor_id != '' && date != ''){
                $.ajax({
                    url: "{{ route('appointment.getDocSchedules') }}",
                    method: "POST",
                    data: {
                        doctor_id: doctor_id,
                        appointment_date: date, 
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(output){
                        $('#edit_appointment_time').html(output);
                        $('#edit_appointment_time').val(time);
                    }
                });
            }
        });

        $('.dynamic').change(function(){
            if($(this).val() != ''){
                var doctor_id = $('#doctor_id').val();
                var appointment_date = $('#appointment_date').val();

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
                            $('#doctor_schedule_id').html(output);
                        }
                    });
                }
            }
        });

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

        $('.dynamic-modal').change(function(){
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

        $('#AddAppointmentForm').submit(function(e){
            e.preventDefault();
            var doctor_schedule_id = $('#mdl_doctor_schedule_id').val();
            var patient_id = $('#mdl_patient_id').val();
            var appointment_date = $('#mdl_appointment_date').val();
            var remarks = $('#mdl_remarks').val();

            $.ajax({
                url: "{{ route('appointment.store') }}",
                method: "POST",
                data: {
                    doctor_schedule_id: doctor_schedule_id,
                    appointment_date: appointment_date,
                    patient_id: patient_id, 
                    remarks: remarks,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(response){
                    $('#AddAppointment').modal('hide');
                    if(response.type == "success"){
                        toastr.success(response.message);
                        refresh_dt();
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        });

        $('#medical_service').change(function(){
            var html
        });

        var arr = [];

        $('#add_row').click(function(){
            var rate = $('#medical_service').val();
            var description = $('#medical_service option:selected').text();
            var id = $('#medical_service option:selected').data('id');
            var currTotal = $('#GrandTotal').val();

            var html = "<tr><td data-id="+id+" class='attrDes'>"+description+"</td><td data-rate="+rate+" class='attrRate'>"+rate+"</td></tr>";
            $('#medical_service_list').append(html);

            arr.push(parseFloat(rate));
            var total = 0;

            for(var x=0; x < arr.length; x++){
                total = parseFloat(total) + arr[x];
            }
            
            $('#GrandTotal').val(total);

        });

        $('#amount_paid').keyup(function(){
            var GrandTotal = $('#GrandTotal').val();
            $('#change').val($(this).val()-parseInt(GrandTotal));
        });

        $('#ClearBtn').click(function(){
            $('#medical_service_list').empty();
        });

        $('#Pay').click(function(){
            var bill_patient_id = $('#bill_patient_id').val();
            var bill_doctor_id = $('#bill_doctor_id').val();
            var amount_paid = $('#amount_paid').val();
            var GrandTotal = $('#GrandTotal').val();
            var ary = [];

            if($('input[type=checkbox]').prop('checked') == true){
                var discount = 1;
            }else{
                var discount = 0;
            }

            $('#medical_serv_bill tbody tr').each(function (a, b) {
                var id = $('.attrDes', b).data('id');
                var rate = $('.attrRate', b).data('rate');
                ary.push({ id: id, rate: rate });
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('billing.store') }}",
                data: {
                    medical_services: JSON.stringify(ary),
                    patient_id: bill_patient_id,
                    doctor_id: bill_doctor_id,
                    total: GrandTotal,
                    amount_paid: amount_paid,
                    discount: discount,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(){
                    $('#AddBillModal').modal('hide');
                    toastr.info('Payment has been made!');
                },
                error: function(){
                    $('#AddBillModal').modal('hide');
                    toastr.info('Payment has been made!');
                }
            });
        });

        $('.dynamic-edit').change(function(){
            if($(this).val() != ''){
                var doctor_id = $('#doctor_id').val();
                var appointment_date = $('#edit_appointment_date').val();

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
                            $('#edit_appointment_time').html(output);
                        }
                    });
                }
            }
        });

        $('#EditAppointmentForm').submit(function(e){
            e.preventDefault();
            
            var id = $('#EditBtn').data('id');
            var date = $('#edit_appointment_date').val();
            var time = $('#edit_appointment_time').val();

            if(id != '' && date != '' && time != ''){
                $.ajax({
                    url: "{{ route('appointment.reschedule') }}",
                    method: "POST",
                    data: {
                        appointment_id: id,
                        appointment_date: date,
                        appointment_time: time,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(response){
                        if(response.type == "success"){
                            toastr.success(response.message);
                            refresh_dt();
                        }else{
                            toastr.error(response.message);
                        }
                    }
                });
            }

            $('#EditModal').modal('hide');
        });

        $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                    scrollTop: (target.offset().top - 70)
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
        });

        $('.js-scroll-trigger').click(function() {
            $('.navbar-collapse').collapse('hide');
        });
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
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