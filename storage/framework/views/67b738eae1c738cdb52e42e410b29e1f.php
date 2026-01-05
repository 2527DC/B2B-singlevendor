
<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <?php if(isset($myCode)): ?>
                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_24 f_w_700 mb_20"><?php echo e(__('defaultTheme.my_referral_code')); ?></h4>
                    </div>
                    <div id="coupon">
                        <div class="d-flex gap_10 flex-sm-wrap flex-md-nowrap gray_color_1 theme_border padding25 mb_40">
                            <input name="code" id="code" value="<?php echo e(getNumberTranslate($myCode->referral_code)); ?>" class="primary_input3 rounded-0 style2  flex-fill" readonly type="text">
                            <button id="copyBtn" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.copy_code')); ?></button>
                        </div>
                    </div>

                    <div class="dashboard_white_box_header d-flex align-items-center">
                        <h4 class="font_20 f_w_700 mb_20"><?php echo e(__('defaultTheme.user_list')); ?></h4>
                    </div>
                    <div class="dashboard_white_box_body">
                        <div class="table_border_whiteBox mb_30">
                            <div class="table-responsive">
                                <table class="table amazy_table style4 mb-0">
                                    <thead>
                                        <tr>
                                        <th class="font_14 f_w_700 priamry_text" scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.user')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.date')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.status')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('defaultTheme.discount_amount')); ?></th>
                                        <th class="font_14 f_w_700 priamry_text border-start-0 border-end-0" scope="col"><?php echo e(__('common.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $referList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(getNumberTranslate($key +1)); ?></span>
                                            </td>
                                            <td>
                                                <span class="font_16 f_w_500 mute_text"><?php echo e(textLimit(@$referral->user->first_name. @$referral->user->last_name,20)); ?></span><br>
                                                <span class="font_12 f_w_400 mute_text"><?php echo e(@$referral->user->email?@$referral->user->email:@$referral->user->username); ?></span>
                                            </td>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(dateConvert($referral->created_at)); ?> </span>
                                            </td>
                                            <td>
                                            <a href="#" id="referral_used_<?php echo e($referral->id); ?>" class="table_badge_btn <?php echo e($referral->is_use == 1?'style4':'style3'); ?> text-nowrap"><?php echo e($referral->is_use == 1?__('defaultTheme.already_use'):__('defaultTheme.not_used')); ?></a>
                                            </td>
                                            <td>
                                                <span class="font_14 f_w_500 mute_text"><?php echo e(single_price($referral->discount_amount)); ?> </span>
                                            </td>
                                            <td>
                                            <button id="referral_used<?php echo e($referral->id); ?>" class="referral_used <?php echo e($referral->is_use == 1?'style4 amaz_primary_btn gray_bg_btn':'style3 amaz_primary_btn'); ?> text-nowrap" <?php echo e($referral->is_use == 1 ? 'disabled' : ''); ?> data-id="<?php echo e($referral->id); ?>"><?php echo e($referral->is_use == 1?__('common.already_claimed'):__('common.claim')); ?></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if($referList->lastPage() > 1): ?>
                            <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $referList,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <?php elseif(!$referList->count()): ?>
                            <p class="empty_p"><?php echo e(__('common.empty_list')); ?>.</p>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <div class="dashboard_white_box_header d-flex align-items-center">
                            <h4 class="font_24 f_w_700 mb_20 text-center w-100"><?php echo e(__('defaultTheme.you_will_get_referral_after')); ?></h4>
                        </div>
                    <?php endif; ?>
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
                $(document).on('click', '#copyBtn', function(event){
                    let copyTextarea = document.createElement("textarea");
                    copyTextarea.style.position = "fixed";
                    copyTextarea.style.opacity = "0";
                    copyTextarea.textContent = document.getElementById("code").value;
                    document.body.appendChild(copyTextarea);
                    copyTextarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(copyTextarea);
                    toastr.success("<?php echo e(__('defaultTheme.code_copied_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                });
                $(document).on('click', '.referral_used', function(event){
                    var id = $(this).data('id');
                    $('#pre-loader').show();
                    $.post('<?php echo e(route('customer_panel.referral.used')); ?>',{_token:'<?php echo e(csrf_token()); ?>', referral_id:id}, function(data){
                        var balance = $('#total_balance').text();
                        var total = balance.split(" ");
                        var total_bal =total[1].split(',') ;
                        var total_balance = parseFloat(total_bal[0]+total_bal[1]);
                        var amount = parseFloat(data.amount + total_balance);
                        $('#total_balance').text(currency_format(amount));
                        $('#referral_used'+id).text('<?php echo e(__('common.already_claimed')); ?>');
                        $('#referral_used_'+id).text('<?php echo e(__('defaultTheme.already_use')); ?>');
                        $('#referral_used'+id).addClass("gray_bg_btn");
                        $('#referral_used'+id).prop("disabled", true);
                        $('#pre-loader').hide();
                    });
                });
            });

        })(jQuery);
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/referral.blade.php ENDPATH**/ ?>