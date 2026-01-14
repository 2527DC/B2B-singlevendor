
<?php echo Toastr::message(); ?>
<script>
    <?php if(Session::has('messege')): ?>
    let type = "<?php echo e(Session::get('alert-type','info')); ?>";
    switch(type){
        case 'info':
            toastr.info("<?php echo e(Session::get('messege')); ?>");
            break;
        case 'success':
            toastr.success("<?php echo e(Session::get('messege')); ?>");
            break;
        case 'warning':
            toastr.warning("<?php echo e(Session::get('messege')); ?>");
            break;
        case 'error':
            toastr.error("<?php echo e(Session::get('messege')); ?>");
            break;
    }
    <?php endif; ?>
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/default/auth/partials/_scripts.blade.php ENDPATH**/ ?>