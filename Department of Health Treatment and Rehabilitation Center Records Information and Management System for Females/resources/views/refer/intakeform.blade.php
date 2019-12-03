       <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
              <div class="container scrollAble2" style="margin-top: 30px">
                <form action="{{URL::to('/patientsave_intake')}}" method="post">
                  {{csrf_field()}}
                  <fieldset style="margin-bottom: 30px">
                      <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
                    <div class="form-group" style="margin-left:20px">
                      <div class="form-row">
                        <div class="col-md-4">
                          <div class="form-label-group">
                            <h6>Last name*</h6>
                            <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}" disabled="true">
                          </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>First name*</h6>
                            <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}" disabled="true">
                        </div>
                      </div>
                    <div class="col-md-1">
                      <div class="form-label-group">
                        <h6>Age*</h6>
                          <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{$pats->age}}" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-label-group">
                        <h6>Birthday*</h6>
                          <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}" disabled="true">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="department" value="{{$pats->id}}">
                      </div>
                    </div>
                </div>
              </div>
            <div class="form-group" style="margin-left:20px">
                <div class="form-row">
                  <div class="col-md-3">
                    <div class="form-label-group">
                      <h6>Street Address*</h6>
                      <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}" disabled="true">
                    </div>
                  </div>
                <div class="col-md-3  ">
                  <div class="form-label-group">
                    <h6>Barangay*</h6>
                    <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <h6>City*</h6>
                    <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-label-group">
                    <h6>Marital Status*</h6>
                    <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils" value="{{$pats->civil_status}}" disabled="true">
                      <label for="civils">Civil Status</label>
                      <option value="Single" {{ ($pats->civil_status == 'Single') ? 'selected' : '' }}>Single</option>
                      <option value="Married" {{ ($pats->civil_status == 'Married') ? 'selected' : '' }}>Married</option>
                      <option value="Separated" {{ ($pats->civil_status == 'Separated') ? 'selected' : '' }}>Separated</option>
                      <option value="Divorced" {{ ($pats->civil_status == 'Divorced') ? 'selected' : '' }}>Divorced</option>
                      <option value="Widowed" {{ ($pats->civil_status == 'Widowed') ? 'selected' : '' }}>Widowed</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </fieldset>
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
                          @foreach($patos as $patss)
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}" disabled="true">
                            @endforeach
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}" disabled="true">
                      @endforeach
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
                          @foreach($patos as $patss)
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain" disabled="true">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="Elementary" {{ ($patss->educational_attainment == 'Elementary') ? 'selected' : '' }}>Elementary Graduate</option>
                            <option value="Highschool" {{ ($patss->educational_attainment == 'Highschool') ? 'selected' : '' }}>High-school Graduate</option>
                            <option value="College" {{ ($patss->educational_attainment == 'College') ? 'selected' : '' }}>College Graduate</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                          @foreach($patos as $patss)
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat" disabled="true">
                            <label for="edstat">Employement Status</label>
                            <option value="Employed"  {{ ($patss->employment_status == 'Employed') ? 'selected' : '' }}>Employed</option>
                            <option value="Unemployed"  {{ ($patss->employment_status == 'Unemployed') ? 'selected' : '' }}>Unemployed</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          @foreach($patos as $patss)
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}" disabled="true">
                          @endforeach
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
                          @foreach($patos as $patss)
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}" disabled="true">
                            @endforeach
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
              @foreach($patos as $patss)
              <textarea type="text" id="preprob" class="form-control" placeholder="{{$patss->presenting_problems}}" name="preprob" value="{{$patss->presenting_problems}}" disabled="true"></textarea>
              @endforeach
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  @foreach($patos as $patss)
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="{{$patss->impression}}" name="impre" value="{{$patss->impression}}" disabled="true"></textarea>
                  @endforeach
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
  </fieldset>
        </div>