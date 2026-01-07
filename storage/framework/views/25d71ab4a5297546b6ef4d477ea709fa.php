<?php $__env->startSection('mainContent'); ?>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('hr.select_criteria')); ?></h3>
                            <div class="mr-3"><?php echo e(__('hr.present')); ?>: <span class="text-success"><?php echo e(__('hr.P')); ?></span></div>
                            <div class="mr-3"><?php echo e(__('hr.late')); ?>: <span class="text-warning"><?php echo e(__('hr.L')); ?></span></div>
                            <div class="mr-3"><?php echo e(__('hr.absent')); ?>: <span class="text-danger"><?php echo e(__('hr.A')); ?></span></div>
                            <div class="mr-3"><?php echo e(__('hr.holiday')); ?>: <span class="text-dark"><?php echo e(__('hr.H')); ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">
                        <form class="" action="<?php echo e(route('attendance_report.search')); ?>" method="GET">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.select_role')); ?> *</label>
                                        <select class="primary_select mb-15" name="role_id" id="role_id">
                                            <option selected disabled><?php echo e(__('common.choose_one')); ?></option>
                                            <?php if(isset($r)): ?>
                                            <option value="0" <?php if($r == 0): ?> selected <?php endif; ?>><?php echo e(__('common.all')); ?></option>
                                            <?php else: ?>
                                            <option value="0"><?php echo e(__('common.all')); ?></option>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($r)): ?>
                                                    <option value="<?php echo e($role->id); ?>"<?php if($r == $role->id): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('role_id')); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('hr.select_month')); ?></label>
                                        <select class="primary_select mb-15" name="month" id="month">
                                            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($m)): ?>
                                                    <option value="<?php echo e($month); ?>"<?php if($m == $month): ?> selected <?php endif; ?>><?php echo e($month); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($month); ?>" <?php echo e($month == \Carbon\Carbon::now()->monthName ? 'selected' : ''); ?>><?php echo e($month); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('month')); ?></span>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="year"><?php echo e(__('common.year')); ?> *</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="<?php echo e(__('common.year')); ?>"
                                                               class="primary_input_field primary-input datepicker form-control"
                                                               type="text" id="year"
                                                               name="year" value="<?php if(isset($y)): ?> <?php echo e($y); ?> <?php else: ?> <?php echo e(getNumberTranslate(date('Y'))); ?> <?php endif; ?>"
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
                                    <button type="submit" class="primary-btn btn-sm fix-gr-bg pull-right" id="save_button_parent"><i class="ti-search"></i><?php echo e(__('common.search')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <?php
                    $max_col = 0;
                ?>
                <?php if(isset($report_dates)): ?>
                    <div class="col-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">

                                <ul class="d-flex">
                                    <li><a target="_blank" download class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('attendance_report_print', [$r, $m, $y])); ?>">
                                    <i class="ti-printer"></i><?php echo e(__('hr.attendance_report')); ?> <?php echo e(__('common.print')); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table ">
                                <!-- table-responsive -->
                                <div class="">
                                    <table class="table Crm_table_active3">
                                        <thead>
                                            <tr>
                                                <th scope="col"><?php echo e(__('common.id')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.staff')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.staff_id')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.P')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.L')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.A')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.H')); ?></th>
                                                <th scope="col"><?php echo e(__('hr.present')); ?></th>
                                                <?php $__currentLoopData = $report_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report_date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th scope="col"><?php echo e($report_date->date); ?></th>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $total_attendance = 0;
                                                    $total_days_of_month = count($report_dates);
                                                    $absent = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'A'));
                                                    $late = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'L'));
                                                    $half_day = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'F'));
                                                    $present = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'P'));
                                                    $Totalpresent = ($late + $half_day + $present);
                                                    if ($total_days_of_month > 0) {
                                                        $total_attendance = ($Totalpresent * 100) / $total_days_of_month;
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo e(getNumberTranslate($key + 1)); ?></td>
                                                    <td><?php echo e($user->getFullNameAttribute()); ?></td>
                                                    <td>
                                                        <?php if($user->staff): ?>
                                                            <?php echo e($user->staff->employee_id); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(getNumberTranslate($present)); ?></td>
                                                    <td><?php echo e(getNumberTranslate($late)); ?></td>
                                                    <td><?php echo e(getNumberTranslate($absent)); ?></td>
                                                    <td><?php echo e(getNumberTranslate($half_day)); ?></td>
                                                    <td>
                                                        <?php if($user->attendances): ?>
                                                            <?php echo e(getNumberTranslate(number_format($total_attendance, 2))); ?> %
                                                        <?php else: ?>
                                                            <?php echo e(getNumberTranslate(00)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <?php
                                                    $attendances = $user->attendances->where('month', $m)->where('year', $y);
                                                    $max_col_1 = count($attendances);
                                                    if ($max_col < $max_col_1) {
                                                        $max_col = $max_col_1;
                                                    }else {
                                                        $max_diff = $max_col - $max_col_1;
                                                    }
                                                    ?>

                                                    <?php if(sizeof($attendances) > 0 && sizeof($attendances) == $max_col): ?>
                                                        <?php $__currentLoopData = $user->attendances->where('month', $m)->where('year', $y); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td><?php echo e(getNumberTranslate($attendance->attendance)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php elseif(sizeof($attendances) > 0 && sizeof($attendances) < $max_col): ?>
                                                        <?php $__currentLoopData = $user->attendances->where('month', $m)->where('year', $y); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td><?php echo e(getNumberTranslate($attendance->attendance)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php for($i=$max_col_1; $i < $max_col; $i++): ?>
                                                            <td></td>
                                                        <?php endfor; ?>
                                                    <?php else: ?>
                                                        <?php for($i=0; $i < $max_diff; $i++): ?>
                                                            <td></td>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Attendance/Resources/views/attendance_reports/index.blade.php ENDPATH**/ ?>