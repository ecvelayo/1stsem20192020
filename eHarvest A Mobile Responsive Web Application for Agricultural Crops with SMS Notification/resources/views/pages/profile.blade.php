@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container">
    <div class="row">
        <div class="col-sm-10 ml-3 ml-sm-auto mr-sm-auto" id="profilerow">
            <div class="d-block row">

                <br>

                        <div class="cardprofile">
                            <div class="d-block profiletop">
                                <div class="hovereffect">

                                  <img src="{{ Auth::user()->photo }}" id="prof_pic" class="img-fluid">
                                    <div class="overlay">
                                      <button class="btn cbuttons" data-toggle="modal" data-target="#productModal3" style="color:white;">Change Photo</button>

                                    </div>
                                </div>

                                <!-- <div class="hovereffect1">
                                        <img src="/storage/{{ Auth::user()->photo }}" id="prof_pic" class="img-fluid">
                                        <div class="overlay">


                                          <a class="info" data-toggle="modal" data-target="#productModal3">Change Photo</a>
                                        </div>
                                      </div> -->
                                    <br>
                                <div class="btn-group-vertical" id="profilebtngrp">
                                  <button class="btn btn-success" data-toggle="modal" data-target="#productModal">Edit
                                    Profile</button>
                                    <a class="btn btn-success" href="/changePassword">Change Password</a>


                                </div>

                            </div>

                            <div class="userinfo">

                                <p> <b>First Name:</b></p>
                                <p> <b>Last Name:</b></p>
                                <p> <b>Email:</b></p>
                                <p> <b>Birthdate:</b></p>
                                <p> <b>Contact Number:</b></p>
                                <p> <b>Address:</b></p>
                            </div>
                            <div class="vl d-none d-lg-block"></div>
                            <div class="userinfo2">
                                <p> <b></b> {{ Auth::user()->firstname }} </p>
                                <p> <b></b> {{ Auth::user()->lastname }} </p>
                                <p> <b></b> {{ Auth::user()->email }} </p>
                                <p> <b></b> {{ Carbon\Carbon::parse(Auth::user()->birthdate)->format('M d, Y') }} </p>
                                <p> <b></b> 0{{ substr(Auth::user()->contact, 2) }} </p>
                                <p> <b></b> {{ Auth::user()->address }} </p>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Modal for Change Profile Photo --}}

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" id="productModal3">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="mowdal">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productModalLabel">Upload New Photo</h4>

                        <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>




                    <div class="modal-body">
                        <form method="POST" action="/changePP" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label text-md-right">Upload Photo</label>

                        <div class="col-sm-6">
                            <input  id="photo" type="file"
                                class="form-control-file {{$errors->has('photo') ? ' is-invalid ' : ''}}"
                                name="photo" autofocus required accept="image/x-png,image/jpeg" >
                             <br>   <p style="color:red;"> Choose .jpg or .png file only.. </p>
                        </div>
                    </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>



        {{-- Modal for edit profile --}}

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" id="productModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="mowdal">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productModalLabel">Edit Profile</h4>

                        <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>




                    <div class="modal-body">
                        <!-- <form method="POST" action="/update" role="form" enctype="multipart/form-data"> -->
                        <form>
                            @csrf

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">

                                    <input id="firstname" type="text"
                                        class="form-control {{$errors->has('firstname') ? ' is-invalid ' : ''}}"
                                        name="firstname" value="{{ Auth::user()->firstname }}" autocomplete="firstname" required>
                                        <span class="text-danger d-none"  id="firstnameError"></span>

                                </div>



                            </div>


                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">

                                    <input id="lastname" type="text"
                                        class="form-control {{$errors->has('lastname') ? ' is-invalid ' : ''}}"
                                        name="lastname" value="{{ Auth::user()->lastname }}" autocomplete="lastname" required>
                                        <span class="text-danger d-none"  id="lastnameError"></span>

                                </div>



                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">Contact No.</label>

                                <div class="col-md-6">

                                    <input id="contact" type="text"
                                        class="form-control {{$errors->has('contact') ? ' is-invalid ' : ''}}"
                                        name="contact" value="0{{ substr(Auth::user()->contact, 2) }}" autocomplete="contact" required>
                                        <span class="text-danger d-none" id="contactError"></span>

                                </div>



                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">

                                    <input id="address" type="text"
                                        class="form-control {{$errors->has('address') ? ' is-invalid ' : ''}}"
                                        name="address" value="{{ Auth::user()->address }}" autocomplete="address" required>
                                        <span class="text-danger d-none"  id="addressError"></span>

                                </div>



                            </div>

                            <div class="form-group row">
                                <label for="bdate" class="col-md-4 col-form-label text-md-right">Birthdate</label>

                                <div class="col-md-6">

                                    <input id="bdate" type="date"
                                        class="form-control {{$errors->has('bdate') ? ' is-invalid ' : ''}}"
                                        name="bdate" value="{{ Auth::user()->birthdate }}" autocomplete="bdate" required>
                                        <span class="text-danger d-none"  id="bdateError"></span>

                                </div>



                            </div>


                          </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" onclick="storeData();">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>


        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
        var id // global variable
        function storeData(){
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var contact = $("#contact").val();
            var address = $("#address").val();
            var bdate = $("#bdate").val();


            event.preventDefault();
             $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });



            swal({
              title: "Are you sure?",
              text: "Do you want to change your user details?",
              icon: "warning",
              buttons: true,
              dangerMode: true
            }).then((willDelete) => {
              if (willDelete) {

                $.ajax({
                    type:'POST',
                    url:'/update',

                    data:{firstname:firstname,lastname:lastname,contact:contact,address:address,bdate:bdate},
                    success:function(data) {

                      // alert(JSON.stringify(data))

                      location.reload();

                    },
                    error: function(data) {

                        var errors = data.responseJSON;
                        // console.log(errors.errors.delivery_charge);
                        if($.isEmptyObject(errors) == false){
                            $.each(errors.errors,function(key,value){

                                var errorID = '#' + key + 'Error';
                                $(errorID).removeClass("d-none");
                                $(errorID).text(value);
                            })
                        }
                    }
                });


              } else {
                swal("User details was not updated.");
              }
            });




        }

        </script>

        @endsection
