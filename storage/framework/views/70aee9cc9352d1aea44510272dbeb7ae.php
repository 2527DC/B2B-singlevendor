

<?php
    $page = \Modules\FrontendCMS\Entities\DynamicPage::where('slug', 'about-us')->first();
?>


<?php $__env->startSection('title'); ?>
<?php echo e($content->mainTitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Auction Product Gallery | <?php echo e(config('app.name')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('share_meta'); ?>
<meta name="title" content=" <?php echo e($content->mainTitle); ?> | <?php echo e(config('app.name')); ?>">
<meta name="description" content="<?php echo e($content->mainTitle); ?> | <?php echo e(config('app.name')); ?>">
<meta property="og:title" content="<?php echo e($content->mainTitle); ?> | <?php echo e(config('app.name')); ?>" />
<meta property="og:description" content="<?php echo e($content->mainTitle); ?> | <?php echo e(config('app.name')); ?>" />
<meta property="og:url" content="<?php echo e(url()->current()); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt_30 mb_30 min-vh-50">

    <?php
        echo $page->description;
    ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/about_us.blade.php ENDPATH**/ ?>