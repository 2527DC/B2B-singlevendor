
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center white-box">
                <div class="col-12">
                    <div class="col-xl-12">
                        <label class="primary_input_label" for=""><?php echo e(__('general_settings.active_file_storage')); ?></label>
                        <ul id="" class="permission_list sms_list">
                            <?php $__currentLoopData = $cloud_hosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $host): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <label class="primary_checkbox d-flex mr-12 ">
                                        <input class="file_storage" data-type="<?php echo e($host->type); ?>" name="file_storage_type" type="radio" id="file_host<?php echo e($key); ?>" value="<?php echo e($host->type.'-'.$host->id); ?>" <?php if($host->status != 0): ?> checked <?php endif; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <p><?php echo e($host->type); ?></p>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <form action="<?php echo e(route('DefaultStorageSettingSubmit')); ?>" method="POST" id="DefaultStorage">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="file_storage" id="file_storage_default">
                        <div class="col-12">
                            <div class="submit_btn text-center">
                                <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                        class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                            </div>
                        </div>
                    </form>

                    <?php if(isModuleActive('AmazonS3')): ?>
                    <form action="<?php echo e(route('AwsS3SettingSubmit')); ?>" method="POST" id="AmazonS3">
                        <?php echo csrf_field(); ?>
                        <?php echo $__env->make('amazons3::setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <input type="hidden" name="file_storage" id="file_storage_S3">
                        <div class="col-12 mb-10 pt_15">
                            <div class="submit_btn text-center">
                                <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                        class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
                    <?php if(isModuleActive('StorageCDN')): ?>
                        <form action="<?php echo e(route('DigitalOceanSettingSubmit')); ?>" method="POST" id="DigitalOcean">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::digitalocean', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_do">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('GoogleDriveSettingSubmit')); ?>" method="POST" id="GoogleDrive">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::googledrive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_google_drive">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('WasabiStorageSettingSubmit')); ?>" method="POST" id="Wasabi">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::wasabi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_wasabi">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('BackblazeStorageSettingSubmit')); ?>" method="POST" id="Backblaze">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::backblaze', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_backblaze">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('DropboxStorageSettingSubmit')); ?>" method="POST" id="Dropbox">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::dropbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_dropbox">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('GoogleCloudStorageSettingSubmit')); ?>" method="POST" id="GoogleCloud">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::googlecloud', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_googlecloud">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>
                        <form action="<?php echo e(route('BunnyCDNStorageSettingSubmit')); ?>" method="POST" id="BunnyCDN">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::bunny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_bunnycdn">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo e(route('ContaboStorageSettingSubmit')); ?>" method="POST" id="Contabo">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('storagecdn::contabo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="file_storage" id="file_storage_contabo">
                            <div class="col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="primary_btn_large d-none" data-toggle="tooltip"><i
                                            class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                     <div class="col-12 mb-10">
                        <div class="submit_btn text-center">
                            <button type="button" id="submit_storage" class="primary_btn_large" data-toggle="tooltip"><i
                                    class="ti-check"></i> <?php echo e(__('common.save')); ?></button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/javascript">
        (function($){
            "use strict";

            $(document).ready(function() {
                $(document).on('click', '#submit_storage', function(){
                 var file_storage = $("input[name='file_storage_type']:checked").val();
                 file_storage = file_storage.split('-');
               if (file_storage[0] == 'DigitalOcean') {
                $('#file_storage_do').val(file_storage[1]) 
                $('#DigitalOcean').submit();
               }
               else if (file_storage[0] == 'AmazonS3') {
                $('#file_storage_S3').val(file_storage[1]) 
                $('#AmazonS3').submit();
               }
               else if (file_storage[0] == 'GoogleDrive') {
                $('#file_storage_google_drive').val(file_storage[1]) 
                $('#GoogleDrive').submit();
               }
               else if (file_storage[0] == 'Wasabi') {
                $('#file_storage_wasabi').val(file_storage[1]) 
                $('#Wasabi').submit();
               }
               else if (file_storage[0] == 'Backblaze') {
                $('#file_storage_backblaze').val(file_storage[1]) 
                $('#Backblaze').submit();
               }
               else if (file_storage[0] == 'Dropbox') {
                $('#file_storage_dropbox').val(file_storage[1]) 
                $('#Dropbox').submit();
               }
               else if (file_storage[0] == 'GoogleCloud') {
                $('#file_storage_googlecloud').val(file_storage[1]) 
                $('#GoogleCloud').submit();
               }
               else if (file_storage[0] == 'BunnyCDN') {
                $('#file_storage_bunnycdn').val(file_storage[1]) 
                $('#BunnyCDN').submit();
               }
               else if (file_storage[0] == 'Contabo') {
                $('#file_storage_contabo').val(file_storage[1]) 
                $('#Contabo').submit();
               }
               else{
                $('#file_storage_default').val(file_storage[1]) 
                $('#DefaultStorage').submit();
               }
                });
                file_storage_form();
                do_file_storage_form();
                google_drive_file_storage_form();
                wasabi_file_storage_form();
                backblaze_file_storage_form();
                dropbox_file_storage_form();
                googlecloud_file_storage_form();
                bunnycdn_file_storage_form();
                contabo_file_storage_form();

                $(document).on('change','.file_storage', function(){
                    file_storage_form();
                    do_file_storage_form();
                    google_drive_file_storage_form();
                    wasabi_file_storage_form();
                    backblaze_file_storage_form();
                    dropbox_file_storage_form();
                    googlecloud_file_storage_form();
                    bunnycdn_file_storage_form();
                    contabo_file_storage_form();
                });

                function file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let aws3Div = $('#aws3_host_div');
                    if (file_storage_type === 'AmazonS3') {
                        aws3Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'aws3_hidden_field',
                            name: 'aws3',
                            value: 1
                        })
                        hiddenInput.appendTo('#aws3_hidden_div');
                    }
                    else{
                        aws3Div.hide();
                        $('#aws3_hidden_div').html('');
                    }
                }
                
                function do_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let doDiv = $('#do_host_div');
                    if (file_storage_type === 'DigitalOcean') {
                        doDiv.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'do_hidden_field',
                            name: 'digitalocean',
                            value: 1
                        })
                        hiddenInput.appendTo('#do_hidden_div');
                    }
                    else{
                        doDiv.hide();
                        $('#do_hidden_div').html('');
                    }
                }
                function google_drive_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let google_drive_Div = $('#google_drive_host_div');
                    if (file_storage_type === 'GoogleDrive') {
                        google_drive_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'google_drive_hidden_div',
                            name: 'googledrive',
                            value: 1
                        })
                        hiddenInput.appendTo('#google_drive_hidden_div');
                    }
                    else{
                        google_drive_Div.hide();
                        $('#google_drive_hidden_div').html('');
                    }
                }
                function wasabi_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let wasabi_Div = $('#wasabi_host_div');
                    if (file_storage_type === 'Wasabi') {
                        wasabi_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'wasabi_hidden_div',
                            name: 'wasabi',
                            value: 1
                        })
                        hiddenInput.appendTo('#wasabi_hidden_div');
                    }
                    else{
                        wasabi_Div.hide();
                        $('#wasabi_hidden_div').html('');
                    }
                }
                function backblaze_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let backblaze_Div = $('#backblaze_host_div');
                    if (file_storage_type === 'Backblaze') {
                        backblaze_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'backblaze_hidden_div',
                            name: 'backblaze',
                            value: 1
                        })
                        hiddenInput.appendTo('#backblaze_hidden_div');
                    }
                    else{
                        backblaze_Div.hide();
                        $('#backblaze_hidden_div').html('');
                    }
                }
                function dropbox_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let dropbox_Div = $('#dropbox_host_div');
                    if (file_storage_type === 'Dropbox') {
                        dropbox_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'dropbox_hidden_div',
                            name: 'dropbox',
                            value: 1
                        })
                        hiddenInput.appendTo('#dropbox_hidden_div');
                    }
                    else{
                        dropbox_Div.hide();
                        $('#dropbox_hidden_div').html('');
                    }
                }
                function googlecloud_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let googlecloud_Div = $('#google_cloud_host_div');
                    if (file_storage_type === 'GoogleCloud') {
                        googlecloud_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'google_cloud_hidden_div',
                            name: 'googlecloud',
                            value: 1
                        })
                        hiddenInput.appendTo('#google_cloud_hidden_div');
                    }
                    else{
                        googlecloud_Div.hide();
                        $('#google_cloud_hidden_div').html('');
                    }
                }
                function bunnycdn_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let bunnycdn_Div = $('#bunny_cdn_host_div');
                    if (file_storage_type === 'BunnyCDN') {
                        bunnycdn_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'bunny_cdn_hidden_div',
                            name: 'bunnycdn',
                            value: 1
                        })
                        hiddenInput.appendTo('#bunny_cdn_hidden_div');
                    }
                    else{
                        bunnycdn_Div.hide();
                        $('#bunny_cdn_hidden_div').html('');
                    }
                }
                function contabo_file_storage_form(){
                    let file_storage_type = $('.file_storage:checked').data("type");
                    let contabo_Div = $('#contabo_host_div');
                    if (file_storage_type === 'Contabo') {
                        contabo_Div.show();
                        let hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: 'contabo_hidden_div',
                            name: 'contabo',
                            value: 1
                        })
                        hiddenInput.appendTo('#contabo_hidden_div');
                    }
                    else{
                        contabo_Div.hide();
                        $('#contabo_hidden_div').html('');
                    }
                }
            });
        })(jQuery);

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/cloud_storage_index.blade.php ENDPATH**/ ?>