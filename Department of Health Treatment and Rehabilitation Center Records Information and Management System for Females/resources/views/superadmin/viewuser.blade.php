@extends('main')
@section('content')



        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>User Profile</li>
        </ol>

      <div class="container">
         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
              @foreach($uses as $use)
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Name:</h5> {{$use->fname}} {{$use->lname}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Email:</h5> {{$use->email}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Contact:</h5> {{$use->contact}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Role:</h5> {{$use->user_roles->name}}</p>
              </div>
              @if($use->designation != NULL)
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Designation:</h5> {{$use->user_designation->name}}</p>
              </div>
              @endif
              @if($use->department != NULL)
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Department:</h5> {{$use->user_departments->department_name}} Department</p>
              </div>
              @else
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Department:</h5> --ADMIN--</p>
              </div>
              @endif
              @endforeach
           </div>
          </fieldset>
        </div>

@endsection