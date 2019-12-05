   @extends('main')
@section('content')


   <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/showIntervention')}}">Intervention</a>
          </li>
          <li class="breadcrumb-item active">Intervention Creation</li>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
    <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-header">Create Intervention</div>
      <div class="card-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <form action="{{URL::to('/create_intervention')}}" method="post">
          {{csrf_field()}}

          <!--   <div class="form-group">         
                  <div class="form-label-group">
                    <h6>Parent Intervention</h6>
                   <select class="form-control parent" id="parent" placeholder="Civil Status" name="parent">
                        <option value="0">--NONE--</option>
                       @foreach($inter as $interven)
                          <option value="{{ $interven->id }}">{{ $interven->interven_name}}</option>
                        @endforeach
                  </select>
                  </div>
                </div> -->
             <div class="form-group">
                  <div class="form-label-group">
                    <h6>Name</h6>
                      <input type="text" id="interven_name" class="form-control" placeholder="Name" required="required" name="interven_name">
                  </div>
                </div>
                <div class="form-group depts">
                <div class="form-label-group">
                  <h6>Department</h6>
                 <select class="form-control department" id="department" placeholder="Department" name="department" required="required">
                  <label for="department">Department</label>
                  @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                  @endforeach
                </select>
                </div>
              </div>
             <div class="form-group">
            <div class="form-label-group">
               <h6>Description</h6>
              <input style="height:100px;" type="textbox" id="descrpt" class="form-control" placeholder="Description" required="required" name="descrpt">
            </div>
          </div>

           <input class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
        </form>
      </div>
    </div> 
  </div>

@endsection

@section('script')
<script>
      
  $(document).ready(function () {

      $('.parent').change(function() {

          var parentVal = $(this).val();

            if(parentVal != 0){

                $('.depts').hide(); 
                $('.department').removeAttr('required');    


            }
            else{

              $('.depts').show();
              $('.department').prop('required',true);   


            }


      });

  })

</script>

@endsection
