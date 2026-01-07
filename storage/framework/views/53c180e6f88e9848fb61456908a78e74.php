<!-- sidebar part here -->
<nav id="sidebar" class="sidebar">
    <div class="sidebar-header update_sidebar">
        <a class="large_logo" href="<?php echo e(url('/login')); ?>">
            <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>">
        </a>
        <a class="mini_logo" href="<?php echo e(url('/login')); ?>">
            <img src="<?php echo e(showImage(app('general_setting')->favicon)); ?>">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    <ul id="sidebar_menu">
        <li>
            <a href="<?php echo e(route('affiliate.my_affiliate.index')); ?>" class="<?php echo e(request()->routeIs('affiliate.my_affiliate.index') ? 'active' : ''); ?>"> <?php echo e(__('affiliate.My Affiliate')); ?></a>
        </li>
    </ul>
</nav>
<!-- sidebar part end -->
<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/_sidebar.blade.php ENDPATH**/ ?>