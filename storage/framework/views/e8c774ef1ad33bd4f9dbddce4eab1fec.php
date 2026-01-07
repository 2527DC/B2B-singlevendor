<form action="<?php echo e(route('payment_gateway.configuration')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="BANK_NAME">
                <label class="primary_input_label" for=""><?php echo e(__('payment_gatways.bank_name')); ?></label>
                <input name="BANK_NAME" class="primary_input_field" value="<?php echo e($gateway->perameter_1); ?>" placeholder="<?php echo e(__('payment_gatways.bank_name')); ?>" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="BRANCH_NAME">
                <label class="primary_input_label" for=""><?php echo e(__('payment_gatways.branch_name')); ?></label>
                <input name="BRANCH_NAME" class="primary_input_field" value="<?php echo e($gateway->perameter_2); ?>" placeholder="<?php echo e(__('payment_gatways.branch_name')); ?>" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <input type="hidden" name="name" value="Bank Payment Configuration">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="ACCOUNT_NUMBER">
                <label class="primary_input_label" for=""><?php echo e(__('payment_gatways.account_number')); ?></label>
                <input name="ACCOUNT_NUMBER" class="primary_input_field" value="<?php echo e($gateway->perameter_3); ?>" placeholder="<?php echo e(__('payment_gatways.account_number')); ?>" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="ACCOUNT_HOLDER">
                <label class="primary_input_label" for=""><?php echo e(__('payment_gatways.account_holder')); ?></label>
                <input name="ACCOUNT_HOLDER" class="primary_input_field" value="<?php echo e($gateway->perameter_4); ?>" placeholder="<?php echo e(__('payment_gatways.account_holder')); ?>" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo e(@$gateway->id); ?>">
        <input type="hidden" name="method_id" value="<?php echo e(@$gateway->method->id); ?>">
        <?php if(auth()->user()->role->type != 'seller'): ?>
            <div class="col-xl-8">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for=""><?php echo e(__('payment_gatways.gateway_logo')); ?> (<?php echo e(getNumberTranslate(400)); ?> X <?php echo e(getNumberTranslate(166)); ?>)<?php echo e(__('common.px')); ?></label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="bank_image_file" placeholder="<?php echo e(__('payment_gatways.gateway_logo')); ?>" readonly="" />
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="logobank"><?php echo e(__('product.Browse')); ?> </label>
                            <input type="file" class="d-none" name="logo" accept="image/*" id="logobank"/>
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="logo_div">
                    <?php if(@$gateway->method->logo): ?>
                        <img id="BankImgDiv" class="" src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                    <?php else: ?>
                        <img id="BankImgDiv" class="" src="<?php echo e(showImage('backend/img/default.png')); ?>" alt="">
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-lg-12 text-center">
            <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.update")); ?> </button>
        </div>
    </div>
</form>
<?php /**PATH /var/www/html/mytestdhatri/Modules/PaymentGateway/Resources/views/components/bank_config.blade.php ENDPATH**/ ?>