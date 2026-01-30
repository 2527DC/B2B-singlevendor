<?php
$modal = false;
if(Session::get('ip') == NULL){
Session::put('ip',request()->ip());
$modal = true;
}
if($popupContent->status == 0){
    $modal = false;
}
?>

<?php if($modal): ?>
<!-- newsletter_form ::start  -->
<div class="" id="subscriptionDiv">
    <div class="newsletter_form_wrapper newsletter_active" id="subscriptionModal">
        <div class="newsletter_form_inner">
            <div class="close_modal">
                <i class="ti-close"></i>
            </div>
            <div class="newsletter_form_thumb d-flex align-items-center align-items-center justify-content-center d-none d-lg-block">
                <img class="img-fluid popup_image d-block" src="<?php echo e(showImage(@$popupContent->image)); ?>" alt="<?php echo e($popupContent->title); ?>" title="<?php echo e($popupContent->title); ?>" >
            </div>
            <div class="newsletter_form d-flex flex-column justify-content-center text-center text-lg-start">
                <h2><?php echo e($popupContent->title); ?></h2>
                <p class="text-capitalize"><?php echo e($popupContent->subtitle); ?></p>
                <form action="" id="modalSubscriptionForm">
                    <div class="d-flex gap-10 flex-column flex-sm-row">
                        <div class="flex-grow-1">
                            <input id="modalSubscription_email_id" placeholder="<?php echo e(__('defaultTheme.enter_email_address')); ?>" class="primary_input3 mb_10" type="text" name="email">
                        </div>
                        <div class="col-lg-12 message_div_modal d-none"></div>
                        <div class="">
                            <button class="amaz_primary_btn py-3 lh-1 rounded-3 w-100 text-center" id="modalSubscribeBtn"><?php echo e(__('defaultTheme.subscribe')); ?></button>
                        </div>
                    </div>
                </form>
                <p class="m-0 mt-3"> <?php echo e(__("common.By Subscribing to our newsletter you agree to our")); ?> <a href="#"><?php echo e(__("common.Privacy Policy")); ?></a></p>

                <div class="hide_modal_in_future d-flex gap-10 align-items-center mt-3 justify-content-center justify-content-lg-start">
                    <label class="primary_checkbox d-flex">
                        <input name="dont_show_again" id="dont_show_again" type="checkbox" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <span class="checkmark mr_15"></span>
                        <span class="label_name f_w_400 "><?php echo e(__("common.Don't show this popup again")); ?></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- newsletter_form ::end  -->
<?php endif; ?>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/partials/_subscription_modal.blade.php ENDPATH**/ ?>