

<?php $__env->startSection('mainContent'); ?>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30"><?php echo e(__('general_settings.general_settings')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_30px">
                    <?php echo $__env->make('generalsetting::page_components.activation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $(document).on('change','.activations', function(){
            if(this.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('update_activation_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:this.value, status:status}, function(data){
                if(data == 1){
                    toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                }
                else{
                    toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");

                }
            }).fail(function(response) {
               if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                    $('#pre-loader').addClass('d-none');
                    return false;
                }

            });
        });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/activation_index.blade.php ENDPATH**/ ?>