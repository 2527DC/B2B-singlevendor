
<?php $__env->startSection('title'); ?>
<?php echo e(__('ticket.ticket')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25" id="dataShow">
                    <?php echo $__env->make('frontend.amazy.pages.ticket.partials._ticket_list_with_paginate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                $('#status_by').niceSelect();
                $(document).on('click', '.page_link', function(event) {
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetch_filter_data(page);

                });

                function fetch_filter_data(page){
                    $('#pre-loader').show();
                    var status = $('#status_by').val();
                    if(status != null) {
                        var url = "<?php echo e(route('frontend.support-ticket.paginate')); ?>"+'?status='+status+'&page='+page;
                    }else {
                        var url = "<?php echo e(route('frontend.support-ticket.paginate')); ?>"+'?page='+page;
                    }

                    if(page != 'undefined'){
                        $.ajax({
                            url:url,
                            success:function(data)
                            {
                                $('#dataShow').html(data);
                                $('#status_by').niceSelect();
                                $('#pre-loader').hide();
                            }
                        });
                    }else{
                        toastr.warning("<?php echo e(__('common.error_message')); ?>");
                    }

                }

                $(document).on('change', '#status_by', function(event){
                    getFilterUpdateByIndex();
                });

                function getFilterUpdateByIndex(){
                    $('#pre-loader').show();
                    let status = $('#status_by').val();

                    $.get("<?php echo e(route('frontend.support-ticket.paginate')); ?>", {status : status}, function(data){
                        $('#dataShow').html(data);
                        $('#status_by').niceSelect();
                        $('#pre-loader').hide();
                    });
                }
            });
        })(jQuery);

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/ticket/index.blade.php ENDPATH**/ ?>