@extends('main')
@section('content')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>
      <div class="row" style="">
        <div class="col-md-8 col-sm-6 mb-3">
          <div class="row" style="">
          <div class="col-md-4 col-sm-6 mb-3">
           <div class="card bg-success text-white o-hidden h-100">
               <div class="card-body" style="text-align: center">
                <p><h1 style="font-size: 40px"><i class="fa fa-graduation-cap"></i> <span class="count"> {{$pat}}</span></h1><span><h6>Newly Graduated Patient for Today</h6></span></p>
                
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 mb-3">
            <div class="card bg-danger text-white o-hidden h-100">
               <div class="card-body" style="text-align: center">
                <p><h1 style="font-size: 40px"><i class="fa fa-ban"></i> <span class="count"> {{$patz}}</span></h1><span><h6>Newly Dismissed Patient for Today</h6></span></p>
                
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 mb-3">
            <div class="card bg-primary text-white o-hidden h-100">
              <div class="card-body" style="text-align: center">
                <p><h1 style="font-size: 40px"><i class="fa fa-check-square"></i> <span class="count"> {{$patx}}</span></h1><span><h6>Newly Enrolled Patient for Today</h6></span></p>

              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-6 mb-3">
            <div class="card mb-3">
              <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-line"></i>
                Patients Added</div>
              <div class="card-body" style="border:solid #343a40 1px">
                {!! $chart->container() !!}
              </div>
            </div>
        <!---  <div class="row">
          <div class="col-md-4 col-sm-9 mb-3" style="height: 18rem;">
            <div class="card border-dark mb-3 text-black o-hidden h-85">
              <div class="card-body">
                  <p style="font-size: 20px;margin-top: 35px"><i class="fas fa-fw fa fa-users"></i> Users</p>
                <div class="mr-5">@foreach($roles as $role) {{$role->name}}s  @endforeach</div>
              </div>
                <a style="color:white" href="{{URL::to('/chooseuser')}}"><button class="btn btn-dark btn-block" style="height: 50px">Create New User</button></a>
            </div>
          </div>
          <div class="col-md-4 col-sm-9 mb-3" style="height: 18rem;">
            <div class="card border-dark mb-3 text-black o-hidden h-85">
              <div class="card-body">
                  <p style="font-size: 20px;margin-top: 50px"><i class="fas fa-fw fa fa-hospital"></i> Departments</p>
                <div class="mr-5">@foreach($deps as $dep) {{$dep->department_name}}  @endforeach</div>
              </div>
                <a style="color:white" href="{{URL::to('/create_dep')}}"><button class="btn btn-dark btn-block" style="height: 50px">Create New Department</button></a>
            </div>
          </div>
          <div class="col-md-4 col-sm-9 mb-3" style="height: 18rem;">
            <div class="card border-dark mb-3 text-black o-hidden h-85">
              <div class="card-body">
                  <p style="font-size: 30px;margin-top: 50px"><i class="fas fa-fw fa fa-user"></i> Patients</p>
                <div class="mr-5"></div>
              </div>
                <a style="color:white" href="{{URL::to('/patient_dep')}}"><button class="btn btn-dark btn-block" style="height: 50px">Create New Patient</button></a>
            </div>
          </div>
      </div> -->
          </div>
          </div>
        </div>
           <div class="col-md-4 col-sm-6 mb-3">
           <!-- <div class="row">
              <div class="col-md-8 col-sm-6 mb-3">
                <a style="color:white" href="{{URL::to('/chooseuser')}}"><button class="btn btn-dark btn-block" style="height: 45px">New User Role</button></a>
              </div>
              <div class="col-md-8 col-sm-6 mb-3">
                <a style="color:white" href="{{URL::to('/create_dep')}}"><button class="btn btn-dark btn-block" style="height: 45px">New Department</button></a>
              </div>
              <div class="col-md-8 col-sm-6 mb-3">
                <a style="color:white" href="{{URL::to('/patient_dep')}}"><button class="btn btn-dark btn-block" style="height: 45px">New Patient</button></a>
              </div>
            </div> -->
            <div class="card mb-3">
              <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-pie"></i>
                Total no. of Patients</div>
              <div class="card-body" style="border:solid #343a40 1px">
                <canvas id="myPieChart" width="100%" height="70"></canvas>
              </div>
            </div>
          </div>
       </div>

        <!-- Icon Cards-->
        
{!! $chart->script() !!}
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script> 
<script src="{{asset('js/sb-admin.min.js')}}"></script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>

$(function () {

    var dep1 = [];
     $.ajax({ 
          url:"{{URL::route('getDeps1')}}",
          type:"GET",
          dataType:"JSON",
          async:false
    }).done(function(a){

          dep1 = a;
    8});

    var count1;
     $.ajax({ 
          url:"{{URL::route('getcountDeps1')}}",
          type:"GET",
          async:false
    }).done(function(e){

          count1 = e;
    });

    var count2;
     $.ajax({ 
          url:"{{URL::route('getcountDeps2')}}",
          type:"GET",
          async:false
    }).done(function(d){

          count2 = d;
    });

    var count3;
     $.ajax({ 
          url:"{{URL::route('getcountDeps3')}}",
          type:"GET",
          async:false
    }).done(function(f){

          count3 = f;
    });

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: dep1,
    datasets: [{
      data: [count1, count2, count3 ],
      backgroundColor: ['#007bff', 'yellowgreen', '#ffc107'],
    }],
  },
});

})

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});


</script>

@endsection