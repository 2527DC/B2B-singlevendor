<div class="col-lg-12">
    <div class="primary_input mb-15">
        <label class="primary_input_label" for="shipping_method"><?php echo e(__('shipping.shipping_method')); ?> <span class="text-danger">*</span></label>
        <select class="primary_select mb-15" id="c_shipping_method" name="c_shipping_method">
            <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($row->shipping_method == $value->id ? 'selected' :''); ?>  value="<?php echo e($value->id); ?>"><?php echo e($value->method_name); ?> [ <?php echo e($value->carrier?'Carrier- '.$value->carrier->name. ',':''); ?> <?php echo e('Time- '.$value->shipment_time); ?> <?php echo e(!empty($value->cost_based_on)?', Cost based on '.$value->cost_based_on.',' :''); ?> <?php echo e('Cost '.$value->cost); ?> ]</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <span class="text-danger"  id="error_shipping_method"></span>
    </div>
</div>

<?php if($carrier->type == 'Manual'): ?>
    <div class="col-lg-12">
        <div class="primary_input mb-15">
            <label class="primary_input_label" for="tracking_id"> <?php echo e(__('shipping.tracking_id')); ?> </label>
            <input class="primary_input_field" id="tracking_id" name="tracking_id" placeholder="<?php echo e(__('shipping.tracking_id')); ?>" type="text" value="<?php echo e(old('tracking_id')); ?>">
            <span class="text-danger" id="error_tracking_id"></span>
        </div>
    </div>
<?php else: ?>
    <?php if(isModuleActive('ShipRocket') && $carrier->slug =='Shiprocket' && $carrier->status ==1): ?>
        <?php if(count($couriers) > 0): ?>
        <div class="col-lg-12">
            <div class="primary_input mb-15">
                <label class="primary_input_label" for="">Filter</label>
                <select class="primary_select mb-15" id="filter">
                    <option selected  value=""><?php echo e(__('common.select_one')); ?></option>
                    <option value="1">Cheapest</option>
                    <option value="2">Fasted</option>
                </select>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-lg-12">
            <label class="primary_input_label" for=""><?php echo e(__('shipping.shipping')); ?> <span class="required_mark_theme">*</span></label>
            <ul class="permission_list sms_list" id="courier_data">
                <?php if(count($couriers) > 0): ?>
                    <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <label class="primary_checkbox d-flex mr-12 ">
                                <input name="shipping_method" class="shipping_method" type="radio" id="shipping_method" value="<?php echo e($c['courier_company_id']); ?>">
                                <span class="checkmark"></span>
                            </label>
                            <p><?php echo e($c['courier_name']); ?> (Freight Charges: <?php echo e(single_price($c['freight_charge'])); ?>, Estimated Delivery: <?php echo e($c['estimated_delivery_days']); ?> days)</p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    No courier available for this shipping.
                <?php endif; ?>
            </ul>
        </div>

        <input type="hidden" id="couriers_data" value="<?php echo e(json_encode($couriers)); ?>">
        <?php endif; ?>
 <?php endif; ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/order/components/_shipping_change.blade.php ENDPATH**/ ?>