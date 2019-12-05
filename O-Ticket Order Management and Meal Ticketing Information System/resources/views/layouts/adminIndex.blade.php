{{-- @if (Auth::user()->user_type == '0') --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <script lang="javascript" type="text/javascript">
            window.history.forward();
        </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

       <!-- jQuery library -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.bootstrap4.min.js"></script>
</head>
<body>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm flex-md-nowrap p-0" style="background-color:#a23131">
            <a class="navbar-brand col-sm-3 col-md-11 mr-0" href="#"><img class="logo" src="../imgs/logo.png" width="80px" height="70px" style="margin-top:-10px;"></a>
            {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Enter driver name" aria-label="Search"> --}}
            <ul class="navbar-nav px-4">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="text-white  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->firstname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <div class="app">
            <div class="row">

                

            <nav class="navbar col-md-2 d-none d-md-block navbar-light sidebar" style="background-color:#a23131; height: 700px">
                <div class="container">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('index') }}">{{ __('Dashboard') }}</a>
                            <span data-feather="home"></span>
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Registration
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('driver_registration') }}">{{ __('Driver') }}</a>
                                <a class="dropdown-item" href="{{ route('conductor_registration') }}">{{ __('Conductor') }}</a>
                                <a class="dropdown-item" href="{{ route('employee_registration') }}">{{ __('Employee') }}</a>
                                <div class="dropdown-divider">Meal</div>
                                <a class="dropdown-item" href="{{ route('add_meal') }}">{{ __('Meal') }}</a>
                                <div class="dropdown-divider">Branch</div>
                                <a class="dropdown-item" href="{{ route('add_branch') }}">{{ __('Branch') }}</a>
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item" href="#">SHS walay building</a> --}}
                                {{-- Add Account --}}
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('manage_accounts') }}">{{ __('Manage Accounts') }}</a>
                            <span data-feather="file"></span>
                            {{-- Manage Accounts --}}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('add_meal') }}">{{ __('Add Meal') }}</a>
                            <span data-feather="file"></span>
                            Add Meal Type
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('add_branch') }}">{{ __('Add Branch') }}</a>
                            <span data-feather="file"></span>
                            Add Branch
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('request') }}">{{ __('Request') }}</a>
                            <span data-feather="file"></span>
                            {{-- Request --}}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('reports') }}">{{ __('Reports') }}</a>
                            <span data-feather="file"></span>
                            Reports
                            </a> 
                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('redeem') }}">{{ __('Redeem') }}</a>
                            <span data-feather="file"></span>
                            {{-- Redeem Meal --}}
                            </a> 
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="py-4">
                @include('inc.message')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
{{-- @else 
    @php
        return redirect()->back();
    @endphp
@endif --}}