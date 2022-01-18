
<?php $__env->startSection('title', 'Create User'); ?>
<?php $__env->startSection('content'); ?>
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">create user</h3>
    </div>

    <?php if( session()->get('error') == '0' ): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <?php echo e(session()->get('msg')); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->get('error') == '1' ): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5><?php echo e(session()->get('msg')); ?>

        </div>
    <?php endif; ?>


    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('users.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="role">Role</label><i class="text-danger">*</i>
                <select name="role" class="form-control" id="role">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Name</label><i class="text-danger">*</i>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="<?php echo e(old('name')); ?>">
                </div>
                <div class="form-group col-6">
                <label for="family">Family</label><i class="text-danger">*</i>
                <input type="text" name="family" class="form-control" id="family" placeholder="Enter family" value="<?php echo e(old('family')); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Mobile</label><i class="text-danger">*</i>
                <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile" value="<?php echo e(old('mobile')); ?>">
                </div>
                <div class="form-group col-6">
                <label for="email">Email</label><i class="text-danger">*</i>
                <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo e(old('email')); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Password</label><i class="text-danger">*</i>
                <input type="password" name="password" class="form-control" id="password" >
                </div>
                <div class="form-group col-6">
                <label for="email">Confirm password</label><i class="text-danger">*</i>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">status</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/users/create.blade.php ENDPATH**/ ?>