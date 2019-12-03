@extends('main')
@section('content')
 <style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

</style>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>


      
      <div style="background-color: white;border-radius: 5px;height: 550px">
        <div class="row" style="">
          <div class="col-md-9">
            <div class="text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px">Reports</p> 
              </div>
                @include('flash::message')
            </div>
        </div>
      </div>

      <!--<div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('samplecsv')}}"><button class="btn btn-success"><i class="fas fa-fw fa fa-file-csv"></i>CSV</button></a></div>-->


  <div class="container" style="margin-left:0px">
    <div class="row">
    <div class="col-md-6">
    <div class="card" style="max-width: 500px;border-color: gray">
      <div class="card-header"  style="background-color: #343a40;color:white">Generate Reports</div>
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger">{{$error}}</div>
            @endforeach
          @endif
          <form action="{{URL::to('/samplecsv')}}" method="post" id="myform">
          {{csrf_field()}}
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12" style="margin-bottom: 10px">
                <div class="form-label-group">
                  <h6>Report</h6>
                 <select class="form-control" id="report" placeholder="Report" required="required" name="report" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Report</option>
                    <option value="Profile Report">Enrollment Profile Report</option>
                    <option value="Accomplishment Report">Monthly Accomplishment Report</option>
                    <option value="Status Report">Status Report</option>
                </select>
                </div>
              </div>
              <div class="col-md-12" style="margin-bottom: 10px">
                <div class="form-label-group">
                  <h6>Department</h6>
                 <select class="form-control" id="department" placeholder="Department" required="required" name="department" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Department</option>
                  @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                  @endforeach
                </select>
                </div>
              </div>
            <div class="col-md-6" style="margin-bottom: 10px">
                <div class="form-label-group">
                  <h6>Date from</h6>
                 <input type="date" id="datefrom" class="form-control" placeholder="Date from" required="required" autofocus="autofocus" name="datefrom">
                </div>
              </div>
               <div class="col-md-6" style="margin-bottom: 10px">
                <div class="form-label-group">
                  <h6>Date to</h6>
                 <input type="date" id="dateto" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="dateto">
                </div>
              </div>
            </div>
          </div>
           <input class="btn btn-success" type="submit" value="Generate" id="go" style="width:100px;margin-left: 0px">
        </form>
      </div>
    </div>
  </div>
<div class="col-md-6"> 
  <form action="{{URL::to('/downloadcsv')}}" method="post">
     {{csrf_field()}}
    <input type="hidden" name="reports" id="reports">
    <input type="hidden" name="departments" id="departments">
    <input type="hidden" name="datefroms" id="datefroms">
    <input type="hidden" name="datetos" id="datetos">
    <span class="loader" style="display: none"><img style="margin-left: 210px;margin-top: 120px" src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." /><br><h6 style="margin-left: 195px;margin-top: 10px">Generating....</h6></span>
    <span class="successload" style="display: none"><h3 style="margin-left: 130px;margin-top: 100px">Your report is ready</h3><br><input class="btn btn-success" type="submit" value="Download" style="width:100px;margin-left:200px"></span>
    <span class="failedload" style="display: none"><h3 style="margin-left: 200px;margin-top: 100px">No result</h3><br></span>
  </form>
  </div>
  </div>
</div>
</div>
  
@endsection