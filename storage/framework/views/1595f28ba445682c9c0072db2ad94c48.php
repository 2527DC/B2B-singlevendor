<!doctype html>
<html <?php if(isRtl()): ?> dir="rtl" class="rtl no-js" <?php else: ?> class="no-js" <?php endif; ?> lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e(app('general_setting')->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(showImage(app('general_setting')->favicon)); ?>">

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
    <!-- CSS here -->
    <?php if(isRtl()): ?>
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('frontend/amazy/compile_css/rtl_app.css'))); ?>" >
    <?php else: ?>
    <link rel="stylesheet"  href="<?php echo e(asset(asset_path('frontend/amazy/compile_css/app.css'))); ?>" >
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <!-- CSS here -->
</head>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/auth/partials/_header.blade.php ENDPATH**/ ?>