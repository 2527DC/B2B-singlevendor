<div class="dashboard_white_box_header d-flex align-items-center gap_20 flex-wrap mb_20">
    <h4 class="font_24 f_w_700 flex-fill m-0"><?php echo e(__('ticket.all_submmited_ticket')); ?> </h4>
    <div class="wish_selects d-flex align-items-center gap_10 flex-wrap">
        <select class="amaz_select4 style2" name="status" id="status_by">
            <option value="0" <?php if(isset($status) && $status == "0"): ?> selected <?php endif; ?>><?php echo e(__('ticket.all_ticket')); ?></option>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($item->id); ?>" <?php if(isset($status) && $status == $item->id): ?> selected <?php endif; ?>><?php echo e($item->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <a href="<?php echo e(route('frontend.support-ticket.create')); ?>" class="amaz_primary_btn style7 text-nowrap radius_3px">+ <?php echo e(__('common.add_new')); ?></a>
    </div>
</div>
<div class="dashboard_white_box_body">
    <div class="table-responsive mb_30">
        <table class="table amazy_table style5 mb-0">
            <thead>
                <tr>
                    <th class="font_14 f_w_700 priamry_text" scope="col"><?php echo e(__('common.sl')); ?></th>
                    <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('ticket.ticket_id')); ?></th>
                    <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('ticket.subject')); ?></th>
                    <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('ticket.priority')); ?></th>
                    <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('ticket.last_update')); ?></th>
                    <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span class="font_14 f_w_500 mute_text"><?php echo e(getNumberTranslate($key + 1)); ?></span>
                        </td>
                        <td>
                            <span class="font_14 f_w_500 mute_text"><?php echo e($ticket->reference_no); ?></span>
                        </td>
                        <td>
                            <span class="font_14 f_w_500 mute_text"><?php echo e($ticket->subject); ?></span>
                        </td>
                        <td>
                        <a href="#" class="table_badge_btn style4 text-nowrap"><?php echo e(@$ticket->priority->name); ?></a>
                        </td>
                        <td>
                            <span class="font_14 f_w_500 mute_text text-nowrap"><?php echo e(date_format($ticket->updated_at, 'F j, Y ')); ?> <?php echo e(__('ticket.at')); ?>

                                <?php echo e(date_format($ticket->updated_at, 'g:i a')); ?></span>
                        </td>
                        <td>
                        <a href="<?php echo e(route('frontend.support-ticket.show', $ticket->reference_no)); ?>" class="amaz_badge_btn4 text-nowrap text-capitalize text-center"><?php echo e(__('common.view')); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php if($tickets->lastPage() > 1): ?>
        <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $tickets,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <?php elseif(!$tickets->count()): ?>
        <p class="empty_p"><?php echo e(__('common.empty_list')); ?>.</p>
    <?php endif; ?>
</div><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/ticket/partials/_ticket_list_with_paginate.blade.php ENDPATH**/ ?>