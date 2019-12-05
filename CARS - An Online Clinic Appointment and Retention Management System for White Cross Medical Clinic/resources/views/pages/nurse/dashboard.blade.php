@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.nurse.include.sidebar')
    <div class="main-panel">
        @include('pages.nurse.include.navbar')
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <p class="card-category">TODAY'S APPOINTMENTS</p>
                                <h3 class="card-title" id="today-appoint">{{$todaystaff}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <p class="card-category">REQUESTED APPOINTMENTS</p>
                                <h3 class="card-title" id="requested-appoint">{{$patientrequeststaff}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <p class="card-category">NO. OF PATIENTS</p>
                                <h3 class="card-title" id="patientcount-appoint">{{$patientcountstaff}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@include('pages.admin.include.profile')

@endsection

@section('script')
<script src="{{ asset('vendor/material/js/material-dashboard.js') }}"></script>
<script src="{{ asset('vendor/material/demo/demo.js') }}"></script>
<script>
    $( document ).ready(function() {

        $.ajax({
            url: '/appointment/todayn/',
            type: 'get',
            success: function(response){
                $('#today-appoint').text(response);
            }
        });
        
        $.ajax({
            url: '/appointment/requestn/',
            type: 'get',
            success: function(response){
                $('#requested-appoint').text(response);
            }
        });

        $.ajax({
            url: '/appointment/countn/',
            type: 'get',
            success: function(response){
                $('#patientcount-appoint').text(response);
            }
        });
        
        LoadNotification();
        md.initDashboardPageCharts();
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
