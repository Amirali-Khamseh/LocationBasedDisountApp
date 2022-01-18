
<?php $__env->startSection('title', 'Update Product'); ?>
<?php $__env->startSection('css'); ?>
<style>
    .slider-checked{
        display: none
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">Edit Product</h3>
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
    <form method="post" enctype="multipart/form-data" action="<?php echo e(route('products.update',['product' => $data['data']->id])); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Category</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    <!-- <option value="0" selected>parent</option> -->
                    <?php $__currentLoopData = $data['parent_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" <?php echo e($data['data']->category->parent_id == $item->id ? 'selected' : ''); ?>><?php echo e($item->title); ?></option>
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
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo e($data['data']->title); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product URL</label><i class="text-danger">*</i>
                <input type="text" name="product_link" class="form-control" id="URL" placeholder="Link goes here " value="<?php echo e($data['data']->product_link); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="<?php echo e($data['data']->price); ?>">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter discount_percent" value="<?php echo e($data['data']->discount_percent); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10"><?php echo e($data['data']->description); ?></textarea>
                </div>
            </div>
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        <?php if(isset($data['data']->image)): ?>
                            <img src="<?php echo e(route('image-show') . '?image=' . $data['data']->image->path); ?>" style="display:block;margin:auto;width: 400px" width="100" alt="">
                            <button type="button" onclick="destroyImage()" class="btn btn-danger" style="display:block;margin:auto"><span class="fa fa-trash"></span></button>
                        <?php else: ?>
                            <input type="file" name="image" placeholder="Choose image" id="image">
                        <?php endif; ?>
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
                    <input type="checkbox" name="status" <?php echo e($data['data']->status == 1 ? 'checked' : ''); ?> class="custom-control-input" id="status">
                    <label class="custom-control-label" for="status">status</label>
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" id="is_slider" name="is_slider" <?php echo e($data['data']->is_slider == 1 ? 'checked' : ''); ?> class="custom-control-input">
                    <label class="custom-control-label" for="is_slider">slider</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn">Submit</button>
        </div>
    </form>
    <form method="post" id="ImageDestroy" action="<?php echo e(route('products.image-destroy',['id' => $data['data']->id])); ?>">
        <?php echo csrf_field(); ?>
    </form>
<?php $__env->startSection('scripts'); ?>
<script>
    function destroyImage(){
        document.getElementById("ImageDestroy").submit();
    }
    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + <?php echo e($data['data']->category->parent_id); ?>,
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if (<?php echo e($data['data']->category->id); ?> == result[i].id) {
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/products/edit.blade.php ENDPATH**/ ?>