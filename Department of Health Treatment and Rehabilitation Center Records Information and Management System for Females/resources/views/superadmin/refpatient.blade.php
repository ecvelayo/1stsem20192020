@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard<b></a>
          </li>
          <li class="breadcrumb-item active"><b>Patient Referral</b></li>
        </ol>

        <!-- Icon Cards-->
    <div class="container border border-dark">
        <form action="{{URL::to('/registernow')}}" method="post">
          {{csrf_field()}}
              <div class="form-group" style="margin-top: 20px">
                <div class="form-label-group">
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="fname">
                  <label for="fname">Referred by</label>
                </div>
              </div>
              <div class="card card-register mx-auto mt-4" style="margin-bottom: 20px">
              <div class="card-header">Accompanied by/Informant</div>
              <div class="card-body">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" name="lname">
                      <label for="lname">Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" name="lname">
                      <label for="lname">Contact no.</label>
                    </div>
                  </div>
              </div>
            </div>
               <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" name="lname">
                  <label for="lname">Address</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="username" class="form-control" placeholder="Drugs Abused (Present)" required="required" autofocus="autofocus" name="username">
                  <label for="username">Drugs Abused (Present)</label>
                </div>
              </div>
              <div class="col-md-6">
              <div class="form-label-group">
                  <input type="password" id="password" class="form-control" placeholder="Password" required="required" name="password">
                  <label for="password">Chief Complaint</label>
              </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <textarea type="email" id="email" class="form-control" placeholder="History of Present Illness" required="required" name="email"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <textarea style="height: 120px"type="text" id="contact" class="form-control" placeholder="History of Drug Used" required="required" name="contact"></textarea>
              </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <textarea style="height:200px" type="text" id="contact" class="form-control" placeholder="Family/Personal History" required="required" name="contact"></textarea>
              </div>
          </div>
           <input style="width:200px;float:right;margin-top: 10px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create"><input style="width:200px;float:right;margin-right: 10px;margin-top: 10px" class="btn btn-primary btn-block" type="submit" name="submit" value="Back">
        </form>
      </div>

@endsection
