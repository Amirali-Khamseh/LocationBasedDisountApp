<!DOCTYPE html>
<html lang="en">
    <?php echo $__env->make('panel.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php echo $__env->yieldContent('css'); ?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <form action="<?php echo e(route('logout')); ?>" method="post"><?php echo csrf_field(); ?><button class="btn btn-danger" type="submit">Logout</button></form>
      </li>
   
    </ul>

    
      </li> 

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php echo $__env->make('panel.layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="col-10 ml-auto mr-4 mt-4">
  <?php echo $__env->yieldContent('content'); ?>
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php echo $__env->make('panel.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/layouts/master.blade.php ENDPATH**/ ?>