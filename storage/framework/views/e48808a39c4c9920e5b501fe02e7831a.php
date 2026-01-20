<div class="modal fade" id="report_modal" tabindex="-1" aria-labelledby="report_modal_label" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo e(route('frontend.submit.report')); ?>" method="post">
        <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 text-upper" id="report_modal_label"><?php echo e(__('product.report_this_product')); ?></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo csrf_field(); ?>
                <?php if(!empty($reasons)): ?>
                <div class="form-group ">
                    <label for=""><?php echo e(__("product.reason")); ?></label>
                    <select name="reason_id" id="reason_id" class="amaz_select2 mb_10 w-100">
                        <option value="">Please select</option>
                        <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for=""><?php echo e(__('common.email')); ?></label>
                    <input type="email" name="email" class="primary_input3 style5 radius_3px" value="<?php echo e(auth()->check() ? auth()->user()->email:''); ?>">
                    <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                    <input type="hidden" name="user_id" value="<?php echo e(auth()->check() ? auth()->id():""); ?>">
                </div>

                <div class="form-group">
                    <label for=""><?php echo e(__('product.comment')); ?></label>
                    <textarea name="comment" id="comment" class="primary_textarea4 radius_5px mb_25" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="amaz_primary_btn3"><?php echo e(__('product.report_product')); ?></button>
            </div>
          </div>
      </form>
    </div>
  </div>
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/components/product_report.blade.php ENDPATH**/ ?>