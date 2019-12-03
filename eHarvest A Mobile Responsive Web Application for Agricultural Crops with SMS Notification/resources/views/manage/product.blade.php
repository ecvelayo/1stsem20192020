@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container">

  <div class="row">
    <div class="col-sm-12 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto" id="mar">
      <div class="card" id="ordercard">
        <div class="card-body" id="background">
          <div class="menu">
            <br>
            <h1>List of Products</h1><br>

            @if(Auth::user()->type=='Admin')
            <button class="btn btn-link" id="menulink" href="/product" data-toggle="modal"
              data-target="#productModal">Add a
              Product</button>&nbsp;|&nbsp;
            <button class="btn btn-link" id="menulink" href="/product" data-toggle="modal" data-target="#unitModal">Add
              a Product Unit</button>&nbsp;|&nbsp;
            <button class="btn btn-link" id="menulink" href="/product" data-toggle="modal" data-target="#typeModal">Add
              a Product Type</button>
              <!-- &nbsp;|&nbsp;
              <button class="btn btn-link" id="menulink" href="/product" data-toggle="modal" data-target="#markup">Update Mark up</button>   -->
            @endif
          </div><br>

          <div class="  row">
            <div class="col-sm-4 ">
              <div class="input-group">
                <form method="GET" action="product" enctype="multipart/form-data">
                  @csrf
                  <div class="input-group">

                    <input type="text" class="form-control" id="searchProduct" name="searchProduct"
                      placeholder="Search product name">

                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>

                  </div>
                </form>
              </div>

            </div>

            <div class="col-sm-2"></div>

            <div class="col-sm-6">
              <form action="filterProducts" method="get" enctype="multipart/form-data">
                @csrf
                <div class="input-group">

                  <select id="selectUnit" name="selectUnit" class="form-control">
                    <option value="" selected disabled>Select Unit</option>
                    <option value="">All Units</option>
                    @if(isset($units))
                    @foreach ($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                    @endif
                  </select>

                  <select id="selectType" name="selectType" class="form-control">
                    <option value="" selected disabled>Select Type</option>
                    <option value="">All Types</option>
                    @if(isset($types))
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                    @endif
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
            <table class="table table-striped" id="managetd">
              <thead>
                <tr>

                  <th id="managetd"> Name </th>
                  <th id="managetd"> Type </th>
                  <th id="managetd"> Price/Unit </th>
                  <th id="managetd"> Stocks </th>
                  <th id="managetd"> Action </th>
                </tr>
              </thead>
              <tbody id="productsTable">
                @foreach ($data as $product)

                <tr>

                  <td id="managetd">{{$product->product_name}} </td>
                  <td id="managetd">{{$product->type['name']}} </td>
                  <td id="managetd">
                    ₱{{number_format($product->price, 2, '.', ',')}} /
                    {{$product->unit['name']}}
                  </td>
                  <td id="managetd">{{$product->quantity}} </td>
                  <td id="managetd">
                    <a href="{{ route('productInfo', $product->id) }}" class="btn btn-primary" data-toggle="tooltip"
                      data-placement="top" title="View Product"><i class="fa fa-eye"></i></a>
                    @if(Auth::user()->type == 'Admin')
                    <span data-toggle="modal" data-target="#editModal">
                      <a onclick="editPrice({{$product->id}})" class="btn btn-success" data-toggle="tooltip"
                        data-placement="top" title="Update Product Price"><i class="fa fa-pencil"></i></a>
                    </span>


                    <span data-toggle="modal" data-target="#editstock">
                      <a onclick="updateStocks({{$product->id}}, {{$product->quantity}})" class="btn btn-info" data-toggle="tooltip"
                        data-placement="top" title="Update Stock"><i class="fa fa-refresh"></i></a>
                    </span>

                    <a onclick="deleteProd({{$product->id}})" class="btn btn-danger" data-toggle="tooltip"
                      data-placement="top" title="Delete Product"><i class="fa fa-trash"></i></a>
                    @endif
                    <span data-toggle="modal" data-target="#restock">
                      <a onclick="updateID({{$product->id}}, {{$product->srp}})" class="btn btn-warning" data-toggle="tooltip"
                        data-placement="top" title="Restock Product"><i class="fa fa-plus"></i></a>
                    </span>
                  </td>
                </tr>
                @endforeach

              </tbody>

            </table>
          </div>
          {!! $data->render() !!}
          @endif

          @if($errors->any())
          <h2 style="text-align: center;">{{$errors->first()}}</h2>
          @endif

        </div>

      </div>

    </div>


  </div>
</div>
</div>
</div>
</div>

{{-- modal for add product  --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" id="productModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="mowdal">
      <div class="modal-header">
        <h4 class="modal-title" id="productModalLabel">Add Product</h4>

        <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="addProductForm" enctype="multipart/form-data">
          @csrf



          <div class="form-group row">
            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }} <font
                color="red">*</font></label>


            <div class="col-sm-6">


              <input id="product_name" type="text"
                class="form-control {{$errors->has('product_name') ? ' is-invalid ' : ''}}" name="product_name"
                value="{{ old('product_name') }}" autocomplete="product_name">
                <span class="text-danger d-none" id = "product_nameError"></span>

            </div>



          </div>


          <div class="form-group row">
            <label for="product_type" class="col-md-4 col-form-label text-md-right">{{ __('Product Type') }} <font
                color="red">*</font></label>

            <div class="col-sm-6">


              <select id="product_type" class="form-control @error('product_type') is-invalid @enderror"
                name="product_type" value="{{ old('product_type') }}" autocomplete="product_type">
                <option selected disabled>Choose...</option>
                <!-- <option value="Fruit">Fruits</option>
                                <option value="Vegetable">Vegetables</option> -->
                @if(isset($types))
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
                @endif
              </select>
              <span class="text-danger d-none" id = "product_typeError"></span>


            </div>


          </div>


          <div class="form-group row">
            <label for="unit" class="col-md-4 col-form-label text-md-right">{{ __('Product Unit') }} <font color="red">*
              </font></label>

            <div class="col-sm-6">


              <select id="product_unit" class="form-control @error('unit') is-invalid @enderror" name="unit"
                value="{{ old('unit') }}" autocomplete="unit" autofocus>
                <option selected disabled>Choose...</option>
                @if(isset($units))
                @foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
                @endif
              </select>
              <span class="text-danger d-none" id = "unitError"></span>


            </div>
          </div>

          {{--Input for srp--}}
          {{-- <div class="form-group row">
            <label for="srp" class="col-md-4 col-form-label text-md-right">{{ __('Suggested Retail Price') }} <font color="red">*
              </font></label>

            <div class="col-sm-6">
              <input id="srp" type="number" class="form-control {{$errors->has('srp') ? ' is-invalid ' : ''}}" name="srp" value="{{ old('srp') }}" autocomplete="srp">
              <span class="text-danger d-none" id = "srpError"></span>


            </div>
          </div> --}}

          {{--Input for markup price--}}
          <div class="form-group row">
            <label for="markup" class="col-md-4 col-form-label text-md-right">{{ __('Mark Up %') }} <font color="red">*
              </font></label>

            <div class="col-sm-6">
              <input id="markup" type="number" class="form-control {{$errors->has('markup') ? ' is-invalid ' : ''}}" name="markup" value="{{ old('markup') }}" autocomplete="markup">
              <span class="text-danger d-none" id = "markupError"></span>


            </div>
          </div>





          <div class="form-group row">
            <label for="product_description"
              class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }} <font color="red">*</font>
            </label>

            <div class="col-sm-6">
              <textarea id="product_description" rows="3"
                class="form-control {{$errors->has('product_description') ? ' is-invalid ' : ''}}"
                name="product_description" value="{{ old('product_description') }}" autocomplete="product_description"
                autofocus > </textarea>
                <span class="text-danger d-none" id = "product_descriptionError"></span>

              {{-- <textarea class="form-control" rows="3" id="comment" name="text"></textarea> --}}


            </div>
          </div>

          <div class="form-group row">
            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Product Photo') }} <font
                color="red">*</font></label>

            <div class="col-sm-6">
              <input id="photo" type="file" class="form-control-file {{$errors->has('photo') ? ' is-invalid ' : ''}}"
                name="photo" autofocus>
                <span id = "photoError" class="text-danger d-none"></span>
              <br>
              <p style="color:red;"> Choose .jpg or .png file only.. </p>

            </div>
          </div>

          <div class="modal-footer">

            <div class="col-sm-8 offset-sm-3 ">
              <button id = "addProductSubmit" type="submit" class="btn btn-primary">  <i class="fa fa-plus"></i>
                {{ __('Add Product') }}
              </button>
            </div>

        </form>

      </div>





    </div>

  </div>
</div>
</div>








{{-- Modal for editing product price --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">

  <!-- <form action="priceUpdate" method="POST">
    @csrf -->


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="form-group-row">


        </div>
        <br>


        {{-- input price --}}

        <div class="form-group row">
          <label for="price1" class="col-md-4 col-form-label text-md-right">{{ __('Suggested Retail Price') }}</label>

          <div class="col-sm-6">

            <input id="srp2" type="number" class="form-control {{$errors->has('srp2') ? ' is-invalid ' : ''}}"
              name="srp2" value="{{ old('srp2') }}" autocomplete="srp2" required>
              <span class="text-danger d-none" id="srp2Error">test</span>

          </div>

        </div>

        <div class="form-group row">
          <label for="price1" class="col-md-4 col-form-label text-md-right">{{ __('Mark Up %') }}</label>

          <div class="col-sm-6">

            <input id="markup2" type="number" class="form-control {{$errors->has('markup2') ? ' is-invalid ' : ''}}"
              name="markup2" value="{{ old('markup2') }}" autocomplete="markup2" required>
              <span class="text-danger d-none" id="markup2Error">test</span>

          </div>

        </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
      @if(isset($product))
      <button type="submit" class="btn btn-primary" id="updatePrice" onclick="updatePrice({{$product->id}})"><i class="fa fa-check"></i> Save
        changes</button>
      @endif

    </div>

  </div>
</div>
</div>



{{-- Modal for editing product stock --}}
<div class="modal fade" id="editstock" tabindex="-1" role="dialog" aria-labelledby="editstock" aria-hidden="true">

  <!-- <form action="priceUpdate" method="POST">
    @csrf -->


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Update Product stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="form-group-row">


        </div>
        <br>




        {{-- input product stock --}}

        <div class="form-group row">
          <label for="prod_stock" class="col-md-4 col-form-label text-md-right">{{ __('Product Stock') }}</label>

          <div class="col-sm-6">

            <input id="prod_stock" type="text" class="form-control {{$errors->has('prod_stock') ? ' is-invalid ' : ''}}"
              name="prod_stock" value="{{ old('prod_stock') }}" autocomplete="prod_stock" required>
              <span id="prod_stockError" class="text-danger d-none">asdasdsad</span>

          </div>

        </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
      @if(isset($product))
      <button type="submit" class="btn btn-primary" id="updateStock" ><i class="fa fa-check"></i> Save
        changes</button>
      @endif

    </div>

  </div>
</div>
</div>











{{-- Modal for adding new unit --}}
<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="unitModalLabel">Add New Product Unit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          {{-- input for quantity --}}
          <div class="form-group row">
            <label for="unitName" class="col-sm-4 col-form-label text-sm-right">{{ __('Unit Name') }} <font color="red">
                *</font></label>
            <div class="col-sm-5">

              <input id="unitName" type="text" class="form-control {{$errors->has('unitName') ? ' is-invalid ' : ''}}"
                name="unitName" value="{{ old('unitName') }}" autocomplete="unitName">

                <span class="text-danger d-none" id="unitNameError">asdsad</span>



            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            <button  onclick ="addUnitName()" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Unit</button>

            {{-- <button onclick ="updateDeliveryCharge()"type="submit" class="btn btn-primary">Save Changes</button> --}}

          </div>
        </div>
    </div>
    </form>
  </div>
</div>
</div>
</div>

{{-- Modal for adding new type --}}
<div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="typeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="typeModalLabel">Add New Product Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          {{-- input for quantity --}}
          <div class="form-group row">
            <label for="typetName" class="col-sm-4 col-form-label text-sm-right">{{ __('Type Name') }} <font
                color="red">*</font></label>

            <div class="col-sm-5">

              <input id="typeName" type="text" class="form-control {{$errors->has('typeName') ? ' is-invalid ' : ''}}"
                name="typeName" value="{{ old('typeName') }}" autocomplete="typeName">
                <span class="text-danger d-none" id="typeNameError">asdsad</span>



              {{-- @if ($errors->has('typeName'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('typeName') }}</strong>
              </span>
              @endif --}}
            </div>
          </div>


        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
          <button onclick ="addTypeName()" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Type</button>
            {{-- <button onclick ="updateDeliveryCharge()"type="submit" class="btn btn-primary">Save Changes</button> --}}
        </div>
      </form>
    </div>
  </div>
</div>


{{-- Modal for update price markup --}}
<div class="modal fade" id="markup" tabindex="-1" role="dialog" aria-labelledby="typeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="typeModalLabel">Update Mark Up</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

              {{-- input percentage --}}

      <div class="form-group row">
          <label for="percentage" class="col-md-4 col-form-label text-md-right">{{ __('Percentage') }}</label>

          <div class="col-sm-6">


            <input id="percentage" type="text" class="form-control {{$errors->has('percentage') ? ' is-invalid ' : ''}}"
              name="percentage" value="{{ old('percentage') }}" autocomplete="percentage" required>




          </div>

        </div>



        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
          <button onclick ="addTypeName()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
            {{-- <button onclick ="updateDeliveryCharge()"type="submit" class="btn btn-primary">Save Changes</button> --}}
        </div>
      </form>
    </div>
  </div>
</div>






<!-- Modal for restock product -->
<div class="modal fade" id="restock" tabindex="-1" role="dialog" aria-labelledby="restockLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form enctype="multipart/form-data">
          @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="restockLabel">Restock Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- input for quantity --}}
        <div class="form-group row">
          <label for="expected_quantity"
            class="col-sm-4 col-form-label text-sm-right">{{ __('Expected Quantity') }}</label>

          <div class="col-sm-6">

            <input id="expected_quantity" type="number"
              class="form-control {{$errors->has('expected_quantity') ? ' is-invalid ' : ''}}"
              name="expected_quantity" value="{{ old('expected_quantity') }}" autocomplete="expected_quantity"
              min="1" max="9999">
              <span class="text-danger d-none" id="expected_quantityError">asdsad</span>



          </div>
        </div>

        <div class="col-sm-12">
          <center><strong><span class="text-success" id="suggest-price"></span></strong></center>
        </div>

         {{-- input price --}}

        <div class="form-group row">
              <label for="expected_price"
                class="col-md-4 col-form-label text-md-right">{{ __('Expected Price per Unit') }}</label>

              <div class="col-sm-6">


                <input id="expected_price" type="text" class="form-control {{$errors->has('expected_price') ? ' is-invalid ' : ''}}"
                name="expected_price" value="{{ old('expected_price') }}" autocomplete="expected_price">
                <span class="text-danger d-none" id="expected_priceError">asdsad</span>
              </div>

        </div>

        {{-- date harvest --}}
        <div class="form-group row">
                <label for="expected_harvest_date"
                  class="col-md-4 col-form-label text-md-right">{{ __('Expected Date Harvest') }}</label>

                <div class="col-md-6">
                  <input id="expected_harvest_date" type="date"
                    class="form-control {{$errors->has('expected_harvest_date') ? ' is-invalid ' : ''}}"
                    name="expected_harvest_date" value="{{ old('expected_harvest_date') }}"
                    autocomplete="expected_harvest_date" autofocus >
                    <span class="text-danger d-none" id="expected_harvest_dateError">asdsad</span>


                </div>
        </div>

        {{-- date delivered --}}
        <div class="form-group row">
                <label for="expected_delivery_date"
                  class="col-md-4 col-form-label text-md-right">{{ __('Expected Date Delivered') }}</label>

                <div class="col-md-6">
                  <input id="expected_delivery_date" type="date"
                    class="form-control {{$errors->has('expected_delivery_date') ? ' is-invalid ' : ''}}"
                    name="expected_delivery_date" value="{{ old('expected_delivery_date') }}"
                    autocomplete="expected_delivery_date" autofocus >
                    <span class="text-danger d-none" id="expected_delivery_dateError">asdsad</span>
                </div>
        </div>










{{-- //end div bot --}}
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i>Close</button>
        @if(isset($product))


        <button onclick="sendData({{$product->id}})" type="submit" class="btn btn-primary">Send Request</button>

        @endif
      </div>
    </form>
    </div>
  </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

var prodID;
var name;
var unitName = "";
var srp;


$('#addProductForm').on('submit',function(event){


  $("#photoError").addClass("d-none");
  $("#unitError").addClass("d-none");
  $("#product_nameError").addClass("d-none");
  $("#product_typeError").addClass("d-none");
  $("#product_descriptionError").addClass("d-none");
  // $("#srpError").addClass("d-none");
  $("#markupError").addClass("d-none");


  var name = $('#product_name').val();
  var type = $('#product_type').val();
  var unit = $('#product_unit').val();
  // var srp = $('#srp').val();
  var markup = $('#markup').val();
  var description = $('#product_description').val();
  var photo = $('#photo').val();

  console.log(name);
  console.log(type);
  console.log(unit);
  // console.log(srp);
  console.log(markup);
  console.log(description);
  console.log(photo);


  event.preventDefault();
  $.ajaxSetup({

  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }

  });

  swal({
    title: "Are you sure?",
    text: "Do you really want to add "+name+"?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $("#addProductSubmit").attr("disabled",true);

      if(name!='' && type!='' && unit!='' && markup!='' && description!='' && photo!=''){
        swal("Adding product "+name+". Please wait for a moment.");
      }
      $.ajax({

        url:'/sampleAddProduct',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          window.location.replace("/product");
        },
        error: function(data) {

            var errors = data.responseJSON;
             console.log(errors);
            if($.isEmptyObject(errors) == false){
              $("#addProductSubmit").attr("disabled",false);
                $.each(errors.errors,function(key,value){

                    var errorID = '#' + key + 'Error';
                    $(errorID).removeClass("d-none");
                    $(errorID).text(value);
                })
            }
        }

        });

    } else {
      swal("Product "+name+" was not added.");
    }
  });




});



//end of add new product
function addUnitName(){

    var unitName = $('#unitName').val();

    event.preventDefault();

    $.ajaxSetup({

       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

  });

  swal({
    title: "Are you sure?",
    text: "Do you want to add "+unitName+" as a unit?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
          type:'POST',
          url:'/unit',

          data:{unitName:unitName},
          success:function(data) {

            location.reload();


          },
          error: function(data) {

              var errors = data.responseJSON;
              console.log(errors);
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
      swal(unitName+" was not added as a unit.");
    }
  });


}




///end of validate unit
function addTypeName(){

  //  var unitName = $('#unitName').val();
  var typeName = $('#typeName').val();
   event.preventDefault();

   $.ajaxSetup({

      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }

 });

 swal({
    title: "Are you sure?",
    text: "Do you want to add "+typeName+" as a product type?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
          type:'POST',
          url:'/types',

          data:{typeName:typeName},
          success:function(data) {

            location.reload();


          },
          error: function(data) {

              var errors = data.responseJSON;
              console.log(errors);
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
      swal(typeName+" was not added as a product type.");
    }
  });


}

//restock
function sendData(){
    id = prodID;
    name = name;
    unitName = unitName;

   var expected_quantity=$("#expected_quantity").val();
   var expected_price= $("#expected_price").val();

   var expected_harvest_date =$("#expected_harvest_date").val();
   var expected_delivery_date =$("#expected_delivery_date").val();



   event.preventDefault();

    $.ajaxSetup({

       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

  });



  swal({
    title: "Are you sure?",
    text: "Do you want to restock "+name+" with "+expected_quantity+" "+unitName+"?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
          type:'POST',
          url:'/addSupply',

          data:{prodID:prodID,expected_quantity:expected_quantity,expected_price:expected_price,expected_harvest_date:expected_harvest_date,expected_delivery_date:expected_delivery_date,srp:srp},
          success:function(data) {
            location.reload();


          },
          error: function(data) {
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

    } else {
      swal(name+" was not restocked.");
    }
  });



 }



//end of validate type
  var prodID;
  var name;
  var unitName;
  // var srp;

  function updateID(valueID, valueSRP){
      prodID = valueID;
      srp = valueSRP;

      console.log(prodID);
      console.log(srp);

      // document.getElementById("suggest-price").textContent="*The Suggested Retail Price is ₱"+srp+"*";

      event.preventDefault();

       $.ajaxSetup({

          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }

     });


     $.ajax({
                type:'GET',
                url:'/productDet',

                data:{id:id},
                success:function(data) {

                     name = data.prod[0].product_name;
                     unitName = data.prod[0].unit.name;
                     // unitName = "test";

               }
     });
}





// for updating product price
function editPrice (valueId){
     id = valueId;
     prodName = "";

     event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/productDet',

               data:{id:id},
               success:function(data) {

                    var percentage = data.prod[0].markup * 100;

                    document.getElementById("srp2").value = data.prod[0].srp;
                    document.getElementById("markup2").value = percentage;
                    prodName = data.prod[0].product_name;
              }
    });

    $("#updatePrice").click(function (){

        var srp2 = $("#srp2").val();
        var markup2 = $("#markup2").val();
        // alert(String(id) + " " + String(price));
        console.log(srp2);
        console.log(markup2);

        swal({
          title: "Are you sure?",
          text: "Do you really want to set SRP to "+srp2+" and Mark Up % to "+markup2+" for "+prodName+"?",
          icon: "warning",
          buttons: true,
          dangerMode: true
        }).then((willDelete) => {
          if (willDelete) {

            $.ajax({
                  type:'POST',
                  url:'/priceUpdate',

                  data:{id:id, srp2:srp2, markup2:markup2},
                  success:function(data){
                      // alert(JSON.stringify(data));
                      window.location.replace("/product");
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
            swal(prodName+"'s SRP and Mark Up % was not updated.");
          }
        });


    });

}

function updateStocks(valueID, quantity)
{
  id = valueID;
  qty = quantity;
  prodName = "";
  console.log(prodName);

  document.getElementById("prod_stock").value = qty;

  $.ajax({
             type:'GET',
             url:'/productDet',

             data:{id:id},
             success:function(data) {

                  prodName = data.prod[0].product_name;
            }
  });

}

$("#updateStock").click(function(){
  $("#prod_stockError").addClass("d-none");
  var prod_stock = $("#prod_stock").val();
  event.preventDefault();
  $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

  });

  swal({
    title: "Are you sure?",
    text: "Do you really want to update stocks for "+prodName+" to "+prod_stock+"?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
            type:'POST',
            url:'/updateProductStock',

            data:{id:id,prod_stock:prod_stock},
            success:function(data) {

               window.location.replace("/product");

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
      swal(prodName+"'s stocks was not updated.");
    }
  });



});


// for deleting products
function deleteProd(valueId){
  productId = valueId;
  event.preventDefault();

 SwalDelete(productId);

}

function SwalDelete(id){

  $.ajaxSetup({

     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }

 });

	swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this!",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
                 type:'POST',
                 url:'/delete',

                 data:{id:id},
                 success:function(data) {
                    window.location.replace("/product");
                }
      });

    } else {
      swal("Product was not deleted.");
    }
  });
}

//tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

// for update products




</script>
@endsection
