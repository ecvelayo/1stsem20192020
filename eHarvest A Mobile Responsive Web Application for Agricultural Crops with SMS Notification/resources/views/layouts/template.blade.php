<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href={{asset("/images/link.png")}}>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{asset('website\js\jquery-1.11.1.min.js')}}"></script>
    {{-- <script type="text/javascript" src='https://kit.fontawesome.com/a076d05399.js'></script> --}}
    
    <!-- for dropdown in notifications -->
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{asset('css\navbar-fixed-left.min.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    {{-- buttons --}}
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <script src="{{url( 'vendor/jquery.min.js' )}}"></script>

<script src="{{url( 'vendor/Chart.min.js' )}}"></script>

<script src="{{url( 'vendor/create-charts.js' )}}"></script>




    <style>
        input[type=text] {
            width: 100%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            /* padding: 12px 20px 12px 40px; */
        }

        #searchButton {
            background-color: white;
        }

        #topnav {
            position: fixed;
            top: 0px;
            width: 100%;
            z-index: 1;
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: white;
            background: url('images\logo.gif') 50% 50% no-repeat rgb(249, 249, 249);
        }

        .loader img {
            position: relative;
            left: 40%;
            top: 40%;
        }

    </style>
</head>

<body>
    @include('include.sideNavBar')
    @include('sweet::alert')

    <div id="app">


        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>

</html>
 
 
<script>

    //Preloader
    window.onload = function(){ 
        // loader on page load 
         $('.loader').fadeOut();
         
      }	
    
 


 



</script>