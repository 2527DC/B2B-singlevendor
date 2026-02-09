<div role="tabpanel" class="tab-pane fade" id="transaction_tab">
    <div class="main-title">
        <h3 class="mb-20"><?php echo e(__('affiliate.Withdraw History')); ?></h3>
    </div>
    <div class="QA_section QA_section_heading_custom check_box_table">
        <div class="QA_table ">
            <div class="">
                <table id="lms_table" class="table Crm_table_active3">
                    <thead>
                    <tr>
                        <th><?php echo e(__('common.sl')); ?></th>
                        <th><?php echo e(__('affiliate.Request Date')); ?></th>
                        <th><?php echo e(__('affiliate.Amount')); ?></th>
                        <th><?php echo e(__('affiliate.Payment Type')); ?></th>
                        <th><?php echo e(__('common.status')); ?></th>
                        <th><?php echo e(__('affiliate.Confirm Date')); ?></th>
                        <th><?php echo e(__('common.action')); ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $user_transaction_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(getNumberTranslate($loop->iteration)); ?></td>
                            <td><?php echo e(dateConvert($item->request_date)); ?></td>
                            <td><?php echo e(single_price($item->withdraw_amount)); ?></td>
                            <td>
                                <?php if($item->payment_type == 1): ?>
                                    <span class="badge_5">Offline</span>
                                <?php elseif($item->payment_type == 2): ?>
                                    <span class="badge_5"><?php echo e(__('affiliate.paypal')); ?></span>
                                <?php else: ?>
                                    <span class="badge_5"> <?php echo e(__('affiliate.add_user_wallet')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($item->status == 0): ?>
                                    <span class="badge_3"><?php echo e(__('affiliate.Pending')); ?></span>
                                <?php elseif($item->status == 1): ?>
                                    <span class="badge_1"><?php echo e(__('affiliate.Done')); ?></span>
                                <?php else: ?>
                                    <span class="badge_4"><?php echo e(__('affiliate.Cancel')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($item->confirm_date?showDate($item->confirm_date):"NA"); ?>

                            </td>

                            <td>
                                <div class="dropdown CRM_dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(__('common.select')); ?>

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        <?php if($item->status == 0): ?>
                                            <a href="#" class="dropdown-item edit_row" data-id="<?php echo e($item->id); ?>"><?php echo e(__('common.edit')); ?></a>
                                        <?php endif; ?>
                                        <?php if($item->status == 0): ?>
                                            <a href="#" class="dropdown-item delete_row" data-id="<?php echo e($item->id); ?>" type="button"><?php echo e(__('common.delete')); ?></a>
                                        <?php endif; ?>
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
<?php /**PATH /var/www/DhatriProduction/Modules/Affiliate/Resources/views/affiliate/components/tableDataComponents/_transaction.blade.php ENDPATH**/ ?>