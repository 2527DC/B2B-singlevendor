<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col"><?php echo e(__('common.id')); ?></th>
                    <th scope="col"><?php echo e(__('common.name')); ?></th>
                    <th scope="col"><?php echo e(__('gst.same_state_GST')); ?></th>
                    <th scope="col"><?php echo e(__('gst.outsite_state_GST')); ?></th>
                    <th scope="col"><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $gst_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                        <td><?php echo e($group->name); ?></td>
                        <td>
                            <?php
                                $gsts = json_decode($group->same_state_gst);
                                $gsts = (array) $gsts;
                                ?>
                            <?php $__currentLoopData = $gsts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $percent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $gst = \Modules\GST\Entities\GstTax::find($key);
                            ?>
                            <?php if($gst !=''): ?>
                                <p><?php echo e($gst->name); ?>: <?php echo e(getNumberTranslate($percent)); ?> %</p>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php
                                $gsts = json_decode($group->outsite_state_gst);
                                $gsts = (array) $gsts;
                            ?>
                            <?php $__currentLoopData = $gsts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $percent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $gst = \Modules\GST\Entities\GstTax::find($key);
                                ?>
                                <?php if($gst !=''): ?>
                                <p><?php echo e($gst->name); ?>: <?php echo e(getNumberTranslate($percent)); ?> %</p>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <div class="dropdown CRM_dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(__('common.select')); ?>

                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item edit_group" data-id="<?php echo e($group->id); ?>"><?php echo e(__('common.edit')); ?></a>
                                    <a class="dropdown-item delete_group" data-id="<?php echo e($group->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div><?php /**PATH /var/www/DhatriProduction/Modules/GST/Resources/views/configurations/components/group_list.blade.php ENDPATH**/ ?>