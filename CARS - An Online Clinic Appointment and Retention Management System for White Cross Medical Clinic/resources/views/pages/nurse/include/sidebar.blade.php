<div class="sidebar" data-color="blue" data-background-color="white">
    <div class="sidebar-background" style="background-color: #fff;"></div>
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-normal" style="font-size: 15px;">
            White Cross Medical Clinic
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.dashboard', ['name' => Auth::user()->username]) }}">
                    <i class="material-icons">dashboard</i>
                    <p>DASHBOARD</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.appointment') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.appointment', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <p>APPOINTMENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.patient_records') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.patient_records', ['name' => Auth::user()->username]) }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <p>PATIENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.results') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.results', ['name' => Auth::user()->username]) }}">
                    <i class="fas fa-flask"></i>
                    <p>LAB RESULTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.billing') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.billing', ['name' => Auth::user()->username]) }}">
                    <i class="material-icons">library_books</i>
                    <p>BILL PAYMENTS</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::current()->getName() == 'nurse.settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('nurse.settings', ['name' => Auth::user()->username]) }}">
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

