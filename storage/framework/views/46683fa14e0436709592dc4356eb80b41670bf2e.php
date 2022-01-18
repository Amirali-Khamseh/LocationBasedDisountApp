<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0"><?php echo $__env->yieldContent('title'); ?></h1>
    </div>
    <div class="row mt-4 parent-user_header" style="width:50%">
    <a class="col-4" href="/user/account"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'user/account' ? 'user_active_link' : ''); ?>">Account Detail</h4></a>
    <a class="col-4" href="/wishlist"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'wishlist' ? 'user_active_link' : ''); ?>">Wishlist</h4></a>
    <a class="col-4" href="/user/address"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'user/address' ? 'user_active_link' : ''); ?>">Address Detail</h4></a>
    </div>
</div><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/front/user/layout/header.blade.php ENDPATH**/ ?>