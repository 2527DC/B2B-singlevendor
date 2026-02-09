
<?php if($data->stock_manage == 1): ?>
    <?php
        $stock = 0;
    ?>
    <?php $__currentLoopData = $data->skus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $stock += $sku->product_stock;
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <?php
        $stock = __("common.not_manage");
    ?>
<?php endif; ?>

<?php echo e($stock); ?>

<?php if($data->unit_type_id != null): ?>
    (<?php echo e(@$data->unit_type->name); ?>)
<?php endif; ?>
<?php /**PATH /var/www/DhatriProduction/Modules/AdminReport/Resources/views/product_stock/components/_stock_td.blade.php ENDPATH**/ ?>