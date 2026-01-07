<div class="main-title">
    <h3 class="mb-30"> <?php echo e(__('frontendCms.add_InQuery')); ?> </h3>
</div>

<?php echo $__env->make('frontendcms::contact_content.components.query_form',['form_id' => 'add_query_form','form_tab' => 'iq_create','btn_id' => 'create_btn', 'button_name' => __('common.save') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH /var/www/html/mytestdhatri/Modules/FrontendCMS/Resources/views/contact_content/components/create_query.blade.php ENDPATH**/ ?>