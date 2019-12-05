@section('style')

<style> 
section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
  background: #007b5e;
    color: #eee;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #f3f3f3;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
}
</style>
@endsection

  <div class="tab-pane fade" id="v-pills-patientnote" role="tabpanel" aria-labelledby="v-pills-patientnote-tab">
  
      <div class="row">
      <div style="width: 100%">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-user-md" style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user-nurse"  style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-tooth" style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fas fa-brain"  style="font-size:32px;"></i></a>
            <a class="nav-item nav-link" id="nav-social-worker-tab" data-toggle="tab" href="#nav-social-worker" role="tab" aria-controls="nav-social-worker" aria-selected="false"><i class="fas fa-user-check" style="font-size:32px;"></i></a>
          </div>
        </nav>
      <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

  <!--DOCTOR-->
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
             <div class="container">
               <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('doctorsNotes/doctor/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i></button></a></div>
              @if(Auth::user()->designation != $dentist[0]->id && Auth::user()->designation != $psychiatrist[0]->id)
                @if(Auth::user()->user_role->name == 'Doctor' || Auth::user()->user_role->name == 'Superadmin')
                                @if($pats->status == 'Enrolled')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addDoctortNotes">
                  <button id="addDoctortNotes" name="addDoctortNotes" class="btn btn-success addDoctortNotes" value="add"><i class="fas fa-fw fa fa-plus"></i></button></a></div>

                @endif
                @endif
                @endif

               

                 <div class="table-responsive scrollAble2" id="doctorTablediv">
                       <table class="table table-bordered doctorsTable" id="doctorsTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="10%">Service Type</th>
                               <th width="50%">Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="doctor-list" name="doctor-list">
                           @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "doctor")
                              <tr id="doctorNotes_{{$patient_note->id}}" value="{{$patient_note->id}}">
                                    <td width="15%">{{$patient_note->date_time}}</td>
                                    <td width="20%" id="doctorService_{{$patient_note->id}}">{{$patient_note->servicex->name}}</td>
                                    <td width="40%" id="doctorNote_{{$patient_note->id}}">{{$patient_note->notes}}</td>
                                    <td width="15%">{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td width="5%">
                                  @if((Auth::user()->role == 3 || Auth::user()->role == 2 || Auth::user()->role == 1) && Auth::user()->id == $patient_note->note_by)
                                   @if($pats->status == 'Enrolled')
                                    <button class="btn btn-info addDoctortNotes" id="addDoctortNote" name="addDoctortNote" style="font-size: 8px;"  value="{{$patient_note->id}}"><i class="fas fa-edit"></i></button>
                                    @endif
                                    @endif
                                  </td>
                                </tr>
                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>          
          </div>

  <!--nurse-->
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
             <div class="container">
                  <div class="form-group">
                     <div class="form-row">
                        <div class="col-md-6">

                             <select class="form-control tableType" id="tableType" placeholder="tableType"name="tableType">
                                 <option value="BS">Blood Sugar Daily Monitoring</option>
                                  <option value="F">BMI</option>
                                <option value="M">Medication Records</option>
                                 <option value="S">Services</option>
                              </select>

                        </div>

                       <div class="col-md-6">

                @if(Auth::user()->user_role->name == 'Nurse' || Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
                @if($pats->status == 'Enrolled')

                          <div style="float:right;margin-bottom: 10px;"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addNurseNotes"><button id="addNurseNotes" name="addNurseNotes" value="add" class="btn btn-success addNurseNotes"><i class="fas fa-fw fa fa-plus"></i></button></a></div>
                  @endif
                  @endif

                        <div class="dropdown" style="float:right;margin-bottom: 10px;margin-right: 10px">
                          <button class="btn btn-danger dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa fa-file-pdf"></i></button>
                          <div class="dropdown-menu menu_btn" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{URL::to('MedicalRecordsPDF/'.$pats->id)}}" target="_blank">Medication Records</a>
                            <a class="dropdown-item"  href="{{URL::to('BMINotes/'.$pats->id)}}"  target="_blank">BMI</a>
                            <a class="dropdown-item"   href="{{URL::to('BloodSugarPDF/'.$pats->id)}}"  target="_blank">Blood Sugar</a>
                          </div>
                      </div>
                  </div>
                </div>
                </div>
                 <div class="table-responsive scrollAble2" id="nurseTablediv">
                       <table class="table table-bordered nurseTable" id="nurseTable"  width="100%" style="font-size: 12px">
                            <thead>
                              <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="nurse-list" name="nurse-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "nurse")
                              <tr id="nurseServiceList_{{$patient_note->id}}">
                                    <td width="15%">{{$patient_note->date_time}}</td>
                                    @if($patient_note->service_id)
                                    <td width="20%" id="nurseService_{{$patient_note->id}}">{{$patient_note->servicex->name}}</td>
                                    @else
                                    <td width="20%" id="nurseService_{{$patient_note->id}}"></td>
                                    @endif
                                    <td width="40%" id="nurseNote_{{$patient_note->id}}">{{$patient_note->notes}}</td>
                                    <td width="15%">{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td width="5%"> 
                                     @if(Auth::user()->id == $patient_note->note_by && $pats->status == 'Enrolled')
                                      <button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="{{$patient_note->id}}"><i class="fas fa-edit"></i></button>
                                      @endif
                                    </td>
                                </tr>
                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
                      <div class="table-responsive scrollAble2" id="BloodSugarTablediv" hidden="hidden">
                       <table class="table table-bordered BloodSugarTable" id="BloodSugarTable"  width="100%" style="font-size: 12px" >
                            <thead>
                              <tr>
                               <th width="15%">Date/Time</th>
                               <th width="20%">Reading (Before Breakfast)</th>
                               <th width="45%">Notes</th>
                               <th width="15%">By</th>
                               <th width="5%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="bloodSugar-list" name="nurse-list">
                            @foreach($blood_sugar as $bloodSugar)
                            <tr id="bloodSugar_{{$bloodSugar->id}}">
                              <td width="15%" >{{$bloodSugar->dateTime}}</td>
                              <td width="20%" id="bloodSugarReading_{{$bloodSugar->id}}">{{$bloodSugar->reading}}</td>
                              <td width="45%" id="bloodSugarNotes_{{$bloodSugar->id}}">{{$bloodSugar->notes}}</td>
                              <td width="15%">{{$bloodSugar->userxe->lname}}, {{$bloodSugar->userxe->fname}}</td>
                              <td  width="5%">
                                @if(Auth::user()->id == $bloodSugar->created_by && $pats->status == 'Enrolled')
                              <button id="addNurseNotes" name="addNurseNotes" style="font-size: 8px;" class="btn btn-info addNurseNotes" value="{{$bloodSugar->id}}"><i class="fas fa-edit"></i></button>
                              @endif
                            </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                     </div>
                      <div class="table-responsive scrollAble2" id="BMIMonitoringdiv" hidden="hidden">
                       <table class="table table-bordered BMIMonitoring" id="BMIMonitoring"  width="100%" style="font-size: 12px" >
                            <thead>
                              <tr>
                               <th width="15%" >Date</th>
                               <th width="10%">Weight(KG)</th>
                               <th width="10%">BMI</th>
                               <th width="40%">Remarks</th>
                                <th width="15%">By</th>
                               <th width="5%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="bmiMonitoring-list" name="bmiMonitoring-list">
                               @foreach($bmi_record as $bmi)
                              <tr  id="bmiMonitor_{{$bmi->id}}">
                              <td width="15%">{{$bmi->date}}</td>
                              <td width="10%" id="bmiWeight_{{$bmi->id}}">{{$bmi->weight}}</td>
                              <td width="10%" id="bmi_{{$bmi->id}}">{{$bmi->bmi}}</td>
                              <td width="40%" id="bmiRemarks_{{$bmi->id}}">{{$bmi->remarks}}</td>
                              <td width="15%">{{$bmi->userxe->lname}}, {{$bmi->userxe->fname}}</td>
                              <td width="5%">
                              @if(Auth::user()->id == $bmi->created_by && $pats->status == 'Enrolled')                     
                               <button id="addNurseNotes" name="addNurseNotes" class="btn btn-info addNurseNotes" value="{{$bmi->id}}"><i class="fas fa-edit fa-xs"></i></button>
                                @endif
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                     </div>

                      <div class="table-responsive scrollAble2" id="MedicationRecordsdiv" hidden="hidden">
                       <table class="table table-bordered MedicationRecords" id="MedicationRecords"  width="100%" style="font-size: 12px" >
                            <thead>
                              <tr>
                               <th width="15%">Date</th>
                               <th width="15%">Time</th>
                               <th width="15%">Medications</th>
                               <th width="45%">Remarks</th>
                              <th width="15%">By</th>
                               <th width="5%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="medication-list" name="medication-list">
                              @foreach ($medical_record as $record)
                               <tr id="medication_{{$record->id}}">
                              <td  width="10%">{{$record->intake_date}}</td>gf
                              <td  width="10%">{{$record->intake_time}}</td>
                              <td  width="20%" id="medicine_{{$record->id}}">{{$record->medication}}</td>
                              <td width="40%"  id="medicineNotes_{{$record->id}}">{{$record->notes}}</td>
                              <td width="15%">{{$record->userxe->lname}}, {{$record->userxe->fname}}</td>
                              <td  width="5%">
                            @if(Auth::user()->id == $record->created_by && $pats->status == 'Enrolled')
                                <button id="addNurseNotes" name="addNurseNotes" class="btn btn-info addNurseNotes" value="{{$record->id}}" style="font-size: 8px;"><i class="fas fa-edit"></i></button>
                                @endif
                              </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>


    <!--Dental-->
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
             <div class="container">
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px">
                <a href="{{URL::to('dentalNotes/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i></button></a>

              @if((Auth::user()->designation == $dentist[0]->id || Auth::user()->user_role->name == 'Superadmin') && $pats->status == 'Enrolled')                

                  <a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addDentalNotes"><button id="addDentalNotes" name="addDentalNotes" class="btn btn-success addDentalNotes" value="add"><i class="fas fa-fw fa fa-plus"></i></button></a>
             @endif
              </div>
                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered"  id="dentalTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="10%">Date</th>
                               <th width="25%">Diagnosis</th>
                               <th width="10%">Tooth No.</th>
                               <th width="22%">Service Rendered</th>
                                <th width="15%">Dentist</th>
                                <th width="22%">Remarks</th>
                                <th width="22%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="dental-list" name="dental-list">
                              @foreach ($patient_notes as $dental_notes)
                                  @if($dental_notes->role_type == "Dentist")
                               <tr id="dental_{{$dental_notes->id}}">
                                    <td width="10%"> {!! \Carbon\Carbon::parse($dental_notes->date_time)->format('Y-m-d') !!}</td>
                                    <td width="25%" id="dentalDiagnose_{{$dental_notes->id}}">{{$dental_notes->diagnose}}</td>
                                    <td width="5%" id="dentalTooth_{{$dental_notes->id}}">{{$dental_notes->tooth_no}}</td>
                                    <td width="20%"  id="dentalServiceRendered_{{$dental_notes->id}}">{{$dental_notes->service_rendered}}</td>
                                    <td width="10%">{{$dental_notes->userx->lname}}, {{$dental_notes->userx->fname}}</td>
                                    <td width="25%" id="dentalRemarks_{{$dental_notes->id}}">{{$dental_notes->notes}}</td>  
                                    <td width="5%">
                        @if(Auth::user()->id == $patient_note->note_by && $pats->status == 'Enrolled')

                                    <button id="addDentalNotes" name="addDentalNotes" class="btn btn-info addDentalNotes" style="font-size: 8px;" value="{{$dental_notes->id}}"><i class="fas fa-edit" ></i></button></td>  
                            </tr>
                          @endif    
                          @endif
                              @endforeach

                          </tbody>
                        </table>
                     </div>
             </div>          
          
          </div>


          <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                 <div class="container">

              @if((Auth::user()->designation == $psychiatrist[0]->id || Auth::user()->user_role->name == 'Superadmin') && $pats->status == 'Enrolled')        

                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addPyschiatristNotes"><button id="psychiatristNotes" class="btn btn-success psychiatristNotes" value="add"><i class="fas fa-fw fa fa-plus"></i></button></a></div>
                @endif

                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered" id="psychiatristTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                           </thead>
                          <tbody id="psychiatrist-list" name="psychiatrist-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type == "psychiatrist")
                              <tr id="psychiatrist_{{$patient_note->id}}">
                                    <td width="15%">{{$patient_note->date_time}}</td>
                                     @if($patient_note->service_id)
                                    <td width="20%" id="psychiatristService_{{$patient_note->id}}">{{$patient_note->servicex->name}}</td>
                                    @else
                                    <td width="20%" id="psychiatristService_0"></td>
                                    @endif 
                                    <td width="45%" id="psychiatristNote_{{$patient_note->id}}">{{$patient_note->notes}}</td>
                                    <td width="15%">{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td width="5%">
                                    @if($pats->status == 'Enrolled' && Auth::user()->id == $patient_note->note_by)
                                      <button id="psychiatristNotes" name="psychiatristNotes" class="btn btn-info psychiatristNotes" style="font-size: 8px;" value="{{$patient_note->id}}"><i class="fas fa-edit"></i></button>
                                          @endif
                                      </td>
                                </tr>

                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>

          <div class="tab-pane fade" id="nav-social-worker" role="tabpanel" aria-labelledby="nav-social-worker-tab">
                 <div class="container">

@if((Auth::user()->user_role->name == 'Social Worker' || Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin') && $pats->status == 'Enrolled')
                <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="addSocialWorkerNotes"><button id="addSocialWorkerNotes" name="addSocialWorkerNotes" value="add" class="btn btn-success addSocialWorkerNotes"><i class="fas fa-fw fa fa-plus"></i></button></a></div>
                @endif
                 <div class="table-responsive scrollAble2">
                       <table class="table table-bordered"  id="socialworkerTable" width="100%" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th width="15%">Date/Time</th>
                               <th width="15%">Service Type</th>
                               <th>Notes</th>
                               <th width="15%">By</th>
                               <th width="10%">Action</th>
                            </tr>
                            </thead>
                          <tbody id="socialworker-list" name="socialworker-list">
                              @foreach ($patient_notes as $patient_note)
                             @if($patient_note->role_type =="socialworker")
                              <tr id="socialworker_{{$patient_note->id}}">
                                    <td width="15%">{{$patient_note->date_time}}</td>
                                    @if($patient_note->service_id)
                                    <td width="20%" id="socialworkerService_{{$patient_note->id}}">{{$patient_note->servicex->name}}</td>
                                    @else
                                    <td width="20%" id="socialworkerService_{{$patient_note->id}}"></td>
                                    @endif                                    
                                    <td width="45%" id="socialworkerNote_{{$patient_note->id}}">{{$patient_note->notes}}</td>
                                    <td width="15%">{{$patient_note->userx->lname}}, {{$patient_note->userx->fname}}</td>
                                    <td width="5%">
                      @if(Auth::user()->id == $patient_note->note_by && $pats->status == 'Enrolled')
                                      <button id="addSocialWorkerNotes" name="addSocialWorkerNotes" class="btn btn-info addSocialWorkerNotes" value="{{$patient_note->id}}" style="font-size: 8px;"><i class="fas fa-edit"></i></button>
                                      @endif
                                    </td>
                                </tr>
                             @endif
                          @endforeach
                          </tbody>
                        </table>
                     </div>
             </div>
          </div>
        </div>
      
      </div>
    </div>

 </div>

  <div class="modal fade" id="AddSocialWorkerNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddSocialWorkerNotesModal">Add Social Worker Service</h4>
                              </div>
                              <form id="AddSocialWorkerFormData" name="AddSocialWorkerFormData" class="form-horizontal">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6> 
                                      <select class="form-control" id="socialList"  name="socialList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          <option value=0>--NONE--</option>
                                          @foreach($service as $services)
                                          @if($services->role == 5)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="socialworkerNote" class="form-control" placeholder="Note" name="socialworkerNote" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-socialworker" name ="btn-save-socialworker" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="noteId" name="noteId" value="">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>

<div class="modal fade" id="AddPsychiatristNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddPsychiatristNotesModal">Add Psychiatrist Service</h4>
                              </div>
                              <form id="AddPsychiatristFormData" name="AddPsychiatristFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="psychiatristList"  name="psychiatristList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 6)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes2" class="form-control" placeholder="Note" name="notes2" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-psychiatristnotes" name ="btn-save-psychiatristnotes" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>

  

   <div class="modal fade" id="NurseNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:760px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="NurseNotesModal">Add Nurse Notes</h4>
                              </div>

                          <form id="NurseNotesFormData" name="NurseNotesFormData">
                              <div class="modal-body">
                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control nurseList" id="nurseList"  name="nurseList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                        <option value=0>--NONE--</option>
                                        <option value="BS">Blood Sugar Daily Monitoring</option>
                                        <option value="F">BMI</option>
                                          @foreach($service as $services)
                                          @if($services->role == 4)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                        <option value="M">Medication Records</option>
                                        </select>
                                 
                                      
                                   <div class="medicalRecords" hidden="hidden">

                                        <h6>Medication</h6>
                                         <input style="word-wrap: break-word;" type="text" id="medication_record" class="form-control has-error" placeholder="Description" required name="medication_record">

                                  </div>

                                  <div class="BloodSugarRecords" hidden="hidden">

                                          <h6>Reading (Before Breakfast)</h6>

                                           <input type="number" style="width:40%;" id="reading_bbreakfast" class="form-control has-error reading_bbreakfast" placeholder="Reading (Before Breakfast)" required name="reading_bbreakfast">
                                  </div>

                                  <div class="BMIRecords" hidden="hidden">
                                    <div class="form-group has-error">
                                    <div class="form-row">
                                     <div class="col-md-6">

                                      <h6>Weight (KG)</h6>

                                           <input type="number" style="width:80%;" id="weight_kg" class="form-control has-error weight_kg" placeholder="Weight(KG)" required name="weight_kg">
                                      </div>
                                   <div class="col-md-6">

                                       <h6>BMI</h6>

                                           <input type="number" style="width:80%;" id="bmi_record" class="form-control has-error" placeholder="Description" required name="bmi_record">
                                      </div>
                                    </div>
                                  </div>
                                  </div>

                                   

                                    <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:720px;margin-bottom: 10px" type="text" id="nursenote" class="form-control has-error nursenote" placeholder="Note" name="nursenote" required="required"></textarea>
                                 </div>


                          </div>
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary" id="btn-save-nursenotes" name ="btn-save-nursenotes" value="add">Save changes
                                  </button>
                                    <input type="hidden" id="id" name="id" value="0">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                    <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                    <input type="hidden" id="noteId" name="noteId">                            
                                    <input type="hidden" id="creator_role" name="creator_role" value="doctor">

                              </div>
                         </form>

                  </div>
          </div>
  </div>


 <div class="modal fade" id="AddDoctorNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddDoctorNotesModal">Add Doctor Service</h4>
                              </div>
                              

                          <form id="AddDoctorFormData" name="AddDoctorFormData">
                                    
                              <div class="modal-body" style="width:800px">
                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control doctorList" id="doctorList"  name="doctorList"  data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                  
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes" class="form-control has-error" placeholder="Note" name="notes" required="required"></textarea>
                                  </div>


                                    
                              </div>
                             </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-doctornotes" name ="btn-save-doctornotes" value="add">Save changes</button>
                                 <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="noteId" name="noteId" value="">
                                  <input type="hidden" id="creator_role" name="creator_role" value="doctor">
                              </div>

                  </div>
          </div>
  </div>

 <div class="modal fade" id="AddDentalNotesModal" aria-hidden="true" >
      <div class="modal-dialog">
            <div class="modal-content" style="width:800px" >
                  <div class="modal-header" style="width:800px">
                       <h4 class="modal-title" id="AddDentalNotesModal">Add Dental Service</h4>
                  </div>
                       <form id="AddDentalFormData" name="AddDentalFormData" class="form-horizontal" novalidate="">
                  <div class="modal-body" style="width:800px">

                                  <h6>Tooth No.</h6>
                                  <input style="width:30%;" type="number" id="tooth_no" class="form-control" placeholder="Tooth No." required="required" name="tooth_no">

                                  <h6>Diagnosis</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="diagnosis" class="form-control" placeholder="Diagnoses" required="required" name="diagnosis">



                                  <h6>Service Rendered</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="service_rendered" class="form-control" placeholder="Service Rendered" required="required" name="service_rendered">
                          
                                        <h6>Remarks</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px;word-wrap: break-word;" type="text" id="remarks" class="form-control" placeholder="Note" name="remarks" required="required"></textarea>
        
                       </form>
                  <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-dentalServices" name ="btn-save" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" class="noteId" id="noteId" name="noteId">                            
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">
                  </div>
          </div>
      </div>
  </div>

