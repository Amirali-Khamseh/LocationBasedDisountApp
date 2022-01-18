<!DOCTYPE html>
<html lang="en">
    @include('panel.layouts.header')
    
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@yield('css')

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <form action="{{route('logout')}}" method="post">@csrf<button class="btn btn-danger" type="submit">Logout</button></form>
      </li>
   
    </ul>

    
      </li> 

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('panel.layouts.menu')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-10 ml-auto mr-4 mt-4">
  @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('panel.layouts.scripts')
@yield('scripts')
</body>
</html>