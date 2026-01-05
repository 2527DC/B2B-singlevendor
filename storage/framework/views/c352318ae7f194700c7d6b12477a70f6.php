<div class="col-lg-3  col-md-6">
    <div class="footer_widget">
        <div class="footer_title">
            <h3><?php echo e(@$subscribeContent->title); ?></h3>
        </div>
        <div class="subcribe-form mb_20 theme_mailChimp2" id="mc_embed_signup">
            <form id="subscriptionForm" method="" class="subscription relative">
                <input name="email" id="subscription_email_id" class="form-control" placeholder="<?php echo e(__('defaultTheme.enter_email_address')); ?>" type="email">
                <div class="message_div d-none">
                </div>
                <button id="subscribeBtn"><?php echo e(__('defaultTheme.subscribe')); ?></button>
                <div class="info"></div>
            </form>
        </div>
        <div class="social__Links">           
            <?php $__currentLoopData = $sellerSocialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sellerSocialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a target="__blank" href="<?php echo e($sellerSocialLink->url); ?>">
                    <i class="<?php echo e($sellerSocialLink->icon); ?>"></i>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/components/subscribe-component.blade.php ENDPATH**/ ?>