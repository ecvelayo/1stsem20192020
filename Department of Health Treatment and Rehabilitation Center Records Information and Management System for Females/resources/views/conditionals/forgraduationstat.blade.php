<div class="row">
        @if(Auth::user()->user_role->name == 'Superadmin' || Auth::user()->user_role->name == 'Admin')
              <div class="col-md-12">
        @else
              <div class="col-md-1">
              </div>
              <div class="col-md-11">
        @endif
         <div class="row">
          <div class="col-md-4" style="margin-left: 40px;">
            <p><h6><b>Admission no: {{$pats->admission_no}}</b></h6><h4 style="color:#343a40"><b>Patient Status: </b><span class="text-warning"><b>For Graduation</b></span></p>
            <fieldset style="margin-bottom: 30px;border:solid thin gray;border-radius: 10px;margin-top: 10px">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                          @foreach($graduates as $grads)
                          <p style="font-size: 8px"><h6><b>Graduate Remarks: </b></h6><span style="font-size: 15px">{{$grads->remarks}}</span></p>
                          @endforeach
                          </div>
                       </div>
                    </div>
            </fieldset>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
              <a href="{{URL::to('graduate_patient_now/'.$pats->id.'/'.$grads->in_department.'/'.$grads->graduate_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:50px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Graduate</p></a>
              <a href="{{URL::to('declinet_patient_now/'.$pats->id.'/'.$grads->in_department.'/'.$grads->graduate_id.'/'.$pid)}}" class="btn btn-danger" style="margin-left:10px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Decline</p></a>
          </div>
         </div>