@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.admin.include.sidebar')
    <div class="main-panel">
        @include('pages.admin.include.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form id="patient_details">
                                @csrf
                                <div class="card-header card-header-primary">
                                    <div class="d-flex w-100">
                                        <div class="mr-auto">ENTER PATIENT NAME</div>
                                        <div></div>
                                        <div><button type="submit" id="submit_patient" class="btn btn-secondary btn-sm m-0">SUBMIT</button></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Select Patient</label>
                                        <input id="patient_id" list="patient_list" class="form-control">
                                        <datalist id="patient_list">
                                            @foreach ($users as $user)
                                                <option data-value="{{ $user->id }}" value="{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div>MEDICAL HISTORY</div>
                                    <div></div>
                                </div></div>
                            <div class="card-body">
                                <table id="medical_history_table" class="table display table-striped w-100">
                                    <thead>
                                        <th style="font-size: 1em;">Description</th>
                                        <th style="font-size: 1em;">Created At</th>
                                        <th style="font-size: 1em;">Last Update</th>
                                        <th style="font-size: 1em;">Action</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div>VITAL SIGNS</div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="vital_signs_table" class="table display table-striped w-100">
                                    <thead>
                                        <th style="font-size: 1em;">Doctor</th>
                                        <th style="font-size: 1em;">Description</th>
                                        <th style="font-size: 1em;">Value</th>
                                        <th style="font-size: 1em;">Created At</th>
                                        <th style="font-size: 1em;">Last Update</th>
                                        <th style="font-size: 1em;">Action</th>
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

<!-- Edit MH Modal -->
<div class="modal fade" id="EditMHModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT MEDICAL HISTORY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditMHForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="">Description</label>
                        <input type="text" id="edit_mh_description" class="form-control">
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

<!-- Edit VS Modal -->
<div class="modal fade" id="EditVSModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT VITAL SIGNS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditVSForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="">Description</label>
                        <select name="edit_vs_description" id="edit_vs_description" class="form-control">
                            @foreach ($vitals as $vital)
                                <option value="{{$vital->vital_sign_id}}">{{ strtoupper(str_replace(["_", "_"], " ", $vital->name)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="">Value</label>
                        <input type="text" name="edit_vs_value" id="edit_vs_value" class="form-control">
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

<!-- Delete MH Modal -->
<div class="modal fade" id="DeleteMHModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-times-circle fa-3x text-danger pt-4"></i>
                <h3>Delete Medical History?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="DeleteMHForm">
                        <button type="submit" class="btn btn-danger">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete VS Modal -->
<div class="modal fade" id="DeleteVSModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-times-circle fa-3x text-danger pt-4"></i>
                <h3>Delete Vital Sign?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="DeleteVSForm">
                        <button type="submit" class="btn btn-danger">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Restore MH Modal -->
<div class="modal fade" id="RestoreMHModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle fa-3x text-primary pt-4" aria-hidden="true"></i>
                <h3>Restore Medical History?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="RestoreMHForm">
                        <button type="submit" class="btn btn-primary">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Restore VS Modal -->
<div class="modal fade" id="RestoreVSModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle fa-3x text-primary pt-4" aria-hidden="true"></i>
                <h3>Restore Vital Sign?</h3>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="RestoreVSForm">
                        <button type="submit" class="btn btn-primary">YES!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO</button>
                    </form>
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

        const mh_tb = $('#medical_history_table').DataTable({
            "scrollX": true
        });

        const vs_tb = $('#vital_signs_table').DataTable({
            "scrollX": true
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

        $('.selectpicker').selectpicker();

        $('#submit_patient').click(function(e){
            e.preventDefault();
            
            refreshTB();
        });

        function refreshTB(){
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
        }

        mh_tb.on('click', '#EditMHBtn', function(){
            var id = $(this).data('id');
            var description = $(this).data('description');
            $('#edit_mh_description').val(description);

            $('#EditMHForm').submit(function(){
                event.preventDefault();
                var des = $('#edit_mh_description').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('updateMedicalHistory') }}",
                    data: {
                        id: id,
                        description: des,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#EditMHModal').modal('hide');
                        toastr.info('Medical history record updated!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
        });

        vs_tb.on('click', '#EditVSBtn', function(){
            var patient_id = $(this).data('patient_id');
            var vs_id = $(this).data('vs_id');
            var value = $(this).data('value'); 
            var created_at = $(this).data('created');

            $('#edit_vs_description').val(vs_id);
            $('#edit_vs_value').val(value);

            $('#EditVSForm').submit(function(){
                event.preventDefault();

                var edit_vs_description = $('#edit_vs_description').val();
                var edit_vs_value = $('#edit_vs_value').val();

                console.log(edit_vs_description, edit_vs_value);

                $.ajax({
                    type: "POST",
                    url: "{{ route('updateVitalSign') }}",
                    data: {
                        patient_id: patient_id,
                        vital_sign_id: vs_id,
                        value: value,
                        edit_vital_sign_id: edit_vs_description,
                        edit_value: edit_vs_value,
                        created_at: created_at,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#EditVSModal').modal('hide');
                        toastr.info('Vital sign record updated!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
        });


        //
        mh_tb.on('click', '#DeleteMHBtn', function(){
            var id = $(this).data('id');

            $('#DeleteMHForm').submit(function(){
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteMedicalHistory') }}",
                    data: {
                        id: id,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#DeleteMHModal').modal('hide');
                        toastr.info('Medical history record deleted!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
        });

        vs_tb.on('click', '#DeleteVSBtn', function(){
            var patient_id = $(this).data('patient_id');
            var vs_id = $(this).data('vs_id');
            var value = $(this).data('value'); 
            var created_at = $(this).data('created_at');
            console.log(created_at);

            $('#DeleteVSForm').submit(function(){
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteVitalSign') }}",
                    data: {
                        patient_id: patient_id,
                        vital_sign_id: vs_id,
                        value: value,
                        created_at: created_at,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#DeleteVSModal').modal('hide');
                        toastr.info('Vital sign record deleted!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
        });

        // Restore Modal
        mh_tb.on('click', '#RestoreMHBtn', function(){
            var id = $(this).data('id');

            $('#RestoreMHForm').submit(function(){
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('restoreMedicalHistory') }}",
                    data: {
                        id: id,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#RestoreMHModal').modal('hide');
                        toastr.info('Medical history record restored!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
        });

        vs_tb.on('click', '#RestoreVSBtn', function(){
            var patient_id = $(this).data('patient_id');
            var vs_id = $(this).data('vs_id');
            var value = $(this).data('value'); 
            var created_at = $(this).data('created_at');
            console.log(created_at);

            $('#RestoreVSForm').submit(function(){
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('restoreVitalSign') }}",
                    data: {
                        patient_id: patient_id,
                        vital_sign_id: vs_id,
                        value: value,
                        created_at: created_at,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(){
                        refreshTB();
                        $('#RestoreVSModal').modal('hide');
                        toastr.info('Vital sign record restored!');
                    },
                    error: function(){
                        toastr.error('Something seems to be wrong :/');
                    }
                });
            });
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
                    { data: "updated_at", name: "updated_at" },
                    { data: "Action", name: "Action" }
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
                    { data: "created_at", name: "created_at" },
                    { data: "updated_at", name: "updated_at" },
                    { data: "Action", name: "Action" }
                ]
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