<?php $__env->startSection('mainContent'); ?>


<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php if(isset($role)): ?>
                                    <?php echo app('translator')->get('common.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('common.add'); ?>
                                <?php endif; ?>
                                    <?php echo app('translator')->get('hr.role'); ?>
                            </h3>
                        </div>
                        <?php if(isset($role)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => route('permission.roles.update',$role->id),'method' => 'PUT'])); ?>

                        <?php else: ?>

                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'permission.roles.store', 'method' => 'POST'])); ?>


                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger')); ?>

                                        </div>
                                        <?php endif; ?>
                                        <div class="input-effect">
                                            <label><?php echo app('translator')->get('common.name'); ?> <span><span class="text-danger">*</span></span></label>
                                            <input class="primary_input_field form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" id="name"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($role)? @$role->name: ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($role)? @$role->id: ''); ?>">
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                    $tooltip = "";
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <?php if(permissionCheck('permission.roles.edit') || permissionCheck('permission.roles.store')): ?>
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php echo e(!isset($role)? __('common.save') : __('common.update')); ?>


                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('hr.role'); ?> <?php echo app('translator')->get('common.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table ">
                                <!-- table-responsive -->
                                <div class="mt-30">
                                <table class="table Crm_table_active3">
                                        <thead>
                                           <?php echo $__env->make('backEnd.partials._alertMessagePageLevelAll', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <tr>
                                                <th width="20%"><?php echo app('translator')->get('common.sl'); ?></th>
                                                <th width="20%"><?php echo app('translator')->get('hr.role'); ?></th>
                                                <th width="40%"><?php echo app('translator')->get('common.action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $RoleList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$role->module or isModuleActive($role->module)): ?>
                                                    <tr>
                                                        <td><?php echo e(getNumberTranslate($key + 1 )); ?></td>
                                                        <td><?php echo e(@$role->name); ?></td>
                                                        <td>
                                                            
                                                            <div class="dropdown CRM_dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <?php echo e(__('common.select')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                    <?php if(permissionCheck('permission.permissions.index')): ?>
                                                                      <a class="dropdown-item" type="button" href="<?php echo e(route('permission.permissions.index', [ 'id' => @$role->id])); ?>"><?php echo e(__('hr.assign_permission')); ?></a>
                                                                    <?php endif; ?>

                                                                    <?php if(permissionCheck('permission.roles.edit')): ?>
                                                                        <a href="<?php echo e(route('permission.roles.edit',$role->id)); ?>" class="dropdown-item" type="button"><?php echo app('translator')->get('common.edit'); ?></a>
                                                                    <?php endif; ?>

                                                                    <?php if(permissionCheck('permission.roles.destroy')): ?>
                                                                        <a href=""  class="dropdown-item delete_role"  type="button" data-value="<?php echo e(route('permission.roles.destroy',$role->id)); ?>" ><?php echo app('translator')->get('common.delete'); ?></a>
                                                                    <?php endif; ?>


                                                                </div>
                                                            </div>
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
        </div>
    </div>
    
    <?php echo $__env->make('backEnd.partials.delete_modal',['item_name' => __('hr.role')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use script";
            $(document).ready(function(){
                $(document).on('click', '.delete_role', function(event){
                    event.preventDefault();
                    let route = $(this).data('value');
                    confirm_modal(route);
                });
            });

        })(jQuery);
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/RolePermission/Resources/views/role.blade.php ENDPATH**/ ?>