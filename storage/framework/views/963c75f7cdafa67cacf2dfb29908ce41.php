
<?php $__env->startSection('styles'); ?>
<style>
    .fieldtable td{
        padding-left: 0px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo e(__('checkpincode.checkpincode_config')); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="formHtml" class="col-lg-12">
                        <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <form class="w-100" action="<?php echo e(route('checkpincode.update.checkpincode.system.config')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <table class="table fieldtable">
                                                    <thead>
                                                        <tr>
                                                            <td><?php echo e(__('setup.Field Name')); ?></td>
                                                            <td><?php echo e(__('setup.Status')); ?></td>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo e(__('checkpincode.pincode_check_system_status')); ?></td>
                                                            <td>
                                                                <div class="primary_input">
                                                                    <label class="switch_toggle" for="pincode_check_system_status">
                                                                        <input type="checkbox" name="pincode_check_system_status" id="pincode_check_system_status" value="1" class="pincode_check_system_status_change_checkbox" <?php if($checkPincodeConfig->pincode_check_system_status==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo e(__('checkpincode.delivery_days_status')); ?></td>
                                                            <td>
                                                                <div class="primary_input">
                                                                    <label class="switch_toggle" for="delivery_days_status">
                                                                        <input type="checkbox" name="delivery_days_status" id="delivery_days_status" value="1" class="delivery_days_status_change_checkbox" <?php if($checkPincodeConfig->delivery_days_status==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <button class="primary-btn fix-gr-bg submit">Save</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/CheckPincode/Resources/views/pincode_check_config.blade.php ENDPATH**/ ?>