

<?php $__env->startSection('title'); ?>
    <?php echo e(__('defaultTheme.track_order')); ?>

<?php $__env->stopSection(); ?>
<style>
    .order_tracking_area{
        padding: 50px 0px;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="order_tracking_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-8 col-md-10">
                    <div class="tracking_form">

                        <h3 class="font_30 f_w_700 mb_5"><?php echo e(__('defaultTheme.track_your_order')); ?></h3>
                        <p class="mb-4"><?php echo e(__('defaultTheme.enter_your_order_id_in_the_box_below_and_press_the_track_button')); ?></p>

                        <form action="<?php echo e(route('frontend.order.track_find')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12 mb_20">
                                    <label class="primary_label2 style2"><?php echo e(__('defaultTheme.order_tracking_number')); ?> <span>*</span></label>
                                    <input id="order_number" name="order_number"
                                    value="<?php echo e(old('order_number')); ?>"
                                    placeholder="<?php echo e(__('defaultTheme.order_tracking_number')); ?>" value="<?php echo e(old('order_number')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.order_tracking_number')); ?>'" class="primary_input3 rounded-0 style2" type="text">
                                    <?php $__errorArgs = ['order_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php if(auth()->guard()->guest()): ?>
                                    <?php if(app('general_setting')->track_order_by_secret_id): ?>
                                        <div class="col-12 mb_20">
                                            <label class="primary_label2 style2"><?php echo e(__('defaultTheme.secret_id_only_for_guest_user')); ?> <span>*</span></label>
                                            <input id="guest_id" name="secret_id"
                                            placeholder="<?php echo e(__('defaultTheme.secret_id_only_for_guest_user')); ?>"
                                            value="<?php echo e(old('secret_id')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.secret_id_only_for_guest_user')); ?>'" class="primary_input3 rounded-0 style2" required type="text">
                                            <?php $__errorArgs = ['secret_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="col-12">
                                    <button class="amaz_primary_btn  rounded-0  w-100 text-uppercase  text-center"><?php echo e(__('defaultTheme.track_now')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/track_order.blade.php ENDPATH**/ ?>