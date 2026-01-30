<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <?php
           $value = [
            "name" => $category->name,
            "slug" => $category->slug,
            "icon" => $category->icon,
            "searchable" => $category->searchable,
            "status" => $category->status,
            "commission_rate" => $category->commission_rate,
            'image' => $category->categoryImage->image
           ];
        ?>
        <a data-value="<?php echo e(json_encode($value)); ?>" class="dropdown-item show_category"><?php echo e(__('common.show')); ?></a>
        <a data-id="<?php echo e($category->id); ?>" class="dropdown-item copy_id"><?php echo e(__('product.Copy ID')); ?></a>
        <?php if(permissionCheck('product.category.edit')): ?>
            <a class="dropdown-item edit_category" data-id="<?php echo e($category->id); ?>"><?php echo e(__('common.edit')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('product.category.delete')): ?>
            <a class="dropdown-item delete_brand" data-id="<?php echo e($category->id); ?>"><?php echo e(__('common.delete')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/category/components/_action_td.blade.php ENDPATH**/ ?>