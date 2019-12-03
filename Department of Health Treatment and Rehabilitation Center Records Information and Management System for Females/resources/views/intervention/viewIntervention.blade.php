@extends('main')
@section('content')

      <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><a href="{{URL::to('/showIntervention')}}">Interventions</a></li>
          <li class="breadcrumb-item active">{{$interven->interven_name}}</a></li>

      </ol>
      
      <div class="row" style="margin-left: 5px;margin-bottom: 10px">
          <div class="col-xl-12 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 45px;margin-top: 0px">{{$interven->interven_name}}</p>             
              </div>
              
            </div>
          </div>
        </div>
       
          <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      </div>

  
@endsection

@section('script')

  <script type="text/javascript">

    $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
  @endsection
