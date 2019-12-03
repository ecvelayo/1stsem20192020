<!DOCTYPE html>
<html lang="en">

  @include('parts.head')

  @include('parts.loader')

<body id="page-top" style="background-color: #e9ecef">

@if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
    @include('parts.nav')
@else
    @include('parts.nav2')  
@endif

  <div id="wrapper">

 @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
    @include('parts.sidebar')
 @endif

    <div id="content-wrapper" style="background-color: #e9ecef">

      <div class="container-fluid" style="background-color: #e9ecef">
        

       @yield('content')
        
      </div>

      <!-- Sticky Footer -->
    @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
      @include('parts.footer')
    @else
      @include('parts.footer2')
    @endif

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  @include('parts.modal')

  @include('parts.scripts')

</body>

</html>
