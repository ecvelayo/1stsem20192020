
@include('auth.include.navbar')

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-9 col-xs-12">
            <div class="card">
                <div class="card-header card-header-primary text-center"><i class="fa fa-lock" aria-hidden="true"></i></div>

                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="username" class="col-md-12">{{ __('Username or E-Mail') }}</label>
                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control @error('email') is-invalid @enderror @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    {{ __('Remember Me') }}
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between w-100">
                                    <div>
                                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                    </div>
                                    <div>
                                        <a class="btn btn-link p-0 m-0 mt-3" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            var navbarCollapse = function() {
                if ($("#MainNav").offset().top > 100) {
                $("#MainNav").addClass("navbar-shrink");
                } else {
                $("#MainNav").removeClass("navbar-shrink");
                }
            };

            navbarCollapse();
            
            $(window).scroll(navbarCollapse);
        });
    </script>
@endsection
