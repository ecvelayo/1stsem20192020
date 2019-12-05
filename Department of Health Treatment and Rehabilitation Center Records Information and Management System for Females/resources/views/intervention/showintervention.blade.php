@extends('main')
@section('content')
 <style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

</style>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Intervention</b></li>
        </ol> 

      <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>Intervention</b></p> 
              </div>

                @include('flash::message')

            </div>
        </div>

        <div class="col-xl-8 col-sm-6 mb-10">
        </div>
        <div class="col-xl-4 col-sm-6 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                <a style="color:white" href="{{URL::to('/add_intervention')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;">New Intervention</button></a>
              </div>
          </div>
        </div>
      </div>
         <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
                  <table class="table table-bordered" id="InterventionTable" width="100%" cellspacing="0" style="text-align: center">
                      <thead>
                          <tr>
                            <th width="40%">Intervention</th>
                            <th width="20%">Department</th>
                            <th width="20%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                         @foreach($inter as $intervention)
                            <tr>
                                <td id="inteven_{{$intervention->id}}" >{{$intervention->interven_name}}</td>
                                <td id="inteven_depart_{{$intervention->id}}">{{$intervention->deptxs->department_name}}</td>
                                <td id="button_{{$intervention->id}}">
                         
                                    @if($intervention->inactive == 1)
                                      <div class="forinactive">
                                        <button class="btn btn-success deleteIntervention" id="deleteIntervention" name="deleteIntervention" value="{{$intervention->id}}">Active</button></td>

                                    </div>
                                    @else
                                      <div class="foractive">
                                      <button class="btn btn-info editIntervention" id="editIntervention" name="editIntervention" value="{{$intervention->id}}">Edit</button>
<!--                                      <button class="btn btn-success" id="ViewIntervention" name="ViewIntervention" value="{{$intervention->id}}">View</button>
 -->                                    <button class="btn btn-danger deleteIntervention" id="deleteIntervention" name="deleteIntervention" value="{{$intervention->id}}">Delete</button></td>
                                  </div>

                                    @endif


                            </tr>
                         @endforeach
                      </tbody>
              </table>
            </div>
          </div>
        </div>

            <div class="modal fade" id="deleteInterventionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteInterventionLabel">Are you sure you want to delete this Intervention?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="{{URL::to('/deleteIntervention')}}" name="deleteInterventioneModalData" method="post" class="form-horizontal" novalidate="">
                    {{csrf_field()}} 
                    <div class="modal-body">
                    <input type="hidden" id="interventionId" name="interventionId" class="form-control" value="">
                    <input type="hidden" id="intervenstatus" name="intervenstatus" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>  
                    </div>
                  </form>
                </div>
              </div>
          </div>

            <div class="modal fade" id="EditInterventionModal" aria-hidden="true" >
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title" id="EditInterventionModalLabel">Edit Intervention</h4>
                                  </div>
                                  <div class="modal-body">
                                      <form id="EditServiceModalData" name="EditInterventioneModalData" class="form-horizontal" novalidate="">
                                          <div class="form-group">
                                              <label for="interven_name">Intervention Name</label>
                                               <input type="text" id="interven_name" class="form-control" required="required" autofocus="autofocus" name="name">
                                              <label for="interventiondesc">Description</label>
                                                <input style="height:100px;" type="textbox" id="interventiondesc" class="form-control" required="required" name="description">
                                                <label for="department">Department</label>
                                                <select class="form-control department" id="department" placeholder="Department" name="department" required="required">
                                                @foreach($deps as $dep)
                                                  <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                                                @endforeach
                                              </select>                              
                                            </div>   
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-primary btn_update"  id="btn_update" name ="btn_update">Save changes
                                      </button>

                                    
                                  </div>
                              </div>
                          </div>
                      </div>


@endsection


@section('script')
<script>
      
  $(document).ready(function () {

              $('#InterventionTable').DataTable();

//     $(".deleteIntervention").click(function (e) {
  $('body').on('click', '.deleteIntervention', function () {
            //alert("sample");

            var stat = $(this).text();
             var id = $(this).val();

            $('#intervenstatus').val(stat);
            $('#interventionId').val(id);

              if(stat != "Delete"){
              console.log("sample");
                $("#deleteButton").addClass("btn-success");
                $("#deleteButton").text("Activate");
                $("#deleteButton").removeClass("btn-danger");
            }else{
                 $("#deleteButton").addClass("btn-danger");
                $("#deleteButton").text("Delete");
                $("#deleteButton").removeClass("btn-success");

            }

                  $('#EditInterventioneModalData').trigger("reset");
                  $('#deleteInterventionModal').modal('show');


          });

   //       $(".editIntervention").click(function (e) {

  $('body').on('click', '.editIntervention', function () {
               
                  var id = $(this).val();

                  var ajaxurl = '{{URL::to("/edit/intervention")}}';


                  $('#EditInterventioneModalData').trigger("reset");
                  $('#EditInterventionModal').modal('show');

              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: "GET",
                url: ajaxurl,
                data: {'id': $(this).val()},

                  success: function (data) {

                       $interven_name = data['interven_name'];
                       $decrpt = data['descrp'];
                       $deparment = data['department_id'];

                       $('#interven_name').val($interven_name);
                       $('#interventiondesc').val($decrpt);
                       $('#btn_update').val(id);
                       $('.department option[value='+$deparment+']').attr('selected','selected');




                   },
                  error: function (data) {
                    console.log('Error:', data);

                }


              });

      });


              $('.btn_update').click(function(){

                    var id = $(this).val();

                      $interven_name = $('#interven_name').val();
                      $decription = $('#interventiondesc').val();
                      $department = $('#department').val();


                      console.log($interven_name)

                      $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                       });

                       var ajaxurl = '{{URL::to("/update/intervention")}}'+ '/' + id;

                         $.ajax({
                            //contentType: "application/json; charset=utf-8",
                            type: "POST",
                            url: ajaxurl,
                            data: {interven_name: $interven_name, descrp: $decription, department_id: $department},

                              success: function (data) {

                                var link = '<td id="inteven_'+data[0].id+'">'+data[0].interven_name+'</td>';

                                   $('#inteven_'+data[0].id).replaceWith(link);

                        

                                var depart = '<td id="inteven_depart_'+data[0].id+'">'+data[0].deptxs.department_name+'</td>';

                                  $('#inteven_depart_'+data[0].id).replaceWith(depart);

                                    $('#EditInterventioneModalData').trigger("reset");
                                    $('#EditInterventionModal').modal('hide');

                               },
                              error: function (data) {
                                console.log('Error:', data);

                            }

              });


                     

                
              });
  

  })


  </script>
@endsection