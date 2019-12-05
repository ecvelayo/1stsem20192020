@extends('layouts.app')

@section('content')
<div class="wrapper ">
    @include('pages.patient.include.sidebar')
    <div class="main-panel">
        @include('pages.patient.include.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                Lab Results
                            </div>
                            <div class="card-body">
                                <table id="results_tb" class="table display table-bordered nowrap compact" style="font-size: 1em; width: 100%;">
                                    <thead>
                                        <tr>
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

@endsection


@section('script')
<script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script>
<script>
    $( document ).ready(function() {
        
        $('#results_tb').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "POST",
                url: "{{ route('patient.resultsForPatient') }}",
                data: {
                    '_token' : "{{csrf_token() }}"
                }
            },
            columns: [
                { data: "description", name: "description"},
                { data: "created_at", name: "created_at"},
                { data: "updated_at", name: "updated_at"},
                { data: "Status", name: "Status"},
                { data: "Action", name: "Action"},
            ]
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