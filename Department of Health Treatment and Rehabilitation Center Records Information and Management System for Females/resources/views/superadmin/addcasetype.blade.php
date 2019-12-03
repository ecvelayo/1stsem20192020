@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/show_case_types')}}"><b>Case Types</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Case type Creation</b></li>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
    <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-header"><b>Create Case Type</b></div>
      <div class="card-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <form action="{{URL::to('/add_casetype')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="case_name" class="form-control" placeholder="Case Type" required="required" autofocus="autofocus" name="case_name">
                  <label for="case_name">Case Type</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6 style="margin-top: 20px;margin-left: 20px">Addtional Textbox?</h6>
                   <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px;margin-left: 20px">
                    <input type="radio" class="custom-control-input" required id="yescourt" name="court" value="1">
                    <label class="custom-control-label"  for="yescourt"><h6>Yes</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px">
                    <input type="radio" class="custom-control-input" required id="nocourt" name="court" value="0">
                    <label class="custom-control-label" for="nocourt"><h6>No</h6></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <input class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
        </form>
      </div>
    </div> 
  </div>
  
@endsection