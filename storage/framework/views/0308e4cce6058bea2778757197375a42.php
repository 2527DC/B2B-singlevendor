<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/vendors/css/nestable2.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/vendors/css/icon-picker.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/menu/css/style.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/menu/css/setup.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <?php if($menu->menu_type == 'mega_menu'): ?>
        <div class="row">
            <div class="col-md-12 mb-20">
                <div class="box_header_right">
                    <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#Setup" role="tab" data-toggle="tab" id="1"
                                    aria-selected="true"><?php echo e(__('common.setup')); ?></a>
                            </li>
                            <?php if(app('theme')->folder_path == 'default'): ?>
                                <li class="nav-item">
                                    <a class="nav-link show" href="#RightPanel" role="tab" data-toggle="tab" id="2"
                                        aria-selected="false"><?php echo e(__('menu.right_panel')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" href="#BottomPanel" role="tab" data-toggle="tab" id="3"
                                        aria-selected="false"><?php echo e(__('menu.bottom_panel')); ?></a>
                                </li>
                            <?php elseif(app('theme')->folder_path == 'amazy'): ?>
                                <li class="nav-item">
                                    <a class="nav-link show" href="#AdsSectionPanel" role="tab" data-toggle="tab" id="4"
                                        aria-selected="false"><?php echo e(__('common.ads_section')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($menu->menu_type == 'mega_menu'): ?>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Setup">
                <div class="container-fluid p-0">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('menu.setup_menu')); ?> -> <?php echo e($menu->name); ?></h3>
                                    <ul class="d-flex">
                                        <li><a href="<?php echo e(url('/menu/manage')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><?php echo e(__('menu.back_to_menu')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $__env->make('menu::menu.components.create_element', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div id="div333" class="col-lg-8">
                            <?php echo $__env->make('menu::menu.components.element_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                   </div>
                </div>
            </div>
            <?php if(app('theme')->folder_path == 'default'): ?>
                <div role="tabpanel" class="tab-pane fade" id="RightPanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('menu.right_panel_setup')); ?> -> <?php echo e($menu->name); ?></h3>
                                    <ul class="d-flex">
                                        <li><a href="<?php echo e(url('/menu/manage')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><?php echo e(__('menu.back_to_menu')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div id="formHtml" class="col-lg-12 mb-20">
                                    <div class="white-box minh-250">
                                        <div class="add-visitor">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="accordion_rightpanel_create">
                                                        <div class="card">
                                                            <div class="card-header" id="heading_rightpanel_create">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link add_btn_link collapsed" data-toggle="collapse"
                                                                        data-target="#menusrightpanel_create" aria-expanded="false" aria-controls="collapse_rightpanel_create">
                                                                        <?php echo e(__('product.add_category')); ?>

                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="menusrightpanel_create" class="collapse" aria-labelledby="heading_rightpanel_create"
                                                                data-parent="#accordion_rightpanel_create">
                                                                <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="primary_input mb-15">
                                                                            <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                            <select name="category" id="category_rightpanel" class="mb-15" multiple>
                                                                            </select>
                                                                            <span class="text-danger"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 text-center">
                                                                        <button id="add_category_rightpanel_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title="" data-original-title=""><span class="ti-check"></span><?php echo e(__('common.save')); ?> </button>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="white-box p-15">
                                <h4 class="mb-10"><?php echo e(__('common.category_list')); ?></h4>
                                <div id="rightpanelListDiv" class="minh-250">
                                    <?php echo $__env->make('menu::menu.components.rightpanel_category_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="BottomPanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('menu.bottom_panel_setup')); ?> -> <?php echo e($menu->name); ?></h3>
                                    <ul class="d-flex">
                                        <li><a href="<?php echo e(url('/menu/manage')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><?php echo e(__('menu.back_to_menu')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div id="formHtml" class="col-lg-12 mb-20">
                                    <div class="white-box minh-250">
                                        <div class="add-visitor">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="accordion_bottompanel_create">
                                                        <div class="card mb-10">
                                                            <div class="card-header" id="headingBrand_bottompanel_create">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link add_btn_link collapsed" data-toggle="collapse"
                                                                        data-target="#brands_bottompanel_create" aria-expanded="false"
                                                                        aria-controls="collapseBrand_bottompanel_create">
                                                                        <?php echo e(__('menu.add_brand')); ?>

                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="brands_bottompanel_create" class="collapse" aria-labelledby="headingBrand_bottompanel_create"
                                                                data-parent="#accordion_bottompanel_create">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?>

                                                                                    <span class="text-danger">*</span></label>
                                                                                <select name="brand" id="brand_bottompanel" class="mb-15" multiple>
                                                                                </select>
                                                                                <span class="text-danger"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 text-center">
                                                                            <button id="add_brand_bottompanel_create_btn" type="submit"
                                                                                class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                                                title="" data-original-title="">
                                                                                <span class="ti-check"></span>
                                                                                <?php echo e(__('common.save')); ?> </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="white-box p-15">
                                <h4 class="mb-10"><?php echo e(__('product.brand_list')); ?></h4>
                                <div id="bottompanelListDiv" class="minh-250">
                                    <?php echo $__env->make('menu::menu.components.bottompanel_brand_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif(app('theme')->folder_path == 'amazy'): ?>
                <div role="tabpanel" class="tab-pane fade" id="AdsSectionPanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('Ads section setup for')); ?> -> <?php echo e($menu->name); ?></h3>
                                    <ul class="d-flex">
                                        <li><a href="<?php echo e(url('/menu/manage')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><?php echo e(__('menu.back_to_menu')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div id="formHtml" class="col-lg-12 mb-20">
                                    <div class="white-box minh-250">
                                        <div class="add-visitor">
                                            <form action="" id="ads_form" enctype="multipart/form-data">
                                                <div class="row">
                                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                        <div class="col-lg-12">
                                                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#megamenuadselement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="megamenuadselement<?php echo e($language->code); ?>">
                                                                       <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="primary_input mb-25">
                                                                                    <label class="primary_input_label" for="subtitle"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input class="primary_input_field" type="text" id="title" value="<?php echo e(isset($menu->menuAds)?$menu->menuAds->getTranslation('title',$language->code):old('title.'.$language->code)); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off"  placeholder="<?php echo e(__('common.title')); ?>">
                                                                                    <span class="text-danger" id="ads_error_title_<?php echo e($language->code); ?>"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="primary_input mb-25">
                                                                                    <label class="primary_input_label" for="subtitle"><?php echo e(__('common.sub_title')); ?> <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input class="primary_input_field" type="text" id="subtitle" value="<?php echo e(isset($menu->menuAds)?$menu->menuAds->getTranslation('subtitle',$language->code):old('subtitle.'.$language->code)); ?>" name="subtitle[<?php echo e($language->code); ?>]" autocomplete="off"  placeholder="<?php echo e(__('common.sub_title')); ?>">
                                                                                    <span class="text-danger" id="ads_error_subtitle_<?php echo e($language->code); ?>"></span>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="subtitle"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span>
                                                                </label>
                                                                <input class="primary_input_field" type="text" id="title" value="<?php echo e(@$menu->menuAds->title); ?>" name="title" autocomplete="off"  placeholder="<?php echo e(__('common.title')); ?>">
                                                                <span class="text-danger" id="ads_error_title"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="subtitle"><?php echo e(__('common.sub_title')); ?> <span class="text-danger">*</span>
                                                                </label>
                                                                <input class="primary_input_field" type="text" id="subtitle" value="<?php echo e(@$menu->menuAds->subtitle); ?>" name="subtitle" autocomplete="off"  placeholder="<?php echo e(__('common.sub_title')); ?>">
                                                                <span class="text-danger" id="ads_error_subtitle"></span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-lg-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for="link"><?php echo e(__('common.link')); ?> <span class="text-danger">*</span>
                                                            </label>
                                                            <input class="primary_input_field" type="text" id="link" value="<?php echo e(@$menu->menuAds->link); ?>" name="link" autocomplete="off"  placeholder="<?php echo e(__('common.link')); ?>">
                                                            <span class="text-danger" id="ads_error_link"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="primary_input mt_40">
                                                            <ul id="theme_nav" class="permission_list sms_list ">
                                                                <li>
                                                                    <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                        <input name="status" id="status" value="1" <?php echo e(@$menu->menuAds->status?'checked':''); ?> type="checkbox">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <p><?php echo e(__('appearance.enable_this_section')); ?></p>
                                                                </li>
                                                            </ul>
                                                            <span class="text-danger" id="error_status"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 upload_photo_div">
                                                        <div class="primary_input">
                                                            <label class="primary_input_label"><?php echo e(__('common.image')); ?> (<?php echo e(getNumberTranslate(330)); ?> X <?php echo e(getNumberTranslate(300)); ?>)<?php echo e(__('common.px')); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="primary_input mb-25">
                                                            <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="menu_ads_image">
                                                                <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                                                                <button class="" type="button">
                                                                    <label class="primary-btn small fix-gr-bg" for="image"><?php echo e(__("blog.image")); ?> </label>
                                                                    <input type="hidden" class="selected_files" value="<?php echo e(@$menu->menuAds->menu_ads_image_media->media_id); ?>">
                                                                </button>
                                                            </div>
                                                            <div class="product_image_all_div">
                                                                <?php if(@$menu->menuAds->menu_ads_image_media->media_id): ?>
                                                                    <input type="hidden" name="menu_ads" class="product_images_hidden" value="<?php echo e(@$menu->menuAds->menu_ads_image_media->media_id); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="error_menu_ads"></span>
                                                    </div>
                                                    <input type="hidden" value="<?php echo e($menu->id); ?>" name="menu_id">
                                                    <div class="col-xl-4 offset-xl-4">
                                                        <button class="primary_btn_2 mt-5" id="ads_form_btn"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
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
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('menu.setup_menu')); ?> -> <?php echo e($menu->name); ?></h3>
                            <ul class="d-flex">
                                <li><a href="<?php echo e(url('/menu/manage')); ?>" class="primary-btn radius_30px mr-10 fix-gr-bg"><?php echo e(__('menu.back_to_menu')); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php echo $__env->make('menu::menu.components.create_element', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div id="div333" class="col-lg-8">
                    <?php echo $__env->make('menu::menu.components.element_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
           </div>
        </div>
        <?php endif; ?>
    </section>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',
    ['item_name' => __('menu.column'),'modal_id' => 'deleteColumnModal',
    'form_id' => 'column_delete_form','delete_item_id' => 'delete_column_id','dataDeleteBtn' =>'columnDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',
    ['item_name' => __('menu.element'),'modal_id' => 'deleteElementModal',
    'form_id' => 'element_delete_form','delete_item_id' => 'delete_element_id','dataDeleteBtn' =>'elementDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',
    ['item_name' => __('menu.menu'),'modal_id' => 'deleteMenuModal',
    'form_id' => 'menu_delete_form','delete_item_id' => 'delete_menu_id','dataDeleteBtn' =>'menuDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',
    ['item_name' => __('common.category'),'modal_id' => 'deleteCategoryModal',
    'form_id' => 'category_delete_form','delete_item_id' => 'delete_category_id','dataDeleteBtn' =>'categoryDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backEnd.partials._deleteModalForAjax',
    ['item_name' => __('product.brand'),'modal_id' => 'deleteBrandModal',
    'form_id' => 'brand_delete_form','delete_item_id' => 'delete_brand_id','dataDeleteBtn' =>'brandDeleteBtn'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('menu::menu.components._setup_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/setup.blade.php ENDPATH**/ ?>