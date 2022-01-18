<header class="header">
            <div class="header-top">
                <div class="container">
                   
                    <div class="header-right pr-0">
                        <!-- End of Dropdown Menu -->
                        <span class="divider d-lg-show"></span>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                        <?php if(Auth::check()): ?>
                        <a onclick="logout()" class="d-lg-show login sign-in"><i
                                class="w-icon-logout"></i>Logout</a>
                        <span class="delimiter d-lg-show"></span>
                        <a href="<?php echo e(Auth::user()->role_id == 2 ? '/user' : '/producer'); ?>/account" class="d-lg-show login"><i
                                class="w-icon-account"></i>Dashboard</a>
                        <span class="delimiter d-lg-show"></span>
                        <?php else: ?>
                        <a href="/user-auth" class="d-lg-show login "><i
                                class="w-icon-account"></i>Sign In</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="/user-auth" class="ml-0 d-lg-show login ">Register</a>
                        <?php endif; ?>
                        <a href="/admin-panel/login" class="d-lg-show login "><i
                            class="w-icon-account"></i>ADMIN LOGIN PAGE</a>
                   
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    
                    <div class="header-right ml-4">
                    
                        <?php if(Auth::check() && Auth::user()->role_id != 3): ?>
                        <a class="wishlist label-down link d-xs-show" href="/wishlist">
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a>
                        <?php endif; ?>
                       
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left flex-1">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                        <?php $__currentLoopData = $data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="#" onclick="return false;">
                                            <!-- <i class="w-icon-tshirt2"></i> -->
                                                <?php echo e($item->title); ?>

                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <ul>
                                                        <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><a href="<?php echo e(route('categories.index', [ 'id' => $value->id ])); ?>"><?php echo e($value->title); ?></a></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper ">
                               
                                <input type="text" class="form-control" id="search"
                                    placeholder="Search in..." required />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                                </button>
                                <div id="parent-search_box" class="d-none">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
        function logout(){
            var url = '/logout';
            var method = 'post';
            ajax_Func(url,method)
        }
        function ajax_Func(url,method){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: method,
                        url: url,
                        success: function(result){
                            window.location.href = '/'
                        }
                    });
                }
        </script><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/layouts/head.blade.php ENDPATH**/ ?>