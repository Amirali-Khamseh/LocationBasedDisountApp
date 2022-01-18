<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0"><?php echo $__env->yieldContent('title'); ?></h1>
    </div>
    <div class="row mt-4 parent-user_header" style="width:50%">
    <a class="col-4" href="/producer/account"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'producer/account' ? 'user_active_link' : ''); ?>">Account Detail</h4></a>
    <a class="col-4" href="/producer/products"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'producer/products' ? 'user_active_link' : ''); ?>">Products</h4></a>
    <a class="col-4" href="/producer/address"><h4 class="text-primary <?php echo e(Route::getFacadeRoot()->current()->uri() == 'producer/address' ? 'user_active_link' : ''); ?>">Address Detail</h4></a>
    </div>
</div><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/user/layout/producer-header.blade.php ENDPATH**/ ?>