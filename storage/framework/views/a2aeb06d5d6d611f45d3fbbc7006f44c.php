
<?php if(isset($prev_list)): ?>
    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $gst  = \Modules\GST\Entities\GstTax::find($list);
        $exsist = null;
        foreach ($prev_list as $key => $value) {
            if($key == $list){
                $exsist = $value;
            }
        }
    ?>
    <?php if($gst !=''): ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="primary_input mb-25">
                <input type="hidden" name="outsite_state_gst[]" value="<?php echo e($gst->name); ?>-<?php echo e($gst->id); ?>">
                <input class="primary_input_field name" type="text" value="<?php echo e($gst->name); ?>" autocomplete="off"  placeholder="" readonly>
            </div>
            <span class="text-danger" id="error_name"></span>
        </div>
        <div class="col-lg-6">
            <div class="primary_input mb-25">
                <input class="primary_input_field name" type="number" name="outsite_state_gst_percent[]" min="0" step="<?php echo e(step_decimal()); ?>" max="100" value="<?php echo e($exsist?$exsist:$gst->tax_percentage); ?>" autocomplete="off"  placeholder="">
            </div>
            <span class="text-danger" id="error_name"></span>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $gst  = \Modules\GST\Entities\GstTax::find($key);
        ?>
        <?php if($gst !=''): ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="name"> <?php echo e(__('common.name')); ?> <span class="text-danger">*</span> </label>
                    <input type="hidden" name="outsite_state_gst[]" value="<?php echo e($gst->name); ?>-<?php echo e($gst->id); ?>">
                    <input class="primary_input_field name" type="text" value="<?php echo e($gst->name); ?>" autocomplete="off"  placeholder="" readonly>
                </div>
                <span class="text-danger" id="error_name"></span>
            </div>
            <div class="col-lg-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="name"> <?php echo e(__('common.Value')); ?> <span class="text-danger">*</span> </label>
                    <input class="primary_input_field name" type="number" name="outsite_state_gst_percent[]" min="0" step="<?php echo e(step_decimal()); ?>" max="100" value="<?php echo e($amount); ?>" autocomplete="off"  placeholder="">
                </div>
                <span class="text-danger" id="error_name"></span>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /var/www/DhatriProduction/Modules/GST/Resources/views/configurations/components/outsite_state_gst_edit.blade.php ENDPATH**/ ?>