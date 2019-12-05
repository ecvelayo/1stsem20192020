<head>
<!-- Icon Tab -->
<link rel="icon" href="../imgs/final.png" type="image" sizes="50x50">
    
</head>
@extends('layouts.app')
@section('content')
{{-- {{ Session::forget('email') }}
{{ Session::forget('password') }} --}}
<section id= "home">
    <div class="card">
        
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="-webkit-box-shadow: 0 8px 6px -6px #999;
        -moz-box-shadow: 0 8px 6px -6px #999;
        box-shadow: 0 8px 6px -6px #999;height:70px;">


            <!-- Brand -->
            <a class="navbar-brand" href="#"><img class="logo" src="imgs/final.png" width="80px" height="70px"></a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collap">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collap">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#history">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Our Team</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div id="img-holder" style="background:url(imgs/ros1.jpg);height:700px;background-repeat:no-repeat;background-size:cover;">	
        <br>
        <div class="container py-5" style="width:500px;height:90px;margin-right:10px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                            <div class="card-header" style="background-color: #a23131;color:white;font-size:18px;">{{ __('Login') }}</div>

                                <div class="card-body">



                                <form method="POST" action="{{ route('login.custom') }}">
                            @csrf

                            <div class="form-group row">
                            
                                <label for="email" class="col-md-6">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-6">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        <div class="dropdown-divider"></div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                   
                                        <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        @if (Route::has('password.request'))
                                <div class="form-group row mb-0">

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                          @endif
                         <div class="form-group row mb-0">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
        </div>          
    </div>
                
</section>
 <!-- History-->
    <section id="history" style="margin-top:50px;">
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>History</h2>
                        
                        
                        <p>In 1907 Lola Titay made a ring-shaped cookie which she sold in her bakeshop.
                        The business was run just like a typical small neighborhood business in the old 
                        countryside community in northern Cebu.
                        Soon their grandmother Mama Corazon took over in 1999. 
                        It was in her time when more products were introduced such as  
                        bread, pastries and biscuits like otap.
                        According to Aljew Fernando J. Frasco,
                         chief executive officer of Titay’s Liloan Rosquillos and Delicacies, Inc.,
                         their father Gerardo also helped in running the family business.      </p>
                      
                         <div class="collapse" id="collapse">
                        
                            Rosquillos are cookies that originated from the Municipality of Liloan, Cebu.
                            The cookies are circular in shape with flower-like edges and a ring-shaped hole in the center. 
                            It is a snack unique to Cebu and is a favorite snack of locals and expatriate Cebuanos 
                            in the United States. The late Philippine president Sergio Osmeña Sr. reputedly gave the
                             name of rosquillos from the Spanish word rosca, meaning ringlet.

                            Margarita “Titay” T. Frasco created the rosquillos in 1907 in the town of Liloan.
                           She later founded Titay’s Liloan Rosquillos and Delicacies Inc., the pioneer and
                          premier company producing delicious and fine-quality rosquillos in Cebu.
                          Descendants of her family presently run the company, which now produces other native snacks.
                          Titay’s Rosquillos supplies and delivers its products to supermarkets in Cebu City
                          and has several retail outlets in the city.
                            
                            The packaging of the rosquillos states that the cookies are made
                            of flour, eggs, shortening, sugar and baking powder, with no preservatives 
                            and artificial colorings. However, descendants of the Frasco family claim that
                            the recipe for the rosquillos is a patented family recipe passed on to succeeding
                            generations of the family.
                            
                            Although there have been other bakeshops creating and selling their own rosquillos,
                            many people still attest that they prefer the original Titay’s Rosquillos because of its
                            unique and delicious taste.
                            
                            Titay’s is located in Poblacion, Liloan, Cebu. You may call them at (032)564-2993 or 424-8888. 
                       
                        </div>
                        <br><button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapse">Read more >>
                        </button>
                      </div>
                      
                
           </div>
        </section> 
   <!--Our Team-->
   <section id="team" style="margin-top:150px;">
            <div class="container">
                <h1>Our Team</h1>
                <div class="row">
                    <div class="col-md-3 profile-pic text-center">
                    <div class="img-box">
                        <img src="imgs/pic4.jpg" class="img-responsive" style="height: 250px;">

                    </div><h2>Vincent Franco "Duke" Frasco</h2>
                    <h5>Chief Operating Officer</h5>
                    <p>5th District Congressman of Cebu Province</p>
                   
                    </div>
                    <div class="col-md-3 profile-pic text-center">
                            <div class="img-box">
                                <img src="imgs/pic1.jpg" class="img-responsive" style="height: 250px;">
        
                            </div>
                            <h2>Aljew Fernando Frasco</h2>
                                    <h5>Chief Executive Officer/ Owner</h5>
                                    <p>Councilor of Liloan</p>
                            </div>
                            <div class="col-md-3 profile-pic text-center">
                                    <div class="img-box">
                                        <img src="imgs/pic3.jpg" class="img-responsive" style="height: 250px;">
                
                                    </div>
                                    
                              <h2>Don Gerardo Frasco</h2>
                            <h5>Chief Financial Officer</h5>
                            <p>Director</p>
                            </div>
                            <div class="col-md-3 profile-pic text-center">
                                    <div class="img-box">
                                        <img src="imgs/pic6.jpg" class="img-responsive" style="height: 250px; width:250px;">
                
                                    </div>
                                    
                              <h2>Margarita Frasco</h2><br>
                            <h5>Chief Operational Officer</h5>
                            <p>Business woman</p>
                            
                                    </div>
                </div>
            </div> 
        </section>
      

  
@endsection
   