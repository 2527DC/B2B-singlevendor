<div class="modal fade admin-query" id="single_order_method_change_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e($row->package_code); ?> <?php echo e(__('shipping.shipping')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="shipping_method_change">
                    <div class="row">
                        <input type="hidden" id="packageId" name="order_id" value="<?php echo e($row->id); ?>">


                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="carrier"><?php echo e(__('shipping.carrier')); ?> <span class="text-danger">*</span></label>
                                <select class="primary_select mb-15" id="shipping_carrier" name="carrier">
                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                    <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($row->carrier_id == $value->id ? 'selected' :''); ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div id="courier_div" class=" row">
                        <?php echo $__env->make('shipping::order.components._shipping_change',['carrier'=>$row->carrier], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="row">
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
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/order/components/_single_order_method_change.blade.php ENDPATH**/ ?>