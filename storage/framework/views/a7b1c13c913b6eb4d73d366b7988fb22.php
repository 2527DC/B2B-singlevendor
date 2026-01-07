<div class="row">
    <div class="col-lg-12">
        <table class="table" id="categoryDataTable">
            <thead>
                <tr>
                    <th scope="col"><?php echo e(__('common.id')); ?></th>
                    <th scope="col"><?php echo e(__('common.name')); ?></th>
                    <th scope="col"><?php echo e(__('product.parent_category')); ?></th>
                    <?php if(isModuleActive('MultiVendor')): ?>
                    <th scope="col"><?php echo e(__('common.commission_rate')); ?></th>
                    <?php endif; ?>
                    <th scope="col"><?php echo e(__('common.status')); ?></th>
                    <th scope="col"><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/category/components/list.blade.php ENDPATH**/ ?>