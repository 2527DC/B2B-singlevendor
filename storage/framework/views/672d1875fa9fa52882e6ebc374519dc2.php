<!DOCTYPE html>
<html dir="<?php echo e(isRtl()?'rtl':''); ?>" class="<?php echo e(isRtl()?'rtl':''); ?>">
<?php
$adminColor = Modules\Appearance\Entities\AdminColor::where('is_active',1)->first();
if(Auth::user()->role->type == "superadmin"){
    $notifications = Modules\OrderManage\Entities\CustomerNotification::where('read_status',0)->where(function($query){
        $query->whereNotNull('seller_id')
                ->orWhere('customer_id',Auth::id());
    })->latest()->get();
}else{
    $notifications= Modules\OrderManage\Entities\CustomerNotification::where('read_status',0)
    ->where(function($query){
        $query->where('seller_id',Auth::id())
                ->orWhere('customer_id',Auth::id());
    })->latest()->get();
}
if($adminColor->background_type == "image"){
    $background = "url(".showImage($adminColor->background_image).") no-repeat center";
}else{
    $background = $adminColor->background_color;
}
if($adminColor->color_mode == "solid"){
    $gradient1 = $adminColor->solid_color;
    $gradient2 = $adminColor->solid_color;
    $gradient3 = $adminColor->solid_color;
}else{
    $gradient1 = $adminColor->gradient_color_one;
    $gradient2 = $adminColor->gradient_color_two;
    $gradient3 = $adminColor->gradient_color_three;
}
?>
<style>
    :root {
    --background: <?php echo e($background); ?>;
    --base_color: <?php echo e($adminColor->base_color); ?>;
    --base_color_60: <?php echo e($adminColor->base_color); ?>99;
    --gradient_1: <?php echo e($gradient1); ?>;
    --gradient_2: <?php echo e($gradient2); ?>;
    --gradient_3: <?php echo e($gradient3); ?>;
    --text-color: <?php echo e($adminColor->text_color); ?>;
    --border_color: <?php echo e($adminColor->border_color); ?>;
    --scroll_color: <?php echo e($adminColor->scroll_color); ?>;
    --bg_white: <?php echo e($adminColor->background_white); ?>;
    --bg_black: <?php echo e($adminColor->background_black); ?>;
    --input__bg: <?php echo e($adminColor->input_background); ?>;
    --text_white: <?php echo e($adminColor->text_white); ?>;
    --text_black: <?php echo e($adminColor->text_black); ?>;
    --success: <?php echo e($adminColor->success_color); ?>;
    --danger: <?php echo e($adminColor->danger_color); ?>;
    --warning: <?php echo e($adminColor->warning_color); ?>;
    }
    .anchore_color{
        color: #415094;
    }


</style>
<?php echo $__env->make('backEnd.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="admin">
    <div id="pre-loader" class="">
        <?php echo $__env->make('backEnd.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
    <div class="main-wrapper min_height_600">
        <!-- Sidebar  -->
        <?php if(isModuleActive('Affiliate') && auth()->user()->role->type == 'affiliate' || isModuleActive('Affiliate') && auth()->user()->role->type == 'customer'): ?>
            <?php echo $__env->make('affiliate::_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('backEnd.partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!-- Page Content  -->
        <div id="main-content">
            <?php echo $__env->make('backEnd.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php $__env->startSection('mainContent'); ?>
            <?php echo $__env->yieldSection(); ?>
            <?php echo $__env->make('backEnd.partials._invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->make('backEnd.partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backEnd.partials._modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="mediaManagerDiv">
    </div>
    <?php echo $__env->make('backEnd.partials._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/master.blade.php ENDPATH**/ ?>