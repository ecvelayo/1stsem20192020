<!DOCTYPE HTML>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <title>Coche Admin Login Page</title>

  <meta name="keywords" content="" />
  <meta name="description" content="" />

  <!-- css -->
  <link rel="stylesheet" href="{{asset('Bootslander/css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('Bootslander/css/bootstrap-responsive.css')}}" />
  <link rel="stylesheet" href="{{asset('Bootslander/css/prettyPhoto.css')}}" />
  <link rel="stylesheet" href="{{asset('Bootslander/css/sequence.css')}}" />
  <link rel="stylesheet" href="{{asset('Bootslander/css/style.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">



  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('Bootslander/img/favicon.ico')}}">

  <!-- =======================================================
    Theme Name: Bootslander
    Theme URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
	======================================================= -->
</head>

<body>

  <!-- main wrap -->
  <div class="main-wrap">

    <!-- header -->
    <header>
      <!-- top area -->
      <div class="top-nav">
        <div class="wrapper">
          <div class="logo">
            <a href="#">
              <!-- your logo image -->
              <img width="60" height="60" src="{{asset('Bootslander/img/coche_logo.png')}}" alt="" />
            </a>
          </div>

          <div class="phone">
            <p>Welcome Admin!</p>
          </div>
        </div>
      </div>
      <!-- end top area -->
    </header>
    <!-- end of header-->

    <!-- section intro -->
    <section id="intro">
      <div class="featured">
        <div class="wrapper">

          <div class="row-fluid">

                <div class="col-md-4">
                      <img align="left" width="280" height="560" class="model" src="{{asset('Bootslander/img/slides/img1.png')}}" alt="" />
                      <!--login-->
    <div class="login-clean">
        <form method="post" action="{{URL::to('/loginnow')}}">
                  {{ csrf_field() }}
            <h2 class="sr-only">Login to your Account</h2>
              @if ($errors->has('message'))
              <div class="has-error">
                  <span class="help-block text-center"><h5>{{ $errors->first('message') }}</h5></span>
              </div>
              @endif
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <!--end of login-->
                </div>
                        
          </div>

        </div>
      </div>   
    </section>
    <!-- end section intro -->




    
    <!-- footer -->
    <footer>
      <div class="footer">
        <div class="wrapper">
          

          <div class="subfooter">
            <ul>
              <li><a href="#">Home</a> &#45; </li>
              <li><a href="#">Terms conditions</a> &#45; </li>
              <li><a href="#">Contact</a></li>
            </ul>
            <p class="copyright">&#169; Copyright. All rights reserved</p>

          </div>
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bootslander
            -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>
    </footer>


  </div>
  <!-- end main wrap -->

  <!-- Javascript Libraries -->
  <script src="{{asset('Bootslander/js/jquery.min.js')}}"></script>
  <script src="{{asset('Bootslander/js/bootstrap.js')}}"></script>
  <script src="{{asset('Bootslander/js/jquery.prettyPhoto.js')}}"></script>
  <script src="{{asset('Bootslander/js/sequence.jquery.js')}}"></script>
  <script src="{{asset('Bootslander/js/jquery-hover-effect.js')}}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('Bootslander/contactform/contactform.js')}}"></script>

  <!-- Template Custom Javascript File -->
  <script src="{{asset('Bootslander/js/custom.js')}}"></script>

 

</body>

</html>
