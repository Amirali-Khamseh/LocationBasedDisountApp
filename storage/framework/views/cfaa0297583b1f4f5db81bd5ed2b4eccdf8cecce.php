
<?php $__env->startSection('content'); ?>

<?php if( session()->get('error') == '0' ): ?>
        <div class="alert alert-success alert-dismissible">
           
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <?php echo e(session()->get('msg')); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->get('error') == '1' ): ?>
        <div class="alert alert-danger alert-dismissible">
           
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
 <!-- Start of Page Content -->
 <div class="page-content">
                <div class="container">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                                <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="<?php echo e($data['detail']['image']); ?>"
                                                    data-zoom-image="<?php echo e($data['detail']['image']); ?>"
                                                    alt="Bright Green IPhone" width="800" height="900">
                                            </figure>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    },
                                    'breakpoints': {
                                        '992': {
                                            'direction': 'vertical',
                                            'slidesPerView': 'auto'
                                        }
                                    }
                                }">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details">
                                <h1 class="product-title"><?php echo e($data['detail']['title']); ?></h1>
                                <div class="product-bm-wrapper">
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category"><?php echo e($data['detail']['parent_category']); ?> - <a href="#"><?php echo e($data['detail']['category']); ?></a></span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="product-divider">

                                <div class="product-price">
                                    <?php if($data['detail']['discount_percent'] > 0): ?>
                                    <div class="product-price">
                                        <?php echo e($data['detail']['price'] - ($data['detail']['discount_percent'] / 100) * $data['detail']['price']); ?> - <del><?php echo e($data['detail']['price']); ?></del><span class="discount_percent">%<?php echo e($data['detail']['discount_percent']); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="product-price">
                                        <?php echo e($data['detail']['price']); ?>

                                    </div>
                                    <?php endif; ?>
                                    </div>

                                <div class="ratings-container">
                                    <div class="ratings-full">
                                       
                                        <span class="ratings" style="width: <?php echo e(number_format((float)$data['detail']['avg_comments'] * 20 , 1)); ?>%;"></span>
                                   
                                    </div>
                                    <a href="#" class="rating-reviews">(<?php echo e($data['detail']['comment_count']); ?> Reviews)</a>
                                </div>

                            

                                <hr class="product-divider">


                                <div class="social-links-wrapper">
                             
                                <div class="social-links">
                                   
                                        <div class="social-icons social-no-color border-thin">
                                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                                            
                                            </div>
                                        
                                    </div>
                                    
                                   
                                    <span class="divider d-xs-show"></span>

                                    <?php if(Auth::check()): ?>
                                    <div class="product-link-wrapper d-flex">
                                        <a onclick="addToWishlist(<?php echo e($data['detail']['id']); ?>, <?php echo e($data['detail']['is_wishlist']); ?>)" id="item-<?php echo e($data['detail']['id']); ?>" class="btn-product-icon btn-wishlist <?php echo e($data['detail']['is_wishlist'] == 1 ? 'red-text w-icon-heart-full' : 'w-icon-heart'); ?>"><span></span></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo e($data['detail']['product_link']); ?>" class="btn btn-dark btn-link btn-slide-right btn-icon-right" >More About this item <i class="w-icon-long-arrow-right"></i> </a> 
                            </div>
                        </div>
                    </div>
                    <hr>
                   
                  
         
                    <?php $__currentLoopData = $data['producers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/product-detail/<?php echo e($item['id']); ?>">
                        <div class="parent-producers">
                        <div class="parent-producer-img text-center">
                            <img src="<?php echo e($item['image']); ?>" alt="">
                        </div>
                        <div class="producer-product-title text-center">
                            <p><?php echo e($item['title']); ?></p>
                        </div>
                        <div class="producer-title text-center">
                            <p>
                                <?php echo e($item['shop_name']); ?>

                            </p>
                        </div>
                        <?php if($item['discount_percent'] > 0): ?>
                        <div class="product-price m-auto text-center">
                            <?php echo e($item['price'] - ($item['discount_percent'] / 100) * $item['price']); ?> - <del><?php echo e($item['price']); ?></del><span class="discount_percent">%<?php echo e($item['discount_percent']); ?></span>
                        </div>
                        <?php else: ?>
                        <div class="product-price m-auto text-center">
                            <?php echo e($item['price']); ?>

                        </div>
                        <?php endif; ?>
              

                    </div></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                    <hr>
                    <div class="tab tab-nav-boxed tab-nav-underline product-tabs mt-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#product-tab-description" class="nav-link active">Description</a>
                            </li>
                            <li class="nav-item">
                                <a href="#product-tab-reviews" class="nav-link">Customer Reviews (<?php echo e($data['detail']['comment_count']); ?>)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-tab-description">
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-md-10 mb-5">
                                        <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                        <p class="mb-4 product-description"><?php echo e($data['detail']['description']); ?></p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="product-tab-reviews">
                                <div class="row mb-4">
                                    <div class="col-xl-4 col-lg-5 mb-4">
                                        <div class="ratings-wrapper">
                                            <div class="avg-rating-container">
                                                <h4 class="avg-mark font-weight-bolder ls-50"><?php echo e(number_format((float)$data['detail']['avg_comments'],1)); ?></h4>
                                                <div class="avg-rating">
                                                    <p class="text-dark mb-1">Average Rating</p>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: <?php echo e($data['detail']['avg_comments'] * 20); ?>%;"></span>
                                                        </div>
                                                        <a href="#" class="rating-reviews">(<?php echo e($data['detail']['comment_count']); ?> Reviews)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-7 mb-4">
                                        <div class="review-form-wrapper">
                                            <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your Review
                                            </h3>
                                            <form action="<?php echo e(route('comment_post', ['id' => $data['detail']['id']])); ?>" method="POST" id="comment-form" class="review-form">
                                                <?php echo csrf_field(); ?>
                                                <div class="rating-form">
                                                    <label for="rating">Your Rating Of This Product :</label>
                                                    <span class="rating-stars" id="rating-stars">
                                                        <a class="star-1" href="#">1</a>
                                                        <a class="star-2" href="#">2</a>
                                                        <a class="star-3" href="#">3</a>
                                                        <a class="star-4" href="#">4</a>
                                                        <a class="star-5" href="#">5</a>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="rating" name="rating" value="">
                                                <textarea cols="30" rows="6" placeholder="Write Your Review Here..."
                                                    class="form-control" name="description" id="review"></textarea>
                                                <div class="row gutter-md">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" placeholder="Your Name"
                                                            id="author" value="<?php echo e(Auth::check() ? Auth::user()->name .' '. Auth::user()->family : ''); ?>" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" placeholder="Your Email"
                                                            id="email_1" value="<?php echo e(Auth::check() ? Auth::user()->email : ''); ?>" disabled>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-dark" onclick="submitComment(<?php echo e(Auth::check()); ?>)">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#show-all" class="nav-link active">Show All</a>
                                        </li>
                                    
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="show-all">
                                            <ul class="comments list-style-none">
                                                <?php $__currentLoopData = $data['detail']['comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#"><?php echo e($item['user_name']); ?></a>
                                                                <span class="comment-date"><?php echo e($item['created_time']); ?></span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: <?php echo e($item['rating']); ?>%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p><?php echo e($item['description']); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="helpful-positive">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/1-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at 1:54
                                                                    pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>pellentesque habitant morbi tristique senectus et. In
                                                                dictum non consectetur a erat.
                                                                Nunc ultrices eros in cursus turpis massa tincidunt ante
                                                                in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum ut
                                                                tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-1.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-1.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/2-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at 1:52
                                                                    pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>Nullam a magna porttitor, dictum risus nec, faucibus
                                                                sapien.
                                                                Ultrices eros in cursus turpis massa tincidunt ante in
                                                                nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum ut
                                                                tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-2.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-2-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="helpful-negative">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/3-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at 1:21
                                                                    pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>In fermentum et sollicitudin ac orci phasellus. A
                                                                condimentum vitae
                                                                sapien pellentesque habitant morbi tristique senectus
                                                                et. In dictum
                                                                non consectetur a erat. Nunc scelerisque viverra mauris
                                                                in aliquam sem fringilla.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (0)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful (1)
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="highest-rating">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/2-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at 1:52
                                                                    pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>Nullam a magna porttitor, dictum risus nec, faucibus
                                                                sapien.
                                                                Ultrices eros in cursus turpis massa tincidunt ante in
                                                                nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum ut
                                                                tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-2.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-2-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="lowest-rating">
                                            <ul class="comments list-style-none">
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <figure class="comment-avatar">
                                                            <img src="assets/images/agents/1-100x100.png"
                                                                alt="Commenter Avatar" width="90" height="90">
                                                        </figure>
                                                        <div class="comment-content">
                                                            <h4 class="comment-author">
                                                                <a href="#">John Doe</a>
                                                                <span class="comment-date">March 22, 2021 at 1:54
                                                                    pm</span>
                                                            </h4>
                                                            <div class="ratings-container comment-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                            </div>
                                                            <p>pellentesque habitant morbi tristique senectus et. In
                                                                dictum non consectetur a erat.
                                                                Nunc ultrices eros in cursus turpis massa tincidunt ante
                                                                in nibh mauris cursus mattis.
                                                                Cras ornare arcu dui vivamus arcu felis bibendum ut
                                                                tristique.</p>
                                                            <div class="comment-action">
                                                                <a href="#"
                                                                    class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                    <i class="far fa-thumbs-down"></i>Unhelpful (0)
                                                                </a>
                                                                <div class="review-image">
                                                                    <a href="#">
                                                                        <figure>
                                                                            <img src="assets/images/products/default/review-img-3.jpg"
                                                                                width="60" height="60"
                                                                                alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                                data-zoom-image="assets/images/products/default/review-img-3-800x900.jpg" />
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="vendor-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title text-left">More Products From This Vendor</h4>
                          
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
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
                                    'slidesPerView': 4
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-4 cols-md-4 cols-sm-3 cols-2">
                                <?php $__currentLoopData = $data['suggestion']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide product">
                                    <figure class="product-media">
                                        <a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>">
                                            <img src="<?php echo e($item['image']); ?>" alt="Product"
                                                width="300" height="338" />
                                        </a>
                                        <?php if(Auth::check()): ?>
                                        <div class="product-action-vertical">
                                            <a onclick="addToWishlist(<?php echo e($item['id']); ?>, <?php echo e($item['is_wishlist']); ?>)" id="item-<?php echo e($item['id']); ?>" class="btn-product-icon btn-wishlist <?php echo e($item['is_wishlist'] == 1 ? 'red-text w-icon-heart-full' : 'w-icon-heart'); ?>"
                                                title="Add to wishlist"></a>
                                        </div>
                                        <?php endif; ?>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                                View</a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="product-cat"><a href="shop-banner-sidebar.html"><?php echo e($item['parent_category'] . ' - ' . $item['category']); ?></a>
                                        </div>
                                        <h4 class="product-name"><a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>"><?php echo e($item['title']); ?></a>
                                        </h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="<?php echo e(route('product_detail', ['id' => $item['id']])); ?>" class="rating-reviews">(3 reviews)</a>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- End of Page Content -->
            <?php $__env->startSection('scripts'); ?>
<script>
function submitComment(check){
    if(check == 1){
        $('#comment-form').submit();
    }else{
        alert('you are not logged in')
    }
}
$('#rating-stars a').on('click', function(event){
    event.preventDefault();
    $('#rating-stars a.active').removeClass('active')
    var rateClass = this.classList[0];
    $('.' + rateClass).addClass('active')
    $('#rating').val($('#rating-stars a.active')[0].innerHTML)
})
function addToWishlist(id,wishlist){
    var url = '/wishlist';
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
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/front/productDetail.blade.php ENDPATH**/ ?>