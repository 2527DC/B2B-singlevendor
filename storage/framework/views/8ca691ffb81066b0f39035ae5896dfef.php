
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="white-box box_shadow_white">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('refund.configuration')); ?></h3>
                        </div>
                    </div>
                    <?php
                    $refund_time = app('business_settings')->where('type', 'refund_times')->first();
                    $approval = app('business_settings')->where('type', 'refund_status')->first();
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label"><?php echo e(__('refund.refund_status')); ?></label>
                                <label class="switch_toggle" for="checkbox<?php echo e($approval->id); ?>">
                                    <input type="checkbox" id="checkbox<?php echo e($approval->id); ?>" <?php if($approval->status == 1): ?> checked <?php endif; ?> value="<?php echo e($approval->id); ?>" class="refund_status">
                                    <div class="slider round"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo e(route('refund.refund_config_store')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="id" value="<?php echo e($refund_time->id); ?>">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="status"><?php echo e(__('refund.refund_time')); ?> <?php echo e(__('refund.in_days')); ?> <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" name="status" id="status" type="text" value="<?php echo e($refund_time->status); ?>" required="1">
                                    <span class="text-danger"><?php echo e($errors->first('status')); ?></span>
                                </div>
                            </div>
                            <?php if(permissionCheck('refund.refund_config_store')): ?>
                            <div class="col-lg-12 text-center">
                                <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.save")); ?>

                                </button>
                            </div>
                            <?php else: ?>
                            <div class="col-lg-12 text-center mt-2">
                                <span class="alert alert-warning" role="alert">
                                    <strong><?php echo e(__('common.you_don_t_have_this_permission')); ?></strong>
                                </span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($){
        "use Strict";
        $(document).ready(function(){
            $(document).on('change', '.refund_status', function(event){
                update_active_status($(this)[0]);
            });

            function update_active_status(el){
                $('#pre-loader').removeClass('d-none');
                if(el.checked){
                    var status = 1;
                }
                else{
                    var status = 0;
                }
                $.post('<?php echo e(route('update_activation_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                    if(data == 1){
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                        $('#pre-loader').addClass('d-none');
                    }
                    else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                }).fail(function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }

                });
            }

        });
    })(jQuery);

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Refund/Resources/views/admin/refund_config/index.blade.php ENDPATH**/ ?>