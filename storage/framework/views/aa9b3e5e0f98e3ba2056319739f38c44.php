

<?php $__env->startSection('code', '429'); ?>
<?php $__env->startSection('title', __('defaultTheme.too_many_requests')); ?>

<?php $__env->startSection('image'); ?>
    <div class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center img_403">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __('defaultTheme.sorry_you_are_making_too_many_requests_to_our_servers')); ?>

<?php echo $__env->make('errors.illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/errors/429.blade.php ENDPATH**/ ?>