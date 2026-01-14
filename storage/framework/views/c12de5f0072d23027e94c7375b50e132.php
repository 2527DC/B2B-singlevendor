<?php $__env->startSection('mainContent'); ?>
<style>
    #message-body {
        white-space: normal !important;
    }
</style>

    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">


            <div class="row">
                <div class="col-lg-4 mb-20">
                    <div class="row">
                        <div class="col-lg-12">

                            <?php if(permissionCheck('generalsetting.updatesystem.submit')): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'generalsetting.updatesystem.submit', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>

                            <div class="white-box sm_mb_20 sm2_mb_20 md_mb_20 ">
                                <div class="main-title">
                                    <h3 class="mb-30"><?php echo e(__('general_settings.upload_from_local_directory')); ?></h3>
                                </div>
                                <div class="add-visitor">

                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect mb-15">
                                                <input
                                                    class="primary-input form-control <?php echo e($errors->has('content_file') ? ' is-invalid' : ''); ?>"
                                                    readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):trans('common.browse')); ?> "
                                                    id="placeholderUploadContent" name="content_file">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('content_file')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('content_file')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                            <div class="primary_input">

                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text"
                                                        id="upload_content_file_place"
                                                        placeholder="<?php echo e(__('common.browse_file')); ?>"
                                                        readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                            for="upload_content_file"><?php echo e(__('product.Browse')); ?>

                                                        </label>
                                                        <input type="file" class="d-none" name="updateFile"
                                                            id="upload_content_file">
                                                    </button>
                                                </div>
                                                <?php $__errorArgs = ['updateFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                        </div>

                                    </div>
                                    <?php
                                        $tooltip = "";

                                    if (permissionCheck('setting.updateSystem.submit')){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                    ?>

                                <?php if(permissionCheck('generalsetting.updatesystem.submit')): ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                    title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($session)): ?>
                                                    <?php echo app('translator')->get('common.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('common.save'); ?>
                                                <?php endif; ?>

                                            </button>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span class="text-danger"> <?php echo e(__('common.no_action_permitted')); ?></span>
                                <?php endif; ?>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class="main-title">
                                    <h3 class="mb-30"><?php echo e(__('general_settings.about_system')); ?></h3>
                                </div>
                                <div class="add-visitor">
                                    <table class="display school-table school-table-style update_system_table">

                                        <tr>
                                            <td><?php echo e(__('general_settings.software_version')); ?></td>
                                            <td><?php echo e(getNumberTranslate(app('general_setting')->system_version)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('general_settings.check_update')); ?></td>
                                            <td><a href="https://codecanyon.net/user/codethemes/portfolio"
                                                   target="_blank"> <i
                                                        class="ti-new-window"> </i> <?php echo e(__('common.update')); ?> </a></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo e(__('general_settings.php_version')); ?></td>
                                            <td><?php echo e(getNumberTranslate(phpversion())); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(__('general_settings.curl_enable')); ?></td>
                                            <td><?php
                                                    if  (in_array  ('curl', get_loaded_extensions())) {
                                                        echo 'enable';
                                                    }
                                                    else {
                                                        echo 'disable';
                                                    }
                                                ?></td>
                                        </tr>


                                        <tr>
                                            <td><?php echo e(__('general_settings.purchase_code')); ?></td>
                                            <td>
                                                <?php echo e(__('Verified')); ?>

                                                <?php if(\Illuminate\Support\Facades\Auth::user()->role->type == 'superadmin'): ?>
                                                    <?php if(!env('APP_SYNC')): ?>
                                                        <?php if ($__env->exists('service::license.revoke')) echo $__env->make('service::license.revoke', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td><?php echo e(__('general_settings.install_domain')); ?></td>
                                            <td><?php echo e(env('APP_URL')); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('general_settings.system_activated_date')); ?></td>
                                            <td><?php echo e(dateConvert(app('general_setting')->system_activated_date)); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('general_settings.last_update_at')); ?></td>
                                            <td>
                                                <?php if($last_update): ?>
                                                    <?php echo e($last_update->created_at); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            'use strict';
            $(document).ready(function(){
                $(document).on('change', '#upload_content_file', function(event){
                    getFileName($(this).val(),'#upload_content_file_place');
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/update_system/updateSystem.blade.php ENDPATH**/ ?>