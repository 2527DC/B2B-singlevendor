<div id="add_item_modal">
    <div class="modal fade" id="item_add">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <?php echo e(__('common.add_new')); ?>

                        <?php echo e(__('hr.department')); ?>

                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body item_create_form">
                    
                    <?php echo $__env->make('setup::department.components.form',['form_id' => 'item_create_form', 'button_level_name' => __('common.save') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Setup/Resources/views/department/components/create.blade.php ENDPATH**/ ?>