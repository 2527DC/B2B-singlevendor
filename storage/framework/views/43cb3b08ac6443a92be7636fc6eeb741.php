<div class="dropdown CRM_dropdown">
    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
        <?php echo app('translator')->get('common.select'); ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a data-id="<?php echo e($value->id); ?>" class="dropdown-item copy_id"><?php echo e(__('product.Copy ID')); ?></a>
        <?php if(permissionCheck('tags.edit')): ?>
        <a class="dropdown-item edit_tag" data-value="<?php echo e($value); ?>" type="button"><?php echo e(__('common.edit')); ?></a>
        <?php endif; ?>
        <?php if(permissionCheck('tags.destroy')): ?>
        <a class="dropdown-item"
            onclick="confirm_modal('<?php echo e(route('tags.destroy', $value->id)); ?>');"><?php echo e(__('common.delete')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Setup/Resources/views/tags/_action_td.blade.php ENDPATH**/ ?>