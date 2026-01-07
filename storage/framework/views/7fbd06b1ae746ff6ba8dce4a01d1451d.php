<div class="row student-details student-details_tab mt_0_sm m-0">
    <div class="col-lg-12 p-0">
        <ul class="nav nav-tabs no-bottom-border mt_0_sm mb-20 m-0 justify-content-start"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#affiliate_link_tab" role="tab" data-toggle="tab"><?php echo e(__('affiliate.Affiliate Link')); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#income_tab" role="tab" data-toggle="tab"><?php echo e(__('affiliate.Commissions')); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#transaction_tab" role="tab" data-toggle="tab"><?php echo e(__('affiliate.Withdraw')); ?></a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-15">
            <?php echo $__env->make('affiliate::affiliate.components.tableDataComponents._affiliate_link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('affiliate::affiliate.components.tableDataComponents._commissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('affiliate::affiliate.components.tableDataComponents._transaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/affiliate/components/_table_data.blade.php ENDPATH**/ ?>