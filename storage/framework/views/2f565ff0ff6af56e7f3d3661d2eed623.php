<?php
    $total_number_of_item_per_page = $items->perPage();
    $total_number_of_items = ($items->total() > 0) ? $items->total() : 0;
    $total_number_of_pages = $total_number_of_items / $total_number_of_item_per_page;
    $reminder = $total_number_of_items % $total_number_of_item_per_page;
    if ($reminder > 0) {
        $total_number_of_pages += 1;
    }

    $current_page = $items->currentPage();
    $previous_page = $items->currentPage() - 1;
    if($current_page == $items->lastPage()){
    $show_end = $total_number_of_items;
    }else{
    $show_end = $total_number_of_item_per_page * $current_page;
    }


    $show_start = 0;
    if($total_number_of_items > 0){
        $show_start = ($total_number_of_item_per_page * $previous_page) + 1;
    }
    if(!isset($request_type)){
        $request_type = request()->toRecievedList;
    }
?>
<div class="amaz_pagination d-flex align-items-center justify-content-center mb_10 mt_20">
    <a class="arrow_btns d-inline-flex align-items-center justify-content-center page_link <?php echo e($type); ?> ms-0 <?php if(!$items->previousPageUrl()): ?> paginate_disabled <?php endif; ?>" href="<?php if($items->previousPageUrl()): ?> <?php echo e($items->previousPageUrl()); ?> <?php endif; ?>">
        <i class="fas fa-chevron-left"></i>
        <span><?php echo e(__('common.prev')); ?></span>
    </a>
    <?php for($i=1; $i <= $total_number_of_pages; $i++): ?>
        <?php if(($items->currentPage() + 3) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($items->currentPage() + 2) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($items->currentPage() + 1) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if($items->currentPage() == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?> <?php if($request_type == $i || $request_type == null): ?> active <?php endif; ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($items->currentPage() - 1) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($items->currentPage() - 2) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
        <?php if(($items->currentPage() - 3) == $i): ?>
            <a class="page_counter page_link <?php echo e($type); ?>" href="<?php echo e($items->url($i)); ?>"><?php echo e(getNumberTranslate($i)); ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <a class="arrow_btns d-inline-flex align-items-center justify-content-center page_link <?php echo e($type); ?> <?php if(!$items->nextPageUrl()): ?> paginate_disabled <?php endif; ?>" href="<?php if($items->nextPageUrl()): ?><?php echo e($items->nextPageUrl()); ?><?php endif; ?>">
        <span><?php echo e(__('common.next')); ?></span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/components/pagination-component.blade.php ENDPATH**/ ?>