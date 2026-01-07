<div role="tabpanel" class="tab-pane fade show active" id="affiliate_link_tab">
    <div class="main-title">
        <h3 class="mb-20"><?php echo e(__('affiliate.Affiliate Links')); ?></h3>
    </div>
    <div class="QA_section QA_section_heading_custom check_box_table">
        <div class="QA_table ">
            <div class="">
                <table id="lms_table" class="table Crm_table_active3">
                    <thead>
                    <tr>
                        <th><?php echo e(__('affiliate.Affiliate Link')); ?></th>
                        <th><?php echo e(__('affiliate.Visits')); ?></th>
                        <th><?php echo e(__('affiliate.Registered')); ?></th>
                        <th><?php echo e(__('affiliate.Purchased')); ?></th>
                        <th><?php echo e(__('affiliate.Commissions')); ?></th>
                        <th><?php echo e(__('common.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td id="link_<?php echo e($item->id); ?>"><?php echo e($item->affiliate_link); ?></td>
                            <td><?php echo e($item->visits); ?></td>
                            <td><?php echo e($item->registerUser->count()); ?></td>
                            <td><?php echo e($item->payment->count()); ?></td>
                            <td><?php echo e(single_price($item->payment->sum('amount'))); ?></td>
                            <td>

                                <div class="dropdown CRM_dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(__('common.select')); ?>

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        <a href="#" class="dropdown-item show_category copy_btn" data-id="<?php echo e($item->id); ?>"><?php echo e(__('affiliate.copy_link')); ?></a>
                                        <a  class="dropdown-item delete_link" data-value="<?php echo e(route('affiliate.delete_link',$item->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/affiliate/components/tableDataComponents/_affiliate_link.blade.php ENDPATH**/ ?>