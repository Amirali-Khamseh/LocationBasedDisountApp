<?php $__env->startSection('title'); ?> Products list <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('front.user.layout.producer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row justify-content-center margin-tb-4">
    <div class="col-3">
        <a href="<?php echo e(route('create_product')); ?>" class="btn btn-primary btn-block">Add Product</a>
    </div>
</div>
<div class="container">
<section class="mb-2 mb-lg-7">
    <div class="row product-wrapper show-code-action">
        <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 col-6">
            <div class="product product-image-gap product-simple">
                <figure class="product-media">
                    <a href="<?php echo e($item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#'); ?>">
                        <img src="<?php echo e($item['image']); ?>" alt="Product" width="295"
                            height="335" />
                    </a>
                    <div class="product-label-group">
                        <?php if($item['status'] == 0): ?>
                        <label class="product-label label-discount">Pending</label>
                        <?php else: ?>
                        <label class="product-label-approved">Approved</label>
                        <?php endif; ?>
                    </div>
                </figure>
                <div class="product-details">
                    <div class="product-cat">
                        <a href="shop-banner-sidebar.html"><?php echo e($item['category']['parent']['title'] .' - '. $item['category']['title']); ?></a>
                    </div>
                    <h4 class="product-name">
                        <a href="<?php echo e($item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#'); ?>"><?php echo e($item['title']); ?></a>
                    </h4>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: <?php echo e($item['rating'] * 20); ?>%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="<?php echo e($item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#'); ?>" class="rating-reviews">(<?php echo e($item['rating_count']); ?> reviews)</a>
                    </div>
                    <div class="product-pa-wrapper">
                    <?php if($item['discount_percent'] > 0): ?>
                    <div class="product-price">
                        <?php echo e($item['price'] - ($item['discount_percent'] / 100) * $item['price']); ?> - <del><?php echo e($item['price']); ?></del><span class="discount_percent">%<?php echo e($item['discount_percent']); ?></span>
                    </div>
                    <?php else: ?>
                    <div class="product-price">
                        <?php echo e($item['price']); ?>

                    </div>
                    <?php endif; ?>
                        <div class="product-action">
                            <a href="<?php echo e(route('edit_product', ['id' => $item['id']])); ?>" target="_blank" class="btn-cart btn-product btn btn-link btn-underline">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/user/products.blade.php ENDPATH**/ ?>