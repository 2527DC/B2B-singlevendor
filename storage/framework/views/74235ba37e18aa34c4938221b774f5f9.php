<div class="row">
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?php echo e($loginPageTab == 1?'active show':''); ?> " id="admin">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo e(route('frontendcms.login_page.update')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="login_slug" value="admin-login">

                        <div class="add-visitor">
                            <div class="row">
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                                                <div class="primary_file_uploader">
                                                                    <input name="title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[0])?$getAllLoginPageInfo[0]->getTranslation('title',$language->code):old('title.'.$language->code)); ?>" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                                                <div class="primary_file_uploader">
                                                                    <input name="sub_title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[0])?$getAllLoginPageInfo[0]->getTranslation('sub_title',$language->code):old('sub_title.'.$language->code)); ?>" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                            <div class="primary_file_uploader">
                                                <input name="title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[0]->title)? $getAllLoginPageInfo[0]->title:''); ?>" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                            <div class="primary_file_uploader">
                                                <input name="sub_title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[0]->sub_title)? $getAllLoginPageInfo[0]->sub_title:''); ?>" type="text">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(<?php echo e(getNumberTranslate(730)); ?>x<?php echo e(getNumberTranslate(503)); ?>) <?php echo e(__('common.px')); ?></small></label>
                                        <div class="primary_file_uploader">
                                            <input class="primary-input" type="text" id="placeholderFileOneName1" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo e(__("common.image")); ?> </label>
                                                <input type="file" class="d-none" name="cover_image" id="document_file_1" accept="image/*">
                                            </button>
                                        </div>
                                        <span class="text-danger"  id="file_error"></span>

                                        <div class="img_div mt-20">
                                            <img class="blogImgShow" id="blogImgShow1" src="<?php echo e(showImage( isset($getAllLoginPageInfo[0]->cover_img) ?$getAllLoginPageInfo[0]->cover_img:'backend/img/default.png')); ?>" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <?php if(permissionCheck('frontendcms.login_page')): ?>
                                    <button class="primary-btn semi_large2  fix-gr-bg mr-1" type="submit"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                                <?php else: ?>
                                    <span class="alert alert-warning" role="alert">
                                        <strong>
                                            <?php echo e(__('common.you_don_t_have_this_permission')); ?>

                                        </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade <?php echo e($loginPageTab == 2?'active show':''); ?> " id="customer">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo e(route('frontendcms.login_page.update')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="login_slug" value="login">

                        <div class="add-visitor">
                            <div class="row">
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#celement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="celement<?php echo e($language->code); ?>">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                                                <div class="primary_file_uploader">
                                                                    <input name="title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[1])?$getAllLoginPageInfo[1]->getTranslation('title',$language->code):old('title.'.$language->code)); ?>" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                                                <div class="primary_file_uploader">
                                                                    <input name="sub_title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[1])?$getAllLoginPageInfo[1]->getTranslation('sub_title',$language->code):old('sub_title.'.$language->code)); ?>" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                            <div class="primary_file_uploader">
                                                <input name="title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[1]->title)? $getAllLoginPageInfo[1]->title:''); ?>" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-25">
                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                            <div class="primary_file_uploader">
                                                <input name="sub_title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[1]->sub_title)? $getAllLoginPageInfo[1]->sub_title:''); ?>" type="text">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(<?php echo e(getNumberTranslate(730)); ?>x<?php echo e(getNumberTranslate(503)); ?>) <?php echo e(__('common.px')); ?></small></label>
                                        <div class="primary_file_uploader">
                                            <input class="primary-input" type="text" id="placeholderFileOneName2" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_2"><?php echo e(__("common.image")); ?> </label>
                                                <input type="file" class="d-none" name="cover_image" id="document_file_2" accept="image/*">
                                            </button>
                                        </div>
                                        <span class="text-danger"  id="file_error"></span>

                                        <div class="img_div mt-20">
                                            <img class="blogImgShow" id="blogImgShow2" src="<?php echo e(showImage( isset($getAllLoginPageInfo[1]->cover_img) ? $getAllLoginPageInfo[1]->cover_img:'backend/img/default.png')); ?>" alt="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <?php if(permissionCheck('frontendcms.login_page')): ?>
                                    <button class="primary-btn semi_large2  fix-gr-bg mr-1"
                                            type="submit"><i class="ti-check"></i><?php echo e(__('common.update')); ?>

                                    </button>
                                <?php else: ?>
                                    <span class="alert alert-warning" role="alert">
                                        <strong>
                                            <?php echo e(__('common.you_don_t_have_this_permission')); ?>

                                        </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade <?php echo e($loginPageTab == 3?'active show':''); ?> " id="seller">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo e(route('frontendcms.login_page.update')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="login_slug" value="seller-login">

                        <div class="add-visitor">
                            <div class="row">
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#selement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="selement<?php echo e($language->code); ?>">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                                            <div class="primary_file_uploader">
                                                                <input name="title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[2])?$getAllLoginPageInfo[2]->getTranslation('title',$language->code):old('title.'.$language->code)); ?>" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                                            <div class="primary_file_uploader">
                                                                <input name="sub_title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[2])?$getAllLoginPageInfo[2]->getTranslation('sub_title',$language->code):old('sub_title.'.$language->code)); ?>" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                        <div class="primary_file_uploader">
                                            <input name="title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[2]->title)? $getAllLoginPageInfo[2]->title:''); ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                        <div class="primary_file_uploader">
                                            <input name="sub_title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[2]->sub_title)? $getAllLoginPageInfo[2]->sub_title:''); ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(<?php echo e(getNumberTranslate(730)); ?>x<?php echo e(getNumberTranslate(503)); ?>) <?php echo e(__('common.px')); ?></small></label>
                                        <div class="primary_file_uploader">
                                            <input class="primary-input" type="text" id="placeholderFileOneName3" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_3"><?php echo e(__("common.image")); ?> </label>
                                                <input type="file" class="d-none" name="cover_image" id="document_file_3" accept="image/*">
                                            </button>
                                        </div>
                                        <span class="text-danger"  id="file_error"></span>

                                        <div class="img_div mt-20">
                                            <img class="blogImgShow" id="blogImgShow3" src="<?php echo e(showImage( isset($getAllLoginPageInfo[2]->cover_img) ? $getAllLoginPageInfo[2]->cover_img:'backend/img/default.png')); ?>" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <?php if(permissionCheck('frontendcms.login_page')): ?>
                                    <button class="primary-btn semi_large2  fix-gr-bg mr-1"
                                            type="submit"><i class="ti-check"></i><?php echo e(__('common.update')); ?>

                                    </button>
                                <?php else: ?>
                                    <span class="alert alert-warning" role="alert">
                                        <strong>
                                            <?php echo e(__('common.you_don_t_have_this_permission')); ?>

                                        </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade <?php echo e($loginPageTab == 4?'active show':''); ?> " id="password_reset">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo e(route('frontendcms.login_page.update')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="login_slug" value="password-reset">

                        <div class="add-visitor">
                            <div class="row">
                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#pelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="pelement<?php echo e($language->code); ?>">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                                            <div class="primary_file_uploader">
                                                                <input name="title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[3])?$getAllLoginPageInfo[3]->getTranslation('title',$language->code):old('title.'.$language->code)); ?>" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="primary_input mb-25">
                                                            <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                                            <div class="primary_file_uploader">
                                                                <input name="sub_title[<?php echo e($language->code); ?>]" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[3])?$getAllLoginPageInfo[3]->getTranslation('sub_title',$language->code):old('sub_title.'.$language->code)); ?>" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('frontendCms.title')); ?></label>
                                        <div class="primary_file_uploader">
                                            <input name="title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[3]->title)? $getAllLoginPageInfo[3]->title:''); ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('frontendCms.sub_title')); ?></label>
                                        <div class="primary_file_uploader">
                                            <input name="sub_title" class="primary_input_field" value="<?php echo e(isset($getAllLoginPageInfo[3]->sub_title)? $getAllLoginPageInfo[3]->sub_title:''); ?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="mb-2 mr-30"><?php echo e(__('common.image')); ?><small>(<?php echo e(getNumberTranslate(730)); ?>x<?php echo e(getNumberTranslate(503)); ?>) <?php echo e(__('common.px')); ?></small></label>
                                        <div class="primary_file_uploader">
                                            <input class="primary-input" type="text" id="placeholderFileOneName4" placeholder="<?php echo e(__('common.browse')); ?>" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="document_file_4"><?php echo e(__("common.image")); ?> </label>
                                                <input type="file" class="d-none" name="cover_image" id="document_file_4" accept="image/*">
                                            </button>
                                        </div>
                                        <span class="text-danger"  id="file_error"></span>

                                        <div class="img_div mt-20">
                                            <img class="blogImgShow" id="blogImgShow4" src="<?php echo e(showImage( isset($getAllLoginPageInfo[3]->cover_img) ? $getAllLoginPageInfo[3]->cover_img:'backend/img/default.png')); ?>" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <?php if(permissionCheck('frontendcms.login_page')): ?>
                                    <button class="primary-btn semi_large2  fix-gr-bg mr-1"
                                            type="submit"><i class="ti-check"></i><?php echo e(__('common.update')); ?>

                                    </button>
                                <?php else: ?>
                                    <span class="alert alert-warning" role="alert">
                                        <strong>
                                            <?php echo e(__('common.you_don_t_have_this_permission')); ?>

                                        </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php /**PATH /var/www/DhatriProduction/Modules/FrontendCMS/Resources/views/login-page/components/form.blade.php ENDPATH**/ ?>