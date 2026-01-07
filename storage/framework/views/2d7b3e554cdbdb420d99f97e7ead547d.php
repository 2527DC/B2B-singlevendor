<div class="row">
    <div class="col-lg-12">
        <table class="table Crm_table_active3">
            <thead>
                <tr>
                    <th scope="col"><?php echo e(__('common.sl')); ?></th>
                    <th scope="col"><?php echo e(__('common.title')); ?></th>
                    <th scope="col"><?php echo e(__('common.banner')); ?></th>
                    <th scope="col"><?php echo e(__('common.start_date')); ?></th>
                    <th scope="col"><?php echo e(__('common.end_date')); ?></th>
                    <th scope="col"><?php echo e(__('common.page')); ?> <?php echo e(__('common.link')); ?></th>
                    <th scope="col"><?php echo e(__('common.status')); ?></th>
                    <th scope="col"><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $DealList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                <td><?php echo e($deal->title); ?></td>
                <td>
                    <div class="banner_img_div">
                        <?php if($deal->banner_image != null): ?>
                            <img class="banner_height" src="<?php echo e(showImage($deal->banner_image)); ?>" alt="<?php echo e($deal->banner_image); ?>">
                        <?php else: ?>
                            <img class="banner_height" src="<?php echo e(showImage('frontend/img/no_image.png')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </td>
                <td><?php echo e(dateConvert($deal->start_date)); ?></td>
                <td><?php echo e(dateConvert($deal->end_date)); ?></td>
                <td><a href="<?php echo e(url('/flash-deal'.'/'.$deal->slug)); ?>">/flash-deal/<?php echo e($deal->slug); ?></a></td>
                <td>
                    <label class="switch_toggle" for="checkbox_<?php echo e($deal->id); ?>">
                        <input type="checkbox" id="checkbox_<?php echo e($deal->id); ?>" <?php echo e($deal->status?'checked':''); ?> <?php if(permissionCheck('marketing.flash-deals.status')): ?>  value="<?php echo e($deal->id); ?>" data-id="<?php echo e($deal->id); ?>" class="changeStatus" <?php endif; ?>>
                        <div class="slider round"></div>
                    </label>
                </td>
                
                <td>
                    <?php if(permissionCheck('marketing.flash-deals.edit') || permissionCheck('marketing.flash-deals.delete')): ?>
                        <!-- shortby  -->
                        <div class="dropdown CRM_dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('common.select')); ?>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                <?php if(permissionCheck('marketing.flash-deals.edit')): ?>
                                    <a href="<?php echo e(route('marketing.flash-deals.edit', $deal->id)); ?>" class="dropdown-item edit_brand"><?php echo e(__('common.edit')); ?></a>
                                <?php endif; ?>
                                <?php if(permissionCheck('marketing.flash-deals.delete')): ?>
                                    <a class="dropdown-item delete_deal" data-id="<?php echo e($deal->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- shortby  -->
                    <?php else: ?>
                        <button class="primary_btn_2" type="button"><?php echo e(__('common.no_action_permitted')); ?></button>
                    <?php endif; ?>
                </td>
            </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/flash_deals/components/list.blade.php ENDPATH**/ ?>