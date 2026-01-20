
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('frontend/default/css/frontend_style.css'))); ?>" />
<style>
    .min-height-630 {
        min-height: 630px;
    }
    #myFrame {
        -moz-transform: scale(0.80);
        -moz-transform-orgin: 0 0;
        -o-transform: scale(0.80);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.80);
        -webkit-transform-origin: 0 0;
        position: absolute;
        height: 130%;
        width: 120%;
    }
    @media (max-width: 1440px) {
        #myFrame {
            -moz-transform: scale(0.60);
            -moz-transform-orgin: 0 0;
            -o-transform: scale(0.60);
            -o-transform-origin: 0 0;
            -webkit-transform: scale(0.60);
            -webkit-transform-origin: 0 0;
            position: absolute;
            height: 170%;
            width: 165%;
        }
    }
    @media (max-width: 780px) {
        .iframe_div{
            min-height: 900px;
        }
        #myFrame {
            width: 125%;
        }
    }
    @media (max-width: 540px) {
        .iframe_div{
            min-height: 900px;
        }
        #myFrame {
            width: 155%;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30"> <?php echo e(__('appearance.color')); ?> <?php echo e(__('appearance.scheme')); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="white_box_50px box_shadow_white mb-40 min-height-630">
                    <form action="<?php echo e(route('appearance.themeColor.update',$themeColor->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="background_color"><?php echo e(__('common.select')); ?> <?php echo e(__('appearance.color')); ?> <?php echo e(__('appearance.scheme')); ?> <span class="text-danger">*</span></label>
                                    <select id="color_theme" required class="primary_select mb-15" name="color_theme_id">
                                        <?php $__currentLoopData = $themeColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($themeColor->id == $color->id ): ?> selected <?php endif; ?> value="<?php echo e($color->id); ?>"><?php
                                            switch ($color->id) {
                                                case '1':
                                                echo __("appearance.default");
                                                break;
                                                case '2':
                                                echo __("appearance.color_scheme_one");
                                                break;
                                                case '3':
                                                echo __("appearance.color_scheme_two");
                                                break;
                                                case '4':
                                                echo __("appearance.color_scheme_three");
                                                break;
                                                case '5':
                                                echo __("appearance.color_scheme_four");
                                                break;
                                                case '6':
                                                echo __("appearance.color_scheme_five");
                                                break;
                                            }
                                            ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="background_color"><?php echo e(__('marketing.background_color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="background_color" class="form-control" name="background_color" autocomplete="off" value="<?php echo e($themeColor->background_color); ?>">
                                    <?php $__errorArgs = ['background_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="base_color"><?php echo e(__('appearance.base_color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="base_color" name="base_color" value="<?php echo e($themeColor->base_color); ?>">
                                    <?php $__errorArgs = ['base_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="text_color"><?php echo e(__('appearance.text')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="text_color" class="form-control" name="text_color" autocomplete="off" value="<?php echo e($themeColor->text_color); ?>">
                                    <?php $__errorArgs = ['text_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="feature_color"><?php echo e(__('appearance.feature')); ?> <?php echo e(__('appearance.area')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="feature_color" class="form-control" name="feature_color" autocomplete="off" value="<?php echo e($themeColor->feature_color); ?>">
                                    <?php $__errorArgs = ['feature_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="footer_background_color"><?php echo e(__('appearance.footer')); ?> <?php echo e(__('appearance.background')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="footer_background_color" class="form-control" name="footer_background_color" autocomplete="off" value="<?php echo e($themeColor->footer_background_color); ?>">
                                    <?php $__errorArgs = ['footer_background_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_footer_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="footer_text_color"><?php echo e(__('appearance.footer')); ?> <?php echo e(__('appearance.text')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="footer_text_color" class="form-control" name="footer_text_color" autocomplete="off" value="<?php echo e($themeColor->footer_text_color); ?>">
                                    <?php $__errorArgs = ['footer_text_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_footer_text_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="navbar_color"><?php echo e(__('appearance.navbar')); ?> <?php echo e(__('appearance.area')); ?><?php echo e(__('appearance.color')); ?><span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="navbar_color" class="form-control" name="navbar_color" autocomplete="off" value="<?php echo e($themeColor->navbar_color); ?>">
                                    <?php $__errorArgs = ['navbar_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="menu_color"><?php echo e(__('appearance.menu')); ?> <?php echo e(__('appearance.area')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="menu_color" class="form-control" name="menu_color" autocomplete="off" value="<?php echo e($themeColor->menu_color); ?>">
                                    <?php $__errorArgs = ['menu_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="border_color"><?php echo e(__('appearance.border')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="border_color" class="form-control" name="border_color" autocomplete="off" value="<?php echo e($themeColor->border_color); ?>">
                                    <?php $__errorArgs = ['border_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="success_color"><?php echo e(__('common.success')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="success_color" class="form-control" name="success_color" autocomplete="off" value="<?php echo e($themeColor->success_color); ?>">
                                    <?php $__errorArgs = ['success_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="warning_color"><?php echo e(__('common.warning')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="warning_color" class="form-control" name="warning_color" autocomplete="off" value="<?php echo e($themeColor->warning_color); ?>">
                                    <?php $__errorArgs = ['warning_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="danger_color"><?php echo e(__('common.danger')); ?> <?php echo e(__('appearance.color')); ?> <span class="text-danger">*</span></label>
                                    <input required class="primary_input_field" type="color" id="danger_color" class="form-control" name="danger_color" autocomplete="off" value="<?php echo e($themeColor->danger_color); ?>">
                                    <?php $__errorArgs = ['danger_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger" id="error_background_color"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <?php if($themeColor->id != 1): ?>
                            <div class="primary_input">
                                <button type="submit" class="primary-btn fix-gr-bg mb-2 w-100" id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                            </div>
                            <?php endif; ?>
                            <?php if($themeColor->status == 1): ?>
                                <button class="primary-btn fix-gr-bg mb-2 w-100" disabled dusk="Add New"><?php echo e(__('common.activated')); ?></button>
                            <?php else: ?>
                                <div class="primary_input">
                                    <a href="<?php echo e(route('appearance.themeColor.activate',$themeColor->id)); ?>" class="primary-btn fix-gr-bg w-100" id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.active')); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="iframe_div">
                    <iframe id="myFrame" src="<?php echo e(url('/')); ?>" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($){
            "use strict";
            $(document).ready(function () {
                let iframe = document.getElementById("myFrame");
                $(document).on('change','#color_theme',function(){
                    var id = $('#color_theme').val();
                    window.location = "<?php echo e(route('appearance.themeColor.index')); ?>?id="+id;
                });
                setColorOnSchemeChange();
                $(document).on('input', '#background_color', function(){
                    setBackgroundColor();
                });
                $(document).on('input', '#base_color', function(){
                    setBaseColor();
                });
                $(document).on('input', '#text_color', function(){
                    setTextColor();
                });
                $(document).on('input', '#feature_color', function(){
                    setFeatureColor();
                });
                $(document).on('input', '#footer_background_color', function(){
                    setFooterBackgroundColor();
                });
                $(document).on('input', '#footer_text_color', function(){
                    setFooterTextColor();
                });
                $(document).on('input', '#navbar_color', function(){
                    setNavbarColor();
                });
                $(document).on('input', '#menu_color', function(){
                   setMenuColor();
                });
                $(document).on('input', '#border_color', function(){
                    setBorderColor();
                });
            });
            function setColorOnSchemeChange(){
                setBaseColor();
                setFeatureColor();
                setBackgroundColor();
                setFooterBackgroundColor();
                setFooterTextColor();
                setNavbarColor();
                setMenuColor();
                setBorderColor();
                setTextColor();
            }
            function setFeatureColor(){
                $('#myFrame').contents().find('.project_estimate').css('background-color', $("#feature_color").val());
            }
            function setBackgroundColor(){
                $('#myFrame').contents().find('body').css('background-color', $("#background_color").val());
            }
            function setFooterBackgroundColor(){
                $('#myFrame').contents().find('.footer_part').css('background-color', $("#footer_background_color").val());
            }
            function setFooterTextColor(){
                $('#myFrame').contents().find('.footer_part').css('background-color', $("#footer_text_color").val());
            }
            function setNavbarColor(){
                $('#myFrame').contents().find('.header_part .main_menu').css('background-color', $("#navbar_color").val());
            }
            function setMenuColor(){
                $('#myFrame').contents().find('.side-menu').css('background-color', $("#menu_color").val());
                $('#myFrame').contents().find('.nav li a').css('background-color', $("#menu_color").val());
            }
            function setBorderColor(){
                $('#myFrame').contents().find('.category_box_input').css('border-color', $("#border_color").val());
                $('#myFrame').contents().find('.header_part .main_menu .category_box .select2-container--default .select2-selection--single').css('border', $("#border_color").val());
            }
            function setBaseColor(){
                $('#myFrame').contents().find('.input-group-append').css('background-color', $("#base_color").val());
                $('#myFrame').contents().find('.product_btn').css('background-color', $("#base_color").val());
                $('#myFrame').contents().find('.load_more_btn_homepage').css('background-color', $("#base_color").val());
                $('#myFrame').contents().find('.input-group-text').css('background-color', $("#base_color").val());
            }
            function setTextColor(){
                $('#myFrame').contents().find('h1').css('color', $("#text_color").val());
                $('#myFrame').contents().find('h2').css('color', $("#text_color").val());
                $('#myFrame').contents().find('h3').css('color', $("#text_color").val());
                $('#myFrame').contents().find('h4').css('color', $("#text_color").val());
                $('#myFrame').contents().find('h5').css('color', $("#text_color").val());
                $('#myFrame').contents().find('h6').css('color', $("#text_color").val());
                $('#myFrame').contents().find('p').css('color', $("#text_color").val());
                $('#myFrame').contents().find('a').css('color', $("#text_color").val());
                $('#myFrame').contents().find('.header_part .sub_menu .left_sub_menu .select_option a span').css('color', $("#text_color").val());
            }
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Appearance/Resources/views/theme_color/index.blade.php ENDPATH**/ ?>