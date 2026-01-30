

<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/backend_page_css/staff_create.css'))); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<style>
/* File input container fix */
input[type="file"] {
    height: 42px;                 /* match your input height */
    display: flex;
    align-items: center;          /* vertical center */
}

/* Inner "Choose File" button */
input[type="file"]::file-selector-button {
    margin-top: 6px;
    height: 28px;
    padding: 4px 12px;
    font-size: 12px;
    line-height: 1;
}

/* Chrome / Edge / Safari */
input[type="file"]::-webkit-file-upload-button {
    margin: 3;
    height: 28px;
    padding: 4px 12px;
    font-size: 12px;
    line-height: 1;
}


</style>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30"><?php echo e(__('common.add_new')); ?> <?php echo e(__('common.customer')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="<?php echo e(route('admin.customer.store')); ?>" method="POST" id="staff_addForm"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30"><?php echo e(__('common.basic_info')); ?></h3>
                                </div>
                            </div>
                            <hr>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.first_name')); ?> <span
                                            class="text-danger">*</span></label>
                                    <input name="first_name" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.first_name')); ?>" type="text"
                                        value="<?php echo e(old('first_name')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('first_name')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.last_name')); ?></label>
                                    <input name="last_name" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.last_name')); ?>" type="text"
                                        value="<?php echo e(old('last_name')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('last_name')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.email_or_phone')); ?> <span class="text-danger">*</span></label>
                                    <input name="email" class="primary_input_field user_id name"
                                        placeholder="<?php echo e(__('common.email_or_phone')); ?>" type="text" value="<?php echo e(old('email')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                </div>
                                <p class="text-danger user_id_row d-none"><?php echo e(__('common.your_user_id_is')); ?> : <span
                                        class="generated_user_id"></span></p>
                            </div>
                            <div class="col-xl-4">
    <div class="primary_input mb-25">
        <label class="primary_input_label">
            Store Name <span class="text-danger">*</span>
        </label>
        <input
            name="store_name"
            class="primary_input_field"
            placeholder="Store Name"
            type="text"
            value="<?php echo e(old('store_name')); ?>"
            required
        >
        <span class="text-danger"><?php echo e($errors->first('store_name')); ?></span>
    </div>
</div>

<!-- Store Image Upload -->
<div class="col-xl-4">
    <div class="primary_input mb-25">
        <label class="primary_input_label">
            Shop Image <span class="text-danger">*</span>
            <small class="text-muted">(PNG, JPG, JPEG)</small>
        </label>

        <input
            type="file"
            name="store_image"
            class="primary_input_field file_input_fix"
            accept=".jpg,.jpeg,.png"
            required
        >

        <span class="text-danger"><?php echo e($errors->first('store_image')); ?></span>
    </div>
</div>

<div class="col-xl-4">
    <div class="primary_input mb-25">
        <label class="primary_input_label">
            Upload Document 
            <span class="text-danger">*</span>
            <small class="text-muted">(GST, MSME, Store Document, Company PAN)</small>
        </label>

        <input
            type="file"
            name="document"
            class="primary_input_field file_input_fix"
            accept=".jpg,.jpeg,.png,.pdf"
        >

        <span class="text-danger"><?php echo e($errors->first('document')); ?></span>
    </div>
</div>




                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.password')); ?>

                                        (<?php echo e(__('common.minimum_8_charecter')); ?>)<span class="text-danger">*</span></label>
                                    <input name="password" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.password')); ?>" value="<?php echo e(old('password')); ?>" type="password" minlength="8">
                                    <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.confirm_password')); ?><span class="text-danger">*</span></label>
                                    <input name="password_confirmation" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.confirm_password')); ?>" type="password" minlength="8">

                                </div>
                            </div>


                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.referral_code_(optional)')); ?></label>
                                    <input name="referral_code" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.referral_code')); ?>" type="text"
                                        value="<?php echo e(old('referral_code')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('referral_code')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                                    <ul id="theme_nav" class="permission_list sms_list ">
                                        <li>
                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                                <input name="status" id="status_active" value="1" checked="true" class="active"
                                                    type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p><?php echo e(__('common.active')); ?></p>
                                        </li>
                                        <li>
                                            <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                                <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p><?php echo e(__('common.inactive')); ?></p>
                                        </li>
                                    </ul>
                                    <span class="text-danger" id="error_status"></span>
                                </div>
                            </div>


                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                        id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.create')); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
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

        $(document).ready(function(){


        });

    })(jQuery);

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Production_dev/Modules/Customer/Resources/views/customers/create.blade.php ENDPATH**/ ?>