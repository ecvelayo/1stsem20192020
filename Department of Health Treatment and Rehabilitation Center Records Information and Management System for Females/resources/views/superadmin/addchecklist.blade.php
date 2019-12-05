@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/show_jails')}}"><b>Checklist</b></a>
          </li>
          <li class="breadcrumb-item active"><b>List Creation</b></li>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
    <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-header"><b>Add List</b></div>
      <div class="card-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <form action="{{URL::to('/add_checklist')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="name" class="form-control" placeholder="City Jail" required="required" autofocus="autofocus" name="name">
                  <label for="name">List Name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                 <select class="form-control" id="parentlist" placeholder="Designation" name="parentlist">
                  <label for="parnetlist">Parent List</label>
                    <option disabled selected hidden>Parent List</option>
                    <option value="">None</option>
                  @foreach($list as $lists)
                    <option value="{{$lists->id}}">{{$lists->name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group" id="sublist" name="sublist" style="display: none" required="required">
                  <h6 style="margin-top: 20px;margin-left: 20px">Has Sublist?</h6>
                   <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px;margin-left: 20px">
                    <input type="radio" class="custom-control-input" id="ylist" name="slist" value="1">
                    <label class="custom-control-label" for="ylist"><h6>Yes</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px;margin-left: 10px">
                    <input type="radio" class="custom-control-input" id="nlist" name="slist" value="0">
                    <label class="custom-control-label" for="nlist"><h6>No</h6></label>
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