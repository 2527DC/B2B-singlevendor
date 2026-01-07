<?php if(count($users) > 0): ?>
    <form class="" action="<?php echo e(route('attendances.store')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="date" value="<?php echo e($date); ?>">
        <div class="col-lg-12 mb-2 mt-3">
            <div class="d-flex">
                <button type="submit" class="primary-btn btn-sm fix-gr-bg" id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.save')); ?></button>
            </div>
        </div>
        <div class="common_QA_section QA_section_heading_custom th_padding_l0">
            <div class="QA_table ">
                <!-- table-responsive -->
                <div class="table-responsive">
                    <table class="table Crm_table_active2 pt-0 shadow_none pt-0 pb-0">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('common.id')); ?></th>
                                <th scope="col"><?php echo e(__('common.name')); ?></th>
                                <th scope="col"><?php echo e(__('hr.attendance')); ?></th>
                                <th scope="col"><?php echo e(__('common.note')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($user->getFullNameAttribute()); ?></td>
                                    <td>
                                        <input type="hidden" name="user[]" value="<?php echo e($user->id); ?>">
                                        <div class="d-flex radio-btn-flex">
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[<?php echo e($user->id); ?>]" id="attendanceP<?php echo e($user->id); ?>" value="P" <?php if(attendanceCheck($user->id, 'P',$date)): ?> checked <?php endif; ?> class="common-radio attendanceP">
                                                <label for="attendanceP<?php echo e($user->id); ?>"><?php echo e(__('hr.present')); ?></label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[<?php echo e($user->id); ?>]" id="attendanceL<?php echo e($user->id); ?>" value="L" <?php if(attendanceCheck($user->id, 'L',$date)): ?> checked <?php endif; ?> class="common-radio">
                                                <label for="attendanceL<?php echo e($user->id); ?>"><?php echo e(__('hr.late')); ?></label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[<?php echo e($user->id); ?>]" id="attendanceA<?php echo e($user->id); ?>" value="A" <?php if(attendanceCheck($user->id, 'A',$date)): ?> checked <?php endif; ?> class="common-radio">
                                                <label for="attendanceA<?php echo e($user->id); ?>"><?php echo e(__('hr.absent')); ?></label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attendance[<?php echo e($user->id); ?>]" id="attendanceH<?php echo e($user->id); ?>" value="H" <?php if(attendanceCheck($user->id, 'H',$date)): ?> checked <?php endif; ?> class="common-radio">
                                                <label for="attendanceH<?php echo e($user->id); ?>"><?php echo e(__('hr.holiday')); ?></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="primary_input mb-25">
                                            <input name="note_<?php echo e($user->id); ?>" class="primary_input_field name note_input" <?php if(attendanceNote($user->id)): ?> value="<?php echo e(Note($user->id)); ?>" <?php else: ?> value="" <?php endif; ?> placeholder="<?php echo e(__('common.note')); ?>" type="text">
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
<?php endif; ?>
<?php /**PATH /var/www/html/mytestdhatri/Modules/Attendance/Resources/views/attendances/create_attendance.blade.php ENDPATH**/ ?>