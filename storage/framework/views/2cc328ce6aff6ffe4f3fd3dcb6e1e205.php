<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo e(app('general_setting')->site_title); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <link rel="icon" href="<?php echo e(showImage(app('general_setting')->favicon)); ?>" type="image/png">
    <!-- Bootstrap CSS -->

    <?php if(isRtl()): ?>
        <link rel="stylesheet" href="<?php echo e(asset(asset_path('frontend/default/compile_css/rtl_app.css'))); ?>" >
    <?php else: ?>
        <link rel="stylesheet"  href="<?php echo e(asset(asset_path('frontend/default/compile_css/app.css'))); ?>" >
    <?php endif; ?>

    <?php $__env->startSection('styles'); ?>
     <?php echo $__env->yieldSection(); ?>
    <!-- jquery -->
    <script src="<?php echo e(asset(asset_path('frontend/default/compile_js/app.js'))); ?>"></script>



    <style>
        .text-danger {
            color: #dc3545 !important;
        }
        .toast-success {
            background-color: <?php echo e($themeColor->success_color); ?>!important;
        }

        .toast-error{
            background-color: <?php echo e($themeColor->danger_color); ?>!important;
        }
        .toast-warning{
            background-color: <?php echo e($themeColor->warning_color); ?>!important;
        }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/default/auth/partials/_header.blade.php ENDPATH**/ ?>