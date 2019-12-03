@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container">
    <div class="row">
        <div class="col-sm-9 ml-sm-auto mr-sm-auto">
            <div class="card">

                <div class="card-body">
                    <div class="menu">
                        <br>
                        <h1>Product Information</h1>
                        <br>
                    </div>
                    <br>
                    <a href="{{ URL::previous() }}" class="btn btn-success" id="backbtn"><span>Back</span></a>

                    <div class="row">
                        {{-- image display --}}
                        @foreach($prod as $res)
                        <div class="col-sm-4 offset-sm-1" id="photo">

                            <div class="mt-4 d-inline">

                                <div class="mt-md-5 ">
                                    <img src="{{$res->photo}}" class="productImage img-fluid">
                                </div>
                            </div>
                        </div>
                        {{-- product description --}}
                        <div class="col-sm-6" id="photo">
                            <div class="d-inline">

                                <div class="rightdiv">
                                    <p> <b>Product Name:</b> {{$res->product_name}}</p>
                                    <p> <b>Type:</b> {{$res->type['name']}}</p>

 
                                    <p> <b>Price Per Unit:</b> ₱{{number_format($res->price, 2, '.', ',')}}/{{$res->unit['name']}}  </p>
                                    <p id="stocks"> <b>Quantity:</b> {{$res->quantity}}</p>
                                    <b>Description:</b> <p id="proddescription"> {{$res->product_description}} </p>

 
                                </div>



                            </div>
                        </div>
                        @endforeach

                    </div>


                    <div class="productInfoButtons">
                        <div class="col-sm-12 ml-sm-auto mr-sm-auto" id="productInfoButtons">
                            <hr>


                            <a onclick="followButton({{$prodid}})" class="btn btn-outline-success" id="btns">
                            <span id = "followStatus"class="btncontent">
                            @if(isset($followed))
                            Following
                            @else
                            Follow
                            @endif
                            </span></a>
                            <a class="btn btn-outline-success" data-toggle="modal"
                                data-target="#productModal" id="btns3"><span class="btncontent">Order</span></a>
                            <hr>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- modal for reserve  button --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" id="productModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="mowdal">
                <div class="modal-header">
                    <h4 class="modal-title" id="productModalLabel">Order Form</h4>

                    <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form enctype="multipart/form-data">
                        @csrf
                        @if(\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{\Session::get('success')}}</p>
                        </div>
                        @endif

                        @foreach($prod as $res)

                        <div class="modalleftdiv">
                            <img src="{{$res->photo}}" class="modalProductImage">
                        </div>
                        <div class="modalmiddlediv">

                        </div>

                        <div class="modalrightdiv">
                            <p> <b>Product Name:</b> {{$res->product_name}}</p>
                            <p id="stocks"> <b>Stocks:</b> {{$res->quantity}} </p>
                            <p id="stocks"> <b>Price per unit:</b> {{$res->price}} / {{$res->unit['name']}} </p>

                        </div>


                        @endforeach
                        {{-- input for  Quantity--}}
                        <div class="form-group row">
                            <label for="quantity1"
                                class="col-sm-4 col-form-label text-sm-right">{{ __('Quantity') }}</label>

                            <div class="col-sm-6">

                                <input id="quantity" type="number"
                                    class="form-control {{$errors->has('quantity1') ? ' is-invalid ' : ''}}"
                                    name="quantity1" value="{{ old('quantity1') }}" autocomplete="quantity1" min="1"
                                    max="9999">
                                    <span class="text-danger d-none" id="quantityError"></span>


                            </div>
                        </div>



                        {{-- input for  --}}
                        <div class="form-group row">
                            <label for="price_payed"
                                class="col-sm-4 col-form-label text-sm-right">{{ __('Total Price') }}</label>

                            <div class="col-sm-6">

                                <input id="price_payed" type="text"
                                    class="form-control {{$errors->has('price_payed') ? ' is-invalid ' : ''}}"
                                    name="price_payed" autocomplete="price_payed" disabled>

                            </div>
                        </div>



                        {{-- Add to cart button --}}
                        <div class="col-sm-4 ml-sm-auto mr-sm-auto">
                            <button id="addBasket" type="submit" class="btn btn-success">
                                {{ __('Add to Basket') }}
                            </button>

                        </div>


                    </form>


                </div> {{-- end of modal body class --}}

            </div>
        </div>
    </div>

<script>
function followButton(prodID){
    // alert(prodID);
    event.preventDefault();
    var action = $("#followStatus").html();
    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    $.ajax({
        type:'POST',
        url:'/followProduct',

        data:{action:action,prodID:prodID},
        success:function(data) {
             $("#followStatus").html(data);
            //  alert(JSON.stringify(data));
            // if(data.action == "Following"){
            //     $("#followStatus").html("Follow");
            // }else{
            //     $("#followStatus").html("Following");
            // }

        },
        error: function(data) {
            console.log(data);
        }
    });


}


        $(document).ready(function(){

  $("#quantity").change(function(){

    $quantity = $("#quantity").val();
    $price = {{$res->price}};
    $("#price_payed").val(Number($quantity*$price).toFixed(2));


  });



  $('#addBasket').click(function(e){


               e.preventDefault();
               var quantity = $("#quantity").val();
               var id = "{{$res->id}}";
               var names ="{{$res->product_name}}";
               var types ="{{$res->product_type}}";
               var prices = "{{$res->price}}";

               $.ajaxSetup({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

               });

               $.ajax({
               type:'POST',
               url:'/reserve',

               data:{id:id, quantity:quantity, price:prices},
               success:function(data) {
                
                if(data.stock_error){
                    $("#quantityError").removeClass("d-none");
                    $("#quantityError").text(data.stock_error);
                }else{
                    window.location.replace("/home");
                }

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
    });

});
    </script>


    @endsection
