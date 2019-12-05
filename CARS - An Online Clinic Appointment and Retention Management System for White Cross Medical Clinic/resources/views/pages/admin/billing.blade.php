@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.admin.include.sidebar')
    <div class="main-panel">
        @include('pages.admin.include.navbar')
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header card-header-primary"><i class="fas fa-search" aria-hidden="true"></i> Search Bill Payments</div>
                                    <div class="card-body">
                                        <form action="{{ route('billing.getBilling') }}" method="POST">
                                            @csrf
                                            <div class="form-group py-3 pb-4">
                                                <label><i class="fa fa-user pr-2 text-secondary" aria-hidden="true"></i>Patient's Name</label>
                                                <input id="patient_id" name="patient_id" list="patient_list" class="form-control" placeholder="Select Patient" autocomplete="off" required>
                                                <input type="hidden" id="patient_hidden" name="patient_hidden">
                                                <datalist id="patient_list">
                                                    @foreach ($patients as $patient)
                                                        <option data-value="{{ $patient->id }}" value="{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}"></option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label><i class="fa fa-calendar pr-2 text-secondary" aria-hidden="true"></i>Select Date Range</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group pt-0 mt-0">
                                                        <label>From:</label>
                                                        <input id="start_date" name="start_date" type="date" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group pt-0 mt-0">
                                                        <label>To:</label>
                                                        <input id="end_date" name="end_date" type="date" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end w-100">
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search" aria-hidden="true"></i> Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                @isset($bills)
                                    @foreach ($bills as $b)
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between w-100">
                                                    <div>
                                                        <h4 class="card-title text-primary">OR No. {{$b->services_availed_id}}</h4>
                                                    </div>
                                                    <div></div>
                                                    <div>
                                                        @if ($b->deleted_at == NULL)
                                                            <button id="DeleteBtn" type="button" data-id="{{$b->services_availed_id}}" data-toggle="modal" data-target="#DeleteModal" class="btn btn-danger btn-sm">Delete</button>
                                                        @else
                                                            <button id="RestoreBtn" type="button" data-id="{{$b->services_availed_id}}" data-toggle="modal" data-target="#RestoreModal" class="btn btn-info btn-sm">Restore</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <p class="card-text" style="margin-bottom:3px;">Date: {{$b->created_at->format('F d, Y')}}</p>
                                                <p class="card-text">Patient: {{$b->patient->first_name}} {{$b->patient->last_name}}</p>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>DESCRIPTION</th>
                                                            <th>RATE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($services as $s)
                                                            @if ($b->services_availed_id == $s->services_availed_id)
                                                                <tr>
                                                                    <td>
                                                                        {{$s->medical_service->description}}
                                                                        {{-- @if ($s->medical_service_id == 1) 
                                                                        <br>
                                                                        <small class="text-secondary">
                                                                            Dr. 
                                                                            {{$s->appointment->doctor_schedule->doctor->first_name}}
                                                                            {{$s->appointment->doctor_schedule->doctor->middle_name}}
                                                                            {{$s->appointment->doctor_schedule->doctor->last_name}}
                                                                        </small>
                                                                        @endif --}}
                                                                        
                                                                    </td>
                                                                    <td>{{$s->medical_service->rate}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        <tr>
                                                            <th class="text-right">DISCOUNT</th>
                                                            <td>
                                                                @if ($b->discount != NULL)
                                                                    20%
                                                                @else
                                                                    <div class="text-secondary">N/A</div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-right">GRAND TOTAL</th>
                                                            <th class="text-primary">{{$b->total_amount}}</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="card-text">Staff: {{$b->staff->first_name}} {{$b->staff->last_name}}</p>
                                            </div>
                                        </div>
                                    @endforeach 
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <input type="hidden" id="del_id" value="">
                    <input type="hidden" id="del_date" value="">
                    <button id="DelSubmit" type="button" class="btn btn-danger">YES, DELETE IT!</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">NO, KEEP IT</button>
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
                    @csrf
                    <input type="hidden" id="restore_id" value="">
                    <input type="hidden" id="restore_date" value="">
                    <button id="RestoreSubmit" type="button" class="btn btn-primary">YES, RESTORE IT!</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">NO, LEAVE IT</button>
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

        $('#patient_id').change(function(){
            var label = $('#patient_id').val();
            var patient_id = $('#patient_list [value="' + label + '"]').data('value');
            
            $('#patient_hidden').val(patient_id);
        });

        $('#DelSubmit').click(function(){
            var id = $('#DeleteBtn').data('id');

            $.ajax({
                type: "POST",
                url: "{{ route('billing.destroy') }}",
                data: {
                    id: id,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(response){
                    toastr.info(response);
                    window.location.reload();
                },
                error: function() {
                    toastr.error('Error');
                }
            });
        })

        $('#RestoreSubmit').click(function(){
            var id = $('#RestoreBtn').data('id');
            
            $.ajax({
                type: "POST",
                url: "{{ route('billing.restore') }}",
                data: {
                    id: id,
                    '_token' : "{{csrf_token() }}"
                },
                success: function(response){
                    toastr.info(response);
                    window.location.reload();
                },
                error: function() {
                    toastr.error('Error');
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