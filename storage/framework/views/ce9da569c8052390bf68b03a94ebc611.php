

<?php $__env->startSection('content'); ?>
<div class="amazy_login_area">
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center">
        <div class="amazy_login_form">
            <a href="<?php echo e(url('/')); ?>" class="logo mb_50 d-block">
                <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>">
            </a>
            <h3 class="m-0"><?php echo e(__('amazy.Sign In')); ?> </h3>
            <p class="support_text"><?php echo e(__('auth.See your growth and get consulting support!')); ?></p>
            <?php if(config('app.sync')): ?>
                <div class="d-flex justify-content-center mt-20 grid_gap_5 flex-wrap">
                    <button class="amaz_primary_btn style2 radius_5px text-uppercase  text-center mb_25" id="admin" data-email="<?php echo e($admin_email); ?>"><?php echo e(__('common.admin')); ?></button>
                </div>
            <?php endif; ?>
            <br>


            <form action="<?php echo e(route('admin.login_submit')); ?>" method="POST" name="login" id="login_form">
                <?php echo csrf_field(); ?>

                <?php if(config('app.sync')): ?>
                    <input type="hidden" id="auto_login" name="auto_login" value="true">
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 mb_20">
                        <label class="primary_label2"><?php echo e(__('amazy.Email address or phone')); ?> <span>*</span> </label>
                        <input name="login" id="text" placeholder="<?php echo e(__('amazy.Email address or phone')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('amazy.Email address or phone')); ?>'" class="primary_input3 radius_5px" type="text">
                        <span class="text-danger" ><?php echo e($errors->first('email')); ?></span>
                        <span class="text-danger" ><?php echo e($errors->first('username')); ?></span>
                    </div>
                    <div class="col-12 mb_20">
                        <label class="primary_label2"><?php echo e(__('common.password')); ?> <span>*</span></label>
                        <input name="password" id="password" placeholder="<?php echo e(__('amazy.Min. 8 Character')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('amazy.Min. 8 Character')); ?>'" class="primary_input3 radius_5px" type="password">
                        <span class="text-danger" ><?php echo e($errors->first('password')); ?></span>
                    </div>
                    <?php if(env('NOCAPTCHA_FOR_LOGIN') == "true"): ?>
                    <div class="col-12 mb_20">
                        <?php if(env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                        <div class="g-recaptcha" data-callback="callback" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                        <?php endif; ?>
                        <span class="text-danger" ><?php echo e($errors->first('g-recaptcha-response')); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="col-12 mb_20">
                        <label class="primary_checkbox d-flex">
                            <input name="remember" id="remember" type="checkbox" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <span class="checkmark mr_15"></span>
                            <span class="label_name f_w_400 "><?php echo e(__('defaultTheme.remember_me')); ?></span>
                        </label>
                    </div>
                    <div class="col-12">
                        <?php if(env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                        <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('auth.Sign In')); ?></button>
                        <?php else: ?>
                        <button class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" id="sign_in_btn"><?php echo e(__('auth.Sign In')); ?></button>
                        <?php endif; ?>
                    </div>
                    <div class="col-12">
                        <p class="sign_up_text"><?php echo e(__('amazy.Forgot Password?')); ?> <a href="<?php echo e(url('/password/reset')); ?>"><?php echo e(__('common.click_here')); ?></a></p>
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
                <h4><?php echo e(isset($loginPageInfo->title)? $loginPageInfo->title:''); ?>.</h4>
                <p class="m-0"><?php echo e(isset($loginPageInfo->sub_title)? $loginPageInfo->sub_title:''); ?>.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("login_form").submit();
    }
</script>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $('#submit_btn').removeAttr('disabled');
                $(document).on('submit', '#login_form', function(event){

                    $('#login_form > div > div:nth-child(1) > span:nth-child(3)').text('');
                    $('#login_form > div > div:nth-child(2) > span').text('');
                    $('#login_form > div > div:nth-child(1) > span:nth-child(4)').text('');

                    let email = $('#text').val();
                    let password = $('#password').val();

                    let val_check = 0;

                    if(email == ''){
                        $('#login_form > div > div:nth-child(1) > span:nth-child(3)').text('The email or phone field is required.');
                        val_check = 1;
                    }

                    if(password == ''){
                        $('#login_form > div > div:nth-child(2) > span').text('The password field is required.');
                        val_check = 1;
                    }

                    if(val_check == 1){
                        event.preventDefault();
                    }
                });

                <?php if(config('app.sync')): ?>
                    $(document).on('click', '#admin', function(event){
                        $('#sign_in_btn').attr('disabled', true);
                        let email = $(this).data('email');
                        $("#text").val('');
                        $("#password").val('');
                        if(email != ''){
                            $("#text").val(email);
                            $("#password").val('12345678');
                            $('#login_form').submit();
                        }else{
                            toastr.error('Please Create a Admin First.', 'Error');
                        }
                    });
                    $(document).on('change', '#password', function(){
                        let value = $(this).val();
                        if($('#auto_login').length){
                            $('#auto_login').val(value == '12345678');
                        }
                    });
                <?php endif; ?>

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/auth/admin_login.blade.php ENDPATH**/ ?>