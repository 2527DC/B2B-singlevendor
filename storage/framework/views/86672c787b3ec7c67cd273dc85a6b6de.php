<link rel="stylesheet" href="<?php echo e(asset(asset_path('frontend/amazy/css/page_css/review.css'))); ?>" />
<?php $__env->startSection('title'); ?>
    <?php echo e(__('defaultTheme.place_a_refund_request')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="white_box style2 bg-white mb_20">
                        <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.package_code')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e($package->package_code); ?></p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(@$package->order->order_number); ?></p>
                                </div>
                                <?php if(isModuleActive('MultiVendor')): ?>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.seller')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(($package->seller_id != 1)?@$package->seller->sellerAccount->seller_shop_display_name:app('general_setting')->site_title); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex flex-column ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base">
                                        <?php if($package->order->is_cancelled == 1): ?>
                                            <?php echo e(__('common.cancelled')); ?>

                                        <?php elseif($package->order->is_completed == 1): ?>
                                            <?php echo e(__('common.completed')); ?>

                                        <?php else: ?>
                                            <?php if($package->order->is_confirmed == 1): ?>
                                                <?php echo e(__('common.confirmed')); ?>

                                            <?php elseif($package->order->is_confirmed == 2): ?>
                                                <?php echo e(__('common.declined')); ?>

                                            <?php else: ?>
                                                <?php echo e(__('common.pending')); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>

                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e($package->created_at); ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column  ">
                                <?php
                                    $grand_total = $package->products->sum('total_price') + $package->shipping_cost;
                                ?>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price($grand_total)); ?></p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.payment')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base">
                                        <?php if($package->order->is_paid == 1): ?>
                                            <?php echo e(__('common.paid')); ?>

                                        <?php else: ?>
                                            <?php echo e(__('common.pending')); ?>

                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo e(route('refund.refund_make_request_store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php
                                $e_items = [];
                            ?>
                            <div class="dashboard_white_box_body">
                                <div class="table-responsive mb_10">
                                    <table class="table amazy_table3 style2 mb-0 min-height-250 refund_product_list">
                                        <tbody>
                                            <input type="hidden" name="order_id" value="<?php echo e($package->order->id); ?>">
                                            <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                                            <?php $__currentLoopData = $package->products->where('type','product'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(@$package_product->seller_product_sku->sku->product->is_physical): ?>
                                                    <?php
                                                        //ga4
                                                        $e_items[]=[
                                                            "item_id"=>$package_product->product_sku_id,
                                                            "item_name"=> $package_product->seller_product_sku->sku->product->product_name,
                                                            "currency"=> currencyCode(),
                                                            "price"=> $package_product->price
                                                        ];
                                                    ?>
                                                    <input type="hidden" name='e_items' value="<?php echo e(json_encode($e_items)); ?>" >
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo e(singleProductURL($package_product->seller_product_sku->product->seller->slug, $package_product->seller_product_sku->product->slug)); ?>" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                                <label class="primary_checkbox d-flex" for="product_id<?php echo e($package_product->id); ?>">
                                                                    <input type="checkbox" name="product_ids[]" id="product_id<?php echo e($package_product->id); ?>" checked value="<?php echo e($package->id); ?>-<?php echo e($package_product->product_sku_id); ?>-<?php echo e($package->seller_id); ?>-<?php echo e($package_product->price); ?>">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <div class="thumb">
                                                                    <img src="
                                                                        <?php if(@$package_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                            <?php echo e(showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>

                                                                        <?php else: ?>

                                                                            <?php echo e(showImage((@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img)??@$package_product->seller_product_sku->product->product->thumbnail_image_source)); ?>

                                                                        <?php endif; ?>
                                                                    " alt="">
                                                                </div>
                                                                <div class="summery_pro_content">
                                                                    <h4 class="font_16 f_w_700 m-0 theme_hover"><?php echo e(textLimit(@$package_product->seller_product_sku->product->product_name,30)); ?></h4>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php
                                                                            $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                        ?>
                                                                        <?php $__currentLoopData = @$package_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($combination->attribute->id == 1): ?>
                                                                                <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                            <?php endif; ?>
                                                                            <?php if(!$loop->last): ?>, <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e($package_product->qty); ?> X <?php echo e(single_price($package_product->price)); ?></h4>
                                                        </td>
                                                        <td>
                                                            <div class="product_number_count style_4" data-target="amount-1">
                                                                <button type="button" value="-" data-input-id='qty_<?php echo e($package_product->product_sku_id); ?>' class="count_single_item inumber_decrement"> <i class="ti-minus"></i></button>
                                                                <input class="count_single_item input-number qty" id="qty_<?php echo e($package_product->product_sku_id); ?>" type="text" name="qty_<?php echo e($package_product->product_sku_id); ?>" maxlength="<?php echo e($package_product->qty); ?>" minlength="1" value="<?php echo e($package_product->qty); ?>" readonly>
                                                                <button type="button" value="+" data-input-id='qty_<?php echo e($package_product->product_sku_id); ?>' class="count_single_item number_increment"> <i class="ti-plus"></i></button>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="theme_select wide rounded-0" required id="reason_<?php echo e($package_product->product_sku_id); ?>" name="reason_<?php echo e($package_product->product_sku_id); ?>">
                                                                <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->reason); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <?php $__errorArgs = ['product_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="amazy_bb3 mt-2 mb-3"></div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="primary_label2 style2 "><?php echo e(__('defaultTheme.additional_information')); ?></label>
                                            <textarea  name="additional_info" id="additional_info" maxlength="255" placeholder="<?php echo e(__('defaultTheme.additional_information')); ?>" class="primary_textarea4  rounded-0 mb_25"></textarea>
                                            <span class="text-danger"  id="error_message"></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="primary_label2 style2 "><?php echo e(__('defaultTheme.set_prefered_option')); ?> </label>
                                            <select class="theme_select wide rounded-0 mb_30" name="money_get_method" id="money_get_method">
                                                <option value="wallet"><?php echo e(__('defaultTheme.wallet')); ?></option>
                                                <option value="bank_transfer"><?php echo e(__('defaultTheme.bank_transfer')); ?></option>
                                            </select>
                                            <div class="bank_info_div row d-none">
                                                <div class="col-md-12">
                                                    <h5><?php echo e(__('defaultTheme.bank_information_to_recieve_money')); ?></h5>
                                                </div>
                                                <div class="col-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('common.bank_name')); ?> <span>*</span></label>
                                                    <input type="text" id="bank_name" name="bank_name" placeholder="<?php echo e(__('common.bank_name')); ?>" class="primary_input3 style4 mb_30">
                                                    <?php $__errorArgs = ['bank_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('common.branch_name')); ?> <span>*</span></label>
                                                    <input type="text" id="branch_name" name="branch_name" placeholder="<?php echo e(__('common.branch_name')); ?>" class="primary_input3 style4 mb_30">
                                                    <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('common.account_name')); ?> <span>*</span></label>
                                                    <input type="text" id="account_name" name="account_name" placeholder="<?php echo e(__('common.account_name')); ?>" class="primary_input3 style4 mb_30">
                                                    <?php $__errorArgs = ['account_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('common.account_number')); ?><span>*</span></label>
                                                    <input type="text" id="account_no" name="account_no" placeholder="<?php echo e(__('common.account_number')); ?>" class="primary_input3 style4 mb_30">
                                                    <?php $__errorArgs = ['account_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="primary_label2 style2 "><?php echo e(__('defaultTheme.set_shipment_option')); ?> </label>
                                            <select class="theme_select wide rounded-0 mb_30" name="shipping_way" id="shipping_way">
                                                <option value="courier"><?php echo e(__('shipping.courier_pick_up')); ?></option>
                                                <option value="drop_off"><?php echo e(__('shipping.drop_off')); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row shipment_info_div1">
                                                <div class="col-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('defaultTheme.courier_address')); ?> <span>*</span></label>
                                                    <select class="theme_select wide rounded-0 mb_30" name="pick_up_address_id" id="pick_up_address_id">
                                                        <?php $__currentLoopData = auth()->user()->customerAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_num => $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($address->id); ?>"><?php echo e($address->address); ?>, <?php echo e(@$address->getCity->name); ?>, <?php echo e(@$address->getState->name); ?> (<?php echo e($address->phone); ?>)</option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['pick_up_address_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="shipment_info_div2 row d-none">
                                            <div class="col-12">
                                                <label class="primary_label2 style2 "><?php echo e(__('defaultTheme.courier_address')); ?> <span>*</span></label>
                                                <input id="drop_off_courier_address" name="drop_off_courier_address" placeholder="<?php echo e(__('defaultTheme.courier_address')); ?>" class="primary_input3 style4 mb_30" type="text">
                                                <?php $__errorArgs = ['drop_off_courier_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="photo_uploader_lists">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="primary_label2 style2 "><?php echo e(__('common.image')); ?></label>
                                                    <div class="img_upload_group d-flex align-items-center flex-wrap">
                                                        <div class="flex-wrap img_upload_div" id="img_upload_div_<?php echo e($key); ?>">
                                                        </div>
                                                        <label for="photo_<?php echo e($key); ?>" class="photo_uploader">
                                                            <i class="fas fa-camera"></i>
                                                            <p id="count_<?php echo e($key); ?>"><?php echo e(getNumberTranslate(0)); ?>/<?php echo e(getNumberTranslate(6)); ?></p>
                                                            <input class="d-none upload_img_for_product" type="file" id="photo_<?php echo e($key); ?>" name="product_images_<?php echo e(@$product->giftCard->id); ?>[]" data-upload_div="#img_upload_div_<?php echo e($key); ?>" data-count="#count_<?php echo e($key); ?>" max="6" multiple>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="contactBtn" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('common.send')); ?></button>
                                </div>
                            </div>
                        </form>
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
            $(document).ready(function() {
                $(document).on('change', '#money_get_method', function() {
                    $('#pre-loader').show();
                    var method = this.value;
                    if (method == "bank_transfer") {
                        $('.bank_info_div').removeClass('d-none');
                    }else {
                        $('.bank_info_div').addClass('d-none');
                    }
                    $('#pre-loader').hide();
                });
                $(document).on('change', '#shipping_way', function() {
                    $('#pre-loader').show();
                    var way = this.value;
                    if (way == "courier") {
                        $('.shipment_info_div1').removeClass('d-none');
                        $('.shipment_info_div2').addClass('d-none');
                    }else {
                        $('.shipment_info_div1').addClass('d-none');
                        $('.shipment_info_div2').removeClass('d-none');
                    }
                    $('#pre-loader').hide();
                });
                $(document).on('change', '.upload_img_for_product', function(event){
                    let upload_div = $(this).data('upload_div');
                    let count = $(this).data('count');
                    uploadImage($(this)[0], upload_div, count);
                });

                $(document).on('click','.count_single_item',function(){
                    let isIn = $(this).val();
                    let element = $(this).attr('data-input-id');
                    let max = parseInt($('#'+element).attr('maxlength'));
                    let quantity = parseInt($('#'+element).val());
                    let min = 1;
                    if(isIn == '-')
                    {
                        quantity = quantity - 1;
                        if(quantity != 0){
                            $('#'+element).val(quantity);
                        }
                    }else{
                        quantity = quantity + 1;
                        if(max >= quantity){
                            $('#'+element).val(quantity);
                        }
                    }
                });
                function uploadImage(data, divId, count) {
                    if (data.files) {
                        if(data.files.length>6){
                            toastr.error("<?php echo e(__('defaultTheme.maximum_6_image_can_upload')); ?>","<?php echo e(__('common.error')); ?>");
                            data.value = '';
                        }
                        else{
                            $.each(data.files, function(key, value) {
                            $(divId).empty();
                            $(count).text(data.files.length+'/6');
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $(divId).append(
                                    `<div class="single_img">
                                        <img src="` +e.target.result + `" alt="">
                                    </div>`);
                            };
                            reader.readAsDataURL(value);
                        });
                        }
                    }
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/refunds/create.blade.php ENDPATH**/ ?>