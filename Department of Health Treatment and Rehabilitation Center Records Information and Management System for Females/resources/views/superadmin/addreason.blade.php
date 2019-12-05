@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/show_dismiss_reason')}}"><b>Dismissal Reasons</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Dismissal Reason Creation</b></li>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
    <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-header">Create Dismissal Reason</div>
      <div class="card-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <form action="{{URL::to('/add_reason')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="reason" class="form-control" placeholder="Reason" required="required" autofocus="autofocus" name="reason">
                  <label for="name">Reason</label>
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