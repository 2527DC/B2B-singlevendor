<div class="row">
    <div class="col-lg-12">
        <div class="QA_section QA_section_heading_custom check_box_table">
            <div class="QA_table">
                <div class="">
                    <table class="table Crm_table_active3">
                        <thead>
                            <tr>
                                <th width="15%" scope="col" class=" text-center"><?php echo e(__('common.sl')); ?></th>
                                <th width="35%" scope="col" class=""><?php echo e(__('common.name')); ?></th>
                                <th width="20%" scope="col" class=""><?php echo e(__('common.status')); ?></th>
                                <th width="30%" scope="col" class=""><?php echo e(__('common.action')); ?></th>
                            </tr>
                        </thead>
                        <tbody id="sku_tbody">
                            <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                                <td><?php echo e($priority->name); ?></td>
                                <td>
                                    <label class="switch_toggle" for="checkbox<?php echo e($priority->id); ?>">
                                        <input type="checkbox" id="checkbox<?php echo e($priority->id); ?>" <?php if(permissionCheck('ticket.priority.status')): ?> class="status_change" data-value="<?php echo e($priority->id); ?>" <?php echo e($priority->status?'checked':''); ?> value="<?php echo e($priority->id); ?>" <?php endif; ?>>
                                        <div class="slider round"></div>
                                    </label>
                                </td>
                                <td>
                                    <div class="dropdown CRM_dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo e(__('common.select')); ?>

                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                            <?php if(permissionCheck('ticket.priority.update')): ?>
                                                <a href="" data-value="<?php echo e($priority->id); ?>" class="dropdown-item edit_priority"><?php echo e(__('common.edit')); ?></a>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('ticket.priority.delete')): ?>
                                                <a href="" class="dropdown-item delete_priority" data-value="<?php echo e($priority->id); ?>"><?php echo e(__('common.delete')); ?></a>
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
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/SupportTicket/Resources/views/priority/components/list.blade.php ENDPATH**/ ?>