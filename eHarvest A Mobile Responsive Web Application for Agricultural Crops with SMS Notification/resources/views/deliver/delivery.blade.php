@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="containter">
    <div class="row">
        <div class="col-sm-10 ml-sm-auto mr-sm-auto">
            <div class="card" id="ordercard">

                <div class="card-body" id="background">
                    <div class="menu">
                        <br><h1>My Delivery</h1><br>
<!--
                            <button class="btn btn-link" id="menulink" onclick="thisType('')">All Orders</button>&nbsp;/&nbsp;
                            <button class="btn btn-link" id="menulink" onclick="thisType('for delivery')">For Delivery</button>&nbsp;/&nbsp;
                            <button class="btn btn-link" id="menulink" onclick="thisType('completed')">Completed</button>&nbsp;
 -->

                    </div><br>



                    <div class="row">
                            <div class="col-sm-4 ">

                                    <form method="GET" action="searchDelivery" role="search">
                                        {{ csrf_field() }}
                                        <div class="input-group">

                                          <input type="text" class="form-control" name="searchDelivery" id="searchDelivery"  placeholder="Search Deliveries">

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
                                <form method="GET" action="/filterDelivery">
                                    @csrf
                                    <div class="input-group">
                                        <select id="selectType" name="selectType" class="form-control">
                                            <option value="" selected>All Deliveries</option>
                                            <option value="Pending" >Pending</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary">Select Type</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>


                     @if(isset($userDelivery)||isset($adminData))
                    <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th id="managetd">Order Code </th>
                                <th id="managetd">Delivery Date </th>
                                <th id="managetd"> Delivery Status </th>
                                <th id="managetd">Grand Total </th>
                                <th id="managetd"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(Auth::user()->type =='Driver')
                        @foreach($userDelivery as $deliveries)
                                <tr>

                                    <td id="managetd"> {{$deliveries->orders['order_code']}} </td>
                                    <td id="managetd"> {{$deliveries->orders['order_datetime']}} </td>
                                    <td id="managetd"> {{$deliveries->status}} </td>
                                    {{-- <td> {{$deliveries->orders['grand_total']}} </td> --}}

                                    <td id="managetd">  ₱{{number_format($deliveries->orders['grand_total'], 2, '.', ',')}} </td>
                                    <td id="managetd"><span data-toggle="modal" data-target="#userModal">
                                        <a  onclick = "sendData({{$deliveries->id}})" class="btn btn-primary" data-toggle="tooltip"
                                        data-toggle="tooltip" data-placement="top" title="View Delivery"><i class="fa fa-eye"></i></a> </span></td>


                                </tr>
                                @endforeach


                            </tbody>
                    </table>

                    </div>
                    {!! $userDelivery->render() !!}
                    @elseif(Auth::user()->type =='Admin')
                    @foreach($adminData as $adminView)
                                <tr>

                                    <td id="managetd"> {{$adminView->orders['order_code']}} </td>
                                    <td id="managetd"> {{$adminView->orders['order_datetime']}} </td>
                                    <td id="managetd"> {{$adminView['status']}} </td>
                                    {{-- <td> {{$adminView->orders['grand_total']}} </td> --}}

                                    <td id="managetd">  ₱{{number_format($adminView->orders['grand_total'], 2, '.', ',')}} </td>
                                    <td id="managetd"><span data-toggle="modal" data-target="#userModal">
                                        <a  onclick = "sendData({{$adminView->id}})" class="btn btn-primary" data-toggle="tooltip"
                                        data-toggle="tooltip" data-placement="top" title="View Delivery"><i class="fa fa-eye"></i></a> </span></td>


                                </tr>
                                @endforeach


                            </tbody>
                    </table>

                    </div>
                    {!! $adminData->render() !!}
                    @endif

                      @else
                      asd
                      @endif

                      @if($errors->any())
                          <h2 style="text-align: center;">{{$errors->first()}}</h2>
                      @endif


                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" id="userModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="mowdal">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModalLabel">Delivery Information</h4>

                    <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead id="tablebody">
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
                                        <p>Delivery Status: <strong> <span id="deliveryStatus"></span></strong> </p>
                                        <p>Delivery Place: <strong> <span id="deliveryPlace"></span>  </strong> </p>
                                        <p>Delivery Method: <strong> <span id="deliveryMethod"></span>  </strong></p>
                                        <p>Delivery Date: <strong> <span id="deliveryDate"></span>  </strong></p>


                                    </div>
                                </div>

                                <div class="col-sm-4 offset-sm-2">
                                    <div class="d-inline">
                                        <p>Grand Total: <strong> <span id="grandTotal"></span>  </strong> </p>
                                        <p>Delivery Fee: <strong> <span id="deliveryFee"></span> </strong></p>
                                        <p>Delivery By: <strong> <span id="deliveryBy"></span> </strong> </p>
                                        <p>Delivery To: <strong> <span id="deliveryTo"></span> </strong> </p>
                                        <p>Contact Number: <strong> <span id="contactbuyer"></span> </strong> </p>
                                    </div>
                                </div>



                            </div>
                        @if(Auth::user()->type =='Driver')
                            {{-- input for  Price Paid--}}
                        <div id="pricePaidDiv" class="form-group row">
                            <label for="price_paid"
                                class="col-sm-2 offset-sm-0 col-form-label text-sm-right">{{ __('Price Paid') }}</label>

                            <div class="col-sm-3">

                                <input id="price_paid" type="text"
                                    class="form-control {{$errors->has('quantity1') ? ' is-invalid ' : ''}}"
                                    name="price_paid" value="{{ old('price_paid') }}" autocomplete="price_paid">   <p id="demo"></p>
                                    <span class="text-danger d-none" id = "price_paidError"></span>


                            </div>

                            <label for="change"
                            class="col-sm-2 col-form-label text-sm-right">{{ __('Change') }}</label>

                        <div class="col-sm-3">

                            <input id="change" type="text"
                                class="form-control {{$errors->has('change') ? ' is-invalid ' : ''}}"
                                name="change" value="{{ old('change') }}" autocomplete="change" disabled>


                        </div>


                        </div>

                        {{-- input for  Change--}}
                        {{-- <div id ="changeDiv" class="form-group row">
                            <label for="change"
                                class="col-sm-4 col-form-label text-sm-right">{{ __('Change') }}</label>

                            <div class="col-sm-5">

                                <input id="change" type="text"
                                    class="form-control {{$errors->has('change') ? ' is-invalid ' : ''}}"
                                    name="change" value="{{ old('change') }}" autocomplete="change" disabled>

                            </div>
                        </div> --}}

                            <div class="modal-footer">
                                <div class="col-sm-4 ml-sm-auto mr-sm-auto">
                                    <button id="completedButton" onclick = "deliveryAction('Completed')" type="submit" class="btn btn-success ">
                                        {{ __('Complete') }}
                                    </button>

                                    {{-- <button id="cancelledButton" onclick = "deliveryAction('Cancelled')" type="submit" class="btn btn-danger">
                                        {{ __('Cancel') }}
                                    </button> --}}

                                    <button id="cancelledButton"   type="submit" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                            @endif
                    </div>

                </div>

            </div>
        </div>
    </div>




    
{{-- cancel modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" id="cancelModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="mowdal">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalLabel">Reason for Cancelled Delivery</h4>

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
                                        <label id="reason1" class="custom-control-label" for="customRadio1">Consumer did not show up</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label id ="reason2" class="custom-control-label" for="customRadio2">There was a problem with the products</label>
                                      </div>

                                      <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Others:</label>
                                          </div>
    

                                    

                           <div  class="form-group row">
                                 
                                        
                      <div class="col-sm-6">
                            <textarea onchange="otherReasons()" id="others" rows="2"   
                            class="form-control {{$errors->has('other') ? ' is-invalid ' : ''}}"
                            name="other" value="{{ old('other') }}" autocomplete="other"
                            autofocus  disabled> </textarea>
                            <span class="text-danger d-none" id = "otherError"></span>
   
                     </div>

                            </div>

                            </div>                                
                    
                        </div>

                    </div>

                        <div class="modal-footer">
                            <div class="col-sm-6 ml-sm-auto mr-sm-auto">
                                <button onclick ="declineThisDelivery()"disabled id="declineDelivery"  type="submit" class="btn btn-success ">
                                    {{ __('Submit') }}
                                </button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                
                            </div>
                        </div>
                      
                </div>

            </div>

        </div>
    </div>
 

<script>


$(document).ready(function(){

    $("#price_paid").change(function(){
        $paid = $("#price_paid").val();
        $total = $("#grandTotal").html();
        // $("#change").val($paid-$total);
        // Number($paid-$total).toFixed(2);


        $("#change").val( Number($paid-$total).toFixed(2));
        // if( $("#change").val()  < 0 ){
        //     document.getElementById("demo").innerHTML = "invalid input";
        //     document.getElementById("price_paid").style.border= "2px solid red";
        // }else{
        //     document.getElementById("demo").innerHTML = "";
        //     document.getElementById("price_paid").style.border= "none";
        // }
    });

                $("#customRadio1").change(function(){
            $("#declineDelivery").attr('disabled', false);
            $("#others").attr('disabled', true);
            $("#others").val("");
            msg = $("#reason1").html();
           
            });
            $("#customRadio2").change(function(){
            $("#declineDelivery").attr('disabled', false);
            $("#others").val("");
            $("#others").attr('disabled', true);
            msg = $("#reason2").html();
            

            
            });
                $("#customRadio3").change(function(){
                $("#declineDelivery").attr('disabled', true);
                
                $("#others").attr('disabled', false);

                
            });


});


var id;
var msg;
function otherReasons()
{
    msg = $("#others").val();
    if ($.trim($("#others").val()))
    {
        $("#declineDelivery").attr('disabled', false);
    }else{
        $("#declineDelivery").attr('disabled', true);
    }
}
function declineThisDelivery()
{
    event.preventDefault();

     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'POST',
               url:'/declineADelivery',

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
function sendData(valueID){

    id = valueID;
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/getDeliveryDetails',

               data:{id:id},
               success:function(data) {
                   if(data.transactions[0]['status'] == "Completed" || data.transactions[0]['status'] == "Cancelled"){
                    $("#pricePaidDiv").hide();
                    $("#cancelledButton").hide();
                    $("#completedButton").hide();
                    $("#changeDiv").hide();

                   }else{
                    $("#pricePaidDiv").show();
                    $("#cancelledButton").show();
                    $("#completedButton").show();
                    $("#changeDiv").show();
                   }
                   $("#tableBody").empty();
                      for(var i = 0;i<data.transactions[0].orders.products.length;i++){
                             var total = JSON.stringify(data.transactions[0].orders.products[i]['pivot']['price_at_current_order']) * JSON.stringify(data.transactions[0].orders.products[i]['pivot']['quantity']);
                          $("#tableBody").append("<tr>");
                          $("#tableBody").append("<td>" + (i+1) +"</td>");
                          $("#tableBody").append("<td>"+data.transactions[0].orders.products[i]['product_name']+"</td>");
                          $("#tableBody").append("<td>"+data.transactions[0].orders.products[i]['pivot']['price_at_current_order'].toFixed(2)+" / " +data.transactions[0].orders.products[i].unit['name'] +"</td>");
                          $("#tableBody").append("<td>"+JSON.stringify(data.transactions[0].orders.products[i]['pivot']['quantity'])+"</td>");
                          $("#tableBody").append("<td>" + total.toFixed(2) + "</td>");
                          $("#tableBody").append("</tr>");
                      }

                      $('#deliveryStatus').html(data.transactions[0]['status']);
                      $('#deliveryPlace').html(data.transactions[0].orders['delivery_place']);
                      $('#deliveryFee').html(data.transactions[0].orders['delivery_fee'].toFixed(2));
                      $('#grandTotal').html(data.transactions[0].orders['grand_total'].toFixed(2));
                      $('#deliveryMethod').html(data.transactions[0].orders['obtaining_method']);
                      $('#deliveryDate').html(data.transactions[0].orders['delivery_date']);

                      $("#deliveryBy").html(data.transactions[0].users['firstname'] + " " + data.transactions[0].users['lastname']);
                      $("#deliveryTo").html(data.transactions[0].orders.users['firstname'] + " " + data.transactions[0].orders.users['lastname']);
                      $("#contactbuyer").html(data.transactions[0].orders.users['contact']);

               },error:function(data){
                   console.log(data);
               }
    });

}

function deliveryAction(Action)
{
    // alert(Action);
    event.preventDefault();
    var action = Action;
    var price_paid = $("#price_paid").val();
    var change = $("#change").val();
    var total = $("#grandTotal").html();

    var choice;
    var choice2;

    if(action == "Completed"){
      choice = 'complete';
      choice2 = 'Completing';
    }else{
      choice = 'cancel';
      choice2 = 'Cancelling';
    }

    console.log(action);
    // alert(total);
    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });


    swal({
      title: "Are you sure?",
      text: "Do you want to "+choice+" this order?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then((willDelete) => {
      if (willDelete) {

        swal(choice2+" order. Please wait.");

        $.ajax({
                   type:'POST',
                   url:'/completeDelivery',

                   data:{id:id, action:action,price_paid:price_paid,change:change,total:total},
                   success:function(data) {
                    //   alert(JSON.stringify(data));
                    window.location.replace('/delivery');
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
        swal("Order was not "+action+".");
      }
    });




}

$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
