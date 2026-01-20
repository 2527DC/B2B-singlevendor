<div class="modal fade admin-query" id="CreateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('frontendCms.add_link')); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
            </div>
            <form method="POST" action="<?php echo e(route('footerSetting.footer.widget-store')); ?>" id="widget_create_form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="section_id" id="section_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#macelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="tab-content">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="macelement<?php echo e($language->code); ?>">
                                            <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="name"><?php echo e(__('frontendCms.page_name')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field name" id="name" type="text" name="name[<?php echo e($language->code); ?>]" autocomplete="off" value="">
                                            </div>
                                            <?php $__errorArgs = ['name.'.auth()->user()->lang_code];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-md-12">
                                <div class="primary_input mb-25">
                                <label class="primary_input_label" for="name"><?php echo e(__('frontendCms.page_name')); ?> <span class="text-danger">*</span></label>
                                    <input class="primary_input_field name" id="name" type="text" name="name" autocomplete="off" value="">
                                </div>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <?php echo e(__('common.list')); ?> <span class="text-danger">*</span></label>
                                <select name="page" id="page" class="primary_select mb-15">
                                    <option value="" selected disabled><?php echo e(__('common.select_one')); ?></option>
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <?php $__currentLoopData = $dynamicPageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $dynamicPageList->where('id', '!=', 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
            
                                </select>
                                <?php $__errorArgs = ['page'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-40 text-center">
                            <button type="button" class="primary-btn tr-bg mr-10 modal_cancel_btn" data-dismiss="modal"><?php echo e(__('common.cancel')); ?></button>
                                <button type="submit" id="widget_create_btn" class="primary-btn fix-gr-bg tooltip-wrapper" data-original-title="" title=""><span class="ti-check"></span> <?php echo e(__('common.save')); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/FooterSetting/Resources/views/footer/components/widget_create.blade.php ENDPATH**/ ?>