<form action="#" method="POST" id="address_form">
<?php echo csrf_field(); ?>
 <div class="form-row">
    <div class="col-md-6">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="address_name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
            <input type="text" class="primary_input_field" id="address_name" placeholder="<?php echo e(__('common.name')); ?>" name="name" value="<?php echo e(isset($primary_address->name)?$primary_address->name:''); ?>" autocomplete="off" >
            <span class="text-danger" id="error_name"></span>
        </div>
     </div>
     <div class="col-md-6">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="Email_Address1"><?php echo e(__('common.email_address')); ?> <span class="text-danger">*</span></label>
            <input type="email" class="primary_input_field" id="Email_Address1" placeholder="<?php echo e(__('common.email_address')); ?>" name="email" value="<?php echo e(isset($primary_address->email)?$primary_address->email:''); ?>">
            <span class="text-danger" id="error_email"></span>
        </div>
     </div>
     <div class="col-md-6">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="customer_phn"><?php echo e(__('common.phone_number')); ?> <span class="text-danger">*</span></label>
            <input type="text" class="primary_input_field" id="customer_phn" placeholder="<?php echo e(__('common.phone_number')); ?>" name="phone" value="<?php echo e(isset($primary_address->phone)?$primary_address->phone:''); ?>">
            <span class="text-danger" id="error_phone"></span>
        </div>
         
     </div>
     <div class="col-md-6">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="Address"><?php echo e(__('common.address')); ?> <span class="text-danger">*</span></label>
            <input type="text" class="primary_input_field" id="Address" placeholder="<?php echo e(__('common.address')); ?>" name="address" value="<?php echo e(isset($primary_address->address_one)?$primary_address->address:''); ?>" autocomplete="off">
            <span class="text-danger" id="error_address"></span>
        </div>
     </div>

     <div class="col-md-3">
        <div class="primary_input mb-25">
            <label class="primary_input_label"><?php echo e(__('common.country')); ?> <span class="text-danger">*</span></label>
            <select class="form-control primary_select" name="country" id="country" autocomplete="off">
            <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php if(app('general_setting')->default_country == $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span class="text-danger" id="error_country"></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="primary_input mb-25">
            <label class="primary_input_label"><?php echo e(__('common.state')); ?> <span class="text-danger">*</span></label>
            <select class="form-control primary_select" name="state" id="state" autocomplete="off">
                <option value=""><?php echo e(__('common.select_from_options')); ?></option>
                <?php if(app('general_setting')->default_country != null): ?>
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($state->id); ?>" <?php if(app('general_setting')->default_state == $state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
            <span class="text-danger" id="error_state"></span>
        </div>
    </div>
     <div class="col-md-3">
        <div class="primary_input mb-25">
            <label class="primary_input_label"><?php echo e(__('common.city')); ?> <span class="text-danger">*</span></label>
            <select class="form-control primary_select" name="city" id="city" autocomplete="off">
                <option value=""><?php echo e(__('common.select_from_options')); ?></option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span class="text-danger" id="error_city"></span>
        </div>
     </div>


     <div class="col-md-3">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="postal_code"><?php echo e(__('common.postal_code')); ?> <span class="text-danger">*</span></label>
            <input type="text" class="primary_input_field" id="postal_code" placeholder="<?php echo e(__('common.postal_code')); ?>" name="postal_code" value="<?php echo e(isset($primary_address->postal_code)?$primary_address->postal_code:''); ?>" autocomplete="off" aria-autocomplete="none">
            <span class="text-danger" id="error_postcode"></span>
        </div>
     </div>
     <div class="form_btn col-md-12 text-center">
         <button class="primary-btn semi_large2 fix-gr-bg float-none" type="submit"><?php echo e(__('common.save')); ?></button>
     </div>
 </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/pages/customer_data/_address_form.blade.php ENDPATH**/ ?>