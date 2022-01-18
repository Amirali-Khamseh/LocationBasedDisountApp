<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description"
        content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('front/images/icons/favicon.png')); ?>">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = "<?php echo e(asset('front/js/webfont.js')); ?>";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="<?php echo e(asset('front/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')); ?>" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?php echo e(asset('front/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')); ?>" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?php echo e(asset('front/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')); ?>" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?php echo e(asset('front/fonts/wolmart87d5.woff?png09e')); ?>" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/vendor/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/style.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/vendor/fontawesome-free/css/all.min.css')); ?>">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('front/vendor/swiper/swiper-bundle.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/vendor/animate/animate.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/vendor/magnific-popup/magnific-popup.min.css')); ?>">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/demo2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/rangeslider.css')); ?>">
    <!-- MAP -->
    <style rel="stylesheet" href="<?php echo e(asset('front/css/map.css')); ?>"></style>
    <!-- MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
</head><?php /**PATH C:\Users\pixyboy\Desktop\laravel\project\resources\views/front/layouts/header.blade.php ENDPATH**/ ?>