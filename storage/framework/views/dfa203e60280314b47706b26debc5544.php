<div class="primary_input mb-25">
    <label class="primary_input_label" for=""><?php echo e(__('product.parent_category')); ?> <span class="text-danger">*</span></label>
    <select class="primary_select mb-25" name="parent_id" id="parent_id">
        <?php if(isset($first_category) && $first_category != null): ?>
            <option value="<?php echo e($first_category->id); ?>" selected><?php echo e($first_category->name); ?></option>
        <?php endif; ?>
    </select>
    
    <span class="text-danger"></span>
    
</div><?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/products/components/_category_parent_list.blade.php ENDPATH**/ ?>