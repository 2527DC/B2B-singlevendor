<div class="row mt-20">
    <div class="col-lg-12">
        <div class="white-box">
            <div class="add-visitor">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'affiliate.add_or_update_paypal_account',
                       'method' => 'POST'])); ?>

                <div class="row">
                    <h3 class="mb-30">
                        <?php if(isset($paypal_account)): ?>
                            <?php echo e(__('affiliate.Update Paypal Account For Withdraw Commissions From System')); ?>

                        <?php else: ?>
                            <?php echo e(__('affiliate.Add Paypal Account For Withdraw Commissions From System')); ?>

                        <?php endif; ?>
                    </h3>

                    <div class="col-lg-12">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="paypal_account"> <?php echo e(__('affiliate.Paypal Account')); ?> <span class="required_mark_theme">*</span> </label>
                            <input  class="primary_input_field" name="paypal_account" id="paypal_account" placeholder="<?php echo e(__('affiliate.Paypal Account')); ?>" type="text" value="<?php echo e(isset($paypal_account) ? $paypal_account :''); ?>">
                            <span class="text-danger"><?php echo e($errors->first('paypal_account')); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-12 text-center mtr-10">
                        <button class="primary-btn btn-sm fix-gr-bg submit">
                            <?php if(isset($paypal_account)): ?>
                                <?php echo e(__('affiliate.Update')); ?>

                            <?php else: ?>
                                <?php echo e(__('affiliate.Add')); ?>

                            <?php endif; ?>
                        </button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Affiliate/Resources/views/affiliate/components/_paypal_account.blade.php ENDPATH**/ ?>