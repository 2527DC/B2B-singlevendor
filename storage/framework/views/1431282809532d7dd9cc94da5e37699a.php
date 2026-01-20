<div class="modal fade admin-query" id="multiple_order_method_change_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('shipping.selected_order_shipping_method_change')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="multiple_shipping_method_change">
                    <div class="row">
                        <input type="hidden" name="order_ids" id="orderIds">
                        <input type="hidden" name="multiple_order" value="1">
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="shipping_method"><?php echo e(__('shipping.shipping_method')); ?> <span class="text-danger">*</span></label>
                                <select class="primary_select mb-15" id="shipping_method" name="shipping_method">
                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                    <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  value="<?php echo e($value->id); ?>"><?php echo e($value->method_name); ?> [ <?php echo e($value->carrier?'Carrier- '.$value->carrier->name. ',':''); ?> <?php echo e('Time- '.$value->shipment_time); ?> <?php echo e(!empty($value->cost_based_on)?', Cost based on '.$value->cost_based_on.',' :''); ?> <?php echo e('Cost '.$value->cost); ?> ]</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger"  id="error_shipping_method"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-check"></i><?php echo e(__('common.submit')); ?></button>
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><i class="ti-check"></i><?php echo e(__('common.cancel')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/order/components/_multiple_order_method_change.blade.php ENDPATH**/ ?>