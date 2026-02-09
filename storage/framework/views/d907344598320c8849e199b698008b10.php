<div class="main-title d-md-flex form_div_header">
    <h3 class="mb-3 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('Edit Group')); ?> </h3>
    
</div>

<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="edit_group_form">

    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="name">
                            <?php echo e(__('common.name')); ?>

                            <span class="text-danger">*</span>
                        </label>
                        <input class="primary_input_field name" type="text" id="name" name="name" value="<?php echo e($group->name); ?>" autocomplete="off"  placeholder="<?php echo e(__('common.name')); ?>">
                        <span class="text-danger" id="error_name"></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="main-title d-flex">
                        <h4 class="mb-3 mr-30"><?php echo e(__('gst.same_state_GST')); ?></h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php
                        $same_state_gst = json_decode($group->same_state_gst);
                        $same_state_gst = (array) $same_state_gst;
                    ?>
                    <select class="primary_select mb-25" id="same_state_gist_edit" multiple>
                        <option value="0" disabled><?php echo e(__('gst.select_one_or_multiple')); ?></option>
                        <?php $__currentLoopData = $gst_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($gst->id); ?>" <?php if(array_key_exists ($gst->id, $same_state_gst)): ?> selected <?php endif; ?>><?php echo e($gst->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" id="prev_same_state" value="<?php echo e($group->same_state_gst); ?>">
                    <span class="text-danger" id="error_same_state_gst"></span>
                </div>
                <div id="same_state_gst_list_div" class="col-lg-12">
                    <?php echo $__env->make('gst::configurations.components.same_state_gst_edit',['lists' => $same_state_gst], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="col-lg-12">
                    <div class="main-title d-flex">
                        <h4 class="mb-3 mr-30"><?php echo e(__('gst.outsite_state_GST')); ?></h4>
                    </div>
                </div>
                <?php
                    $outsite_state_gst = json_decode($group->outsite_state_gst);
                    $outsite_state_gst = (array) $outsite_state_gst;
                ?>
                <div class="col-lg-12">
                    <select class="primary_select mb-25" id="outsite_state_gst_edit" multiple>
                        <option value="0" disabled><?php echo e(__('gst.select_one_or_multiple')); ?></option>
                        <?php $__currentLoopData = $gst_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($gst->id); ?>" <?php if(array_key_exists ($gst->id, $outsite_state_gst)): ?> selected <?php endif; ?>><?php echo e($gst->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="hidden" id="prev_outsite_state" value="<?php echo e($group->outsite_state_gst); ?>">
                    <span class="text-danger" id="error_outsite_state_gst"></span>
                </div>
                <div id="outsite_gst_list_div" class="col-lg-12">
                    <?php echo $__env->make('gst::configurations.components.outsite_state_gst_edit',['lists' => $outsite_state_gst], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <input type="hidden" name="id" value="<?php echo e($group->id); ?>">
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button id="create_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title=""
                        data-original-title="">
                        <span class="ti-check"></span>
                        <?php echo e(__('common.save')); ?> </button>
                </div>
            </div>
        </div>
    </div>
</form><?php /**PATH /var/www/DhatriProduction/Modules/GST/Resources/views/configurations/components/edit_group.blade.php ENDPATH**/ ?>