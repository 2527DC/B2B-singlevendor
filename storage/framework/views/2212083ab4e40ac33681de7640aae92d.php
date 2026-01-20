<div class="primary_input mb-15">
    <div class="double_label d-flex justify-content-between">
        <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?></label>
        <label class="primary_input_label green_input_label" for=""><a href="" id="add_new_brand"><?php echo e(__('common.add_new')); ?><i class="fas fa-plus-circle"></i></a></label>
    </div>
    <select  class="brand_id mb-15 primary_select2" id="brand_id" name="brand_id">
        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
        <?php if(old('brand_id')): ?>
        <?php
            $old_selected_brand = \DB::table('brands')->where('id', old('brand_id'))->first();
        ?>
        <option value="<?php echo e($old_selected_brand->id); ?>" selected><?php echo e($old_selected_brand->name); ?></option>
        <?php elseif(isset($product)): ?>
            <option value="<?php echo e($product->brand_id); ?>" selected><?php echo e($product->brand->name); ?></option>
        <?php endif; ?>
    </select>
    <span class="text-danger"><?php echo e($errors->first('customer_id')); ?></span>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_brand_list_select.blade.php ENDPATH**/ ?>