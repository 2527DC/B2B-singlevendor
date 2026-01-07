<div class="modal fade admin-query" id="withdraw_request_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('affiliate.Create Withdraw Request')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <?php if(!isset($paypal_account)): ?>
                   <div class="row">
                       <div class="col">
                           <div class="alert alert-info">
                               <strong>Info!</strong> <?php echo e(__('affiliate.Withdraw Commissions By Paypal Add Account')); ?>.
                           </div>
                       </div>
                   </div>
                <?php endif; ?>
                <form id="create_withdraw_request">
                    <div class="row">
                        <input type="hidden" value="<?php echo e($user->id); ?>" name="user_id">
                        <div class="col-lg-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="withdraw_amount"><?php echo e(__('affiliate.Withdraw Amount')); ?> <span class="required_mark_theme">*</span> <span id="withdraw_amount_msg" class="text-danger"></span></label>
                                <input step="0.01" autocomplete="off" name="withdraw_amount" id="withdraw_amount" value="<?php echo e(old('withdraw_amount')); ?>" class="primary_input_field" placeholder="<?php echo e(__('affiliate.Withdraw Amount')); ?>" type="number">
                                <span class="text-danger" id="error_withdraw_amount"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="payment_type"><?php echo e(__('affiliate.Payment Type')); ?> <span class="required_mark_theme">*</span></label>
                                <select  class="primary_select mb-15" id="payment_type" name="payment_type">
                                    <option disabled selected value=""><?php echo e(__('affiliate.Select One')); ?></option>
                                    <option value="1"><?php echo e(__('affiliate.Offline')); ?></option>
                                    <?php if(isset($paypal_account)): ?>
                                        <option value="2"><?php echo e(__('affiliate.Paypal')); ?></option>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger" id="error_payment_type"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <button id="withdraw_submit_btn" class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-check"></i><?php echo e(__('affiliate.Submit')); ?></button>
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><i class="ti-check"></i><?php echo e(__('affiliate.Cancel')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/affiliate/components/_withdraw_request_modal.blade.php ENDPATH**/ ?>