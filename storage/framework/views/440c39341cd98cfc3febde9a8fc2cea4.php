<div class="col-lg-12">
    <section class="send_query bg-white contact_form">
        <form name="bank_payment" id="contactForm" enctype="multipart/form-data" action="<?php echo e(route('frontend.order_payment')); ?>" class="p-0" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="method" value="BankPayment">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <label for="name" class="primary_label2 style3"><?php echo e(__('payment_gatways.bank_name')); ?> <span>*</span></label>
                    <input type="text" required class="primary_input3 style4 radius_3px mb_20" placeholder="<?php echo e(__('payment_gatways.bank_name')); ?>" name="bank_name" value="<?php echo e(@old('bank_name')); ?>">
                    <span class="invalid-feedback" role="alert" id="bank_name"></span>
                </div>
                <div class="col-xl-6 col-md-6">
                    <label for="name" class="primary_label2 style3"><?php echo e(__('payment_gatways.branch_name')); ?> <span>*</span></label>
                    <input type="text" required name="branch_name" class="primary_input3 style4 radius_3px mb_20" placeholder="<?php echo e(__('payment_gatways.branch_name')); ?>" value="<?php echo e(@old('branch_name')); ?>">
                    <span class="invalid-feedback" role="alert" id="owner_name"></span>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-xl-6 col-md-6">
                    <label for="name" class="primary_label2 style3"><?php echo e(__('payment_gatways.account_number')); ?> <span>*</span></label>
                    <input type="text" required class="primary_input3 style4 radius_3px mb_20" placeholder="<?php echo e(__('payment_gatways.account_number')); ?>" name="account_number" value="<?php echo e(@old('account_number')); ?>">
                    <span class="invalid-feedback" role="alert" id="account_number"></span>
                </div>
                <div
                    class="col-xl-6 col-md-6">
                    <label for="name" class="primary_label2 style3"><?php echo e(__('payment_gatways.account_holder')); ?> <span>*</span></label>
                    <input type="text" required name="account_holder" class="primary_input3 style4 radius_3px mb_20" placeholder="<?php echo e(__('payment_gatways.account_holder')); ?>" value="<?php echo e(@old('account_holder')); ?>">
                    <span class="invalid-feedback" role="alert" id="account_holder"></span>
                </div>
                <input type="hidden" name="bank_amount" value="<?php echo e($total_amount - $coupon_am); ?>">

            </div>
            <div class="row  mb-20">

                <div
                    class="col-xl-12 col-md-12">
                    <label for="name" class="primary_label2 style3"><?php echo e(__('payment_gatways.cheque_slip')); ?> <span>*</span></label>
                    <input type="file" required name="image" class="primary_input3 style4 radius_3px pd_12">
                    <span class="invalid-feedback" role="alert" id="amount_validation"></span>
                </div>
            </div>
            <div class="row">
                <?php
                    $gateway = DB::table('payment_methods')->where('slug','bank-payment')->first();
                    if($gateway){
                        $credential = DB::table('seller_wise_payment_gateways')->where('payment_method_id',$gateway->id)->first();
                    }
                ?>
                <div class="col-md-12">
                    <table class="table table-bordered">

                        <tr>
                            <td><?php echo e(__('payment_gatways.bank_name')); ?></td>
                            <td><?php echo e(!empty($gateway) && !empty($credential) ? $credential->perameter_1:''); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('payment_gatways.branch_name')); ?></td>
                            <td><?php echo e(!empty($gateway) && !empty($credential) ? $credential->perameter_2:''); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(__('payment_gatways.account_number')); ?></td>
                            <td><?php echo e(!empty($gateway) && !empty($credential) ? $credential->perameter_3:''); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(__('payment_gatways.account_holder')); ?></td>
                            <td><?php echo e(!empty($gateway) && !empty($credential) ? $credential->perameter_4:''); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="send_query_btn d-flex justify-content-between">
                <button class="btn_1 d-none" id="bank_btn" type="submit"><?php echo e(__('common.payment')); ?></button>
            </div>
        </form>
    </section>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/payments/bank_payment.blade.php ENDPATH**/ ?>