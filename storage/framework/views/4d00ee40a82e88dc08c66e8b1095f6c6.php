<?php if($data_type == 'product'): ?>
<div class="primary_input mb-25">
    <label class="primary_input_label" for=""><?php echo e(__('product.product_list')); ?></label>
    <select name="data_id" id="slider_product" class="product mb-15">
        <?php if($first_product): ?>
            <option value="<?php echo e($first_product->id); ?>" selected><?php echo e($first_product->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if($first_product->seller->role->type == 'seller'): ?> <?php echo e($first_product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?></option>
        <?php endif; ?>
        
    </select>
    <span class="text-danger"></span>
</div>

<?php elseif($data_type == 'category'): ?>
<div class="primary_input mb-25">
    <label class="primary_input_label" for=""><?php echo e(__('product.category_list')); ?></label>
    <select name="data_id" id="slider_category" class="category mb-15">

        <?php if($first_category): ?>
            <?php
                $depth = '';
                for($i= 1; $i <= $first_category->depth_level; $i++){
                    $depth .='-';
                }
                $depth.='> ';
            ?>
            <option value="<?php echo e($first_category->id); ?>" selected><?php echo e($depth . @$first_category->name); ?></option>
        <?php endif; ?>
        
    </select>
    <span class="text-danger"></span>
</div>
<?php elseif($data_type == 'brand'): ?>
<div class="primary_input mb-25">
    <label class="primary_input_label" for=""><?php echo e(__('product.brand_list')); ?></label>
    <select name="data_id" id="slider_brand" class="slider_brand mb-15">
        <?php if($first_brand): ?>
            <option value="<?php echo e($first_brand->id); ?>" selected><?php echo e($first_brand->name); ?></option>
        <?php endif; ?>
        
    </select>
    <span class="text-danger"></span>
</div>

<?php elseif($data_type == 'tag'): ?>
<div class="primary_input mb-25">
    <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <?php echo e(__('common.list')); ?></label>
    <select name="data_id" id="slider_tag" class=" slider_tag mb-15">
        <?php if($first_tag): ?>
            <option value="<?php echo e($first_tag->id); ?>" selected><?php echo e($first_tag->name); ?></option>
        <?php endif; ?>
    </select>
    <span class="text-danger"></span>
</div>

<?php elseif($data_type == 'url'): ?>
<div class="col-lg-12">
    <div class="primary_input mb-25">
            <label class="primary_input_label"
                for="url"><?php echo e(__('setup.url')); ?> <span class="text-danger">*</span></label>
                <input class="primary_input_field" type="text" id="url" name="data_id" autocomplete="off"
            value="" placeholder="<?php echo e(__('setup.url')); ?>">
    </div>
    <span class="text-danger" id="error_name"></span>
</div>


<?php endif; ?><?php /**PATH /var/www/DhatriProduction/Modules/Appearance/Resources/views/header/components/slider_for_data.blade.php ENDPATH**/ ?>