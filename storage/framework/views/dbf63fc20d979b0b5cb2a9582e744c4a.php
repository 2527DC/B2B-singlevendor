<!DOCTYPE html>
<html dir="<?php echo e(isRtl()?'rtl':''); ?>" class="<?php echo e(isRtl()?'rtl':''); ?>" lang="en" itemscope
      itemtype="<?php echo e(url('/')); ?>">
<head>
    <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>

    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo e(app('general_setting')->site_title); ?>"/>
    <meta property="og:description" content="<?php echo e(app('general_setting')->site_title); ?>"/>
    <meta property="og:image" content="<?php echo e(showImage(app('general_setting')->favicon)); ?>"/>

    <title>Page Builder | <?php echo e($row->title); ?></title>

    

    <link rel="stylesheet" href="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/css/aoraeditor.css')); ?>"
          data-type="aoraeditor-style"/>
    <link rel="stylesheet"
          href="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/css/aoraeditor-components.css')); ?>"
          data-type="aoraeditor-style"/>


    <link rel="stylesheet" type="text/css" data-type="aoraeditor-style"
          href="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/css/style.css')); ?>">

    <?php
        if(app('theme')->folder_path == 'amazy'){
            $frontend_asset = asset(asset_path('frontend/amazy/compile_css/app.css'));
        }else{
            $frontend_asset = asset(asset_path('frontend/default/compile_css/app.css'));
        }
    ?>
    <link rel="stylesheet" data-type="aoraeditor-style" href="<?php echo e($frontend_asset); ?>" />

    <?php echo $__env->yieldContent('styles'); ?>

    <script src="<?php echo e(asset('public/js/common.js')); ?>"></script>
    <script type="text/javascript" data-type="aoraeditor-script"
            src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/jquery-1.11.3.min.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(asset('public/css/preloader.css')); ?>"/>

    <script type="text/javascript"
            src="<?php echo e(asset('public/frontend/infixlmstheme/js/jquery.lazy.min.js')); ?>"></script>
            <style>
             .aoraeditor-ui.btn-add-content {
                    color: #fff;
                    width: 40px;
                    height: 40px;
                    background: #556ee6 !important;
                    border-radius: 50%;
                    border: 0;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    transition: 0.3s;
                    border-radius: 50% !important;
                    text-decoration: none !important;
                }
            </style>
</head>
<body>
<?php if(str_contains(request()->url(), 'chat')): ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/css/jquery-ui.css')); ?><?php echo e(assetVersion()); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/vendors/select2/select2.css')); ?><?php echo e(assetVersion()); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/chat/css/style-student.css')); ?><?php echo e(assetVersion()); ?>">
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->role_id == 3 && !str_contains(request()->url(), 'chat')): ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/chat/css/notification.css')); ?><?php echo e(assetVersion()); ?>">
<?php endif; ?>

<?php if(isModuleActive("WhatsappSupport")): ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/whatsapp-support/style.css')); ?><?php echo e(assetVersion()); ?>">
<?php endif; ?>
<script>
    window.Laravel = {
        "baseUrl": '<?php echo e(url('/')); ?>' + '/',
        "current_path_without_domain": '<?php echo e(request()->path()); ?>',
        "csrfToken": '<?php echo e(csrf_token()); ?>',
    }
</script>

<script>
    window._locale = '<?php echo e(app()->getLocale()); ?>';
    window._translations = <?php echo json_encode(cache('translations'), JSON_INVALID_UTF8_IGNORE); ?>

</script>

<?php if(auth()->check() && auth()->user()->role_id == 3): ?>
    <style>
        .admin-visitor-area {
            margin: 0 30px 30px 30px !important;
        }

        .dashboard_main_wrapper .main_content_iner.main_content_padding {
            padding-top: 50px !important;
        }

        .primary_input {
            height: 50px;
            border-radius: 0px;
            border: unset;
            font-family: "Jost", sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: unset;
            padding: unset;
            width: 100%;
            <?php if($errors->any()): ?>
margin-bottom: 5px;
            <?php else: ?>
margin-bottom: 30px;
        <?php endif; ?>








}

        .primary_input_field {
            border: 1px solid #ECEEF4;
            font-size: 14px;
            color: #415094;
            padding-left: 20px;
            height: 46px;
            border-radius: 30px;
            width: 100%;
            padding-right: 15px;
        }

        .primary_input_label {
            font-size: 12px;
            text-transform: uppercase;
            color: #828BB2;
            display: block;
            margin-bottom: 6px;
            font-weight: 400;
        }

        .chat_badge {
            color: #ffffff;
            border-radius: 20px;
            font-size: 10px;
            position: relative;
            left: -20px;
            top: -12px;
            padding: 0px 4px !important;
            max-width: 18px;
            max-height: 18px;
            box-shadow: none;
            background: #ed353b;
        }

        .chat-icon-size {
            font-size: 1.35em;
            color: #687083;
        }
    </style>
<?php endif; ?>


<input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
<input type="hidden" name="base_url" class="base_url" value="<?php echo e(url('/')); ?>">
<input type="hidden" name="csrf_token" class="csrf_token" value="<?php echo e(csrf_token()); ?>">
<?php if(auth()->check()): ?>
    <input type="hidden" name="balance" class="user_balance" value="<?php echo e(auth()->user()->balance); ?>">
<?php endif; ?>
>
<div data-aoraeditor="html">

    <div id="content-area">
        <?php echo $__env->yieldContent('content'); ?>
    </div>


</div>


<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/ckeditor.js')); ?>"></script>
<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/form-builder.min.js')); ?>"></script>
<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/form-render.min.js')); ?>"></script>
<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/aoraeditor.js')); ?>"></script>

<script type="text/javascript"
        src="<?php echo e(asset('Modules/AoraPageBuilder/Resources/assets/js/aoraeditor-components.js')); ?>"></script>



<?php echo $__env->yieldContent('scripts'); ?>


<script type="text/javascript" data-aoraeditor="script">
    $(function () {
        // $('.dynamicData').each(function (i, obj) {
        //     aoraEditor.loadDynamicContent($(this));
        // });


    });
    $(function () {
        if ($.isFunction($.fn.lazy)) {
            $('.lazy').lazy();
        }
    });
</script>
</body>
</html>
<?php /**PATH /var/www/html/mytestdhatri/Modules/AoraPageBuilder/Resources/views/layouts/master.blade.php ENDPATH**/ ?>