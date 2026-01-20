<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.edit_unit')); ?></h3>
    </div>
</div>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<form action="" method="POST" id="unitEditForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <div class="row">
            <input type="hidden" class="edit_id" value="0">
           
            <?php if(isModuleActive('FrontendMultiLang')): ?>
            <div class="col-lg-12">
                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#euelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="tab-content">
                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="euelement<?php echo e($language->code); ?>">
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.name')); ?> *</label>
                                    <input name="name[<?php echo e($language->code); ?>]" class="primary_input_field name" id="name_<?php echo e($language->code); ?>" placeholder="<?php echo e(__('common.name')); ?>" type="text">
                                    <span class="text-danger" id="edit_name_<?php echo e($language->code); ?>_error"></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.name')); ?> *</label>
                <input name="name" class="primary_input_field name" placeholder="<?php echo e(__('common.name')); ?>" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <?php endif; ?>
            <div class="col-lg-12">
               <div class="primary_input">
                   <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                   <ul id="theme_nav" class="permission_list sms_list ">
                       <li>
                           <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                               <input name="status" id="status_active" value="1" checked="true" class="active"
                                   type="radio">
                               <span class="checkmark"></span>
                           </label>
                           <p><?php echo e(__('common.active')); ?></p>
                       </li>
                       <li>
                           <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                               <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                               <span class="checkmark"></span>
                           </label>
                           <p><?php echo e(__('common.inactive')); ?></p>
                       </li>
                   </ul>
                   <span class="text-danger" id="edit_status_error"></span>
               </div>
           </div>

            <?php if(permissionCheck('product.units.store')): ?>
                <div class="col-lg-12 text-center">
                    <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.update")); ?> </button>
                </div>
            <?php else: ?>
                <div class="col-lg-12 mt-5 text-center">
                    <span class="alert alert-warning" role="alert">
                        <strong><?php echo e(__('common.you_don_t_have_this_permission')); ?></strong>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/units/edit.blade.php ENDPATH**/ ?>