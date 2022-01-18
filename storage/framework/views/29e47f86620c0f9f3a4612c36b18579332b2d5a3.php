<?php $__env->startSection('title'); ?> Edit Product  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('front.user.layout.producer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
<form method="post" enctype="multipart/form-data" action="<?php echo e(route('producer_product.update',['id' => $data['detail']['id']])); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Parent</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    <?php $__currentLoopData = $data['parent_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" <?php echo e($data['detail']['category_parent_id'] == $item->id ? 'selected' : ''); ?>><?php echo e($item->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>  
                <div class="form-group col-6">
                <label for="parent">Childrens</label><i class="text-danger">*</i>
                <select name="childern_id" class="form-control" id="childern">
                        
                </select>
                </div>
               
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo e($data['detail']['title']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="<?php echo e($data['detail']['price']); ?>">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter discount_percent" value="<?php echo e($data['detail']['discount_percent']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product Link</label><i class="text-danger"></i>
                <input type="text" name="product_link" class="form-control" id="product_link" placeholder="Enter product_link" value="<?php echo e($data['detail']['product_link']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10"><?php echo e($data['detail']['description']); ?></textarea>
                </div>
            </div>
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        <?php if($data['detail']['image'] != null): ?>
                            <img src="<?php echo e($data['detail']['image']); ?>" style="display:block;margin:auto;width: 400px" width="100" alt="">
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
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block" id="btn">Submit</button>
        </div>
    </form>
    <form method="post" id="ImageDestroy" action="<?php echo e(route('products.image-destroy',['id' => $data['detail']['id']])); ?>">
        <?php echo csrf_field(); ?>
    </form>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    function destroyImage(){
        document.getElementById("ImageDestroy").submit();
    }
    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + <?php echo e($data['detail']['category_parent_id']); ?>,
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if (<?php echo e($data['detail']['category_id']); ?> == result[i].id) {
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
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/user/product_edit.blade.php ENDPATH**/ ?>