@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/patient_dep')}}"><b>Choose Department</b></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/choosef/'.$id)}}"><b>Choose what to fill up</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Fill up</b></li>
        </ol>

  <div style="background-color: white;border-radius: 5px;height: 1500px;padding-top: 10px">
    <div class="container" style="margin-top: 30px">
        <p style="font-size:50px"><b>Intake Form</b></p>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger">{{$error}}</div>
          @endforeach
        @endif
        <form action="{{URL::to('/patientsave_intake')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px" class="bg bg-dark">Intake Information </legend><legend style="text-indent: 20px;width:1090px;margin-left: 5px"><div class="form-row" style="border-radius: 5px">
              <div class="col-md-4 mb-4">
                <div class="form-label-group" style="margin-top: 20px">
                  <h6>Patient Type*</h6>
                <select class="form-control" id="patype" placeholder="Patient Type" required="required" name="ptype" style="margin-left: 20px">
                    <option value="" disabled selected hidden>Patient Type</option>
                  @foreach($case as $cases)
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}" @if (old('ptype') == $cases->id)
                     selected @endif>{{$cases->case_name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="textes" style="display: none;margin-top: 20px">
                  <h6>City Jail*</h6>
                <select class="form-control" id="jail" placeholder="Patient Type" required="required" name="jail" style="margin-left: 20px">
                    <option value="" disabled selected hidden>City Jail</option>
                @foreach($jails as $jail)
                    <option value="{{$jail->id}}" @if (old('jail') == $jail->id)
                     selected @endif>{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="form-label-group" id="textc" style="display: none;margin-top: 20px">
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="{!! old('caseno') !!}"style="margin-left: 20px">
                </div>
              </div>
            </div></legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{!! old('lname') !!}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{ old('fname') }}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Middle Name</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle Name" autofocus="autofocus" name="mname" value="{{ old('mname') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{!! old('bday') !!}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" value="{{$id}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{!! old('street') !!}">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{!! old('barangay') !!}">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{!! old('city') !!}">
            </div>
           </div>
            <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Marital Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" name="civils" required="required">
                  <label for="civils">Civil Status</label>
                    <option value="" disabled selected hidden>--Choose--</option>
                    @foreach($status as $stat)
                    <option value="{{$stat->id}}" @if (old('civils') == $stat->id)
                     selected @endif>{{$stat->name}}</option>
                    @endforeach
                </select>
                </div>
              </div>
          </div>
        </div>
        </fieldset>
        <fieldset>
            <div class="form-group" style="margin-left:20px">
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
                           <input type="text" id="emername" class="form-control" placeholder="Last name" required="required" name="emername" value="{!! old('emername') !!}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name" required="required" name="emerelation" value="{!! old('emerelation') !!}">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name" required="required" name="emerphone" value="{!! old('emerphone') !!}">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="number" id="emercell" class="form-control" placeholder="Last name" required="required" name="emercell" value="{!! old('emercell') !!}">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-sgroup">
                      <h6>Email add*</h6>
                       <input type="email" id="emeremail" class="form-control" placeholder="Last name" required="required" name="emeremail" value="{!! old('emeremail') !!}">
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
                            <option value="" disabled selected hidden>--Choose--</option>
                            @foreach($eduatain as $edu)
                            <option value="{{$edu->id}}" @if (old('eduattain') == $edu->id)
                            selected @endif>{{$edu->name}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            <label for="edstat">Employement Status</label>
                             <option value="" disabled selected hidden>--Choose--</option>
                            @foreach($estat as $estats)
                            <option value="{{$estats->id}}" @if (old('edstat') == $estats->id)
                            selected @endif>{{$estats->name}}</option>
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
                          <h6>Name of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{!! old('spouse') !!}">
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
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{!! old('fathname') !!}">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{!! old('mothname') !!}">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob" required="required" value="{!! old('preprob') !!}">{{Request::old('preprob')}}</textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre" required="required" value="{!! old('impre') !!}">{{Request::old('impre')}}</textarea>
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
  </div>

       
@endsection
