<!-- Modal -->
<div class="modal theme_modal2 fade" id="<?php echo e(isset($modal_id) ? $modal_id : 'deleteItemModal'); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog max_width_570 modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="payment_modal_wallet style2">
                    <div class="d-flex align-items-center gap_10 mb_30">
                        <h3 class="font_24 f_w_700  flex-fill mb-0"><?php echo app('translator')->get('common.delete'); ?> <?php echo e($item_name); ?></h3>
                        <button type="button" class="close_modal_icon" data-bs-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                    </div>
                </div>
                <div class="text-center">
                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete_?'); ?></h4>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-lg-12 justify-content-between d-flex">
                        <button type="button" class="amaz_primary_btn3 text-center justify-content-center text-uppercase" data-bs-dismiss="modal"
                        aria-label="Close"><?php echo app('translator')->get('common.cancel'); ?></button>
                        <form id="<?php echo e(isset($form_id) ? $form_id : 'item_delete_form'); ?>" class="p-0">
                            <input type="hidden" name="id"
                                id="<?php echo e(isset($delete_item_id) ? $delete_item_id : 'delete_item_id'); ?>">
                            <button type="submit" class="amaz_primary_btn style2  add_to_cart text-uppercase flex-fill text-center"
                                id="<?php echo e(isset($dataDeleteBtn) ? $dataDeleteBtn : 'dataDeleteBtn'); ?>"><?php echo e(__('common.delete')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/partials/_delete_modal_for_ajax.blade.php ENDPATH**/ ?>