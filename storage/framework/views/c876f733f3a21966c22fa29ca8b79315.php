<div class="modal fade admin-query" id="create_unit_modal">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('product.create_unit')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <?php if(isModuleActive('FrontendMultiLang')): ?>
            <?php
            $LanguageList = getLanguageList();
            ?>
            <?php endif; ?>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="create_unit_form">
                    <div class="row">
                        <input type="hidden" name="form_type" value="modal_form">
                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#uelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content">
                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="uelement<?php echo e($language->code); ?>">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" name="name[<?php echo e($language->code); ?>]" id="name" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>">
                                                <span class="text-danger" id="error_unit_name"></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                                <input class="primary_input_field" name="name" id="name" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>">
                                <span class="text-danger" id="error_unit_name"></span>
                            </div>
                        </div>
                    <?php endif; ?>
                        <div class="col-lg-12">
                           <div class="primary_input">
                               <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                               <ul id="theme_nav" class="permission_list sms_list ">
                                   <li>
                                       <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                           <input name="status" value="1" id="unit_active_status" checked class="active"
                                               type="radio">
                                           <span class="checkmark"></span>
                                       </label>
                                       <p><?php echo e(__('common.active')); ?></p>
                                   </li>
                                   <li>
                                       <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                           <input name="status" value="0" class="de_active" id="unit_inactive_status" type="radio">
                                           <span class="checkmark"></span>
                                       </label>
                                       <p><?php echo e(__('common.inactive')); ?></p>
                                   </li>
                               </ul>
                               <span class="text-danger" id="error_unit_status"></span>
                           </div>
                       </div>
                        <div class="col-lg-12 text-center">
                            <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_create_unit_modal.blade.php ENDPATH**/ ?>