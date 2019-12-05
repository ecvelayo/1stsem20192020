@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.doctor.include.sidebar')
    <div class="main-panel">
        @include('pages.doctor.include.navbar')
        @csrf
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header card-header-primary">ENTER PATIENT DETAILS</div>
                            <div class="card-body">
                                <form id="patient_submit" class="row">
                                    <div class="col-lg-8 col-sm-12 col-xs-12">
                                        <label for="">Patient's Name</label>
                                        <select name="patient_id" id="patient_id" class="form-control">
                                            <option value="" disabled selected>Select Patient Name</option>
                                            @foreach ($patients as $p)
                                                <option value="{{$p->id}}">{{$p->first_name}} {{$p->middle_name}} {{$p->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                        <div class="d-flex justify-content-end align-items-end w-100 h-100">
                                            <button type="submit" class="btn btn-primary btn-sm m-0">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                <div class="nav-tabs-navigation">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#medical_history" data-toggle="tab">Medical History</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#vital_signs" data-toggle="tab">Vital Signs</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="medical_history">
                                        <table id="medical_history_table" class="table display">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Date Added</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <hr>
                                        <div class="d-flex justify-content-end w-100">
                                            <button id="add_medical_btn" type="button" data-toggle="modal" data-target="#AddModal" class="btn btn-primary">+ Add Medical History</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="vital_signs">
                                        <div class="pr-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-thermometer"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step=".01" id="temperature" class="form-control" placeholder="Temperature">   
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-wind"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step=".01" id="respiratory_rate" class="form-control" placeholder="Respiratory Rate">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-heartbeat"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step=".01" id="pulse_rate" class="form-control" placeholder="Pulse Rate">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-tint"></i>
                                                    </span>
                                                </div>
                                                <input type="text" step=".01" id="blood_pressure" class="form-control" placeholder="Blood Pressure">
                                                
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-ruler-vertical"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step=".01" id="height" class="form-control" placeholder="Height">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text pr-2 pl-2">
                                                        <i class="fas fa-balance-scale"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step=".01" id="weight" class="form-control" placeholder="Weight">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-venus"></i>
                                                    </span>
                                                </div>
                                                <input type="text" id="last_menstrual_period" class="form-control" placeholder="Last Menstrual Period">
                                            </div>
                                            <div class="d-flex justify-content-end w-100 mt-3">
                                                <button id="vs_submit" type="button" class="btn btn-primary">+ Add Vitals</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header card-header-primary">PATIENT INFORMATION</div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="row">
                                        <input type="hidden" name="user_id" value="">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input id="first_name" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input id="middle_name" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input id="last_name" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input id="email" type="email" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Contact No.</label>
                                                <input id="contact_no" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <input id="sex" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Civil Status</label>
                                                <input id="civil_status" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Bloodtype</label>
                                                <input id="bloodtype_id" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Birthday</label>
                                                <input id="birthday" type="date" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Citizenship</label>
                                                <input id="citizenship" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label >Adress Line 1</label>
                                                <input id="address_line_1" type="text" class="form-control disabled" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Adress Line 2</label>
                                                <input id="address_line_2" type="text" class="form-control disabled" disabled>
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
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="medical_history_submit" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script>
<script>
    $( document ).ready(function() {
        
        const medical_history_table = $('#medical_history_table').DataTable({
            bLengthChange: false
        });

        PusherListener();

        function PusherListener() {
            Pusher.logToConsole = true;

            var pusher = new Pusher('89973cf8f98acc38053a', {
                cluster: 'ap1',
                'useTLS': false,
            });
            
            var channel = pusher.subscribe('NurseDoctor.'+{{Auth::user()->role_id}}+'.'+{{Auth::user()->id}});
            channel.bind('NurseDoctor', function(data) {
                if (data.type == 'success') {
                    toastr.success(data.message, data.title);
                } else if (data.type == 'info') {
                    
                    toastr.info(data.message, data.title);
                    
                    // $.ajax({
                    //     type: "GET",
                    //     url: ,
                    //     // data: {'_token' : "{{csrf_token() }}"},
                    //     success: function(){
                            
                    //     },
                    //     error: function(){
                    //         toastr.error('Something went wrong :/', 'Error!');
                    //     }
                    // });

                } else if (data.type == 'warning') {
                    toastr.warning(data.message, data.title);
                } else if (data.type == 'error') {
                    toastr.error(data.message, data.title);
                }
            });
        }

        function getMedicalHistory(patient_id) {
            $('#medical_history_table').DataTable().destroy();
            $('#medical_history_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('getMedicalHistory') }}",
                    data: {
                        '_token' : "{{csrf_token() }}",
                        patient_id: patient_id
                    }
                },
                columns: [
                    { data: "description", name: "description" },
                    { data: "created_at", name: "created_at" }
                ]
            });
        }

        $('#medical_history_submit').click(function(){
            var description = $('#description').val();
            var user_id = $('#patient_id').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('storeMedicalHistory') }}",
                data: {
                    user_id: user_id,
                    description: description,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(){
                    getMedicalHistory(user_id);
                    $('#AddModal').modal('hide');
                    toastr.info('Medical History Added!');
                },
                error: function(){
                    toastr.error('Something seems to be wrong :/');
                }
            });
        });

        $('#patient_submit').submit(function(e){
            e.preventDefault();
            var patient_id = $('#patient_id').val();
            
            $.ajax({
                type: 'GET',
                url: "{{ route('doctor.getPatient', '') }}/"+patient_id,
                success: function(response){
                    $('#first_name').val(response.user[0].first_name);
                    $('#last_name').val(response.user[0].last_name);
                    $('#middle_name').val(response.user[0].middle_name);
                    $('#email').val(response.user[0].email);
                    $('#contact_no').val(response.user[0].contact_no);
                    $('#sex').val(response.user[0].sex);
                    $('#civil_status').val(response.user[0].civil_status);
                    $('#bloodtype_id').val(response.user[0].bloodtype.description);
                    $('#birthday').val(response.user[0].birthday);
                    $('#citizenship').val(response.user[0].citizenship);
                    $('#address_line_1').val(response.user[0].address_line_1);
                    $('#address_line_2').val(response.user[0].address_line_2);
                    getMedicalHistory(patient_id);
                }
            });
        });

        $('#vs_submit').click(function(){
            
            var temperature = $('#temperature').val();
            var respiratory_rate = $('#respiratory_rate').val();
            var pulse_rate = $('#pulse_rate').val();
            var blood_pressure = $('#blood_pressure').val();
            var height = $('#height').val();
            var weight = $('#weight').val();
            var last_menstrual_period = $('#last_menstrual_period').val();
            var patient_id = $('#patient_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('storeVitalSigns') }}",
                data: {
                    temperature: temperature,
                    respiratory_rate: respiratory_rate,
                    pulse_rate: pulse_rate,
                    blood_pressure: blood_pressure,
                    height: height,
                    weight: weight,
                    last_menstrual_period: last_menstrual_period,
                    patient_id: patient_id,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(){
                    toastr.error('Something seems wrong :/');
                },
                 error: function(){
                     toastr.info('Vital Signs Added!');
                 }
                // error: function(){
                //     toastr.error('Something seems wrong :/');
                // }
            })
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

        $('#patient_id').select2();

    });
</script>
@endsection