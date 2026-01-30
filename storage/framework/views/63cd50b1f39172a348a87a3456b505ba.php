<!-- wallet_modal::start  -->
<div class="modal fade theme_modal2" id="Address_edit_modal" tabindex="-1" role="dialog" aria-labelledby="theme_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <form action="#" method="POST" id="address_form_edit">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="address_id" id="address_id" value="<?php echo e($address->id); ?>">
                    <div class="payment_modal_wallet style2">
                        <div class="d-flex align-items-center gap_10 mb_30">
                            <h3 class="font_24 f_w_700  flex-fill mb-0"><?php echo e(__('common.update')); ?> <?php echo e(__('common.address')); ?></h3>
                            <button type="button" class="close_modal_icon" data-bs-dismiss="modal">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                        
                        <label class="primary_label2 style4 mb_15"><?php echo e(__('common.type')); ?></label>
                        <div class="address_type d-flex align-items-center gap_30 flex-wrap mb_30">
                            <label class="primary_checkbox style6 d-flex" >
                                <input type="checkbox" name="shipping_address" <?php echo e($address->is_shipping_default?'checked disabled':''); ?> value="1">
                                <span class="checkmark mr_10"></span>
                                <span class="label_name f_w_500"><?php echo e(__('common.shipping')); ?> <?php echo e(__('common.address')); ?></span>
                            </label>
                            <label class="primary_checkbox style6 d-flex" >
                                <input type="checkbox" name="billing_address" <?php echo e($address->is_billing_default?'checked disabled':''); ?> value="1">
                                <span class="checkmark mr_10"></span>
                                <span class="label_name f_w_500"><?php echo e(__('common.billing_address')); ?></span>
                            </label>
                        </div>
                        <form action="#">
                            <div class="row">
                                <div class="col-12 mb_25">
                                    <label class="primary_label2 style4" for="address_name_edit"><?php echo e(__('common.name')); ?> <span>*</span></label>
                                    <input name="name" id="address_name_edit" placeholder="<?php echo e(__('common.name')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.name')); ?>'" class="primary_input3 radius_3px style5" type="text" value="<?php echo e($address->name); ?>">
                                    <span class="text-danger" id="error_name"></span>
                                </div>
                                <div class="col-6 mb_25">
                                    <label class="primary_label2 style4" for="Email_Address_edit"><?php echo e(__('common.email_address')); ?> <span>*</span></label>
                                    <input name="email" id="Email_Address_edit" placeholder="<?php echo e(__('common.email_address')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.email_address')); ?>'" class="primary_input3 radius_3px style5" type="email" value="<?php echo e($address->email); ?>">
                                    <span class="text-danger" id="error_email"></span>
                                </div>
                                <div class="col-6 mb_25">
                                    <label class="primary_label2 style4" for="customer_phn_edit"><?php echo e(__('common.phone_number')); ?> <span>*</span></label>
                                    <input name="phone" id="customer_phn_edit" placeholder="<?php echo e(__('common.phone_number')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.phone_number')); ?>'" class="primary_input3 radius_3px style5" type="text" value="<?php echo e($address->phone); ?>">
                                    <span class="text-danger" id="error_phone"></span>
                                </div>
                                <div class="col-xl-6 mb_25">
                                    <div class="form-group input_div_mb">
                                        <label class="primary_label2 style4"><?php echo e(__('common.country')); ?> <span>*</span></label>
                                        <select class="theme_select style2 wide" name="country" id="country_edit" autocomplete="off">
                                        <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($address->country == $country->id?'selected':''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="error_country"></span>
                                </div>
                                <div class="col-xl-6 mb_25">
                                    <div class="form-group input_div_mb">
                                        <label class="primary_label2 style4 "><?php echo e(__('common.state')); ?> <span>*</span></label>
                                        <select class="theme_select style2 wide" name="state" id="state_edit" autocomplete="off">
                                            <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                            <?php if($address->getCountry): ?>
                                                <?php $__currentLoopData = $address->getCountry->states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($address->state == $state->id?'selected':''); ?> value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="error_state"></span>
                                </div>
                                <div class="col-xl-6 mb_25">
                                    <div class="form-group input_div_mb">
                                        <label class="primary_label2 style4"><?php echo e(__('common.city')); ?> <span>*</span></label>
                                        <select class="theme_select style2 wide" name="city" id="city_edit" autocomplete="off">
                                           <option value=""><?php echo e(__('defaultTheme.select_from_options')); ?></option>
                                           <?php if($address->getState): ?>
                                               <?php $__currentLoopData = $address->getState->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <option <?php echo e($address->city == $city->id?'selected':''); ?> value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           <?php endif; ?>
                                        </select>
                                     </div>
                                     <span class="text-danger" id="error_city"></span>
                                </div>
                                <div class="col-xl-6 mb_25">
                                    <label class="primary_label2 style4" for="postal_code_edit"><?php echo e(__('common.postal_code')); ?></label>
                                    <input name="postal_code" id="postal_code_edit" placeholder="<?php echo e(__('common.postal_code')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.postal_code')); ?>'" class="primary_input3 radius_3px style5" value="<?php echo e($address->postal_code); ?>" type="text">
                                </div>
                                <div class="col-12 mb_25">
                                    <label class="primary_label2 style4" for="address_edit"><?php echo e(__('common.Street Address')); ?> <span>*</span></label>
                                    <textarea name="address" id="address_edit" placeholder="<?php echo e(__('common.Street Address')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('common.Street Address')); ?>'" class="primary_textarea4 radius_5px mb_25"><?php echo e($address->address); ?></textarea>
                                    <span class="text-danger" id="error_address"></span>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="amaz_primary_btn style2 radius_5px w-100 text-center  text-uppercase  text-center min_200"><?php echo e(__('common.update')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- wallet_modal::end  -->
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/pages/profile/partials/_edit_form.blade.php ENDPATH**/ ?>