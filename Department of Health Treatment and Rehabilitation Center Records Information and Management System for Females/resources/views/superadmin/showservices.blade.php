@extends('main')
@section('content')

<style>

  th {
  text-align: inherit;
  background-color: #212529;
  color:white;
  }

</style>
 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Services</b></li>
        </ol> 

      <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>Services</b></p>
              </div>

                @include('flash::message')

            </div>
          </div>
          <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/create_service')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Service</button></a>
                </div>
              </div>
            </div>
         </div>
          <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
                  <table class="table table-bordered" id="serviceTable" width="100%" cellspacing="0" style="text-align: center">
                      <thead>
                          <tr>
                            <th>Service</th>
                            <th>Parent</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                       @foreach($services as $service)
                            <tr>
                                <td id=servicename_{{$service->id}}>{{$service->name}}</td>
                                @if($service->parent != 0)
                                @foreach($services as $serviced)
                                    @if($service->parent == $serviced->id)
                                <td id=serviceparent_{{$service->id}}>{{$serviced->name}}</td>
                                  @endif
                                  @endforeach
                                @else
                                <td id=serviceparent_{{$service->id}}></td>
                                @endif
                                <td>
                                  @if($service->inactive == 1)
                                      <div class="forinactive">
                                        <button class="btn btn-success deleteServices" id="deleteServices" name="deleteServices" value="{{$service->id}}">Active</button></td>

                                    </div>
                                    @else
                                    <button class="btn btn-info editServices " id="editServices" name="editServices" value="{{$service->id}}">Edit</button>
                                    <button class="btn btn-danger deleteServices" id="deleteServices" name="deleteServices" value="{{$service->id}}">Delete</button>
                                      <input type="hidden" id="service_id" name="service_id" value="{{$service->id}}">
                                      @endif
                                    </td>
                            </tr>
                         @endforeach
                      </tbody>
              </table>
            </div>
          </div>
        </div>

          <div class="modal fade" id="EditServiceModal" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="EditServiceModalLabel">Edit Service</h4>
                        </div>
                        <form action="{{URL::to('/save_services')}}" method="post" id="EditServiceModalData" name="EditServiceModalData">
                              {{ csrf_field() }}
                          <div class="modal-body">
                                <div class="form-group">
                                  <label for="parent">Parent</label>
                                   <select id="parent" class="form-control parent" name="parent">
                                        <option value="0">--NONE--</option>
                                      @foreach($parent as $parents)
                                            <option value="{{$parents->id}}">{{$parents->name}}</option>
                                        @endforeach
                                      </select>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label for="servicename">Service Name</label>
                                     <input type="text" id="servicename" class="form-control" required="required" autofocus="autofocus" name="name">
                                    <label for="servicedesc">Description</label>
                                      <input style="height:100px;" type="textbox" id="servicedesc" class="form-control" required="required" name="description">                              
                                  </div>
                                  <div class="form-group">

                                        <label>Display</label>
                                      <div class="id_100">
                                       
                                        <select id="display" class="selectpicker form-control display" style="font-size: 18px; width: 500px;height: 100px" name="display[]" multiple="multiple">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id}}">{{ $role['name'] }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                      <label>Notify</label>
                                      <select id="notify" class="notify form-control notify " style="font-size: 18px; width: 500px;height: 100px" name="notify[]" multiple="multiple">
                                      @foreach($roles as $role)
                                       <option value="{{ $role->id}}">{{ $role['name'] }}</option>
                                      @endforeach
                                
                                    </select>
                                </div> -->
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" id="serviceId" class="form-control" required="required" autofocus="autofocus" name="serviceId">
                            <button type="buttin" class="btn btn-primary"  id="btn-save" name ="btn-save" value="add">Save changes
                            </button>
                        </div>
                      </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteServicesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteServicesLabel">Are you sure you want to delete this ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="{{URL::to('/deleteServices')}}" name="deleteServicesModalData" method="post" class="form-horizontal" novalidate="">
                    {{ csrf_field() }} 
                    <div class="modal-body">
                    <input type="hidden" id="servicesId" name="servicesId" class="form-control" value="">
                    <input type="hidden" id="servicestatus" name="servicestatus" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>

                      <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>  
                    </div>
                  </form>
                </div>
              </div>
          </div>

            <div class="modal fade" id="deleteServicesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteServicesLabel">Are you sure you want to delete this ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="{{URL::to('/deleteServices')}}" name="deleteServicesModalData" method="post" class="form-horizontal" novalidate="">
                    {{csrf_field()}} 
                    <div class="modal-body">
                    <input type="hidden" id="servicesId" name="servicesId" class="form-control" value="">
                    <input type="hidden" id="servicestatus" name="servicestatus" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>

                      <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>  
                    </div>
                  </form>
                </div>
              </div>
          </div>



        

@endsection

@section('script')
<script>
      
  $(document).ready(function () {

              $('#serviceTable').DataTable();

              $(".selectpicker").selectpicker();

              $(".notify").selectpicker();



//      $(".deleteServices").click(function (e) {
$('body').on('click', '.deleteServices', function () {

            //alert("sample");

            var stat = $(this).text();
             var id = $(this).val();

            $('#servicesId').val(id);
            $('#servicestatus').val(stat);


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

                  $('#deleteServicesModalData').trigger("reset");
                  $('#deleteServicesModal').modal('show');


          });


      $("#btn-save").click(function (e){

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });

                 

                  var id = $('#serviceId').val();

                  var display = $("#display").val();

                  var notify = $("#notify").val();

                  console.log(display);


                   var ajaxurl = '{{URL::to("/saveservices")}}/'+id;


                   $.ajax({
                     type: "POST",
                     url: ajaxurl,
                     data: {'parent':$('#parent').val(),'servicename': $("#servicename").val(), 'servicedesc': $("#servicedesc").val(), 'display': display, 'notify': notify},
                     success: function (data) {

                              $("#servicename_"+data.id).val(data.servicename);
                              $("#serviceparent_"+data.id).val(data.parent);

                               var link = '<td id="servicename_'+data.id+'">'+data.servicename+'</td>';

                                   $('#servicename_'+data.id).replaceWith(link);

                        

                                var depart = '<td id="serviceparent_'+data.id+'">'+data.parent+'</td>';

                                  $('#serviceparent_'+data.id).replaceWith(depart);

                       },
                     error: function (data) {
                          console.log('Error:', data);
                      }

               });

                $('#EditServiceModalData').trigger("reset");
                  $('#EditServiceModal').modal('hide');

            
             



      });


   $('#EditServiceModal').on('hidden.bs.modal', function () {
        //$(this).removeData('bs.modal');
        $(this).find('form').trigger("reset");
        $(this).find('select').removeAttr('selected');
          $('#EditServiceModalData .display option').removeAttr('selected','selected');
          $('#EditServiceModalData .notify option').removeAttr('selected','selected');
          $('select[name="notify[]"]').next('.btn').attr('title', "Nothing selected");
          $('select[name="notify[]"]').next('.btn').find('div.filter-option-inner-inner').text("Nothing selected")

      });


$('body').on('click', '.editServices', function () {

                    $('#EditServiceModalData').find("input, select").val("");
                 
                 var service_id = $(this).val();

                  $('#EditServiceModalData').trigger("reset");
                  $('#EditServiceModal').modal('show');
                   
                var ajaxurl = '{{URL::to("/view/service")}}';

              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: "GET",
                url: ajaxurl,
                data: {'id': $(this).val()},
               success: function (data) {
                
              $('#EditServiceModalData li, #EditServiceModalData li a').removeClass('selected');

              $('#serviceId').val(data['service']['id']);
        
                  $serivcename = data['service']['name'];

                  $description = data['service']['description'];

                  var displaytitles = [];
                  var notifytitles = [];


                 if (data['notify'].length> 0){

                  $('#EditServiceModalData .notify option').removeAttr('selected');

                      for(var a=0; a<data['notify'].length; a++) {
                          var notifId =data['notify'][a]['role'];
                          var notifyName =data['notify'][a]['rolesx']['name'];

                        

                          $('#EditServiceModalData .notify option[value='+notifId+']').attr('selected','selected');

                          notifytitles.push(" "+notifyName);
                      }
                      $('select[name="notify[]"]').next('.btn').attr('title', notifytitles);
                      $('select[name="notify[]"]').next('.btn').find('div.filter-option-inner-inner').text(notifytitles);


                  }

                


                   if (data['display'].length> 0){ 


                    $('#EditServiceModalData .display option').removeAttr('selected');


                      for(var a=0; a<data['display'].length; a++) {

                          var displayId =data['display'][a]['role'];
                          var displayName =data['display'][a]['rolesxe']['name'];

                          //console.log(displayName);
                          $('#EditServiceModalData .display option[value='+displayId+']').attr('selected','selected');

                            displaytitles.push(" "+displayName);

                            

                      }
                         $('select[name="display[]"]').next('.btn').attr('title', displaytitles);
                  $('select[name="display[]"]').next('.btn').find('div.filter-option-inner-inner').text(displaytitles)

                  }

               
                  console.log($serivcename);
                 
                    $('#parent').val(data['service']['parent']);
                    $('#servicename').val($serivcename);
                    $('#servicedesc').val($description);
                },
               error: function (data) {
                    console.log('Error:', data);

                }


            
              });

              });



  })


  </script>
@endsection