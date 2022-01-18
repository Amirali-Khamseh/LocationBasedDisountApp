
<?php $__env->startSection('content'); ?>
<main class="main">
            <div class="intro-section">
                <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider pg-xxl-hide pg-show nav-xxl-show nav-hide"
                    data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    }
                }">
                    <div class="swiper-wrapper row gutter-no cols-1">
                        <?php $__currentLoopData = $data['slider']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                            style="background-color: #f1f0f0;">
                            <div class="container">
                                <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                    'name': 'fadeInDownShorter', 'duration': '1s'
                                }" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}"
                                    data-child-depth="0.2">
                                    <img src="<?php echo e(isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('images/no-img.jpg')); ?>" alt="Ski" width="729"
                                        height="570" />
                                </figure>
                                <div class="banner-content text-right y-50 ml-auto">
                                    <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate text-primary"
                                        data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }"><?php echo e($item->category->parent->title . ' - ' .$item->category->title); ?></h5>
                                    <h3 class="banner-title ls-25 mb-6 slide-animate" data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }"><?php echo e($item->title); ?>

                                    </h3>
                                    <a href="shop-banner-sidebar.html"
                                        class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                        data-animation-options="{
                                        'name': 'fadeInUpShorter', 'duration': '1s'
                                    }">
                                        Detail<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End of .banner-content -->
                            </div>
                            <!-- End of .container -->
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- End of .intro-slide3 -->
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
            <!-- End of .intro-section -->

            <div class="container">
                <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6 mb-10"
                    data-swiper-options="{
                    'loop': true,
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    },
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                        <div class="swiper-slide icon-box icon-box-side text-dark">
                            <span class="icon-box-icon icon-shipping">
                                <i class="w-icon-truck"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                <p class="text-default">For all orders over $99</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark">
                            <span class="icon-box-icon icon-payment">
                                <i class="w-icon-bag"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Secure Payment</h4>
                                <p class="text-default">We ensure secure payment</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                            <span class="icon-box-icon icon-money">
                                <i class="w-icon-money"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Money Back Guarantee</h4>
                                <p class="text-default">Any back within 30 days</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat">
                            <span class="icon-box-icon icon-chat">
                                <i class="w-icon-chat"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Customer Support</h4>
                                <p class="text-default">Call or email us 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Iocn Box Wrapper -->

                <div class="title-link-wrapper mb-3 appear-animate">
                    <h2 class="title title-deals mb-1">Deals Of The Day ⚖</h2>
                    <!-- <div class="product-countdown-container font-size-sm text-dark align-items-center">
                        <label>Offer Ends in: </label>
                        <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+10d"
                            data-relative="true" data-compact="true">10days,00:00:00</div>
                    </div> -->
                    <a href="shop-boxed-banner.html" class="font-weight-bold ls-25">More Products<i
                            class="w-icon-long-arrow-right"></i></a>
                </div>
                <!-- End of .title-link-wrapper -->

                <div class="swiper-container swiper-theme product-deals-wrapper appear-animate mb-7"
                    data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 2,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 3
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 5
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-2">
                        <?php $__currentLoopData = $data['product_new_deals']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>">
                                        <img src="<?php echo e($item['image']); ?>" alt="Product"
                                            width="300" height="338">
                                        <!-- <img src="<?php echo e(asset('front/images/demos/demo2/products/1-1-2.jpg')); ?>" alt="Product"
                                            width="300" height="338"> -->
                                    </a>
                                    <div class="product-action-vertical">
                                        <a onclick="addToWishlist(<?php echo e($item['id']); ?>, <?php echo e($item['is_wishlist']); ?>)" id="item-<?php echo e($item['id']); ?>" class="btn-product-icon btn-wishlist <?php echo e($item['is_wishlist'] == 1 ? 'red-text w-icon-heart-full' : 'w-icon-heart'); ?>"
                                            title="Add to wishlist"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>"><?php echo e($item['title']); ?></a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: <?php echo e($item['rating'] * 20); ?>%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>" class="rating-reviews">(<?php echo e($item['rating_count']); ?> Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                    <?php if($item['discount_percent'] > 0): ?>
                                    <div class="product-price">
                                        <?php echo e($item['price'] - ($item['discount_percent'] / 100) * $item['price']); ?> - <del><?php echo e($item['price']); ?></del><span class="discount_percent">%<?php echo e($item['discount_percent']); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="product-price">
                                        <?php echo e($item['price']); ?>

                                    </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

 >
                <!-- End of Banner -->

                <div class="title-link-wrapper mb-3 appear-animate">
                    <h2 class="title title-deals mb-1">Top Raitings📈</h2>
                    <div class="product-countdown-container font-size-sm text-dark align-items-center">
                        <label>Offer Ends in: </label>
                        <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+10d"
                            data-relative="true" data-compact="true">10days,00:00:00</div>
                    </div>
                    <a href="shop-boxed-banner.html" class="font-weight-bold ls-25">More Products<i
                            class="w-icon-long-arrow-right"></i></a>
                </div>
                <!-- End of .title-link-wrapper -->

                <div class="swiper-container swiper-theme product-deals-wrapper appear-animate mb-7"
                    data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 2,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 3
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 5
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-2">
                        <div class="swiper-slide product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="<?php echo e(asset('front/images/demos/demo2/products/1-1-1.jpg')); ?>" alt="Product"
                                            width="300" height="338">
                                        <img src="<?php echo e(asset('front/images/demos/demo2/products/1-1-2.jpg')); ?>" alt="Product"
                                            width="300" height="338">
                                    </a>
                                    <div class="product-action-vertical">
                           
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                      
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="product-default.html">Women's Comforter</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="product-default.html" class="rating-reviews">(3 Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">$45.62 - $58.28</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <!-- End of Container -->
        </main>
<?php $__env->startSection('scripts'); ?>
<script>
function addToWishlist(id,wishlist){
    var url = 'wishlist';
    var method = 'post';
    if (wishlist == 1) {
        setTimeout(() => {
            $('#item-' + id).removeClass('w-icon-heart')
            $('#item-' + id).addClass('w-icon-heart-full');
            $('#item-' + id).addClass('red-text');
        }, 1000);
        return false;
    }
    return ajaxFunc(url,method,id);
}
function ajaxFunc(url,method,id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url + '/' + id + '/add',
        success: function(result){
            console.log(result)
            if(result.error == 1){
                alert(result.msg)
            }else{
                setTimeout(() => {
                    $('#item-' + id).removeClass('w-icon-heart')
                    $('#item-' + id).addClass('w-icon-heart-full');
                    $('#item-' + id).addClass('red-text');
                }, 500);
            }
        }
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/index.blade.php ENDPATH**/ ?>