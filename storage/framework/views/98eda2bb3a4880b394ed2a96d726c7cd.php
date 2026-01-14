<h4><?php echo e(__('common.make')); ?> <?php echo e(__('common.default')); ?> <?php echo e(__('defaultTheme.shipping')); ?> <?php echo e(__('common.address')); ?></h4>
<div class="QA_section QA_section_heading_custom check_box_table" id="address_list">
    <div class="QA_table ">
        <table class="table Crm_table_active2" id="address_table">
            <thead>
                <tr>
                    <th><?php echo e(__('common.full_name')); ?></th>
                    <th><?php echo e(__('common.address')); ?></th>
                    <th><?php echo e(__('common.region')); ?></th>
                    <th><?php echo e(__('common.email')); ?></th>
                    <th><?php echo e(__('common.phone_number')); ?></th>
                    <th><?php echo e(__('common.make_default')); ?></th>
                </tr>

            </thead>
            <tbody>
                <?php $__currentLoopData = $addressList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($address->name); ?></td>
                    <td><?php echo e($address->address); ?></td>
                    <td><?php echo e(@$address->getCity->name.', '.@$address->getState->name.', '.@$address->getCountry->name); ?></td>
                    <td><?php echo e($address->email); ?></td>
                    <td><?php echo e($address->phone); ?></td>
                    <td>
                        <ul id="" class="permission_list sms_list">
                            <li>
                                <label class="primary_checkbox d-flex mr-12 ">
                                    <input name="dft_adrs_shipping" type="radio" id="sms_gateway_id<?php echo e($key); ?>" value="1" c_list_id="<?php echo e($address->id); ?>" c_id="<?php echo e($address->customer_id); ?>" <?php if($address->is_shipping_default==1): ?> checked <?php endif; ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>
</div>
<button class="primary_btn_2 default_setup_shipping"><?php echo e(__('common.save')); ?></button>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/pages/customer_data/_shipping_address.blade.php ENDPATH**/ ?>