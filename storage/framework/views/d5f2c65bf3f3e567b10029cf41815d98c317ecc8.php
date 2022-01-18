<?php $__env->startSection('title'); ?> Create Product  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('front.user.layout.producer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
<?php if(session()->has('error') && session()->get('error') == 0): ?>
<div class="alert alert-icon alert-success alert-bg alert-inline show-code-action" id="parent-alert-logedin">
    <h4 class="alert-title">
        <i class="fas fa-check"></i>Done</h4>
        <p id="alert-loged-in"><?php echo e(session()->get('msg')); ?></p>
</div>
<?php endif; ?>
<?php if(session()->has('error') && session()->get('error') == 1): ?>
<div class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="parent-alert-danger-login">
    <h4 class="alert-title">
    <i class="w-icon-times-circle"></i>Oh snap!</h4>
    <p id="alert-danger-logedin"><?php echo e(session()->get('msg')); ?></p>
</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="parent-alert-danger-login">
    <h4 class="alert-title">
    <i class="w-icon-times-circle"></i>Oh snap!</h4>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p id="alert-danger-logedin"><?php echo e($error); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<form autocomplete="off" method="post" enctype="multipart/form-data" action="<?php echo e(route('store_product')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Parent</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    <?php $__currentLoopData = $data['parent_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
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
                <!-- <div class="form-group col-12">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo e(old('title')); ?>">
                </div> -->
                <div class="col-6 parent-search-prducer">
                <div class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper ">
                    <input type="text" name="title" class="form-control" id="searchProducer" placeholder="Search your product name ..." required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                    <div id="parent-producer_search_box" class="d-none">
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="<?php echo e(old('price')); ?>">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter discount_percent" value="<?php echo e(old('discount_percent')); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product Link</label><i class="text-danger"></i>
                <input type="text" name="product_link" class="form-control" id="product_link" placeholder="Enter your product link if you have ..." value="<?php echo e(old('product_link')); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10"><?php echo e(old('description')); ?></textarea>
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


        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block" id="btn">Submit</button>
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
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/user/product_create.blade.php ENDPATH**/ ?>