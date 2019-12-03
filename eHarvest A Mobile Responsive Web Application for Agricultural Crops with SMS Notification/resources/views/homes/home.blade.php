@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="scroll">
  <button class="fa fa-arrow-up scrolimg" onclick="animateToTop(event)" title="Go to top"></button>
</div>
 
@if (session('status'))
<div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
@endif

 

<div class="container" id="homecontainer">
  <div class="row">
    <div class="py-3 col-sm-12  ml-sm-auto mr-sm-auto">
      <br><br><br>

      <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ul class="carousel-indicators">
          @foreach( $news as $key => $new )
         
          <li data-target="#myCarousel" data-slide-to="{{$key}}" class="carousel-1">
            @endforeach
        </ul>

     

            <div class="carousel-inner" id="inner">

          @foreach( $news as $new )
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <img id="carouselimg" src="{{ $new->photo }}" alt="{{ $new->news_name }}">
            
          </div>
          @endforeach



        </div>



        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
      <div class="carousel-title">
        <h4> News </h4>
      </div>
      <br><br>
      <div class="menu2">
        <div>
          <hr>
          <button type="button" class="btn btn-success" id="all">All Products</button>
          @foreach($types as $type)
          <button type="button" class="btn btn-success" id="{{$type->id}}">{{$type->name}}</button>
          @endforeach
          <hr>
        </div>
      </div>
      <br>

      <div class="col-sm-5 offset-sm-7">


         
        @csrf
        <div class="input-group">

          <input type="text" class="form-control" id="searchProduct" name="searchProduct" placeholder="Search product">

         

        </div>
        <!-- </form> -->




      </div>
    </div>



  </div>

</div>



@if(isset($Product))
<div class="container">
  <div class="row" id="parent">
    {{-- <p><span class="text-danger d-none" id="qtyError"></span></p> --}}
    <div class="container">
      <div class="row">
        <div class="col-sm-12  col-12">
          <h2><span class="text-danger d-none homer" id="qtyError"></span></h2>
        </div>
      </div>
    </div>
    @if($errors->any())



    <div class="container">
      <div class="row">
        <div class="col-sm-12 offset-sm-4 col-12 offset-2">
          <h2>{{$errors->first()}}</h2>
        </div>
      </div>
    </div>

    @endif

    @foreach ($Product as $products)


    <div class="col-6  col-md-3 box {{$products->types_id}}" id="productCard">
      <a href="{{ route('productInfo', $products->id) }}" id="prod_con">
        <div class="card border-success  mb-1" id="homeprods">
          <!-- set a width on the image otherwise it will expand to full width       -->
          <img class="card-img-top " src="{{$products->photo}}" alt="Card image cap" width="400" id="homeprodimg">

          <div class="card-body" id="homeprodinfo">

            <h5 class="name">{{$products->product_name}}</h5>
            <p class="title" id="productdetails">
              ₱{{number_format($products->price, 2, '.', ',')}} /
              {{$products->unit['name']}}
            </p>

            <p class="title" id="productdetails">Stocks: {{$products->quantity}}</p>


      </a>

      <p id="productdetails"><span> qty: <input type="number" class="input2" id="qty{{$products->id}}" value="1" min="0"
            name="quantity"> </span></p>

      {{-- <p><span class="text-danger d-none" id="qtyError"></span></p> --}}

      <p id="productdetails"><a
          onclick="homeAddBasket({{$products->id}}, {{$products->price}}, {{$products->quantity}})"
          class="btn btn-outline-success addtobaskethome">Add to Basket</a></p>

    
    </div>


  </div>


</div>


@endforeach


</div>

{!! $Product->render() !!}
@else
{{-- {{ $message }} --}}
<h2 style="text-align: center;"> No Items in Cart! </h2>
@endif
</div>



<script>
  $(document).ready(function(){
  var $btns = $('.btn').click(function() {
      if (this.id == 'all') {
        $('#parent > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parent > div').not($el).hide();
      }
      $btns.removeClass('active');
      $(this).addClass('active');
    })

  var $search = $("#searchProduct").on('input',function(){
      $btns.removeClass('active');
      var matcher = new RegExp($(this).val(), 'gi');
      $('.box').show().not(function(){
          return matcher.test($(this).find('.name').text())
      }).hide();
  })
})


  document.body.scrollTop = 0;
document.documentElement.scrollTop = 0;

function animateToTop(e) {
    window.scrollTo(0, 0);
}

window.addEventListener('scroll', (e) => {
    var scrollTopBtn = document.getElementsByClassName('scrolimg')[0];
    if (window.scrollY >= 100) {
        scrollTopBtn.style.visibility = 'visible';
    } else {
        scrollTopBtn.style.visibility = 'hidden';
    }
});


function homeAddBasket(prodID,price,quantity)
{

  var qty = $("#qty"+prodID).val();
   var stocks = quantity;
  

   
 
  event.preventDefault();
  $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

  });

  $.ajax({
      type:'POST',
      url:'/homeAddToCart',

      data:{prodID:prodID,price:price,qty:qty,stocks:stocks},
      success:function(data) {
        if(data.stock_error){
          $("#qtyError").removeClass("d-none");
          $("#qtyError").text(data.stock_error);
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
}

</script>

@endsection