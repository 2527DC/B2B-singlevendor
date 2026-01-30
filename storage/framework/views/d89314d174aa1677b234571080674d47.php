<table class="table" id="SKUTable">
    <thead>

        <tr>
            <th scope="col"><?php echo e(__('common.sl')); ?></th>
            <th scope="col"><?php echo e(__('common.name')); ?></th>
            <th scope="col"><?php echo e(__('product.brand')); ?></th>
            <th scope="col"><?php echo e(__('product.sku')); ?></th>
            <th scope="col"><?php echo e(__('product.selling_price')); ?></th>
            <th scope="col"><?php echo e(__('common.image')); ?></th>
            <th scope="col"><?php echo e(__('common.action')); ?></th>
        </tr>
    </thead>

</table>


<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('product.product_sku '),'form_id' =>
'sku_delete_form','modal_id' => 'sku_delete_modal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/Production_dev/Modules/Product/Resources/views/products/sku_list.blade.php ENDPATH**/ ?>