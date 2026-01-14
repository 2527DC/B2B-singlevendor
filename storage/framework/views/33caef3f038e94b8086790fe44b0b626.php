

<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <form action="<?php echo e(route('checkpincode.update')); ?>" enctype="multipart/form-data" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($checkPincode->id); ?>">
        <div class="row">
                <?php echo csrf_field(); ?>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"> <?php echo e(__('checkpincode.edit_pincode')); ?> </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="formHtml" class="col-lg-12">
                        <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="pincode"><?php echo e(__('checkpincode.pincode')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="number" id="pincode" name="pincode" autocomplete="off" value="<?php if(isset($checkPincode) && !empty($checkPincode->pincode)): ?><?php echo e($checkPincode->pincode); ?><?php else: ?><?php echo e(old('pincode')); ?><?php endif; ?>" placeholder="<?php echo e(__('checkpincode.pincode')); ?>">
                                                <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_pincode"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="city"><?php echo e(__('checkpincode.city')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="text" id="city" name="city" autocomplete="off" value="<?php if(isset($checkPincode) && !empty($checkPincode->city)): ?><?php echo e($checkPincode->city); ?><?php else: ?><?php echo e(old('city')); ?><?php endif; ?>" placeholder="<?php echo e(__('checkpincode.city')); ?>">
                                                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_city"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="state"><?php echo e(__('checkpincode.state')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="text" id="state" name="state" autocomplete="off" value="<?php if(isset($checkPincode) && !empty($checkPincode->state)): ?><?php echo e($checkPincode->state); ?><?php else: ?><?php echo e(old('state')); ?><?php endif; ?>" placeholder="<?php echo e(__('checkpincode.state')); ?>">
                                                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_state"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="delivery_days"><?php echo e(__('checkpincode.delivery_days')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="number" id="delivery_days" name="delivery_days" autocomplete="off" value="<?php if(isset($checkPincode) && !empty($checkPincode->delivery_days)): ?><?php echo e($checkPincode->delivery_days); ?><?php else: ?><?php echo e(old('delivery_days')); ?><?php endif; ?>" placeholder="<?php echo e(__('checkpincode.delivery_days')); ?>">
                                                <?php $__errorArgs = ['delivery_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger" id="error_delivery_days"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""> <span class="ti-check"></span> <?php echo e(__('common.save')); ?> </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/CheckPincode/Resources/views/edit.blade.php ENDPATH**/ ?>