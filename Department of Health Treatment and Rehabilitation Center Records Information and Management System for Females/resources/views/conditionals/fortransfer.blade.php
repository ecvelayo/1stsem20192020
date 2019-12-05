<div class="row">
        @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
              <div class="col-md-12">
        @else
              <div class="col-md-1">
              </div>
              <div class="col-md-11">
        @endif
          <div class="row">
              <div class="col-md-4" style="margin-left: 15px;">
                <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-warning"><b>For Transfer</b></span></p>  
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-3" style="margin-top: 20px">
                  <span><h3><b>---Pending---</b></h3></span></li>
              </div>
            </div>
          </div>