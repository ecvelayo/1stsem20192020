@extends('main')
@section('content')
<style>

  th {
  text-align: inherit;
  background-color: #212529;
  color:white;
  }

</style>
 
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Patients</b></li>
        </ol> 

        <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>Patients</b></p>
              </div>

                @include('flash::message')

            </div>
          </div>
          @if(Auth::user()->designation != $dentist[0]->id && Auth::user()->designation != $psychiatrist[0]->id)
          <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/patient_dep')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Patient</button></a>
              </div>
          </div>
        </div>
        @endif
        </div>
         <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pat as $pats)  
                  @if(in_array($pats->department_id, $user_dept)) 
                    @if($pats->flag != 'deleted')    
                  <tr>
                    <td>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</td>
                    <td>{{$pats->address->street}},{{$pats->address->barangay}},{{$pats->address->city}}</td>
                    <td>{{$pats->departments->department_name}} Department</td>
                    <td style="text-align: center"><a class="btn btn-success" href="{{URL::to('/viewpatient/'.$pats->id)}}" style="margin-right: 10px;color:white">View</a>
                     @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                      <button class="btn btn-danger" data-toggle="modal" data-target="#deletePatient" data-patientid="{{$pats->id}}">Delete</button>
                      @endif
                     @endif
                  </tr>
                  @elseif(Auth::user()->user_role()->first()->name == 'Superadmin')
                    @if($pats->flag != 'deleted')
                  <tr>
                    <td>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</td>
                    <td>{{$pats->address->street}},{{$pats->address->barangay}},{{$pats->address->city}}</td>
                    <td>{{$pats->departments->department_name}} Department</td>
                    <td style="text-align: center"><a class="btn btn-success" href="{{URL::to('/viewpatient/'.$pats->id)}}" style="margin-right: 10px;color:white">View</a>
                     @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                      <button class="btn btn-danger" data-toggle="modal" data-target="#deletePatient" data-patientid="{{$pats->id}}">Delete</button>
                     @endif
                    </td>
                  </tr>
                    @endif
                  @elseif(Auth::user()->user_role()->first()->name == 'Admin')
                    @if($pats->flag != 'deleted')
                  <tr>
                    <td>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
                    <td>{{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</td>
                    <td>{{$pats->address->street}},{{$pats->address->barangay}},{{$pats->address->city}}</td>
                    <td>{{$pats->departments->department_name}} Department</td>
                    <td style="text-align: center"><a class="btn btn-success" href="{{URL::to('/viewpatient/'.$pats->id)}}" style="margin-right: 10px;color:white">View</a>
                      @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                      <button class="btn btn-danger" data-toggle="modal" data-target="#deletePatient" data-patientid="{{$pats->id}}">Delete</button>
                      @endif
                    </td>
                  </tr>
                    @endif
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>


@endsection