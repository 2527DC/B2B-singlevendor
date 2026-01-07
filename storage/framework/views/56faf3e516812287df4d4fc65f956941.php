<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/attendance/css/style.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($editData)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(url('/events')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('common.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30"><?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('common.edit'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('common.add'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->get('hr.event'); ?>
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php if(permissionCheck('events.update')): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['events.update', $editData], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php else: ?>
                                <?php if(permissionCheck('events.store')): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'events.store','method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.title')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <input name="title" id="title"
                                                       class="primary_input_field"
                                                       value="<?php echo e(isset($editData) ? $editData->title : old('title')); ?>"
                                                       placeholder="<?php echo e(__('common.title')); ?>" type="text">
                                                <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('hr.for_whom')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <select class="primary_select mb-25" name="for_whom"
                                                        id="employment_type">
                                                    <option
                                                        value="all" <?php echo e(isset($editData) && $editData->for_whom == 'all' ? 'selected' : ''); ?>><?php echo e(__('common.all')); ?></option>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            value="<?php echo e($role->name); ?>" <?php echo e(isset($editData) && $editData->for_whom == $role->name ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="text-danger"><?php echo e($errors->first('for_whom')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.location')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <input name="location" id="current_address"
                                                       class="primary_input_field name"
                                                       placeholder="<?php echo e(__('common.location')); ?>"
                                                       value="<?php echo e(isset($editData) ? $editData->location : old('location')); ?>" type="text">
                                                <span class="text-danger"><?php echo e($errors->first('location')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 date_of_joining_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                       for=""><?php echo e(__('common.start_date')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="07/14/2021"
                                                                       class="primary_input_field primary-input date form-control"
                                                                       id="start_date" type="text"
                                                                       name="from_date"
                                                                       value="<?php echo e(dateConvert(isset($editData)? date('m/d/Y', strtotime($editData->from_date)): date('m/d/Y'))); ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="btn-date" data-id="#start_date" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="text-danger"><?php echo e($errors->first('from_date')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 date_of_joining_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.to_date')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="07/14/2021"
                                                                       class="primary_input_field primary-input date form-control"
                                                                       type="text" name="to_date" id="date"
                                                                       value="<?php echo e(dateConvert(isset($editData)? date('m/d/Y', strtotime($editData->to_date)): date('m/d/Y'))); ?>"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="btn-date" data-id="#date" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="text-danger"><?php echo e($errors->first('to_date')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for=""><?php echo e(__('common.description')); ?></label>

                                                       <textarea name="description" id="description1" class="primary_textarea height_112" name="description" maxlength="300"><?php echo e(isset($editData) ? $editData->description : old('description')); ?></textarea>
                                                <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                       for=""><?php echo e(__('common.image')); ?> (<?php echo e(getNumberTranslate(1920)); ?>x <?php echo e(getNumberTranslate(500)); ?>)px</label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text"
                                                           id="placeholderFileOneName"
                                                           placeholder="<?php echo e(__('common.browse_file')); ?>" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="document_file_1"><?php echo e(__("common.browse")); ?> </label>
                                                        <input type="file" class="d-none" name="image" accept="image/*"
                                                               id="document_file_1">
                                                    </button>
                                                </div>
                                                <span class="text-danger"><?php echo e($errors->first('image')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="img_div">
                                                <img id="img" src="
                                                    <?php if(isset($editData)): ?>
                                                        <?php if($editData->image != null): ?>
                                                            <?php echo e(showImage($editData->image)); ?>

                                                        <?php else: ?>
                                                            <?php echo e(showImage('backend/img/default.png')); ?>

                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php echo e(showImage('backend/img/default.png')); ?>

                                                    <?php endif; ?>
                                                " alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                                <span class="ti-check"></span>
                                                <?php if(isset($editData)): ?>
                                                    <?php echo app('translator')->get('common.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('common.save'); ?>
                                                <?php endif; ?>
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(permissionCheck('events.store') || permissionCheck('events.update')): ?>
                                    <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <?php if(session()->has('message-success-delete')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('message-success-delete')); ?>

                            </div>
                        <?php elseif(session()->has('message-danger-delete')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session()->get('message-danger-delete')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0"><?php echo app('translator')->get('hr.event_list'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-40">

                            <div class="col-lg-12">
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <!-- table-responsive -->
                                        <div class="">
                                            <table class="table Crm_table_active3">

                                                <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('common.title'); ?></th>
                                                    <th><?php echo app('translator')->get('hr.for_whom'); ?></th>
                                                    <th><?php echo app('translator')->get('common.start_date'); ?></th>
                                                    <th><?php echo app('translator')->get('common.to_date'); ?></th>
                                                    <th><?php echo app('translator')->get('common.location'); ?></th>
                                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php if(isset($events)): ?>
                                                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>

                                                            <td><?php echo e(@$event->title); ?></td>
                                                            <td><?php echo e(@$event->for_whom); ?></td>

                                                            <td><?php echo e(dateConvert($event->from_date)); ?></td>


                                                            <td><?php echo e(dateConvert($event->to_date)); ?></td>

                                                            <td><?php echo e(@$event->location); ?></td>

                                                            <td>
                                                                <div class="dropdown CRM_dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                            type="button"
                                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        <?php echo e(__('common.select')); ?>

                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                                        <?php if(permissionCheck('events.update')): ?>
                                                                            <a class="dropdown-item" href="<?php echo e(route('events.edit',$event->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                                        <?php endif; ?>
                                                                        <?php if(permissionCheck('events.delete')): ?>
                                                                            <a data-value="<?php echo e(route('events.delete', $event->id)); ?>" class="dropdown-item delete_event"><?php echo e(__('common.delete')); ?></a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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
                $(document).on('click', '.delete_event', function(event){
                    let url = $(this).data('value');
                    confirm_modal(url);
                });
                $(document).on('change', '#document_file_1', function(event){
                    getFileName($(this).val(),'#placeholderFileOneName');
                    imageChangeWithFile($(this)[0],'#img');
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Attendance/Resources/views/events/index.blade.php ENDPATH**/ ?>