@extends('main')


@section('content')


		<div class="container">
	   <div class="row">
		
        
        <div class="col-md-12" align="center">
        <div class="table-responsive">

              <br><br>  
              <table id="mytable" class="table table-bordred table-striped table-hover table-bordered">
                   
                   <thead class="black white-text">
                   
                      <th scope="col">Name</th>
                      <th scope="col">Company Name</th>
                      <th scope="col">Date of Transaction</th>
                      <th scope="col">Contact Number</th>
                      <th scope="col">Plate Number</th>
                      <th scope="col">Service</th>
                      <th scope="col">Time of Appointment</th>
                      <th scope="col">Payment Status</th>
                      <th scope="col">Status</th>
                      <th scope="col">Amount Paid</th>
                   </thead>
                  <tbody>

                  @foreach($result as $results)
                  
                    @foreach($results1 as $results3)
                      @if($results->get("FBID") == $results3->get("FBID"))

                        @foreach($results2 as $results4)
                      @if($results->get("ObjectID") == $results4->getObjectId())
                  <tr>
                      <td>{{$results3->get("FirstName")}} {{$results3->get("LastName")}}</td>
                      <td>{{$results4->get("CompanyName")}}</td>
                      <td>{{$results->get("created_at")}}</td>
                      <td>{{$results3->get("Mobile")}}</td>
                      <td>{{$results->get("CarPlateNumber")}}</td>
                      <td>{{$results->get("Service")}}</td>
                      <td>{{$results->get("Time")}}</td>
                      <td>{{$results->get("PaymentStatus")}}</td>
                      <td>{{$results->get("Status")}}</td>
                      <td>{{$results->get("Amount")}}</td>
                     
                      
                  </tr>
                  @endif
                      @endforeach
                
                  @endif
                      @endforeach

                  @endforeach
    
                  </tbody>
        
              </table>
          </div>
         </div>
        </div>
    </div>
    @endsection