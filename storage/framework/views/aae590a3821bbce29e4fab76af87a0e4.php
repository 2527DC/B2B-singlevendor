<div id="show_item_modal">
    <div class="modal" id="item_show">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <?php echo e(__('product.show_category')); ?>

                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body item_edit_form">
                    <h5><?php echo e(__('common.name')); ?>: <p class="d-inline" id="show_name"></p></h5>
                    <h5><?php echo e(__('common.slug')); ?>: <p class="d-inline" id="show_slug"></p></h5>
                    <h5><?php echo e(__('common.searchable')); ?>: <p class="d-inline" id="show_searchable"></p></h5>
                    <h5><?php echo e(__('product.parent_category')); ?>: <p class="d-inline" id="show_parent_category"></p></h5>
                    <?php if(isModuleActive('GoogleMerchantCenter')): ?>
                    <h5><?php echo e(__('product.google_product_category_id')); ?>: <p class="d-inline" id="google_product_category_id"></p></h5>
                    <?php endif; ?>
                    <?php if(isModuleActive('MultiVendor')): ?>
                    <h5><?php echo e(__('common.commission_rate')); ?>: <p class="d-inline" id="commission_rate"></p></h5>
                    <?php endif; ?>
                    <h5><?php echo e(__('common.icon')); ?>: <p class="d-inline" id="show_icon"></p></h5>
                    <h5><?php echo e(__('common.status')); ?>: <p class="d-inline" id="show_status"></p></h5>

                    <div class="row" id="single_image_div">
                        <div class="col-6">
                            <div class="show_img_div">
                                <img id="view_image" width='300' height='250'>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/category/components/show.blade.php ENDPATH**/ ?>