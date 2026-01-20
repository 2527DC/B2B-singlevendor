

<?php $__env->startSection('content'); ?>
<div class="amazy_login_area">
    <?php
        $loginPageInfo = \Modules\FrontendCMS\Entities\LoginPage::findOrFail(4);
    ?>
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center">
        <div class="amazy_login_form">
            <a href="<?php echo e(url('/')); ?>" class="logo mb_50 d-block">
                <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>">
            </a>
            <h3 class="m-0"><?php echo e(__('amazy.Welcome back')); ?></h3>
            <p class="support_text"><?php echo e(__('amazy.Please send password link.')); ?></p>
            <br>

            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('password.email')); ?>" method="POST" id="email_form">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-12 mb_20">
                        <label class="primary_label2"><?php echo e(__('common.email_address')); ?> <span>*</span> </label>
                        <input name="email" id="email" type="email" placeholder="<?php echo e(__('common.email_address')); ?>" value="<?php echo e(old('email')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.email_address')); ?>'" class="primary_input3 radius_5px">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger" ><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <?php if(env('NOCAPTCHA_FOR_EMAIL') == "true"): ?>
                    <div class="col-12 mb_20">
                        <?php if(env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                        <div class="g-recaptcha" data-callback="callback" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                        <?php endif; ?>
                        <span class="text-danger" ><?php echo e($errors->first('g-recaptcha-response')); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <?php if(env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                        <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('amazy.Send link')); ?></button>
                        <?php else: ?>
                        <button class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" id="sign_in_btn"><?php echo e(__('amazy.Send link')); ?></button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="amazy_login_area_right d-flex align-items-center justify-content-center">
        <div class="amazy_login_area_right_inner d-flex align-items-center justify-content-center flex-column">
            <div class="thumb">
                <img class="img-fluid" src="<?php echo e(showImage($loginPageInfo->cover_img)); ?>" alt="<?php echo e(isset($loginPageInfo->title)? $loginPageInfo->title:''); ?>" title="<?php echo e(isset($loginPageInfo->title)? $loginPageInfo->title:''); ?>">
            </div>
            <div class="login_text d-flex align-items-center justify-content-center flex-column text-center">
                <h4><?php echo e(isset($loginPageInfo->title)? $loginPageInfo->title:''); ?></h4>
                <p class="m-0"><?php echo e(isset($loginPageInfo->sub_title)? $loginPageInfo->sub_title:''); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("email_form").submit();
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.amazy.auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/auth/email.blade.php ENDPATH**/ ?>