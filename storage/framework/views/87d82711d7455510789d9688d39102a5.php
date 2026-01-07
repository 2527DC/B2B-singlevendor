
<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_24 f_w_700 mb_20"><?php echo e(__('wallet.my_wallet')); ?></h4>
                    </div>

                    <div class="dashboard_wallet_boxes mb_40">
                        <div class="singl_dashboard_wallet green_box d-flex align-items-center justify-content-center flex-column">
                            <h4 class="font_16 f_w_400 lh-1"><?php echo e(__('wallet.running_balance')); ?></h4>
                            <h3 class="f_w_700 m-0 lh-1"><?php echo e(auth()->check()?single_price(auth()->user()->CustomerCurrentWalletAmounts):single_price(0.00)); ?></h3>
                        </div>
                        <div class="singl_dashboard_wallet pink_box d-flex align-items-center justify-content-center flex-column">
                            <h4 class="font_16 f_w_400 lh-1"><?php echo e(__('wallet.pending_balance')); ?></h4>
                            <h3 class="f_w_700 m-0 lh-1"><?php echo e(auth()->check()?single_price(auth()->user()->CustomerCurrentWalletPendingAmounts):single_price(0.00)); ?></h3>
                        </div>
                        <div  data-bs-toggle="modal" data-bs-target="#recharge_wallet" class="singl_dashboard_wallet bordered d-flex align-items-center justify-content-center flex-column gj-cursor-pointer ">
                            <h4 class="font_16 f_w_400 lh-1 mb_10 mute_text"><?php echo e(__('wallet.recharge_wallet')); ?></h4>
                                <svg  width="25" height="25" viewBox="0 0 25 25">
                                <path id="plus_1_" data-name="plus (1)" d="M12.5,0A12.5,12.5,0,1,0,25,12.5,12.514,12.514,0,0,0,12.5,0Zm0,23.437A10.937,10.937,0,1,1,23.438,12.5,10.95,10.95,0,0,1,12.5,23.438ZM19.435,12.5a.781.781,0,0,1-.781.781H13.282v5.371a.781.781,0,0,1-1.563,0V13.282H6.349a.781.781,0,1,1,0-1.563H11.72V6.349a.781.781,0,1,1,1.563,0V11.72h5.371A.781.781,0,0,1,19.435,12.5Z" transform="translate(-0.001 -0.001)" fill="#687083"/>
                            </svg>
                        </div>
                    </div>

                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_20 f_w_700 mb_20"><?php echo e(__('wallet.wallet_recharge_history')); ?></h4>
                    </div>
                    <div class="dashboard_white_box_body">
                        <div class="table_border_whiteBox mb_30">
                            <div class="table-responsive">
                                <table class="table amazy_table style3 mb-0">
                                    <thead>
                                        <tr>
                                        <th class="font_14 f_w_700 priamry_text" scope="col"><?php echo e(__('common.date')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.txn_id')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.amount')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.type')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.payment_method')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text" scope="col"><?php echo e(__('common.status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text"><?php echo e(dateConvert($transaction->created_at)); ?></span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">
                                                        <?php if($transaction->txn_id): ?>
                                                            <?php if($transaction->txn_id = "None"): ?>
                                                                <?php echo e(__("common.none")); ?>

                                                            <?php elseif($transaction->txn_id == "Added By Admin"): ?>
                                                                <?php echo e(__("wallet.added_by_admin")); ?>

                                                            <?php else: ?>
                                                            <?php echo e($transaction->txn_id); ?>

                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text"><?php echo e(single_price($transaction->amount)); ?></span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text">
                                                        <?php
                                                        switch ($transaction->type) {
                                                            case 'Deposite':
                                                            echo __("wallet.deposite");
                                                            break;
                                                            case 'Cart Payment':
                                                            echo __("wallet.cart_payment");
                                                            break;
                                                            case 'Refund Back':
                                                            echo __("wallet.refund_back");
                                                            break;
                                                            case 'Refund':
                                                            echo __("wallet.refund");
                                                            break;
                                                            case 'Withdraw':
                                                            echo __("wallet.withdraw");
                                                            break;
                                                            case 'point':
                                                            echo __("clubpoint.point");
                                                            break;
                                                            default:
                                                            echo $transaction->type;
                                                            break;
                                                        }
                                                        ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="font_14 f_w_500 mute_text"><?php echo e($transaction->GatewayName); ?></span>
                                                </td>
                                                <td>
                                                    <?php if($transaction->status == 1): ?>
                                                        <a class="table_badge_btn style4 text-nowrap"><?php echo e(__('common.approved')); ?></a>
                                                    <?php else: ?>
                                                        <a class="table_badge_btn style3 text-nowrap"><?php echo e(__('common.pending')); ?></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php if(count($transactions) < 1): ?>
                                    <p class="empty_p"><?php echo e(__('common.empty_list')); ?>.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if($transactions->lastPage() > 1): ?>
                            <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $transactions,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PaginationComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $attributes = $__attributesOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__attributesOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $component = $__componentOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__componentOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('submit', '#recharge_form', function(event){
                    $('#error_amount').text('');

                    let amount = $('#recharge_amount').val();
                    let val_check = 0;
                    if(amount == '' || amount < 1){
                        $('#error_amount').text('<?php echo e(__("validation.the_amount_field_is_required")); ?>');
                        val_check = 1;
                    }

                    if(val_check == 1){
                        event.preventDefault();
                    }
                });

                $(document).on('submit', '#redeem_form', function(event){
                    $('#error_secret_code').text('');

                    let secret_code = $('#secret_code').val();
                    let val_check = 0;
                    if(secret_code == ''){
                        $('#error_secret_code').text('<?php echo e(__("validation.the_secret_code_field_is_required")); ?>');
                        val_check = 1;
                    }

                    if(val_check == 1){
                        event.preventDefault();
                    }
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/wallets/my_wallet_index.blade.php ENDPATH**/ ?>