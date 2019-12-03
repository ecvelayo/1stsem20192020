<div class="row">
        @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
              <div class="col-md-12">
        @else
              <div class="col-md-1">
              </div>
              <div class="col-md-11">
        @endif
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
             <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-danger"><b>Dismissed</b></span></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
          @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-toggle="modal" data-target="#adminreenrollPatient" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
          @else
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-toggle="modal" data-target="#reenrollPatient" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
          @endif
          </div>
         </div>
         </div>