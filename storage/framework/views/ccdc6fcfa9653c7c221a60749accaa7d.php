
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/marketing/css/flash_deal_create.css'))); ?>" />
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
        <form action="<?php echo e(route('setup.update.checkout.field.settings')); ?>" enctype="multipart/form-data" method="POST">
            <?php echo csrf_field(); ?>
            
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo e(__('setup.Checkout Field Manager')); ?></h3>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div id="formHtml" class="col-lg-12">
                        <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                            <table class="table fieldtable text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <div class="main-title">
                                                                <h3>
                                                                    <?php echo e(__('setup.Field Name')); ?>

                                                                </h3>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="main-title">
                                                                <h3>
                                                                    <?php echo e(__('setup.Visibility')); ?>

                                                                </h3>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="main-title">
                                                                <h3>
                                                                    <?php echo e(__('setup.Required')); ?>

                                                                </h3>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td><?php echo e(__('setup.Address')); ?></td>
                                                        <td class="text-center">
                                                            <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="address_visibility">
                                                                    <input type="checkbox" name="address_visibility" id="address_visibility" value="1" class="address_change_checkbox" <?php if($checkoutField[0]->field_name=='address' && $checkoutField[0]->visibility==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="address_required">
                                                                    <input type="checkbox" name="address_required" id="address_required" value="1" class="addressr_change_checkbox" <?php if($checkoutField[0]->field_name=='address' && $checkoutField[0]->required==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('setup.City')); ?></td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="city_visibility">
                                                                    <input type="checkbox" name="city_visibility" id="city_visibility" value="1" class="city_change_checkbox" <?php if($checkoutField[1]->field_name=='city' && $checkoutField[1]->visibility==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="city_required">
                                                                    <input type="checkbox" name="city_required" id="city_required" value="1" class="cityr_change_checkbox" <?php if($checkoutField[1]->field_name=='city' && $checkoutField[1]->required==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('setup.State')); ?></td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="state_visibility">
                                                                    <input type="checkbox" name="state_visibility" id="state_visibility" value="1" class="state_change_checkbox" <?php if($checkoutField[2]->field_name=='state' && $checkoutField[2]->visibility==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="state_required">
                                                                    <input type="checkbox" name="state_required" id="state_required" value="1" class="stater_change_checkbox" <?php if($checkoutField[2]->field_name=='state' && $checkoutField[2]->required==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('setup.Country')); ?></td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="country_visibility">
                                                                    <input type="checkbox" name="country_visibility" id="country_visibility" value="1" class="country_change_checkbox" <?php if($checkoutField[3]->field_name=='country' && $checkoutField[3]->visibility==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="country_required">
                                                                    <input type="checkbox" name="country_required" id="country_required" value="1" class="countryr_change_checkbox" <?php if($checkoutField[3]->field_name=='country' && $checkoutField[3]->required==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('setup.Postal Code')); ?></td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="postal_visibility">
                                                                    <input type="checkbox" name="postal_visibility" id="postal_visibility" value="1" class="postal_change_checkbox" <?php if($checkoutField[4]->field_name=='postal' && $checkoutField[4]->visibility==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                        <div class="primary_input mb-15">
                                                                <label class="switch_toggle" for="postal_required">
                                                                    <input type="checkbox" name="postal_required" id="postal_required" value="1" class="postalr_change_checkbox" <?php if($checkoutField[4]->field_name=='postal' && $checkoutField[4]->required==1): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                                                    <div class="slider round"></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                        <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""> <span class="ti-check"></span> <?php echo e(__('common.save')); ?> </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Setup/Resources/views/checkoutsetting/checkout_field_settings.blade.php ENDPATH**/ ?>