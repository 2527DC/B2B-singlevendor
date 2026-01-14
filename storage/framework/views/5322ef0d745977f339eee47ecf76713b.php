<div class="modal fade admin-query" id="variant_wholesale_price_modal_<?php echo e($modalTargetId); ?>">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('wholesale.Wholesale Price')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row" id="repeat_<?php echo e($modalTargetId); ?>">

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_<?php echo e($incKey); ?>[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_<?php echo e($incKey); ?>[]">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_<?php echo e($incKey); ?>[]">
                                </div>
                                <div class="col">
                                    <button type="button" data-id="#repeat_<?php echo e($modalTargetId); ?>" incKey="<?php echo e($incKey); ?>" class="btn btn-sm style_plus_icon add_variant__whole_sale_price">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                <div class="row">
                    <div class="col-md-10 text-right">
                        <button type="button" class="primary_btn_2 mt-5 text-center wholesale_p_save_btn" append_w_priceId="<?php echo e($modalTargetId); ?>" w_incKey="<?php echo e($incKey); ?>" style="margin-right: 22px"><i class="ti-check"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/WholeSale/Resources/views/components/_create_variant_wholesale_price_modal.blade.php ENDPATH**/ ?>