<?php $__env->startSection('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/attendance/css/style.css'))); ?>" />
<style>
    .primary-btn.primary-circle {

    padding: 9px !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">
                        <form class="" action="<?php echo e(route('holidays.store')); ?>" method="POST"><?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.year')); ?> <span class="text-danger">*</span></label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="<?php echo e(__('common.year')); ?>"
                                                               class="primary_input_field primary-input datepicker form-control"
                                                               type="text" id="year"
                                                               name="year" value="<?php echo e(getNumberTranslate(date('Y'))); ?>"
                                                               autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <button class="btn-date" data-id="#year" type="button">
                                                    <i class="ti-calendar"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if(permissionCheck('last.year.data')): ?>
                                <div class="row">
                                    <div class="col-lg-12 text-right mb-2 mt-3">
                                        <a id="copy_previous_year_btn" href="<?php echo e(route('last.year.data', date('Y'))); ?>"
                                           class="primary-btn btn-sm fix-gr-bg"><?php echo e(__('hr.copy_previous_year_settings')); ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table ">

                                    <!-- table-responsivaae -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody class="holiday_table">
                                            <tr>
                                                <td>
                                                    <div class="primary_input mb-15 min-width-150">
                                                        <label class="primary_input_label"
                                                               for=""><?php echo e(__('hr.holiday_name')); ?></label>
                                                        <input type="text" name="holiday_name[]" id="holiday_row_1_name"
                                                               class="primary_input_field"
                                                               placeholder="<?php echo e(__('hr.holiday_name')); ?>" value="" required>
                                                        <span
                                                            class="text-danger"><?php echo e($errors->first('holiday_name')); ?></span>
                                                    </div>
                                                </td>
                                                <td id="holiday_row_1_type">
                                                    <div class="primary_input mb-15 min-width-150">
                                                        <label class="primary_input_label"
                                                               for=""><?php echo e(__('common.select_type')); ?> <span class="text-danger">*</span></label>
                                                        <select class="primary_select mb-15 type"
                                                                name="type[]">
                                                            <option value="0"><?php echo e(__('common.single_day')); ?></option>
                                                            <option value="1"><?php echo e(__('common.multiple_day')); ?></option>
                                                        </select>
                                                        <span class="text-danger"><?php echo e($errors->first('type')); ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="single_date">
                                                        <div class="primary_input mb-15 min-width-150">
                                                            <label class="primary_input_label"
                                                                   for=""><?php echo e(__('common.date')); ?>

                                                                <span class="text-danger">*</span></label>
                                                            <div class="primary_datepicker_input">
                                                                <div class="no-gutters input-right-icon">
                                                                    <div class="col">
                                                                        <div class="">
                                                                            <input placeholder="<?php echo e(__('common.date')); ?>" id="single_date"
                                                                                   class="primary_input_field primary-input date form-control"
                                                                                   type="text"
                                                                                   name="date[]"
                                                                                   value="<?php echo e(dateConvert(date('m/d/Y'))); ?>"
                                                                                   autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn-date" data-id="#single_date" type="button">
                                                                        <i class="ti-calendar"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="multiple_date d-none">
                                                        <div class="primary_input mb-15 min-width-150">
                                                            <label class="primary_input_label"
                                                                   for=""><?php echo e(__('common.start_date')); ?>

                                                                <span class="text-danger">*</span></label>
                                                            <div class="primary_datepicker_input">
                                                                <div class="no-gutters input-right-icon">
                                                                    <div class="col">
                                                                        <div class="">
                                                                            <input placeholder="<?php echo e(__('common.date')); ?>" id="first_row_start_date"
                                                                                   class="primary_input_field primary-input date form-control"
                                                                                   type="text"
                                                                                   name="start_date[]"
                                                                                   value="<?php echo e(dateConvert(date('m/d/Y'))); ?>"
                                                                                   autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn-date" data-id="#first_row_start_date" type="button">
                                                                        <i class="ti-calendar"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="text-danger"><?php echo e($errors->first('start_date')); ?></span>
                                                        </div>
                                                        <div class="primary_input mb-15 min-width-150">
                                                            <label class="primary_input_label"
                                                                   for=""><?php echo e(__('common.end_date')); ?>

                                                                <span class="text-danger">*</span></label>
                                                            <div class="primary_datepicker_input">
                                                                <div class="no-gutters input-right-icon">
                                                                    <div class="col">
                                                                        <div class="">
                                                                            <input placeholder="<?php echo e(__('common.date')); ?>" id="end_row_start_date"
                                                                                   class="primary_input_field primary-input date form-control"
                                                                                   type="text"
                                                                                   name="end_date[]"
                                                                                   value="<?php echo e(dateConvert(date('m/d/Y'))); ?>"
                                                                                   autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn-date" data-id="#end_row_start_date" type="button">
                                                                        <i class="ti-calendar"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="text-danger"><?php echo e($errors->first('end_date')); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                        <a class="primary-btn primary-circle fix-gr-bg text-white" id="add_row_btn"
                                                           href=""> <i class="ti-plus"></i></a>

                                                </td>
                                            </tr>
                                            <?php if(session()->has('holidays')): ?>
                                                <?php
                                                    $data = session()->get('holidays');
                                                ?>
                                                <?php $__currentLoopData = $data['holiday_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="add_row">
                                                        <td>
                                                            <div class="primary_input mb-15 min-width-150">
                                                                <label class="primary_input_label"
                                                                       for=""><?php echo e(__('hr.holiday_name')); ?></label>
                                                                <input type="text" name="holiday_name[]"
                                                                       class="primary_input_field"
                                                                       placeholder="<?php echo e(__('hr.holiday_name')); ?>"
                                                                       value="<?php echo e($data['holiday_name'][$key]); ?>" required>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('holiday_name')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="primary_input mb-15 min-width-150">
                                                                <label class="primary_input_label"
                                                                       for=""><?php echo e(__('common.select_type')); ?> <span class="text-danger">*</span></label>
                                                                <select class="primary_select mb-15 type" name="type[]">
                                                                    <option
                                                                        value="0" <?php echo e($data['type'][$key] == 0 ? 'selected' : ''); ?>><?php echo e(__('common.single_day')); ?></option>
                                                                    <option
                                                                        value="1" <?php echo e($data['type'][$key] == 1 ? 'selected' : ''); ?>><?php echo e(__('common.multiple_day')); ?></option>
                                                                </select>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('type')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="single_date <?php if($data['type'][$key] == 1): ?> d-none <?php endif; ?>">
                                                                <div class="primary_input mb-15 min-width-150">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text" name="date[]"
                                                                                           value="<?php echo e(dateConvert($data['date'][$key])); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="multiple_date <?php if($data['type'][$key] == 0): ?> d-none <?php endif; ?>">
                                                                <div class="primary_input mb-15 min-width-150">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.start_date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text"
                                                                                           name="start_date[]"
                                                                                           value="<?php echo e(dateConvert($data['start_date'][$key])); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="text-danger"><?php echo e($errors->first('start_date')); ?></span>
                                                                </div>
                                                                <div class="primary_input mb-15 min-width-150">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.end_date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text" name="end_date[]"
                                                                                           value="<?php echo e(dateConvert($data['end_date'][$key])); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('end_date')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td><a href="javascript:void(0)" class="delete_row"><i class="ti-trash"></i></a></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php else: ?>
                                                <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr class="add_row">
                                                        <td>
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label"
                                                                       for=""><?php echo e(__('hr.holiday_name')); ?></label>
                                                                <input type="text" name="holiday_name[]"
                                                                       class="primary_input_field"
                                                                       placeholder="<?php echo e(__('hr.holiday_name')); ?>"
                                                                       value="<?php echo e($holiday->name); ?>" required>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('holiday_name')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label"
                                                                       for=""><?php echo e(__('common.select_type')); ?> <span class="text-danger">*</span></label>
                                                                <select class="primary_select mb-15 type" name="type[]">
                                                                    <option
                                                                        value="0" <?php echo e($holiday->type == 0 ? 'selected' : ''); ?>><?php echo e(__('common.single_day')); ?></option>
                                                                    <option
                                                                        value="1" <?php echo e($holiday->type == 1 ? 'selected' : ''); ?>><?php echo e(__('common.multiple_day')); ?></option>
                                                                </select>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('type')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="single_date <?php if($holiday->type == 1): ?> d-none <?php endif; ?>">
                                                                <div class="primary_input mb-15">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text" name="date[]"
                                                                                           value="<?php echo e(dateConvert($holiday->date)); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="text-danger"><?php echo e($errors->first('date')); ?></span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                $start_date = '';
                                                                $end_date = '';
                                                                $date = [];
                                                                if ($holiday->type == 1)
                                                                    {
                                                                        $date = explode(',',$holiday->date);
                                                                        $start_date = $date[0];
                                                                        $end_date = $date[1];
                                                                    }
                                                            ?>
                                                            <div class="multiple_date <?php if($holiday->type == 0): ?> d-none <?php endif; ?>">
                                                                <div class="primary_input mb-15">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.start_date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text"
                                                                                           name="start_date[]"
                                                                                           value="<?php echo e(dateConvert(!empty($date) ? date('m/d/Y',strtotime($date[0]))  : date('m/d/y'))); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="text-danger"><?php echo e($errors->first('start_date')); ?></span>
                                                                </div>
                                                                <div class="primary_input mb-15">
                                                                    <label class="primary_input_label"
                                                                           for=""><?php echo e(__('common.end_date')); ?>

                                                                        <span class="text-danger">*</span></label>
                                                                    <div class="primary_datepicker_input">
                                                                        <div class="no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="">
                                                                                    <input placeholder="<?php echo e(__('common.date')); ?>"
                                                                                           class="primary_input_field primary-input date form-control"
                                                                                           type="text" name="end_date[]"
                                                                                           value="<?php echo e(dateConvert(!empty($date) ? date('m/d/Y',strtotime($date[1])) : date('m/d/y'))); ?>"
                                                                                           autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <button class="" type="button">
                                                                                <i class="ti-calendar"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="text-danger"><?php echo e($errors->first('end_date')); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="primary-btn primary-circle delete_row fix-gr-bg text-white"
                                                                   href="javascript:void(0)"> <i
                                                                        class="ti-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php if(permissionCheck('holidays.store')): ?>
                                <div class="row justify-content-center mt-2">
                                    <button type="submit"
                                            class="primary-btn btn-sm fix-gr-bg"><?php echo e(__('common.submit')); ?></button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>

        (function($){
            "use strict";

            $(document).ready(function(){
                $(".primary-input.datepicker").datepicker({
                    autoclose: true,
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years"
                });
                $(document).on('change', '#year', function(){
                    changeYear();
                });

                $(document).on('click', '#add_row_btn', function(event){
                    event.preventDefault();
                    addRow();
                });

                $(document).on('change', '.type', function () {
                    let value = $(this).val();
                    var whichtr = $(this).closest("tr");
                    if (value == 0) {
                        whichtr.find($('.single_date')).removeClass('d-none');
                        whichtr.find($('.multiple_date')).addClass('d-none');
                    } else {
                        whichtr.find($('.single_date')).addClass('d-none');
                        whichtr.find($('.multiple_date')).removeClass('d-none');
                    }
                });

                $(document).on('click', '.delete_row', function () {
                    var whichtr = $(this).closest("tr");
                    whichtr.remove();
                });

                function changeYear() {
                    let year = $('#year').val();
                    $('#pre-loader').removeClass('d-none');
                    let baseUrl = $('#url').val();
                    let pre_year_route = baseUrl + "/attendance/last-year-data/" + year;
                    $('#copy_previous_year_btn').attr('href', pre_year_route);
                    $.ajax({
                        url: "<?php echo e(route('add.row')); ?>",
                        method: "POST",
                        data: {
                            year: year,
                            _token: "<?php echo e(csrf_token()); ?>",
                        },
                        success: function (result) {
                            $(".add_row").each(function (index, element) {
                                element.remove();
                            });
                            $(".holiday_table").append(result);
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            $('#pre-loader').addClass('d-none');
                            toastr.error('<?php echo e(__("common.error_message")); ?>');
                        }
                    });
                }

                function addRow() {
                    $('#pre-loader').removeClass('d-none');
                    $.ajax({
                        url: "<?php echo e(route('add.row')); ?>",
                        method: 'POST',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                        },
                        success: function (data) {
                            $(".holiday_table").append(data);
                            $('select').niceSelect();
                            $(".date").datepicker();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            $('#pre-loader').addClass('d-none');
                            toastr.error('<?php echo e(__("common.error_message")); ?>');
                        }
                    })
                }

            });
        })(jQuery);


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Attendance/Resources/views/holiday_setup/index.blade.php ENDPATH**/ ?>