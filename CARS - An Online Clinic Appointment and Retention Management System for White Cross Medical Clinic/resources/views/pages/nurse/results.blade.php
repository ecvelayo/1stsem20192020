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
                                <div class="d-flex justify-content-end w-100">
                                    <button type="button" class="btn btn-secondary btn-sm m-0" data-toggle="modal" data-target="#uploadModal"><i class="fas fa-file-upload pr-2"></i>Upload Results</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end w-100">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <form id="resultForm">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <label>Search Patient:</label>
                                                    </span>
                                                </div>
                                                <input id="patient_id" name="patient_id" list="patient_list" class="form-control" autocomplete="off">
                                                <input type="hidden" id="patient_hidden" name="patient_hidden">
                                                <datalist id="patient_list">
                                                    @foreach ($patients as $patient)
                                                        <option data-value="{{ $patient->id }}" value="{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}"></option>
                                                    @endforeach
                                                </datalist>
                                                <button type="submit" class="btn btn-primary btn-round btn-sm"><i class="fas fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                    </div>   
                                </div>
                                <table id="result_tb" class="table display table-bordered nowrap compact" style="font-size: 1em; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Patient's Name</th>
                                            <th>Description</th>
                                            <th>Add On</th>
                                            <th>Last Update</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
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

<!-- Add Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadForm">
                @csrf
                <div class="modal-body">
                    <div class="p-5">
                        <div class="form-group">
                            <label><i class="fa fa-user pr-2" aria-hidden="true"></i>Patient</label>
                            <input id="patient_mdl" name="patient_mdl" list="patient_list" class="form-control" autocomplete="off">
                            <input type="hidden" id="patient" name="patient">
                            <datalist id="patient_list_mdl">
                                @foreach ($patients as $patient)
                                    <option data-value="{{ $patient->id }}" value="{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-pen pr-2"></i>Description</label>
                            <select name="description" id="description" class="form-control">
                                @foreach ($services as $service)
                                    @if($service->medical_service_id != 1)
                                        <option value="{{$service->description}}">{{$service->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-2">
                            <label><i class="fa fa-file pr-2" aria-hidden="true"></i>Upload File</label>
                            <input type="file" class="form-control" id="upload_file" name="upload_file" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditForm">
                <div class="modal-body">
                    <div class="p-5">
                        <div class="form-group">
                            <label><i class="fas fa-pen pr-2"></i>Description</label>
                            <select name="description_edit" id="description_edit" class="form-control">
                                @foreach ($services as $service)
                                    @if($service->medical_service_id != 1)
                                        <option value="{{$service->description}}">{{$service->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save</button>
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
                    <form id="DeleteForm" method="POST">
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
        
        $('#patient_id').change(function(){
            var label = $('#patient_id').val();
            var patient_id = $('#patient_list [value="' + label + '"]').data('value');

            $('#patient_hidden').val(patient_id);
        });

        $('#patient_mdl').change(function(){
            var label = $('#patient_mdl').val();
            var patient_id = $('#patient_list_mdl [value="' + label + '"]').data('value');

            $('#patient').val(patient_id);
        });

        $('#uploadForm').submit(function(e){
            e.preventDefault();

            var patient_id = $('#patient').val();

            $.ajax({
                type: 'POST',
                
                contentType: false,
                url: "{{ route('results.store') }}",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response){
                    $('#uploadModal').modal('hide');
                    refresh(patient_id);
                    if(response.type == 'error'){
                        toastr.error(response.message);
                    }else{
                        toastr.success(response.message);
                    }
                }
            });
        });

        var result_tb = $('#result_tb').DataTable({
            "searching": false,
            "bLengthChange": false,
            "scrollX": true,
        });

        $('#resultForm').submit(function(e){
            e.preventDefault();
            
            var patient_id = $('#patient_hidden').val();
            refresh(patient_id);
        })

        function refresh(patient_id){
            $('#result_tb').DataTable().destroy();
            $('#result_tb').DataTable({
                "searching": false,
                "bLengthChange": false,
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('results.patientResults') }}",
                    data: {
                        '_token' : "{{csrf_token() }}",
                        patient_hidden: patient_id
                    }
                },
                columns: [
                    { data: "patient_name", name : "patient_name"},
                    { data: "description", name: "description" },
                    { data: "created_at", name: "created_at" },
                    { data: "updated_at", name: "updated_at" },
                    { data: "Status", name: "Status" },
                    { data: "Action", name: "Action" }
                ],
                columnDefs: [
                    { className: 'text-center', "targets": [4] }
                ],
                success: function(){
                    toastr.info('Successful!');
                },
                error: function(){
                    toastr.error('Error!');
                }
            });
        }

        result_tb.on('click', '#DeleteBtn', function(){
            var id = $(this).data('id');
            var route = "{{ route('results.destroy', '')}}/"+id;

            $('#DeleteForm').submit(function(e){
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: route,
                    data: {
                        id: id,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(response){
                        $('#DeleteModal').modal('hide');
                        refresh($('#patient_hidden').val());
                        toastr.info(response.message);
                    }
                });
            });
        });

        result_tb.on('click', '#EditBtn', function() {
            var id = $(this).data('id');
            var des = $(this).data('des');
            var route = "{{ route('results.update', '') }}/"+id;
            var description = $('#description_edit').val(des);

            $('#EditForm').submit(function(e){
                e.preventDefault();

                var newDes = $('#description_edit').val();
                console.log(newDes);
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {
                        description: newDes,
                        id: id,
                        '_token' : "{{csrf_token() }}"
                    },
                    success: function(response){
                        $('#EditModal').modal('hide');
                        refresh($('#patient_hidden').val());
                        toastr.info(response.message);
                    }
                });
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