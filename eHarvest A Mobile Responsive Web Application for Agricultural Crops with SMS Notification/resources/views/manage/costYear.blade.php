@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="scroll">
        <button class="fa fa-arrow-up scrolimg" onclick="animateToTop(event)" title="Go to top"></button>
      </div>
      
<div class="containter">
    <div class="row">
        <div class="col-sm-8 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto">
            <div class="card" id="ordercard">

                <div class="card-body" id="background">
                    <div class="menu">
                        <br>
                        <h1>Cost Report</h1><br>
                        <h3 style="color:white;">{{$year}}</h3><br>
                      
                    </div><br>


                    <div class="row">
                        <div class="col-sm-6 ">
                                <h2>Total Cost: ₱
                                @if(isset($costYearly))
                                {{number_format($costYearly, 0, '.', ',')}}
                                @else
                                0.00
                                @endif
                                 </h2>
                            {{-- <form    role="search">
                                {{ csrf_field() }}
                                <div class="input-group">

                                    <input type="text" class="form-control" name="searchOrders" id="searchOrders"
                                        placeholder="Search Month Here">

                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form> --}}
                        </div>

                        {{-- <div class="col-sm-3"></div> --}}

                        <div class="col-sm-6">
                            <form method="GET" action="/filterCosts">
                                @csrf
                                <div class="input-group">
                                    <select id="selectType" name="selectMonth" class="form-control">
                                        <option value="" selected disabled>Select Month</option>
                                        <option value="1"> January </option>
                                        <option value="2"> February </option>
                                        <option value="3"> March </option>
                                        <option value="4"> April </option>
                                        <option value="5"> May </option>
                                        <option value="6"> June </option>
                                        <option value="7"> July </option>
                                        <option value="8"> August </option>
                                        <option value="9"> September </option>
                                        <option value="10"> October  </option>
                                        <option value="11"> November </option>
                                        <option value="12"> December </option>
                                  
                                    </select>

                                    <select id="selectType" name="selectYear" class="form-control">
                                            <option value="" selected disabled>Select Year</option>
                                            <option value="2018"> 2018 </option>
                                            <option value="2019"> 2019 </option>
                                            <option value="2020"> 2020 </option>
                                      
                                        </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </div>
                            </form>

                        </div>  
                    </div>


            
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th id="managetd"> Date </th>
                                    <th id="managetd">Product </th>
                                    <th id="managetd"> Price </th>
                                    <th id="managetd"> Quantity </th>
                                    <th id="managetd"> Grand Total </th>
                                    
                                </tr>
                            </thead>
                            @if(isset($costCollect))
                                    @foreach($costCollect as $costCol)
                            <tbody id="ordersTable">
                                <tr>
                                 
                                    <td  id="managetd">{{$costCol->updated_at->format('Y-m-d')}} </td>
                                    <td  id="managetd"> {{$costCol->products->product_name}}</td>
                                    <td  id="managetd">{{number_format($costCol->expected_price, 2, '.', ',')}}</td>
                                    <td  id="managetd">{{number_format($costCol->actual_quantity, 0, '.', ',')}} </td>
                                    <td  id="managetd">{{number_format(($costCol->expected_price * $costCol->actual_quantity), 2, '.', ',')}}</td>
                                    @endforeach
                                    
                                @else
                                @endif
                                </tr>
                              
                            </tbody>
                            <div>
                        </table>
                        
                    
                         
                    </div>
                </div>


                {{-- <div class="card-footer bg-transparent"><h2>TOTAL COST ₱: 1234123.00 </h2></div> --}}
            </div>


 

 






    
 

    <script>
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


</script>
    @endsection
