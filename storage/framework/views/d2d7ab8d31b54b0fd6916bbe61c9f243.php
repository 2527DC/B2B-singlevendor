<div class="modal fade deleteForm" id="<?php echo e(isset($modal_id)?$modal_id:'deleteItemModal'); ?>" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?> <?php echo e($item_name); ?> </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('affiliate.Are you sure to delete ?'); ?></h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                    <form id="<?php echo e(isset($form_id)?$form_id:'item_delete_form'); ?>">
                        <input type="hidden" name="id" id="<?php echo e(isset($delete_item_id)?$delete_item_id:'delete_item_id'); ?>">
                        <input id="<?php echo e(isset($dataDeleteBtn)?$dataDeleteBtn:'dataDeleteBtn'); ?>" type="submit" class="primary-btn tr-bg" value="Delete"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/_deleteModalForAjax.blade.php ENDPATH**/ ?>