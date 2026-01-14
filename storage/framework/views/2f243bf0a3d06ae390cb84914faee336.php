
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/generalsetting/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<style>
    .removeUpImage{
        position: absolute !important;
        top: -10px;
        left: -10px;
        padding: 0 !important;
        width: 30px;
        height: 30px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 100% !important;        
    }
    .removeUpImage i{
        margin: 0 !important;
    }
   

</style>
<?php $__env->startSection('mainContent'); ?>
    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row pt-20">
                        <div class="main-title pl-3 pt-10">
                            <h3 class="mb-30"><?php echo e(__('general_settings.maintenance')); ?> <?php echo e(__('common.setting')); ?></h3>
                        </div>
                    </div>
                    <form class="form-horizontal" action="<?php echo e(route('maintenance.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="white-box">
                            <div class="col-md-12 p-0">
                                <div class="row mb-30">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for=""><?php echo e(__('common.title')); ?></label>
                                                    <input class="primary_input_field" placeholder="-" type="text"
                                                           name="title"
                                                           value="<?php echo e($setting->maintenance_title); ?>">
                                                    <?php $__errorArgs = ['title'];
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
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for=""><?php echo e(__('common.sub_title')); ?>  </label>
                                                    <input class="primary_input_field" placeholder="-" type="text"
                                                           name="subtitle"
                                                           value="<?php echo e($setting->maintenance_subtitle); ?>">
                                                    <?php $__errorArgs = ['subtitle'];
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
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="primary_input mb-25">
                                                    <div class="banner_img_div position-relative d-block">
                                                        <div class="removeUpImage primary-btn fix-gr-bg <?php echo e($setting->maintenance_banner ? "" : ""); ?>">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                        <img class="imagePreview1 removeUpImage w-100 h-100"
                                                            src="<?php echo e(showImage($setting->maintenance_banner)); ?>"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.maintenance_page_banner')); ?> (<?php echo e(getNumberTranslate(1300)); ?>x<?php echo e(getNumberTranslate(920)); ?>) <?php echo e(__('common.px')); ?>

                                                    </label>
                                                    <div class="primary_file_uploader">
                                                        <input
                                                            class="primary-input  filePlaceholder"
                                                            type="text" id="filePlaceholder"
                                                            placeholder="Browse file"
                                                            readonly="" <?php echo e($errors->has('course_page_banner') ? ' autofocus' : ''); ?>>
                                                        <button class="" type="button">
                                                            <label class="primary-btn small fix-gr-bg"
                                                                   for="file1"><?php echo e(__('common.browse')); ?></label>
                                                            <input type="file" class="d-none fileUpload imgInput1"
                                                                   name="banner" id="file1">
                                                        </button>
                                                    </div>
                                                    <?php $__errorArgs = ['banner'];
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
                                            </div>
                                            <div class="col-xl-6 dripCheck">
                                                <div class="primary_input mb-25">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="primary_input_label"
                                                                   for=""> <?php echo e(__('general_settings.maintenance')); ?> <?php echo e(__('general_settings.mode')); ?></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="radio"
                                                                           class="common-radio "
                                                                           id="yes"
                                                                           name="status"
                                                                           <?php echo e($setting->maintenance_status==1?'checked':''); ?>

                                                                           value="1">
                                                                    <label
                                                                        for="yes"><?php echo e(__('common.yes')); ?></label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="radio"
                                                                           class="common-radio "
                                                                           id="no"
                                                                           name="status"
                                                                           value="0" <?php echo e($setting->maintenance_status==0?'checked':''); ?>>
                                                                    <label
                                                                        for="no"><?php echo e(__('common.no')); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php $__errorArgs = ['status'];
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row justify-content-center">
                                            <?php if(session()->has('message-success')): ?>
                                                <p class=" text-success">
                                                    <?php echo e(session()->get('message-success')); ?>

                                                </p>
                                            <?php elseif(session()->has('message-danger')): ?>
                                                <p class=" text-danger">
                                                    <?php echo e(session()->get('message-danger')); ?>

                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(permissionCheck('maintenance.update')): ?>
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                        <span class="ti-check"></span>
                                        <?php echo e(__('common.update')); ?>

                                    </button>
                                </div>
                            </div>
                            <?php else: ?>
                            <span class="text-danger"><?php echo e(__('common.no_action_permitted')); ?></span>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('change', '#file1', function(event){
                    getFileName($(this).val(),'#filePlaceholder');
                    imageChangeWithFile($(this)[0],'.imagePreview1');
                });
            });
        })(jQuery);
    </script>
     <script>
        $(document).on('change', '.imgInput1', function(event){
            let name = $(this).data('name');
            let view = $(this).data('view');
            getFileName($(this).val(),name);
            imageChangeWithFile($(this)[0], view);
            $('.removeUpImage').removeClass('d-none');
        });

        $(".removeUpImage").click(function(){
            var img_src = $('#uploadImgShow').attr('src');
            if (img_src == '') {
                return false;
            }
            $('#pre-loader').show();
            $('#linkImageClickId').attr('placeholder', '<?php echo e(__('common.browse_image_file')); ?>');
            $('.removeUpImage').addClass('d-none');
            $('#uploadImgShow').attr("src","<?php echo e(showImage('frontend/default/img/avatar.jpg')); ?>");
            $('#customerMiniImage').attr("src","<?php echo e(showImage('frontend/default/img/avatar.jpg')); ?>");
            var formData = new FormData();
            formData.append('_token', "<?php echo e(csrf_token()); ?>");
            formData.append('image',img_src);
            $.ajax({
                    url: "<?php echo e(route('customer.profile.image.delete')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                            toastr.success("<?php echo e(__('common.deleted_successfully')); ?>");
                            $('#pre-loader').hide();
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').hide();
                            return false;
                        }
                        toastr.error("<?php echo e(__('common.address_already_used')); ?>", "<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/maintenance/index.blade.php ENDPATH**/ ?>