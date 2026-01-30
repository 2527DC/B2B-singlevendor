
<div class="primary_input mb-25">
    <div class="double_label d-flex justify-content-between">
        <label class="primary_input_label" for=""><?php echo e(__('product.unit')); ?> <span class="text-danger">*</span></label>
        <label class="primary_input_label green_input_label" for=""><a href="" id="add_new_unit"><?php echo e(__('common.add_new')); ?><i class="fas fa-plus-circle"></i></a></label>
    </div>
    <select name="unit_type_id" id="unit_type_id" class="primary_select mb-15 unit"
        required="1">
        <option disabled selected><?php echo e(__('product.select_unit')); ?></option>
        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($unit->id); ?>" <?php if(old('unit_type_id')): ?> <?php if(old('unit_type_id') == $unit->id): ?> selected <?php endif; ?> <?php else: ?> <?php if(isset($product)): ?> <?php if($product->unit_type_id == $unit->id): ?> selected <?php endif; ?> <?php endif; ?> <?php endif; ?>><?php echo e($unit->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger" id="error_unit_type"><?php echo e($errors->first('unit_type_id')); ?></span>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_unit_list_select.blade.php ENDPATH**/ ?>