<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/modulemanager/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <link rel="stylesheet" href="<?php echo e((asset(asset_path('modules/modulemanager/sass/manage_module.css')))); ?>">
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('vendor/spondonit/css/parsley.css'))); ?>">

    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-9 col-xs-6 col-md-6 col-sm-12 no-gutters ">
                            <div class="main-title sm_mb_20 sm2_mb_20 md_mb_20 mb-30 ">
                                <h3 class="mb-0"> <?php echo e(__('general_settings.module')); ?> <?php echo e(__('general_settings.manage')); ?></h3>
                            </div>
                        </div>
                        <?php if(permissionCheck('modulemanager.uploadModule')): ?>
                        <div class="col-lg-3 col-xs-6 col-md-6 col-sm-12 no-gutters list_div">
                            <a data-toggle="modal"
                               data-target="#add_module" href="#"
                               class="primary-btn fix-gr-bg small">  <?php echo e(__('common.add')); ?> / <?php echo e(__('common.update')); ?> <?php echo e(__('general_settings.module')); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table class="display school-table school-table-style" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('common.sl')); ?></th>
                                    <th><?php echo e(__('general_settings.module')); ?><?php echo e(__('common.name')); ?></th>
                                    <th><?php echo e(__('common.description')); ?></th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>

                                <tbody>
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <?php $count=1;
                                $manage =\Modules\ModuleManager\Entities\InfixModuleManager::all();
                                ?>
                                <?php $__currentLoopData = $is_module_available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $is_module_available = base_path().'/'.'Modules/' . $row->name. '/Providers/' .$row->name. 'ServiceProvider.php';
                                        $configFile = 'Modules/' . $row->name. '/' .$row->name. '.json';
                                         $is_data =  $manage->where('name', $row->name)->first();

                                    try {
                                        $config =file_get_contents(base_path().'/'.$configFile);

                                    }catch (\Exception $exception){
                                    $config =null;
                                    }


                                    ?>
                                    <tr>
                                        <td><?php echo e(getNumberTranslate(@$count++)); ?></td>
                                        <td>
                                            <?php if(@$row->name == 'Otp'): ?> <?php echo e(strtoupper(@$row->name)); ?> <?php else: ?> <?php echo e(@$row->name); ?> <?php endif; ?>
                                            <?php if(!empty($is_data->purchase_code)): ?> <p class="text-success">
                                                <?php echo e(__('general_settings.verified')); ?>

                                                on <?php echo e(date("F jS, Y", strtotime(@$is_data->activated_date))); ?></p>
                                            <a href="#" class="module_switch" data-id="<?php echo e(@$row->name); ?>"
                                               id="module_switch_label<?php echo e(@$row->name); ?>"
                                               data-item="<?php echo e($row); ?>">
                                                <?php echo e(isModuleActive($row->name )  == false? 'Activate':'Deactivate'); ?>



                                            </a>
                                            <?php if ($__env->exists('service::license.revoke-module', ['name' =>$row->name, 'row' => false, 'file' =>false])) echo $__env->make('service::license.revoke-module', ['name' =>$row->name, 'row' => false, 'file' =>false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <div id="waiting_loader"
                                                 class="waiting_loader<?php echo e(@$row->name); ?>">
                                                <img
                                                    src="<?php echo e(showImage('backend/img/loader.gif')); ?>"
                                                    width="40" height="40"/><br>

                                            </div>

                                            <?php else: ?><p class="text-danger">
                                                <?php if(! file_exists($is_module_available)): ?>
                                                <?php else: ?>

                                                    <a class="verifyBtn"
                                                       data-toggle="modal" data-id="<?php echo e(@$row->name); ?>"
                                                       data-target="#Verify"
                                                       href="#">   <?php echo e(__('general_settings.verify')); ?></a>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <?php if(isset($config)): ?>
                                                <?php

                                                    $name=$row->name;
                                                    $config= json_decode($config);
                                                    if (isset($config->$name->notes[0])){
                                                    echo $config->$name->notes[0];
                                                    echo '<br>';
                                                    echo 'Version: '.$config->$name->versions[0].' | Developed By <a target="_blank" href="https://aorasoft.com/">Aora Soft</a>';

                                                    }
                                                ?>
                                            <?php else: ?>
                                                <?php
                                                    if (isset($row->details)){
                                                        echo $row->details;
                                                    }
                                                ?>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-right">
                                            <?php if(! file_exists($is_module_available)): ?>
                                                <div class="row">
                                                    <div class="col-lg-12 ">
                                                        <a class="primary-btn fix-gr-bg text-nowrap" target="_blank"
                                                           href="https://aorasoft.com/">   <?php echo e(__('general_settings.buy_now')); ?></a>

                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(file_exists($is_module_available)): ?>
                                                <?php
                                                    $system_settings= \Modules\GeneralSetting\Entities\GeneralSetting::first();

                                                     $is_moduleV= $is_data;
                                                     $configName = $row->name;
                                                     $availableConfig=$system_settings->$configName;


                                                ?>

                                                <?php if(@$availableConfig==0 || @@$is_moduleV->purchase_code== null): ?>
                                                    <input type="hidden" name="name" value="<?php echo e(@$configName); ?>">


                                                <?php else: ?>
                                                    <div class="row">
                                                        <div class="col-lg-12 ">
                                                            <?php if('RolePermission' != $row->name && 'TemplateSettings' != $row->name ): ?>
                                                                <div id="waiting_loader"
                                                                     class="waiting_loader<?php echo e(@$row->name); ?>">


                                                                </div>
                                                                    <?php endif; ?>

                                                        </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </td>


                                    </tr>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade admin-query" id="add_module">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('general_settings.add_new_update_module')); ?></h4>
                    <button type="button" class="close " data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_form" action="<?php echo e(route('modulemanager.uploadModule')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="primary_input mb-35">

                                    <div class="primary_file_uploader">
                                        <input class="primary-input filePlaceholder" type="text"
                                               id="document_file_place"
                                               placeholder="<?php echo e(__('general_settings.select_module_file')); ?>"
                                               readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file"><?php echo e(__('common.browse')); ?></label>
                                            <input type="file" class="d-none fileUpload" name="module" accept="application/zip" id="document_file">
                                        </button>
                                    </div>
                                    <?php $__errorArgs = ['module'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger" id="module_error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-12 text-center pt_15">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                        type="submit"><i
                                        class="ti-check"></i> <?php echo e(__('common.save')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade admin-query" id="Verify">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Module Verification</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                </div>

                <div class="modal-body">
                    <?php echo e(Form::open(['id'=>"content_form",'class' => 'form-horizontal', 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST'])); ?>

                    <input type="hidden" name="name" value="" id="moduleName">

                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="user">Envato Email Address :</label>
                        <input type="text" class="form-control " name="envatouser"
                               required="required"
                               placeholder="Enter Your Envato Email Address"
                               value="<?php echo e(old('envatouser')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="purchasecode">Envato Purchase Code:</label>
                        <input type="text" class="form-control" name="purchase_code"
                               required="required"
                               placeholder="Enter Your Envato Purchase Code"
                               value="<?php echo e(old('purchasecode')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="domain">Installation Path:</label>
                        <input type="text" class="form-control"
                               name="installationdomain" required="required"
                               placeholder="Enter Your Installation Domain"
                               value="<?php echo e(url('/')); ?>" readonly>
                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg submit">
                                <span class="ti-check"></span>
                                <?php echo e(__('general_settings.verify')); ?>

                            </button>
                            <button type="button" class="primary-btn fix-gr-bg submitting" style="display: none">
                                <i class="fas fa-spinner fa-pulse"></i>
                                Verifying
                            </button>
                        </div>
                    </div>

                    <?php echo e(Form::close()); ?>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset(asset_path('backend/js/module.js'))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(asset_path('vendor/spondonit/js/parsley.min.js'))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(asset_path('vendor/spondonit/js/function.js'))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset(asset_path('vendor/spondonit/js/common.js'))); ?>"></script>
    <script type="text/javascript">
        _formValidation('content_form');
    </script>

    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                $(document).on('submit', '#add_form', function(event){
                    let fileCheck = $('#document_file').val();
                    $('#module_error').text("");
                    if(fileCheck == ''){
                        $('#module_error').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                        event.preventDefault();
                    }
                });

                $(document).on('change', '#document_file', function(event){
                    getFileName($(this).val(),'#document_file_place');
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/ModuleManager/Resources/views/manage_module.blade.php ENDPATH**/ ?>