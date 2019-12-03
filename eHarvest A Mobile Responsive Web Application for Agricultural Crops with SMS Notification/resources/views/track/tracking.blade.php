    @extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="containter">
    <div class="row">
        <div class="col-sm-8 ml-sm-auto mr-sm-auto">
            <div class="card" id="ordercard">

                <div class="card-body" id="background">
                    <div class="menu">
                        <br><h1>List of Orders</h1><br>
                        <!-- @if(Auth::user()->type == 'Admin')
                        <button class="btn btn-link" id="menulink" onclick="thisType('')">All Orders</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('for approval')">For Approval</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('for delivery')">For Delivery</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('completed')">Completed</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('cancelled')">Cancelled</button>

                        @endif -->
                    </div><br>




                        <div class="row">
                                <div class="col-sm-4 ">

                                    <form method="GET" action="searchTrack" role="search">
                                            {{ csrf_field() }}
                                            <div class="input-group">

                                              <input type="text" class="form-control" name="searchOrders" id="searchOrders"  placeholder="Search Order Code">

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
                                    <form method="GET" action="filterTrack">
                                      @csrf
                                      <div class="input-group">
                                        <select id="selectType" name="selectType" class="form-control">
                                          <option value="" selected>All Orders</option>
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




                    @if(isset($data) || isset($userData))
                    <div class="table-responsive-sm">
                    <table class="table table-striped" id="managetd">
                        <thead>
                            <tr>
                                <th>Order Code </th>
                                <th>Delivery Method </th>
                                <th> Delivery Status </th>
                                <th>Grand Total </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(Auth::user()->type =='Admin')
                            @foreach ($data as $orders)
                                <tr>
                                    <td id="managetd">{{$orders->order_code}} </td>
                                    <td id="managetd">{{$orders->obtaining_method}} </td>
                                    <td id="managetd">{{$orders->status}} </td>
                                    <td id="managetd">₱{{number_format($orders->grand_total, 2, '.', ',')}} </td>
                                    <td id="managetd">  <span data-toggle="modal" data-target="#userModal">

                                         <a onclick="sendData({{$orders->id}})" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Order Details"><i class="fa fa-eye"></i></a>
                                         </span>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    {!! $data->render() !!}
                        @elseif(Auth::user()->type == 'Consumer')
                            @foreach ($userData as $userOrders)
                                <tr>
                                    <td>{{$userOrders->order_code}} </td>
                                    <td>{{$userOrders->obtaining_method}} </td>
                                    <td>{{$userOrders->status}} </td>
                                    <td>₱{{number_format($userOrders->grand_total, 2, '.', ',')}} </td>
                                    <td> <a onclick="sendData({{$userOrders->id}})" class="btn btn-primary" data-toggle="modal"
                                            data-target="#userModal"><i class="fa fa-eye"></i></a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    </div>
                    {!! $userData->render() !!}
                        @endif

                    @else
                    {{ $message }}
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
                    <h4 class="modal-title" id="userModalLabel">Order Information</h4>

                    <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table" id="managetd">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order No</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price per Unit</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Quantity</th>

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
                                        <p>Delivery Status: <strong> <span id="deliveryStatus"></span> </strong> </p>
                                        <p>Delivery Place: <strong> <span id="deliveryPlace"></span> </strong> </p>
                                        <p>Delivery Method: <strong> <span id="deliveryMethod"></span> </strong></p>

                                    </div>
                                </div>

                                <div class="col-sm-4 offset-sm-2">
                                    <div class="d-inline">
                                        <p>Grand Total: <strong> <span id="grandTotal"></span> </strong> </p>
                                        <p>Delivery Fee: <strong> <span id="deliveryFee"></span>  </strong></p>
                                        <p>Deliver By:<strong> <span id="driver"></span> </p>
                                    </div>
                                </div>



                            </div>

                    </div>

                </div>

                {{-- <div class="modal-footer">
                    <div class="col-sm-3 ml-sm-auto mr-sm-auto">
                        <button onclick="orderAction('accept')" type="submit" class="btn btn-success">
                            {{ __('Accept') }}
                        </button>

                        <button onclick="orderAction('decline')" type="submit" class="btn btn-danger">
                            {{ __('Decline') }}
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
<script>
    var id; // global variable
function sendData(valueId){
     id = valueId;
    //  alert(id);
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
                         $("#tableBody").append("<td>" + total.toFixed(2) + "</td>");

                         $("#tableBody").append("<td>"+JSON.stringify(data.orders[0].products[i]['pivot']['quantity'])+"</td>");
                         $("#tableBody").append("</tr>");
                     }
                     console.log(JSON.stringify(data.orders));
                     $('#deliveryStatus').html(data.orders[0]['status']);
                     $('#deliveryPlace').html(data.orders[0]['delivery_place']);
                     $('#deliveryFee').html(data.orders[0]['delivery_fee'].toFixed(2));
                     $('#grandTotal').html(data.orders[0]['grand_total'].toFixed(2));

                     $('#deliveryMethod').html(data.orders[0]['obtaining_method']);
                     if(data.orders[0].transactions == null){
                        $('#driver').html("To be Assigned");
                     }else{
                        $('#driver').html(data.orders[0].transactions.users['firstname'] + " " + data.orders[0].transactions.users['lastname']);
                     }


               }
            });
}

// //for searching orders
// $(document).ready(function(){
//   $("#searchOrders").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#ordersTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });
//
// //for filtering order types
// function thisType(productType){
//
//   $(document).ready(function(){
//       var value = productType;
//       console.log(value);
//       $("#ordersTable tr").filter(function() {
//         $(this).toggle($(this).text().indexOf(value) > -1)
//       });
//     });
// }

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
    </script>


@endsection
