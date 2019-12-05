@extends('main')

@section('style')

<style type="text/css">
.dataTables tbody tr {
    min-height: 20px; /* or whatever height you need to make them all consistent */
}
input.largerCheckbox
{
width: 30px;
height: 30px;
}

button.btn.add::before {
  font-family: fontAwesome;
  background-image: url();
}

.custom-control-label::before, 
.custom-control-label::after {
top: .30rem;
width: 15rem;
height: 15rem;
}

select
{
  margin-left:auto;
    margin-right:auto;

    width: 400px;
    background: #D2E9FF;
    padding: 10px 5px 5px 5px;
    font: 14px Arial, Helvetica, sans-serif;
    color: #666;
}

.bootstrap-select.btn-group {width: auto !important;}
</style>

@endsection
@section('content')

        <!-- Breadcrumbs-->
        
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-calendar"></i>
          @if($evt->status == 2)
          {{$evt->title}} (Cancelled)
          @else
          {{$evt->title}}
          @endif

          </li>
        @if($isEventCancelled)
         <button class="btn btn-success edit-event" style="margin-left: 10px;margin-left:250px;height: 60px;width: 90px;margin-top: 10px">Edit</button><button class="btn btn-danger cancel-event" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" name="cancel-event" id="cancel-event">Cancel</button>
            @endif
        </ol> 
        
      <div class="container">
        <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
          <div class="container" style="margin-left: 10px">
            <div class="row">
              <div class="col-md-3">
                 <input type="text" id="event_id" class="form-control" placeholder="End Date" name="event_id" value='{{$evt->id}}' hidden="hidden">
                <p style="font-size: 15px"> <h5>Venue:</h5>{{$evt->venue}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Start Date:</h5> {{$evt->start_date}}</p>
              </div>
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>End Date:</h5> {{$evt->end_date}}</p>
              </div>
               <div class="col-md-2">
                <p style="font-size: 15px"><h5>Start Time:</h5> {{$evt->start_time}}</p>
              </div>
               <div class="col-md-2">
                <p style="font-size: 15px"><h5>End Time:</h5><span id="datetime">{{$evt->end_time}}</span></p>
              </div>
          </div>
      </fieldset>


         <div class="form-group">
                  <div class='form-row'>
                      <div class="col-md-12">
                              <div class="container">
                                  <div class="row">
                                      <div class="col-md-12 col-md-offset-3" >
                                      <center>
                                      <div class="col-md-12">
                                      <div class="form-group">
                                        
                                          <select class="selectpicker form-control col-md-6" id="patientList"  name="patientList"data-live-search-placeholder="Search" data-live-search="true" title="Select a Patient" data-hide-disabled="true">
                                          @foreach($patients as $pats_Evt)
                                            <option value="{{$pats_Evt->id}}">{{ $pats_Evt->lname }}, {{ $pats_Evt->fname }}</option>
                                          @endforeach
                                          </select>
                                          <button class="btn btn-success add_patient col-md-1">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                                          </div>
                                      </div>

                                        </center>

                                        <table class="table table-hover table-striped table-bordered" id="dataTable">
                                          <thead>
                                            <tr>
                                              <th height="20px">Name</th>
                                              <th>Date Last Visited</th>
                                              <th>Contact Number</th>
                                              <th>Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                @foreach($pats as $patients)
                                          <tr id="patient{{$patients->id}}">
                                             <td height="15" style="height: 15px !important;"><a> {{ $patients->patients->lname }}, {{ $patients->patients->fname }}</a></td>
                                             <td height="15px"><a>{{ $patients->patients->department_id}}</a></td>
                                             <td height="20"><a>{{ $patients->patients->contact}}</a></td>
                                             <td>
                                            @if($isEventExpired)
                                            <button class="btn btn-info  open-modal" value="{{$patients->patient_id}}" data-id="{{$patients->id}}"><i class="far fa-calendar-check" aria-hidden="true"></i></button>
                                            @endif

                                              @if($isPatientRemove)
                                            <button class="btn btn-danger delete_link" value="{{$patients->id}}" data-name="{{ $patients->patients->lname }}, {{ $patients->patients->fname }}"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            @endif
                                              </td>

                                             </tr>
                                          @endforeach
                                          </tbody>
                                      </table>
                                    </div> 
                                </div>
                              </div>
                  
                            </div>
                          </div>
                  </div>

            <div class="modal fade" id="linkEditor" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content"  style="width:980px;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Add Intervention the Patient Attended</h4>
                        </div>
                        <div class="modal-body">
                            <form id="linkeditor_Data" name="linkeditor_Data" class="form-horizontal" novalidate="">

                                @foreach($intv as $interven)
                                  <div>
                                    <input type="hidden" name="rec_id_{{$interven->id}}" id="rec_id_{{$interven->id}}" value="">
                                    <div class="checkboxs" id="checkboxes_{{$interven->id}}">
                                      <label><input type="checkbox" class="checkitems" id="checkitem[]" name="checkitem[]" style="zoom:1.5;font-size: 28px;"  value="{{$interven->id}}">{{$interven->interven_name}}</label>
                                    </div>

                                  @foreach($childIntervens->groupby('parent') as  $name => $member)

                                    @if($name  == $interven->id)

                                <div class="form-label-group select1" id="select_{{$interven->id}}" name="select_{{$interven->id}}"  style="display: none;">

                                  <select class="form-control col-md-6" id="childInterven_{{$interven->id}}"  name="childInterven_{{$interven->id}}" style=" margin-bottom: 10px">
                                    @foreach($member as $item)
                                      <option value="{{ $item['id']}}">{{  $item['interven_name'] }}</option>
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
                            <input type="hidden" id="evts_id" name="evts_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">


                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="EventEditor" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content" style="width:580px;">
                          <div class="modal-header">
                            <h4 class="modal-title" id="EventEditorModalLabel">Edit Event</h4>
                        </div>

                  <form action="{{URL::to('/event_save_edit')}}" method="post" >
                    {{csrf_field()}} 
                        <div class="modal-body">

                            <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-2">
                                  <h6>Title:</h6>
                              </div>
                              <div class="col-md-10">
                                  <input type="text" id="title" class="form-control" placeholder="Title" required="required" name="title" value="{{$evt->title}}">
                              </div>
                              </div>
                          </div>
                          <div class="form-group">
                          <div class="form-row">
                              <div class="col-md-2">
                                  <h6>Venue:</h6>
                              </div>
                              <div class="col-md-10">
                                  <input type="text" id="venue" class="form-control" placeholder="Venue" required="required" name="venue" value="{{$evt->venue}}">
                              </div>
                            </div>
                          </div>
                              <div class="form-group">
                              <div class="form-row">
                              <div class="col-md-2">
                                  <h6>Start Date:</h6>
                              </div>
                              <div class="col-md-4">
                                  <input type="date" id="start" class="form-control" placeholder="start" required="required" name="start" value="{{$evt->start_date}}">
                              </div>
                             
                              <div class="col-md-2">
                                  <h6>Start Time:</h6>
                              </div>
                              <div class="col-md-4">
                                  <input type="time" id="start_time" class="form-control" placeholder="Start Time" required="required" name="time" value="{{$evt->start_time}}">
                              </div>
                              </div>
                            </div>
                             <div class="form-group">
                              <div class="form-row">
                              <div class="col-md-2">
                                  <h6>End Date:</h6>
                              </div>
                              <div class="col-md-4">
                                  <input type="date" id="end" class="form-control" placeholder="start" required="required" name="end" value="{{$evt->end_date}}">
                              </div>
                            
                              <div class="col-md-2">
                                  <h6>End Time:</h6>
                              </div>
                              <div class="col-md-4">
                                  <input type="time" id="end_time" class="form-control" placeholder="End Time" required="required" name="end_time" value="{{$evt->start_time}}">
                              </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>

                        </div>
                    </form>

                    </div>
                </div>
            </div>
          </div>

@endsection


@section('script')

  <script type="text/javascript">



   $(document).ready(function () { 

  $(".selectpicker").selectpicker();

   $('#linkEditor').on('hidden.bs.modal', function () {
        //$(this).removeData('bs.modal');
        console.log('hide');
        $(this).find('form').trigger("reset")
      });

          $('body').on('click', '.open-modal', function () {
              var evt_id = $('#event_id').val();
              $('#evts_id').val(evt_id);
              $('#patient_interven_id').val($(this).val());
              $('#btn-save').val("add");
              $('#modalFormData').trigger("reset");
              $('#linkEditor').modal('show');

          var type = "GET";
          var ajaxurl = '{{URL::to("/view/vieweventattended")}}';
          var data = [{'event_id': evt_id, 'patient_id': $(this).val()}]
              $.ajax({
                contentType: "application/json; charset=utf-8",
                type: type,
                url: ajaxurl,
                data: {'event_id': evt_id, 'patient_id': $(this).val()},
               // dataType: 'json',
                success: function (data) {
                 
                  if (data.length > 0){ console.log(data);
                    for(var a=0; a<data.length; a++) {
                      var interven_id = data[a]['interven_id'];
                      var remarks = data[a]['remarks'];
                      var id = data[a]['id'];

                      //console.log(interven_id);
                      $("input[value=" + interven_id + "]").click();
                      $("input[name=remarks_" + interven_id + "]").val(remarks);
                      $("input[name=rec_id_" + interven_id + "]").val(id);
                    }

                      //
                  } else{
                    $('#modalFormData').trigger("reset");
                    $('#linkEditor').modal('show');
                  }
                   
                },
               error: function (data) {
                    console.log('Error:', data);
                }

            });

          });

           $('body').on('click', '.edit-event', function () {

              $('#EventEditor').modal('show');
          });


     $('#cancel-event').click(function () {
       
            var result = confirm('Your are about to cancel this event. Would you like to continue?');
    
            if(result == true){

              var id = $('#event_id').val();

                var base = '{{ URL::to('/cancel_event') }}'+'/'+id;

                window.location.href=base;
            }else{
              
            }

    });

     $('#linkEditor').on('hidden.bs.modal', function () {

              $('.textboxes').hide();
              $('.select1').hide();


  
    })

    $('#btn-attended').click(function(e){

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });
        e.preventDefault();
      var patient_inter = $('#patient_interven_id').val();
      var events = $('#evts_id').val();
      

      var details = {};

      var eventArr = [];

      console.log()
        var length = $("input[type=checkbox]").each(function(){
              var isChecked = $(this).is(':checked');
              var event = {};
              var value = $(this).val();
              event['isChecked'] = isChecked;
              event['rec_id'] = $('#rec_id_'+value).val();
              event['child_interven_id'] =  $('#childInterven_'+value).val();;
              event['patient_id'] = patient_inter;
              event['interven_id'] = value;
              event['event_id'] = events;
              event['remarks'] = $('#remarks_'+value).val();

              eventArr.push(event);
        });

       var type = "POST";
        var ajaxurl = '{{URL::to("/patient/attendIntervention")}}';
         $.ajax({
            contentType: "application/json; charset=utf-8",
            type: type,
            url: ajaxurl,
            data: JSON.stringify(eventArr),
            success: function (data) {
                $('#modalFormData').trigger("reset");
                $('#linkEditor').modal('hide');
               
            },
           error: function (data) {
                console.log('Error:', data);
            }

        });

    });

     $('.add_patient').click(function(e){


         var patient = $('#patientList').val();

         if(patient == ''){

              alert('add patient is required');
         }else {
            // remove from select
            $('#patientList option:selected').remove();
            $('#patientList').siblings('.dropdown-menu').find('ul.dropdown-menu.inner.show > .selected').remove();
            $('#patientList').siblings('button').find('.filter-option-inner-inner').text('Select a patient');
         }

         var event_id = $('#event_id').val();

         var selectedVal = $('select option:selected').text();

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
        });
        e.preventDefault();
         var formData = {
            event_id: event_id,
            patient_id: patient,
            status: 1
         }

        var type = "POST";
        var ajaxurl = '{{URL::to("/view/addpatient")}}';

         $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

              console.log(data);

                 var link = '<tr id="patient' + data[0].id + '"><td>' + data.ref_date + '</td><td>' + + '</td><td>' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>';
                link += '<button class="btn btn-secondary delete-link" id="btn-accept" name ="btn-accept" value="' + data.id + '">Accept</button>';
                 link += '<button class="btn btn-light print-link" id="btn-ptint" name ="btn-print" value="' + data.id + '">Print</button>';

                    $('#links-list').append(link);
                alert('successfully added');
               
            },
           error: function (data) {
                console.log('Error:', data);
            }

        });
     })


    $('.delete_link').click(function () {
    var result = confirm('Your are about to remove this patient in the list. Would you like to continue?');
    // "<li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class="text">Tinapay, Mikay</span></a></li>"
    if(result == true){
        var patient_name = $(this).data('name');
        var patient_id = $(this).val();
          
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

// console.log(patient_name);
// $('button.dropdown-toggle').click();

// $('#patientList').append('<option value="' + patient_id + '">' + patient_name + '</option>');

// $('#patientList').siblings('.dropdown-menu').find('ul.dropdown-menu.inner.show').append('<li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class="text">' + patient_name + '</span></a></li>');
//  //$('#patientList').trigger('click');
           
       ajaxurl = '{{URL::to("delete/patient")}}'+ '/' + patient_id;
        $.ajax({
            type: "DELETE",
            url: ajaxurl,
            success: function (data) {
                $("#patient" +  patient_id).remove();

                location.reload();
                // console.log("delete");
                // $('#patientList').siblings('.dropdown-menu').find('ul.dropdown-menu.inner.show').append('<li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class="text">' + patient_name + '</span></a></li>');

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

      }

    })
    
 
           $("input[type='checkbox']").click(function (e) {
            var id = $(this).val();
            if ($(this).is(':checked')) {
              $("#textboxes_" + id).show();
              $("#select_" + id).show();

            } else {
              $("#textboxes_" + id).hide();
               $("#select_" + id).hide();
            }
        
           })
      

    });
  </script>  

@endsection
