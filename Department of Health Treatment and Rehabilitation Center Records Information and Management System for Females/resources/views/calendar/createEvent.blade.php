@extends('main')
@section('style')

<style> 
 /*    tbody{
       height:200px;display:block;overflow:scroll

     }*/

     body {
  background: #000;
  color: #fff;
}

.bootstrap-select.btn-group {width: auto !important;}

.bootstrap-select.btn-group .dropdown-toggle .filter-option { white-space: normal; }
   </style>

@endsection
@section('content')


 <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Create Event</li>
        </ol>


        <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
                    <form action="{{URL::to('/add_event')}}" method="post">

                      {{csrf_field()}}
          <div class="card"> 
            <div class="card-header">
                 <h5 class="card-title">Create Event</h5>
              </div>

                        @include('flash::message')

              <div class="card-body">

                      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
                     <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Title:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="title" placeholder="Event Name" name="title" required="required" value="{{old('title')}}">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Venue:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="venue" placeholder="Event Name" name="venue" required="required" value="{{old('venue')}}">
                        </div>
                     </div>
                       <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Description:</label>
                        <div class="col-sm-10">
                              <textarea class="form-control" id="description" name="description" rows="4" required="required">{{old('description')}}</textarea>

                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label input-daterange" style="text-align: right;">Date:</label>
                        <div class="col-sm-4">
                              <input type="date" id="start_date" class="form-control"  placeholder="Start Date" name="start_date" value='{{$date}}'>

                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Start Time:</label>
                        <div class="col-sm-3">
                                    <input type="time" id="start_time" class="form-control" placeholder="start Time" name="start_time" value="12:00" required="required">
                                     <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <span class="text-danger">
                                        <strong id="start_time-error"></strong>
                                    </span>

                        </div>

                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">End Time:</label>
                        <div class="col-sm-3">
                              <input type="time" id="end_time" class="form-control" placeholder="End Time" name="end_time" value="12:00" required="required">

                        </div>
                     </div>
                       <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Assignee:</label>
                        <div class="col-sm-10 col-md-4">
                             <select id="nameid[]" class="selectpicker show-menu-arrow form-control"  style="font-size: 18px; width: 300px;overflow: hidden;" name="nameid[]" multiple="multiple"required="required">
                                        @foreach($assignee->groupby('role') as $assign => $user)

                                        @foreach($roles as $role)
                                        @if($assign == $role->id)
                                            <optgroup label="{{$role->name}}">
                                          @foreach($user as $assgnee)
                                            <option value="{{$assgnee['id']}}">{{$assgnee['fname']}} {{$assgnee['lname']}}</option>
                                          @endforeach
                                        </optgroup>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </select>
                        </div>
                     </div>
                       <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="text-align: right;">Department:</label>
                        <div class="col-sm-10">
                             <select id="department" class="form-control dept_picker" style="font-size: 18px;" name="department">
                                                                     <option value=''> Employee Assembly </option>                                                                               
                                        @foreach($deps as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                              </select>
                        </div>
                     </div>
                   <div class="form-group row list-patient" hidden>
                     <div class="col-sm-1">
                      </div>
                    <div class="col-sm-10">
                    <div class="card">
                    <div class="card-body">
                     <table class="table table-bordered table-striped dataTable" id="YoohsTable">
                                    <thead>
                                        <tr>
                                             <th style="text-align:center;width:45px"><input type="checkbox" id="checkall"/></th>
                                              <th style="text-align:center;width:20px">Id</th>
                                              <th style="text-align:center;width:250px">Name</th>
                                              <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                       </table>
                     </div>
                   </div>
                   </div>
                 </div>
              </div>
                      <div class="col-md-12">
             <input style="width:400px;float:right;margin-top: 10px" class="btn btn-primary btn-block" type="submit" name="event-create" id="event-create" value="Create">
           </div><br>
          </div>
        </form>
        </div>
         <div class="col-sm-2">
        </div>
             
</div>
</br>
</br>
      
@endsection

@section('script')

 <script type="text/javascript">


       $(document).ready(function () {


        $("#end_date").change(function(){

          var start_time = $("#start_time").val();

          var end_time = $("#end_time").val();

          var end_date = new Date($(this).val() + ' '+ end_time);


          var start_date = new Date($("#start_date").val() + ' ' + start_time);

           var  time_start = start_date.getTime();

            //console.log("end_date", end_date);

             if(end_date < start_date){

                alert("End Date should be after Start Date");

                  $(this).val($("#start_date").val());

                    if(start_time > end_time){

                      $("#end_time").val(start_time);


                    }


              }


        })

        $("#start_date").change(function(){

          var start_time = $("#start_time").val();

          var end_time = $("#end_time").val();

          var start_date = new Date($(this).val() + ' '+ start_time);


          var end_date = new Date($("#end_date").val() + ' ' + end_time);



         if(end_date < start_date){

                alert("End Date should be after Start Date");

                  $(this).val($("#end_date").val());

                    if(start_time > end_time){

                      $("#start_time").val(end_time);


                    }


              }


        })
        
        $(".dept_picker").change(function(){



                 var selectedCountry = $(this).children("option:selected").val();

                  if(selectedCountry == 0){

                        $(".list-patient").hide();
                
                  }else{

                    $(".list-patient").removeAttr("hidden");

                    $(".list-patient").show();


                  ajaxurl = '{{URL::to("/event_patient")}}'+ '/' + selectedCountry;

               $.ajax({
                type: "GET",
                url: ajaxurl,
                datatype: 'json',
                success: function(data){
                  
                  $('#YoohsTable').DataTable().clear().draw();
    

                     $.each(data, function(index, value) {



                         var newRow = $('#YoohsTable').DataTable().row.add([

                               '<input style="center" type="checkbox" class="checkitem" name="checkitem[]" value="'+value.id+'"/>',value.id,value.fname +' '+ value.lname, value.contact
                            ]).draw().node(); 



                      });


                }

                });
             }
            });


        $('#YoohsTable').dataTable({
                "order": [[3, "desc"]]
            

       });

      $(".picker").selectpicker({
      style: 'btn-info',
      size: 4
        });
        $('#checkall').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            console.log('checked');
            $(".checkitem").prop('checked', true);  
         } else {  
            $(".checkitem").prop('checked',false);  
         }  
        });
      })

  </script>  
@endsection


