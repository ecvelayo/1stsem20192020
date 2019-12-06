@extends('main')


@section('content')


		<div class="container">
	   <div class="row">
		
        
        <div class="col-md-12" align="center">
        <h4 style="font-family:verdana;">List of our Partners!</h4>
        <div class="table-responsive">

              <br><br>  
              <table id="mytable" class="table table-striped table-hover table-bordered" role="document">
                   
                   <thead class="black white-text">
                   
                      <th scope="col">Company Name</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Address</th>
                      <th scope="col">Contact Number</th>
                      <th scope="col">Email</th>
                      <th scope="col">Service</th>
                   </thead>
                  <tbody>

                  @foreach($result as $results)
                  <tr>
                      <td>{{$results->get("CompanyName")}}</td>
                      <td>{{$results->get("FirstName")}} {{$results->get("LastName")}}</td>
                      <td>{{$results->get("Address")}}</td>
                      <td>{{$results->get("Number")}}</td>
                      <td>{{$results->get("Email")}}</td>
                      <td>{{$results->get("Services")}}</td>
                      
                  </tr>
                  @endforeach
    
                  </tbody>
        
              </table>
          </div>
         </div>
        </div>
    </div>

    @endsection

    @section('script')


  <script type="text/javascript"> 


      $(document).ready(function () {
        $('#mytable').DataTable({
          "searching": true // false to disable search (or any other option)
        });
      $('.dataTables_length').addClass('bs-select');
      });
    


  </script>
@endsection