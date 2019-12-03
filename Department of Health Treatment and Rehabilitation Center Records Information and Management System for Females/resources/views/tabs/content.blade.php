@if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
         <div class="row" style="margin-left: 20px;">
         @else
         <div class="row" style="margin-left: 150px;">
         @endif
          <div>
            <div class="col-md-4">
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
            <div style="width: 1000px">
            <div class="col-md-12" style="margin-top: 10px" style="background-color: #e9ecef;">
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
                <!--Patient history-->
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
              <!--Doctor's Progress Notes-->
                <div class="tab-pane fade" id="v-pills-doctornote" role="tabpanel" aria-labelledby="v-pills-doctornote-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes </legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                           <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                        @if($pats->status == 'Enrolled')
                          @if(Auth::user()->user_role->name == 'Doctor' || Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                          <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><button class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
                          @endif
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
      <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px;">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Patient Referral</legend>
                @if(Auth::user()->user_role->name == 'Social Worker' || Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                      <button id="add-patient-refer" name="add-patient-refer" class="btn btn-dark btn-block" style="height: 50px; width:200px;margin-top: 0px;margin-left: 750px">Refer Patient</button>
                  @endif
                        <br>
                        <br>
                        <div class="card-body" style="margin-left: 10px">
                          <div class="table-responsive">
                              <table class="table table-bordered referTable" id="referTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Refer At</th>
                                    <th>Reason of Referral</th>
                                    <th>Referred by</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="links-list" name="links-list">
                                @if($refers != '[]')
                                    @foreach ($refers as $refer)
                                    <tr id="refer{{$refer->id}}">
                                    <td>{{$refer->ref_date}}</td>
                                    <td>{{$refer->ref_at}}</td>
                                    <td>{{$refer->ref_reason}}</td>
                                    <td>{{$refer->users->fname}} {{$refer->users->lname}}</td>
                              <td>
                                @if($pats->status == 'Enrolled')
                                @if($refer->accepted_by)
                                <button class="btn btn-info view-refer-patient-modal" value="{{$refer->id}}">View
                                  </button>
                                  <a href="{{URL::to('pdfreferral/'.$pats->id.'/'.$refer->id)}}" target="_blank"><button class="btn btn-danger print-link" id="btn-print" name ="btn-print" value="{{$refer->id}}">Print
                                  </button></a>

                                @else
                                  <button class="btn btn-info edit-refer-modal" value="{{$refer->id}}">Edit
                                  </button>
                                  <button class="btn btn-secondary accept_patient_referal" id="btn-accept" name ="btn-accept" value="{{$refer->id}}">Accept
                                  </button>
                                  <a href="{{URL::to('pdfreferral/'.$pats->id.'/'.$refer->id)}}" target="_blank"><button class="btn btn-danger print-link" id="btn-ptint" name ="btn-print" value="{{$refer->id}}">Print
                                  </button></a>
                                @endif
                                @endif
                              </td>
                          </tr>
                          @endforeach
                        @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </fieldset>
                      </div>

      <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px;">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Sessions</legend>
            
                   <div class="dropdown">
                          <button class="btn btn-dark dropdown-toggle"  style="height: 50px; width:200px;margin-top: 0px;margin-left: 750px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu menu_btn" aria-labelledby="dropdownMenuButton">
                          @if(Auth::user()->user_role->name == 'Social Worker' || Auth::user()->user_role->name == 'Superadmin')  
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
                            @endif
                             <a class="dropdown-item pdf_btn"  id="a-inactive" name="a-inactive" href="{{URL::to('MonitoringTool/'.$pats->id)}}"  target="_blank" style="text-align: center">PDF<i class="fas fa-fw fa fa-file-pdf"></i></a>
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
                                        @if($pats->status == 'Enrolled')
                                      @if($pat_visit->status == 1)
                                      @if($pat_visit->date == $today)
                                        <button class="btn btn-success btn-visit" value="edit" id="attend_btn"  name="attend_btn"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                        @else
                                         <button class="btn btn-info btn-visit-view" value="edit" id="btn-visit-view" data-id="{{$pat_visit->id}}" name="btn-visit-view"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                         @endif
                                      @endif
                                      @endif
                                    </td>
                         
                                  </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                         </div>
                      </fieldset>     
                    </div>


       <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('pdfintake/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
          @if($pats->status == 'Enrolled')
            @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin' || Auth::user()->user_role->name == 'Social Worker' || Auth::user()->user_role->name == 'Nurse')
            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#intakeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
            @endif
          @endif
          <div class="container" style="margin-top: 60px;margin-bottom: 30px">
            <div class="container">
              <p style="float: left;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
              <p style="float: right;margin-top: 20px"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p><br><p style="text-align: center;font-size: 12px"><b>Republic of the Philippines<br> Department of Health</b><br>
              <b>DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br><b>TREATMENT & REHABILITATION CENTER - Cebu City</b><br><b>Outpatient and Aftercare Department</b><br>Jagobiao, Mandaue City, Cebu<br>
              <font size="1px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: <u>cebu_trc@yahoo.com.ph</u></font><br>
              </p>
            <center style="margin-bottom: 60px"><h5><b>INTAKE FORM</b></h5></center>
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
               @if($patos != '[]')
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
              @elseif($patos == '[]')
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
          <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
            <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
              <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('pdfdde/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
              @if($pats->status == 'Enrolled')
              @if(Auth::user()->designation != $dentist[0]->id && Auth::user()->designation != $psychiatrist[0]->id)
                @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin' || Auth::user()->user_role->name == 'Doctor')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><button class="btn btn-success" data-toggle="modal" data-target="#ddeFormEdit"><i class="fas fa-fw fa fa-pen"></i>Edit</button></div>
                @endif
              @endif
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
                    <input type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary Submission' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label>
                  </div>
                </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain' || $pats->type->case_name == 'Plea Bargain with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label>
                  </div>
                  </div>
                  <div class="form-label-group">
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" class="custom-control-input" id="others" name="type" value="Others">
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
                       <div class="col-md-9">{{$patin->dabused->name}}</div>
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
      </div>
    </div>
  </div>