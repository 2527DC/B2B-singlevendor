<!-- wallet_modal::start  -->
<div class="modal fade theme_modal2" id="recharge_wallet" tabindex="-1" role="dialog" aria-labelledby="theme_modal" aria-hidden="true">
    <div class="modal-dialog max_width_700 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <form action="<?php echo e(route('my-wallet.recharge_create')); ?>" method="post" class="send_query_form" id="recharge_form">
                    <?php echo csrf_field(); ?>
                    <div class="payment_modal_wallet">
                        <h3 class="font_24 f_w_700 mb_18"><?php echo e(__('amazy.Recharge Amount')); ?></h3>
                        <input type="number" min="1" step="<?php echo e(step_decimal()); ?>" value="1" id="recharge_amount" name="recharge_amount" placeholder="<?php echo e(__('wallet.enter_recharge_amount')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('wallet.enter_recharge_amount')); ?>'" class="primary_input3 rounded-0 style2  mb_15">
                        <?php $__errorArgs = ['recharge_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="d-flex justify-content-end gap_30 align-items-center">
                            <h5 class="font_14 f_w_700 text-uppercase gj-cursor-pointer m-0" data-bs-dismiss="modal"><?php echo e(__('common.cancel')); ?></h5>
                            <button class="amaz_primary_btn style2 text-nowrap"><?php echo e(__('defaultTheme.add_fund')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- wallet_modal::end  --><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/wallets/components/_recharge_modal.blade.php ENDPATH**/ ?>