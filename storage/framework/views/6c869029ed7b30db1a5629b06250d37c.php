
<?php $__env->startPush('css'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/style.css'))); ?>" />

<?php $__env->stopPush(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div id="add_product">
        <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="white_box_50px box_shadow_white">
                            <div class="box_header">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30"><?php echo e(__('common.bulk_customer_upload')); ?></h3>
                                </div>
                            </div>
                            <form action="<?php echo e(route('admin.coustomer.bulkupload.store')); ?>" method="POST" enctype="multipart/form-data" class="csvForm">
                                <?php echo csrf_field(); ?>
                                <div class="row form">
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <div class="primary_input mb-15">
                                          <label class="primary_input_label" for=""><?php echo e(__('common.csv_upload')); ?> <small><a class="d-flex float-right" href="<?php echo e(asset(asset_path('bulk_upload_sample/customer.xlsx'))); ?>" download><?php echo e(__('common.sample_file_download')); ?></a><small> </label>
                                          <div class="primary_file_uploader">
                                             <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="<?php echo e(__('common.browse_file')); ?>" readonly="">
                                             <button class="" type="button">
                                             <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo e(__("common.browse")); ?> </label>
                                             <input type="file" class="d-none" accept=".xlsx, .xls, .csv" name="file" id="document_file_1">
                                             </button>
                                          </div>
                                          <span class="red"><?php echo e($errors->first('file')); ?></span>
                                       </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <div class="primary_input mb-15">
                                          <label class="primary_input_label red_text" for=""><?php echo e(__('common.download_warning')); ?></label>
                                       </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="submit_btn text-center ">
                                        <button class="primary-btn semi_large2 fix-gr-bg csvFormBtn" type="submit"><i class="ti-check"></i><?php echo e(__('common.upload_csv')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("scripts"); ?>
   <script type="text/javascript">
        (function($){
            "use strict";
            $( document ).ready(function() {
                $( ".csvFormBtn" ).attr("disabled", false);

                $( ".csvFormBtn" ).on( "click", function() {
                    $(".csvForm").submit();
                    $( ".csvFormBtn" ).attr("disabled", true);
                });

                $(document).on('change', '#document_file_1', function(event){
                    getFileName($(this).val(),'#placeholderFileOneName');
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Customer/Resources/views/customers/bulk_upload.blade.php ENDPATH**/ ?>