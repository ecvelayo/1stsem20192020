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
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Reports</b></li>
        </ol>


      
    <div style="background-color: white;border-radius: 5px;height: 600px">
        <div class="row" style="">
          <div class="col-md-9">
            <div class="text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px"><b>Reports</b></p> 
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
                @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                    <option value="Accomplishment Report">Monthly Accomplishment Report</option>
                    <option value="Status Report">Aftercare Status Report</option>
                    <option value="Plea Bargain">Plea Bargaining Report</option>
                @elseif(in_array(3,$user_dept) == 1)
                    <option value="Status Report">Aftercare Status Report</option>
                @endif
                </select>
                </div>
              </div>
          @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
              <div class="col-md-12" style="margin-bottom: 10px" id="depsa">
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
          @else
              <div class="col-md-12" style="margin-bottom: 10px" id="depsa">
                <div class="form-label-group">
                  <h6>Department</h6>
                 <select class="form-control" id="department" placeholder="Department" required="required" name="department" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Department</option>
                  @foreach($deps as $dep)
                    @if(in_array($dep->id,$user_dept) == 1)
                      <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
          @endif
              <div class="col-md-6" style="margin-bottom: 10px" id="datef">
                <div class="form-label-group">
                  <h6>Date from</h6>
                 <input type="date" id="datefrom" class="form-control" placeholder="Date from" required="required" autofocus="autofocus" name="datefrom">
                </div>
              </div>
               <div class="col-md-6" style="margin-bottom: 10px" id="datet">
                <div class="form-label-group">
                  <h6>Date to</h6>
                 <input type="date" id="dateto" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="dateto">
                </div>
              </div>
              <div class="col-md-6" style="margin-bottom: 10px" id="yea" hidden="true">
                <div class="form-label-group">
                  <h6>Month</h6>
                  <select class="form-control" id="month" placeholder="Month" required="required" name="month" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
               <div class="col-md-6" style="margin-bottom: 10px" id="mon" hidden="true">
                <div class="form-label-group">
                  <h6>Year</h6>
                   <select class="form-control" id="year" placeholder="Year" required="required" name="year" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Year</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                   </select>
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
    <input type="hidden" name="months" id="months">
    <input type="hidden" name="years" id="years">
    <span class="loader" style="display: none"><img style="margin-left: 340px;margin-top: 120px" src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." /><br><h6 style="margin-left: 320px;margin-top: 10px">Generating....</h6></span>
    <span class="successload" style="display: none"><h3 style="margin-left: 250px;margin-top: 100px">Your report is ready</h3><br><input class="btn btn-success" type="submit" value="Download" style="width:100px;margin-left:320px"></span>
    <span class="failedload" style="display: none"><h3 style="margin-left: 300px;margin-top: 100px">No result</h3><br></span>
  </form>
  </div>
  </div>
</div>
</div>
  
@endsection