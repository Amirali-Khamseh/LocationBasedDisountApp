<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin-panel/dashboard" class="brand-link">
      <!-- <img src="/panel/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
       <div class="info">
          <a href="#" class="d-block"><?php echo e(Auth::check() ? auth()->user()->name .' '. auth()->user()->family : ''); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="fas fa-address-book"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin-panel/users/create" class="nav-link <?php if(\Request::route()->getName() == 'users.create'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create user</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-panel/users" class="nav-link <?php if(\Request::route()->getName() == 'users.index'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>user list</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="fas fa-sitemap"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin-panel/categories/create" class="nav-link <?php if(\Request::route()->getName() == 'categories.create'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-panel/categories" class="nav-link <?php if(\Request::route()->getName() == 'categories.index'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>category list</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="fas fa-shopping-basket"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin-panel/products/create" class="nav-link <?php if(\Request::route()->getName() == 'products.create'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin-panel/products" class="nav-link <?php if(\Request::route()->getName() == 'products.index'): ?> active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>product list</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/layouts/menu.blade.php ENDPATH**/ ?>