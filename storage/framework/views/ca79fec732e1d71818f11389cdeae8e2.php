<div class="row">
    <div class="col-lg-12">
        <table class="table" id="categoryDataTable">
            <thead>
                <tr>
                    <th scope="col"><?php echo e(__('common.id')); ?></th>
                    <th scope="col"><?php echo e(__('common.name')); ?></th>
                    <th scope="col"><?php echo e(__('common.status')); ?></th>
                    <th scope="col"><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($reason->id); ?></td>
                    <td><?php echo e($reason->name); ?></td>
                    <td>
                        <?php if($reason->status == 1): ?>
                         <span class="badge_1">Active</span>
                        <?php else: ?>
                         <span class="badge_2">Active</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="dropdown CRM_dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a data-url='<?php echo e(route("product.report.edit",$reason->id)); ?>' class="dropdown-item edit_category">Edit</a>
                                    <a class="dropdown-item delete_brand" data-id="<?php echo e($reason->id); ?>">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/report_reasons/components/_list.blade.php ENDPATH**/ ?>