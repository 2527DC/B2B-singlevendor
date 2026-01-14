<?php
    $attribute = \Modules\Product\Entities\Attribute::where('id',$attribute)->first();
?>
<div class="row">
    <div class="col-lg-4"><input type="hidden" name="choice_no[]" id="attribute_id_<?php echo e($attribute->id); ?>" value="<?php echo e($attribute->id); ?>">
        <div class="primary_input mb-25"><input class="primary_input_field" width="40%" name="choice[]" type="text" value="<?php echo e($attribute->name); ?>" readonly></div>
    </div>
    <div class="col-lg-7">
        <div class="primary_input mb-25">
            <select name="choice_options_<?php echo e($attribute->id); ?>[]" id="choice_options" class="primary_select mb-15" multiple>
                <?php $__currentLoopData = @$attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->color): ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e(@$item->color->name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->value); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
    </div>
    <div class="col-lg-1 text-center">
        <a class="btn cursor_pointer attribute_remove"><i class="ti-trash"></i></a>
    </div>

</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/products/selected_attributes.blade.php ENDPATH**/ ?>