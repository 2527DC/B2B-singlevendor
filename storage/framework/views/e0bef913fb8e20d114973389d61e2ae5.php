
<div class="">
    <!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
            <tr>
                <th scope="col"><?php echo e(__('common.sl')); ?></th>
                <th scope="col"><?php echo e(__('common.title')); ?></th>
                <th scope="col" width="20%"><?php echo e(__('common.banner')); ?></th>
                <th scope="col"><?php echo e(__('common.page')); ?> <?php echo e(__('common.link')); ?></th>
                <th scope="col"><?php echo e(__('common.status')); ?></th>
                <th scope="col"><?php echo e(__('common.action')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $ZoneList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                <td><?php echo e($zone->title); ?></td>
                <td>
                    <div class="banner_img_div">
                        <?php if($zone->banner_image != null): ?>
                        <img src="<?php echo e(showImage($zone->banner_image)); ?>" alt="<?php echo e($zone->banner_image); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </td>
                <td><a target="_blank" href="<?php echo e(url('new-user-zone/'.$zone->slug)); ?>"><?php echo e($zone->slug); ?></a></td>
                <td>
                    <label class="switch_toggle" for="checkbox_<?php echo e($zone->id); ?>">
                        <input type="checkbox" id="checkbox_<?php echo e($zone->id); ?>" <?php echo e($zone->status?'checked':''); ?> <?php if(permissionCheck('marketing.new-user-zone.status')): ?> value="<?php echo e($zone->id); ?>"
                        data-id="<?php echo e($zone->id); ?>" class="changeStatus" <?php endif; ?>>
                        <div class="slider round"></div>
                    </label>
                </td>
                <td>
                    <?php if(permissionCheck('marketing.new-user-zone.edit') ||
                    permissionCheck('marketing.new-user-zone.delete')): ?>
                    <!-- shortby  -->
                    <div class="dropdown CRM_dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo e(__('common.select')); ?>

                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <?php if(permissionCheck('marketing.new-user-zone.edit')): ?>
                            <a href="<?php echo e(route('marketing.new-user-zone.edit', $zone->id)); ?>"
                                class="dropdown-item edit_brand"><?php echo e(__('common.edit')); ?></a>
                            <?php endif; ?>
                            <?php if(permissionCheck('marketing.new-user-zone.delete')): ?>
                            <a href="javascript:void(0)" class="dropdown-item delete_zone" data-id="<?php echo e($zone->id); ?>"><?php echo e(__('common.delete')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- shortby  -->
                    <?php else: ?>
                    <button class="primary_btn_2" type="button">No Action Permitted</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/new_user_zone/components/list.blade.php ENDPATH**/ ?>