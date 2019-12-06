@extends('main')


@section('content')


		<div class="container">
	   <div class="row">
		
        
        <div class="col-md-12">
        <h4>List of Company for Approval Requests</h4>
        <div class="table-responsive">
 @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
                
              
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th>Company Name</th>
                   <th>Partner ID</th>
                   <th>Fullname</th>
                     <th>Address</th>
                    
                       <th> </th>
                       <th>Action</th>
                   </thead>
                  <tbody>
                
                  @foreach($result as $results)
                  <form id="approved" action="{{URL::to('/approved')}}" method="post">
                  <tr>

                      <td>
                       <div class="custom-control custom-radio radio-primary">
                              <input type="radio" id="cname" name="cname" class="custom-control-input" value= {{$results->get("CompanyName")}} checked>
                              <label class="custom-control-label" >   {{$results->get("CompanyName")}}</label>
                          </div>
                     </td>
                     <td>
                       <div class="custom-control custom-radio radio-primary">
                              <input type="radio" id="fbid" name="fbid" class="custom-control-input" value= {{$results->getObjectId()}} checked>
                              <label class="custom-control-label" >   {{$results->getObjectId()}}</label>
                          </div>
                     </td>
                      <td>{{$results->get("FirstName")}} {{$results->get("LastName")}}</td>
                      <td>{{$results->get("Address")}}</td>
                      
                        <td><a style="font-size:14px" class="btn btn-primary btn-xs buttonModal" data-title="View" data-toggle="modal" data-id="{{$results->get('objectId')}}" data-company="{{$results->get('CompanyName')}}" data-fname="{{$results->get('FirstName')}}" data-lname="{{$results->get('LastName')}}" data-address="{{$results->get('Address')}}" data-number="{{$results->get('Number')}}" data-services="{{$results->get('Services')}}" data-email="{{$results->get('Email')}}" data-target="#viewModal" ><i class="fa fa-android"></i>View Full Details</a></td>
                    

                      <td>
                      {{csrf_field()}}
                         <button type="submit" class="btn btn-success btn-sm btn-info"  id="buttonapproved" name="buttonapproved" class="custom-control-input" value= "1">
                         <span class="glyphicon glyphicon-ok"></span></button>
                       
                         <button type="submit" class="btn btn-danger btn-sm" id="buttonapproved" name="buttonapproved" class="custom-control-input" value= "2">
                           <span class="glyphicon glyphicon-remove"></span>
                           <!--  -->
                         </button>
                          </form>
                     </div></td>




                  </tr>
        

                  @endforeach
    
                  </tbody>
        
              </table>
          </div>
         </div>
        </div>
    </div>




<div class="modal fade" id="viewModal" role="dialog" data-backdrop="false">    
  <div class="modal-dialog" style="width:1250px;" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
 
  <div class="col-md-6"></div>
<div class="col-md-8" align="center">
    
     <br class="">
     <div class="">
         <div class="panel panel-default" align="center">
             <div class="panel-heading">Coche Partner Details</div>
             <div class="panel-body" contenteditable="false">
                 <form role="form" class="">
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:400px;">
                                         <label for="company" class="">Company Name:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="company" style="display:inline;width:200px;" disabled="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="fName" class="">First Name:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="fname" style="display:inline;width:200px;" readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="lName" class="">Last Name:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="lname" style="display:inline;width:200px;" readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="address" class="">Address:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="address"  style="display:inline;width:200px;" readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="services" class="">Service offered:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="services" style="display:inline;width:200px;" readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                      <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="number" class="">Contact Number:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="number" style="display:inline;width:200px;" readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div class="form-group">
                         <table class="">
                             <tbody>
                                 <tr>
                                     <td style="width:100px;">
                                         <label for="email" class="">Email Address:</label>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" id="email" style="display:inline;width:200px;"  readonly="">
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     
             </div>
         </div>
     </div>
</div>              
  </div>
  </div>
  </div>

      

@endsection

@section('script')


  <script type="text/javascript"> 


$(document).ready(function () {

  $('body').on('click', '.buttonModal', function () {


          
          var company = $(this).attr('data-company');
          var fname =$(this).attr('data-fname');
          var lname =$(this).attr('data-lname');
          var number =$(this).attr('data-number');
          var address =$(this).attr('data-address');
          var services =$(this).attr('data-services');
          var email =$(this).attr('data-email');


          $("#company").val(company);
          $("#fname").val(fname);
          $("#lname").val(lname);
          $("#number").val(number);
          $("#address").val(address);
          $("#services").val(services);
          $("#email").val(email);

  })


    });

    


</script>
@endsection