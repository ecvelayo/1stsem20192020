
{{-- {{-- This file is a template to be used for all the pages--} --}}


<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    
    
       
    {{-- side nav source files --}}
    <link href="{{asset('css\navbar-fixed-left.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/docs.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js\jquery-3.4.1.slim.min.js') }}" ></script>
    <script type="text/javascript" src="{{asset('js\bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js\docs.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- END  --}}

    {{-- <link href="{{asset('css/nav.css')}}" rel="stylesheet"> --}}


    </head>
    <body>
      
      {{-- Import the sidenav file found @ views/include/sideNavBar.blade.php --}}
      @include('include.sideNavBar')
      {{-- END --}}


      {{-- <div class="container-fluid" id='topnav'>
            <div class="row">
              <div class="col-md-12 hidden-xs hidden-sm">
        
                <h1>TEST </h1>
  
              </div>
             </div>
      </div> --}}
      

      <div class="container">
          <div class="row">
            <div class="col-md-12">
        
        {{--the content is used in page blade file @extends('layouts.app')  
        @section('content')
       -- content you want to make--
        @endsection
        --}}
             @yield('content')

            </div>
           </div>
    </div>
    </body>
</html>
