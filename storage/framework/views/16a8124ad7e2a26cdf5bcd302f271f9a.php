<?php if(session()->has('message-success-delete') != "" ||
session()->get('message-danger-delete') != ""): ?>
    <tr>
        <td colspan="3">
            <?php if(session()->has('message-success-delete')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('message-success-delete')); ?>

                </div>
                <?php elseif(session()->has('message-danger-delete')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('message-danger-delete')); ?>

                </div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
<?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/partials/_alertMessagePageLevelAll.blade.php ENDPATH**/ ?>