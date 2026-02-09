

<?php $__env->startSection('mainContent'); ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="main-title d-flex">
            <h3 class="mb-0 mr-3 text-nowrap"><?php echo e(__('utilities.utilities')); ?> </h3>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <?php if(permissionCheck('utilities_clear_cache')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100" href="<?php echo e(route('utilities.index', ['utilities' => 'optimize_clear'])); ?>">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="ti-cloud font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"><?php echo e(__('utilities.clear_cache')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if(permissionCheck('utilities_clear_log')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100"
                    href="<?php echo e(route('utilities.index', ['utilities' => 'clear_log'])); ?>">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="ti-receipt font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"><?php echo e(__('utilities.clear_log')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if(permissionCheck('utilities_change_debug_mode')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100"
                    href="<?php echo e(route('utilities.index', ['utilities' => 'change_debug'])); ?>">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="ti-blackboard font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"><?php if(env('APP_DEBUG')): ?> <?php echo e(__('utilities.disable')); ?>

                            <?php else: ?> <?php echo e(__("utilities.enable")); ?> <?php endif; ?> <?php echo e(__('utilities.app_debug')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if(permissionCheck('utilities_change_force_https')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100"
                    href="<?php echo e(route('utilities.index', ['utilities' => 'force_https'])); ?>">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="ti-lock font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"><?php if(env('FORCE_HTTPS')): ?> <?php echo e(__('utilities.disable')); ?>

                            <?php else: ?> <?php echo e(__("utilities.enable")); ?> <?php endif; ?> <?php echo e(__('utilities.force_https')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if(auth()->id() == 1): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100" id="reset_database_card" href="#">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="fas fa-database font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"> <?php echo e(__('utilities.reset_database')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if(auth()->id() == 1): ?>
                <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                    <a class="white-box single-summery d-block btn-ajax w-100" id="import_database_card" href="#">
                        <div class="d-block mt-10 text-center ">
                            <h3><i class="fas fa-database font_30"></i></h3>
                            <h1 class="gradient-color2 total_purchase"><?php echo e(__('utilities.import_demo_database')); ?></h1>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if(permissionCheck('utilities_xml_sitemap')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100" href="#" id="xml_sitemap_card">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="fas fa-sitemap font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"> <?php echo e(__('utilities.xml_sitemap')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if(permissionCheck('utilities.remove_visitor')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100" id="remove_visitor_card" href="#">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="fa fa-trash font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"> <?php echo e(__('utilities.remove_visitor')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if(permissionCheck('utilities.convert_images')): ?>
            <div class="col-md-4 col-lg-3 col-sm-6 d-flex">
                <a class="white-box single-summery d-block btn-ajax w-100" id="convertImageModel" href="#">
                    <div class="d-block mt-10 text-center ">
                        <h3><i class="fas fa-images font_30"></i></h3>
                        <h1 class="gradient-color2 total_purchase"> <?php echo e(__('general_settings.convert_images')); ?></h1>
                    </div>
                </a>
            </div>
            <?php endif; ?>


            <div class="col-lg-12">
                <div class="alert alert-warning mt-30 text-center">
                    <?php echo e(__('utilities.It can take some times to execute operation. please wait until completed
                    operation')); ?>

                </div>
            </div>

            
            <div class="modal fade admin-query" id="resetModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo app('translator')->get('utilities.reset_database'); ?></h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <strong><?php echo e(__('utilities.reset_database_note')); ?></strong>
                                <h4><?php echo app('translator')->get('utilities.are_you_sure_to_reset_database'); ?></h4>
                            </div>
                            <div class="mt-40 justify-content-between">
                                <form id="activate_form" action="<?php echo e(route('utilities.reset_database')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for="title"><?php echo e(__('common.enter_your_password')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input required type="password" id="password"
                                                    class="primary_input_field" name="password" autocomplete="off"
                                                    value="" placeholder="<?php echo e(__('common.enter_your_password')); ?> ">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="primary_input">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                id="save_button_parent"><?php echo e(__('utilities.reset_database')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade admin-query" id="xmlModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo app('translator')->get('utilities.xml_sitemap'); ?></h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h4><?php echo app('translator')->get('utilities.choose_sitemap_option'); ?></h4>
                            </div>
                            <div class="mt-40 justify-content-between">
                                <form id="activate_form" action="<?php echo e(route('utilities.xml_sitemap')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <div class="primary_input">

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label data-id="bg_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" id="all" value="all" <?php if($sitemap_config->where('type','all')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    class="active" type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.all')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="pages" <?php if($sitemap_config->where('type','pages')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.page')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="products" <?php if($sitemap_config->where('type','products')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.product')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                            class="primary_checkbox d-flex mr-12">
                                                            <input name="sitemap[]" value="brands" <?php if($sitemap_config->where('type','brands')->first()->status == 1): ?>checked <?php endif; ?>
                                                                id="status_inactive" class="de_active"
                                                                type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.brand')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="tags" <?php if($sitemap_config->where('type','tags')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.tag')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="flash_deal" <?php if($sitemap_config->where('type','flash_deal')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('marketing.flash_deal')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="new_user_zone" <?php if($sitemap_config->where('type','new_user_zone')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('marketing.new_user_zone')); ?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label data-id="color_option"
                                                                class="primary_checkbox d-flex mr-12">
                                                                <input name="sitemap[]" value="blogs" <?php if($sitemap_config->where('type','blogs')->first()->status == 1): ?>checked <?php endif; ?>
                                                                    id="status_inactive" class="de_active"
                                                                    type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('blog.blog')); ?></p>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger" id="status_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="primary_input">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                id="save_button_parent"><?php echo e(__('common.submit')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="modal fade admin-query" id="ImportDatabaseModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo e(__('utilities.import_demo_database')); ?></h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <strong><?php echo e(__('utilities.import_demo_note')); ?></strong>
                                <h4><?php echo e(__('utilities.are_you_sure_to_import_demo_database')); ?></h4>
                            </div>

                            <div class="mt-40 justify-content-between">
                                <form id="activate_form" action="<?php echo e(route('utilities.import_demo_database')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for="title"><?php echo e(__('common.enter_your_password')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input required type="password" id="password"
                                                    class="primary_input_field" name="password" autocomplete="off"
                                                    value="" placeholder="<?php echo e(__('common.enter_your_password')); ?> ">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="primary_input">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                id="save_button_parent"><?php echo e(__('utilities.import_database')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade admin-query" id="RemoveVisitorModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo app('translator')->get('utilities.remove_all_visitor'); ?></h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <strong><?php echo e(__('utilities.remove_visitor_note')); ?></strong>
                                <h4><?php echo app('translator')->get('utilities.are_you_sure_to_remove_visitor'); ?></h4>
                            </div>

                            <div class="mt-40 justify-content-between">
                                <form id="activate_form" action="<?php echo e(route('utilities.remove_visitor')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for="title"><?php echo e(__('common.enter_your_password')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input required type="password" id="password"
                                                    class="primary_input_field" name="password" autocomplete="off"
                                                    value="" placeholder="<?php echo e(__('common.enter_your_password')); ?> ">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="primary_input">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                id="save_button_parent"><?php echo e(__('utilities.remove_visitor')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


             
             <div class="modal fade admin-query" id="convertImageModelData">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo e(__('general_settings.convert_images')); ?></h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <strong><?php echo e(__('general_settings.convert_image_note')); ?></strong>
                                <h4><?php echo e(__('general_settings.are_you_sure_to_convert_images_to_webp')); ?></h4>
                            </div>

                            <div class="mt-40 justify-content-between">
                                <form id="activate_form" action="<?php echo e(route('generalsetting.convertImages')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for="title"><?php echo e(__('common.enter_your_password')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input required type="password" id="password"
                                                    class="primary_input_field" name="password" autocomplete="off"
                                                    value="" placeholder="<?php echo e(__('common.enter_your_password')); ?> ">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="primary_input">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                id="save_button_parent"><?php echo e(__('general_settings.convert')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click', '#reset_database_card', function(event){
                    event.preventDefault();
                    $('#resetModal').modal('show');
                });
                $(document).on('click', '#import_database_card', function(event){
                    event.preventDefault();
                    $('#ImportDatabaseModal').modal('show');
                });
                $(document).on('click', '#remove_visitor_card', function(event){
                    event.preventDefault();
                    $('#RemoveVisitorModal').modal('show');
                });
                $(document).on('click', '#xml_sitemap_card', function(event){
                    event.preventDefault();
                    $('#xmlModal').modal('show');
                });
                $(document).on('click', '#all', function(event){
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                $(document).on('click', '.de_active', function(event){
                    $('#all').prop('checked',false);
                });
                $(document).on('click','#convertImageModel',function(){
                    $("#convertImageModelData").modal('show');
                });

            });
        })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Utilities/Resources/views/index.blade.php ENDPATH**/ ?>