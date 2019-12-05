@extends('layouts.app')

@section('content')
<div class="wrapper">
    @include('pages.doctor.include.sidebar')
    <div class="main-panel">
        @include('pages.doctor.include.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <p class="card-category">TODAY'S APPOINTMENTS</p>
                                <h3 class="card-title" id="today-appoint"></h3>
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
                                <h3 class="card-title" id="requested-appoint"></h3>
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
                                <h3 class="card-title" id="patientcount-appoint"></h3>
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
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        $.ajax({
            url: '/appointment/today/',
            type: 'get',
            success: function(response){
                $('#today-appoint').text(response);
            }
        });
        
        $.ajax({
            url: '/appointment/request/',
            type: 'get',
            success: function(response){
                $('#requested-appoint').text(response);
            }
        });

        $.ajax({
            url: '/appointment/count/',
            type: 'get',
            success: function(response){
                $('#patientcount-appoint').text(response);
            }
        });
        md.initDashboardPageCharts();

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
    });
</script>
@endsection
