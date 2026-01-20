<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/footersetting/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php
        if(\Session::has('footer_tab')){
            $footerTab = \Session::get('footer_tab');
        }else{
            $footerTab = 1;
        }
    ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
    <section class="mb-40 student-details up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 mb-20">
                            <div class="box_header_right">
                                <div class="float-lg-right float-none pos_tab_btn justify-content-end">
                                    <ul class="nav" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($footerTab == 1?'active':''); ?> show active_section_class" href="#copyrightText" role="tab" data-toggle="tab" id="1" data-id="1" aria-selected="true"><?php echo e(__('frontendCms.copyright_text')); ?></a>
                                        </li>
                                        <?php if(app('theme')->folder_path == 'amazy'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($footerTab == 6?'active':''); ?> show active_section_class" href="#appLinkOther" role="tab" data-toggle="tab" id="6" data-id="6" aria-selected="true"><?php echo e(__('amazy.App link & others')); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($footerTab == 2?'active':''); ?> show active_section_class" href="#footer_1" role="tab" data-toggle="tab" id="2" data-id="2" aria-selected="false"><?php echo e(__('frontendCms.about_text')); ?></a>
                                        </li>
                                        <li class="nav-item" id="company_tab">
                                            <a class="nav-link <?php echo e($footerTab == 3?'active':''); ?> show active_section_class" href="#footer_2" role="tab" data-toggle="tab" id="3" data-id="3" aria-selected="false"><?php echo e($FooterContent->footer_section_one_title); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($footerTab == 4?'active':''); ?> show active_section_class" href="#footer_3" role="tab" data-toggle="tab" id="4" data-id="4" aria-selected="true"><?php echo e($FooterContent->footer_section_two_title); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($footerTab == 5?'active':''); ?> show active_section_class" href="#footer_4" role="tab" data-toggle="tab" id="5" data-id="5" aria-selected="true"><?php echo e($FooterContent->footer_section_three_title); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade <?php echo e($footerTab == 1?'active show':''); ?> " id="copyrightText">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30"> <?php echo e(__('common.update')); ?> </h3>
                                        </div>
                                        <form method="POST" action="" id="copyright_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="white-box">
                                                <div class="add-visitor">
                                                    <div class="row">
                                                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                            <div class="col-lg-12">
                                                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                                                            <div class="primary_input mb-35">
                                                                                <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                                                <textarea required name="copy_right[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__('common.copyright')); ?>" class="lms_summernote summernote" id="copy_right<?php echo e(auth()->user()->lang_code == $language->code?$language->code:''); ?>"><?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_copy_right',$language->code):old('copy_right.'.$language->code)); ?></textarea>
                                                                            </div>
                                                                            <span class="text-danger" id="error_copy_right">
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="col-xl-12">
                                                                <div class="primary_input mb-35">
                                                                    <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                                    <textarea required name="copy_right" placeholder="<?php echo e(__('common.copyright')); ?>" class="lms_summernote summernote" id="copy_right"><?php echo e($FooterContent->footer_copy_right); ?></textarea>
                                                                </div>
                                                                <span class="text-danger" id="error_copy_right">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if(permissionCheck('copyright_content_update')): ?>
                                                        <div class="row mt-40">
                                                            <div class="col-lg-12 text-center tooltip-wrapper">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper " id="copyrightBtn"> <span class="ti-check"></span> <?php echo e(__('common.update')); ?> </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php if(app('theme')->folder_path == 'amazy'): ?>
                                <div role="tabpanel" class="tab-pane fade <?php echo e($footerTab == 6?'active show':''); ?> " id="appLinkOther">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30"> <?php echo e(__('common.update')); ?> </h3>
                                        </div>
                                        <form method="POST" action="" id="app_link_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="white-box">
                                                <div class="add-visitor">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="play_store"><?php echo e(__('amazy.Play store link')); ?> <span class="text-danger">*</span></label>
                                                                <input name="play_store" id="play_store" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('play_store') ? old('play_store') : $footer_content_new->play_store); ?>">
                                                                <span class="text-danger"  id="error_play_store"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="app_store"><?php echo e(__('amazy.App store link')); ?> <span class="text-danger">*</span></label>
                                                                <input name="app_store" id="app_store" class="primary_input_field" placeholder="-" type="text"
                                                                       value="<?php echo e(old('app_store') ? old('app_store') : $footer_content_new->app_store); ?>">
                                                                <span class="text-danger"  id="error_app_store"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="primary_input">
                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                    <li>
                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="play_store_show" id="play_store_show" <?php echo e($footer_content_new->show_play_store?'checked':''); ?> value="1"
                                                                                type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('frontendCms.play_store_show_in_frontend')); ?></p>
                                                                    </li>
                                                                </ul>
                    
                                                            </div>
                                                            <div class="primary_input">
                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                    <li>
                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="app_store_show" id="app_store_show" <?php echo e($footer_content_new->show_app_store?'checked':''); ?> value="1"
                                                                                type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('frontendCms.app_store_show_in_frontend')); ?></p>
                                                                    </li>
                                                                </ul>
                    
                                                            </div>
                                                            <div class="primary_input">
                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                    <li>
                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="show_payment_image" id="show_payment_image" <?php echo e($footer_content_new->show_payment_image?'checked':''); ?> value="1"
                                                                                type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('frontendCms.payment_image_show_in_frontend')); ?></p>
                                                                    </li>
                                                                </ul>
                    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(<?php echo e(getNumberTranslate(513)); ?> X <?php echo e(getNumberTranslate(60)); ?>)<?php echo e(__('common.px')); ?></small></label>
                                                                <div class="primary_file_uploader">
                                                                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                                                                    <button class="" type="button">
                                                                        <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo e(__("common.image")); ?> </label>
                                                                        <input type="file" class="d-none" name="payment_image" id="document_file_1">
                                                                    </button>
                                                                </div>
                                                                <span class="text-danger"  id="file_error"></span>
                                                                
                                                                <div class="img_div mt-20">
                                                                   <img id="blogImgShow"
                                                                   src="<?php echo e(showImage($footer_content_new->payment_image?$footer_content_new->payment_image:'backend/img/default.png')); ?>" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if(permissionCheck('about_content_update')): ?>
                                                        <div class="row mt-40">
                                                            <div class="col-lg-12 text-center tooltip-wrapper" >
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper " id="appLinkBtn">
                                                                    <span class="ti-check"></span>
                                                                    <?php echo e(__('common.update')); ?> </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div role="tabpanel" class="tab-pane <?php echo e($footerTab == 2?'active show':''); ?> fade" id="footer_1">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="col-lg-12">
                                                <div class="main-title">
                                                    <h3 class="mb-30"> <?php echo e(__('common.update')); ?> </h3>
                                                </div>
                                                <form method="POST" id="aboutForm" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                    <div class="white-box">
                                                        <div class="add-visitor">
                                                            <div class="row">
                                                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                <div class="col-lg-12">
                                                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 ml-0 mb-30" role="tablist">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#atelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="atelement<?php echo e($language->code); ?>">
                                                                                <div class="primary_input mb-25">
                                                                                    <label class="primary_input_label" for="about_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                                    <input name="about_title[<?php echo e($language->code); ?>]" id="about_title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_about_title',$language->code):old('about_title.'.$language->code)); ?>">
                                                                                    <span class="text-danger"  id="error_about_title"></span>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="about_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                        <input name="about_title" id="about_title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('about_title') ? old('about_title') : $FooterContent->footer_about_title); ?>">
                                                                        <span class="text-danger"  id="error_about_title"></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            </div>
                                                            <?php if(permissionCheck('about_content_update')): ?>
                                                                <div class="row mt-40">
                                                                    <div class="col-lg-12 text-center tooltip-wrapper">
                                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper" id="aboutSectionBtn"> <span class="ti-check"></span> <?php echo e(__('common.update')); ?> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 mt-50">
                                            <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="aboutDescriptionForm">
                                                <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                <div class="white-box">
                                                 <div class="row justify-content-center mb-30 mt-40">
                                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                        <div class="col-lg-12">
                                                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#adelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="adelement<?php echo e($language->code); ?>">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label" for="about_description"><?php echo e(__('frontendCms.about_description')); ?> <span class="text-danger">*</span></label>
                                                                            <textarea class="summernote lms_summernote" name="about_description[<?php echo e($language->code); ?>]" id="about_description"><?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_about_description',$language->code):old('about_description.'.$language->code)); ?></textarea>
                                                                            <span class="text-danger"  id="error_about_description"></span>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="about_description"><?php echo e(__('frontendCms.about_description')); ?> <span class="text-danger">*</span></label>
                                                                <textarea class="summernote lms_summernote"
                                                                        name="about_description"
                                                                        id="about_description"><?php echo e($FooterContent->footer_about_description); ?></textarea>
                                                                <span class="text-danger"  id="error_about_description"></span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                    <?php if(permissionCheck('company_content_update')): ?>
                                                        <div class="row mt-30">
                                                            <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                                data-original-title="" title="">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper " id="aboutDescriptionBtn"
                                                                    data-original-title="" title="">
                                                                    <span class="ti-check"></span>
                                                                    <?php echo e(__('common.update')); ?> </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php if(permissionCheck('footerSetting.footer.widget-store')): ?>
                                    <?php echo $__env->make('footersetting::footer.components.widget_create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                                <div role="tabpanel" class="tab-pane <?php echo e($footerTab == 3?'active show':''); ?> fade" id="footer_2">
                                    <div class="row">
                                        <div class="col-lg-3 mt-30">
                                            <div class="col-lg-12">
                                                <div class="main-title">
                                                    <h3 class="mb-30"><?php echo e(__('common.update')); ?> </button> </h3>
                                                </div>
                                                <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="companyForm">
                                                    <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                    <div class="white-box">
                                                        <div class="add-visitor">
                                                            <div class="row">
                                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                    <div class="col-lg-12">
                                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 ml-0" role="tablist">
                                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#maselement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                                </li>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                        <div class="tab-content">
                                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="maselement<?php echo e($language->code); ?>">
                                                                                    <div class="primary_input mb-25">
                                                                                        <label class="primary_input_label" for="company_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                                        <input name="company_title[<?php echo e($language->code); ?>]" id="company_title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_section_one_title',$language->code):old('company_title.'.$language->code)); ?>">
                                                                                        <span class="text-danger"  id="error_company_title"></span>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label" for="company_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                            <input name="company_title" id="company_title" class="primary_input_field" placeholder="-" type="text" value="<?php echo e(old('company_title') ? old('company_title') : $FooterContent->footer_section_one_title); ?>">
                                                                            <span class="text-danger"  id="error_company_title"></span>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if(permissionCheck('company_content_update')): ?>
                                                                <div class="row mt-40">
                                                                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                                        data-original-title="" title="">
                                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper "
                                                                            data-original-title="" title="" id="companyBtn">
                                                                            <span class="ti-check"></span>
                                                                            <?php echo e(__('common.update')); ?> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 mt-50">
                                            <?php if(permissionCheck('footerSetting.footer.widget-store')): ?>
                                                <a href="" data-id="1" id="add_new_page_btn" class="primary-btn small fix-gr-bg create_page_btn"><?php echo e(__('frontendCms.add_new_page')); ?></a>
                                            <?php endif; ?>
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="15%"><?php echo e(__('common.sl')); ?></th>
                                                                <th scope="col" width="45%"><?php echo e(__('common.name')); ?></th>
                                                                <th scope="col" width="15%"><?php echo e(__('common.status')); ?></th>
                                                                <th scope="col" width="25%"><?php echo e(__('common.action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $SectionOnePages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e(getNumberTranslate($key +1)); ?></td>
                                                                    <td><?php echo e($page->name); ?></td>
                                                                    <td>
                                                                        <label class="switch_toggle" for="checkbox<?php echo e($page->id); ?>">
                                                                            <input type="checkbox" id="checkbox<?php echo e($page->id); ?>" <?php echo e($page->status?'checked':''); ?> value="<?php echo e($page->id); ?>" data-value="<?php echo e($page); ?>" class="statusChange">
                                                                            <div class="slider round"></div>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown CRM_dropdown">
                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <?php echo e(__('common.select')); ?>

                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                                <?php if(permissionCheck('footerSetting.footer.widget-update')): ?>
                                                                                    <a class="dropdown-item edit_page" data-value="<?php echo e($page); ?>"><?php echo e(__('common.edit')); ?></a>
                                                                                <?php endif; ?>
                                                                                <?php if(permissionCheck('footer.widget-delete')): ?>
                                                                                    <a class="dropdown-item delete_page" data-id="<?php echo e($page->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo e($footerTab == 4?'active show':''); ?> fade" id="footer_3">
                                    <div class="row">
                                        <div class="col-lg-3 mt-30">
                                            <div class="col-lg-12">
                                                <div class="main-title">
                                                    <h3 class="mb-30">
                                                        <?php echo e(__('common.update')); ?> </h3>
                                                </div>
                                                <form method="POST" action=""
                                                    accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="accountForm">
                                                    <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                    <div class="white-box">
                                                        <div class="add-visitor">
                                                            <div class="row">
                                                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                <div class="col-lg-12">
                                                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 ml-0 mb-30" role="tablist">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#cstelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="cstelement<?php echo e($language->code); ?>">
                                                                                <div class="primary_input mb-25">
                                                                                    <label class="primary_input_label" for="account_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                                    <input name="account_title[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" required value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_section_two_title',$language->code):old('account_title.'.$language->code)); ?>">
                                                                                </div>
                                                                                <span class="text-danger"  id="error_account_title"></span>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="account_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                        <input name="account_title" class="primary_input_field" placeholder="-" type="text" required value="<?php echo e(old('account_title') ? old('account_title') : $FooterContent->footer_section_two_title); ?>">
                                                                    </div>
                                                                    <span class="text-danger"  id="error_account_title"></span>
                                                                </div>
                                                            <?php endif; ?>
                                                            </div>
                                                            <?php if(permissionCheck('account_content_update')): ?>
                                                                <div class="row mt-40">
                                                                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                                        data-original-title="" title="">
                                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper " id="accountBtn">
                                                                            <span class="ti-check"></span>
                                                                            <?php echo e(__('common.update')); ?> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 mt-50">
                                            <?php if(permissionCheck('footerSetting.footer.widget-store')): ?>
                                                <a data-id="2" class="primary-btn small fix-gr-bg create_page_btn"><?php echo e(__('frontendCms.add_new_page')); ?></a>
                                            <?php endif; ?>

                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="15%"><?php echo e(__('common.sl')); ?></th>
                                                                <th scope="col" width="45%"><?php echo e(__('common.name')); ?></th>
                                                                <th scope="col" width="15%"><?php echo e(__('common.status')); ?></th>
                                                                <th scope="col" width="25%"><?php echo e(__('common.action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $SectionTwoPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e(getNumberTranslate($key +1)); ?></td>
                                                                    <td><?php echo e($page->name); ?></td>
                                                                    <td>
                                                                        <label class="switch_toggle" for="checkbox<?php echo e($page->id); ?>">
                                                                            <input type="checkbox" id="checkbox<?php echo e($page->id); ?>" <?php echo e($page->status?'checked':''); ?> value="<?php echo e($page->id); ?>" data-value="<?php echo e($page); ?>" class="statusChange">
                                                                            <div class="slider round"></div>
                                                                        </label>
                                                                    </td>
                                                                    <td>

                                                                        <div class="dropdown CRM_dropdown">
                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <?php echo e(__('common.select')); ?>

                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                                <?php if(permissionCheck('footerSetting.footer.widget-update')): ?>
                                                                                    <a data-toggle="modal" data-target="#editModal" class="dropdown-item edit_page" data-value="<?php echo e($page); ?>"><?php echo e(__('common.edit')); ?></a>
                                                                                <?php endif; ?>
                                                                                <?php if(permissionCheck('footerSetting.footer.widget-delete')): ?>
                                                                                    <a class="dropdown-item delete_page" data-id="<?php echo e($page->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?php echo e($footerTab == 5?'active show':''); ?> fade" id="footer_4">
                                    <div class="row">
                                        <div class="col-lg-3 mt-30">
                                            <div class="col-lg-12">
                                                <div class="main-title">
                                                    <h3 class="mb-30">
                                                        <?php echo e(__('common.update')); ?> </h3>
                                                </div>
                                                <form method="POST" action=""
                                                    accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data"
                                                    id="serviceForm">
                                                    <input type="hidden" name="id" value="<?php echo e($FooterContent->id); ?>">
                                                    <div class="white-box">
                                                        <div class="add-visitor">
                                                            <div class="row">
                                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                    <div class="col-lg-12">
                                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 ml-0 mb-30" role="tablist">
                                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#sstelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                                </li>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                        <div class="tab-content">
                                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="sstelement<?php echo e($language->code); ?>">
                                                                                    <div class="primary_input mb-25">
                                                                                        <label class="primary_input_label" for="service_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                                        <input name="service_title[<?php echo e($language->code); ?>]" class="primary_input_field" placeholder="-" type="text" required value="<?php echo e(isset($FooterContent)?$FooterContent->getTranslation('footer_section_three_title',$language->code):old('service_title.'.$language->code)); ?>">
                                                                                    </div>
                                                                                    <span class="text-danger"  id="error_service_title"></span>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label" for="service_title"><?php echo e(__('frontendCms.section_name')); ?> <span class="text-danger">*</span></label>
                                                                            <input name="service_title" class="primary_input_field" placeholder="-" type="text" required value="<?php echo e(old('service_title') ? old('service_title') : $FooterContent->footer_section_three_title); ?>">
                                                                        </div>
                                                                        <span class="text-danger"  id="error_service_title"></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if(permissionCheck('service_content_update')): ?>
                                                                <div class="row mt-40">
                                                                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                                        data-original-title="" title="">
                                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper " id="serviceBtn">
                                                                            <span class="ti-check"></span>
                                                                            <?php echo e(__('common.update')); ?> </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 mt-50">
                                            <?php if(permissionCheck('footerSetting.footer.widget-store')): ?>
                                                <a href="" data-id="3" class="primary-btn small fix-gr-bg create_page_btn"><?php echo e(__('frontendCms.add_new_page')); ?></a>
                                            <?php endif; ?>
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="15%"><?php echo e(__('common.sl')); ?></th>
                                                                <th scope="col" width="45%"><?php echo e(__('common.name')); ?></th>
                                                                <th scope="col" width="15%"><?php echo e(__('common.status')); ?></th>
                                                                <th scope="col" width="25%"><?php echo e(__('common.action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $SectionThreePages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e(getNumberTranslate($key +1)); ?></td>
                                                                    <td><?php echo e($page->name); ?></td>
                                                                    <td>
                                                                        <label class="switch_toggle" for="checkbox<?php echo e($page->id); ?>">
                                                                            <input type="checkbox" id="checkbox<?php echo e($page->id); ?>" <?php echo e($page->status?'checked':''); ?> value="<?php echo e($page->id); ?>" data-value="<?php echo e($page); ?>" class="statusChange">
                                                                            <div class="slider round"></div>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown CRM_dropdown">
                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <?php echo e(__('common.select')); ?>

                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                                <?php if(permissionCheck('footerSetting.footer.widget-update')): ?>
                                                                                    <a data-toggle="modal" data-target="#editModal" class="dropdown-item edit_page" data-value="<?php echo e($page); ?>"><?php echo e(__('common.edit')); ?></a>
                                                                                <?php endif; ?>
                                                                                <?php if(permissionCheck('footerSetting.footer.widget-delete')): ?>
                                                                                    <a class="dropdown-item delete_page" data-id="<?php echo e($page->id); ?>"><?php echo e(__('common.delete')); ?></a>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
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
        <?php if(permissionCheck('footerSetting.footer.widget-update')): ?>
            <?php echo $__env->make('footersetting::footer.components.widget_edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(permissionCheck('footer.widget-delete')): ?>
            <?php echo $__env->make('footersetting::footer.components.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('footersetting::footer.components.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/FooterSetting/Resources/views/footer/index.blade.php ENDPATH**/ ?>