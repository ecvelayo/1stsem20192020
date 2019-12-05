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

      @if($pid)
        @foreach($pat as $pats)
          @if(in_array($pats->department_id, $user_dept))
            @foreach($transfers as $trans)
              @if($trans->status == "")
            <div class="row">
              <div class="col-md-4" style="margin-left: 15px;">
                <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-warning"><b>For Transfer</b></span></p>
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                        @foreach($transfers as $trans)
                          <p style="font-size: 8px"><h6><b>Transfer Remarks: </b></h6><span style="font-size: 15px">{{$trans->remarks}}</span></p>
                        @endforeach
                          </div>
                        </div>
                      </div>
                  </fieldset>  
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-3" style="margin-top: 10px">
                <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:50px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
              </div>
            </div>

        @elseif(Auth::user()->department == $pats->department_id)
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
        </ol>
              @endif
            @endforeach

          @include('flash::message')
        <!-- Icon Cards-->

<div class="row" style="margin-left: 0px;">
           <div style="">
            <div class="col-md-12" style="margin-right: 0px;">
             <ul class="sidebar navbar-nav" style="background-color:transparent;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-radius: 5rem">
                <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px;border-radius: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Information</span></h6></a>
                </li>
                @if($pats->department_id != 1)                
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Refer</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Sessions</span></h6></a>
                </li>
                @endif
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>History</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="false" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Intake</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>


                @if($pats->department_id == 1)
                  <li class="nav-item" id="v-pills-patientnote-tab" data-toggle="pill" href="#v-pills-patientnote" role="tab" aria-controls="v-pills-patientnote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-patientnote-tab" data-toggle="pill" href="#v-pills-patientnote" role="tab" aria-controls="v-pills-note" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Patients Notes</span></h6></a>
                </li>
                @else
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Doctor's Progress Notes</span></h6></a>
                </li>
                @endif
                <li class="nav-item" id="v-pills-checklist-tab" data-toggle="pill" href="#v-pills-checklist" role="tab" aria-controls="v-pills-checklist" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-checklist-tab" data-toggle="pill" href="#v-pills-checklist" role="tab" aria-controls="v-pills-checklist" aria-selected="false" style="color:white;margin-bottom: 10px;height: 50px;text-align: center;border-radius: 5px"><h6>Checklist</h6></a>
                </li>
              </div>
            </ul>
            </div>
          </div>
            <div class="col-md-9" style="margin-top: 10px" style="background-color: #e9ecef;">
              <div class="tab-content" id="v-pills-tabContent" style="background-color: #e9ecef;">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark"> Personal Information</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-3">
                          <p style="font-size: 8px"><h6><b>Name:</b></h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                         </div>
                       <div class="col-md-3">
                          <p style="font-size: 8px"><h6><b>Date of Birth</b>:</h6> {{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</p>
                       </div>
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Address:</b></h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-3">
                       <p style="font-size: 8px"><h6><b>Marital Status:</b></h6> {{$pats->cstatus->name}}</p>
                      </div>
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Age:</b></h6> {{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                      </div> 
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Birth Order:</b></h6> {{NumConvert::numberOrdinal($pats->birthorder)}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6><b>Contact Number:</b></h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6><b>Nationality:</b></h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-3" style=""> 
                     <p style="font-size: 8px"><h6><b>Religion:</b></h6> {{$pats->religion}}</p>
                  </div>
                 @endif
                @endif
                  </div>
                </fieldset>
                 <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px;;background-color: white;">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Patient Type:</b></h6> {{$pats->type->case_name}}</p>
                      </div>
                      @if($pats->jail != NULL)
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>City Jail:</b></h6> {{$pats->jails->name}}</p>
                      </div>
                      @endif
                      @if($pats->caseno != NULL)
                       <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Case Number:</b></h6> {{$pats->caseno}}</p>
                      </div>
                      @endif
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Department:</b></h6> {{$pats->departments->department_name}} Department</p>
                       </div>
                       <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Date Admitted:</b></h6> {{\Carbon\Carbon::parse($pats->date_admitted)->format('M-j-Y')}}</p>
                       </div>
                       @if($pats->case != "")
                        <div class="col-md-2">
                        <p style="font-size: 8px"><h6><b>Case Type:</b></h6> {{$pats->case}}</p>
                       </div>
                       @endif
                       @if($pats->submission != "")
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Submission Type:</b></h6> {{$pats->submission}}</p>
                       </div>
                       @endif
                        <div class="col-md-10">
          
                       </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Patient History</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date</th>
                               <th>Performed By</th>
                               <th>Type</th>
                               <th>From Department</th>
                               <th>To Department</th>
                               <th>Remarks</th>
                            </tr>
                            </thead>
                          <tbody>
                            @foreach($history as $hist)
                            <tr>
                              <td>{{$hist->date}}</td>
                              <td>{{$hist->userss->fname}} {{$hist->userss->lname}}</td>
                              <td>{{$hist->type}}</td>
                              @if($hist->dep)
                              <td>{{$hist->dep->department_name}} Department</td>
                              @else
                              <td></td>
                              @endif  
                              <td>{{$hist->deps->department_name}} Department</td>
                              <td>{{$hist->remarks}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>

                <div class="tab-pane fade" id="v-pills-doctornote" role="tabpanel" aria-labelledby="v-pills-doctornote-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes </legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                           <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                           @if(Auth::user()->user_role->name == 'Doctor' || Auth::user()->user_role->name == 'Superadmin')
                          <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><button class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
                          @endif
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead> 
                             <tr>
                               <th>Date/Time</th>
                               <th>Notes</th>
                            </tr>
                            </thead>
                          <tbody>
                          @foreach($notes as $note)
                            <tr>
                              <td>{{$note->date_time}}</td>
                              <td>{{$note->notes}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>


              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              
                      <button id="add-patient-refer" name="add-patient-refer" class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">Refer Patient</button>
                        <br>
                        <br>
                      

                        <div class="card-body" style="margin-left: 10px">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Refer At</th>
                                    <th>Reason of Referal</th>
                                    <th>Refered by</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="links-list" name="links-list">
                                    @foreach ($refers as $refer)
                                    <tr id="refer{{$refer->id}}">
                                    <td>{{$refer->ref_date}}</td>
                                    <td>{{$refer->ref_at}}</td>
                                    <td>{{$refer->ref_reason}}</td>
                                    <td>{{$refer->ref_by}}</td>
                              <td>
                                @if($refer->accepted_by)
                                <button class="btn btn-info view-refer-patient-modal" value="{{$refer->id}}">View
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-print" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>

                                @else
                                  <button class="btn btn-info edit-refer-modal" value="{{$refer->id}}">Edit
                                  </button>
                                  <button class="btn btn-secondary accept_patient_referal" id="btn-accept" name ="btn-accept" value="{{$refer->id}}">Accept
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-ptint" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>
                                @endif 
                              </td>
                          </tr>
                          @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                 </div>

                               <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                 <!-- <fieldset style="margin-bottom: 30px;margin-left: 0px;">-->
              
              

                 <!--<button id="btn-visit" name="btn-visit" class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">Patient Visit</button>
                    <button id="btn-inactive" name="btn-inactive" class="btn btn-info btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 40px">Inactive</button>-->

                    <div class="dropdown">
                          <button class="btn btn-dark dropdown-toggle"  style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu menu_btn" aria-labelledby="dropdownMenuButton">
                          @if($pats->inactive != 1)
                            <a class="dropdown-item btn-visit" id="a-visit" name="a-visit" href="#"><button id="btn-visit" name="btn-visit" class="btn">Patient Visit</button></a>
                          @endif
                            <a class="dropdown-item inactive_btn"  id="a-inactive" name="a-inactive" href="#"><button id="btn-inactive" name="btn-inactive" class="btn" value="{{$pats->inactive}}">
                             @if($pats->inactive != 1)
                             Inactive
                             @else
                             Active
                             @endif
                            </button></a>
                          </div>
                      </div>
                        <br>

                        <div class="card-body" style="margin-left: 10px;margin-top: 20px">
                         <div class="table-responsive">
                              <table class="table table-bordered" id="patientTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Event Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                               <tbody id="visit-list" name="visit-list">
                                    @foreach ($visits as $pat_visit)
                                  <tr id="visit{{$pat_visit->id}}">
                                    <td>{{$pat_visit->date}}</td>
                                    <td>@if($pat_visit->events)
                                      {{$pat_visit->events->title}}
                                        @else
                                        Patient Visit
                                      @endif</td>
                                    <td>@if($pat_visit->status == 1)
                                    Attended
                                    @else
                                    Not Attended
                                    @endif</td>
                                    <td><input type="hidden" class="visit_event_date_{{$pat_visit->id}}" id="visit_event_date" name="visit_event_date" value="{{$pat_visit->date}}">
                                      @if($pat_visit->status == 1 && $pat_visit->date == $today)
                                        <button class="btn btn-success btn-visit" value="edit" id="attend_btn"  name="attend_btn"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                        @else
                                         <button class="btn btn-info btn-visit-view" value="edit" id="btn-visit-view"  name="btn-visit-view"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                      @endif
                                    </td>
                         
                                  </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                         </div>     
                    </div>



       <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
            @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#intakeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
            @endif
          <div class="container" style="margin-top: 60px;margin-bottom: 30px">
              <p style="float: left;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
              <p style="float: right;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p><br><p style="text-align: center;font-size: 12px"><b>Republic of the Philippines<br> Department of Health</b><br>
              <b>DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br><b>TREATMENT & REHABILITATION CENTER - Cebu City</b><br><b>Outpatient and Aftercare Department</b><br>Jagobiao, Mandaue City, Cebu<br>
              <font size="1px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: <u>cebu_trc@yahoo.com.ph</u></font><br>
              </p>
            <center style="margin-bottom: 60px"><h5>INTAKE FORM</h5></center>
              <div class="row" style="margin-left:60px;font-size: 12px">
                <label><h6>Client's name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->fname}} {{$pats->lname}}</p></div>
                <label style="margin-left: 20px"><h6>Date:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{date('M-j-Y')}}</p></div>
              </div>
            <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Date of Birth:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->birthdate}}</p></div>
                <label><h6>Age:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p></div>
                <label style="margin-left: 0px"><h6>Marital Status:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->cstatus->name}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Home Address:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px;text-align: center"><p style="border-bottom: solid black 1px">{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
        @if($patos)
          @foreach($patos as $patss)
                <label><h6>Educational Attainment:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eduatain->name}}</p></div>
                <label><h6>Employment Status:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->estat->name}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name of Spouse:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->spouse}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Parents:</h6></label>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
                <label><h6>Father's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->father}}</p></div>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
               <label><h6>Mother's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->mother}}</p></div>
              </div>
              <div class="row">
                 <label style="margin-left: 75px;"><h6>Whom to notify in case of emergency:</h6></label>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->name}}</p></div>
                <label><h6>Relationship:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->relationship}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Phone No.(Home):</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->phone}}</p></div>
                <label><h6>Cellphone No.:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->cellphone}}</p></div>
                <label><h6>Email add:</h6></label>
                <div class="col-md-1"><p><u style="text-align: center;font-size: 10px">{{$patss->eperson->email}}</u></p></div>
              </div>
               <div class="row">
                <label style="margin-left: 75px;"><h6>Presenting Problems:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px">{{$patss->presenting_problems}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Impression:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px">{{$patss->impression}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px;margin-top: 40px;margin-bottom: 50px">
                <label><h6>Intake Officer Signature:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
                <label><h6>Date:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
              </div>
        @endforeach
      @elseif(!$patos)
                <label><h6>Educational Attainment:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Employment Status:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name of Spouse:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Parents:</h6></label>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
                <label><h6>Father's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
               <label><h6>Mother's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row">
                 <label style="margin-left: 75px;"><h6>Whom to notify in case of emergency:</h6></label>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Relationship:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Phone No.(Home):</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Cellphone No.:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Email add:</h6></label>
                <div class="col-md-1"><p><u style="text-align: center;font-size: 10px"></u></p></div>
              </div>
               <div class="row">
                <label style="margin-left: 75px;"><h6>Presenting Problems:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px"></p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Impression:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px;margin-top: 40px;margin-bottom: 50px">
                <label><h6>Intake Officer Signature:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
                <label><h6>Date:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
              </div>
      @endif
            </div>
          </fieldset>
      </div>
          <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
            <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
              <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#ddeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
                @endif
                    <div class="container" style="margin-top: 60px;margin-bottom: 30px">
                      <div class="container">
                        <div style="margin-top:30px">
                          <img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px" style="float:left;">
                          <p style="text-align:center;position:relative;"><b style="font-size: 25px">TREATMENT & REHABILITATION CENTER - CEBU</b><br><span style="font-size:20px">Drug Dependency Examination Report</span></p>
                        </div>
  
            <div class="row" style="margin-top: 50px;padding:20px">
              <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px;border-right: none">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                  <?php $count = 0 ?>
                  @foreach($history as $hist)
                    @if($hist->type == 'Enrolled')
                      @if($hist->deps->department_name == $pats->departments->department_name)
                      <?php $count++; ?>
                      @endif
                    @endif
                  @endforeach
                    <input type="checkbox" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ ($count != 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="new case"><b>Old Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ ($count == 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="old case"><b>New Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ ($pats->caseno != NULL)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="case"><b>With Court Case:</b>
                  @if($pats->caseno != NULL)
                    <b><u> {{$pats->caseno}}</u></b>
                  @else
                    ________________________________________
                  @endif
                    </label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline" style="font-size: 50px">
                    <input type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label>
                  </div>
                </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label>
                  </div>
                  </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }} disabled="true">
                    <label class="custom-control-label" for="others"><b>Others: ___________________________________</b></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px;border-top:none;border-right:none">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <b><p>Last name:</p></b>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->lname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;">
                    <b><p>Address:</p></b>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>First name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->fname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;border-bottom: solid gray 1px;">
                    <p>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                  </div>
                 </div>
                  <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Middle name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->mname}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Contact Number:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->contact}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Age:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Gender:</b></p>
                  </div>
                @if($pats->gender != NULL)
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->genders->name}}</p>
                @else
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                @endif
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birthdate:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthdate}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Civil Status:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->cstatus->name}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birth Order:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{NumConvert::numberOrdinal($pats->birthorder)}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Nationality:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p>{{$pats->nationality}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Religion:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p>{{$pats->religion}}</p>
                  </div>
                 </div>
                </div> 
              </div>
              <div class="row" style="padding:20px">
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Referred by:</b></p>
                  </div>
                  <div class="col-md-9" style="border-right: none">
                    <p></p>
                  </div>
                </div>
              @if($patis != '[]')
                @foreach($patis as $patin)
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b> {{$patin->informants->name}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b> {{$patin->informants->address}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b> {{$patin->informants->contact}}</div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->drugs_abused}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->chief_complaint}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_present_illness}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_drug_abuse}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->famper_history}}</div>
                   </div>
                  </div>
                </div>
                 @endforeach
                @elseif($patis == '[]')
                    <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b></div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
    </fieldset>
  </div>
  <div class="tab-pane fade" id="v-pills-checklist" role="tabpanel" aria-labelledby="v-pills-checklist-tab">
      <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
          <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Checklist</legend>
            <div class="container" style="margin-left: 0px">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive scrollAble2" id="table1">
                    <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
          @foreach($checklist as $list)
              @if($pats->status == 'Enrolled')
                @if($list->parent == 0 || $list->has_sublist == 1)
                    <?php $current = $list->id; ?>
                        <thead style="width: 200px">
                          <tr>
                            <th  style="width: 200px">{{$list->name}}</th>
                            <th style="text-align: center;width:200px">Status</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                    @else
                    <?php $current = 0; ?>
                    @endif
                    @if($list->parent == $current)
                    <tbody>
                          <td style="width: 200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                          @endif
                        @endforeach
                          <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">View</button><button class="btn btn-primary" data-toggle="modal" data-checklistid="{{$list->id}}" data-checklistname="{{$list->name}}" data-patientid="{{$pats->id}}" data-departmentid="{{$pats->department_id}}" data-target="#uploadList">Upload</button></td>
                    </tbody>
                @elseif($list->has_sublist == 0 && $list->parent != 0)
                    </tbody>
                          <td style="width:200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id && $lists->department_id == $pats->department_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                          @endif
                       @endforeach
                         <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">View</button><button class="btn btn-primary" data-toggle="modal" data-checklistid="{{$list->id}}" data-checklistname="{{$list->name}}" data-patientid="{{$pats->id}}" data-departmentid="{{$pats->department_id}}" data-target="#uploadList">Upload</button></td>
                    </tbody>
                 @endif
              @else
                   @if($list->parent == 0 || $list->has_sublist == 1)
                    <?php $current = $list->id; ?>
                        <thead style="width: 200px">
                          <tr>
                            <th  style="width: 200px">{{$list->name}}</th>
                            <th style="text-align: center;width:200px">Status</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                    @else
                    <?php $current = 0; ?>
                    @endif
                    @if($list->parent == $current)
                    <tbody>
                          <td style="width: 200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                            <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">Views</button></td>
                          @endif
                        @endforeach
                    </tbody>
                   @elseif($list->has_sublist == 0 && $list->parent != 0)
                    </tbody>
                          <td style="width:200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id && $lists->department_id == $pats->department_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                          @endif
                        @endforeach
                         <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">View</button></td>
                    </tbody>
                    @endif
                  @endif
                @endforeach
                      </table>
                      </div>
                      <div class="table-responsive scrollAble2" id="table2" style="display: none">
                      <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                        <h1 id="title"></h1>
                         <thead style="width: 200px">
                          <tr>
                            <th style="text-align: center;width:200px">Path</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                         </tbody>

                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
                 </div> 
          </fieldset>
      </div>
   

        @include('refer.patientnote')
        </div>
        @include('refer.tabform')
          @endif
        @endforeach
      @elseif($pid == '0')
        @foreach($pat as $pats) 
          @if(in_array($pats->department_id, $user_dept))
        @if($pats->status == 'Enrolled')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px;margin-top: 10px">
            <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-primary"><b>Enrolled</b></span></p>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-4" style="margin-top: 10px">
    
                <button class="btn btn-success" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientGraduate" style="margin-left:10px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" data-toggle="modal" data-patientdep="{{$pats->department_id}}" data-patientid="{{$pats->id}}" data-target="#patientDismiss" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
    
          </div>
         </div>
            @elseif($pats->status == 'For Graduate')
        <div class="row">
           <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-warning"><b>For Graduation</b></span></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
            <ol class="breadcrumb" style="height: 100px;font-size:40px;text-align: center;">
              <li class="breadcrumb-item active" style="margin-left: 60px;margin-top: 20px"><span><h3>---Pending---<h3></span></li>
            </ol>
          </div>
         </div>
         @elseif($pats->status == 'Graduated')
        <div class="row">
         <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-green"><b>Graduated</b></span></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
           
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
            
          </div>
         </div>
          @elseif($pats->status == 'Dismissed')
        <div class="row">
         <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-danger"><b>Dismissed</b></span></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
        
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{Auth::user()->department}}" data-toggle="modal" data-target="#patientReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
        
          </div>
         </div>
         @endif


          @include('flash::message')

          <!--Tabs-->
          <div class="row" style="margin-left: 0px">
          <div>
          <div class="col-md-12">
              <ul class="sidebar navbar-nav" style="background-color:transparent;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-radius: 5rem">
                <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px;border-radius: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Information</span></h6></a>
                </li>
                @if($pats->department_id != 1)                
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Refer</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Sessions</span></h6></a>
                </li>
                @endif
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>History</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="false" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Intake</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>


                @if($pats->department_id == 1)
                  <li class="nav-item" id="v-pills-patientnote-tab" data-toggle="pill" href="#v-pills-patientnote" role="tab" aria-controls="v-pills-patientnote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-patientnote-tab" data-toggle="pill" href="#v-pills-patientnote" role="tab" aria-controls="v-pills-note" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Patients Notes</span></h6></a>
                </li>
                @else
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Doctor's Progress Notes</span></h6></a>
                </li>
                @endif
                <li class="nav-item" id="v-pills-checklist-tab" data-toggle="pill" href="#v-pills-checklist" role="tab" aria-controls="v-pills-checklist" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-checklist-tab" data-toggle="pill" href="#v-pills-checklist" role="tab" aria-controls="v-pills-checklist" aria-selected="false" style="color:white;margin-bottom: 10px;height: 50px;text-align: center;border-radius: 5px"><h6>Checklist</h6></a>
                </li>
              </div>
            </ul>
          </div>
        </div>
          <div class="col-md-9" style="margin-top: 10px" style="background-color: #e9ecef;">
              <div class="tab-content" id="v-pills-tabContent" style="background-color: #e9ecef;">
                   <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark"> Personal Information</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-3">
                          <p style="font-size: 8px"><h6><b>Name:</b></h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                         </div>
                       <div class="col-md-3">
                          <p style="font-size: 8px"><h6><b>Date of Birth</b>:</h6> {{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</p>
                       </div>
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Address:</b></h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-3">
                       <p style="font-size: 8px"><h6><b>Marital Status:</b></h6> {{$pats->cstatus->name}}</p>
                      </div>
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Age:</b></h6> {{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                      </div> 
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Birth Order:</b></h6> {{NumConvert::numberOrdinal($pats->birthorder)}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6><b>Contact Number:</b></h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6><b>Nationality:</b></h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-3" style=""> 
                     <p style="font-size: 8px"><h6><b>Religion:</b></h6> {{$pats->religion}}</p>
                  </div>
                 @endif
                @endif
                  </div>
                </fieldset>
                 <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px;;background-color: white;">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Patient Type:</b></h6> {{$pats->type->case_name}}</p>
                      </div>
                      @if($pats->jail != NULL)
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>City Jail:</b></h6> {{$pats->jails->name}}</p>
                      </div>
                      @endif
                      @if($pats->caseno != NULL)
                       <div class="col-md-3">
                         <p style="font-size: 8px"><h6><b>Case Number:</b></h6> {{$pats->caseno}}</p>
                      </div>
                      @endif
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Department:</b></h6> {{$pats->departments->department_name}} Department</p>
                       </div>
                       <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Date Admitted:</b></h6> {{\Carbon\Carbon::parse($pats->date_admitted)->format('M-j-Y')}}</p>
                       </div>
                       @if($pats->case != "")
                        <div class="col-md-2">
                        <p style="font-size: 8px"><h6><b>Case Type:</b></h6> {{$pats->case}}</p>
                       </div>
                       @endif
                       @if($pats->submission != "")
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6><b>Submission Type:</b></h6> {{$pats->submission}}</p>
                       </div>
                       @endif
                        <div class="col-md-10">
          
                       </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <!--Patient History-->
               <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Patient History</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date</th>
                               <th>Performed By</th>
                               <th>Type</th>
                               <th>From Department</th>
                               <th>To Department</th>
                               <th>Remarks</th>
                            </tr>
                            </thead>
                          <tbody>
                            @foreach($history as $hist)
                            <tr>
                              <td>{{$hist->date}}</td>
                              <td>{{$hist->userss->fname}} {{$hist->userss->lname}}</td>
                              <td>{{$hist->type}}</td>
                              @if($hist->dep)
                              <td>{{$hist->dep->department_name}} Department</td>
                              @else
                              <td></td>
                              @endif  
                              <td>{{$hist->deps->department_name}} Department</td>
                              <td>{{$hist->remarks}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
          <!--Doctor's Note Tab-->
               <div class="tab-pane fade" id="v-pills-doctornote" role="tabpanel" aria-labelledby="v-pills-doctornote-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes </legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                           <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                           @if(Auth::user()->user_role->name == 'Doctor' || Auth::user()->user_role->name == 'Superadmin')
                          <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><button class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
                          @endif
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead> 
                             <tr>
                               <th>Date/Time</th>
                               <th>Notes</th>
                            </tr>
                            </thead>
                          <tbody>
                          @foreach($notes as $note)
                            <tr>
                              <td>{{$note->date_time}}</td>
                              <td>{{$note->notes}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
      <!--Intake Tab-->
        <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
            @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#intakeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
            @endif
          <div class="container" style="margin-top: 60px;margin-bottom: 30px">
            <div class="container">
              <p style="float: left;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
              <p style="float: right;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p><br><p style="text-align: center;font-size: 12px"><b>Republic of the Philippines<br> Department of Health</b><br>
              <b>DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br><b>TREATMENT & REHABILITATION CENTER - Cebu City</b><br><b>Outpatient and Aftercare Department</b><br>Jagobiao, Mandaue City, Cebu<br>
              <font size="1px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: <u>cebu_trc@yahoo.com.ph</u></font><br>
              </p>
            <center style="margin-bottom: 60px"><h5>INTAKE FORM</h5></center>
              <div class="row" style="margin-left:60px;font-size: 12px">
                <label><h6>Client's name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->fname}} {{$pats->lname}}</p></div>
                <label style="margin-left: 20px"><h6>Date:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{date('M-j-Y')}}</p></div>
              </div>
            <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Date of Birth:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->birthdate}}</p></div>
                <label><h6>Age:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p></div>
                <label style="margin-left: 0px"><h6>Marital Status:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$pats->cstatus->name}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Home Address:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px;text-align: center"><p style="border-bottom: solid black 1px">{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
              @if($patos)
                @foreach($patos as $patss)
                <label><h6>Educational Attainment:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eduatain->name}}</p></div>
                <label><h6>Employment Status:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->estat->name}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name of Spouse:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->spouse}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Parents:</h6></label>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
                <label><h6>Father's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->father}}</p></div>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
               <label><h6>Mother's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->mother}}</p></div>
              </div>
              <div class="row">
                 <label style="margin-left: 75px;"><h6>Whom to notify in case of emergency:</h6></label>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->name}}</p></div>
                <label><h6>Relationship:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->relationship}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Phone No.(Home):</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->phone}}</p></div>
                <label><h6>Cellphone No.:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center">{{$patss->eperson->cellphone}}</p></div>
                <label><h6>Email add:</h6></label>
                <div class="col-md-1"><p><u style="text-align: center;font-size: 10px">{{$patss->eperson->email}}</u></p></div>
              </div>
               <div class="row">
                <label style="margin-left: 75px;"><h6>Presenting Problems:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px">{{$patss->presenting_problems}}</p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Impression:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px">{{$patss->impression}}</p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px;margin-top: 40px;margin-bottom: 50px">
                <label><h6>Intake Officer Signature:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
                <label><h6>Date:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
              </div>
                @endforeach
              @elseif(!$patos)
                <label><h6>Educational Attainment:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Employment Status:</h6></label>
                <div class="col-md-3"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name of Spouse:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Parents:</h6></label>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
                <label><h6>Father's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 125px;font-size: 12px">
               <label><h6>Mother's Name:</h6></label>
                <div class="col-md-5"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row">
                 <label style="margin-left: 75px;"><h6>Whom to notify in case of emergency:</h6></label>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Name:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Relationship:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px">
                <label><h6>Phone No.(Home):</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Cellphone No.:</h6></label>
                <div class="col-md-2"><p style="border-bottom: solid black 1px;text-align: center"></p></div>
                <label><h6>Email add:</h6></label>
                <div class="col-md-1"><p><u style="text-align: center;font-size: 10px"></u></p></div>
              </div>
               <div class="row">
                <label style="margin-left: 75px;"><h6>Presenting Problems:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px"></p></div>
              </div>
              <div class="row">
                <label style="margin-left: 75px;"><h6>Impression:</h6></label>
                <div class="col-md-10" style="margin-left: 60px;font-size: 12px"><p style="border-bottom: solid black 1px"></p></div>
              </div>
              <div class="row" style="margin-left: 60px;font-size: 12px;margin-top: 40px;margin-bottom: 50px">
                <label><h6>Intake Officer Signature:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
                <label><h6>Date:</h6></label>
                <div class="col-md-4"><p style="border-bottom: solid black 1px;text-align: center">wasd</p></div>
              </div>
              @endif
            </div>
            </div>
          </fieldset>
        </div>
      <!--Sessions-->
                       <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-profile-tab">


                    <div class="dropdown">
                          <button class="btn btn-dark dropdown-toggle"  style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu menu_btn" aria-labelledby="dropdownMenuButton">
                          @if($pats->inactive != 1)
                            <a class="dropdown-item btn-visit" id="a-visit" name="a-visit" href="#"><button id="btn-visit" name="btn-visit" class="btn">Patient Visit</button></a>
                          @endif
                            <a class="dropdown-item inactive_btn"  id="a-inactive" name="a-inactive" href="#"><button id="btn-inactive" name="btn-inactive" class="btn" value="{{$pats->inactive}}">
                             @if($pats->inactive != 1)
                             Inactive
                             @else
                             Active
                             @endif
                            </button></a>
                          </div>
                      </div>
                        <br>

                        <div class="card-body" style="margin-left: 10px;margin-top: 20px">
                         <div class="table-responsive">
                              <table class="table table-bordered" id="patientTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Event Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                               <tbody id="visit-list" name="visit-list">
                                    @foreach ($visits as $pat_visit)
                                  <tr id="visit{{$pat_visit->id}}">
                                    <td>{{$pat_visit->date}}</td>
                                    <td>@if($pat_visit->events)
                                      {{$pat_visit->events->title}}
                                        @else
                                        Patient Visit
                                      @endif</td>
                                    <td>@if($pat_visit->status == 1)
                                    Attended
                                    @else
                                    Not Attended
                                    @endif</td>
                                    <td><input type="hidden" class="visit_event_date_{{$pat_visit->id}}" id="visit_event_date" name="visit_event_date" value="{{$pat_visit->date}}">
                                      @if($pat_visit->status == 1 && $pat_visit->date == $today)
                                        <button class="btn btn-success btn-visit" value="edit" id="attend_btn"  name="attend_btn"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                        @else
                                         <button class="btn btn-info btn-visit-view" value="edit" id="btn-visit-view"  name="btn-visit-view"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                      @endif
                                    </td>
                         
                                  </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                         </div>     
                    </div>

      <!--Refer-->
             <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                      <button id="add-patient-refer" name="add-patient-refer" class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">Refer Patient</button>
                        <br>
                        <br>
                        <div class="card-body" style="margin-left: 10px">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Refer At</th>
                                    <th>Reason of Referal</th>
                                    <th>Refered by</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="links-list" name="links-list">
                                    @foreach ($refers as $refer)
                                    <tr id="refer{{$refer->id}}">
                                    <td>{{$refer->ref_date}}</td>
                                    <td>{{$refer->ref_at}}</td>
                                    <td>{{$refer->ref_reason}}</td>
                                    <td>{{$refer->ref_by}}</td>
                              <td>
                                @if($refer->accepted_by)
                                <button class="btn btn-info view-refer-patient-modal" value="{{$refer->id}}">View
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-print" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>

                                @else
                                  <button class="btn btn-info edit-refer-modal" value="{{$refer->id}}">Edit
                                  </button>
                                  <button class="btn btn-secondary accept_patient_referal" id="btn-accept" name ="btn-accept" value="{{$refer->id}}">Accept
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-ptint" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>
                                @endif 
                              </td>
                          </tr>
                          @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

      <!--DDE-->
        <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
            <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
              <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#ddeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
                @endif
                    <div class="container" style="margin-top: 60px;margin-bottom: 30px">
                      <div class="container">
                        <div style="margin-top:30px">
                          <img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px" style="float:left;">
                          <p style="text-align:center;position:relative;"><b style="font-size: 25px">TREATMENT & REHABILITATION CENTER - CEBU</b><br><span style="font-size:20px">Drug Dependency Examination Report</span></p>
                        </div>
  
            <div class="row" style="margin-top: 50px;padding:20px">
              <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px;border-right: none">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                  <?php $count = 0 ?>
                  @foreach($history as $hist)
                    @if($hist->type == 'Enrolled')
                      @if($hist->deps->department_name == $pats->departments->department_name)
                      <?php $count++; ?>
                      @endif
                    @endif
                  @endforeach
                    <input type="checkbox" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ ($count != 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="new case"><b>Old Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ ($count == 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="old case"><b>New Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ ($pats->caseno != NULL)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="case"><b>With Court Case:</b>
                  @if($pats->caseno != NULL)
                    <b><u> {{$pats->caseno}}</u></b>
                  @else
                    ________________________________________
                  @endif
                    </label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline" style="font-size: 50px">
                    <input type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label>
                  </div>
                </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label>
                  </div>
                  </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }} disabled="true">
                    <label class="custom-control-label" for="others"><b>Others: ___________________________________</b></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px;border-top:none;border-right:none">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <b><p>Last name:</p></b>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->lname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;">
                    <b><p>Address:</p></b>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>First name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->fname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;border-bottom: solid gray 1px;">
                    <p>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                  </div>
                 </div>
                  <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Middle name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->mname}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Contact Number:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->contact}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Age:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Gender:</b></p>
                  </div>
                @if($pats->gender != NULL)
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->genders->name}}</p>
                @else
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                @endif
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birthdate:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthdate}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Civil Status:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->cstatus->name}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birth Order:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{NumConvert::numberOrdinal($pats->birthorder)}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Nationality:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p>{{$pats->nationality}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Religion:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p>{{$pats->religion}}</p>
                  </div>
                 </div>
                </div> 
              </div>
              <div class="row" style="padding:20px">
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Referred by:</b></p>
                  </div>
                  <div class="col-md-9" style="border-right: none">
                    <p></p>
                  </div>
                </div>
              @if($patis != '[]')
                @foreach($patis as $patin)
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b> {{$patin->informants->name}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b> {{$patin->informants->address}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b> {{$patin->informants->contact}}</div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->drugs_abused}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->chief_complaint}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_present_illness}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_drug_abuse}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->famper_history}}</div>
                   </div>
                  </div>
                </div>
                 @endforeach
                @elseif($patis == '[]')
                    <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b></div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b></div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9"></div>
                   </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
    </fieldset>
  </div>
  <!--Checklist-->
    <div class="tab-pane fade" id="v-pills-checklist" role="tabpanel" aria-labelledby="v-pills-checklist-tab">
      <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
          <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Checklist</legend>
            <div class="container" style="margin-left: 0px">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive scrollAble2" id="table1">
                    <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                @foreach($checklist as $list)
                  @if($pats->status == 'Enrolled')
                   @if($list->parent == 0 || $list->has_sublist == 1)
                    <?php $current = $list->id; ?>
                        <thead style="width: 200px">
                          <tr>
                            <th  style="width: 200px">{{$list->name}}</th>
                            <th style="text-align: center;width:200px">Status</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                    @else
                    <?php $current = 0; ?>
                    @endif
                    @if($list->parent == $current)
                    <tbody>
                          <td style="width: 200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                            <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">Views</button><button class="btn btn-primary" data-toggle="modal" data-checklistid="{{$list->id}}" data-checklistname="{{$list->name}}" data-patientid="{{$pats->id}}" data-departmentid="{{$pats->department_id}}" data-target="#uploadList">Upload</button></td>
                          @endif
                        @endforeach
                    </tbody>
                   @elseif($list->has_sublist == 0 && $list->parent != 0)
                    </tbody>
                          <td style="width:200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id && $lists->department_id == $pats->department_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                          @endif
                        @endforeach
                         <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">View</button><button class="btn btn-primary" data-toggle="modal" data-checklistid="{{$list->id}}" data-checklistname="{{$list->name}}" data-patientid="{{$pats->id}}" data-departmentid="{{$pats->department_id}}" data-target="#uploadList">Upload</button></td>
                    </tbody>
                    @endif
                  @else
                   @if($list->parent == 0 || $list->has_sublist == 1)
                    <?php $current = $list->id; ?>
                        <thead style="width: 200px">
                          <tr>
                            <th  style="width: 200px">{{$list->name}}</th>
                            <th style="text-align: center;width:200px">Status</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                    @else
                    <?php $current = 0; ?>
                    @endif
                    @if($list->parent == $current)
                    <tbody>
                          <td style="width: 200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                            <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">Views</button></td>
                          @endif
                        @endforeach
                    </tbody>
                   @elseif($list->has_sublist == 0 && $list->parent != 0)
                    </tbody>
                          <td style="width:200px">{{$list->name}}</td>
                        @foreach($checklists as $lists)
                          @if($list->id == $lists->checklist_id && $lists->department_id == $pats->department_id)
                            @if($lists->has_files == 1)
                              <td style="width: 200px;"><i class="fa fa-check-circle" style="color:#28a745;font-size: 50px;margin-left: 100px"></i></td>
                            @else
                              <td style="width: 200px;"><i class="fa fa-times-circle" style="color:red;font-size: 50px;margin-left: 100px"></i></td>
                            @endif
                          @endif
                        @endforeach
                         <td style="width: 200px;"><button class="details btn btn-success" data-patientid="{{$pats->id}}" data-checklistid="{{$list->id}}" data-depid="{{$pats->department_id}}" style="margin-right: 10px;margin-left: 50px">View</button></td>
                    </tbody>
                    @endif
                  @endif
                @endforeach
                      </table>
                      </div>
                      <div class="table-responsive scrollAble2" id="table2" style="display: none">
                      <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                        <h1 id="title"></h1>
                         <thead style="width: 200px">
                          <tr>
                            <th style="text-align: center;width:200px">Path</th>
                            <th style="text-align: center;width:200px">Action</th>
                          </tr>
                        </thead>
                         </tbody>

                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
                 </div> 
          </fieldset>
      </div>
  @include('refer.patientnote')        
  </div>
  @include('refer.tabform')
  </div>
    @elseif(in_array($pats->department_id, $user_dept))
    <h1>Patient Not Found/Transfered/Deleted</h1>
    @endif
    @endforeach
    @endif

<!--Dismiss modal-->
<div class="modal fade" id="patientDismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Specify a reason to dismiss</h5>
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
  
<!--Choose a form for re-enrolling-->
<div class="modal fade" id="reenrollForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Choose a form to be filled-up</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      <div style="margin-bottom: 50px">
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <p style="font-size: 10px;margin-top: 7px"><h6>Intake Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#intakeForms" data-patientid="{{$pats->id}}">Proceed</button>
              </div>
            </div>
        </div>
      </div>
      <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="modal-body">
                <p style="font-size: 10px;margin-top: 7px"><h6>Drug Dependency Form</h6></p>             
                <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#ddeForms" data-patientid="{{$pats->id}}">Proceed</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!--Intake Re-enroll Form-->
<div class="modal2 fade" id="intakeForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:1000px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{Auth::user()->user_department->department_name}} Department (Intake Form)</h5>
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
                  <input type="hidden" name="department" value="{{Auth::user()->user_department->id}}">
                  <input type="hidden" name="patdepartment" value="{{$pats->department_id}}">
                  <input type="hidden" name="patient_id" value="{{$pats->id}}">
                  <input type="hidden" name="patientadd" value="{{$pats->address_id}}">
                  @if($patos != NULL)
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
                  <label for="civils">{{$pats->civil_status}}</label>
                    <option value="{{$pats->civil_status}}" selected hidden>{{$pats->civil_status}}</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
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
                            <label for="eduattain">Educational Attainment</label>
                            <option value="{{$patss->educational_attainment}}" selected>{{$patss->educational_attainment}}</option>
                            <option value="Elementary">Elementary Graduate</option>
                            <option value="Highschool">High-school Graduate</option>
                            <option value="College">College Graduate</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            <label for="edstat">Employement Status</label>
                            <option value="{{$patss->employment_status}}" selected>{{$patss->employment_status}}</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
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
                            <label for="eduattain">Educational Attainment</label>
                            <option value="" disabled hidden selected></option>
                            <option value="Elementary">Elementary Graduate</option>
                            <option value="Highschool">High-school Graduate</option>
                            <option value="College">College Graduate</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" name="edstat">
                            <label for="edstat">Employement Status</label>
                            <option value="" disabled hidden selected></option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
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
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Enroll">
         </form>
      </div>
    </div>
  </div>
</div>

<!--DDE Form for Re-enrolling-->
<div class=" modal2 fade" id="ddeForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Drug Dependency Examination Report</h5>
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
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" required="required" name="mname" value="{{$pats->mname}}">
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
                  <input type="hidden" id="department" name="department" value="{{Auth::user()->department}}">
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
                  @if($pats->gender == 'M')
                    <option value="{{$pats->gender}}" selected>Male</option>
                  @elseif($pats->gender == 'F')
                    <option value="{{$pats->gender}}" selected>Female</option>
                  @else
                    <option value="Others" selected>Others</option>
                  @endif
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="Others">Others</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  <label for="civils">Civil Status</label>
                    <option value="{{$pats->civil_status}}" selected>{{$pats->civil_status}}</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
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
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname" value="{{$patin->informants->name}}">
                           <input type="hidden" name="patientinfor" value="{{$patin->informant_id}}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact" value="{{$patin->informants->contact}}">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd" value="{{$patin->informants->address}}">
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
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred" value="{{$patin->referred_by}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused" value="{{$patin->drugs_abused}}">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint" value="{{$patin->chief_complaint}}">
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
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness">{{$patin->h_present_illness}}</textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused">{{$patin->h_drug_abuse}}</textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background">{{$patin->famper_history}}</textarea>
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
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname">
                           <input type="hidden" name="patientinfor">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd">
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
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint">
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
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group" style="margin-left: 20px">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background"></textarea>
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

    $('.addNurseNotes').click(function () {

      console.log($(this).val());

       if($(this).val() != 'add'){

        var type = "GET";
        var id = $(this).val();
        var ajaxurl = '{{URL::to("/findNotes")}}/' + id;


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

                        $("#nurseList option[value=M]").addAttr('disabled');
                        $("#nurseList option[value=B]").addAttr('disabled');
                        $("#nurseList option[value=BS]").addAttr('disabled');

                }
              })
     }


        $('#NurseNotesFormData').trigger("reset");
        $('#NurseNotesModal').modal('show');
     

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


    $('.addDoctortNotes').click(function () {

       // console.log($(this).val());

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

                }
              })
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
                        $('#psychiatristList').val(service_id);

                }
              })
     }

          $('#AddPsychiatristFormData').trigger("reset");
          $('#AddPsychiatristNotesModal').modal('show');

       });
    

 $('.addDentalNotes').click(function () {

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
                        $('#socialList').val(service_id);

                }
              })
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

             // $('.reading_bbreakfast').addClass('has-error'); 

             //  $('.weight_kg').removeClass('has-error');  
             //  $('.bmi_record').removeClass('has-error');    
             //  $('.medication_record').removeClass('has-error'); 


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
    });

 $('#NurseNotesModal').on('hidden.bs.modal', function () {

  console.log("hide");

        $(this).find('form').trigger("reset");

            $('.medicalRecords').hide();
            $('.BMIRecords').hide();
            $('.BloodSugarRecords').hide();


  });


   $(".btn-visit-view").click(function(e){

   });

     $('.btn-visit').click(function(e){
     
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


                        //.prop('checked', true);

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
        var activate = $(this).val();

            $('#inactivemodalFormData').trigger("reset");
            $('#inactiveEditorModal').modal('show');
        


     
    });

  

$("#btn-save").click(function (e) {

  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });
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

              $(".odd").remove();

                var link = '<tr id="refer' + data.id + '"><td>' + data.ref_date + '</td><td>' + data.ref_at + '</td><td>' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info edit-refer-modal" value="' + data.id + '">Edit</button>';
                link += '<button class="btn btn-secondary accept_patient_referal" id="btn-accept" name ="btn-accept" value="' + data.id + '">Accept</button>';
                 link += '<button class="btn btn-light print-link" id="btn-ptint" name ="btn-print" value="' + data.id + '">Print</button>';
                
                if (state == "add") {
                    $('#links-list').append(link);
                } else {
                    $("#refer" + id).replaceWith(link);
                }
    
                $('#modalFormData').trigger("reset");
                $('#linkEditorModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });
      });

$("#btn_activate").click(function (e) {

          var curStat = $(this).val();

          var patient_id = $("#patient-id").val();

          console.log(curStat);

          var newStat;

          if(curStat == 1){

              newStat = 0;
          }else{

              newStat = 1;
          }

          alert(patient_id);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
               e.preventDefault();
              var formData = {

                    remarks:  $("#note").val(),
                    inactive: newStat,

              };


            $.ajax({
            type: "PUT",
            url: '{{URL::to("/activation")}}'+ '/' + patient_id,
            data: formData,
            dataType: 'json',
            success: function (data) {

                      $('#inactivemodalFormData').trigger("reset");
                      $('#inactiveEditorModal').modal('hide');

                          var link = '<div class="dropdown-menu menu_btn2" aria-labelledby="dropdownMenuButton">';
                       

                       if(curStat == 1){
                           link += ' <a class="dropdown-item visit_btn" id="a-visit" name="a-visit" href="#"><button id="btn-visit" name="btn-visit" class="btn">Patient Visit</button></a>';
                            link += '<a class="dropdown-item inactive_btn"  id="a-inactive" name="a-inactive" href="#"><button id="btn-inactive" name="btn-inactive" class="btn" value="{{$pats->inactive}}">Inactive</button></a>';


                        
                        }else{
                             link += '<a class="dropdown-item inactive_btn"  id="a-inactive" name="a-inactive" href="#"><button id="btn-inactive" name="btn-inactive" class="btn" value="{{$pats->inactive}}">Active</button></a>';

                        }

                       $('.menu_btn').replaceWith(link);


                 
            },
           error: function (data) {
                console.log('Error:', data);
            }
          });



});

$("#btn-save-socialworker").click(function (e) {
   

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
            progress_id: "sample",
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: $('#socialList').val(),
            note_by: $('#note_by').val(),
            notes: $('#socialworkerNote').val(),
            role_type: "socialworker"
        };


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addsocialworkernotes")}}';


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

                    var link = '<tr id="socialworker_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + service + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td></td>';
                

                    $('#socialworker-list').append(link);

               

                $('#AddSocialWorkerFormData').trigger("reset");
                $('#AddSocialWorkerNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });

});

$("#btn-save-nursenotes").click(function (e) {
   

 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });



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
        var ajaxurl = '{{URL::to("/addBMIrecords")}}/BMIRecords';


     $.ajax({
                type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

             
               

                $('#NurseNotesFormData').trigger("reset");
                $('#NurseNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

          

        });


        
      }

   }else if(selectVal == 'BS'){

     if( reading_bbreakfast == null  || reading_bbreakfast == "" || nursenote == null  || nursenote == ""){
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


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addBMIrecords")}}/BloodSugar';


     $.ajax({
                type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

             
               

                $('#NurseNotesFormData').trigger("reset");
                $('#NurseNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

          

        });



        
      }


   }else if(selectVal == 'M'){

        if( medication_record == null  || medication_record == "" || nursenote == null  || nursenote == ""){
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
        var ajaxurl = '{{URL::to("/addBMIrecords")}}/medicalRecords';


     $.ajax({
                type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

             
               

                $('#NurseNotesFormData').trigger("reset");
                $('#NurseNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

          

        });




        
      }


       
   }else{


    if($('.nursenote').val() == null || $('.nursenote').val() == ""){

          console.log("sulod");

    }else{

        var service_id = $('#nurseList').val();

      if(service_id == 0){

          service_id = " ";
      }


      e.preventDefault();
         var formData = {
            progress_id: "sample",
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: service_id,
            note_by: $('#note_by').val(),
            notes: $('#nursenote').val(),
            role_type: "nurse"
        };


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addsocialworkernotes")}}';


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

                  console.log(service);
                    var link = '<tr id="nurse_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + service + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td></td>';
                

                    $('#nurse-list').append(link);

               

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
            progress_id: "sample",
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: $('#psychiatristList').val(),
            note_by: $('#note_by').val(),
            notes: $('#notes2').val(),
            role_type: "psychiatrist"
        };


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addsocialworkernotes")}}';


     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {



                   var link = '<tr id="psychiatrist_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0]['servicex'].name + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td></td>';
                

                    $('#psychiatrist-list').append(link);
              

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
            remarks: $('#remarks').val()

        };


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addDentalNotes")}}';



     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {


                  console.log(data);

                   var link = '<tr id="dental_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0].diagnose + '</td><td>' + data[0].tooth_no + '</td><td>' + data[0].service_rendered +'</td><td>'+ data[0]['userxk'].lname +', '+data[0]['userxk'].fname+'</td><td>'+data[0].remarks+'</td>';
                link += '<td></td>';
                

                    $('#dental-list').append(link);

                $('#AddDentalFormData').trigger("reset");
                $('#AddDentalNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });

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
            progress_id: "sample",
            patient_id: $('#patient_id').val(),
            date_time: dateTime,
            service_id: $('#doctorList').val(),
            note_by: $('#note_by').val(),
            notes: $('#notes').val(),
            role_type: "doctor"
        };


        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/addsocialworkernotes")}}';


     $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {



                   var link = '<tr id="doctor_' + data[0].id + '"><td>' + data[0].date_time + '</td><td>' + data[0]['servicex'].name + '</td><td>' + data[0].notes + '</td><td>' + data[0]['userx'].lname +', '+ data[0]['userx'].fname + '</td>';
                link += '<td></td>';
                

                    $('#doctor-list').append(link);
        
               
                $('#AddDoctorFormData').trigger("reset");
                $('#AddDoctorNotesModal').modal('hide');
        },
           error: function (data) {
                console.log('Error:', data);
            }

        });

});
//Accept Referral REFERAL 
$('.accept_patient_referal').click(function (e) {

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
               e.preventDefault();
              var formData = {

                    ref_slip_return:  output,
                    accepted_by: $('#user_accepted').val(),

              };


            }

            $.ajax({
            type: "PUT",
            url: '{{URL::to("/refers")}}'+ '/' + refer_id,
            data: formData,
            dataType: 'json',
            success: function (data) {
                  var link = '<tr id="refer' + data.id + '"><td>' + data.ref_date + '</td><td>' + data.ref_at + '</td><td>' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info view-link" value="' + data.id + '">View</button>';
                link += '<button class="btn btn-light print-link" id="btn-print" name ="btn-print" value="' + data.id + '">Print</button></td>';
               
                    $("#refer" + refer_id).replaceWith(link);
            },
           error: function (data) {
                console.log('Error:', data);
            }
          });
        
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