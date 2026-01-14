
<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('frontend/default/css/page_css/otp.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="login_area register_part">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-4">
                <div class="register_form_iner">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="login_logo text-center mb-3">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>"></a>
                    </div>
                    <h2><?php echo e(__('otp.otp_is_sent')); ?> </h2>
                    <form method="POST" class="register_form" action="<?php echo e(route('otp_check')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <br>
                                <br>
                                <label for="email"><?php echo e(__('otp.otp')); ?></label>
                            </div>
                            <div class="col-md-6 float-right">
                                <div class="float-right">
                                    <div id="app"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" id="otp" name="otp" placeholder="<?php echo e(__('otp.enter_otp')); ?>" required
                                    value="<?php echo e(old('otp')); ?>" class="<?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = ''">

                                <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <input type="hidden" name="first_name" value="<?php echo e($request->first_name); ?>">
                            <input type="hidden" name="last_name" value="<?php echo e($request->last_name); ?>">
                            <input type="hidden" name="email" value="<?php echo e($request->email); ?>">
                            <input type="hidden" name="referral_code" value="<?php echo e($request->referral_code); ?>">
                            <input type="hidden" name="password" value="<?php echo e($request->password); ?>">
                            <input type="hidden" id="code_validation_time" name="code_validation_time" value="">
                            <input type="hidden" name="password_confirmation"
                                value="<?php echo e($request->password_confirmation); ?>">


                            <div class="col-md-12 text-center">
                                <div class="register_area">
                                    <button type="submit" id="btnSubmit" class="btn_1"><?php echo e(__('common.submit')); ?></button>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <p> <a href="<?php echo e(route('resend_otp',$request->all())); ?>"><?php echo e(__('otp.resend_otp')); ?></a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.partials._otp_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('frontend.default.auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/auth/otp.blade.php ENDPATH**/ ?>