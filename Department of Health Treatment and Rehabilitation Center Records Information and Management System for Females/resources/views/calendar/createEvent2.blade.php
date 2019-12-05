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

        <!-- Icon Cards-->
  <div class="container" style="margin-top: 30px">
        <p style="font-size:50px;margin-bottom: 20px">Create Event</p>
        <form action="{{URL::to('/add_event')}}" method="post">
          {{csrf_field()}}
            <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Event Details</legend>
                <div class="form-group" style="margin-left:20px">
                    <div class="form-row">
                       <div class="col-md-12">
                          <div class="form-label-group">
                             <h6>Title*</h6>
                              <input type="text" id="title" class="form-control" placeholder="Title" required="required" autofocus="autofocus" name="title" value="{!! old('title') !!}">
                          </div>
                       </div>
                    </div>
                </div>
                <div class="form-group" style="margin-left:20px">
                    <div class='form-row'>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-11">
                                  <div class="form-label-group">
                                    <h6>Venue*</h6>
                                      <input type="text" id="venue" class="form-control" placeholder="Venue" name="venue">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-6">
                                <div class="form-label-group">
                                    <h6>Start Date*</h6>
                                    <input type="date" id="start_date" class="form-control"  placeholder="Start Date" name="start_date" value='{{$date}}'>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-label-group">
                                  <h6>Start Time*</h6>
                                  <input type="time" id="start_time" class="form-control" placeholder="Start Time" name="start_time" value="12:00">
                                </div>
                              </div>
                            </div>
                          </div>
                           <div class="form-group">
                              <div class="form-row">
                                <div class="col-md-6">
                                <div class="form-label-group">
                                    <h6>End Date*</h6>
                                    <input type="date" id="end_date" class="form-control"  placeholder="End Date" name="end_date" value='{{$date}}'>
                                </div>
                              </div>
                                <div class="col-md-5">
                                  <div class="form-label-group">
                                    <h6>End Time*</h6>
                                    <input type="time" id="end_time" class="form-control" placeholder="End Time" name="end_time" value="12:00">
                                  </div>
                                </div>
                                
                             </div>
                          </div>
                        </div>

                         
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-11">
                                  <div class="col-md-11">

                                      <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
                                    </div>
                                  <div class="form-label-group">
                                    <h6>Assignee</h6>
                                      <select id="nameid[]" class="selectpicker show-menu-arrow form-control" width="300" style="font-size: 18px; width: 300px;overflow: hidden;" name="nameid[]" multiple="multiple">
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
                            </div>
                              <div class="form-row">

                              <div class="col-md-11">
                                  <div class="form-label-group" style="margin-top: 25px">
                                    <h6>Department</h6>
                                    <select id="department" class="form-control dept_picker" style="font-size: 18px;" name="department" required="required">
                                        <option disabled selected value> -- select an option -- </option>                                        
                                        @foreach($deps as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>

                     <div class="dataTables_wrapper form-inline dt-bootstrap pt-20"> 
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped dataTable" id="YoohsTable">
                                    <thead>
                                        <tr>
                                             <th style="text-align:center;width:45px"><input type="checkbox" id="checkall"/></th>
                                              <th style="text-align:center;width:45px">Id</th>
                                              <th style="text-align:center;width:300px">Name</th>
                                              <th style="text-align:center;width:300px">Date Admitted</th>
                                              <th>Contact Number</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


      </div>    

        </fieldset>

          <div class="col-md-12">
             <input style="width:400px;float:right;margin-top: 10px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
           </div><br>
           <br>
           <br>
           <br>
         

           </form>
         </div>
      
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

                  ajaxurl = '{{URL::to("/event_patient")}}'+ '/' + selectedCountry;


                 console.log(selectedCountry);

               $.ajax({
                type: "GET",
                url: ajaxurl,
                datatype: 'json',
                success: function(data){
                  $('#YoohsTable').DataTable().clear().draw();
    

                     $.each(data, function(index, value) {



                     var newRow = $('#YoohsTable').DataTable().row.add([

                           '<input style="center" type="checkbox" class="checkitem" name="checkitem[]" value="'+value.id+'"/>',value.id,value.fname +' '+ value.lname, value.date_admitted,value.contact
                        ]).draw().node(); 



                  });


                }

                });
            });
  })

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
       

  </script>  
@endsection


