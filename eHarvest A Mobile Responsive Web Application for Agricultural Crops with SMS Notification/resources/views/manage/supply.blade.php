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
                        <h1>List of Supply</h1><br>

                    </div><br>


                    <div class="row">
                        <div class="col-sm-4 ">

                            <form method="GET" action="searchSupply" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">

                                    <input type="text" class="form-control" name="searchSupply" id="searchSupply"
                                        placeholder="Search product or farmer">

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
                            <form method="GET" action="filterSupply">
                                @csrf
                                <div class="input-group">
                                    <select id="selectType" name="selectType" class="form-control">
                                        <option value="" selected>All Supply</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Acknowledged">Acknowledged</option>
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



                    @if(isset($data))
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <!-- <th id="managetd" style="width:5%"> Farmer ID</th> -->
                                    <th id="managetd" style="width:15%"> First Name</th>
                                    <th id="managetd" style="width:15%"> Last Name</th>
                                    <th id="managetd" style="width:15%"> Product </th>
                                    <th id="managetd" style="width:15%"> Quantity </th>
                                    <th id="managetd" style="width:15%"> Price / Unit </th>
                                    <th id="managetd" style="width:15%">Status </th>
                                    <th id="managetd" style="width:10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody id="ordersTable">
                                @foreach($data as $supplyData)
                                <!-- <td id="managetd">{{$supplyData->users['id']}}</td> -->
                                <td id="managetd">{{$supplyData->users['firstname']}}</td>
                                <td id="managetd">{{$supplyData->users['lastname']}}</td>
                                <td id="managetd">{{$supplyData->products['product_name']}} </td>
                                <td id="managetd">{{$supplyData->expected_quantity}}
                                    {{$supplyData->products->unit['name']}}s</td>
                                <td id="managetd">₱{{$supplyData->expected_price}} /
                                    {{$supplyData->products->unit['name']}} </td>
                                <td id="managetd">{{$supplyData->status}} </td>
                                {{-- action button --}}
                                <td id="managetd">
                                    <span data-toggle="modal" data-target="#userModal">
                                        <a onclick="sendData({{$supplyData->id}}, 'ack')" class="btn btn-primary"
                                            data-toggle="tooltip" data-placement="top" title="View Supply"> <i class="fa fa-eye"></i> </a>
                                        </span>
                                            @if($supplyData->status == "Acknowledged" )
                                            <span data-toggle="modal" data-target="#userModal">
                                        <a onclick="sendData({{$supplyData->id}}, 'acc')" class="btn btn-warning"
                                                data-toggle="tooltip" data-placement="top" title="Confirm Supply"> <i class="fa fa-check"></i>
                                        </a>
                                    </span>
                                </td>
                                @endif


                            </tbody>
                            <div>
                                @endforeach
                        </table>








                    </div>
                    {!! $data->render() !!}


                    @else
                    @endif

                    @if($errors->any())
                    <h2 style="text-align: center;">{{$errors->first()}}</h2>
                    @endif
                </div>
            </div>

            {{-- modal for view supply --}}
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" id="userModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" id="mowdal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="userModalLabel">Supply Information</h4>

                            <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table" id="tablesupply">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col"> Price per Unit</th>
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
                                            <p> Farmer: <strong> <span id="farmer"></span> </strong> </p>
                                            <p> Contact: <strong> <span id="contact"></span> </strong> </p>
                                            <p> Supply Status: <strong> <span id="supply_status"></span> </strong> </p>




                                        </div>
                                    </div>

                                    <div class="col-sm-4 offset-sm-2">
                                        <div class="d-inline">


                                            <p>Expected Harvest: <strong> <span id="expected_harvest"></span> </strong>
                                            </p>
                                            <p>Expected Delivery: <strong> <span id="expected_delivery"></span>
                                                </strong> </p>

                                        </div>
                                    </div>



                                </div>




                            </div>

                        </div>


                        <div  id ="divActualQty"class="form-group row">
                                    <label for="exptected_quantity"
                                    class="col-sm-3 offset-sm-1 col-form-label text-sm-left">{{ __('Actual Quantity') }}</label>

                                    <div class="col-sm-3">

                                        <input id="actualQuantity" type="number"
                                            class="form-control {{$errors->has('exptected_quantity') ? ' is-invalid ' : ''}}"
                                            name="exptected_quantity" value="{{ old('exptected_quantity') }}"
                                            autocomplete="exptected_quantity" min="1" max="9999">
                                            <span class="text-danger d-none" id="actualQuantityError"></span>

                                    </div>
                                </div>


                        <div class="modal-footer">
                            @if(isset($supplyData))
                            <div class="col-sm-4 ml-sm-auto mr-sm-auto" id="acknowledgeBtn">


                                <button onclick="acknowledgeSupply()" id="acknowledgeButton" type="submit"
                                    class="btn btn-success">  <i class="fa fa-check"></i>
                                    {{ __('Acknowledge') }}
                                </button>

                                {{-- <button onclick="declineSupplyQuery()" id="declineButton111" type="submit"
                                    class="btn btn-danger">  <i class="fa fa-trash"></i>
                                    {{ __('Decline') }}
                                </button> --}}

                                <button   id="declineButton111" type="submit"
                                    class="btn btn-danger" data-toggle="modal" data-target="#declineModal">  <i class="fa fa-trash"></i>
                                    {{ __('Decline') }}
                                </button>
                                



                                <button onclick="supplyAction('accept')" id="acceptButton" type="submit"
                                    class="btn btn-success">  <i class="fa fa-check"></i>
                                    {{ __('Accept') }}
                                </button>

                                <button onclick="supplyAction('decline')" id="declineButton" type="submit"
                                    class="btn btn-danger">  <i class="fa fa-remove"></i>
                                    {{ __('Cancelled') }}
                                </button>

                                
                            </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>




            {{-- decline supply modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" id="declineModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="mowdal">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModalLabel">Reason for decline supply</h4>
    
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
                                            <label id="reason1" class="custom-control-label" for="customRadio1">Too many stocks.</label>
                                          </div>
                                          <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label id="reason2" class="custom-control-label" for="customRadio2">The price is too high.</label>
                                          </div>

                                          <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Others:</label>
                                          </div>
    
    
                               <div   class="form-group row">
                                            
    
                          <div class="col-sm-6">
                                <textarea onchange="otherReasons()" id="others" rows="2"
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
                                    <button onclick="declineASupply()"disabled id="completedButton"  type="submit" class="btn btn-success ">
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
                var id;
                var msg;
function declineASupply()
{
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $.ajax({
               type:'POST',
               url:'/declineASupply',

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
// function acceptSupply(valueID){
//     id = valueID;
//     $("#acknowledgeButton").hide();
//     $("#acceptButton").show();
//     $("#declineButton").show();
//     event.preventDefault();
//     $.ajaxSetup({

//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }

//     });
// }
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();




$("#customRadio1").change(function(){
            
            $("#others").attr('disabled', true);
            $("#completedButton").attr('disabled', false);
            $("#others").val("");
            msg = $("#reason1").html();
            
            });
            $("#customRadio2").change(function(){
            msg = $("#reason2").html();
            
            $("#others").attr('disabled', true);
            $("#completedButton").attr('disabled', false);
            $("#others").val("");
            
            });
                $("#customRadio3").change(function(){
                $("#completedButton").attr('disabled', true);
            
                $("#others").attr('disabled', false);

                
            });
});


function supplyAction(action){
    var actualQuantity = $("#actualQuantity").val();
    // alert(action);
    var choice;
    var choice2;
    var choice3;

    if(action == 'accept'){
      choice = 'accepted';
      choice2 = 'accept';
      choice3 = "Accepting";
    }else{
      choice = 'cancelled';
      choice2 = 'cancel';
      choice3 = 'Cancelling';
    }

    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });


    swal({
    title: "Are you sure?",
    text: "Do you want to "+choice2+" this supply request?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      swal(choice3+" supply. Please wait.");

      $.ajax({
                 type:'POST',
                 url:'/supplyAction',

                 data:{prodID:id,action:action,actualQuantity:actualQuantity},
                 success:function(data) {
                    // alert(JSON.stringify(data));
                    window.location.replace('/supply');


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
      swal("Supply request was not "+choice+".");
    }
  });

}
function acknowledgeSupply(){
    // alert(id);
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    swal({
    title: "Are you sure?",
    text: "Do you want to acknowledge this supply query?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      swal("Acknowledging supply. Please wait.");


      $.ajax({
                 type:'POST',
                 url:'/acknowledgeSupply',

                 data:{id:id},
                 success:function(data) {
                    // alert(JSON.stringify("Successfully acknowledged!"));
                    location.reload();

                 },
                  error: function(data) {
                      console.log(data);
                  }
      });


    } else {
      swal("Supply query was not acknowledged.");
    }
  });



}
function declineSupplyQuery(){
    //  alert(id);
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    swal({
    title: "Are you sure?",
    text: "Do you want to decline this supply query?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      swal("Declining supply. Please wait.");


      $.ajax({
                 type:'POST',
                 url:'/declineSupplyQuery',

                 data:{id:id},
                 success:function(data) {
                    // alert(JSON.stringify("Successfully acknowledged!"));
                    location.reload();

                 },
                  error: function(data) {
                      console.log(data);
                  }
      });

    } else {
      swal("Supply query was not declined.");
    }
  });



}
function sendData(valueID,action){
    id = valueID;
    if(action =='ack'){
        $("#acknowledgeButton").show();
        $("#declineButton111").show();
        $("#acceptButton").hide();
        $("#declineButton").hide();
        $("#divActualQty").hide();


    }else{
        $("#acknowledgeButton").hide();
        $("#declineButton111").hide();
        $("#acceptButton").show();
        $("#declineButton").show();
        $("#divActualQty").show();
    }

    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/getSupplyDetails',

               data:{id:id},
               success:function(data) {
                  // alert(JSON.stringify(data));
                  if(data.supplyDetails['status'] != "Pending"){
                    $("#acknowledgeButton").hide();
                    $("#declineButton111").hide();
                  }
                  $("#tableBody").empty();
                  $("#tableBody").append("<tr>");
                  $("#tableBody").append("<td>"+data.productDetails['product_name']+"</td>");
                  $("#tableBody").append("<td>"+data.typeDetails+"</td>");
                  $("#tableBody").append("<td>₱"+JSON.stringify(data.supplyDetails['expected_price'])+" / " + data.unitDetails +"</td>");
                  $("#tableBody").append("<td>"+JSON.stringify(data.supplyDetails['expected_quantity'])+"</td>");
                  $('#farmer').html(data.farmerDetails['firstname'] + " " +  data.farmerDetails['lastname']);
                  $('#contact').html('0' + data.farmerDetails['contact'].substring(2) );
                  $('#supply_status').html(data.supplyDetails['status'] );
                  $('#expected_harvest').html(data.supplyDetails['expected_harvest_date'] );
                  $('#expected_delivery').html(data.supplyDetails['expected_delivery_date'] );

                  $("#tableBody").append("</tr>");
               }
    });
}


            </script>



@endsection
