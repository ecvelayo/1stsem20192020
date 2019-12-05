<div class="sidebar" data-color="blue" data-background-color="white">
    <div class="sidebar-background" style="background-color: #fff;"></div>
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-normal" style="font-size: 15px;">
            White Cross Medical Clinic
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ (Route::current()->getName() == 'doctor.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.dashboard', ['name' => Auth::user()->username]) }}">
                    <i class="material-icons">dashboard</i>
                    <p>DASHBOARD</p>
                </a>
            </li>
            
            <li class="nav-item {{ (Route::current()->getName() == 'doctor.appointments') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.appointments', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-calendar"></i>
                    <p>APPOINTMENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'doctor.patients') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.patient_records', ['name' => Auth::user()->username]) }}">
                    <i class="fas fa-poll-h"></i>
                    <p>PATIENT RECORDS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'doctor.settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.settings', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <p>SETTINGS</p>
                </a>
            </li>
            <li class="nav-item logout">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>LOGOUT</p>
                </a>
            </li>
        </ul>
    </div>
</div>