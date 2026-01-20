<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('shipping.edit_shipping_rate')); ?></h3>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" id="methodEditForm">
    <?php echo csrf_field(); ?>
    <div class="white_box p-15 box_shadow_white mb-20">
        <div class="row">
            <input type="hidden" name="id" class="edit_id" value="<?php echo e($shipping_method->id); ?>">
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
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="method_name_<?php echo e($language->code); ?>"> <?php echo e(__("shipping.method_name")); ?> <span class="text-danger">*</span></label>
                                        <input class="primary_input_field method_name" name="method_name[<?php echo e($language->code); ?>]" id="method_name_<?php echo e($language->code); ?>" placeholder="<?php echo e(__("shipping.method_name")); ?>" type="text" value="<?php echo e(isset($shipping_method)?$shipping_method->getTranslation('method_name',$language->code):old('method_name.'.$language->code)); ?>" <?php echo e($shipping_method->id == 1?'readonly':''); ?>>
                                        <span class="text-danger" id="error_method_name_<?php echo e($language->code); ?>"></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="primary_input mb-15">
                        <label class="primary_input_label" for=""> <?php echo e(__("shipping.method_name")); ?> <span class="text-danger">*</span></label>
                        <input class="primary_input_field method_name" name="method_name" id="method_name" placeholder="<?php echo e(__("shipping.method_name")); ?>" type="text" value="<?php echo e($shipping_method->method_name); ?>" <?php echo e($shipping_method->id == 1?'readonly':''); ?>>
                        <span class="text-danger" id="error_method_name"></span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="carrier_id"><?php echo e(__('shipping.carrier')); ?></label>
                    <select class="primary_select mb-15" id="carrier_id" name="carrier_id">
                        <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carrier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($shipping_method->carrier_id == $carrier->id ? 'selected' :''); ?> value="<?php echo e($carrier->id); ?>"><?php echo e($carrier->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span class="text-danger" id="error_carrier_id"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> <?php echo e(__("shipping.shipment_time")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field shipment_time" name="shipment_time" id="shipment_time" placeholder="<?php echo e(__("shipping.ex: 3-5 days or 6-12 hrs")); ?>" type="text" value="<?php echo e($shipping_method->shipment_time); ?>">
                    <span class="text-danger" id="error_shipment_time"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <label class="primary_input_label" for=""><?php echo e(__('shipping.cost')); ?> <?php echo e(__('shipping.based_on')); ?> <span class="text-danger">*</span></label>
                <ul class="permission_list sms_list">
                    <li>
                        <label class="primary_checkbox d-flex mr-12 ">
                            <input <?php echo e($shipping_method->cost_based_on == 'Price' ? 'checked' :''); ?> name="cost_based_on" class="cost_based_on" type="radio" id="cost_based_on" value="Price">
                            <span class="checkmark"></span>
                        </label>
                        <p><?php echo e(__('shipping.price')); ?></p>
                    </li>
                    <li>
                        <label class="primary_checkbox d-flex mr-12 ">
                            <input <?php echo e($shipping_method->cost_based_on == 'Weight' ? 'checked' :''); ?> name="cost_based_on" class="cost_based_on" type="radio" id="cost_based_on" value="Weight">
                            <span class="checkmark"></span>
                        </label>
                        <p><?php echo e(__('shipping.weight')); ?></p>
                    </li>
                    <li>
                        <label class="primary_checkbox d-flex mr-12 ">
                            <input <?php echo e($shipping_method->cost_based_on == 'Flat' ? 'checked' :''); ?> name="cost_based_on" class="cost_based_on" type="radio" id="cost_based_on" value="Flat">
                            <span class="checkmark"></span>
                        </label>
                        <p><?php echo e(__('shipping.flat')); ?></p>
                    </li>
                </ul>
                <span class="text-danger" id="error_cost_based_on"></span>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> <?php echo e(__("shipping.minimum_shopping_amount")); ?> <?php if(!isModuleActive('MultiVendor')): ?> (<?php echo e(__('shipping.without_shipping_cost')); ?>) <?php endif; ?></label>
                    <input class="primary_input_field" name="minimum_shopping" id="minimum_shopping" placeholder="<?php echo e(__("shipping.minimum_shopping_amount")); ?>" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e($shipping_method->minimum_shopping); ?>">
                    <span class="text-danger" id="error_minimum_shopping"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> <?php echo e(__("shipping.cost")); ?>  <span class="cost_help_label required_mark_theme"></span> <span class="text-danger">*</span></label>
                    <input class="primary_input_field cost" name="cost" id="cost" placeholder="<?php echo e(__("shipping.cost")); ?>" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e($shipping_method->cost); ?>">
                    <span class="text-danger" id="error_cost"></span>
                </div>
            </div>

            <div class="col-lg-12 text-center">
                <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.update")); ?> </button>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/shipping_methods/components/_edit.blade.php ENDPATH**/ ?>