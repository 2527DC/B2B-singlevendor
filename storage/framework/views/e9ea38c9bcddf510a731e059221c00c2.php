<!doctype html>
<html class="no-js" lang="zxx">

<?php echo $__env->make('frontend.amazy.auth.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('frontend.amazy.auth.partials._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/auth/layouts/app.blade.php ENDPATH**/ ?>