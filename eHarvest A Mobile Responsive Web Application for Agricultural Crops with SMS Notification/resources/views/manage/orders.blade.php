@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="containter">
    <div class="row">
        <div class="col-sm-8 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto">
            <div class="card" id="ordercard">

                <div class="card-body" id="background">
                    <div class="menu">
                        <br>
                        <h1>List of Orders</h1><br>
                        <button class="btn btn-link" id="menulink" href="/product" data-toggle="modal" data-target="#deliverycharge">Delivery Charge</button>
                    </div><br>


                    <div class="row">
                        <div class="col-sm-4 ">

                            <form method="GET" action="/orderSearch" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">

                                    <input type="text" class="form-control" name="searchOrders" id="searchOrders"
                                        placeholder="Search Order Code">

                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4"></div>

                        <div class="col-sm-4">
                            <form method="GET" action="/orderFilter">
                                @csrf
                                <div class="input-group">
                                    <select id="selectType" name="selectType" class="form-control">
                                        <option value="" selected>All  Orders</option>
                                        <option value="for approval">For Approval</option>
                                        <option value="for delivery">For Delivery</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Select Type</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                    @if(isset($data))
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th id="managetd">Order Code </th>
                                    <th id="managetd"> Name </th>
                                    <th id="managetd"> Status </th>
                                    <th id="managetd"> Action </th>
                                </tr>
                            </thead>
                            <tbody id="ordersTable">
                                @foreach ($data as $order)


                                <tr>
                                    <td id="managetd">{{$order->order_code}} </td>
                                    <td id="managetd">{{$order->users['firstname']}} {{$order->users['lastname']}} </td>
                                    {{-- <td>{{$order->obtaining_method}}</td> --}}
                                    <td id="managetd">{{$order->status}} </td>
                                    <td id="managetd">
                                        <span data-toggle="modal" data-target="#userModal">
                                            <a onclick="sendData({{$order->id}})" class="btn btn-primary"
                                                data-toggle="tooltip" data-placement="top" title="View Product"> <i
                                                    class="fa fa-eye"></i> </a>
                                        </span>
                                        @if($order->transactions['status'] == "Completed" && $order->status == "for delivery")
                                        <a onclick="completeOrder({{$order->id}})" class="btn btn-success"
                                            data-toggle="tooltip" data-placement="top" title="Complete Order"> <i
                                                class="fa fa-check"></i> </a>
                                        @elseif($order->transactions['status'] == "Cancelled" && $order->status == "for delivery")
                                        <a onclick="cancelOrder({{$order->id}})" class="btn btn-danger"
                                            data-toggle="tooltip" data-placement="top" title="Cancel Order"> <i
                                                class="fa fa-times"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <div>
                        </table>
                        {!! $data->render() !!}
                        @else
                        {{-- {{ $message }} --}}
                        <tr>
                            <h2 style="text-align: center;"> No Orders </h2>
                        </tr>
                        @endif

                        @if($errors->any())
                            <h2 style="text-align: center;">{{$errors->first()}}</h2>
                        @endif







                    </div>
                </div>
            </div>


{{-- Modal for update delivery charge --}}
<div class="modal fade" id="deliverycharge" tabindex="-1" role="dialog" aria-labelledby="deliverycharge" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">Update Delivery Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                {{-- input for quantity --}}
                <div class="form-group row">
                  <label for="delivery_charge" class="col-sm-4 col-form-label text-sm-right">{{ __('Delivery Charge') }}</label>
                  <div class="col-sm-5">

                    <input id="delivery_charge_change" type="text" class="form-control {{$errors->has('delivery_charge') ? ' is-invalid ' : ''}}"
                      name="delivery_charge" value="{{ old('delivery_charge') }}" autocomplete="delivery_charge">
                      <span class="text-danger d-none" id="delivery_charge_changeError">asdsad</span>
                  </div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id = "delivery_charge_change_button"onclick ="updateDeliveryCharge()"type="submit" class="btn btn-primary">Save Changes</button>

              </div>
            </div>
          </div>
            </form>
          </div>
        </div>
      </div>


{{-- view order information --}}
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" id="userModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" id="mowdal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="userModalLabel">Order Information</h4>

                            <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order No</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Price per Unit</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">



                                            </tbody>
                                        </table>



                                    </div>





                        </div>
                        <div class="row">
                            <div class="col-sm-4 offset-sm-1">
                                <div class="d-inline">
                                    <p> Buyer: <strong> <span id="buyer"></span> </strong> </p>
                                    <p> Contact: <strong> <span id="contact"></span></strong> </p>
                                    <p> Status: <strong> <span id="status"></span></strong> </p>
                                    <p>Delivery Place: <strong> <span id="deliveryPlace"> </strong> </p>




                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-2">
                                <div class="d-inline">


                                    <p>Delivery Fee: <strong>
                                    <span id="deliveryFee"> </strong></p>
                                    <p>Delivery Method:<strong> <span id="deliveryMethod"></strong> </p>
                                    <p>Grand Total:<strong> <span id="grandTotal"></span> </strong> </p>
                                </div>
                            </div>



                        </div>


                        <div class="form-group row">
                            <label for="product_type"
                                class="col-sm-2 offset-sm-1 col-form-label text-sm-left">{{ __('Assign Driver:') }}</label>

                            <div class="col-sm-3">


                                <select id="driver"
                                    class="form-control @error('product_type') is-invalid @enderror" required
                                    name="product_type" value="{{ old('product_type') }}" required
                                    autocomplete="product_type" autofocus>
                                    <option selected disabled>Choose...</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->firstname}} {{$driver->lastname}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger d-none" id="driverError"></span>
                            </div>



                            <label for="deliveryDate"
                                class="col-sm-2  col-form-label text-sm-left">{{ __('Delivery Date:') }}</label>

                            <div class="col-sm-3">

                                <input id="deliveryDate" type="date" class="form-control @error('delivery_date') is-invalid @enderror"
                                    name="delivery_date" value="{{ old('delivery_date') }}" autocomplete="delivery_date" autofocus>
                                    <span class="text-danger d-none" id="validError"></span>
                                    <span class="text-danger d-none" id="deliveryDateError"></span>
{{--
                                    <span class="text-danger d-none" id="deliveryDateError"></span>
                                    <input id="day" hidden type="text" class="form-control @error('day') is-invalid @enderror"
                                    name="day" value="{{ old('day') }}" autocomplete="day" autofocus> --}}


                            </div>


                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-sm-3 ml-sm-auto mr-sm-auto">
                        <button id="acceptButton" onclick="orderAction('accept')" type="submit"
                            class="btn btn-success ">
                            {{ __('Accept') }}
                        </button>

                        {{-- <button id="declineButton" onclick="orderAction('decline')" type="submit"
                            class="btn btn-danger">
                            {{ __('Decline') }}
                        </button> --}}

                        <button id="declineButton"  type="submit"
                            class="btn btn-danger" data-toggle="modal" data-target="#declineModal">
                            {{ __('Decline') }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>






    
{{--Decline order modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" id="declineModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="mowdal">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalLabel">Reason for Decline Order</h4>

                <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">


                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label id ="reason1"class="custom-control-label" for="customRadio1">Insufficient stocks</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label id = "reason2"class="custom-control-label" for="customRadio2">To ensure the qualities given to consumers</label>
                              </div>

                              <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Others:</label>
                              </div>

                           <div id="pricePaidDiv" class="form-group row">
                                       

                      <div class="col-sm-6">
                            <textarea onchange="otherReasons()"id="others" rows="2"
                            class="form-control {{$errors->has('other') ? ' is-invalid ' : ''}}"
                            name="other" value="{{ old('other') }}" autocomplete="other"
                            autofocus disabled> </textarea>
                            <span class="text-danger d-none" id = "otherError"></span>
   
                     </div>

                            </div>

                            </div>                                
                    
                        </div>

                    </div>

                        <div class="modal-footer">
                               
                            <div class="col-sm-6 ml-sm-auto mr-sm-auto">
                                    
                                <button disabled id="completedButton" onclick = "declineOrder()" type="submit" class="btn btn-success ">
                                    {{ __('Submit') }}
                                </button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                
                            </div>
                        </div>
                      
                </div>

            </div>

        </div>
    </div>
</div>

    <script>
        var msg;
        var id; // global variable
        // alert($("#reason1").html());
        $(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();

$("#customRadio1").change(function(){
            $("#completedButton").attr('disabled', false);
            $("#others").val("");
            msg = $("#reason1").html();
            $("#others").attr('disabled', true);
            

            
            });
            $("#customRadio2").change(function(){
            $("#completedButton").attr('disabled', false);
            $("#others").val("");
            msg = $("#reason2").html();

            $("#others").attr('disabled', true);
            $("#others").reset();

            
            });
                $("#customRadio3").change(function(){
                $("#completedButton").attr('disabled', true);
                $("#others").attr('disabled', false);

                
            });

});

function declineOrder()
{
    
    // var isChecked = $('#customRadio3').prop('checked');
    // if(isChecked == true){
    //     alert('naa');
    // }else{
    //     alert('wala');
    // }

    // if ($.trim($("#others").val()))
    // {
    //     alert("naai sud ang textbox");
    // }else{
    //     alert("walai sud");
    // }

    
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $.ajax({
               type:'POST',
               url:'/declineAnOrder',

               data:{id:id,msg:msg},
               success:function(data) {
                
                location.reload();
               },
               error:function(data){
                 console.log(data);
                var errors = data.responseJSON;
                   if($.isEmptyObject(errors) == false){
                       $.each(errors.errors,function(key,value){
                           var errorID = '#' + key + 'Error';
                           $(errorID).removeClass("d-none");
                           $(errorID).text(value);
                       })
                   }
               }
    });
}
function updateDeliveryCharge(){

    $('#delivery_charge_change_button').attr('disabled', true);
    var delivery_charge_change = $("#delivery_charge_change").val();

    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    swal({
    title: "Are you sure?",
    text: "Do you want to change delivery charge?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
          type:'POST',
          url:'/updateDeliveryCharge',

          data:{delivery_charge_change:delivery_charge_change},
          success:function(data) {

            // alert({{config('pickup.delivery_fee')}})
            window.location.replace("/orders");

          },
          error: function(data) {


              var errors = data.responseJSON;
              console.log(errors.errors.delivery_charge);
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
      swal("Delivery Charge was not updated.");
    }
  });




}
function otherReasons()
{
    msg = $("#others").val();
    
    if ($.trim($("#others").val()))
    {
        $("#completedButton").attr('disabled', false);
    }else{
        $("#completedButton").attr('disabled', true);
    }
}
function sendData(valueId){


     id = valueId;
    //   alert(id);
     event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/getBasketOrders',
               data:{id:id},
               success:function(data) {
                    $("#tableBody").empty();
                    for(var i = 0;i<data.orders[0].products.length;i++){
                        var total = JSON.stringify(data.orders[0].products[i]['pivot']['quantity']) * JSON.stringify(data.orders[0].products[i]['pivot']['price_at_current_order']);
                        $("#tableBody").append("<tr>");
                        $("#tableBody").append("<td>" + (i+1) +"</td>");
                        $("#tableBody").append("<td>"+data.orders[0].products[i]['product_name']+"</td>");
                        $("#tableBody").append("<td>"+data.orders[0].products[i]['pivot']['price_at_current_order'].toFixed(2)+" / " + data.orders[0].products[i]['unit']['name'] +"</td>");
                        $("#tableBody").append("<td>"+JSON.stringify(data.orders[0].products[i]['pivot']['quantity'])+"</td>");
                        $("#tableBody").append("<td>" + total.toFixed(2) + "</td>");
                        $("#tableBody").append("</tr>");
                    }
                    $('#buyer').html(data.orders[0].users['lastname'] + ", " + data.orders[0].users['firstname']);
                    $('#contact').html('0' + data.orders[0].users['contact'].substring(2));
                    $('#status').html(data.orders[0]['status']);
                    $('#deliveryMethod').html(data.orders[0]['obtaining_method']);
                    $('#deliveryPlace').html(data.orders[0]['delivery_place']);
                    $('#deliveryFee').html(data.orders[0]['delivery_fee'].toFixed(2));

                    $('#grandTotal').html(data.orders[0]['grand_total'].toFixed(2));

                    if(data.orders[0]['status'] != 'for approval'){
                        $("#acceptButton").hide();
                        $("#declineButton").hide();
                    }else{
                        $("#acceptButton").show();
                        $("#declineButton").show();
                    }

               }
            });

}

function orderAction(decision)
{
    // $("#acceptButton").attr("disabled",true);
    // $("#declineButton").attr("disabled",true);
    $("#deliveryDateError").addClass('d-none');
    $("#driverError").addClass('d-none');
    $("#dayError").addClass('d-none');
    console.log(decision);
    event.preventDefault();

    var decisions = decision;
    var driver = $("#driver").val();
    var deliveryDate = $("#deliveryDate").val();
    var d = new Date(deliveryDate);
    var day = d.getDay();

    var choice;
    var choice2;
    if(decisions == 'decline'){
      choice = 'declined';
      choice2 = 'Declining';
    }else{
      choice = 'accepted';
      choice2 = 'Accepting';
    }




    if(day == 0 || day == 3){

       var valid = 1;

    }else{
        var valid = 0;
    }
    // alert(valid);
    // alert(valid);


     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    swal({
      title: "Are you sure?",
      text: "Do you want to "+decisions+" this order?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then((willDelete) => {
      if (willDelete) {

        swal(choice2+" order. Please wait.");

        $.ajax({
                   type:'POST',
                   url:'/confirmOrder',

                   data:{decisions:decisions,id:id,driver:driver,deliveryDate:deliveryDate,valid:valid},
                   success:function(data) {

                    //  alert(JSON.stringify(data));
                    location.reload();
                    //  window.location.replace("/orders");

                   },
                   error: function(data) {

                       var errors = data.responseJSON;
                        console.log(errors);
                       if($.isEmptyObject(errors) == false){
                        $("#acceptButton").attr("disabled",false);
                        $("#declineButton").attr("disabled",false);
                           $.each(errors.errors,function(key,value){

                               var errorID = '#' + key + 'Error';
                               $(errorID).removeClass("d-none");
                               $(errorID).text(value);
                           })
                       }
                   }
                });


      } else {

        swal("Order was not "+choice+".");
      }
    });


}

function cancelOrder(valueID)
{

    event.preventDefault();
    var orderID = valueID;
    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    swal({
    title: "Are you sure?",
    text: "Are you sure you want to cancel this order?",
    icon: "warning",
    buttons: true,
    dangerMode: true
    }).then((willComplete) => {

        if(willComplete){
            $.ajax({
            type:'POST',
            url:'/cancelOrder',

            data:{orderID:orderID},
            success:function(data) {

                location.reload();

            }
    });

        }

    });


}
function completeOrder(valueID)
{

    event.preventDefault();
    var orderID = valueID;
    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    swal({
       title: "Are you sure?",
       text: "Are you sure you want to complete this order?",
       icon: "warning",
       buttons: true,
       dangerMode: true
     }).then((willComplete) => {

         if(willComplete){
            $.ajax({
               type:'POST',
               url:'/completeOrder',

               data:{orderID:orderID},
               success:function(data) {

                location.reload();

               }
    });

         }

     });


}

$("#delivery_charge").val("{{config('delivery_fee')}}");


 
    </script>
    @endsection
