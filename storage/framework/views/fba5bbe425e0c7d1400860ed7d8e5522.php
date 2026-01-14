<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    <?php echo e(__('general_settings.upload_sql_file')); ?>

                                </h3>
                            </div>
                            <div class="mt-40 pt-30">
                                <form method="POST" action="<?php echo e(route('backup.import')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="white-box">
                                        <div class="add-visitor">
                                            <div class="row  mt-25">
                                                <div class="col-lg-12">

                                                    <div class="primary_input mb-15">
                                                        <div class="primary_file_uploader">
                                                            <input class="primary-input" type="text"
                                                                   id="placeholderFileOneName" placeholder="<?php echo e(__('common.browse_file')); ?>"
                                                                   readonly="">
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="document_file_1"><?php echo e(__("common.browse")); ?> </label>
                                                                <input type="file" class="d-none" name="db_file"
                                                                       id="document_file_1">

                                                            </button>
                                                            <?php $__errorArgs = ['db_file'];
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
                                            </div>
                                            <?php if(permissionCheck('backup.import')): ?>
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                            title="">
                                                        <span class="ti-check"></span>
                                                        <?php echo e(__('common.update')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                             <span class="text-danger"> <?php echo e(__('common.no_action_permitted')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 ">
                    <div class="row">
                        <div class="col-lg-12 no-gutters">

                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo app('translator')->get('general_settings.database_backup_list'); ?></h3>

                                <ul class="pull-right">
                                    <?php if(permissionCheck('backup.create')): ?>
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg"
                                           href="<?php echo e(route('backup.create')); ?>"><i
                                                class="ti-plus"></i><?php echo e(__('general_settings.generate_new_backup')); ?></a></li>
                                    <?php endif; ?>
                                </ul>


                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-10">
                        <div class="col-lg-12 mt-10">

                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table ">
                                    <!-- table-responsive -->
                                    <div class="mt-30">
                                        <table class="table Crm_table_active3">
                                            <thead>

                                            <tr>
                                                <th width="30%"><?php echo app('translator')->get('common.sl'); ?></th>
                                                <th width="30%"><?php echo app('translator')->get('common.date'); ?></th>
                                                <th width="40%"><?php echo app('translator')->get('common.file_name'); ?></th>
                                                <th width="40%"><?php echo app('translator')->get('common.download'); ?></th>
                                                <th width="40%"><?php echo app('translator')->get('common.action'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $__currentLoopData = $allBackup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(getNumberTranslate(++$key)); ?></td>
                                                    <td class=""><?php echo e(dateConvert(substr($value, 0, 10))); ?></td>
                                                    <td><?php echo e(str_replace(' ', '-',app('general_setting')->site_title)."_db_$value".'.sql'); ?></td>
                                                    <td class="text-center">
                                                       <?php if(!config('app.sync')): ?>
                                                         <a href="<?php echo e(asset('public/database-backup/'.$value.'/'.$value.'-dump.sql')); ?>"
                                                            download="<?php echo e(str_replace(' ', '-',app('general_setting')->site_title)."_db_$value".'.sql'); ?>"><i
                                                                class="fa fa-download"></i></a>
                                                       <?php else: ?>

                                                        <span class="cs-pointer" data-toggle="tooltip" title="Restricted in demo mode"><i
                                                                class="fa fa-download"></i>

                                                        </span></a>

                                                       <?php endif; ?>

                                                            </td>

                                                    <td>

                                                        <?php if(permissionCheck('backup.delete')): ?>
                                                           <span>
                                                                <a data-value="<?php echo e(route('backup.delete', $value)); ?>" href=""
                                                                   class="primary-btn radius_30px mr-10 fix-gr-bg delete_data"
                                                                    ><?php echo app('translator')->get('common.delete'); ?></a>
                                                           </span>
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
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('change', '#document_file_1', function(){
                    getFileName($(this).val(),'#placeholderFileOneName');
                });

                $(document).on('click', '.delete_data', function(event){
                    event.preventDefault();
                    let value = $(this).data('value');
                    confirm_modal(value);
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Backup/Resources/views/backup/index.blade.php ENDPATH**/ ?>