

<?php $__env->startSection('code', '500'); ?>
<?php $__env->startSection('title', __('common.error')); ?>

<?php $__env->startSection('image'); ?>
    <div class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center img_403">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __('defaultTheme.whoops_something_went_wrong_on_our_servers')); ?>

<?php echo $__env->make('errors.illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/errors/500.blade.php ENDPATH**/ ?>