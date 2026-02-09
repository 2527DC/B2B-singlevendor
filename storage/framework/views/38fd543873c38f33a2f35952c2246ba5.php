<div class="main-title mb-25">
    <h3 class="mb-0"><?php echo e(__('general_settings.activation')); ?></h3>
</div>

<div class="common_QA_section QA_section_heading_custom">
    <div class="QA_table ">
        <!-- table-responsive -->
        <div class="">
            <table class="table Crm_table_active2">
                <thead>
                    <tr>
                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                        <th scope="col"><?php echo e(__('common.type')); ?></th>
                        <th scope="col" width="10%" class="text-right"><?php echo e(__('general_settings.activate')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $others_activations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $others_activation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(getNumberTranslate($key+1)); ?></td>
                            <td>
                            <?php
                                switch ($others_activation->type) {
                                    case 'email_verification':
                                    echo __("general_settings.email_verification");
                                    break;
                                    case 'sms_verification':
                                    echo __("general_settings.sms_verification");
                                    break;
                                    case 'mail_notification':
                                    echo __("general_settings.mail_notification");
                                    break;
                                    case 'system_notification':
                                    echo __("general_settings.system_notification");
                                    break;
                                }
                            ?>
                            </td>
                            <td class="text-right">
                                <label class="switch_toggle" for="checkbox<?php echo e($others_activation->id); ?>">
                                    <input type="checkbox" id="checkbox<?php echo e($others_activation->id); ?>" <?php if($others_activation->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('update_activation_status')): ?> value="<?php echo e($others_activation->id); ?>" class="activations" <?php endif; ?>>
                                    <div class="slider round"></div>
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isModuleActive('MultiVendor')): ?>
                        <?php $__currentLoopData = $vendor_configurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vendor_configuration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(getNumberTranslate($key+1)); ?></td>
                                <td>
                                    <?php
                                        switch ($vendor_configuration->type) {
                                            case 'Multi-Vendor System Activate':
                                            echo __("general_settings.multivendor_system_activate");
                                            break;
                                        }
                                    ?>
                                </td>
                                <td class="text-right">
                                    <label class="switch_toggle" for="checkbox<?php echo e($vendor_configuration->id); ?>">
                                        <input type="checkbox" id="checkbox<?php echo e($vendor_configuration->id); ?>" <?php if($vendor_configuration->status == 1): ?> checked <?php endif; ?>  <?php if(permissionCheck('update_activation_status')): ?> value="<?php echo e($vendor_configuration->id); ?>" class="activations" <?php endif; ?>>
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/GeneralSetting/Resources/views/page_components/activation.blade.php ENDPATH**/ ?>