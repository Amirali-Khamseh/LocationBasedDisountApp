
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?> Account Detail <?php $__env->stopSection(); ?>

<?php if(Route::getFacadeRoot()->current()->uri() == 'user/account'): ?>
<?php echo $__env->make('front.user.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('front.user.layout.producer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<div class="container">
<div class="tab-pane" id="account-details">
    
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if( session()->get('error') == '0' ): ?>
        <div class="alert alert-success alert-dismissible">
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <h3><?php echo e(session()->get('msg')); ?></h3>
        </div>
    <?php endif; ?>
    <?php if(session()->get('error') == '1' ): ?>
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Alert!</h5><?php echo e(session()->get('msg')); ?>

        </div>
    <?php endif; ?>

    <form class="form account-details-form" action="<?php echo e(route('user-account')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">First name *</label>
                    <input type="text" id="name" name="name" placeholder="John" value="<?php echo e($data['user']->name); ?>"
                        class="form-control form-control-md">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="family">Last name *</label>
                    <input type="text" id="family" name="family" placeholder="Doe" value="<?php echo e($data['user']->family); ?>"
                        class="form-control form-control-md">
                </div>
            </div>
        </div>

        <div class="row form-group mb-6">
            <?php if(Route::getFacadeRoot()->current()->uri() == 'producer/account'): ?>
            <div class="col-6">
                <label for="shop_name">Shop Name *</label>
                <input type="shop_name" id="shop_name" name="shop_name" value="<?php echo e($data['user']->shop_name); ?>"
                    class="form-control form-control-md">
            </div>
            <?php endif; ?>
            <div class="col-6">
                <label for="email">Email address *</label>
                <input type="email" id="email" name="email" value="<?php echo e($data['user']->email); ?>"
                    class="form-control form-control-md">
            </div>
        </div>
        <div class="form-group mb-6">
            <label for="mobile">Mobile *</label>
            <input type="number" id="mobile" name="mobile" value="<?php echo e($data['user']->mobile); ?>"
                class="form-control form-control-md">
        </div>
        
        <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
        <div class="form-group">
            <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
            <input type="password" class="form-control form-control-md"
                id="cur-password" name="cur_password" value="">
        </div>
        <div class="form-group">
            <label class="text-dark" for="new-password">New Password leave blank to leave unchanged</label>
            <input type="password" class="form-control form-control-md"
                id="new-password" name="password">
        </div>
        <div class="form-group mb-10">
            <label class="text-dark" for="conf-password">Confirm Password</label>
            <input type="password" class="form-control form-control-md"
                id="conf-password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/user/account.blade.php ENDPATH**/ ?>