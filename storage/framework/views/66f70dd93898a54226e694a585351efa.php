<label class="switch_toggle" for="checkbox_<?php echo e($code->id); ?>">
    <input type="checkbox" id="checkbox_<?php echo e($code->id); ?>" <?php echo e($code->status?'checked':''); ?> <?php if(permissionCheck('marketing.referral-code.status')): ?> value="<?php echo e($code->id); ?>" class="status_change_referral" <?php else: ?> disabled <?php endif; ?>>
    <div class="slider round"></div>
</label>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/referral_code/components/_status_td.blade.php ENDPATH**/ ?>