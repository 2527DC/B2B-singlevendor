<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/role_module_style.css'))); ?>">
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/rolepermission/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="role_permission_wrap">
        <div class="permission_title">
            <h4><?php echo app('translator')->get('hr.assign_permission'); ?> (<?php echo e(@$role->name); ?>)</h4>
        </div>
    </div>
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'permission.permissions.store','method' => 'POST'])); ?>

    <div class="erp_role_permission_area ">
    <!-- single_permission  -->
    <input type="hidden" name="role_id" value="<?php echo e(@$role->id); ?>">
    <div  class="mesonary_role_header">
        <?php $__currentLoopData = $MainMenuList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$Module->module or isModuleActive($Module->module)): ?>
                <?php echo $__env->make('rolepermission::page-components.permissionModule',[ 'key' =>$key, 'Module' =>$Module ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(permissionCheck('permission.permissions.store')): ?>
        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    <?php echo app('translator')->get('common.submit'); ?>
                </button>
            </div>
        </div>
    <?php endif; ?>

    </div>
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($) {
	"use strict";
    $('.permission-checkAll').on('click', function () {
       if($(this).is(":checked")){
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', true);
            });
       }else{
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', false);
            });
       }
    });
    $('.module_link').on('click', function () {
       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link_id = $(this).val();
       if($(this).is(":checked")){
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', true);
        }else{
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', false);
        }
       var checked = 0;
       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });
        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });
    $('.module_link_option').on('click', function () {
       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link = $(this).parents('.module_link_option_div').attr("id");
       // module link check
        var link_checked = 0;
       $( '.module_option_'+module_id+'_'+ module_link).each(function() {
          if($(this).is(":checked")){
            link_checked++;
          }
        });
        if(link_checked > 0){
            $("#Sub_Module_"+module_link).prop('checked', true);
        }else{
            $("#Sub_Module_"+module_link).prop('checked', false);
        }
       // module check
       var checked = 0;
       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });
        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });
 })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/RolePermission/Resources/views/permission.blade.php ENDPATH**/ ?>