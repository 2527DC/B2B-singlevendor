<?php $__env->startSection('title'); ?>
<?php echo e(__('common.notifications')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <div class="dashboard_white_box_header d-flex align-items-center gap_20 flex-wrap mb_20">
                        <h4 class="font_24 f_w_700 flex-fill m-0"><?php echo e(__('common.notifications')); ?> </h4>
                        <div class="wish_selects d-flex align-items-center gap_10 flex-wrap">
                            <a href="<?php echo e(url('/profile/notification_setting')); ?>" class="amaz_primary_btn style7 text-nowrap radius_3px"><?php echo e(__('common.setting')); ?></a>
                        </div>
                    </div>
                    <div class="dashboard_white_box_body">
                        <div class="table-responsive mb_30">
                            <table class="table amazy_table style5 mb-0">
                                <thead>
                                    <tr>
                                        <th class="font_14 f_w_700 priamry_text" scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.title')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.date')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(getNumberTranslate($loop->index+1)); ?></span>
                                            </td>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(ucfirst($notification->title)); ?></span>
                                            </td>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(dateConvert($notification->created_at)); ?></span>
                                            </td>
                                            <td>

                                                <?php if( str_contains("#",$notification->url) == false  &&   $notification->url != null): ?>
                                                    <a href="<?php echo e(url('/').$notification->url); ?>" class="amaz_badge_btn4 text-nowrap text-capitalize text-center"><?php echo e(__('common.view')); ?></a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" disabled class="amaz_badge_btn4 text-nowrap text-capitalize text-center disabled" ><?php echo e(__('common.view')); ?></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($notifications->lastPage() > 1): ?>
                            <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $notifications,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PaginationComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $attributes = $__attributesOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__attributesOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $component = $__componentOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__componentOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
                        <?php elseif(!$notifications->count()): ?>
                            <p class="empty_p"><?php echo e(__('common.empty_list')); ?>.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/notifications.blade.php ENDPATH**/ ?>