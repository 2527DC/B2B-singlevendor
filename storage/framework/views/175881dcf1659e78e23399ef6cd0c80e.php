


<?php $__env->startSection('title'); ?>
    <?php echo e($data->mainTitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="return_part padding_top bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="single_return_part">
                    <h5 class="font_18 f_w_700"><?php echo e($data->returnTitle); ?></h5>
                    <?php echo $data->returnDescription; ?>

                    <div class="mt-5 w-100">
                        <a href="<?php echo e(url('/contact-us')); ?>" class="amaz_primary_btn style2 mb_20  add_to_cart flex-fill text-center"><?php echo e(__('common.contact_us')); ?></a>
                    </div>
                </div>
                <div class="exchange_part">
                    <h5 class="font_18 f_w_700 m-0"><?php echo e($data->exchangeTitle); ?></h5>
                    <?php echo $data->exchangeDescription; ?>

                    <div class="mt-5 w-100">
                        <a href="<?php echo e(url('/contact-us')); ?>" class="amaz_primary_btn style2 mb_20  add_to_cart flex-fill text-center"><?php echo e(__('common.contact_us')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/return_exchange.blade.php ENDPATH**/ ?>