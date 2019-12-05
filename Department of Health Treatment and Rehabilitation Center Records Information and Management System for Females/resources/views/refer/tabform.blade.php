<div class="modal2 fade" id="linkEditorModal" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content"  style="width:980px;">
      <div class="modal-header">
        <h4 class="modal-title" id="linkEditorModalLabel"><b>Referral Slip (Two Way Referral System)</b></h4>
      </div>
        <form id="modalFormData" name="modalFormData" >

      <div class="modal-body">
          <table style="width:100%">
            <tr>
              <td style="width:25%">Last Name:</th> 
              <td style="width:25%">{{$pats->lname}}</td>
              <td style="width:25%" colspan="2" rowspan="2">Address: &emsp;{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
            </tr>
            <tr>
              <td style="width:25%">First Name:</td><td style="width:25%"> {{$pats->fname}}</td>
            </tr>
           <!--  <?php $count = 0; ?>
            @foreach($history as $hist)
              @if($hist->type == 'Enrolled' || $hist->type == 'Enrolled from Transfer' || $hist->type == 'Re-enrolled')
                @if($hist->deps->department_name == $pats->departments->department_name)
                <?php $count++; ?>
                  @if($count > 1)
                 // <?php $casex = 'Old'; ?>
                  @else
                  //<?php $casex = 'New'; ?>
                  @endif
                @endif
              @endif
            @endforeach -->
          <tr>
            <td style="width:25%">Case: </td>
            <td style="width:25%">Middle Initial: {{$pats->mname}}</td>
            <td style="width:25%">Contact Number:</td>
            <td style="width:25%">{{$pats->contact}}</td>
          </tr>  
          <tr>
            <td style="width:25%">Age:</td>
            <td style="width:25%">{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
            <td style="width:25%">Gender:</td>
            @if($pats->gender == NULL)
            <td style="width:25%"></td>
            @else
            <td style="width:25%">{{$pats->genders->name}}</td>
            @endif 
          </tr>                            
          <tr>
            <td style="width:25%">Birthdate:</td>
            <td style="width:25%">{{$pats->birthdate}}</td>
            <td style="width:25%">Date of Referral:</td>
            <td style="width:25%"><input style="width: 230px;" type="date" value="<?php echo $today; ?>" id="refDate" name="refDate" required></td>
          </tr>
          <tr>
          <div class="form-label-group" style="margin-top: 20px">
            <td style="width:25%" height="70px">Referred at:</td>
            <td style="width:25%"><input type="text" class="form-control has-error"  autofocus="autofocus" style="height:70px; width: 230px;" id="refAt" name="refAt" required="required"></td>
          </div>
            <td style="width:25%">Reason for Referral:</td>
            <td style="width:25%"><input style="height:70px; width: 230px;" type="text"  class="form-control" autofocus="autofocus" id="reason" name="reason" required="required"></td>
          </tr>
          <tr>
            <td style="width:25%">Contact Person:</td>
            <td style="width:25%"><input style="width: 230px;" type="text" class="form-control" autofocus="autofocus" id="contactPer" name="contactPer" required="required"></td>
            <td style="width:25%">Referred by: </td>
            <td style="width:25%"><input  style="width: 230px;" type="text" id="refby" name="refby" value="{{Auth::user()->id}}" hidden="hidden"><input  style="width: 230px;" type="text" id="refby2" name="refby2" value="{{Auth::user()->fname}} {{Auth::user()->lname}}" disabled="disabled"></td>
          </tr>
          <tr>
            <td height="70px" colspan="4"><label> Recommendation/Attachments: </label> &emsp;<input style="height:70px; width: 670px;" type="text" id="ref_recom" name="ref_recom" required="required"/></td>
          </tr>
          <tr>
             <td style="width:25%">Referred back on(date)</td>
             <td style="width:25%"><input style="width: 230px;" type="date" id="refDateback" name="refDateback" ></td>
             <td style="width:25%">Referred back by:</td>
             <td style="width:25%"><input style="width: 230px;" type="text" id="refbyback" name="refbyback" /></td>
          </tr>
          <tr>
              <td style="width:25%" height="70px">Accepted by:</td>
              <td style="width:25%"></td>
              <td style="width:25%">Referral Slip return on</td>
              <td style="width:25%"><input style="width: 230px;" type="date" id="returnDate" name="returnDate" ></td>
          </tr>
      </table>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"  id="btn-save" name ="btn-save" value="add">Save changes</button>
    <input type="hidden" id="id" name="id" value="0">
    <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
    <input type="hidden" id="user_accepted" name="user_accepted" value="{{Auth::user()->id}}">
  </div>
    </form>

  </div>
  </div>
  </div>

<!--modal for Refer Button-->
  <div class="modal2 fade" id="viewModal" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content"  style="width:980px;">
        <div class="modal-header">
          <h4 class="modal-title" id="viewModalLabel"><b>Referral Slip (Two Way Referral System)</b></h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span><button>
         </div>
        <div class="modal-body">
          <form id="viewFormData" name="viewFormData" class="form-horizontal" novalidate="">
            <table style="width:100%">
            <tr>
              <td style="width:25%">Last Name:</th>
              <td style="width:25%">{{$pats->lname}}</td>
              <td style="width:25%" colspan="2" rowspan="2">Address: &emsp;{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
            </tr>
             <tr>
              <td style="width:25%">First Name:</td><td style="width:25%"> {{$pats->fname}}</td>
             </tr>
            <!--   <?php $count = 0; ?>
                @foreach($history as $hist)
                  @if($hist->type == 'Enrolled' || $hist->type == 'Enrolled from Transfer' || $hist->type == 'Re-enrolled')
                    @if($hist->deps->department_name == $pats->departments->department_name)
                    <?php $count++; ?>
                      @if($count > 1)
                      <?php $casex = 'Old'; ?>
                      @else
                      <?php $casex = 'New'; ?>
                      @endif
                    @endif
                  @endif  
                @endforeach -->
                <tr>
                  <td style="width:25%">Case: </td>
                  <td style="width:25%">Middle Initial: {{$pats->mname}}</td>
                  <td style="width:25%">Contact Number:</td>
                  <td style="width:25%">{{$pats->contact}}</td>
                </tr>
                <tr>
                  <td style="width:25%">Age:</td>
                  <td style="width:25%">{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
                  <td style="width:25%">Gender:</td>
                  @if($pats->gender == NULL)
                  <td style="width:25%"></td>
                  @else
                  <td style="width:25%">{{$pats->genders->name}}</td>
                  @endif 
                </tr>
                <tr>
                  <td style="width:25%">Birthdate:</td>
                  <td style="width:25%">{{$pats->birthdate}}</td>
                  <td style="width:25%">Date of Referral:</td>
                  <td style="width:25%"><input style="width: 230px;" type="text" id="refDates" name="refDates" readonly="readonly" class="myinput"></td>
                </tr>
                <tr>
                  <td style="width:25%" height="70px">Referred at:</td>
                  <td style="width:25%;"><input type="text" class="myinput" style="height:70px; width: 230px;overflow-wrap: break-word;flex-wrap: wrap;word-wrap: break-word;"  id="refAt2" name="refAt2"  /></td>
                  <td style="width:25%">Reason for Referral:</td>
                  <td style="width:25%"><input style="height:70px; width: 230px;" type="text" id="reason2" name="reason2" readonly="readonly" class="myinput"/></td>
                </tr>
                <tr>
                  <td style="width:25%">Contact Person:</td>
                  <td style="width:25%"><input style="width: 230px;" type="text" id="contact2" name="contact2" readonly="readonly" class="myinput" ></td>
                  <td style="width:25%">Referred by: </td>
                  <td style="width:25%"><input  style="width: 230px;" type="text" id="refby" name="refby" value="{{Auth::user()->id}}" hidden="hidden"><input  style="width: 230px;" type="text" id="refby22" name="refby22" readonly="readonly" class="myinput"></td>
                </tr>
                <tr>
                  <td height="70px" colspan="4"><label> Recommendation/Attachments: </label> &emsp;<input style="height:70px; width: 670px;" type="text" id="ref_recom2" name="ref_recom2" readonly="readonly" class="myinput" /></td>
                </tr>
                <tr>
                  <td style="width:25%">Referred back on(date)</td>
                  <td style="width:25%"><input style="width: 230px;" type="date" id="refDateback2" name="refDateback2" readonly="readonly" class="myinput" ></td>
                  <td style="width:25%">Referred back by:</td>
                  <td style="width:25%"><input style="width: 230px;" type="text" id="refbyback2" name="refbyback2" readonly="readonly" class="myinput" /></td>
                </tr>
                <tr>
                  <td style="width:25%" height="70px">Accepted by:</td>
                  <td style="width:25%"><input style="width: 230px;" type="text" id="accepted_by2" name="accepted_by2" readonly="readonly" class="myinput" ></td>
                  <td style="width:25%">Referral slip return on</td>
                  <td style="width:25%"><input style="width: 230px;" type="date" id="returnDate2" name="returnDate2" readonly="readonly" class="myinput" ></td>
                </tr>
            </table>
          </form>
          </div>
        <div class="modal-footer">
          <input type="hidden" id="id" name="id" value="0">
          <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
          <input type="hidden" id="user_accepted" name="user_accepted" value="{{Auth::user()->id}}">
        </div>
      </div>
    </div>
  </div>

  <div class="modal2 fade" id="linkEditor"   tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content" >
        <div class="modal-header">
          <h4 class="modal-title" id="linkEditorModalLabel"><b>Intervention the Patient Attended</b></h4>
        </div>
        <div class="modal-body">
          <form id="linkeditor_Data" name="linkeditor_Data" class="form-horizontal" novalidate="">
            @foreach($intv as $interven)
            <div>
             <input type="hidden" name="rec_id_{{$interven->id}}" id="rec_id_{{$interven->id}}" value="">
              <div class="checkboxs" id="checkboxes_{{$interven->id}}">
                <label><input type="checkbox" class="checkitems item_{{$interven->id}}" id="checkitem[]" name="checkitem[]" style="zoom:1.5;font-size: 28px;"  value="{{$interven->id}}">{{$interven->interven_name}}</label>
              </div>
                @foreach($childIntervens->groupby('parent') as  $name => $member)
                  @if($name  == $interven->id)
                    <div class="form-label-group select1" id="select_{{$interven->id}}" name="select_{{$interven->id}}"  style="display: none;">
                        <select class="form-control col-md-6" id="childInterven_{{$interven->id}}"  name="childInterven_{{$interven->id}}" style=" margin-bottom: 10px">
                        @foreach($member as $item)
                          <option value="{{$item['id']}}">{{  $item['interven_name'] }}</option>
                        @endforeach
                        </select>
                      </div>
                   @endif
                 @endforeach
                      <div class="form-label-group textboxes" id="textboxes_{{$interven->id}}" style="display: none;">
                            <input style="margin-left:0px" type="text" class="form-control" placeholder="Remarks" name="remarks_{{$interven->id}}" id="remarks_{{$interven->id}}">
                                     </div>
                                   </br>
                                  </div>
                                @endforeach
                                  
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  id="btn-attended" name ="btn-attended" value="add">Save changes
                            </button>
                            <input type="hidden" id="hasevent" name="hasevent" value="">
                            <input type="text" id="patientEventId" name="patientEventId" hidden="hidden">
                            <input type="text" id="eventId" name="eventId" hidden="hidden">


                        </div>
                    </div>
                </div>
            </div>


  <div class="modal fade" id="inactiveEditorModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  >
                        <form action="{{URL::to('/deletePatient')}}" method="post" id="inactivemodalFormData" name="inactivemodalFormData" class="form-horizontal" novalidate="">
                    {{csrf_field()}} 
                          <input type="hidden" id="inactive" name="inactive" value="{{$pats->inactive}}">
                         @if($pats->inactive != 1)
                              <div class="modal-header">
                                  <h4 class="modal-title" id="inactiveEditorModalLabel">
                             Inactive
                             </h4>
                              </div>
                              <div class="modal-body">

                                          <p>You are about to inactive the patient! Inactivating the patient means the patient will no longer be associated in any types of events in the Rehabilation Center.</p>

                                           <h6>Remarks</h6>
                                           <textarea  type="text" id="note" class="form-control" placeholder="Note" name="note"></textarea>
                                    
                              </div>

                              @else
                                 <div class="modal-header">
                                  <h4 class="modal-title" id="activeEditorModalLabel">Activate</h4>
                              </div>
                              <div class="modal-body">

                                          <p>You are about to activate patient {{$pats->lname}}, {{$pats->fname}}! Click active button to proceed.</p>

                                           <h6>Remarks</h6>
                                           <textarea  type="text" id="note" class="form-control" placeholder="Note" name="note" ></textarea>
                                    
                              </div>
                             @endif
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary" id="btn_activate" name ="btn_activate" value="{{$pats->inactive}}"">Proceed
                                  </button>
                                  <input type="hidden" id="patien_id" name="patient_id" value="{{$pats->id}}">

                              </div>

                        </form>

                  </div>
          </div>
  </div>

 