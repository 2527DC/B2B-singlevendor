<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="modal fade admin-query" id="add_carrier_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('shipping.add_new_carrier')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="create_form" enctype="multipart/form-data">
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
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="name_<?php echo e($language->code); ?>"> <?php echo e(__('common.name')); ?> <span class="required_mark_theme">*</span></label>
                                                    <input class="primary_input_field" id="name_<?php echo e($language->code); ?>" name="name[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__('common.name')); ?>" type="text" value="<?php echo e(old('name.'.$language->code)); ?>">
                                                    <span class="text-danger" id="error_name_<?php echo e($language->code); ?>"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="name"> <?php echo e(__('common.name')); ?> <span class="required_mark_theme">*</span></label>
                                    <input class="primary_input_field" id="name" name="name" placeholder="<?php echo e(__('common.name')); ?>" type="text" value="<?php echo e(old('name')); ?>">
                                    <span class="text-danger" id="error_name"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="tracking_url"> <?php echo e(__('shipping.tracking_url')); ?> <a href="#" class="required_mark_theme" data-toggle="tooltip" title="'@' will be replaced by the dynamic tracking number"><i class="fas fa-question-circle"></i></a></label>
                                <input class="primary_input_field" id="tracking_url" name="tracking_url" placeholder="<?php echo e(__('shipping.tracking_url')); ?>" type="text" value="<?php echo e(old('tracking_url')); ?>">
                                <span class="required_mark_theme">e.g.: http://example.com/track.php?num=@</span>
                                <span class="text-danger" id="error_tracking_url"></span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for=""><?php echo e(__('common.logo')); ?></label>
                                <div class="primary_file_uploader">
                                    <input class="primary-input" type="text" id="logo_name"
                                           placeholder="<?php echo e(__('common.browse_image')); ?>" readonly="">
                                    <button class="" type="button">
                                        <label class="primary-btn small fix-gr-bg"
                                               for="logo"><?php echo e(__('common.browse')); ?> </label>
                                        <input type="file" class="d-none" name="logo" id="logo">
                                    </button>
                                </div>
                            </div>
                            <span class="text-danger" id="error_logo"></span>
                        </div>
                        <div class="col-lg-4 mt-25">
                            <div class="flag_img_div">
                                <img id="logo_preview" src="<?php echo e(showImage('flags/no_image.png')); ?>" alt="">
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
<?php /**PATH /var/www/html/mytestdhatri/Modules/Shipping/Resources/views/carriers/create.blade.php ENDPATH**/ ?>