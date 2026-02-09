

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
            <h3 class="m-0"><?php echo e(__('common.welcome')); ?>! <?php echo e(__('common.please')); ?></h3>
            <p class="support_text"><?php echo e(__('defaultTheme.verify_your_email')); ?>.</p>
            <br>

            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('frontend.resend-link',$user->id)); ?>}" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="hidden" name="verify_code" value="<?php echo e($user->verify_code); ?>">
                    <div class="col-12">
                        <button class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" id="submitBtn"><?php echo e(__('defaultTheme.click_here_to_request_another')); ?></button>
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
<?php echo $__env->make('frontend.amazy.auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/email_verify.blade.php ENDPATH**/ ?>