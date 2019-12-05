@extends('layouts.app')

@section('content')
<div class="wrapper ">
    @include('pages.patient.include.sidebar')
    <div class="main-panel">
        @include('pages.patient.include.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header card-header-primary"><i class="fas fa-search pr-2" aria-hidden="true"></i>Search Bill Payments</div>
                                    <div class="card-body">
                                        <form action="{{ route('patient.getPatientBilling') }}" method="POST">
                                            @csrf
                                            <div class="py-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label><i class="fa fa-calendar pr-2 text-secondary" aria-hidden="true"></i>Select Date Range</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 form-group pt-0 mt-0">
                                                        <label>From:</label>
                                                        <input id="start_date" name="start_date" type="date" class="form-control" required>
                                                    </div>
                                                    <div class="col-6 form-group pt-0 mt-0">
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
                            <div class="col-lg-7 col-sm-12 col-xs-12">
                                @isset($bills)
                                    @foreach ($bills as $b)
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h4 class="card-title text-primary">OR No. {{$b->services_availed_id}}</h4>
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
                                                                        @if ($s->medical_service_id == 1) 
                                                                        <br>
                                                                        <small class="text-secondary">
                                                                            Dr. 
                                                                            {{$s->appointment->doctor_schedule->doctor->first_name}}
                                                                            {{$s->appointment->doctor_schedule->doctor->middle_name}}
                                                                            {{$s->appointment->doctor_schedule->doctor->last_name}}
                                                                        </small>
                                                                        @endif
                                                                        
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