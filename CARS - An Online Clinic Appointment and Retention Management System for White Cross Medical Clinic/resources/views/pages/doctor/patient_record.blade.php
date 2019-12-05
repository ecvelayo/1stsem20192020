@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.doctor.include.sidebar')
    <div class="main-panel">      
        @include('pages.doctor.include.navbar')  
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="card">
                            <form id="patient_details">
                                @csrf
                                <div class="card-header card-header-primary"><i class="fas fa-search" aria-hidden="true"></i> Search Patient Records</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Patient's Name</label>
                                        <input id="patient_id" list="patient_list" class="form-control" placeholder="Select Patient" autocomplete="off">
                                        <datalist id="patient_list">
                                            @foreach ($users as $user)
                                                <option data-value="{{ $user->id }}" value="{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="d-flex justify-content-end w-100">
                                        <button type="submit" id="submit_patient" class="btn btn-primary btn-sm"><i class="fas fa-search" aria-hidden="true"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
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
                            <div class="card-body" style="height:30rem;">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="medical_history">
                                        <table id="medical_history_table" class="table display table-striped compact nowrap w-100">
                                            <thead>
                                                <th style="font-size: 1em;">Description</th>
                                                <th style="font-size: 1em;">Add on</th>
                                                <th style="font-size: 1em;">Last Update</th>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="vital_signs">
                                        <table id="vital_signs_table" class="table table-striped display compact nowrap w-100">
                                            <thead>
                                                <th style="font-size: 1em;">Doctor</th>
                                                <th style="font-size: 1em;">Description</th>
                                                <th style="font-size: 1em;">Value</th>
                                                <th style="font-size: 1em;">Add on</th>
                                                <th style="font-size: 1em;">Last Update</th>
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
@endsection

@section('script')
<script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script>
<script>
    $( document ).ready(function() {

        $('#medical_history_table').DataTable();
        $('#vital_signs_table').DataTable();

        $('#submit_patient').click(function(e){
            e.preventDefault();
            
            var label = $('#patient_id').val();
            var patient_id = $('#patient_list [value="' + label + '"]').data('value');
            
            if( patient_id != '' ){
                $('#medical_history_table').DataTable().destroy();
                $('#vital_signs_table').DataTable().destroy();

                getMedicalHistory(patient_id);
                getVitalSigns(patient_id);
            }else{
                toastr.warning('Missing entries!');
            }
            
        });

        function getMedicalHistory(patient_id) {
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
                    { data: "created_at", name: "created_at" },
                    { data: "updated_at", name: "updated_at" }
                ]
            });
        }

        function getVitalSigns(patient_id) {
            $('#vital_signs_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('getVitalSigns') }}",
                    data: {
                        '_token' : "{{csrf_token() }}",
                        patient_id: patient_id
                    }
                },
                columns: [
                    { data: "fullname", name: "fullname" },
                    { data: "name", name: "name" },
                    { data: "value", name: "value" },
                    { data: "add_on", name: "add_on" },
                    { data: "last_update", name: "last_update" }
                ]
            });
        }
    });
</script>
@endsection