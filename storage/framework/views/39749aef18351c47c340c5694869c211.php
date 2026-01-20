<?php $__env->startPush('styles'); ?>
    <style>
        .primary_bulet_checkbox .checkmark{
            top: 2px;
        }
        .term_link_set, .policy_link_set{
            color: var(--base_color);
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="amazy_login_area">
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center">
        <div class="amazy_login_form">
            <a href="<?php echo e(url('/')); ?>" class="logo mb_50 d-block">
                <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>">
            </a>
            <h3 class="m-0"><?php echo e(__('auth.Sign Up')); ?></h3>
            <p class="support_text"><?php echo e(__('auth.See your growth and get consulting support!')); ?></p>

            <?php if(app('general_setting')->google_status): ?>
            <a href="<?php echo e(url('/login/google')); ?>" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="<?php echo e(url('/')); ?>/public/frontend/amazy/img/svg/google_icon.svg" alt="<?php echo e(__('auth.Sign up with Google')); ?>" title="<?php echo e(__('auth.Sign up with Google')); ?>">
                <h5 class="m-0 font_16 f_w_500"><?php echo e(__('auth.Sign up with Google')); ?></h5>
            </a>
            <?php endif; ?>
            <?php if(app('general_setting')->facebook_status): ?>
            <a href="<?php echo e(url('/login/facebook')); ?>" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="<?php echo e(url('/')); ?>/public/frontend/amazy/img/svg/facebook_icon.svg" alt="<?php echo e(__('auth.Sign up with Facebook')); ?>" title="<?php echo e(__('auth.Sign up with Facebook')); ?>">
                <h5 class="m-0 font_16 f_w_500"><?php echo e(__('auth.Sign up with Facebook')); ?></h5>
            </a>
            <?php endif; ?>
            <?php if(app('general_setting')->twitter_status): ?>
            <a href="<?php echo e(url('/login/twitter')); ?>" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="<?php echo e(url('/')); ?>/public/frontend/amazy/img/svg/twitter_icon.svg" alt="<?php echo e(__('auth.Sign up with Twitter')); ?>" title="<?php echo e(__('auth.Sign up with Twitter')); ?>">
                <h5 class="m-0 font_16 f_w_500"><?php echo e(__('auth.Sign up with Twitter')); ?></h5>
            </a>
            <?php endif; ?>
            <?php if(app('general_setting')->linkedin_status): ?>
            <a href="<?php echo e(url('/login/linkedin')); ?>" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="<?php echo e(url('/')); ?>/public/frontend/amazy/img/svg/linkedin_icon.svg" alt="<?php echo e(__('auth.Sign up with LinkedIn')); ?>" title="<?php echo e(__('auth.Sign up with LinkedIn')); ?>">
                <h5 class="m-0 font_16 f_w_500"><?php echo e(__('auth.Sign up with LinkedIn')); ?></h5>
            </a>
            <?php endif; ?>

            <div class="form_sep2 d-flex align-items-center">
                <span class="sep_line flex-fill"></span>
                <span class="form_sep_text font_14 f_w_500 "><?php echo e(__('auth.Sign up with Email or Phone')); ?></span>
                <span class="sep_line flex-fill"></span>
            </div>
            <form action="<?php echo e(route('register')); ?>" method="POST" name="register" id="register_form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <?php if(!empty($row) && !empty($form_data)): ?>
                        <?php
                            $default_field = [];
                            $custom_field = [];
                        ?>

                         <?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if($row->type != 'header' && $row->type !='paragraph'){
                                    if(property_exists($row,'className') && strpos($row->className, 'default-field') !== false){
                                        $default_field[] = $row->name;
                                    }else{
                                        $custom_field[] = $row->name;
                                    }
                                    $required = property_exists($row,'required');
                                    $type = property_exists($row,'subtype') ? $row->subtype : $row->type;
                                    $placeholder = property_exists($row,'placeholder') ? $row->placeholder : trans('formBuilder.'.$row->label);
                                }
                            ?>

                            <?php if($row->type =='header' || $row->type =='paragraph'): ?>
                                <div class="col-lg-12">
                                    <<?php echo e($row->subtype); ?>><?php echo e(trans('formBuilder.'.$row->label)); ?></<?php echo e($row->subtype); ?>>
                                </div>
                            <?php elseif($row->type == 'text' || $row->type == 'number' || $row->type == 'email' || $row->type == 'date'): ?>
                                <div class="col-12 mb_20">
                                    <label for="<?php echo e($row->name); ?>" class="primary_label2"> <?php echo e(trans('formBuilder.'.$row->label)); ?> <?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                    <input <?php echo e($required ? 'required' :''); ?> type="<?php echo e($type); ?>" id="<?php echo e($row->name); ?>" class="primary_input3 radius_5px <?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="<?php echo e($row->name); ?>" value="<?php echo e(old($row->name)); ?>" placeholder="<?php echo e(trans('formBuilder.'.$row->label)); ?>">
                                    <?php $__errorArgs = [$row->name];
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
                            <?php elseif($row->type=='select'): ?>
                                <div class="col-xl-12 mb_25">
                                    <div class="form-group input_div_mb">
                                        <label class="primary_label2 style4" for=<?php echo e($row->name); ?>><?php echo e(trans('formBuilder.'.$row->label)); ?><?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                        <select <?php echo e($required ? 'required' :''); ?> name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" class=" theme_select style2 wide">
                                            <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->value); ?>" <?php echo e(old($row->name) == $value->value? 'selected': ''); ?>><?php echo e($value->label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first($row->name)); ?></span>
                                    </div>
                                </div>

                            <?php elseif($row->type == 'date'): ?>
                                <div class="col-12 mb_30">
                                    <label for="start_datepicker" class="primary_label2 style2 "> <?php echo e(trans('formBuilder.'.$row->label)); ?> <?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                    <input <?php echo e($required ? 'required' :''); ?> type="<?php echo e($type); ?>" id="start_datepicker" class="primary_input3 style4 mb-0 <?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="<?php echo e($row->name); ?>" value="<?php echo e(old($row->name)); ?>" placeholder="<?php echo e(trans('formBuilder.'.$row->label)); ?>">
                                    <?php $__errorArgs = [$row->name];
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

                            <?php elseif($row->type=='textarea'): ?>
                                <div class="col-md-12 mb-10">
                                    <label for=<?php echo e($row->name); ?>><?php echo e(trans('formBuilder.'.$row->label)); ?><?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                    <textarea class="form-control" <?php echo e($required ? 'required' :''); ?> name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" placeholder="<?php echo e(trans('formBuilder.'.$row->label)); ?>"><?php echo e(old($row->name)); ?></textarea>
                                    <span class="text-danger"><?php echo e($errors->first($row->name)); ?></span>
                                </div>

                            <?php elseif($row->type=="radio-group"): ?>
                                <div class="col-lg-12 mb_20">
                                    <label for=""><?php echo e(trans('formBuilder.'.$row->label)); ?></label>
                                    <div class="d-flex radio-btn-flex">
                                        <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="primary_bulet_checkbox">
                                                <input type="radio" name="<?php echo e($row->name); ?>" class="payment_method" value="<?php echo e($value->value); ?>">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a class="ml_10 mr_10 text_color"><?php echo e($value->label); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php elseif($row->type=="checkbox-group"): ?>
                                <div class="col-12 mb_25">
                                    <label><?php echo e(trans('formBuilder.'.$row->label)); ?></label>
                                    <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="primary_checkbox d-flex">
                                        <input value="<?php echo e($value->value); ?>" id="term_check" name="<?php echo e($row->name); ?>[]" checked type="checkbox">
                                        <span class="checkmark mr_15"></span>
                                        <span class="label_name f_w_400 "><?php echo e($value->label); ?></span>
                                        <span id="error_term_check" class="text-danger"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            <?php elseif($row->type =='file'): ?>
                                <div class="col-lg-12 mb_20">
                                    <label for="<?php echo e($row->name); ?>" class="primary_label2 style3"><?php echo e(trans('formBuilder.'.$row->label)); ?><?php if($required): ?> <span class="text-danger">*</span> <?php endif; ?></label>
                                    <input type="<?php echo e($type); ?>" accept="image/*" class="primary_input3 style4 radius_3px pd_12" name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" >
                                </div>
                            <?php elseif($row->type =='checkbox'): ?>
                                <div class="col-md-12 mb_20 mt_10">
                                    <label class="primary_checkbox d-flex">
                                        <input id="policyCheck" type="checkbox" checked>
                                        <span class="checkmark mr_15"></span>
                                        <span class="label_name f_w_400 "><?php echo $row->label; ?></span>
                                    </label>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php else: ?>
                        <div class="col-12 mb_20">
                            <label class="primary_label2"><?php echo e(__('formBuilder.first_name')); ?> <span>*</span> </label>
                            <input name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="<?php echo e(__('formBuilder.first_name')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.first_name')); ?>'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" ><?php echo e($errors->first('first_name')); ?></span>
                        </div>
                        <div class="col-12 mb_20">
                            <label class="primary_label2"><?php echo e(__('formBuilder.last_name')); ?></label>
                            <input name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="<?php echo e(__('formBuilder.last_name')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.last_name')); ?>'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" ><?php echo e($errors->first('last_name')); ?></span>
                        </div>

                            <div class="col-12 mb_20">
        <label class="primary_label2">Store Name <span>*</span></label>
        <input name="store_name" value="<?php echo e(old('store_name')); ?>" class="primary_input3 radius_5px" type="text" required>
        <span class="text-danger"><?php echo e($errors->first('store_name')); ?></span>
    </div>

    <div class="col-12 mb_20">
        <label class="primary_label2">Document Type <span>*</span></label>
        <select name="document_type" class="primary_input3 radius_5px" required>
            <option value="">Select Document</option>
            <option value="GST" <?php echo e(old('document_type') == 'GST' ? 'selected' : ''); ?>>GST</option>
            <option value="MSME" <?php echo e(old('document_type') == 'MSME' ? 'selected' : ''); ?>>MSME</option>
        </select>
        <span class="text-danger"><?php echo e($errors->first('document_type')); ?></span>
    </div>

    <div class="col-12 mb_20">
        <label class="primary_label2">Upload Document <span>*</span></label>
        <input type="file" name="document" class="primary_input3 radius_5px" accept=".jpg,.jpeg,.png,.pdf" required>
        <span class="text-danger"><?php echo e($errors->first('document')); ?></span>
    </div>


                        <?php if(isModuleActive('Otp') && otp_configuration('otp_activation_for_customer') || app('business_settings')->where('type', 'email_verification')->first()->status == 0): ?>
                        <div class="col-12 mb_20">
                            <label class="primary_label2"><?php echo e(__('formBuilder.phone')); ?> <span>*</span></label>
                            <input name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('formBuilder.phone')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.email_or_phone')); ?>'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" ><?php echo e($errors->first('email')); ?></span>
                        </div>
                        <?php else: ?>
                        <div class="col-12 mb_20">
                            <label class="primary_label2"><?php echo e(__('formBuilder.email')); ?> <span>*</span></label>
                            <input name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('formBuilder.email')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.email')); ?>'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" ><?php echo e($errors->first('email')); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="col-12 mb_20">
                            <label for="referral_code" class="primary_label2"><?php echo e(__('formBuilder.referral_code_(optional)')); ?></label>
                            <input name="referral_code" id="referral_code" value="<?php echo e(old('referral_code')); ?>" placeholder="<?php echo e(__('formBuilder.referral_code')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.referral_code')); ?>'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" ><?php echo e($errors->first('referral_code')); ?></span>
                        </div>
                        <div class="col-12 mb_20">
                            <label class="primary_label2"><?php echo e(__('formBuilder.password')); ?> <span>*</span></label>
                            <input name="password" id="password" placeholder="<?php echo e(__('amazy.Min. 8 Character')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('amazy.Min. 8 Character')); ?>'" class="primary_input3 radius_5px" type="password">
                            <span class="text-danger" ><?php echo e($errors->first('password')); ?></span>
                        </div>
                        <div class="col-12 mb_20">
                            <label class="primary_label2" for="password-confirm"><?php echo e(__('formBuilder.confirm_password')); ?> <span>*</span></label>
                            <input name="password_confirmation" id="password-confirm" placeholder="<?php echo e(__('amazy.Min. 8 Character')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('amazy.Min. 8 Character')); ?>'" class="primary_input3 radius_5px" type="password">
                        </div>


                    <?php endif; ?>

                    <?php if(env('NOCAPTCHA_FOR_REG') == "true"): ?>
                    <div class="col-12 mb_20">
                        <?php if(env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                        <div class="g-recaptcha" data-callback="callback" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                        <?php endif; ?>
                        <span class="text-danger" ><?php echo e($errors->first('g-recaptcha-response')); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <?php if(env('NOCAPTCHA_INVISIBLE') == "true"): ?>
                        <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" data-size="invisible" data-callback="onSubmit"><?php echo e(__('auth.Sign Up')); ?></button>
                        <?php else: ?>
                        <button class="amaz_primary_btn style2 radius_5px  w-100 text-uppercase  text-center mb_25" id="sign_in_btn"><?php echo e(__('auth.Sign Up')); ?></button>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-12 mb_20 mt_10">
                        <label class="primary_checkbox d-flex">
                            <input id="policyCheck" type="checkbox" >
                            <span class="checkmark mr_15"></span>
                            <p class="label_name f_w_400"> <?php echo e(__('formBuilder.By signing up, you agree to ')); ?> <a href="/privacy-policy-terms-and-conditions"><?php echo e(__('formBuilder.Terms of Service ')); ?></a> <?php echo e(__('formBuilder.and')); ?> <a href="/privacy-policy-terms-and-conditions"><?php echo e(__('formBuilder.Privacy Policy')); ?></a></p>
                        </label>
                    </div>
                    <div class="col-12">
                        <p class="sign_up_text"><?php echo e(__('auth.Already have an Account?')); ?>  <a href="<?php echo e(url('/login')); ?>"><?php echo e(__('auth.Sign In')); ?></a></p>
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
        document.getElementById("register_form").submit();
    }
</script>
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $(document).on('submit', '#register_form', function(event){
                if($("#policyCheck").prop('checked')!=true){
                    event.preventDefault();
                    toastr.error("<?php echo e(__('common.please_agree_with_our_policy_privacy')); ?>","<?php echo e(__('common.error')); ?>");
                    return false;
                }
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/auth/register.blade.php ENDPATH**/ ?>