
<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $gst = \Modules\GST\Entities\GstTax::find($list);
    ?>
    <?php if($gst !=''): ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="name"> <?php echo e(__('common.name')); ?> <span class="text-danger">*</span> </label>
                <input class="primary_input_field name" type="text" value="<?php echo e($gst->name); ?>" autocomplete="off"  placeholder="" readonly>
                <input type="hidden" name="same_state_gst[]" value="<?php echo e($gst->name); ?>-<?php echo e($gst->id); ?>">
            </div>
            <span class="text-danger" id="error_name"></span>
        </div>
        <div class="col-lg-6">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="name"> <?php echo e(__('common.Value')); ?> <span class="text-danger">*</span> </label>
                <input class="primary_input_field name" type="number" name="same_state_gst_percent[]" min="0" step="<?php echo e(step_decimal()); ?>" max="100" value="<?php echo e($gst->tax_percentage); ?>" autocomplete="off"  placeholder="">
            </div>
            <span class="text-danger" id="error_value"></span>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/DhatriProduction/Modules/GST/Resources/views/configurations/components/same_state_gst.blade.php ENDPATH**/ ?>