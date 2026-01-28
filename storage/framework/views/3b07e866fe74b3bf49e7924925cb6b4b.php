<div id="show_item_modal">
    <div class="modal fade" id="item_show">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <?php echo e(__('File Detaill Info')); ?>

                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body item_edit_form">
                    <h5><?php echo e(__('common.name')); ?>: <p class="d-inline" id="show_name"></p></h5>
                    <h5><?php echo e(__('common.slug')); ?>: <p class="d-inline" id="show_path"></p></h5>
                    <h5><?php echo e(__('Extension')); ?>: <p class="d-inline" id="show_extension"></p></h5>
                    <h5><?php echo e(__('Size')); ?>: <p class="d-inline" id="show_size"></p></h5>
                    <h5><?php echo e(__('Storage Type')); ?>: <p class="d-inline" id="show_storage"></p></h5>

                    <div class="row" id="single_image_div">
                        <div class="col-12">
                            <div class="show_img_div">
                                <img id="view_image">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/media_manager/partials/_info_modal.blade.php ENDPATH**/ ?>