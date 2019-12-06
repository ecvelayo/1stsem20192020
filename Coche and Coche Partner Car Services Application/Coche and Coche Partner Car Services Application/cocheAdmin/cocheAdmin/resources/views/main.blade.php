    
<!DOCTYPE html>

<html lang="en">

<head>
    
    @include('parts.header')

</head>

<body>
    <div class="wrapper">

    <div class="sidebar" data-color="red" data-image="{{asset('vendor/assets/img/sidebar-6.jpg')}}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <h3>
                        COCHE
                    </h3>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ URL('dashboard') }}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ URL('cochepartner') }}">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Coche Partners</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ URL('deniedpartner') }}">
                            <i class="nc-icon nc-scissors"></i>
                            <p>Denied Requests</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ URL('transactions') }}">
                            <i class="nc-icon nc-notes"></i>
                            <p>Transactions History</p>
                        </a>
                    </li>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">

	    @include('parts.nav')


            <div class="content">
            <div class="container-fluid">
                      


        @include('parts.script')



	    @yield('content')

	        </div>
            </div>

		</div>
		</div>



		




</body>



@include('parts.footer')

</html>




