<!DOCTYPE html>
<html lang="en" <?php if(isRtl()): ?> dir="rtl" class="rtl" <?php else: ?> <?php endif; ?>>
    <?php
    $themeColor = Modules\Appearance\Entities\ThemeColor::where('status',1)->first();
?>
<style>

    :root {
        --background_color : <?php echo e($themeColor->background_color); ?>;
        --base_color : <?php echo e($themeColor->base_color); ?>;
        --text_color : <?php echo e($themeColor->text_color); ?>;
        --feature_color : <?php echo e($themeColor->feature_color); ?>;
        --footer_background_color : <?php echo e($themeColor->footer_background_color); ?>;
        --footer_text_color : <?php echo e($themeColor->footer_text_color); ?>;
        --navbar_color : <?php echo e($themeColor->navbar_color); ?>;
        --menu_color : <?php echo e($themeColor->menu_color); ?>;
        --border_color : <?php echo e($themeColor->border_color); ?>;
        --success_color : <?php echo e($themeColor->success_color); ?>;
        --warning_color : <?php echo e($themeColor->warning_color); ?>;
        --danger_color : <?php echo e($themeColor->danger_color); ?>;
    }
</style>
<?php echo $__env->make('frontend.default.auth.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
    <?php $__env->startSection('content'); ?>
        <?php echo $__env->yieldSection(); ?>

    <?php echo $__env->make('frontend.default.auth.partials._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/default/auth/layouts/app.blade.php ENDPATH**/ ?>