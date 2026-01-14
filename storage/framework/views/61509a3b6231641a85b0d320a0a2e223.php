<?php

    $total_number_of_item_get_for_this_page = ($orders->count() > 0) ? $orders->count() : 0;
    if ($total_number_of_item_get_for_this_page != 0) {
        $total_number_of_items = ($orders->total() > 0) ? $orders->total() : 1;
        $half_of_total_items = intval($total_number_of_items/2);
        $reminder = $total_number_of_items % 2;
        if ($reminder > 0) {
            $half_of_total_items += 1;
        }
        if ($total_number_of_item_get_for_this_page >= $half_of_total_items) {
            $total_number_of_pages = intval($total_number_of_items / $total_number_of_item_get_for_this_page);
            $reminder = $total_number_of_items % $total_number_of_item_get_for_this_page;
        }else {
            $total_number_of_pages = intval($total_number_of_items / $half_of_total_items);
            $reminder = $total_number_of_items % $half_of_total_items;
        }
        if ($reminder > 0) {
            $total_number_of_pages += 1;
        }
    }else {
        $total_number_of_pages = 1;
    }
?>
<div class="amaz_pagination d-flex align-items-center justify-content-center mb_10">
    <a class="arrow_btns d-inline-flex align-items-center justify-content-center ms-0" href="<?php echo e($orders->previousPageUrl()); ?>">
        <i class="fas fa-chevron-left"></i>
        <span><?php echo e(__('common.prev')); ?></span>
    </a>
    <?php for($i=1; $i <= $total_number_of_pages; $i++): ?>
        <?php if(($orders->currentPage() + 3) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($orders->currentPage() + 2) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($orders->currentPage() + 1) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if($orders->currentPage() == $i): ?>
            <a class="page_counter <?php if($request_type == $i || $request_type == null): ?> active <?php endif; ?>" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($orders->currentPage() - 1) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($orders->currentPage() - 2) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($orders->currentPage() - 3) == $i): ?>
            <a class="page_counter" href="<?php echo e($orders->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>

    <?php endfor; ?>
    <a class="arrow_btns d-inline-flex align-items-center justify-content-center" href="<?php echo e($orders->nextPageUrl()); ?>">
        <span><?php echo e(__('common.next')); ?></span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/partials/paginations.blade.php ENDPATH**/ ?>