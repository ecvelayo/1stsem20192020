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
                                    <div>MEDICAL SERVICE</div>
                                    <div><button type="button" class="btn btn-secondary btn-sm my-0" data-toggle="modal" id="Add_Button" data-target="#AddModal">+ Add Service</button></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="medical_service_table" class="table display table-bordered nowrap compact">
                                        <thead>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th>Rate</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                        @if(count($services))
                                            @foreach($services as $service)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td>{{ $service->rate }}</td>
                                                <td>
                                                    <a href="#" id="Edit_Button" data-service="{{ $service }}" data-toggle="modal" data-target="#EditModal"><i class="fas fa-edit text-warning mx-1"></i></a>
                                                    @if($service->deleted_at == NULL)
                                                        <a href="#" id="Delete_Button" data-id="{{ $service->medical_service_id }}" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="#" id="Restore_Button" data-id="{{ $service->medical_service_id }}" data-toggle="modal" data-target="#RestoreModal"><i class="fas fa-trash-restore primary"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
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

<!-- Add Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="AddForm" method="POST" action="{{route('admin_service.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group col-12">
                        <label for="description"><i class="fa fa-file pr-2" aria-hidden="true"></i>Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="">
                    </div>
                    <div class="form-group col-12">
                        <label for="rate"><i class="fas fa-coins pr-2"></i>Rate</label>
                        <input type="number" name="rate" id="rate" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            *</form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medical Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="EditForm" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="Edit_description" class="form-control" value="">
                    </div>
                    <div class="form-group col-12">
                        <label for="rate">Rate</label>
                        <input type="number" name="rate" id="Edit_rate" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            *</form>
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
                        @csrf
                        @method('delete')
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
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle fa-3x text-primary pt-4" aria-hidden="true"></i>
                <h3>Are you sure?</h3>
                <p></p>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center w-100">
                    <form id="RestoreForm" method="GET">
                        <button type="submit" class="btn btn-primary">YES, RESTORE IT!</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">NO, LEAVE IT</button>
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
        
        var medical_service_table = $('#medical_service_table').DataTable();

        medical_service_table.on('click', '#Edit_Button', function(){
            var service = $(this).data('service');
            var route = "{{route('admin_service.update', '')}}/"+service.medical_service_id;
            $('#EditForm').attr('action', route);
            $('#Edit_description').val(service.description);
            $('#Edit_rate').val(service.rate);
        });

        medical_service_table.on('click', '#Delete_Button', function(){
            var service = $(this).data('id');
            var route = "{{route('admin_service.destroy', '')}}/"+service;
            $('#DeleteForm').attr('action', route);
        });
        
        medical_service_table.on('click', '#Restore_Button', function(){
            var service = $(this).data('id');
            var route = "{{route('admin_service.restore', '')}}/"+service;
            $('#RestoreForm').attr('action', route);
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