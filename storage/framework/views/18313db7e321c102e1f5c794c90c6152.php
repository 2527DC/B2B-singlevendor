<div role="tabpanel" class="tab-pane fade" id="income_tab">
    <div class="main-title">
        <h3 class="mb-20"><?php echo e(__('affiliate.Commission History')); ?></h3>
    </div>
    <div class="QA_section QA_section_heading_custom check_box_table">
        <div class="QA_table ">
            <div class="">
                <table id="lms_table" class="table Crm_table_active3">
                    <thead>
                    <tr>
                        <th><?php echo e(__('common.sl')); ?></th>
                        <th><?php echo e(__('common.date')); ?></th>
                        <th><?php echo e(__('affiliate.Amount')); ?></th>
                        <th><?php echo e(__('affiliate.Product')); ?></th>
                        <th><?php echo e(__('common.status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $user_income_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(getNumberTranslate($loop->iteration)); ?></td>
                            <td><?php echo e(dateConvert($item->date)); ?></td>
                            <td><?php echo e(single_price($item->amount)); ?></td>
                            <td><?php echo e($item->item?@$item->item->product_name:""); ?></td>
                            <td>
                                <?php if($item->status == 0): ?>
                                    <span class="badge_3"><?php echo e(__('affiliate.Pending')); ?></span>
                                <?php elseif($item->status == 1): ?>
                                    <span class="badge_1"><?php echo e(__('affiliate.Done')); ?></span>
                                <?php elseif($item->status == 2): ?>
                                    <span class="badge_2"><?php echo e(__('common.cancelled')); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/affiliate/components/tableDataComponents/_commissions.blade.php ENDPATH**/ ?>