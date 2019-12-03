@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
  
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>


                                {{-- first name input --}}
                            <div class="form-group row">
                                    <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }} <font color="red">*</font></label>

                                    <div class="col-md-6">
                                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>

                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                     {{-- last name input  --}}
                                <div class="form-group row">
                                        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} <font color="red">*</font></label>

                                        <div class="col-md-6">
                                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                     {{-- contact number name input  --}}
                                <div class="form-group row">
                                        <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }} <font color="red">*</font></label>

                                        <div class="col-md-6">
                                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" autocomplete="contact" autofocus>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                     {{-- address name input  --}}
                                <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} <font color="red">*</font></label>

                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                     {{-- birth date name input  --}}
                                <div class="form-group row">
                                        <label for="bday" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }} <font color="red">*</font></label>

                                        <div class="col-md-6">
                                            <input id="bday" type="date" class="form-control @error('bday') is-invalid @enderror" name="bday" value="{{ old('bday') }}" autocomplete="bday" autofocus>
                                            
                                            @error('bday')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                   
                                   
                                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                    <p>By clicking Register, you agree to our <a style="cursor:pointer" data-toggle="modal" data-target="#tc" id="term"> Terms & Condition </a>.
                                     </p>
                                     <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check">
                                            <label class="custom-control-label" for="check">I have read & I agree</label>
                                          </div><br>

                                     
                                <button type="submit" class="btn btn-primary" id="register">  
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end --}}

 
      
      <!-- Modal -->
      <div class="modal fade" id="tc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Terms & Conditions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <p>These terms and conditions outline the rules and regulations for the use of eharvest's Website.</p>
                    {{-- <span style="text-transform: capitalize;"> eharvest</span> is located at:<br /> 
                    <address>USC Cebu <br />600 - ASIA , Philippines<br />
                    </address> --}}
                    <p>By accessing this website we assume you accept these terms and conditions in full. Do not continue to use eharvest's website 
                            if you do not accept all of the terms and conditions stated on this page.</p>
                <strong>  <span>About eHarvest:</span></strong><br /> 
                  <p>Welcome to E-harvest. A webbased application for farmers
                        and consumers that caters the
                        needs of a fresh produce
                        agricultural crops.
                        We believe that this will give
                        you convenience and comfort
                        while ordering the needed
                        produce at the comfort of your
                        home.

                  </p>

                  <strong>    <span>Registration of Service:</span></strong><br /> 
                  <p>
                        1. If the consumer would like to
                        access, order and purchase
                        products from the platform, a
                        registration is provided to
                        make an account. In order to
                        register, the consumer must
                        provide the name, address, email address and contact number. <br>
                        2. If the consumer wants to be a farmer
                        or driver, just contact us.

                  </p>

                  <strong>   <span>Orders:</span></strong><br /> 
                  <p>
                        At eHarvest, once the order is checked out the order cannot be cancelled. Users should then wait for the order to be accepted by the admin.
                        In the case that the order has been Cancelled/Declined an SMS notification would then be sent to the users with the reason along with
                      details concerning the cancellation of the order.
                  </p>



                  <strong>   <span>Shipping and Delivery:</span></strong><br /> 
                  <p>
                        1. eHarvest will accept the
                        buyer’s purchase and
                        makes the necessary
                        arrangements and provides
                        details of the buyer such
                        as the delivery date, the
                        tracking number and
                        amount to the buyer
                        through sms. <br>
                        2. eHarvest aims to deliver
                        the products within the
                        agreed day which is EVERY WEDNESDAY AND SUNDAY
                        ONLY.<br>
                        3. At eHarvest, our
                        customers can avail the
                        FREE SHIPPING OF ITEMS
                        for orders Php 1000 and
                        up. All orders below this
                        amount will have a
                        delivery charge worth Php
                        50. 

                  </p>

                  <strong>   <span>Mode of Payment:</span></strong><br /> 
                  <p>
                        eHarvest ONLY accepts
                        payment through CASH ON
                        DELIVERY, no any other
                        payment method.
                  </p>

                  <strong>   <span>Product:</span></strong><br /> 
                  <p>
                        Images of the product may
                        vary and differ from the
                        actual product.
                        
                  </p>

                 <strong> <span>Discount Offers:</span></strong><br /> 
                  <p>
                        eHarvest offers
                        promotional discounts to
                        the products. Final price
                        is already reflected as 
                        the price adjustment is
                        already applied.
                        
                  </p>
                  




            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
            </div>
          </div>
        </div>
      </div>

        <script type="text/javascript"> 

$(document).ready(function() { 
    $("#register").attr("disabled", true);


    $("#check").click(function() {
   $("#register").attr("disabled", !this.checked);
});

});
 


    </script>

@endsection
