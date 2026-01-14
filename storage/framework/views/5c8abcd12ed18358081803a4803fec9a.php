

<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/backend_page_css/staff_create.css'))); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30"><?php echo e(__('common.add_new')); ?> <?php echo e(__('hr.staff')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="<?php echo e(route('staffs.store')); ?>" method="POST" id="staff_addForm"
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
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.role')); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="primary_select mb-25" name="role_id" id="role_id" required>
                                        <option disabled selected><?php echo e(__('common.select_one')); ?></option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>-<?php echo e($role->type); ?>" <?php if(old('role_id') &&
                                            old('role_id')==$role->id.'-'.$role->type): ?> selected <?php endif; ?>><?php echo e($role->name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('role_id')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.department')); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="primary_select mb-25" name="department_id" id="department_id"
                                        required>
                                        <?php $__currentLoopData = \Modules\Setup\Entities\Department::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php if(old('department_id') &&
                                            old('department_id')==$department->id): ?> selected
                                            <?php endif; ?>><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('department_id')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.email')); ?>

                                        (<?php echo e(__('common.use_as_username')); ?>) <span class="text-danger">*</span></label>
                                    <input name="email" class="primary_input_field user_id name"
                                        placeholder="<?php echo e(__('common.email')); ?>" type="email" value="<?php echo e(old('email')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                </div>
                                <p class="text-danger user_id_row d-none"><?php echo e(__('common.your_user_id_is')); ?> : <span
                                        class="generated_user_id"></span></p>
                            </div>
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
                                    <label class="primary_input_label" for=""><?php echo e(__('common.phone')); ?></label>
                                    <input type="text" class="primary_input_field  name"
                                        placeholder="<?php echo e(__('common.phone')); ?>" name="phone" value="<?php echo e(old('phone')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                </div>
                            </div>



                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.password')); ?>

                                        (<?php echo e(__('common.minimum_8_charecter')); ?>)<span class="text-danger">*</span></label>
                                    <input name="password" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.password')); ?>" type="password" minlength="8">
                                    <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                </div>
                            </div>


                            <div class="col-xl-4 date_of_birth_div">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.date_of_birth')); ?> <span
                                            class="text-danger">*</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                        class="primary_input_field primary-input date form-control"
                                                        id="date_of_birth" type="text" name="date_of_birth"
                                                        value="<?php echo e(date('m/d/Y')); ?>"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#date_of_birth" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('date_of_birth')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-4 current_address_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.address')); ?></label>
                                    <input name="address" id="address" class="primary_input_field name"
                                        placeholder="<?php echo e(__('common.address')); ?>" type="text" value="<?php echo e(old('address')); ?>">
                                    <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                                </div>
                            </div>

                            <input type="hidden" name="role_type" id="role_type" value="">
                            <div class="col-lg-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.avatar')); ?>

                                        (165x165)PX</label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName"
                                            placeholder="<?php echo e(__('common.browse_file')); ?>" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo e(__('common.browse')); ?></label>
                                            <input type="file" class="d-none" name="photo" id="document_file_1">
                                        </button>
                                        <div class="avatar_div">
                                            <img id="StaffImgShow"
                                                src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                                        </div>

                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('photo')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.date_of_joining')); ?> <span
                                            class="text-danger">*</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                        class="primary_input_field primary-input date form-control"
                                                        id="date"
                                                        type="text" name="date_of_joining"
                                                        value="<?php echo e(old('date_of_joining')?old('date_of_joining'):date('m/d/Y')); ?>"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#date" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('date_of_joining')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.applicable_for_leave')); ?> <span
                                            class="text-danger">*</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                        class="primary_input_field primary-input date form-control"
                                                        id="leave_date"
                                                        type="text" name="leave_applicable_date"
                                                        value="<?php echo e(old('leave_applicable_date')?old('leave_applicable_date'):date('m/d/Y')); ?>"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#leave_date" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"><?php echo e($errors->first('leave_applicable_date')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-12 mt-5 bank_info_div">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30"><?php echo e(__('hr.bank_info')); ?></h3>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-6 bank_name_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.bank_name')); ?></label>
                                    <input name="bank_name" id="bank_name" class="primary_input_field name"
                                        value="<?php echo e(old('bank_name')); ?>" placeholder="<?php echo e(__('hr.bank_name')); ?>" type="text">
                                    <span class="text-danger"><?php echo e($errors->first('bank_name')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-6 bank_account_name_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.branch_name')); ?></label>
                                    <input name="bank_branch_name" value="<?php echo e(old('bank_branch_name')); ?>"
                                        id="bank_branch_name" class="primary_input_field name"
                                        placeholder="<?php echo e(__('hr.branch_name')); ?>" type="text">
                                    <span class="text-danger"><?php echo e($errors->first('bank_branch_name')); ?></span>
                                </div>
                            </div>

                            <div class="col-xl-6 bank_account_no_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.account_name')); ?></label>
                                    <input name="bank_account_name" value="<?php echo e(old('bank_account_name')); ?>"
                                        id="bank_account_name" class="primary_input_field name"
                                        placeholder="<?php echo e(__('hr.account_name')); ?>" type="text">
                                    <span class="text-danger"><?php echo e($errors->first('bank_account_name')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6 bank_account_no_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('hr.account_number')); ?></label>
                                    <input name="bank_account_number" value="<?php echo e(old('bank_account_number')); ?>"
                                        id="bank_account_number" class="primary_input_field name"
                                        placeholder="<?php echo e(__('hr.account_number')); ?>" type="text">
                                    <span class="text-danger"><?php echo e($errors->first('bank_account_number')); ?></span>
                                </div>
                            </div>


                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                        id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.save')); ?></button>
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
<script>
    (function($){
        "use strict";

        $(document).ready(function(){
            $(document).on('change', '#role_id', function(){
                getRoleField();
            });

            function getRoleField()
            {
                var role_id = $('#role_id').val().split('-');
                $('#role_type').val(role_id[1]);
                if (role_id[1] == "admin") {
                    $("#employee_id").attr('disabled', true);

                }else {
                    $("#employee_id").removeAttr("disabled");
                    $("#employee_id").removeAttr("disabled");
                    $("#date_of_birth").removeAttr("disabled");
                    $("#bank_name").removeAttr("disabled");
                    $("#bank_branch_name").removeAttr("disabled");
                    $("#bank_account_name").removeAttr("disabled");
                    $("#bank_account_no").removeAttr("disabled");

                }
            }

            $(document).on('change', '#document_file_1', function(){
                getFileName($(this).val(),'#placeholderFileOneName');
                imageChangeWithFile($(this)[0],'#StaffImgShow');
            });

            $(document).on('change', '#employment_type', function(){
                getField();
            });

            function getField()
            {
                var employment_type = $('#employment_type').val();
                if (employment_type == "Provision") {
                    $("#provisional_time").removeAttr("disabled");
                }
                else if (employment_type == "Contract") {
                    $("#provisional_time").attr('disabled', true);
                }
                else {
                    $("#bank_name").attr('Permanent', true);
                    $("#provisional_time").attr('disabled', true);
                }
            }

            $(document).on('keyup', '.user_id', function(){
                let user_id = $(this).val();
                $('.user_id_row').fadeIn();
                $('.generated_user_id').text(user_id);
            });

        });



    })(jQuery);

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/staffs/create.blade.php ENDPATH**/ ?>