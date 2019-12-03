@extends('main')
@section('content')

<style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }
      table, th, td { 
          border: 1px solid lightgray;
          border-collapse: collapse;
        }
        th, td {
          padding: 7px;
          text-align: left;  

        }

        .myinput {
            border: 0;
        }



</style>

<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

?>

@foreach($pat as $pats)

  @if(in_array($pats->department_id,$user_dept) == 1 || Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')

    @if(!$pid)

      @if($pats->status == 'Enrolled')
      <!--Enrolled Patient-->
        @include('conditionals.enrolled')
      <!--Enrolled Patient-->

      @elseif($pats->status == 'Graduated')
       <!--Graduated Patient-->
        @include('conditionals.graduated')
       <!--Graduated Patient-->

      @elseif($pats->status == 'Dismissed')
        <!--Dismissed Patient-->
        @include('conditionals.dismissed')
        <!--Dismissed Patient-->

      @elseif($pats->status == 'For Graduate')
        <!--For Graduation Patient-->
        @include('conditionals.forgraduation')
        <!--For Graduation Patient-->

      @elseif($pats->status == 'For Transfer')
        <!--For Transfer-->
        @include('conditionals.fortransfer')
        <!--For Transfer-->
      @endif

    @elseif($stat == 0)
    <!--For Graduation Patient-->
    @include('conditionals.forgraduationstat')
    <!--For Graduation Patient-->
     
    @elseif($stat == 1)
    <!--For Transfer Patient-->
    @include('conditionals.fortransferstat')
    <!--For Transfer Patient-->

    @endif
    


   @include('flash::message')

      <!--Tabs-->
      @include('tabs.content')
      <!--Tabs-->
  
  @elseif($stat == 1)

     <!--For Transfer Patient-->
     @include('conditionals.fortransferacc')
     <!--For Transfer Patient-->

   @include('flash::message')

      <!--Tabs-->
      @include('tabs.content')
      <!--Tabs-->
        
  @else
  <div class="card md-3 text-black o-hidden h-100">
    <div class="card-body">
       <h1 style="font-size: 50px;margin-left: 20px"><b>Error: Patient not found</b></h1>
    </div>
  </div>
  @endif
  
@endforeach     
   

<div class="modal fade" id="patientDismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Specify a reason to dismiss</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/patientDismiss')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body" style="margin-bottom: 50px">
          <div class="form-label-group" style="height: 100px">
              <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
              <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
                <select class="form-control" id="dismissal" placeholder="Dismissal Reason" required="required" name="dismissal">
                  <label for="dismissal">Dismissal Reason</label>
                    <option value="" disabled selected hidden>--Choose a Reason--</option>
                     @foreach($reasons as $reas)
                    <option value="{{$reas->id}}">{{$reas->reason}}</option>
                     @endforeach
                    <option value="Others">Others</option>
                </select>
                <div class="form-label-group" id="text" style="display: none;margin-top: 20px">
                  <textarea style="margin-left:0px;height: 100px;margin-bottom: 10px" type="text" id="remarks" class="form-control" placeholder="Specify Reason" name="remarks"></textarea>
                </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="admintransferPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>To what department?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
           @foreach($deps as $dep)
            @foreach($pat as $pats)
           @if($dep->id != $pats->department_id)
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <input type="hidden" name="patientid" id="patientid" value="">
                <input type="hidden" name="patientdep" id="patientdep" value="">
                <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>             
              <button class="btn btn-success" data-depid="{{$dep->id}}" data-toggle="modal" data-target="#admintransferReferral" data-dismiss="modal" style="color:white">
                <span style="" class="float-left">Transfer</span>
                <span  style="" class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </button>
            </div>
            </div>
        </div>
      </div>
        @endif
        @endforeach
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reenrollPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>To what department?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
        @foreach($deps as $dep)
          @foreach($pat as $pats)
           @foreach($user_dept as $udept)
            @if($dep->id == $udept)
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
              <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>
              <button class="btn btn-success" data-depid="{{$dep->id}}" data-patientid="{{$pats->id}}" data-depname-="{{$dep->department_name}}" data-toggle="modal" data-target="#adminreenrollForm" data-dismiss="modal" style="color:white">
                <span style="" class="float-left">Proceed</span>
                <span  style="" class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </button>
            </div>
            </div>
        </div>
      </div>
          @endif
        @endforeach
      @endforeach
    @endforeach
      </div>
    </div>
  </div>
</div>
  
<div class="modal fade" id="adminreenrollPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>To what department?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
        @foreach($deps as $dep)
          @foreach($pat as $pats)
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
              <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>
              <button class="btn btn-success" data-depid="{{$dep->id}}" data-patientid="{{$pats->id}}" data-depname-="{{$dep->department_name}}" data-toggle="modal" data-target="#adminreenrollForm" data-dismiss="modal" style="color:white">
                <span style="" class="float-left">Proceed</span>
                <span  style="" class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </button>
            </div>
            </div>
        </div>
      </div>
      @endforeach
    @endforeach
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="adminreenrollForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Choose a form to be filled-up</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      <div style="margin-bottom: 50px">
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
               <input type="hidden" name="department" id="department" value="">
                <p style="font-size: 10px;margin-top: 7px"><h6>Intake Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#intakeForm" data-patientid="{{$pats->id}}">Proceed</button>
              </div>
            </div>
        </div>
      </div>
      <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <input type="hidden" name="department" id="department" value="">
                <p style="font-size: 10px;margin-top: 7px"><h6>Drug Dependency Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#ddeForm" data-patientid="{{$pats->id}}">Proceed</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<div class="modal2 fade" id="intakeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" name="exampleModalLabel" value=""><b>Intake Form</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
<div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/reenrollpatientsave_intake')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-4 mb-4">
                <div class="form-label-group">
                  <h6>Patient Type*</h6>
                <select class="form-control" id="ptype" placeholder="Patient Type" required="required" name="ptype">
                  @foreach($case as $cases)
                    @if($cases->case_name == $pats->type->case_name)
                    <option  id="{{$cases->court_order}}" value="{{$cases->id}}" selected>{{$cases->case_name}}</option>
                    @else
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->type->court_order == 0)
                <div class="form-label-group" id="textb" style="display: none;">
              @else
                <div class="form-label-group" id="textb">
              @endif
                  <h6>City Jail*</h6>
                <select class="form-control" id="jail" placeholder="Patient Type" required="required" name="jail">
              @if($pats->jail != NULL)
                @foreach($jails as $jail)
                  @if($jail->name == $pats->jails->name)
                    <option value="{{$jail->id}}" selected>{{$jail->name}}</option>
                  @else
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                  @endif
                @endforeach
              @else
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
              @endif
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->caseno != NULL)
                @if($pats->type->court_order == 0)
                <div class="form-label-group" id="textas" style="display: none;">
                @else
                <div class="form-label-group" id="textas">
                @endif
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="{{$pats->caseno}}">
                </div>
              @else
                <div class="form-label-group" id="textas" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="">
                </div>
              @endif
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" required="required" autofocus="autofocus" name="age" value="{{\Carbon\Carbon::parse($pats->birthdate)->age}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" id="department" value="">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                  @if($patos != '[]')
                    @foreach($patos as $patss)
                  <input type="hidden" name="emergency_id" value="{{$patss->eperson->id}}">
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
            <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Marital Status*</h6>
                 <select class="form-control" id="civils" placeholder="{{$pats->civil_status}}" required="required" name="civils">
                  @foreach($cstatus as $cstat)
                    @if($cstat->name == $pats->cstatus->name)
                    <option value="{{$cstat->id}}" selected>{{$cstat->name}}</option>
                    @else
                    <option value="{{$cstat->id}}">{{$cstat->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
          </div>
        </div>
        </fieldset>
      @if($patos != '[]')
        @foreach($patos as $patss)
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain">
                             @foreach($eduatain as $edu)
                              @if($edu->name == $patss->eduatain->name)
                              <option value="{{$edu->id}}" selected>{{$edu->name}}</option>
                              @else
                              <option value="{{$edu->id}}">{{$edu->name}}</option>
                              @endif
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            @foreach($estatus as $estat)
                              @if($estat->name == $patss->estat->name)
                              <option value="{{$estat->id}}" selected>{{$estat->name}}</option>
                              @else
                              <option value="{{$estat->id}}">{{$estat->name}}</option>
                              @endif
                            @endforeach
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob" value="{{$patss->presenting_problems}}">{{$patss->presenting_problems}}</textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre" value="{{$patss->impression}}">{{$patss->impression}}</textarea>
              </div>
          </div>
        </fieldset>
      @endforeach
        @elseif($patos == '[]')
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" name="eduattain">
                            @foreach($eduatain as $edu)
                              <option value="{{$edu->id}}">{{$edu->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" name="edstat">
                            @foreach($estatus as $estat)    
                              <option value="{{$estat->id}}">{{$estat->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre"></textarea>
              </div>
          </div>
        </fieldset>
        @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Re enroll">
         </form>
      </div>
    </div>
  </div>
</div>

<div class="modal2 fade" id="intakeFormEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" name="exampleModalLabel" value=""><b>Intake Form</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
<div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/reenrollpatientsave_intake')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-4 mb-4">
                <div class="form-label-group">
                  <h6>Patient Type*</h6>
                <select class="form-control" id="sptype" placeholder="Patient Type" required="required" name="sptype">
                  @foreach($case as $cases)
                    @if($cases->case_name == $pats->type->case_name)
                    <option  id="{{$cases->court_order}}" value="{{$cases->id}}" selected>{{$cases->case_name}}</option>
                    @else
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->type->court_order == 0)
                <div class="form-label-group" id="stextb" style="display: none;">
              @else
                <div class="form-label-group" id="stextb">
              @endif
                  <h6>City Jail*</h6>
                <select class="form-control" id="sjail" placeholder="Patient Type" required="required" name="sjail">
              @if($pats->jail != NULL)
                @foreach($jails as $jail)
                  @if($jail->name == $pats->jails->name)
                    <option value="{{$jail->id}}" selected>{{$jail->name}}</option>
                  @else
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                  @endif
                @endforeach
              @else
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
              @endif
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
              @if($pats->caseno != NULL)
                @if($pats->type->court_order == 0)
                <div class="form-label-group" id="stextas" style="display: none;">
                @else
                <div class="form-label-group" id="stextas">
                @endif
                  <h6>Case Number*</h6>
                    <input type="text" id="scaseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="scaseno" value="{{$pats->caseno}}">
                </div>
              @else
                <div class="form-label-group" id="stextas" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="scaseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="scaseno" value="">
                </div>
              @endif
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" name="mname" value="{{$pats->mname}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" id="department" value="{{$pats->department_id}}">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                  <input type="hidden" name="edvalue" value="1">
                  <input type="hidden" name="fvalue" value="Intake Form">
                  @if($patos != '[]')
                    @foreach($patos as $patss)
                  <input type="hidden" name="emergency_id" value="{{$patss->eperson->id}}">
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
            <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Marital Status*</h6>
                 <select class="form-control" id="civils" placeholder="{{$pats->civil_status}}" required="required" name="civils">
                   @foreach($cstatus as $cstat)
                    @if($cstat->name == $pats->cstatus->name)
                    <option value="{{$cstat->id}}" selected>{{$cstat->name}}</option>
                    @else
                    <option value="{{$cstat->id}}">{{$cstat->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
          </div>
        </div>
        </fieldset>
      @if($patos != '[]')
        @foreach($patos as $patss)
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain">
                            @foreach($eduatain as $edu)
                              @if($edu->name == $patss->eduatain->name)
                              <option value="{{$edu->id}}" selected>{{$edu->name}}</option>
                              @else
                              <option value="{{$edu->id}}">{{$edu->name}}</option>
                              @endif
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            @foreach($estatus as $estat)
                              @if($estat->name == $patss->estat->name)
                              <option value="{{$estat->id}}" selected>{{$estat->name}}</option>
                              @else
                              <option value="{{$estat->id}}">{{$estat->name}}</option>
                              @endif
                            @endforeach
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob" value="{{$patss->presenting_problems}}">{{$patss->presenting_problems}}</textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre" value="{{$patss->impression}}">{{$patss->impression}}</textarea>
              </div>
          </div>
        </fieldset>
      @endforeach
        @elseif($patos == '[]')
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername">
                         </div> 
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail">
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain">
                              <option value="" disabled selected hidden>--Choose--</option>
                            @foreach($eduatain as $edu)
                              <option value="{{$edu->id}}">{{$edu->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                              <option value="" disabled selected hidden>--Choose--</option>
                            @foreach($estatus as $estat)
                              <option value="{{$estat->id}}">{{$estat->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse">
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre"></textarea>
              </div>
          </div>
        </fieldset>
        @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value=Save>
         </form>
      </div>
    </div>
  </div>
</div>



<div class="modal2 fade" id="ddeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Drug Dependency Examination Report</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
  <div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/reenrollsave_dde')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Personal Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" name="mname" value="{{$pats->mname}}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{\Carbon\Carbon::parse($pats->birthdate)->age}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" id="department" name="department" value="">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birth Order*</h6>
                  <input type="number" id="border" class="form-control" placeholder="" required="required" autofocus="autofocus" name="border" value="{{$pats->birthorder}}">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
          </div>
        </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Contact no.*</h6>
                  <input type="text" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact" value="{{$pats->contact}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
              </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Gender*</h6>
                 <select class="form-control" id="gender" placeholder="Gender" required="required" name="gender">
                  @foreach($gender as $gend)
                    @if($gend->id == $pats->gender)
                    <option value="{{$gend->id}}" selected>{{$gend->name}}</option>
                    @else
                    <option value="{{$gend->id}}">{{$gend->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  @foreach($cstatus as $cstat)
                    @if($cstat->name == $pats->cstatus->name)
                    <option value="{{$cstat->id}}" selected>{{$cstat->name}}</option>
                    @else
                    <option value="{{$cstat->id}}">{{$cstat->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Nationality*</h6>
                <input type="text" id="nation" class="form-control" placeholder="Nationality" required="required" name="nation" value="{{$pats->nationality}}">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Religion*</h6>
                <input type="text" id="religion" class="form-control" placeholder="Nationality" required="required" name="religion" value="{{$pats->religion}}">
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
        <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 20px" class="bg bg-dark">General Information</legend>
        <div class="form-group" style="margin-left: 20px">
          <div class="form-row">
            <div class="col-md-4 mb-4">
              <div class="form-label-group">
               <h6>Patient Type*</h6>
                <select class="form-control" id="ddeptype" placeholder="Patient Type" required="required" name="ddeptype">
                    <option id="{{$pats->type->court_order}}" value="{{$pats->type->id}}" selected hidden>{{$pats->type->case_name}}</option> 
                  @foreach($case as $cases)
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              @if($pats->type->court_order != 0)
              <div class="col-md-4 mb-4">
               <div class="form-label-group" id="ddetextas">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejail" placeholder="Patient Type" name="ddejail">
                    <option value="{{$pats->jails->id}}" selected hidden>{{$pats->jails->name}}</option>
                @foreach($jails as $jail)
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextb">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecaseno" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecaseno" value="{{$pats->caseno}}">
                </div>
              </div>
              @else
               <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextas" style="display: none;">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejail" placeholder="Patient Type" name="ddejail">
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetextb" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecaseno" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecaseno" value="">
                </div>
              </div>
              @endif
          </div>
        </div>
         @if($patis != '[]')
          <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                        @foreach($patis as $patin)
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name" required="required" name="infoname" value="{{$patin->informants->name}}">
                           <input type="hidden" name="patientinfor" value="{{$patin->informant_id}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name" required="required" name="infocontact" value="{{$patin->informants->contact}}">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" required="required" value="{{$patin->informants->address}}">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred" required="required" value="{{$patin->referred_by}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <select class="form-control" id="dabused" placeholder="Gender" required="required" name="dabused" >
                 @foreach($dabused as $dab)
                    @if($dab->id == $pats->drugs_abused)
                    <option value="{{$dab->id}}" selected>{{$dab->name}}</option>
                    @else
                    <option value="{{$dab->id}}">{{$dab->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint" required="required" value="{{$patin->chief_complaint}}">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" required="required" placeholder="Please Specify" name="pillness">{{$patin->h_present_illness}}</textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" required="required" class="form-control" placeholder="Please Specify" name="dused">{{$patin->h_drug_abuse}}</textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" required="required" class="form-control" placeholder="Please Specify" name="background">{{$patin->famper_history}}</textarea>
              </div>
          </div>
            @endforeach
          @elseif($patis == '[]')
            <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname" required="required">
                           <input type="hidden" name="patientinfor">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  required="required" name="infocontact">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" required="required">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred" required="required">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <select class="form-control" id="dabused" placeholder="Gender" required="required" name="dabused" required="required">
                 @foreach($dabused as $dab)
                    <option value="{{$dab->id}}">{{$dab->name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" required="required" name="ccomplaint">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" required="required" id="pillness" class="form-control" placeholder="Please Specify" name="pillness"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" required="required" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" required="required" name="background"></textarea>
              </div>
          </div>
          @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Re-enroll">
            </div>
            </div>
        </fieldset>
      </form>
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uploadList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:500px">
        <div class="modal-header">
          <span><h5 class="modal-title" id="exampleModalLabel"><b>Upload a File</b></h5><h5 id="listle"> </h5></span>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/upload_file_checklist')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" name="checklistid" id="checklistid" value="">
          <input type="hidden" name="checklistname" id="checklistname" value="">
          <input type="hidden" name="patientid" id="patientid" value="">
          <input type="hidden" name="departmentid" id="departmentid" value="">
          <div class="form-label-group">
            <h6>Filename*</h6>
              <input type="text" id="filename" class="form-control" placeholder="Filename"  name="filename" required="required">
          </div>
          <div class="form-label-group">
              <input type="file" name="file" id="file" required="required">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Upload</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="title">
            <h5 class="modal-title"><b>Are you sure you want to delete this file?</b></h5>
          </div>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{URL::to('/delete_file_checklist')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" name="fileid" id="fileid" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
        </div>
    </div>
  </div>
</div>

<div class="modal2 fade" id="getChecklist2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px">
        <div class="modal-header">
          <div class="title">
            <h5 class="modal-title"><b>View files</b></h5>
          </div>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="checklistDetail">
        
        </div>
    </div>
  </div>
</div>


<div class=" modal2 fade" id="ddeFormEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Drug Dependency Examination Report</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      <div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/reenrollsave_dde')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Personal Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" name="mname" value="{{$pats->mname}}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{\Carbon\Carbon::parse($pats->birthdate)->age}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}">
                  <input type="hidden" id="department" name="department" value="{{$pats->department_id}}">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                  <input type="hidden" name="edvalue" value="1">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birth Order*</h6>
                  <input type="number" id="border" class="form-control" placeholder="" required="required" autofocus="autofocus" name="border" value="{{$pats->birthorder}}">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}">
            </div>
           </div>
          </div>
        </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Contact no.*</h6>
                  <input type="text" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact" value="{{$pats->contact}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
              </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Gender*</h6>
                 <select class="form-control" id="gender" placeholder="Gender" required="required" name="gender">
                 @foreach($gender as $gend)
                    @if($gend->id == $pats->gender)
                    <option value="{{$gend->id}}" selected>{{$gend->name}}</option>
                    @else
                    <option value="{{$gend->id}}">{{$gend->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  @foreach($cstatus as $cstat)
                    @if($cstat->name == $pats->cstatus->name)
                    <option value="{{$cstat->id}}" selected>{{$cstat->name}}</option>
                    @else
                    <option value="{{$cstat->id}}">{{$cstat->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Nationality*</h6>
                <input type="text" id="nation" class="form-control" placeholder="Nationality" required="required" name="nation" value="{{$pats->nationality}}">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Religion*</h6>
                <input type="text" id="religion" class="form-control" placeholder="Nationality" required="required" name="religion" value="{{$pats->religion}}">
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
        <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 20px" class="bg bg-dark">General Information</legend>
        <div class="form-group" style="margin-left: 20px">
          <div class="form-row">
            <div class="col-md-4 mb-4">
              <div class="form-label-group">
               <h6>Patient Type*</h6>
                <select class="form-control" id="ddes" placeholder="Patient Type" name="ddes">
                    <option value="{{$pats->type->id}}" selected hidden>{{$pats->type->case_name}}</option> 
                  @foreach($case as $cases)
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              @if($pats->type->court_order != 0)
              <div class="col-md-4 mb-4">
               <div class="form-label-group" id="ddets">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejs" placeholder="Patient Type" name="ddejs">
                    <option value="{{$pats->jails->id}}" selected hidden>{{$pats->jails->name}}</option>
                @foreach($jails as $jail)
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetes">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecas" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecas" value="{{$pats->caseno}}">
                </div>
              </div>
              @else
               <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddets" style="display: none;">
                  <h6>City Jail*</h6>
                <select class="form-control" id="ddejs" placeholder="Patient Type" name="ddejs">
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="ddetes" style="display: none;">
                  <h6>Case Number*</h6>
                    <input type="text" id="ddecas" class="form-control" placeholder="Case Number" autofocus="autofocus" name="ddecas" value="">
                </div>
              </div>
              @endif
          </div>
        </div>
         @if($patis != '[]')
          <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                        @foreach($patis as $patin)
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" required="required" id="infoname" class="form-control" placeholder="Last name"  name="infoname" value="{{$patin->informants->name}}">
                           <input type="hidden" name="patientinfor" value="{{$patin->informant_id}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" required="required" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact" value="{{$patin->informants->contact}}">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" required="required" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" value="{{$patin->informants->address}}">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" required="required" id="referred" class="form-control" placeholder="Referred By" name="referred" value="{{$patin->referred_by}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <select class="form-control" required="required" id="dabused" placeholder="Gender" required="required" name="dabused">
                 @foreach($dabused as $dab)
                    @if($dab->id == $pats->drugs_abused)
                    <option value="{{$dab->id}}" selected>{{$dab->name}}</option>
                    @else
                    <option value="{{$dab->id}}">{{$dab->name}}</option>
                    @endif
                  @endforeach
                </select>
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" required="required" class="form-control" placeholder="Chief Complaint" name="ccomplaint" value="{{$patin->chief_complaint}}">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" required="required" class="form-control" placeholder="Please Specify" name="pillness">{{$patin->h_present_illness}}</textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" required="required" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused">{{$patin->h_drug_abuse}}</textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" required="required" type="text" id="background" class="form-control" placeholder="Please Specify" name="background">{{$patin->famper_history}}</textarea>
              </div>
          </div>
            @endforeach
          @elseif($patis == '[]')
            <div class="form-group" style="margin-left: 20px">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname" required="required">
                           <input type="hidden" name="patientinfor">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact" required="required">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" required="required">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred" required="required">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <select class="form-control" id="dabused" placeholder="Gender" required="required" name="dabused">
                 @foreach($dabused as $dab)
                    <option value="{{$dab->id}}">{{$dab->name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint" required="required">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group" style="margin-left: 20px">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness" required="required"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" required="required" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" required="required" name="background"></textarea>
              </div>
          </div>
          @endif
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Save">
            </div>
            </div>
        </fieldset>
      </form>
    </div>
    </div>
  </div>

<div class="modal2 fade" id="getChecklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:1000px">
        <div class="modal-header">
          <h5 class="modal-title" id="title" name="title" value=""></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="checklistDetail">

        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="transferPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>To what department?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
      @foreach($deps as $dep)
        @foreach($pat as $pats)
          @if($dep->id != $pats->department_id)
              <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
                <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
                   <div class="card border-dark mb-3 text-black o-hidden h-100">
                      <div class="modal-body">
                        <input type="hidden" name="patientid" id="patientid" value="">
                        <input type="hidden" name="patientdep" id="patientdep" value="">
                        <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>
                        @if(in_array($dep->id,$user_dept) == 1)
                          <button class="btn btn-success" data-depid="{{$dep->id}}" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#deptransferReferral" data-dismiss="modal" style="color:white">
                          <span style="" class="float-left">Transfer</span>
                          <span  style="" class="float-right"><i class="fas fa-angle-right"></i></span>
                          </button>
                        @else
                          <button class="btn btn-success" data-depid="{{$dep->id}}" data-toggle="modal" data-target="#transferReferral" data-dismiss="modal" style="color:white">
                          <span style="" class="float-left">Proceed</span>
                          <span  style="" class="float-right"><i class="fas fa-angle-right"></i></span>
                          </button>
                        @endif
                      </div>
                    </div>
                  </div>
              </div>
            @endif
          @endforeach
        @endforeach
      </div>
    </div>
  </div>
</div>


</div>
</div>

@endsection

@section('script')
<script>
      
  $(document).ready(function () {
    ////----- Open the modal to CREATE a link -----////

            $('#referTable').DataTable();

            $('#nurseTable').DataTable();

            $('#dentalTable').DataTable();

            $('#psychiatristTable').DataTable();

            $('#socialworkerTable').DataTable();

            $('#BMIMonitoring').DataTable();

            $('#doctorsTable').DataTable();


            $('#MedicationRecords').DataTable();

            
            $('#BloodSugarTable').DataTable();

            $('#patientTable').DataTable({
               "order": [[0, "desc"]]
            });


  $('#tableType').change(function() {
   var id = $(this).val();

      if(id == 'BS'){

            $('#BloodSugarTablediv').removeAttr('hidden');
            $('#BloodSugarTablediv').show();

            $('#BMIMonitoringdiv').hide();
            $('#MedicationRecordsdiv').hide();
            $('#nurseTablediv').hide();


      }else if(id == 'F'){

              $('#BMIMonitoringdiv').removeAttr('hidden');
              $('#BMIMonitoringdiv').show();


             $('#BloodSugarTablediv').hide();
             $('#MedicationRecordsdiv').hide();
              $('#nurseTablediv').hide();

      }else if(id == 'M'){

              $('#MedicationRecordsdiv').removeAttr('hidden');
              $('#MedicationRecordsdiv').show();


             $('#BloodSugarTablediv').hide();
             $('#BMIMonitoringdiv').hide();
              $('#nurseTablediv').hide();

      }else{

              $('#nurseTablediv').removeAttr('hidden');
              $('#nurseTablediv').show();

            
             $('#BloodSugarTablediv').hide();
              $('#MedicationRecordsdiv').hide();
             $('#BMIMonitoringdiv').hide();
      }
});

   // $('.addNurseNotes').click(function () {

          $('body').on('click', '.addNurseNotes', function () {


            $('#NurseNotesFormData').trigger("reset");
            $('#NurseNotesModal').modal('show');

            $('#noteId').val($(this).val());

            console.log($(this).val());

       if($(this).val() != 'add'){



              var type = $('#tableType').val();
              console.log(type);

                if(type == "M"){

                  $('.medicalRecords').removeAttr('hidden');
                  $('.medicalRecords').show();




                     $('#nurseList').val("M");
                      $(".nurseList option[value=M]").removeAttr('hidden', true);
                      $(".nurseList option[value='M']").prop("selected", true);

                var type = "GET";
                var id = $(this).val();
                var ajaxurl = '{{URL::to("/getRecords")}}/mediRecords' ;

                console.log(id);


                     $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            data: {'noteId': id},
                            success: function (data) {

                                //$(".nurseList")prop()
                                $(".nurseList").attr("disabled", 'disabled');
                                $("#medication_record").val(data[0].medication);
                                $("#nursenote").val(data[0].notes);

                        }
                      });


                }else if(type == "BS"){


                  $('.BloodSugarRecords').removeAttr('hidden');
                  $('.BloodSugarRecords').show();


                

                     $('#nurseList').val("M");
                      $(".nurseList option[value=BS]").removeAttr('hidden', true);
                      $(".nurseList option[value='BS']").prop("selected", true);

                        var type = "GET";
                        var id = $(this).val();
                        var ajaxurl = '{{URL::to("/getRecords")}}/bloodSugar' ;

                console.log(id);


                     $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            data: {'noteId': id},
                            success: function (data) {

                                $(".nurseList").attr("disabled", 'disabled');
                              //  $("#medication_record").val(data[0].medication);

                              $("#reading_bbreakfast").val(data[0].reading);
                                $("#nursenote").val(data[0].notes);

                        }
                      });



                }else if(type == "F"){


                      $('.BMIRecords').removeAttr('hidden');
                      $('.BMIRecords').show();

                       $(".nurseList option[value=F]").removeAttr('hidden', true);
                      $(".nurseList option[value='F']").prop("selected", true);

                        var type = "GET";
                        var id = $(this).val();
                        var ajaxurl = '{{URL::to("/getRecords")}}/BMIRecords' ;


                     $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            data: {'noteId': id},
                            success: function (data) {

                                $(".nurseList").attr("disabled", 'disabled');
                              //$("#reading_bbreakfast").val(data[0].reading);
                                $("#weight_kg").val(data[0].weight);
                                $("#bmi_record").val(data[0].bmi);
                                $("#nursenote").val(data[0].remarks);

                        }
                      });



                }else{

                var type = "GET";
                var id = $(this).val();
                var ajaxurl = '{{URL::to("/findNotes")}}/' + id;

                       $(".nurseList").removeAttr("disabled", 'disabled');
                     $.ajax({
                            type: type,
                            url: ajaxurl,
                            dataType: 'json',
                            success: function (data) {

                                $('#nursenote').val(data.notes);

                                var service_id = data.service_id;
                                if(service_id == " "|| service_id == null){

                                    service_id = 0;
                                }
                                $('#nurseList').val(service_id);

                                $("#nurseList option[value=M]").prop('hidden', true);
                                $("#nurseList option[value=F]").prop('hidden', true);
                                $("#nurseList option[value=BS]").prop('hidden', true);

                        }

                        
                      });
                }

     }else{

                        $("#nurseList option[value=M]").removeAttr('hidden', true);
                        $("#nurseList option[value=F]").removeAttr('hidden', true);
                        $("#nurseList option[value=BS]").removeAttr('hidden', true);
                        $(".nurseList").removeAttr("disabled", 'disabled');


     }

     

    });



 


//    $('.addDoctortNotes').click(function () {
          $('body').on('click', '.addDoctortNotes', function () {


        if($(this).val() != 'add'){

        var type = "GET";
        var id = $(this).val();
        var ajaxurl = '{{URL::to("/findNotes")}}/' + id;


             $.ajax({
                    type: type,
                    url: ajaxurl,
                    dataType: 'json',
                    success: function (data) {

                        $('#notes').val(data.notes);
                        $('#doctorList').val(data.service_id);
                        $('#noteId').val(data.id);

                }
              })
    }else{
           $('#noteId').val("add");
    }

        $('#AddDoctorFormData').trigger("reset");
        $('#AddDoctorNotesModal').modal('show');
    
    });

       $('.psychiatristNotes').click(function () {

          if($(this).val() != 'add'){


        var type = "GET";
        var id = $(this).val();
        var ajaxurl = '{{URL::to("/findNotes")}}/' + id;


             $.ajax({
                    type: type,
                    url: ajaxurl,
                    dataType: 'json',
                    success: function (data) {

                        $('#notes2').val(data.notes);

                                    console.log(data.notes);


                        var service_id = data.service_id;
                        if(service_id == " "|| service_id == null){

                            service_id = 0;
                        }
                        $('#noteId').val(data.id);
                        $('#psychiatristList').val(service_id);

                }
              })
     }else{
                                    $('#noteId').val("add");


     }

          $('#AddPsychiatristFormData').trigger("reset");
          $('#AddPsychiatristNotesModal').modal('show');

       });
    

 $('.addDentalNotes').click(function () {

      if($(this).val() != "add"){

               var type = "GET";
        var id = $(this).val();
        var ajaxurl = '{{URL::to("/findNotes")}}/' + id;


             $.ajax({
                    type: type,
                    url: ajaxurl,
                    dataType: 'json',
                    success: function (data) {

                        $('#noteId').val(data.id);
                        $("#tooth_no").val(data.tooth_no);
                        $("#diagnosis").val(data.diagnose);
                        $("#service_rendered").val(data.service_rendered);
                        $("#remarks").val(data.notes);

                }
              })
      }else{

              $("#noteId").val("add");

      }

        $('#AddDentalFormData').trigger("reset");
        $('#AddDentalNotesModal').modal('show');
    
  });



$('.addSocialWorkerNotes').click(function () {


      
          if($(this).val() != 'add'){


        var type = "GET";
        var id = $(this).val();
        var ajaxurl = '{{URL::to("/findNotes")}}/' + id;


             $.ajax({
                    type: type,
                    url: ajaxurl,
                    dataType: 'json',
                    success: function (data) {

                        $('#socialworkerNote').val(data.notes);

                                    console.log(data.notes);


                        var service_id = data.service_id;
                        if(service_id == " "|| service_id == null){

                            service_id = 0;
                        }
                        $('#noteId').val(data.id);
                        $('#noteId').val(data.id);
                        $('#socialList').val(service_id);

                }
              })
     }else{

                $('#noteId').val("add");

     }


        $('#AddSocialWorkerFormData').trigger("reset");
        $('#AddSocialWorkerNotesModal').modal('show');
    
  });



    $('body').on('click', '.open_modal', function () {
             
              $('#modalFormData').trigger("reset");
              $('#linkEditor').modal('show');

               var evt_id = $('#event_id').val();
              $('#evts_id').val(evt_id);
              $('#patient_interven_id').val($(this).val());
              $('#btn-save').val("add");


          var type = "GET";
          var ajaxurl = '{{URL::to("/view/vieweventattended")}}';
          var data = [{'event_id': evt_id, 'patient_id': $(this).val()}]
              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: type,
                url: ajaxurl,
                data: {'event_id': evt_id, 'patient_id': $(this).val()},
               // dataType: 'json',
                success: function (data) {
                 
                  if (data.length > 0){ console.log(data);
                    for(var a=0; a<data.length; a++) {
                      var interven_id = data[a]['interven_id'];
                      var remarks = data[a]['remarks'];
                      var id = data[a]['id'];

                      //console.log(interven_id);
                      $("input[value=" + interven_id + "]").click();
                      $("input[name=remarks_" + interven_id + "]").val(remarks);
                      $("input[name=rec_id_" + interven_id + "]").val(id);
                    }

                      //
                  } else{
                    $('#modalFormData').trigger("reset");
                    $('#linkEditor').modal('show');
                  }
                   
                },
               error: function (data) {
                    console.log('Error:', data);
                }

            });
    
    });


    $(".nurseList").change(function (e){

         var selected = $(this).val();

                       $('.medication_record').addClass('has-error');   



          if(selected == 'M'){



            $('.medicalRecords').removeAttr('hidden');
            $('.medicalRecords').show();

            $('.note_modal').hide();
            $('.BMIRecords').hide();
            $('.BloodSugarRecords').hide();

              $('.medication_record').addClass('has-error');   

              $('.weight_kg').removeClass('has-error'); 
              $('.bmi_record').removeClass('has-error');    
              $('.reading_bbreakfast').removeClass('has-error');    


          }else if(selected == 'BS'){

            $('.BloodSugarRecords').removeAttr('hidden');
            $('.BloodSugarRecords').show();

            $('.note_modal').hide();
            $('.BMIRecords').hide();
            $('.medicalRecords').hide();


          }else if(selected == 'F'){

            $('.BMIRecords').removeAttr('hidden');
            $('.BMIRecords').show();

            $('.note_modal').hide();
            $('.BloodSugarRecords').hide();
            $('.medicalRecords').hide();

             $('.bmi_record').addClass('has-error');  
             $('.weight_kg').addClass('has-error');    

              $('.reading_bbreakfast').removeClass('has-error');   
              $('.medication_record').removeClass('has-error');  


          }else{

            $('.note_modal').removeAttr('hidden');
            $('.note_modal').show();

            $('.medicalRecords').hide();
            $('.BMIRecords').hide();
            $('.BloodSugarRecords').hide();



          }

    });

      $("input[type='checkbox']").click(function (e) {
            var id = $(this).val();
            if ($(this).is(':checked')) {
              $("#textboxes_" + id).show();
              $("#select_" + id).show();

            } else {
              $("#textboxes_" + id).hide();
               $("#select_" + id).hide();
            }
        
           })

   $('#linkEditor').on('hidden.bs.modal', function () {
        //$(this).removeData('bs.modal');
        console.log('hide');
        $(this).find('form').trigger("reset");
              $('.textboxes').hide();
              $('.select1').hide();

    });

 $('#NurseNotesModal').on('hidden.bs.modal', function () {

  console.log("hide");

        $(this).find('form').trigger("reset");

            $('.medicalRecords').hide();
            $('.BMIRecords').hide();
            $('.BloodSugarRecords').hide();


  });



  $('body').on('click', '.btn-visit-view', function () {

           $('#modalFormData').trigger("reset");
           $('#linkEditor').modal('show');

           $('#btn-attended').hide();


            $('#linkEditor input:checkbox[name="checkitem[]"]').attr('disabled','disabled');

            var id = $(this).attr('data-id');

              var ajaxurl = '{{ URL::to("/getEvent") }}/' + id;
              $.ajax({
                // contentType: "application/json; charset=utf-8",
                type: 'GET',
                url: ajaxurl,
                success: function (data) {

                      for(var i=0; i< data.length; ++i){

                        $('#linkEditor input:checkbox[value='+ data[i].interven_id +']').prop('checked', true);

                      }

                 },
               error: function (data) {
                    console.log('Error:', data);
                }

            });



   });

$('body').on('click', '.btn-visit', function () {  

           $('#modalFormData').trigger("reset");
           $('#linkEditor').modal('show');

           $('#btn-attended').show();


            $('#linkEditor input:checkbox[name="checkitem[]"]').removeAttr('disabled','disabled');

        var date = $('.visit_event_date').val();


        var patient_id = $('#patient_id').val();
        var ajaxurl = '{{ URL::to("/getCurrentEvent") }}/' + patient_id;
              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: 'GET',
                url: ajaxurl,
                data: {'date': date},
                success: function (data) {

                 
                  if(data.hasEvent && data.visitIntervens != null) {
                    var visitIntervens = data.visitIntervens;

                    

                    $('#linkEditor input:text[name="patientEventId"]').val(data.patientEventId);
                    $('#linkEditor input:text[name="eventId"]').val(data.eventId);

                    var i;
                    for (i = 0; i < visitIntervens.length; ++i) {

                      var interven_id = visitIntervens[i].interven_id;

                        $('#linkEditor input:checkbox[value='+ visitIntervens[i].interven_id +']').click();


                        var remarks = visitIntervens[i].remarks;
                        var id = visitIntervens[i].id;

                      $("input[name=remarks_" + interven_id + "]").val(remarks);
                      $("input[name=rec_id_" + interven_id + "]").val(id);

                            $('#modalFormData').trigger("reset");
                            $('#linkEditor').modal('show');
                    }

                  } else {
                      $('#linkEditor input:text[name="patientEventId"]').val();

                            $('#modalFormData').trigger("reset");
                            $('#linkEditor').modal('show');

                  }
                },
               error: function (data) {
                    console.log('Error:', data);
                }

            });

              

    });

 
      


     $('#btn-attended').click(function (e){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

          var eventArr = [];

      var checked = $("input[type=checkbox]:checked").length;

          var event_patient = $('#linkEditor input:text[name="patientEventId"]').val();
           var patient_id = $('#patient_id').val();


        var length = $("input:checkbox[name='checkitem[]']").each(function(){
              var isChecked = $(this).is(':checked');
              var event = {};
              var value = $(this).val();
              event['isChecked'] = isChecked;
              event['patient_event_id'] = $('#linkEditor input:text[name="patientEventId"]').val();
              event['rec_id'] = $('#rec_id_'+value).val();
              event['child_interven_id'] =  $('#childInterven_'+value).val();
              event['patient_id'] = $('#patient_id').val();
              event['event_id'] = $('#linkEditor input:text[name="eventId"]').val();;
              event['interven_id'] = value;
              event['remarks'] = $('#remarks_'+value).val();

              eventArr.push(event);
        });

               var ajaxurl;  

        if(event_patient){

            ajaxurl = '{{URL::to("/patient/attendIntervention")}}/'+event_patient;

         }else{

            ajaxurl  = '{{URL::to("/patient/visitNoEvent")}}/'+patient_id;

       }


       var type = "POST";
      //  var ajaxurl = '{{URL::to("/patient/attendIntervention")}}/'+event_patient;
         $.ajax({
            contentType: "application/json; charset=utf-8",
            type: type,
            url: ajaxurl,
            data: JSON.stringify(eventArr),
            success: function (data) {

                 for(var a = 0; data.length > a; a++){


                    $("#rec_id_"+data[a].interven_id).val("");
                }


                if(checked > 0){

                      $("#attend_btn").addClass("btn-success").removeClass("btn-info");

                
                }else{

                      $("#attend_btn").addClass("btn-info").removeClass("btn-success");

                }


                $('#modalFormData').trigger("reset");
                $('#linkEditor').modal('hide');
               
            },
           error: function (data) {
                console.log('Error:', data);
            }

        });

       $('#modalFormData').trigger("reset");
       $('#linkEditor').modal('hide');


});


   

    $('#add-patient-refer').click(function () {
        $('#btn-save').val("add");
        $('#modalFormData').trigger("reset");
        $('#linkEditorModal').modal('show');
    });


    $('#btn-inactive').click(function () {
        var activate = $(this).text();

            console.log(activate);

            $('#inactivemodalFormData').trigger("reset");
            $('#inactiveEditorModal').modal('show');
        


     
    });

  



$("#btn-save-socialworker").click(function (e) {
   

    if(nursenote == null  || nursenote == ""){

    }else{

 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

     var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

      var service_id = $('#socialList').val();


     if(service_id == 0){

          service_id = " ";
      }


      e.preventDefault();
         var formData = {
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: service_id,
            note_by: $('#note_by').val(),
            notes: $('#socialworkerNote').val(),
            role_type: "socialworker"
        };



        var type = "POST";
        var id = $('#id').val();
       var noteid = $('#noteId').val();

               var ajaxurl ="";


        if(noteid == "add" ){

              console.log("here");

                ajaxurl = '{{URL::to("/addsocialworkernotes")}}';

          }else{

            console.log("not here");

             ajaxurl = '{{URL::to("/updatesocialworkernotes")}}/'+noteid;

          }


     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

                var service = " ";

                  console.log(data[0].service_id);

                  if(data[0].service_id){
                     service = data[0]['servicex'].name;

                  }

                if(noteid == "add" ){

                                  $(".odd").remove();


                    var link = '<tr id="socialworker_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + service + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td></td>';
                

                    $('#socialworker-list').append(link);

               }else{

                            var link = '<td id="socialworkerService_'+data[0].id+'">'+service+'</td>';

                                   $('#socialworkerService_'+data[0].id).replaceWith(link);

                        

                                var depart = '<td id="socialworkerNote_'+data[0].id+'">'+data[0].notes+'</td>';

                                  $('#socialworkerNote_'+data[0].id).replaceWith(depart);



               }

                $('#AddSocialWorkerFormData').trigger("reset");
                $('#AddSocialWorkerNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });
  }

});

$("#btn-save-nursenotes").click(function (e) {
   

 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

        var noteId = $("#noteId").val();

        console.log("noteId",noteId);

    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

   var selectVal = $('#nurseList').val();

   var weight_kg = $('.weight_kg').val();
   var bmi_record = $('#bmi_record').val();
   var reading_bbreakfast = $('#reading_bbreakfast').val();
   var medication_record = $('#medication_record').val();
   var nursenote =$('#nursenote').val();

   if(selectVal == 'F'){

      if(weight_kg == null  || weight_kg == "" || bmi_record == null  || bmi_record == "" || nursenote == null  || nursenote == ""){
              console.log("sulod");
      }else{

        e.preventDefault();
         var formData = {
            date: date,
            patient_id: $('#patient_id').val(),
            weight: $('#weight_kg').val(),
            bmi: $('#bmi_record').val(),
            created_by: $('#note_by').val(),
            remarks: $('#nursenote').val()
        };



        var type = "POST";
        var id = $('#id').val();
        var ajaxurl ="";

        if(noteId == "add"){

        ajaxurl = '{{URL::to("/addBMIrecords")}}/BMIRecords';
        
        }else{

                  ajaxurl = '{{URL::to("/updateRecords")}}/BMIRecords/'+noteId;

        }

                      $('#tableType').val("F");
                      $(".tableType option[value=F]").removeAttr('hidden', true);
                      $(".tableType option[value='F']").prop("selected", true);

              $('#BMIMonitoringdiv').removeAttr('hidden');
              $('#BMIMonitoringdiv').show();


             $('#BloodSugarTablediv').hide();
             $('#MedicationRecordsdiv').hide();
              $('#nurseTablediv').hide();

     $.ajax({
                type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

                  if(noteId == "add"){

                                    $(".odd").remove();


                                var link = '<tr id="bmiMonitor_' + data[0].id + '"><td>' + data[0].date + '</td><td id = "bmiWeight_'+data[0].id+'">' + data[0].weight + '</td><td id="bmi_'+data[0].id+'">' + data[0].bmi + '</td><td id="bmiRemarks_'+data[0].id+'">' + data[0].remarks + '</td><td>' + data[0]['userxe'].lname +', '+ data[0]['userxe'].fname + '</td>';
                                  link += '<td><button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';
                

                              $('#bmiMonitoring-list').append(link);
                     
                  }else{

                             var bmiWeight = '<td id="bmiWeight_'+data.id+'">'+data.weight+'</td>';

                                   $('#bmiWeight_'+data.id).replaceWith(bmiWeight);

                        

                                var bmi = '<td id="bmi_'+data.id+'">'+data.bmi+'</td>';

                                  $('#bmi_'+data.id).replaceWith(bmi);

                                var bmiRemarks = '<td id="bmiRemarks_'+data.id+'">'+data.remarks+'</td>';

                                  $('#bmiRemarks'+data.id).replaceWith(bmiRemarks);



                  }
               

                $('#NurseNotesFormData').trigger("reset");
                $('#NurseNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

          

        });


        
      }

   }else if(selectVal == 'BS'){

       if( reading_bbreakfast == null  || reading_bbreakfast == " " || nursenote == null  || nursenote == " "){
              console.log("sulod");
        }else{

                        e.preventDefault();
                         var formData = {
                            dateTime: dateTime,
                            patient_id: $('#patient_id').val(),
                            reading: $('#reading_bbreakfast').val(),
                            created_by: $('#note_by').val(),
                            notes: $('#nursenote').val()
                        };

                    var noteId = $("#noteId").val();
                     var ajaxurl ="";

                    var type = "POST";
                    var id = $('#id').val();

                    if(noteId == "add"){

                     ajaxurl = '{{URL::to("/addBMIrecords")}}/BloodSugar';

                    }else{

                      ajaxurl = '{{URL::to("/updateRecords")}}/BloodSugar/'+noteId;
                    }

                       $('#tableType').val("BS");
                      $(".tableType option[value=BS]").removeAttr('hidden', true);
                      $(".tableType option[value='BS']").prop("selected", true);

                      $('#BloodSugarTablediv').removeAttr('hidden');
                      $('#BloodSugarTablediv').show();
                      $('#BMIMonitoringdiv').hide();
                     $('#MedicationRecordsdiv').hide();
                      $('#nurseTablediv').hide();

                    $.ajax({
                            type: type,
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        success: function (data) {


                            if(noteId == "add"){
                $(".odd").remove();

                                var link = '<tr id="bloodSugar_' + data[0].id + '"><td>' + data[0].dateTime + '</td><td id = "bloodSugarReading_'+data[0].id+'">' + data[0].reading + '</td><td id="bloodSugarNotes_'+data[0].id+'">' + data[0].notes + '</td><td>' + data[0]['userxe'].lname +', '+ data[0]['userxe'].fname + '</td>';
                                  link += '<td><button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';
                

                              $('#bloodSugar-list').append(link);
                     
                            }else{

                                      var reading = '<td id="bloodSugarReading_'+data.id+'">'+data.reading+'</td>';

                                   $('#bloodSugarReading_'+data.id).replaceWith(reading);

                        

                                var bloodSugarNotes = '<td id="bloodSugarNotes_'+data.id+'">'+data.notes+'</td>';

                                  $('#bloodSugarNotes_'+data.id).replaceWith(bloodSugarNotes);


                            }
                         
                           

                            $('#NurseNotesFormData').trigger("reset");
                            $('#NurseNotesModal').modal('hide');
                    },
                       error: function (data) {
                            console.log('Error:', data);
                        }

                      

                    });


        }


   }else if(selectVal == 'M'){

                if( medication_record == null  || medication_record == " " || nursenote == null  || nursenote == " "){
                      console.log("sulod");
              }else{

                     e.preventDefault();
                 var formData = {
                    intake_date: date,
                    intake_time: time,
                    patient_id: $('#patient_id').val(),
                    medication: $('#medication_record').val(),
                    created_by: $('#note_by').val(),
                    notes: $('#nursenote').val()
                };


                var type = "POST";
                var id = $('#id').val();
                var ajaxur ="";

                var noteId = $("#noteId").val();
                if(noteId == "add"){

                ajaxurl = '{{URL::to("/addBMIrecords")}}/medicalRecords';
              
                
                }else{

                      ajaxurl = '{{URL::to("/updateRecords")}}/medicalRecords/'+noteId;
              }

                 $('#tableType').val("M");
                      $(".tableType option[value=M]").removeAttr('hidden', true);
                      $(".tableType option[value='M']").prop("selected", true);

                      $('#BloodSugarTablediv').hide();
                      $('#BMIMonitoringdiv').hide();
                     $('#MedicationRecordsdiv').removeAttr('hidden');
                      $('#MedicationRecordsdiv').show();
                      $('#nurseTablediv').hide();

             $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {


                            if(noteId == "add"){
                                              $(".odd").remove();

                                var link = '<tr id="medication_' + data[0].id + '"><td>' + data[0].intake_date + '</td><td>' + data[0].intake_time + '</td><td id = "medicine_'+data[0].id+'">' + data[0].medication + '</td><td id="medicineNotes_'+data[0].id+'">' + data[0].notes + '</td><td>' + data[0]['userxe'].lname +', '+ data[0]['userxe'].fname + '</td>';
                                  link += '<td><button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';
                

                              $('#medication-list').append(link);
                     
                            }else{

                                      var medicine = '<td id="medicine_'+data.id+'">'+data.medication+'</td>';

                                   $('#medicine_'+data.id).replaceWith(medicine);

                        

                                var medicineNotes = '<td id="medicineNotes_'+data.id+'">'+data.notes+'</td>';

                                  $('#medicineNotes_'+data.id).replaceWith(medicineNotes);


                            }


                       

                        $('#NurseNotesFormData').trigger("reset");
                        $('#NurseNotesModal').modal('hide');
                },
                   error: function (data) {
                        console.log('Error:', data);
                    }

                  

                });




                
              }


       
   }else{


    if($('.nursenote').val() == null || $('.nursenote').val() == " "){

          console.log("sulod");

    }else{

        var service_id = $('#nurseList').val();

      if(service_id == 0){

          service_id = " ";
      }


      e.preventDefault();
         var formData = {
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: service_id,
            note_by: $('#note_by').val(),
            notes: $('#nursenote').val(),
            role_type: "nurse"
        };


        var type = "POST";
        var id = $('#id').val();

        var noteId = $("#noteId").val();
        if(noteId == "add"){

        var ajaxurl = '{{URL::to("/addsocialworkernotes")}}';
        
        }else{

          ajaxurl = '{{URL::to("/updatesocialworkernotes")}}/'+noteId;

        }

     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {



                var service = " ";

                  console.log(data[0].service_id);
                  if(data[0].service_id){
                     service = data[0]['servicex'].name;

                  }

                   if(noteId == "add"){

                                    $(".odd").remove();


                    var link = '<tr id="nurse_' + data[0].id + '"><td>' + data[0].date_time + '</td><td id="nurseService_' + data[0].id + '">' + service + '</td><td id="nurseNote_' + data[0].id + '">' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                    link += '<td><button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';
                

                    $('#nurse-list').append(link);

               }else{

                    var medicine = '<td id="nurseService_'+data[0].id+'">'+service+'</td>';

                                   $('#nurseService_'+data[0].id).replaceWith(medicine);

                        

                                var medicineNotes = '<td id="nurseNote_'+data[0].id+'">'+data[0].notes+'</td>';

                                  $('#nurseNote_'+data[0].id).replaceWith(medicineNotes);



               }

                $('#NurseNotesFormData').trigger("reset");
                $('#NurseNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });

    }
  }

});



$("#btn-save-psychiatristnotes").click(function (e) {
   

 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

     var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

      e.preventDefault();
         var formData = {
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: $('#psychiatristList').val(),
            note_by: $('#note_by').val(),
            notes: $('#notes2').val(),
            role_type: "psychiatrist"
        };


        var type = "POST";
        var id = $('#id').val();
        var noteid = $("#noteId").val();

       var ajaxurl ="";

        if(noteid == "add" ){

              console.log("here");

                ajaxurl = '{{URL::to("/addsocialworkernotes")}}';

          }else{

            console.log("not here");

             ajaxurl = '{{URL::to("/updatesocialworkernotes")}}/'+noteid;

          }

     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

              if(noteid == "add" ){

                                  $(".odd").remove();

                   var link = '<tr id="psychiatrist_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0]['servicex'].name + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';

                link += '<td><button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';
                

                    $('#psychiatrist-list').append(link);

               }else{

                          var link = '<td id="psychiatristService_'+data[0].id+'">'+data[0]['servicex'].name+'</td>';

                                   $('#psychiatristService_'+data[0].id).replaceWith(link);

                        

                                var depart = '<td id="psychiatristNote_'+data[0].id+'">'+data[0].notes+'</td>';

                                  $('#psychiatristNote_'+data[0].id).replaceWith(depart);


                }
              

                $('#AddPsychiatristFormData').trigger("reset");
                $('#AddPsychiatristNotesModal').modal('hide')
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });

});


$("#btn-save-dentalServices").click(function (e) {


 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

     var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;


 var formData = {
   
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            note_by: $('#note_by').val(),
            tooth_no: $('#tooth_no').val(),
            diagnose: $('#diagnosis').val(),
            service_rendered: $('#service_rendered').val(),
            notes: $('#remarks').val(),
            role_type: 'Dentist',
            service_id: 3

        };


        var type = "POST";
        var id = $('#id').val();

        var ajaxurl = "";
                var noteid = $("#noteId").val();


        
        if(noteid == "add" ){

              console.log("here");

                ajaxurl = '{{URL::to("/addsocialworkernotes")}}';

          }else{


               ajaxurl = '{{URL::to("/updateDentalNotes")}}/'+noteid;

          }


     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

                              $(".odd").remove();

                  console.log(data);

                  if(noteid == "add"){
                   var link = '<tr id="dental_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0].diagnose + '</td><td>' + data[0].tooth_no + '</td><td>' + data[0].service_rendered +'</td><td>'+ data[0]['userx'].lname +', '+data[0]['userx'].fname+'</td><td>'+data[0].notes+'</td>';
                  
                link += '<td><button id="addDentalNotes" name="addDentalNotes" style="font-size: 8px;" class="btn btn-info addDentalNotes" value="'+data[0].id+'"><i class="fas fa-edit"></i></button><</td>';
                

                    $('#dental-list').append(link);
                }else{

                            var link = '<td id="dentalDiagnose_'+data.id+'">'+data.diagnose+'</td>';

                                   $('#dentalDiagnose_'+data.id).replaceWith(link);

                      
                                var dentalTooth = '<td id="dentalTooth_'+data.id+'">'+data.tooth_no+'</td>';

                                  $('#dentalTooth_'+data.id).replaceWith(dentalTooth);

                                  var dentalServiceRendered_ = '<td id="dentalServiceRendered_'+data.id+'">'+data.service_rendered+'</td>';

                                  $('#dentalServiceRendered_'+data.id).replaceWith(dentalServiceRendered_);

                                  var dentalRemarks_ = '<td id="dentalRemarks_'+data.id+'">'+data.notes+'</td>';

                                  $('#dentalRemarks_'+data.id).replaceWith(dentalRemarks_);
                }

        },
           error: function (data) {
                console.log('Error:', data);
            }

        });


              $('#AddDentalFormData').trigger("reset");
              $('#AddDentalNotesModal').modal('hide');

});






$("#btn-save-doctornotes").click(function (e) {



 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });


     var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;

      e.preventDefault();
         var formData = {
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: $('#doctorList').val(),
            note_by: $('#note_by').val(),
            notes: $('#notes').val(),
            role_type: "doctor"
        };


        var type = "POST";

        var noteid = $("#noteId").val();

       var ajaxurl ="";

        if(noteid == "add" ){

              console.log("here");

                ajaxurl = '{{URL::to("/addsocialworkernotes")}}';

          }else{

            console.log("not here");

             ajaxurl = '{{URL::to("/updatesocialworkernotes")}}/'+noteid;

          }


     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
              $(".odd").remove();


                  if(noteid == "add" ){

                                      $(".odd").remove();

                   var link = '<tr id="doctor_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0]['servicex'].name + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td><button class="btn btn-info addDoctortNotes"  id="addDoctortNote" name="addDoctortNote" style="font-size: 8px;" value="'+data[0].id+'"><i class="fas fa-edit"></i></button></td>';

                

                    $('#doctor-list').append(link);
              }else{

                   var link = '<td id="doctorService_'+data[0].id+'">'+data[0]['servicex'].name+'</td>';

                                   $('#doctorService_'+data[0].id).replaceWith(link);

                        

                                var depart = '<td id="doctorNote_'+data[0].id+'">'+data[0].notes+'</td>';

                                  $('#doctorNote_'+data[0].id).replaceWith(depart);


            }
               
                $('#AddDoctorFormData').trigger("reset");
                $('#AddDoctorNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });
  

});

$("#btn-save").click(function (e) {

//$('body').on('click', '#btn-save', function () {
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

  
  if($("#refAt").val() == "" || $("#reason").val() == "" || $("#refby").val() == "" || $("#ref_recom").val() == "" || $("#contactPer").val() == ""){

        console.log("sulod");

  }else{
            e.preventDefault();
        
         var formData = {
            patient_id: $('#patient_id').val(),
            ref_date:  $('#refDate').val(),
            ref_at: $('#refAt').val(),
            ref_reason:  $('#reason').val(),
            ref_by:  $('#refby').val(),
            recommen:  $('#ref_recom').val(),
            contact_person:  $('#contactPer').val(),
            ref_back_date:  $('#refDateback').val(),
            ref_back_by:  $('#refbyback').val(),
            ref_slip_return:  $('#returnDate').val(),

        };

        console.log(formData);
       var state = $('#btn-save').val();

       var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/refers")}}';
        if (state == "update") {
            type = "PUT";
            ajaxurl = '{{URL::to("/refers")}}'+ '/' + id;
            console.log(ajaxurl);
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

              if (state == "add") {

              $(".odd").remove();

                var link = '<tr id="refer' + data.id + '"><td>' + data.ref_date + '</td><td id="refer_at_'+data.id+'">' + data.ref_at + '</td><td id="refer_reason_'+data.id+'">' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info edit-refer-modal" value="' + data.id + '">Edit</button>';
                link += '<button class="btn btn-secondary accept_patient_referal" id="btn-accept" name ="btn-accept" value="' + data.id + '">Accept</button>';
                 link += '<button class="btn btn-light print-link" id="btn-print" name ="btn-print" value="' + data.id + '">Print</button>';
                
                
                    $('#refer-list tr:last').after(link);

                } else {


                         var link = '<td id="refer_at_'+data.id+'">'+data.ref_at+'</td>';

                                   $('#refer_at_'+data.id).replaceWith(link);

                        

                                var depart = '<td id="refer_reason_'+data.id+'">'+data.ref_reason+'</td>';

                                  $('#refer_reason_'+data.id).replaceWith(depart);


                }
    
                $('#modalFormData').trigger("reset");
                $('#linkEditorModal').modal('hide');


        },
           error: function (data) {
                console.log('Error:', data);
            }

        });


      }

 });



$('body').on('click', '.accept_patient_referal', function () {


           var result = confirm('Your are about to accept this referal. Would you like to continue?');
    
            if(result = true){

              var d = new Date();

              var month = d.getMonth()+1;
              var day = d.getDate();

              var output = (month<10 ? '0' : '') + month + '/' +
                            (day<10 ? '0' : '') + day + '/' +
                             d.getFullYear();

                var refer_id = $(this).val();


              $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

              var formData = {

                    ref_slip_return:  output,
                    accepted_by: $('#user_accepted').val(),

              };



            $.ajax({
            type: "PUT",
            url: '{{URL::to("/refers")}}'+ '/' + refer_id,
            data: formData,
            dataType: 'json',
            success: function (data) {
                  var link = '<tr id="refer' + data.id + '"><td>' + data.ref_date + '</td><td>' + data.ref_at + '</td><td>' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info view-link" value="' + data.id + '">View</button>';
                link += '<button class="btn btn-danger print-link" id="btn-print" name ="btn-print" value="' + data.id +'">Print</button></td>';
               
                    $("#refer" + refer_id).replaceWith(link);

                    alert("Refer Accepted");
            },
           error: function (data) {
                console.log('Error:', data);
            }
          });
        
        }
});

$('body').on('click', '.view-refer-patient-modal', function () {

          var view_id = $(this).val();

           $.get('{{URL::to("/refers")}}' + '/' + view_id, function (data) {

            console.log(data);

            $('#id').val(data[0].id);
            $('#refDate').val(data[0].ref_date);
            $('#reason2').val(data[0].ref_reason);
            $('#refAt2').val(data[0].ref_at);
            $('#refby22').val(data[0].users.fname+' '+data[0].users.lname);
            $('#refby2').val(data[0].ref_by);
            $('#contact2').val(data[0].contact_person);
            $('#ref_recom2').val(data[0].recommen);
            $('#refDateback2').val(data[0].ref_back_date);
            $('#refbyback2').val(data[0].ref_back_by);
            $('#returnDate').val(data[0].ref_slip_return);
            $('#accepted_by2').val(data[0].accepted_by.fname+' '+data[0].accepted_by.lname);

            $('#viewModal').modal('show');
            
        })


});

$('body').on('click', '.edit-refer-modal', function () {
        var refer_id = $(this).val();

        $.get('{{URL::to("/refers")}}' + '/' + refer_id, function (data) {

            $('#id').val(data[0].id);
            $('#refDate').val(data[0].ref_date);
            $('#reason').val(data[0].ref_reason);
            $('#refAt').val(data[0].ref_at);
            $('#refby2').val(data[0].users.fname+' '+data[0].users.lname);
            $('#refby').val(data[0].ref_by);
            $('#contactPer').val(data[0].contact_person);
            $('#ref_recom').val(data[0].recommen);
            $('#refDateback').val(data[0].ref_back_date);
            $('#refbyback').val(data[0].ref_back_by);
            $('#returnDate').val(data[0].ref_slip_return);
            $('#btn-save').val("update");
            $('#linkEditorModal').modal('show');
            
        })
});





   })


   </script>
 @endsection