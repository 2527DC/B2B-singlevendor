
<div class="primary_input mb-25">
    <div class="double_label d-flex justify-content-between">
        <label class="primary_input_label" for=""><?php echo e(__('product.attribute')); ?></label>
        <label class="primary_input_label green_input_label" for=""><a href="" id="add_new_attribute"><?php echo e(__('common.add_new')); ?><i class="fas fa-plus-circle"></i></a></label>
    </div>
    <select name="choice_attributes[]" id="choice_attributes"
        class="primary_select mb-15 choice_attribute">
        <option value="" disabled selected><?php echo e(__('product.select_attribute')); ?></option>
        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger"><?php echo e($errors->first('choice_attributes')); ?></span>
</div><?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/products/components/_attribute_list_select.blade.php ENDPATH**/ ?>