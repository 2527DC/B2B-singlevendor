<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('shipping.add_new_pickup_location')); ?></h3>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" id="createForm">
    <?php echo csrf_field(); ?>
    <div class="white_box p-15 box_shadow_white mb-20">
        <div class="row">

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="pickup_location"> <?php echo e(__("shipping.pickup_location")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="pickup_location" id="pickup_location" placeholder="<?php echo e(__("shipping.pickup_location")); ?>" type="text" value="<?php echo e(old('pickup_location')); ?>">
                    <span class="text-danger" id="error_pickup_location"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="name"> <?php echo e(__("common.name")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="name" id="name" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>">
                    <span class="text-danger" id="error_name"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="email"> <?php echo e(__("common.email")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="email" id="email" placeholder="<?php echo e(__("common.email")); ?>" type="text" value="<?php echo e(old('email')); ?>">
                    <span class="text-danger" id="error_email"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="phone"> <?php echo e(__("common.phone")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="phone" id="phone" placeholder="<?php echo e(__("common.phone")); ?>" type="text" value="<?php echo e(old('phone')); ?>">
                    <span class="text-danger" id="error_phone"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="address"> <?php echo e(__("common.address")); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="address" id="address" placeholder="<?php echo e(__("common.address")); ?>" type="text" value="<?php echo e(old('address')); ?>">
                    <span class="text-danger" id="error_address"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="address_2"> <?php echo e(__("shipping.address_2")); ?> </label>
                    <input class="primary_input_field" name="address_2" id="address_2" placeholder="<?php echo e(__("shipping.address_2")); ?>" type="text" value="<?php echo e(old('address_2')); ?>">
                    <span class="text-danger" id="error_address_2"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="pin_code"> <?php echo e(__("shipping.pin_code")); ?>/<?php echo e(__('shipping.post_code')); ?> <span class="text-danger">*</span></label>
                    <input class="primary_input_field" name="pin_code" id="pin_code" placeholder="<?php echo e(__("shipping.pin_code")); ?>/<?php echo e(__('shipping.post_code')); ?>" type="text" value="<?php echo e(old('pin_code')); ?>">
                    <span class="text-danger" id="error_pin_code"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="business_country"><?php echo e(__('seller.country_region')); ?> <span class="text-danger">*</span></label>
                    <select name="country_id" id="business_country" class="primary_select mb-25">
                        <option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($setting->country_id == $country->id?'selected':''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span class="text-danger" id="error_country_id"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="business_state"><?php echo e(__('common.state')); ?> <span class="text-danger">*</span></label>
                    <select name="state_id" id="business_state" class="primary_select mb-25">
                        <option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>
                        <?php if($setting->country_id): ?>
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($setting->state_id== $state->id?'selected':''); ?> value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger" id="error_state_id"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for="business_city"><?php echo e(__('common.city')); ?> <span class="text-danger">*</span></label>
                    <select name="city_id" id="business_city" class="primary_select mb-25">
                        <option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>
                        <?php if($setting->state_id): ?>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($setting->city_id == $city->id?'selected':''); ?> value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger" id="error_city_id"></span>
                </div>
            </div>


















            <div class="col-lg-12 text-center">
                <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/pickup_locations/components/_create.blade.php ENDPATH**/ ?>