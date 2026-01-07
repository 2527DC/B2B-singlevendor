<div class="col-md-12 mb-20">
    <div class="box_header_right">
        <div class=" float-none pos_tab_btn justify-content-start">
            <?php
                $key = 0;
            ?>
            <ul class="nav nav_list" role="tablist">
                <?php $__currentLoopData = @$gateway_activations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($gateway->method->method == 'Wallet' || $gateway->method->method == 'Cash On Delivery'): ?>
                        <?php
                            $key = 0;
                        ?>
                        <?php continue; ?>
                    <?php endif; ?>

                    <?php if($gateway->method->method == 'PayPal' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#paypalTab" role="tab"
                                data-toggle="tab" id="1" aria-selected="true"><?php echo e(__('payment_gatways.paypal')); ?></a>
                        </li>
                    <?php elseif($gateway->method->method == 'Stripe' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#stripeTab" role="tab" data-toggle="tab" id="1"
                                aria-selected="true"><?php echo e(__('payment_gatways.stripe')); ?></a>
                        </li>
                    <?php elseif($gateway->method->method == 'PayStack' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#paystackTab" role="tab" data-toggle="tab" id="1"
                                aria-selected="true"><?php echo e(__('payment_gatways.paystack')); ?></a>
                        </li>
                    <?php elseif($gateway->method->method == 'RazorPay' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#razorpayTab" role="tab" data-toggle="tab" id="1"
                                aria-selected="true"><?php echo e(__('payment_gatways.razorpay')); ?></a>
                        </li>
                    <?php elseif($gateway->method->method == 'PayTM' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#paytmTab" role="tab" data-toggle="tab" id="1"
                                aria-selected="true"><?php echo e(__('payment_gatways.paytm')); ?></a>
                        </li>
                    <?php elseif($gateway->method->method == 'Instamojo' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#instamojoTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.instamojo')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'Midtrans' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#midtransTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.midtrans')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'PayUMoney' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#payumoneyTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.payumoney')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'JazzCash' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#jazzcashTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.jazzcash')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'Google Pay' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#google_payTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.google_pay')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'FlutterWave' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#flutterWaveTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.flutter_wave_payment')); ?></a>
                    </li>
                    <?php elseif($gateway->method->method == 'Bank Payment' && @$gateway->status == 1): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#bankTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.bank_payment')); ?></a>
                    </li>

                    <?php elseif(isModuleActive('Bkash') && $gateway->method->method == 'Bkash' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#bkashTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.bkash')); ?></a>
                        </li>

                    <?php elseif(isModuleActive('SslCommerz') && $gateway->method->method == 'SslCommerz' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#SslCommerzTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.ssl_commerz')); ?></a>
                        </li>

                    <?php elseif(isModuleActive('MercadoPago') && $gateway->method->method == 'Mercado Pago' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#MercadoPagoTab" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.mercado_pago')); ?></a>
                        </li>
                    <?php elseif(isModuleActive('Tabby') && $gateway->method->method == 'Tabby' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#Tabby" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.tabby')); ?></a>
                        </li>
                    <?php elseif(isModuleActive('CCAvenue') && $gateway->method->method == 'CCAvenue' && @$gateway->status == 1): ?>
                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#CCAvenue" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.ccavenue')); ?></a>
                        </li>
                    <?php elseif( $gateway->method->method == 'Clickpay' && @$gateway->status == 1): ?>

                        <li class="nav-item mb-2">
                            <a class="nav-link <?php if($key == 0): ?> active show <?php endif; ?>" href="#clickpay" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('payment_gatways.clickpay')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php
                        $key ++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="white_box_30px mb_30">
        <div class="tab-content">

            <?php
                $key = 0;
            ?>
            <?php $__currentLoopData = @$gateway_activations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($gateway->method->method == 'Wallet' || $gateway->method->method == 'Cash On Delivery'): ?>
                    <?php
                        $key = 0;
                    ?>
                    <?php continue; ?>
                <?php endif; ?>
                <?php if($gateway->method->method == 'PayPal' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="paypalTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.paypal_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.paypal_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'Stripe' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="stripeTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.stripe_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.stripe_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'PayStack' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="paystackTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.paystack_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.paystack_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'RazorPay' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="razorpayTab">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.razorpay_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.razorpay_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'PayTM' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="paytmTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.paytm_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.paytm_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'Instamojo' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="instamojoTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.instamojo_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.instamojo_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'Midtrans' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="midtransTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.midtrans_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.midtrans_configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'PayUMoney' && @$gateway->status == 1): ?>


                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="payumoneyTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.payumoney_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.payumoney_configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                <?php elseif($gateway->method->method == 'JazzCash' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="jazzcashTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.jazzcash_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="" >
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.jazzcash_configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'Google Pay' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="google_payTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.google_pay_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.google_pay_configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'FlutterWave' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="flutterWaveTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.flutter_wave_payment_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.flutter_wave_payment_configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif($gateway->method->method == 'Bank Payment' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="bankTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.bank_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('paymentgateway::components.bank_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif(isModuleActive('Bkash') &&  $gateway->method->method == 'Bkash' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="bkashTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.bkash_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('bkash::bkash_config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif(isModuleActive('SslCommerz') &&  $gateway->method->method == 'SslCommerz' && @$gateway->status == 1): ?>

                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="SslCommerzTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.sslcommerz_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('sslcommerz::config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                <?php elseif(isModuleActive('MercadoPago') &&  $gateway->method->method == 'Mercado Pago' && @$gateway->status == 1): ?>
                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="MercadoPagoTab">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.mercado_pago_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('mercadopago::config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php elseif(isModuleActive('Tabby') &&  $gateway->method->method == 'Tabby' && @$gateway->status == 1): ?>
                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="Tabby">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.tabby_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('tabby::config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php elseif(isModuleActive('CCAvenue') &&  $gateway->method->method == 'CCAvenue' && @$gateway->status == 1): ?>
                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="CCAvenue">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.ccavenue_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('ccavenue::config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php elseif(isModuleActive('Clickpay') &&  $gateway->method->method == 'Clickpay' && @$gateway->status == 1): ?>
                    <div role="tabpanel" class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="clickpay">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('payment_gatways.clickpay_configuration')); ?></h3>
                                <ul class="d-flex">
                                    <div class="img_logo_div">
                                        <img src="<?php echo e(showImage(@$gateway->method->logo)); ?>" alt="">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php echo $__env->make('clickpay::config.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
                <?php
                    $key ++;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/Modules/PaymentGateway/Resources/views/components/_all_config_form_list.blade.php ENDPATH**/ ?>