<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top" style="margin-bottom: 40px">
      <a class="navbar-brand mr-1" href="{{URL::to('/profile')}}" style="height:100px;padding-top: 0px">
          <div style="background-color: #343a40;margin-left: 10px;padding:15px;border-radius: 100px">
            <img style="height:100px" src="{{asset('images/logo3.png')}}">
          </div>
      </a> 
  <ul class="navbar-nav"> 
        <a class="nav-link" href="{{URL::to('/profile')}}" style="color:white">
         <span><b>Treatment and Rehabilitation Center for Females</b></span>
        </a>
 
    <li class="nav-item" style="margin-left: 300px">
        <a class="nav-link" href="{{URL::to('/profile')}}">
          <span><i class="fas fa-fw fa-tachometer-alt"></i>
          <b>Dashboard</b></span>
        </a>
      </li>
       <li class="nav-item dropdown">
        <?php $enrolled = 'Enrolled'; $for = 'For Graduate'; $fort = 'For Transfer'; $grad = 'Graduated'; $dis = 'Dismissed'; ?>
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user"></i>
          <span><b>Patients</b></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{URL::to('/showpatients/'.$enrolled)}}">Enrolled</a>
          <a class="dropdown-item" href="{{URL::to('/showpatients/'.$for)}}">For Graduation</a>
          <a class="dropdown-item" href="{{URL::to('/showpatients/'.$grad)}}">Graduated</a>
          <a class="dropdown-item" href="{{URL::to('/showpatients/'.$dis)}}">Dismissed</a>
        </div>
      </li>  
      <li class="nav-item ml-4">
        <a class="nav-link" href="{{URL::to('/showCalendar')}}">
          <i class="fas fa-fw fa-calendar"></i>
          <span><b>Calendar</b></span></a>
      </li>
      <li class="nav-item ml-4">
        <a class="nav-link" href="{{URL::to('/reports')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span><b>Reports</b></span></a>
      </li> 
  </ul>
    <!-- Navbar Search 
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
     <?php $count = 0;
           $countz = 0; ?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MySecondNotification')
                  <?php $count++; ?>
                  @elseif($user->type == 'App\Notifications\MyNotifications')
                  <?php $countz++; ?>
                  @endif
                @endforeach
              @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MySecondNotification')
                  <?php $count++; ?>
                  @endif
                @endforeach
            @endif

      <?php $counts = 0;?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin')
                 @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                      @if($trans->status != 'transfered')
                      <?php $counts++; ?>
                      @endif
                    @endif
                  @endforeach
              @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                @foreach($users->unreadNotifications as $user)
                  @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                      @if($trans->status != 'transfered')
                      <?php $counts++; ?>
                      @endif
                    @endif
                  @endforeach
                @endforeach
             @endif

      <?php $countx = 0;?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MyFourthNotifications')
                  <?php $countx++; ?>
                  @endif
                @endforeach
            @endif  

    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #343a40">
          <i class="fas fa-bell fa-fw" style="font-size: 30px;margin-top: 0px"></i>
          <span class="badge badge-danger" style="font-size: 10px">{{$count + $countz}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px" aria-labelledby="alertsDropdown">
          <div>
              <div class="card-header">Notifications </div>
              <div class="card-body scrollAble" style="margin-left: 0">
              @if(Auth::user()->user_role()->first()->name == 'Superadmin') 
                @foreach($users->unreadNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @elseif($user->type == 'App\Notifications\MyNotifications')
                   <div style="border:thin gray;background-color: lightgray">
                    <p style="margin-top: 5px;margin-left: 20px"><a href="{{URL::to('/viewuserx/'.$user->data['user_id'].'/'.$user->id)}}" style="color:black">A user has been added as {{$user->data['role']}} in {{$user->data['department']}} Department</a></p>
                    <?php date_default_timezone_set('Asia/Singapore'); ?>
                    <p style="margin-left: 170px">{{$user->created_at->diffForHumans()}}</p>
                    <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                    </div>
                  @endif
                @endforeach
                @foreach($users->readNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p> <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @elseif($user->type == 'App\Notifications\MyNotifications')
                   <div style="border:thin gray">
                    <p style="margin-top: 5px;margin-left: 20px"><a href="{{URL::to('/viewuser/'.$user->data['user_id'])}}" style="color:black">A user has been added as {{$user->data['role']}} in {{$user->data['department']}} Department</a></p>
                    <?php date_default_timezone_set('Asia/Singapore'); ?>
                    <p style="margin-left: 170px">{{$user->created_at->diffForHumans()}}</p>
                    <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                    </div>
                  @endif
                @endforeach
                @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                  @foreach($users->unreadNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                    
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                  
                  @endif
                @endforeach
                @foreach($users->readNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                      
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
               
                  @endif
                @endforeach
              @endif
              </div>
            </div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-building fa-fw" style="font-size: 30px;margin-top: 0px"></i>
          <span class="badge badge-danger" style="font-size: 10px">{{$counts}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px" aria-labelledby="alertsDropdown">
          <div>
            <div class="card-header" style="height: 50px">For Transfer Approval </div>
              <div class="card-body scrollAble" style="margin-left: 0;height: 170px">
              @if(Auth::user()->user_role()->first()->name == 'Superadmin') 
                @foreach($users->unreadNotifications as $user)
                  @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                      @if($trans->status != 'transfered')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 90px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 100px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @else
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->updated_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach($users->readNotifications as $user)
                 @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications')
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->updated_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                  @endif
                 @endforeach
                @endforeach
                @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                  @foreach($users->unreadNotifications as $user)
                   @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                    @if($trans->status != 'transfered')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 0px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @else
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->updated_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                    @endif
                  @endif
                 @endforeach
                @endforeach
                @foreach($users->readNotifications as $user)
                 @foreach($transfer as $trans)
                  @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                   @if($trans->status != 'transfered')
               <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 90px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 100px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @else
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @endif
                  @endif 
                 @endforeach
                @endforeach
              @endif
              </div>
            </div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i style="font-size: 30px;" class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{URL::to('/show_my_logs/'.Auth::user()->id)}}">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewProfile">View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changepassword">Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>