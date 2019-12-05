<div class="sidebar" data-color="blue" data-background-color="white">
    <div class="sidebar-background" style="background-color: #fff;"></div>
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-normal" style="font-size: 15px;">
            White Cross Medical Clinic
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ (Route::current()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard', ['name' => Auth::user()->username]) }}">
                    <i class="material-icons">dashboard</i>
                    <p>DASHBOARD</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.appointment') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.appointment', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <p>APPOINTMENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.user_mgt') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user_mgt', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <p>USER MANAGEMENT</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.schedule') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.schedule', ['name' => Auth::user()->username]) }}">
                    <i class="fas fa-user-md"></i>
                    <p>DOCTOR'S SCHEDULE</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.patient_records') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.patient_records', ['name' => Auth::user()->username]) }}">
                    <i class="fas fa-poll-h"></i>
                    <p>PATIENT RECORDS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.results') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.results', ['name' => Auth::user()->username]) }}">
                    <i class="fas fa-flask"></i>
                    <p>LAB RESULTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.billing') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.billing', ['name' => Auth::user()->username]) }}">
                    <i class="material-icons">library_books</i>
                    <p>BILL PAYMENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.service') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.services', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <p>MEDICAL SERVICES</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'admin.setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.setting', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <p>SETTINGS</p>
                </a>
            </li>
            <li class="nav-item">
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