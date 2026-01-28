<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"> <?php echo e(__('common.select')); ?>

    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
        <a href="<?php echo e(route('order_manage.show_details',$order->id)); ?>" target="_blank" class="dropdown-item" type="button"><?php echo e(__('common.details')); ?></a>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Customer/Resources/views/customers/components/_show_order_action_td.blade.php ENDPATH**/ ?>