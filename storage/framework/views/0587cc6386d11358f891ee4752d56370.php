<label class="switch_toggle" for="checkbox_<?php echo e($subscriber->id); ?>">
    <input type="checkbox" id="checkbox_<?php echo e($subscriber->id); ?>" <?php echo e($subscriber->status?'checked':''); ?> <?php if(permissionCheck('marketing.subscriber.status')): ?> value="<?php echo e($subscriber->id); ?>" class="status_change_subscription" <?php else: ?> disabled <?php endif; ?>>
    <div class="slider round"></div>
</label>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/subscribers/components/_status_td.blade.php ENDPATH**/ ?>