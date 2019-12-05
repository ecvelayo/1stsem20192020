<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'White Cross Medical Clinic') }}</title>
        
        <div id="loadOverlay" style="background-color:#fff; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
            <img src="{{ asset('img/loading_icon.svg') }}" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        </div>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @toastr_css
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-sm navbar-light fixed-top" id="MainNav">
                <div class="container py-2">
                    <a class="navbar-brand font-abril" href="{{ url('/') }}">
                        {{ config('app.name', 'White Cross Medical Clinic') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <i class="custom-navbar-icon material-icons">menu</i>
                    </button>
            
                    <div class="navbar-collapse collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#About">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#Services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#Contact">Contact</a>
                            </li>
                        </ul>
            
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                    </a>
            
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @auth
                                            @if(Auth::user()->role->description == 'ADMIN')
                                                <a class="dropdown-item" href="{{ route('admin.dashboard', ['name' => Auth::user()->username]) }}">Account</a>
                                            @elseif(Auth::user()->role->description == 'PATIENT')
                                                <a class="dropdown-item" href="{{ route('patient.appointments', ['name' => Auth::user()->username]) }}">Account</a>
                                            @elseif(Auth::user()->role->description == 'DOCTOR')
                                                <a class="dropdown-item" href="{{ route('doctor.dashboard', ['name' => Auth::user()->username]) }}">Account</a>
                                            @elseif(Auth::user()->role->description == 'NURSE')
                                                <a class="dropdown-item" href="{{ route('nurse.dashboard', ['name' => Auth::user()->username]) }}">Account</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                        @endauth

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
                    </div>
                </div>
            </nav>
            <section id="top-page">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/doctor.jpg') }}">
                            <div class="carousel-caption">
                                <h2 class="text-primary font-abril">White Cross Medical Clinic</h2>
                                <p>Medical Clinic and Clinical Laboratory in Cebu City<br>Opening at 9:00 AM on Monday</p>
                                <a class="btn btn-lg btn-primary js-scroll-trigger" href="#Contact" >Contact Us</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/image_1.jpg') }}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/image_2.jpg') }}">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
            <div class="container">
                <section id="About">
                    <div class="text-center mt-5 mb-4">
                        <i class="fas fa-users fa-3x"></i>
                        <h3 class="pt-1">About Us</h3>
                    </div>
                    <div class="row">
                        <div class="container">
                            <p><strong class="text-primary font-abril">White Cross Medical Clinic</strong> is a medical clinic and clinical laboratory, duly registered and licensed by the Department of Health, that consistently upholds its mission of rendering quality services to its patients. Established in 2016, WCMC is managed by a medically-inclined family whose priority is excellence at affordable prices. Additionally, we are continuously developing our capacity to reach out a broader scope of clients through providing multiple clinical services and instituting a major facility – that is, the White Cross Medical Clinic Drug Testing Center. Since we started, we have been true to our guiding principle of promoting health among our local clients by means of initiating health-giving community outreach programs.</p>
                            <br>
                            <h4>Our Vision</h4>
                            <p>We envision the White Cross Medical Clinic to be one of the fast-growing medical and laboratory centers in the City of Cebu, committed to provide quality clinical services through our ever proficient and passionate medical team and by means of utilizing state-of-the-art clinical facilities in order to ensure optimal health among local clients which aids them to become effective and efficient individuals in the society.</p>
                            <br>
                            <h4>Our Mission</h4>
                            <p>We are committed to:  
                                <br>&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dot-circle fa-xs"></i>&nbsp&nbsp&nbsp&nbspProfoundly excel in specialized medical practice supported by the ethical and competent medical staff.
                                <br>&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dot-circle fa-xs"></i>&nbsp&nbsp&nbsp&nbspTirelessly provide efficient access to affordable medical care among local clients.
                                <br>&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dot-circle fa-xs"></i>&nbsp&nbsp&nbsp&nbspActively become an instrument of nurtured physical health through quality services and facilities.
                                <br>&nbsp&nbsp&nbsp&nbsp<i class="fas fa-dot-circle fa-xs"></i>&nbsp&nbsp&nbsp&nbspPersistently ensure that White Cross Medical Clinic quality underlies every decision.
                            </p>
                        </div>
                    </div>
                </section>
                <hr class="featurette-divider">
                <section id="Services">
                    <div class="text-center mt-5 mb-3">
                        <span class="fas fa-briefcase-medical fa-3x"></span>
                        <h3 class="pt-1 pb-3">Medical Services</h3>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        @foreach ($data as $row)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$row->description}}</h6>
                                        <p class="card-category text-primary">PHP {{$row->rate}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <hr class="featurette-divider">
                <section id="Contact">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <h4 class="mb-3"><i class="fa fa-phone fa-sm" aria-hidden="true"></i> Contact</h4>
                            <a href="tel:+63-32-255-0305" class="btn btn-primary mb-3">Call (032) 255 0305</a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <h4 class="mb-3"><i class="fas fa-map-marker-alt text-danger"></i> Address</h4>
                            <a href="https://www.google.com/maps/dir//White+Cross+Medical+Clinic/data=!4m8!4m7!1m0!1m5!1m1!1s0x33a99be239d7dd09:0xa9513e6c377f466!2m2!1d123.9013602!2d10.2950368" target="_blank" class="btn btn-primary mb-3">Get Directions</a>
                            <p>Room 205 Teodora Building, Osmeña Boulevard Corner D. Jakosalem Street
                                <br>Cebu City, 6000 Cebu
                                <br>Philippines
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <h4 class="mb-3"><i class="fas fa-clock"></i> Business Hours</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Mon&nbsp&nbsp&nbsp&nbsp</td>
                                        <td>9:00 AM – 5:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Tue&nbsp&nbsp&nbsp&nbsp</td>
                                        <td>9:00 AM – 5:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Wed&nbsp&nbsp&nbsp&nbsp</td>
                                        <td>9:00 AM – 5:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Thu&nbsp&nbsp&nbsp&nbsp</td>
                                        <td>9:00 AM – 5:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Fri&nbsp&nbsp&nbsp&nbsp</td>
                                        <td>9:00 AM – 5:00 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <hr class="featurette-divider">
            </div>
        </div>
        <div id="ScrollTop">
            <a class="js-scroll-trigger" href="#top-page"><i class="fas fa-chevron-up fa-lg text-white"></i></a>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script>
            $( document ).ready(function() {

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
        
                var navbarCollapse = function() {
                    if ($("#MainNav").offset().top > 100) {
                        $("#MainNav").addClass("navbar-shrink");
                        $("#ScrollTop").addClass("fixed-plugin");
                    } else {
                        $("#MainNav").removeClass("navbar-shrink");
                        $("#ScrollTop").removeClass("fixed-plugin");
                    }
                };
        
                navbarCollapse();
        
                $(window).scroll(navbarCollapse);
            });
        </script>
    </body>
    @toastr_render
</html>
