<div class="modal fade admin-query" id="packaging_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e($row->package_code); ?> <?php echo e(__('shipping.packaging_info')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="packaging_form">
                    <div class="row">
                        <input type="hidden" name="id" id="rowId" value="<?php echo e($row->id); ?>">
                        <div class="col-lg-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for=""> <?php echo e(__('product.weight')); ?> [Gm] <span class="text-danger">*</span></label>
                                <input value="<?php echo e($row->weight); ?>" class="primary_input_field" name="weight" id="weight"
                                       type="number" min="0" step="0">
                                <span class="text-danger" id="error_weight"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for=""> <?php echo e(__('product.length')); ?> [Cm] <span class="text-danger">*</span></label>
                                <input value="<?php echo e($row->length); ?>" class="primary_input_field" name="length" id="length"
                                       type="number" min="0" step="0">
                                <span class="text-danger" id="error_length"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for=""> <?php echo e(__('product.breadth')); ?> [Cm] <span class="text-danger">*</span></label>
                                <input value="<?php echo e($row->breadth); ?>" class="primary_input_field" name="breadth" id="breadth"
                                       type="number" min="0" step="0">
                                <span class="text-danger" id="error_breadth"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for=""> <?php echo e(__('product.height')); ?> [Cm] <span class="text-danger">*</span></label>
                                <input value="<?php echo e($row->height); ?>" class="primary_input_field" name="height" id="height"
                                       type="number" min="0" step="0">
                                <span class="text-danger" id="error_height"></span>
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
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/order/components/_packaging.blade.php ENDPATH**/ ?>