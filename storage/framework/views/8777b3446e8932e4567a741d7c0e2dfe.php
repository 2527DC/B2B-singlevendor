
<?php $__env->startSection('styles'); ?>
    <style>
        .mtr-10{
            margin-top: -10px;
        }
        .cursor-not-allowed{
            cursor: not-allowed;
        }
        .badge_5 {
            background: rgba(140, 143, 141, 0.1);
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--secondary) !important;
            border: 0;
            display: inline-block;
            border-radius: 10px;
            padding: 7px 21px;
            white-space: nowrap;
            line-height: 1.2;
            text-transform: none;
        }
        .primary_datepicker_input button {
            position: absolute;
            color: #828BB2;
            font-size: 14px;
            font-weight: 400;
            background: transparent;
            border: 0;
            cursor: pointer;
            z-index: 999;
            top: 70%;
            transform: translateY(-50%);
            right: 14px;
        }
        .primary_datepicker_input button i {
            top: 0;
            cursor: pointer;
            z-index: 9;
        }
        .info_msg{
            color: var(--gradient_3) !important;
        }
        .btn-line-height{
            /*line-height: 20px !important;*/
            /*padding: 1px 20px !important;*/
            white-space: nowrap;
            text-align: center;
        }
        .nav-tabs {
            border: 0 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php if(hasAffiliateAccess()): ?>
        <?php if($start_date && $end_date): ?>
            <section class="sms-breadcrumb mb-40 white-box">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <h1>[ <?php echo e(showDate($start_date)); ?> - <?php echo e(showDate($end_date)); ?> Filter Record ] </h1>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <?php echo $__env->make('affiliate::affiliate.components._filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('affiliate::affiliate.components._balance_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-lg-3">

                        <?php echo $__env->make('affiliate::affiliate.components._create_link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('affiliate::affiliate.components._paypal_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                    <div class="col-lg-9">
                        <?php echo $__env->make('affiliate::affiliate.components._table_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
            <div id="append_html"></div>
            <?php echo $__env->make('affiliate::affiliate.components._withdraw_request_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('affiliate::affiliate.components._balance_transfer_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('affiliate::_deleteModalForAjax',['item_name' => __("affiliate.Withdraw")], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <input type="hidden" value="<?php echo e(affiliateConfig('min_withdraw')); ?>" id="minimum_withdraw_amount">
            <input type="hidden" value="<?php echo e($user->affiliateWallet ? $user->affiliateWallet->amount : 0); ?>" id="user_balance">
            <input type="hidden" value="<?php echo e(route('affiliate.withdraw_request.store')); ?>" id="withdraw_request_store_url">
            <input type="hidden" value="<?php echo e(route('affiliate.withdraw_request.destroy')); ?>" id="withdraw_request_delete_url">
            <input type="hidden" value="<?php echo e(route('affiliate.withdraw_request.edit',':id')); ?>" id="withdraw_request_edit_url">
            <input type="hidden" value="<?php echo e(route('affiliate.withdraw_request.update',':id')); ?>" id="withdraw_request_update_url">
            <input type="hidden" value="<?php echo e(route('affiliate.balance_transfer_to_wallet')); ?>" id="balance_transfer_url">
        </section>
    <?php elseif(auth()->check() && auth()->user()->accept_affiliate_request ==2): ?>
        <section class="admin-visitor-area up_st_admin_visitor white-box">
            <div class="container-fluid p-0">
                <div class="row justify-content-between">
                    <h1 class="info_msg">[<?php echo e(__('affiliate.Info')); ?> : <?php echo e(__('affiliate.You are blocked from admin. Please contact with admin.')); ?> ] </h1>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="admin-visitor-area up_st_admin_visitor white-box">
            <div class="container-fluid p-0">
                <div class="row justify-content-between">
                    <h1 class="info_msg">[<?php echo e(__('affiliate.Info')); ?> : <?php echo e(__('affiliate.Your affiliate joining request is under review. After confirming your request you can join our affiliate program.')); ?> ] </h1>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('Modules/Affiliate/Resources/assets/js/affiliate_link.js')); ?>"></script>
    <script src="<?php echo e(asset('Modules/Affiliate/Resources/assets/js/balance_transfer.js')); ?>"></script>
    <script src="<?php echo e(asset('Modules/Affiliate/Resources/assets/js/daterangepicker.min.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function(){
                $('input[name="date_range_filter"]').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    }

                }, function (start, end, label) {
                    $('#start').val(start.format('YYYY-MM-DD'))
                    $('#end').val(end.format('YYYY-MM-DD'))
                });
                $(document).on('click','#reset-date-filter',function(){
                    let filterRange = $('input[name="date_range_filter"]').val();
                    let formatDate = filterRange.split('-');
                    let startDate = dateFormat(formatDate[0]);
                    let endDate = dateFormat(formatDate[1]);
                    var params = [
                        "startDate=" +startDate,
                        "endDate=" + endDate
                    ];
                    window.location.href = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params.join('&');
                });

                $(document).on('click','.copy_btn',function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    var r = document.createRange();
                    r.selectNode(document.getElementById('link_'+id));
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(r);
                    document.execCommand('copy');
                    window.getSelection().removeAllRanges();
                    toastr.success("<?php echo e(__('common.link_copied_successfully')); ?>", "<?php echo e(__('common.success')); ?>");
                });

                $(document).on('click', '.delete_link', function(event){
                    event.preventDefault();
                    let value = $(this).data('value');
                    confirm_modal(value);
                });

                function dateFormat(date){
                    var newdate = new Date(date);
                    var dd =("0" + (newdate.getDate())).slice(-2);
                    var mm =("0" + (newdate.getMonth() + 1)).slice(-2);
                    var y = newdate.getFullYear();
                    return  y + '-' + mm + '-' + dd;
                }

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Affiliate/Resources/views/affiliate/index.blade.php ENDPATH**/ ?>