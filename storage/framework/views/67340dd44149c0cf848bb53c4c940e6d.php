<?php
   $popular_search = Modules\FrontendCMS\Entities\HomePageSection::where('section_name','popular_search')->first();
?>
<div id="popular_search" class="amaz_popular_search section_spacing <?php echo e(($popular_search) ? ($popular_search->status == 0?'d-none':'') : ''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30">
                    <h3 class="m-0 flex-fill"><?php echo e($popular_search->title); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if($search_items->count()): ?>
                    <div class="popular_search_lists mb_30">
                        <?php $__currentLoopData = $search_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="popular_search_list" href="<?php echo e(url('/').'/category'.'/'.$item->keyword.'?item=search&category=0'); ?>"><?php echo e($item->keyword); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p><?php echo e(__('amazy.no_search_keyword_found')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/components/popular-search-component.blade.php ENDPATH**/ ?>