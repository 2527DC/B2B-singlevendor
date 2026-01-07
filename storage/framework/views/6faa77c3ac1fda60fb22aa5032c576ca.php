
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
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('hr.staff_list')); ?></h3>
                            <?php if(permissionCheck('staffs.store')): ?>
                            <ul class="d-flex">
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('staffs.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.add_new')); ?> <?php echo e(__('hr.staff')); ?></a></li>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('common.name')); ?></th>

                                        <th scope="col"><?php echo e(__('common.email')); ?></th>
                                        <th scope="col"><?php echo e(__('common.phone')); ?></th>
                                        <th scope="col"><?php echo e(__('hr.role')); ?></th>
                                        <th scope="col"><?php echo e(__('common.status')); ?></th>
                                        <th scope="col"><?php echo e(__('hr.department')); ?></th>
                                        <th scope="col"><?php echo e(__('common.registered_date')); ?></th>
                                        <th scope="col"><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($staff->user != null): ?>
                                            <tr>
                                                <th><?php echo e(getNumberTranslate($key+1)); ?></th>
                                                <td><a href="<?php echo e(route('staffs.view', $staff->id)); ?>"><?php echo e(ucwords( @$staff->user->getFullNameAttribute() )); ?></a></td>


                                                <td><a href="mailto:<?php echo e(@$staff->user->email); ?>"><?php echo e(@$staff->user->email); ?></a></td>
                                                <td><a href="tel:<?php echo e(@$staff->phone); ?>"><?php echo e(@getNumberTranslate($staff->phone)); ?></a></td>
                                                <td><?php echo e(@$staff->user->role->name); ?></td>
                                                <td>
                                                    <?php if(@$staff->user->role_id != 1): ?>
                                                        <label class="switch_toggle" for="active_checkbox<?php echo e($staff->id); ?>">
                                                        <input class="update_status_staff" type="checkbox" id="active_checkbox<?php echo e($staff->id); ?>" <?php echo e(permissionCheck('staffs.edit') ? '' : 'disabled'); ?> <?php echo e($staff->user->is_active == 1 ? 'checked' : ''); ?>

                                                        value="<?php echo e($staff->id); ?>" data-id="<?php echo e($staff->user->id); ?>">
                                                        <div class="slider round"></div>
                                                    </label>
                                                    <?php endif; ?>

                                                </td>
                                                <td><?php echo e(@$staff->department->name); ?></td>
                                               <td><?php echo e(dateConvert($staff->created_at)); ?></td>

                                                <td>
                                                    <!-- shortby  -->
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <?php echo e(__('common.select')); ?>

                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            <?php if(permissionCheck('staffs.view')): ?>
                                                            <a href="<?php echo e(route('staffs.view', $staff->id)); ?>" class="dropdown-item"><?php echo e(__('common.view')); ?></a>
                                                            <?php endif; ?>

                                                            <?php if(permissionCheck('staffs.edit')): ?>
                                                            <a href="<?php echo e(route('staffs.edit', $staff->id)); ?>" class="dropdown-item"><?php echo e(__('common.edit')); ?></a>
                                                            <?php endif; ?>

                                                            <?php if(permissionCheck('staffs.destroy')): ?>
                                                            <a data-value="<?php echo e(route('staffs.destroy', $staff->user->id)); ?>" class="dropdown-item delete_staff"><?php echo e(__('common.delete')); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <!-- shortby  -->
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
        	"use strict";
            $(document).ready(function(){
                $(document).on('change','.payrollPayment', function(){
                    if(this.checked){
                        var status = 1;
                    }
                    else{
                        var status = 0;
                    }
                    $.post('<?php echo e(route('staffs.update_active_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:this.value, status:status}, function(data){
                        if(data.success){
                            toastr.success(data.success);
                        }
                        else{
                            toastr.error(data.error);
                        }
                    }).fail(function(response) {
                    if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }

            });
                });

                $(document).on('click', '.delete_staff', function(event){
                    event.preventDefault();
                    let value = $(this).data('value');
                    confirm_modal(value);
                });

                $(document).on('change', '.update_status_staff', function(){
                    event.preventDefault();
                    let status = 0;
                    if($(this).prop('checked')){
                        status = 1;
                    }
                    else{
                        status = 0;
                    }
                    let id = $(this).data('id');
                    $('#pre-loader').removeClass('d-none');
                    let formData = new FormData();
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    formData.append('id', id);
                    formData.append('status', status);

                    $.ajax({
                        url: "<?php echo e(route('staffs.update_active_status')); ?>",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            toastr.error("<?php echo e(__('common.error_message')); ?>");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/staffs/index.blade.php ENDPATH**/ ?>