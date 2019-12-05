<ul class="sidebar navbar-nav" style="">
      <li class="nav-item" style="margin-top: 10px">
        <a class="nav-link" href="{{URL::to('/profile')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><b>Dashboard</b></span>
        </a>
      </li>
      @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-users"></i>
          <span><b>Users</b></span>
        </a> 
        @if(Auth::user()->user_role()->first()->name == 'Superadmin')
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          @foreach($roles as $role)
            @if($role->name != 'Superadmin' && $role->parent == 0)
          <a class="dropdown-item" href="{{ route('showUsers',$role->id) }}">{{$role->name}}s</a>
          @endif
          @endforeach
          <a class="dropdown-item" href="{{URL::to('/chooseuser')}}"><i class="fas fa-fw fa-plus"></i>Add</a>
        </div>
        @elseif(Auth::user()->user_role()->first()->name == 'Admin')
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          @foreach($roles as $role)
            @if($role->name != 'Admin' && $role->name != 'Superadmin' && $role->parent == 0)
          <a class="dropdown-item" href="{{ route('showUsers',$role->id) }}">{{$role->name}}s</a>
          @endif
          @endforeach
        </div>
        @endif
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-building"></i>
          <span><b>Departments</b></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
         @foreach($deps as $dep)
          <a class="dropdown-item" href="{{ route('showDeps',$dep->id) }}">{{$dep->department_name}}</a>
         @endforeach
         @if(Auth::user()->user_role()->first()->name == 'Superadmin')
         <a class="dropdown-item" href="{{URL::to('/create_dep')}}"><i class="fas fa-fw fa-plus"></i>Add</a>
         @endif
        </div>
      </li>
      @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
       <li class="nav-item">
        <a class="nav-link" href="{{URL::to('/showemployees')}}">
          <i class="fas fa-fw fa-users"></i>
          <span><b>Employees</b></span></a>
      </li>
      @endif
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
      <li class="nav-item">
        <a class="nav-link" href="{{URL::to('/showCalendar')}}">
          <i class="fas fa-fw fa-calendar"></i>
          <span><b>Calendar</b></span></a>
      </li>
      <li class="nav-item" style="">
        <a class="nav-link" href="{{URL::to('/reports')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span><b>Reports</b></span></a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-list"></i>
          <span>Forms</span></a>-->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{URL::to('/logs')}}">
          <i class="fas fa-fw fa-book"></i>
          <span><b>System Logs</b></span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-box"></i>
          <span><b>Other categories</b></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{URL::to('/showIntervention')}}">Intervention</a>
          <a class="dropdown-item" href="{{URL::to('/show_services')}}">Services</a>
          <a class="dropdown-item" href="{{URL::to('/show_case_types')}}">Case Types</a>
          <a class="dropdown-item" href="{{URL::to('/show_cities')}}">Cities</a>
          <a class="dropdown-item" href="{{URL::to('/show_jails')}}">City Jails</a>
          <a class="dropdown-item" href="{{URL::to('/show_dismiss_reason')}}">Dismissal Reasons</a>
          <a class="dropdown-item" href="{{URL::to('/show_civilstat')}}">Civil Status</a>
          <a class="dropdown-item" href="{{URL::to('/show_gender')}}">Gender</a>
          <a class="dropdown-item" href="{{URL::to('/show_eduatain')}}">Educational Attainment</a>
          <a class="dropdown-item" href="{{URL::to('/show_estat')}}">Employment Status</a>
          <a class="dropdown-item" href="{{URL::to('/show_dabused')}}">Drug-Level Abused</a>
          <a class="dropdown-item" href="{{URL::to('/show_checklist')}}">Checklist</a>
        </div>
      </li>
    @else
      <li class="nav-item dropdown">
        <?php $enrolled = 'Enrolled'; $for = 'For Graduate'; $grad = 'Graduated'; $dis = 'Dismissed'; ?>
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
      
     @if(Auth::user()->user_role()->first()->name == 'Social Worker' || Auth::user()->user_role()->first()->name == 'Nurse')
        <li class="nav-item">
        <a class="nav-link" href="{{URL::to('/showCalendar')}}">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Calendar</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{URL::to('/reports')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span><b>Reports</b></span></a>
      </li>

      @endif
<!--       @if(Auth::user()->user_role()->first()->name == 'Doctor')
      <li class="nav-item">
         <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-briefcase-medical"></i>
          <span>My Appointments</span></a>
      </li>
      @endif -->
      <!--<li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-list"></i>
          <span>Forms</span></a>
      </li>-->
    @endif
    </ul>