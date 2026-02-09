<?php
    $same_state_gst = json_decode($group->same_state_gst);
    $same_state_gst = (array)$same_state_gst;
    $outsite_state_gst = json_decode($group->outsite_state_gst);
    $outsite_state_gst = (array)$outsite_state_gst;
?>
<table class="table-borderless clone_line_table">
    <tr>
        <td><strong><?php echo e(__('Same State TAX/GST List For: ')); ?> <?php echo e($group->name); ?></strong></td>
    </tr>
    <?php $__currentLoopData = $same_state_gst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst_id => $percent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $gst = \Modules\GST\Entities\GstTax::find($gst_id);
        ?>
        <tr>
            <td class="info_tbl"><?php echo e($gst->name); ?></td>
            <td>: <?php echo e($percent); ?> %</td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><strong><?php echo e(__('Outsite State TAX/GST List For: ')); ?> <?php echo e($group->name); ?></strong></td>
    </tr>
    <?php $__currentLoopData = $outsite_state_gst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst_id => $percent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $gst = \Modules\GST\Entities\GstTax::find($gst_id);
        ?>
        <tr>
            <td class="info_tbl"><?php echo e(@$gst->name); ?></td>
            <td>: <?php echo e($percent); ?> %</td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table><?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/components/_group_gst_list.blade.php ENDPATH**/ ?>