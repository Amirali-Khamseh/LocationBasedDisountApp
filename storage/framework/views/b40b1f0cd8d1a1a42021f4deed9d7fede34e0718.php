
<?php $__env->startSection('title', 'Create Product'); ?>
<?php $__env->startSection('content'); ?>
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">create Product</h3>
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
    <form method="post" enctype="multipart/form-data" action="<?php echo e(route('products.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Category</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    <?php $__currentLoopData = $data['parent_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>" <?php echo e($key == 0 ? 'selected' : ''); ?>><?php echo e($item->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                <div class="form-group col-6">
                <label for="parent">Sub-Category</label><i class="text-danger">*</i>
                <select name="childern_id" class="form-control" id="childern">
                        
                </select>
                </div>
               
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo e(old('title')); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product URL</label><i class="text-danger">*</i>
                <input type="text" name="product_link" class="form-control" id="URL" placeholder="Link goes here " value="<?php echo e(old('product_link')); ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" value="<?php echo e(old('price')); ?>">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="number" min="0" max="100" name="discount_percent" class="form-control"  id="discount_percent" placeholder="Enter discount_percent" value="<?php echo e(old('discount_percent')); ?>">
                </div>
            </div>


            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" value="<?php echo e(old('description')); ?>" class="form-control" placeholder="product descrition ..." id="description" cols="30" rows="10"></textarea>
                </div>
            </div>
            
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
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
            <button type="submit" class="btn btn-primary" id="btn">Submit</button>
        </div>
    </form>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + <?php echo e($data['parent_categories'][0]->id); ?>,
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if (i == 0) {
                    html += `<option value="${result[i].id}" selected>${result[i].title}</option>`;
                }else{
                    html += `<option value="${result[i].id}">${result[i].title}</option>`;
                }
            }
            $('#childern').html(html)
        },
        error: function(err){
            console.log(err)
        }
        });
    }
    function parentCategories(id){
        $.ajax({url: "/test/" + id,
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                html += `<option value="${result[i].id}">${result[i].title}</option>`;
            }
            $('#childern').html(html)
        },
        error: function(err){
            console.log(err)
        }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/products/create.blade.php ENDPATH**/ ?>