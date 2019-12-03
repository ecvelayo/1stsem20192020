    @extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container">
    <div class="row">
        <div class="col-sm-12 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto" id="mar">
            <div class="card" id="ordercard">
                <div class="card-body" id="shoppingcard">
                    <div class="menu">
                        <br><h1>Shopping Basket</h1><br>
                    </div><br>



                    <table id='basketitem'>

                        @if(Session::has('cart'))



                        @foreach($products as $product)
                        <tr id="baskettr">
                            <td id="baskettd"><img src="{{$product['item']['photo']}}" class="img-fluid"
                                    id="basketimg"><br>
                            </td>

                            <td id="baskettd">
                                <p>Name: {{$product['item']['product_name']}} </p>

                                <p>  Price Per Unit: <span id="prodPrice">{{$product['item']['price']}}</span> / <span
                                    id="prodUnit">{{$product['item']->unit['name']}}</span><br></p>
                                {{-- Description: {{$product['item']['product_description']}}<br> --}}
                                {{-- Price: {{$product['item']['product_price']}} --}}

                            </td>

                            <td id="baskettd">
                                    {{-- <p>  Quantity: <input type="number" value="" name="quantity">{{$product['qty']}}</p>
                                    <p>   Total Price: ₱
                                    <span id ="totalPriceUpdate"></span>
                                    {{number_format($product['price'], 2, '.', ',')}}
                                    </p> --}}

                                    <div class="row" id="quantitybasket">
                                            <div class="col-12 ml-2 mr-auto">


                                                    <div class="row" id="quantityrow">
                                                            <label for="quantity"

                                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Quantity') }}</label>

                                                        <div class="col-sm-4 col-4 ml-auto mr-auto" id="quantityrow">

                                                            <input id="quantity" type="number" value="{{$product['qty']}}"
                                                                class="form-control {{$errors->has('quantity') ? ' is-invalid ' : ''}} updatePriceClass"
                                                                name="quantity" autocomplete="quantity">
                                                                <input class = "productid" value ="{{$product['item']['id']}}" hidden>
                                                                <span id="updateError" class="text-danger d-none updateerrors">asdasd</span>
                                                                <br>
                                                                <span id="cartError" class="text-danger d-none updateerrors">asasdasd</span>

                                                        </div>

                                                        </div>

                                                        <div class="row" id="quantityrow">



                                                                <label for="totals"
                                                                    class="col-sm-4 col-form-label text-sm-right">{{ __('Total Price') }}</label>


                                                                <div class="col-sm-4 col-4 ml-auto mr-auto" id="quantityrow">
                                                                    <input value="{{number_format($product['item']['price'] * $product['qty'], 2, '.', ',')}}" id="totals" type="text"

                                                                        class="form-control {{$errors->has('totals') ? ' is-invalid ' : ''}}"
                                                                        name="totals" autocomplete="totals" disabled>
                                                                </div>
                                                            </div>


                                            </div>
                                         </div>



                            </td>

                            <td>

                                    <span data-toggle="tooltip" data-placement="top" title="Delete Product">
                                <button id="btn1" onclick="sendData({{$product['item']['id']}})"
                                    class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </span>
                            </td>
                        </tr>

                        @endforeach


                    </table>
                    {{-- <div class="py-2 col-sm-3 offset-sm-10">
                        <button id="updateBasket" type="submit" class="btn btn-warning">
                            Update Basket
                        </button>

                    </div> --}}


                    <div class="row">

                        <div class="col-sm-12" id=>
                            <form enctype="multipart/form-data">
                                @csrf
                                <div class="delivery">
                                    {{-- Delivery Method:<br>
                                            Delivery Place:<br>
                                            Delivery Charge:<br> --}}
                                    <div class="py-3 form-group row">
                                        {{-- delivery method input --}}
                                        <label for="obtaining_method"
                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Delivery Method') }}</label>

                                        <div class="col-sm-5">
                                            <select onchange="deliveryMethodChange()" id="obtaining_method"
                                                class="form-control @error('obtaining_method') is-invalid @enderror"
                                                name="obtaining_method" value="{{ old('obtaining_method') }}" required
                                                autocomplete="obtaining_method" autofocus>

                                                <option value="delivery">Delivery</option>
                                                <option value="pick up">Pick-up</option>

                                            </select>


                                        </div>


                                        {{-- radio button input --}}
                                        <label for="date_stocked"
                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Use Primary Address') }}</label>

                                        <div class="col-sm-6">


                                            <!-- Group of default radios - option 1 YES-->
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input"   checked
                                                    id="defaultGroupExample1" name="groupOfDefaultRadios">
                                                <label class="custom-control-label" for="defaultGroupExample1"> Yes
                                                </label>
                                            </div>

                                            <!-- Group of default radios - option 2 NO-->
                                            <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                        id="defaultGroupExample2" name="groupOfDefaultRadios">
                                                    <label class="custom-control-label" for="defaultGroupExample2">No
                                                    </label>
                                                </div>

                                        </div>




                                        {{-- delivery place input --}}
                                        <label for="delivery_place"
                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Delivery Place') }}</label>

                                        <div class="col-sm-5">
                                            <input id="delivery_place" type="text"
                                                class="form-control {{$errors->has('delivery_place') ? ' is-invalid ' : ''}}"
                                                name="delivery_place" value="{{ old('delivery_place') }}"
                                                autocomplete="delivery_place" autofocus>
                                            <span id="delivery_placeError" class="text-danger d-none"></span>
                                        </div>



                                        {{-- Delivery charge --}}
                                        <label for="Delivery Charge"
                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Delivery Charge') }}</label>

                                        <div class="col-sm-6">
                                        <h3>₱<span id ="delivery_fee_price">
                                        @if( $totalPrice > 1000 )
                                        {{number_format(0, 2, '.', ',')}}
                                        @else
                                        {{number_format($delivery_fee['price'], 2, '.', ',')}}
                                        @endif
                                        </span>
                                        </h3>
                                            <!-- <h3>₱{{number_format(Session::get('deliveryFee'), 2, '.', ',')}} </h3> -->


                                        </div>



                                        {{-- Grand total --}}
                                        <label for="Delivery Charge"
                                            class="col-sm-4 col-form-label text-sm-right">{{ __('Grand Total Price') }}</label>

                                        <div class="col-sm-6">

                                            <h3> ₱ {{number_format($totalPrice, 2, '.', ',')}} </h3>
                                            <input id="grandTotal" type="text" value="{{$totalPrice}}"
                                                class="form-control {{$errors->has('grandTotal') ? ' is-invalid ' : ''}}"
                                                name="grandTotal" value="{{ old('grandTotal') }}"
                                                autocomplete="grandTotal" hidden autofocus>
                                            <span id = "grandTotalError" class="text-danger d-none"></span>
                                            <div class="container">
                                            <span id = "stockError" class="text-danger d-none"></span>
                                            </div>

                                        </div>


                                    </div>



                                </div>
                                <div class="card-footer" id="shoppingfooter">
                                    <div class="col-sm-5 ml-sm-auto mr-sm-auto">




                                        <button class="btn btn-warning" id="basketupdate" onclick="tryme()" disabled><span>Update </span></button>
                                        <button class="btn btn-success" id="checkout"><span>Checkout </span></button>


                                </div>
                            </form>
                        </div>



                    </div> {{-- end of row div --}}



                </div>

                {{-- <div class="modal-footer">
                        <div class="col-sm-4 ml-sm-auto mr-sm-auto">

                                <button class="btn btn-success" id="checkout"><span>Checkout </span></button>

                        </div>
                    </div>
                </form>
                     --}}

                @else
                <tr>
                    <h2 style="text-align: center;"> No Items in Basket! </h2>
                </tr>
                @endif
            </div>
        </div>
    </div>
</div>

<script>

    var id; // global variable
    var quantity;

function deliveryMethodChange()
{
    // example2 = no
    // var samp =  "{{Auth::user()->address}}";
    // var isChecked = $('#defaultGroupExample2:checked').val()?true:false;



    if($('#obtaining_method').val() == "pick up"){
         $("#delivery_place").val("{{config('pickup.pickup_place')}}");
         $('#delivery_place').attr('readonly', true);
         $('#delivery_place').addClass('text-muted');

         $('#defaultGroupExample2').attr('disabled', true);
         $('#defaultGroupExample1').attr('disabled', true);
    }else{
        $("#delivery_place").val("");
        $('#delivery_place').attr('readonly', false);
        $('#delivery_place').removeClass('text-muted');
        $('#defaultGroupExample2').attr('disabled', false);
         $('#defaultGroupExample1').attr('disabled', false);
    }


    // $("#delivery_place").val("{{config('pickup.pickup_place')}}");
}

// function sendData(valueId){
//      id = valueId;
//      event.preventDefault();
//      $.ajaxSetup({
//
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//
//     });
//
//     $.ajax({
//                type:'GET',
//                url:'/deleteFromCart',
//
//                data:{id:id},
//                success:function(data) {
//                 window.location.replace("/shoppingBasket");
//                }
//             });
//
// }


// function myFunction(valueQuantity) {
//     alert(valueQuantity);

// }
function updateThisProduct(valueID)
{
    alert(valueID);
    alert(quantity);
    // event.preventDefault();
    // var productID = valueID;
    // $.ajaxSetup({

    // headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // }

    // });

    // $.ajax({
    //                 type:'POST',
    //                 url:'/updateShoppingBasket',

    //                 data:{productID:productID},
    //                 success:function(data) {
    //                      alert(JSON.stringify(data));
    //                     //  window.location.replace("/home");
    //                 },
    //                 error: function(data) {

    //                     console.log(data);
    //                     var errors = data.responseJSON;
    //                     // console.log(errors.errors.delivery_charge);
    //                     if($.isEmptyObject(errors) == false){
    //                         $.each(errors.errors,function(key,value){
    //                             var errorID = '#' + key + 'Error';
    //                             $(errorID).removeClass("d-none");
    //                             $(errorID).text(value);
    //                         })
    //                     }
    //                 }

    //                 });



}
var retVal=0;
function tryme(){
    updatess();
    checkerrors();
}
function checkerrors()
{
    var errors = false;
    $( ".updateerrors" ).each(function() {
        if($(this).hasClass('d-none') == false){
            errors = true;

        }
    }
    );
    if(errors ==false){
        window.location.replace('/shoppingBasket');
    }
}

function updatess()
{

    event.preventDefault();

    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    $('.updatePriceClass').each(
    function(index, element) {

        var quantity = $(this).val();
        var productID = $(this).next().val();
        var errorID = $(this).next().next();
        var cartError = $(this).next().next().next().next();
        errorID.addClass("d-none");
        cartError.addClass("d-none");

        $.ajax({
            type:'POST',
            url:'/updateShoppingBasket',
            data:{quantity:quantity,productID:productID},
            async:false,
            success:function(data) {

                if(data.stock_error){
                    cartError.removeClass("d-none");
                    cartError.text(data.stock_error);
                }else{
                }

            },
            error: function(data) {

                errorID.attr("disabled", false);
                console.log(data);
                var errors = data.responseJSON;
                // console.log(errors.errors.delivery_charge);
                if($.isEmptyObject(errors) == false){
                    $.each(errors.errors,function(key,value){
                        errorID.removeClass("d-none");
                        errorID.text(value);
                    })
                }
            }

        });

    }
    );

}
function sendData(valueId){
     id = valueId;
     event.preventDefault();

    SwalDelete(id);

   }

   function SwalDelete(id){
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

   	swal({
       title: "Are you sure?",
       text: "Are you sure you want to remove this item from your basket?",
       icon: "warning",
       buttons: true,
       dangerMode: true
     }).then((willDelete) => {
       if (willDelete) {

         $.ajax({
                    type:'GET',
                    url:'/deleteFromCart',

                    data:{id:id},
                    success:function(data) {
                       window.location.replace("/shoppingBasket");
                   }
         });

       } else {
         swal("Product was not deleted.");
       }
     });
   }

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();



            $('#checkout').click(function(e){


                // $("#checkout").attr("disabled", true);
                $("#delivery_placeError").addClass("d-none");
                $("#grandTotalError").addClass("d-none");
                $("#stockError").addClass("d-none");

                   e.preventDefault();
                   var userid = {{Auth::id()}};
                   var obtainingMethod = $("#obtaining_method").val();
                   var delivery_place = $("#delivery_place").val();
                   var prodPrice = $("#prodPrice").html();
                   var deliveryFee = $("#delivery_fee_price").html();
                //    var deliveryFee = {{Session::get('deliveryFee')}};
                    var grandTotal = $("#grandTotal").val();
                   console.log(grandTotal);

                   $.ajaxSetup({

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                   });


                   swal({
                     title: "Are you sure?",
                     text: "Do you want to checkout items in your basket?",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true
                   }).then((willDelete) => {
                     if (willDelete) {

                       swal("Checking items out from basket. Please wait for a moment.");

                       $.ajax({
                        type:'POST',
                        url:'/checkout',

                        data:{userid:userid, obtainingMethod:obtainingMethod,delivery_place:delivery_place,grandTotal:grandTotal,prodPrice:prodPrice,deliveryFee:deliveryFee},
                        success:function(data) {
                            // alert('test');

                            $("#checkout").attr("disabled", false);


                            if(data.stock_error){
                                $("#stockError").removeClass("d-none");
                                $("#stockError").text(data.stock_error);
                            }else{
                                window.location.replace("/home");
                            }

                        },
                        error: function(data) {
                            $("#checkout").attr("disabled", false);
                            console.log(data);
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
                       swal("Items were not checked out.");
                     }
                   });





            });

            // $("#quantity").change(function(){
            //     quantity = $(this).val();
            //     alert(quantity);
            //     // $quantity = $("#quantity").val();

            //     // $( "li.third-item" ).next().css( "background-color", "red" );

            //     // $("#totals").val(Number($quantity*$price).toFixed(2));

            // });
            $(".updatePriceClass").change(function(){
                $("#basketupdate").attr('disabled',false);
                // alert($(this).val());
                quantity =$(this).val();
                // alert(quantity);
                // $(".PropStatus").closest('.rsaddress').nextAll(".rsimg").append(...
                // $(this).next(".experience").toggle();
                 $('.updatePriceClass').each(
                function(index, element) {

                    // $(this).css('background-color', $(this).data('bgcol')); // Get value of HTML attribute data-bgcol="" and set it as CSS color
                }
                );

                // $quantity = $("#quantity").val();

                // $( "li.third-item" ).next().css( "background-color", "red" );

                // $("#totals").val(Number($quantity*$price).toFixed(2));

            });
            $("#delivery_place").val("{{Auth::user()->address}}");
            $('#delivery_place').attr('readonly', true);
                $('#delivery_place').addClass('text-muted');

            $('#defaultGroupExample1').click(function(e){
                $("#delivery_place").val("{{Auth::user()->address}}");
                $('#delivery_place').attr('readonly', true);
                $('#delivery_place').addClass('text-muted');

                });

            $('#defaultGroupExample2').click(function(e){
                $("#delivery_place").val("");
                $('#delivery_place').attr('readonly', false);
                $('#delivery_place').removeClass('text-muted');
            });




    });
</script>
@endsection
