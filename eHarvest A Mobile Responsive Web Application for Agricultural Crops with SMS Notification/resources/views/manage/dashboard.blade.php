@extends('layouts.template')

@section('content')

       <!-- Begin Page Content -->
       <div class="container py-5">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h2>Dashboard</h2>
              <a href="/news" class=" d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fa fa-upload fa-sm text-white-50"></i> Update News</a>
            </div>
  
            <!-- Content Row -->
            <div class="row">
  
              <!-- Earnings (Monthly) Card Example -->
              
              <div class="col-xl-3 col-md-6">
                  <a href="/revenue" id="report">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                       
                      <div class="col mr-2" >
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenue (Monthly)</div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($monthly))
                        {{number_format($monthly, 0, '.', ',')}}
                        @else
                        0.00
                        @endif
                        </div>
                      </div>
                      {{-- <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div> --}}
                       
                    </div>
                  </div>
                </div>
              </a>
              </div>
               
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6">
                  <a href="/cost" id="report">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Costs (Monthly)</div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($monthlyCost))
                        {{number_format($monthlyCost, 0, '.', ',')}}
                        @else
                        0.00
                        @endif
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>

              <!-- Pending Delivery Card Example -->
              <div class="col-xl-3 col-md-6">
                  <!-- <a href="/profit" id="report"> -->
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Profit (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($monthly) && isset($monthlyCost))
                        {{number_format($monthly - $monthlyCost, 0, '.', ',')}}
                        @else
                        0
                        @endif</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>

            
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6">
                  <a href="/orderFilter?selectType=for+approval" id="report">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Order Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @if(isset($pending))
                        {{$pending}}
                        @else
                        0
                        @endif</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <br>
            <br>
            <!-- Content Row -->
            <div class="row">
  
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6">
                  <a href="/revenueY" id="report">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Revenue (Annual)</div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($annual))
                        {{number_format($annual, 0, '.', ',')}}
                        @else
                        0.00
                        @endif
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>
  
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6">
                  <a href="/costY" id="report">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Costs (Annual)</div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($yearlyCost))
                        {{number_format($yearlyCost, 0, '.', ',')}}
                        @else
                        0.00
                        @endif
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>

              <!-- Pending Delivery Card Example -->
              <div class="col-xl-3 col-md-6">
                  <!-- <a href="/profit" id="report"> -->
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Profit (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                        @if(isset($yearlyCost) && isset($annual))
                        {{number_format($annual - $yearlyCost, 0, '.', ',')}}
                        @else
                        0
                        @endif</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>

             
  
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6">
                  <a href="/orderFilter?selectType=for+delivery" id="report">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Awaiting Delivery Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @if(isset($pendingDelivery))
                        {{$pendingDelivery}}
                        @else
                        0
                        @endif</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
  
            <!-- Content Row -->
  
            <div class="row">
  
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="revenueCheckbox" onclick="checkRevenue()" checked>
                        <label class="custom-control-label" for="revenueCheckbox">Revenue</label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2">
                          <input type="checkbox" class="custom-control-input" id="costCheckbox" onclick="checkCost()" checked>
                          <label class="custom-control-label" for="costCheckbox">Cost</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="profitCheckbox" onclick="checkProfit()"checked>
                            <label class="custom-control-label" for="profitCheckbox">Profit</label>
                          </div>
                    <div class="dropdown no-arrow">
                      

                    
                        
                          <select onchange="getYear()"id="selectYear" name="selectYear" class="form-control">
                              <option value="" selected disabled>Select Year</option>
                              @foreach ($years as $year)
                              <option value='{{$year}}'>{{$year}}</option>
                                  
                              @endforeach
                              
                            </select>
                       
                      
                       
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="myAreaChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5 py-4">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users Overview</h6>
                     
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-pie pt-1 pb-1">
                      <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                      <span class="mr-2">
                        <i class="fa fa-circle text-warning"></i> Admin
                      </span>
                      <span class="mr-2">
                        <i class="fa fa-circle text-success"></i> Consumer
                      </span>
                      <span class="mr-2">
                        <i class="fa fa-circle text-danger"></i> Driver
                      </span>
                      <span class="mr-2">
                            <i class="fa fa-circle text-primary"></i> Farmer
                          </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
   
  
             
  
               
  
                
  
              </div>
  
               
            {{-- </div>
  
          </div> --}}
          <!-- /.container-fluid -->
    
 
          <script src="{{ asset('js/demo/chart-area-demo.js') }}" defer></script>
          <script src="{{ asset('js/demo/chart-pie-demo.js') }}" defer></script>
          <script>
$( window ).on( "load", function() {
  
    event.preventDefault();

    $.ajaxSetup({

    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    $.ajax({
               type:'GET',
               url:'/getUsersOverview',

               data:{},
               success:function(data) {
                // alert(JSON.stringify(data));
                $.each(data.overview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myPieChart.data.labels.push(key);
                  myPieChart.data.datasets[0].data.push(value);
                })
                $.each(data.earningsOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myLineChart.data.labels.push(key);
                  myLineChart.data.datasets[0].data.push(value);
                })
                $.each(data.costsOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myLineChart.data.datasets[2].data.push(value);
                })
                $.each(data.revenueOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myLineChart.data.datasets[1].data.push(value);
                })
                myLineChart.update();
                myPieChart.update();
                
                
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
    // myPieChart.data.datasets[0].data.push(1);
    // myPieChart.data.datasets[0].data.push(2);
    // myPieChart.update();
});

function getYear()
{
  
  var year = $("#selectYear").val();
 
  event.preventDefault();

    $.ajaxSetup({

    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    $.ajax({
               type:'GET',
               url:'/getYearGraph',
               data:{year:year},
               success:function(data) {
                 myLineChart.data.datasets[0].data=[];
                 myLineChart.data.datasets[1].data=[];
                 myLineChart.data.datasets[2].data=[];
                //  myLineChart.data.datasets[0].pop();
                //  myLineChart.data.datasets.forEach((dataset) => {
                //     // dataset.data.pop();
                //     foreach(dataset.data as var datas){
                //       datas.pop();
                //     }
                // });
                 
                $.each(data.earningsOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  // myLineChart.data.labels.push(key);
                  myLineChart.data.datasets[0].data.push(value);
                })
                
                $.each(data.costsOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myLineChart.data.datasets[2].data.push(value);
                })
                $.each(data.revenueOverview,function(key,value){
                  // alert(key);
                  // alert(value);
                  myLineChart.data.datasets[1].data.push(value);
                })
                 myLineChart.update();
                // myPieChart.update();
                
                
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

function checkRevenue()
{
  
  var checkBox = document.getElementById("revenueCheckbox");
  if (checkBox.checked == true){
    myLineChart.data.datasets[1].hidden=false;
  } else {
    myLineChart.data.datasets[1].hidden=true;
  }
  myLineChart.update();
}
function checkProfit()
{
  
  var checkBox = document.getElementById("profitCheckbox");
  if (checkBox.checked == true){
    myLineChart.data.datasets[0].hidden=false;
  } else {
    myLineChart.data.datasets[0].hidden=true;
  }
  myLineChart.update();
}
function checkCost()
{
  
  var checkBox = document.getElementById("costCheckbox");
  if (checkBox.checked == true){
    myLineChart.data.datasets[2].hidden=false;
  } else {
    myLineChart.data.datasets[2].hidden=true;
  }
  myLineChart.update();
}
</script>
@endsection
