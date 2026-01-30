
<div class="primary_input mb-25">
    <div class="double_label d-flex justify-content-between">
        <label class="primary_input_label" for=""><?php echo e(__('product.category')); ?> <span class="text-danger">*</span></label>
        <label class="primary_input_label green_input_label" for=""><a href="" id="add_new_category"><?php echo e(__('common.add_new')); ?><i class="fas fa-plus-circle"></i></a></label>
    </div>
    <select name="category_ids[]" id="category_id" class="mb-15 category_id" <?php if(app('general_setting')->multi_category == 1): ?> multiple <?php elseif(isset($product) && count($product->categories) > 1): ?> multiple <?php endif; ?> required="1">

        <?php if(old('category_ids')): ?>
            <?php
                $old_categories = \DB::table('categories')->whereRaw("id in ('". implode("','",old('category_ids'))."')")->get();
            ?>
            <?php $__currentLoopData = $old_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif(isset($product_categories)): ?>
            <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>
    <span class="text-danger" id="error_category_ids"><?php echo e($errors->first('category_id')); ?></span>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/components/_category_list_select.blade.php ENDPATH**/ ?>