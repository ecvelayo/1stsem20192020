<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>-->
  <script src="{{asset('vendor/fullcalendar/lib/jquery-ui.min.js')}}"></script>
  <script src="{{asset('vendor/fullcalendar/lib/moment.min.js')}}"></script>
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  
  <script src="{{asset('vendor/multi-select/js/jquery.multi-select.js')}}"></script>
 
  <!-- Page level plugin JavaScript-->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <script src="{{asset('js/sb-admin.min.js')}}"></script>

  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script>


  <script src="{{asset('js/cbpFWTabs.js')}}"></script>

    @yield('script')

    <script>
      (function() {

        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
          new CBPFWTabs( el );
        });

      })();
    </script>

  <script>
    $('#flash-overlay-modal').modal();
  </script>
    
  <script>
    $(window).on('load',function() {
      $('#loading').fadeOut('slow');
    });
  </script>

  <script>

  $('#changep').submit(function( event ) {
    event.preventDefault();
    $.ajax({
        url: '{{URL::to('/changepass')}}',
        type: 'post',
        data: $('#changep').serialize(), 
        dataType: 'json',
        success: function(data){
          if(data.res == 1){
            $('#changepassword').show();
            $('#wrong').show();
            $('#correct').hide();
          }
          else if(data.res == 0){
            $('#wrong').hide();
            $('#correct').show();

          }
          else if(data.res == 2){
            $('#changepassword').hide();
            $('#passwordsuccess').modal('show');
            setTimeout(function(){
              $('#passwordsuccess').modal('hide');
              $('.modal-backdrop').remove();
            }, 3000);
            
          }
        }
    });
  });

  $('#myform').submit(function( event ) {
    $('.loader').show();
    $('.successload').hide();
    $('.failedload').hide();
    event.preventDefault();
    $.ajax({
        url: '{{URL::to('/samplecsv')}}',
        type: 'post',
        data: $('#myform').serialize(), 
        dataType: 'json',
        success: function(data){
          $('.loader').hide();
          if(data.res == 1){
            $('.successload').hide();
            $('.failedload').show();
          }
          else if(data.res != 1){
            $('.failedload').hide();
            $('.successload').show();
            $('#reports').val(data.report);
            $('#departments').val(data.dep);
            $('#datefroms').val(data.datefrom);
            $('#datetos').val(data.dateto);
            $('#months').val(data.month);
            $('#years').val(data.year);
            console.log(data.cout);
          }
        }
    });
  });

  $(document).ready(function(){  

    $('#getChecklist2').on('hidden.bs.modal', function(e)
    {
      $(this).remove('#sampleTable');
    });

      $('.details').click(function(){

          $.ajaxSetup({
              headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

           var listid = $(this).data('checklistid');
           var patid = $(this).data('patientid'); 
           var depid = $(this).data('depid'); 

           $.ajax({  
                url: '{{URL::to("/getlist")}}',  
                type: 'get',  
                dataType: 'json',
                data: {'id': listid,
                       'patientid': patid,
                       'depid': depid},  
                success:function(data){

                    $('#table2').show();
                    $('#table2').html(data);
                    $('#table1').hide();
                  

                }

           });
      });  

 });  

</script>

<script>

  function myFunction() {
        $('#table2').hide();
        $('#table1').show();
      }

</script>

</script>

  <script type="text/javascript">  

      $('#editModal').on('hidden.bs.modal', function () {
        //$(this).removeData('bs.modal');

          $('#editModal .depart option').removeAttr('selected','selected');
          $('select[name="depart[]"]').next('.btn').attr('title', "Nothing selected");
          $('select[name="depart[]"]').next('.btn').find('div.filter-option-inner-inner').text("Nothing selected")

      });

  $('#editModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var userid = button.data('userid')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var username = button.data('uname')
    var email = button.data('email')
    var contact = button.data('contact')
    var department = button.data('department')
    var password = button.data('password')
    var designation = button.data('designation')
    var modal = $(this)

                  var notifytitles = [];

                var ajaxurl = '{{URL::to("/editEmployeeDepartment")}}/'+ userid;

              $.ajax({
                type: "GET",
                url: ajaxurl,
               success: function (data) {  

                    if (data.length> 0){

                             $('#editModal li, #editModal li a').removeClass('selected');
                        for(var i=0; i<data.length; i++){


                                  $('#editModal .depart option[value='+data[i].department_id+']').attr('selected','selected');

                                  notifytitles.push(" "+data[i].departmentsc.department_name+" department");

                        }

                    }

                      $('select[name="depart[]"]').next('.btn').attr('title',notifytitles);
                      $('select[name="depart[]"]').next('.btn').find('div.filter-option-inner-inner').text(notifytitles);

               },
               error: function (data) {
                    console.log('Error:', data);

                }
               });

    modal.find('.modal-body #userid').val(userid);
    modal.find('.modal-body #fname').val(fname);
    modal.find('.modal-body #lname').val(lname);
    modal.find('.modal-body #username').val(username);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #contact').val(contact);
    modal.find('.modal-body #department').val(department);
    modal.find('.modal-body #password').val(password);
    modal.find('.modal-body #designation').val(designation);

             // $(".modal-body designation[value="+designation"]").prop("selected", true);


  })

   $('#editemployeeModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var userid = button.data('userid')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var mname = button.data('mname')
    var email = button.data('email')
    var contact = button.data('contact')
    var designation = button.data('designation')
    var department = button.data('department')
    var modal = $(this)

    modal.find('.modal-body #userid').val(userid);
    modal.find('.modal-body #fname').val(fname);
    modal.find('.modal-body #lname').val(lname);
    modal.find('.modal-body #mname').val(mname);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #contact').val(contact);
    modal.find('.modal-body #designation').val(designation);
    modal.find('.modal-body #department').val(department);
  })

  $('#uploadList').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var checklistid = button.data('checklistid')
    var checklistname = button.data('checklistname')
    var patientid = button.data('patientid')
    var departmentid = button.data('departmentid')
    var modal = $(this)


    modal.find('.modal-body #checklistid').val(checklistid);
    modal.find('.modal-body #checklistname').val(checklistname);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #departmentid').val(departmentid);
    $('#listle').html(checklistname);
  })

  $('#deleteFile').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var fileid = button.data('fileid')
    var modal = $(this)


    modal.find('.modal-body #fileid').val(fileid);

  })

  $('#deleteModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var user_id = button.data('userid')
    var modal = $(this)

    modal.find('.modal-body #user_id').val(user_id);
  })

  $('#deleteemployeeModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var employee_id = button.data('employee_id')
    var modal = $(this)

    modal.find('.modal-body #employee_id').val(employee_id);
  })

  $('#deleteCity').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var cityid = button.data('cityid')
    var modal = $(this)

    modal.find('.modal-body #cityid').val(cityid);
  })

  $('#updateCity').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var cityid = button.data('cityid')
    var cityname = button.data('cityname')
    var modal = $(this)

    modal.find('.modal-body #cityid').val(cityid);
    modal.find('.modal-body #cityname').val(cityname);
  })

  $('#activateCity').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var cityid = button.data('cityid')
    var modal = $(this)

    modal.find('.modal-body #cityid').val(cityid);
  })

  $('#deleteStat').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var statid = button.data('statid')
    var modal = $(this)

    modal.find('.modal-body #statid').val(statid);
  })

  $('#updateStat').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var statid = button.data('statid')
    var statname = button.data('statname')
    var modal = $(this)

    modal.find('.modal-body #statid').val(statid);
    modal.find('.modal-body #statname').val(statname);
  })

  $('#activateStat').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var statid = button.data('statid')
    var modal = $(this)

    modal.find('.modal-body #statid').val(statid);
  })

  $('#deleteGender').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var gendid = button.data('gendid')
    var modal = $(this)

    modal.find('.modal-body #gendid').val(gendid);
  })

  $('#updateGender').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var gendid = button.data('gendid')
    var gendname = button.data('gendname')
    var modal = $(this)

    modal.find('.modal-body #gendid').val(gendid);
    modal.find('.modal-body #gendname').val(gendname);
  })

  $('#activateGender').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var gendid = button.data('gendid')
    var modal = $(this)

    modal.find('.modal-body #gendid').val(gendid);
  })

  $('#deleteDab').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var dabid = button.data('dabid')
    var modal = $(this)

    modal.find('.modal-body #dabid').val(dabid);
  })

  $('#updateDab').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var dabid = button.data('dabid')
    var dabname = button.data('dabname')
    var modal = $(this)

    modal.find('.modal-body #dabid').val(dabid);
    modal.find('.modal-body #dabname').val(dabname);
  })

  $('#activateDab').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var dabid = button.data('dabid')
    var modal = $(this)

    modal.find('.modal-body #dabid').val(dabid);
  })

  $('#deleteEdu').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var eduid = button.data('eduid')
    var modal = $(this)

    modal.find('.modal-body #eduid').val(eduid);
  })

  $('#updateEdu').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var eduid = button.data('eduid')
    var eduname = button.data('eduname')
    var modal = $(this)

    modal.find('.modal-body #eduid').val(eduid);
    modal.find('.modal-body #eduname').val(eduname);
  })

  $('#activateEdu').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var eduid = button.data('eduid')
    var modal = $(this)

    modal.find('.modal-body #eduid').val(eduid);
  })

  $('#deleteEm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var emstatid = button.data('emstatid')
    var modal = $(this)

    modal.find('.modal-body #emstatid').val(emstatid);
  })

  $('#updateEm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var emstatid = button.data('emstatid')
    var emstatname = button.data('emstatname')
    var modal = $(this)

    modal.find('.modal-body #emstatid').val(emstatid);
    modal.find('.modal-body #emstatname').val(emstatname);
  })

  $('#activateEm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var emstatid = button.data('emstatid')
    var modal = $(this)

    modal.find('.modal-body #emstatid').val(emstatid);
  })

  $('#deleteJail').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var jailid = button.data('jailid')
    var modal = $(this)

    modal.find('.modal-body #jailid').val(jailid);
  })

  $('#updateJail').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var jailid = button.data('jailid')
    var jailname = button.data('jailname')
    var modal = $(this)

    modal.find('.modal-body #jailid').val(jailid);
    modal.find('.modal-body #jailname').val(jailname);
  })

  $('#activateJail').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var jailid = button.data('jailid')
    var modal = $(this)

    modal.find('.modal-body #jailid').val(jailid);
  })

  $('#deleteList').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var listid = button.data('listid')
    var modal = $(this)

    modal.find('.modal-body #listid').val(listid);
  })

  $('#updateList').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var listid = button.data('listid')
    var listname = button.data('listname')
    var modal = $(this)

    modal.find('.modal-body #listid').val(listid);
    modal.find('.modal-body #listname').val(listname);
  })

  $('#activateList').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var listid = button.data('listid')
    var modal = $(this)

    modal.find('.modal-body #listid').val(listid);
  })


  $('#deleteReason').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var reasonid = button.data('reasonid')
    var modal = $(this)

    modal.find('.modal-body #reasonid').val(reasonid);
  })

  $('#updateReason').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var reasid = button.data('reasid')
    var reasname = button.data('reasname')
    var modal = $(this)

    modal.find('.modal-body #reasid').val(reasid);
    modal.find('.modal-body #reasname').val(reasname);
  })

  $('#activateReason').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var reasonid = button.data('reasonid')
    var modal = $(this)

    modal.find('.modal-body #reasonid').val(reasonid);
  })

  $('#deleteCase').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var caseid = button.data('caseid')
    var modal = $(this)

    modal.find('.modal-body #caseid').val(caseid);
  })

  $('#updateCase').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var caseid = button.data('caseid')
    var casename = button.data('casename')
    var textbox = button.data('textbox')
    var modal = $(this)

    modal.find('.modal-body #caseid').val(caseid);
    modal.find('.modal-body #casename').val(casename);

      if(textbox == 1){
        document.getElementById("yescourt").checked = true;
      }
      else{
        document.getElementById("nocourt").checked = true;
      }
  })

  $('#activateCase').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var caseid = button.data('caseid')
    var modal = $(this)

    modal.find('.modal-body #caseid').val(caseid);
  })

  $('#deleteRole').on('show.bs.modal', function (event) {

    var a = $(event.relatedTarget)

    var role = a.data('role')
    var modal = $(this)

    modal.find('.modal-body #role').val(role);
  })

  $('#deletePatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
  })

  $('#patientDismiss').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var patientdep = button.data('patientdep')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#transferPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#admintransferPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#adminreenrollPatient').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#adminreenrollForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var depid = button.data('depid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #department').val(depid);
  })

  $('#intakeForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var department = $('#adminreenrollForm #department').val().trim();
    var modal = $(this);

    modal.find('.container #department').val(department);
  })

  $('#ddeForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var department = $('#adminreenrollForm #department').val().trim();
    var modal = $(this);

    modal.find('.container #department').val(department);
  })

  $('#changepass').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#editModal #userid").val().trim();

    var userid = $('#editModal #userid').val().trim();
    var modal = $(this);

    modal.find('.modal-body #userid').val(userid);
  })

  $('#transferReferral').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#transferPatient #patientid").val().trim();
  
    var depid = button.data('depid');
    var patientid = $('#transferPatient #patientid').val().trim();
    var patientdep = $('#transferPatient #patientdep').val().trim();
    var modal = $(this);

    modal.find('.modal-body #depid').val(depid);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#deptransferReferral').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#transferPatient #patientid").val().trim();
  
    var depid = button.data('depid');
    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');

    var modal = $(this);

    modal.find('.modal-body #depid').val(depid);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

   $('#admintransferReferral').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var button1 = $("#transferPatient #patientid").val().trim();
  
    var depid = button.data('depid');
    var patientid = $('#admintransferPatient #patientid').val().trim();
    var patientdep = $('#admintransferPatient #patientdep').val().trim();
    var modal = $(this);

    modal.find('.modal-body #depid').val(depid);
    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientGraduate').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientadminGraduate').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

  $('#patientadminReenroll').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
  })

   $('#patientReenroll').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var patientdep = button.data('patientdep');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-footer #patient_id').val(patientid);
    modal.find('.modal-body #patientdep').val(patientdep);
  })

   $('#reenrollForm').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var patientid = button.data('patientid');
    var modal = $(this);

    modal.find('.modal-body #patientid').val(patientid);
  })

    $('#addNotes').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var patientid = button.data('patientid')
    var doctorid = button.data('doctorid')
    var modal = $(this)

    modal.find('.modal-body #patientid').val(patientid);
    modal.find('.modal-body #doctorid').val(doctorid);
  })

  $(function() {
  $('input[name="casetype"]').on('click', function(){

    if ($(this).val() == 'New Case') {
      document.getElementById("casetype").disabled = true;
      $('#textboxes').hide();
    }
    else if ($(this).val() == 'Old Case'){
      document.getElementById("casetype").disabled = true;
      $('#textboxes').hide();
    }
    else if($(this).val() == 'With Court Case'){
      document.getElementById("casetype").disabled = false;
      $('#textboxes').show();
     }
    });
  });


  $(function() {
  $('input[name="type"]').on('click', function(){

    if ($(this).val() == 'Voluntary Submission') {
      document.getElementById("type").disabled = true;
      $('#textbox').hide();
    }
    else if ($(this).val() == 'Compulsory Submission'){
      document.getElementById("type").disabled = true;
      $('#textbox').hide();
    }
    else if($(this).val() == 'Others'){
      document.getElementById("type").disabled = false;
      $('#textbox').show();
     }
    });
  });

  $(function() {
  $('select[id="dismissal"]').on('click', function(){

    if ($(this).val() == 'Others') {
      document.getElementById("remarks").disabled = false;
      $('#text').show();
    }
    else{
      document.getElementById("remarks").disabled = true;
      $('#text').hide();
    }

    });
  });

  $(function() {
  $('select[id="designation"]').on('click', function(){

    if ($(this).val() == 'Others') {
      document.getElementById("designat").disabled = false;
      $('#design').show();
    }
    else{
      document.getElementById("designat").disabled = true;
      $('#design').hide();
    }

    });
  });

   $(function() {
  $('select[id="ptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("caseno").disabled = false;
      document.getElementById("jail").disabled = false;
      $('#textas').show();
      $('#textb').show();
    }
    else{
      document.getElementById("caseno").disabled = true;
      document.getElementById("jail").disabled = true;
      $('#textas').hide();
      $('#textb').hide();
    }

    });
  });

   $(function() {
  $('select[id="sptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("scaseno").disabled = false;
      document.getElementById("sjail").disabled = false;
      $('#stextas').show();
      $('#stextb').show();
    }
    else{
      document.getElementById("scaseno").disabled = true;
      document.getElementById("sjail").disabled = true;
      $('#stextas').hide();
      $('#stextb').hide();
    }

    });
  });

   $(function() {
  $('select[id="patype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("caseno").disabled = false;
      document.getElementById("jail").disabled = false;
      $('#textes').show();
      $('#textc').show();
    }
    else{
      document.getElementById("caseno").disabled = true;
      document.getElementById("jail").disabled = true;
      $('#textes').hide();
      $('#textc').hide();
    }

    });
  });

$(function() {
  $('select[id="ddeptype"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("ddecaseno").disabled = false;
      document.getElementById("ddejail").disabled = false;
      $('#ddetextas').show();
      $('#ddetextb').show();
    }
    else{
      document.getElementById("ddecaseno").disabled = true;
      document.getElementById("ddejail").disabled = true;
      $('#ddetextas').hide();
      $('#ddetextb').hide();
    }

    });
  });

$(function() {
  $('select[id="ddes"]').on('click', function(){

    if ($(this).children(":selected").attr("id") == '1') {
      document.getElementById("ddecas").disabled = false;
      document.getElementById("ddejs").disabled = false;
      $('#ddets').show();
      $('#ddetes').show();
    }
    else{
      document.getElementById("ddecas").disabled = true;
      document.getElementById("ddejs").disabled = true;
      $('#ddets').hide();
      $('#ddetes').hide();
    }

    });
  });

$(function() {
  $('select[id="parentlist"]').on('click', function(){

    if ($(this).children(":selected").attr("value") != 0) {
      document.getElementById("sublist").disabled = true;
      $('#sublist').show();
    }
    else{
      document.getElementById("sublist").disabled = false;
      $('#sublist').hide();
    }

    });
  });

$(function() {
  $('select[id="report"]').on('click', function(){

  if ($(this).children(":selected").attr("value") == 'Status Report') {
      var len = document.getElementById("department").getElementsByTagName("option");
      for (var i = 0; i < len.length; i++) {
        if (len[i].value != 3) {
          len[i].disabled = true;
        }
        else{
          document.getElementById("department").selectedIndex = 3;
        }
      }
    }
    else{
      var len = document.getElementById("department").getElementsByTagName("option");
      for (var i = 0; i < len.length; i++) {
          len[i].disabled = false;
      }
    }
  });
});

$(function() {
  $('select[id="report"]').on('click', function(){

  if ($(this).children(":selected").attr("value") == 'Accomplishment Report') {
      $('#depsa').hide();
      document.getElementById("datefrom").disabled = true;
      document.getElementById("dateto").disabled = true;
      document.getElementById("department").disabled = true;
      document.getElementById("month").disabled = false;
      document.getElementById("year").disabled = false;
      document.getElementById("mon").hidden = false;
      document.getElementById("yea").hidden = false;
      $('#datef').hide();
      $('#datet').hide();
      $('#depsa').hide();

  }
  else{
      document.getElementById("datefrom").disabled = false;
      document.getElementById("dateto").disabled = false;
      document.getElementById("department").disabled = false;
      document.getElementById("month").disabled = true;
      document.getElementById("year").disabled = true;
      document.getElementById("mon").hidden = true;
      document.getElementById("yea").hidden = true;
      $('#datef').show();
      $('#datet').show();
      $('#depsa').show();
  }
 
  });
});


$(function() {
  $('select[id="report"]').on('click', function(){

  if ($(this).children(":selected").attr("value") == 'Plea Bargain') {
      $('#depsa').hide();
      document.getElementById("datefrom").disabled = true;
      document.getElementById("dateto").disabled = true;
      document.getElementById("department").disabled = true;
      document.getElementById("month").disabled = false;
      document.getElementById("year").disabled = false;
      document.getElementById("mon").hidden = false;
      document.getElementById("yea").hidden = false;
      $('#datef').hide();
      $('#datet').hide();
      $('#depsa').hide();

  }
  else if ($(this).children(":selected").attr("value") == 'Accomplishment Report') {
      $('#depsa').hide();
      document.getElementById("datefrom").disabled = true;
      document.getElementById("dateto").disabled = true;
      document.getElementById("department").disabled = true;
      document.getElementById("month").disabled = false;
      document.getElementById("year").disabled = false;
      document.getElementById("mon").hidden = false;
      document.getElementById("yea").hidden = false;
      $('#datef').hide();
      $('#datet').hide();
      $('#depsa').hide();

  }
  else{
      document.getElementById("datefrom").disabled = false;
      document.getElementById("dateto").disabled = false;
      document.getElementById("department").disabled = false;
      document.getElementById("month").disabled = true;
      document.getElementById("year").disabled = true;
      document.getElementById("mon").hidden = true;
      document.getElementById("yea").hidden = true;
      $('#datef').show();
      $('#datet').show();
      $('#depsa').show();
  }
 
  });
});

  
</script>