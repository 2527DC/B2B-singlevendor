
<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/attendance/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('hr.attendance')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.select_role')); ?></label>
                                    <select class="primary_select mb-15 role_type" name="role_id" id="role_id">
                                        <option selected disabled><?php echo e(__('common.choose_one')); ?></option>
                                        <option value="0"> <?php echo e(__('common.all')); ?></option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($role->id !== 1): ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('role_type')); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.date')); ?> <span class="text-danger">*</span></label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="date" type="text" name="date"
                                                           value="<?php echo e(getNumberTranslate(date('m/d/Y'))); ?>" autocomplete="off" />
                                                </div>
                                            </div>
                                            <button class="btn-date" data-id="#date" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn btn-sm fix-gr-bg pull-right search-btn d-none" ><i class="ti-search"></i><?php echo e(__('common.search')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="create_form">

    </div>
<?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">

        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('change', '#date', function(){
                    get_user();
                });
                $(document).on('change', '#role_id', function(){
                    get_user();
                });

                function get_user()
                {
                    var role_id = $('#role_id').val();
                    var date = $('#date').val();
                    if (role_id && date)
                    {
                        $('#pre-loader').removeClass('d-none');
                        $.post("<?php echo e(route('get_user_by_role')); ?>",{_token:'<?php echo e(csrf_token()); ?>', role_id:role_id,date:date}, function(data){
                            $(".create_form").html(data);
                            $('select').niceSelect();
                            $('#pre-loader').addClass('d-none');
                        });
                    }else{
                        toastr.warning("<?php echo e(__('hr.select_Role_date_from_list')); ?>", "<?php echo e(__('common.warning')); ?>");
                    }
                }

                $(document).on('click', '#search_btn', function(){
                    toastr.warning("<?php echo e(__('hr.select_Role_date_from_list')); ?>", "<?php echo e(__('common.warning')); ?>");
                });
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Attendance/Resources/views/attendances/index.blade.php ENDPATH**/ ?>