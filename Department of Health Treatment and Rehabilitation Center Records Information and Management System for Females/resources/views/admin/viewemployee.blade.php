@extends('main')
@section('content')



        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Employee Profile</li>
        </ol>

      <div class="container">
         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
              @foreach($emp as $employee)
              <div class="col-md-2">
                <p style="font-size: 15px"><h5><b>Name:</b></h5> {{$employee->fname}} {{$employee->lname}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5><b>Email:</b></h5> {{$employee->email}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5><b>Contact:</b></h5> {{$employee->contact}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5><b>Designation:</b></h5> {{$employee->emp_designation->name}}</p>
              </div>
              <div class="col-md-3">
                <p style="font-size: 15px"><h5><b>Department:</b></h5> {{$employee->emp_department->department_name}} Department</p>
              </div>
              @endforeach
           </div>
          </fieldset>
        </div>

@endsection