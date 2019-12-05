<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('fancybox/jquery.fancybox.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Chart.min.css') }}" rel="stylesheet">
    <style>
        .scroll {
            max-height: 300px;
            overflow-y: auto;
        }

    </style>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-success navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                        @if(Auth::user()->isRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('advisers') }}">Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('areas') }}">Areas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('projects') }}">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('reports/adviser-yearly') }}">Reports</a>
                            </li>
                        @endif

                        @if(Auth::user()->isRole('student'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('my-projects') }}">My Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('reports/monthly-view') }}">Reports</a>
                            </li>
                        @endif

                        @if(Auth::user()->isRole('adviser'))
                            <li class="nav-item">

                                <a class="nav-link" href="{{ url('my-handled-projects') }}">Handled Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('reports/handled-yearly') }}">Reports</a>
                            </li>
                        @endif

                        @if(Auth::user()->isRole('faculty'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('reports/handled-yearly') }}">Reports</a>
                            </li>
                        @endif

                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('register') }}">Register</a>
                        </li>
                    @else
                        @if(Auth::user()->isRole('adviser'))
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('my-handled-projects?title=&status=pending') }}" id="alertsDropdown" role="button">
                          <i class="fas fa-bell" style="font-size: 20px;margin-top: 0px"></i>
                          <span class="badge badge-danger" style="font-size: 10px" id="projectCount">0</span>
                        </a>
    
                        </li>
                        @elseif(Auth::user()->isRole('student') || Auth::user()->isRole('admin'))
                       <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-bell" style="font-size: 20px;margin-top: 0px"></i>
                              <span class="badge badge-danger" style="font-size: 10px" id="approveCount">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px" aria-labelledby="alertsDropdown">
                            <div>
                                <div class="card-header" style="height: 50px">Approved Projects</div>
                                    <div class="card-body scroll listInfo" id="listInfo" style="margin-left: 0;height: 300">
                                    
                   
                                    </div>
                                </div>
                            </div>
                    </li>




                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{  url('profile') }}">
                                    My Profile
                                </a>
                                <form id="logout-form" action="{{ url('logout') }}">
                                    <a class="dropdown-item" href="#" onclick="confirmLogout()" class="text-danger">
                                        Logout
                                    </a>
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if(session('loginMessage'))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('loginMessage') }}
                </div>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>
</div>
</body>
@stack('js')
<script>
  
$(document).ready(function () {

    //setTimeout(countNotes, 100);
    setTimeout(countApprove, 100);

    setTimeout(function() {
  countNotes() // runs first
  countApprove() // runs second
}, 100)


    function countNotes(){

        $.ajax({
            url: "{{URL::to('count-project')}}",
            type: 'GET',
            success: function(data){

                console.log(data);
                $("#projectCount").text(data.count);
            },
            complete:function(data){
                setTimeout(countNotes,3000);
            }
        });

    }

     function countApprove(){

        $.ajax({
            url: "{{URL::to('projectapprove')}}",
            type: 'GET',
            success: function(data){

                $("#approveCount").text(data.count);
                var appendValues = '';


                for(var a=0; a<data.details.length; a++){

                     appendValues += '<div style="border:thin black;background-color: lightgray">'
                     appendValues += '<p style="margin-top: 5px;font-size: 16px;margin-left: 50px">'+data.details[a].data.title+' is Approved by '+data.details[a].data.adviser_fname +' '+ data.details[a].data.adviser_lname  +'</p>'
                     appendValues += '<a href="{{URL::to("setNotife")}}/'+data.details[a].id+'/'+data.details[a].data.project_id+'"><button class="btn btn-primary" style="margin-left: 30px">View</button></a><div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>'
                 }


                 $( ".listInfo" ).html(appendValues);

            },
            complete:function(data){
                setTimeout(countApprove,3000);
            }
        });

    }
});



</script>


<script>
  function confirmLogout() {
    var x = confirm("Are you sure you want to logout?");
    if (x) {
      $("#logout-form").submit();
    }
    else {
      return;
    }
  }
</script>
</html>
