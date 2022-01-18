
<?php $__env->startSection('title', 'Create Category'); ?>
<?php $__env->startSection('content'); ?>
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">create Category</h3>
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
    <form method="post" action="<?php echo e(route('categories.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Parent</label><i class="text-danger">*</i>
                <select name="parent_id" class="form-control" id="parent">
                    <option value="0" selected>parent</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" selected><?php echo e($item->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                <div class="form-group col-6">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo e(old('title')); ?>">
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
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/categories/create.blade.php ENDPATH**/ ?>