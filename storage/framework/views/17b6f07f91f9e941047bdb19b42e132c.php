<div class="modal fade admin-query" id="add_page_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('page-builder.Create Page')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="create_form" method="post" action="<?php echo e(route('page_builder.pages.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">


                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                        <?php
                            $LanguageList = getLanguageList();
                        ?>
                    <?php endif; ?>
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
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="coupon_title"> <?php echo e(__('page-builder.Title')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field page_title" <?php if($key == 0): ?> oninput="convertToSlug(this.value,'#add_slug')" <?php endif; ?> type="text" id="title_title_<?php echo e($language->code); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(old('title.'.$language->code)); ?>" placeholder="<?php echo e(__('page-builder.Title')); ?>">
                                                <span class="text-danger" id="error_title_<?php echo e($language->code); ?>"></span>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="col-lg-12">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="title"> <?php echo e(__('page-builder.Title')); ?> <span class="required_mark_theme">*</span></label>
                            <input class="primary_input_field page_title" id="title" name="title" oninput="convertToSlug(this.value,'#add_slug')" placeholder="<?php echo e(__('page-builder.Title')); ?>" type="text" value="">
                            <span class="text-danger" id="error_title"></span>
                        </div>
                    </div>
                    <?php endif; ?>

                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="add_slug"> <?php echo e(__('page-builder.Slug')); ?> <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field page_slug" id="add_slug" name="slug" placeholder="<?php echo e(__('page-builder.Slug')); ?>" type="text" value="<?php echo e(old('slug')); ?>">
                                <span class="text-danger" id="error_slug"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-check"></i><?php echo e(__('common.submit')); ?></button>
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><i class="ti-check"></i><?php echo e(__('common.cancel')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /var/www/html/mytestdhatri/Modules/AoraPageBuilder/Resources/views/pages/create.blade.php ENDPATH**/ ?>