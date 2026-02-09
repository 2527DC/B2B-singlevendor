<div class="box_header common_table_header">
    <div class="main-title d-md-flex">
        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('setup.add_new_tag')); ?></h3>
    </div>
</div>
<form action="#" method="POST" enctype="multipart/form-data" id="tagForm">
    <div class="white_box_50px box_shadow_white mb-20">
        <div class="row">
            <div class="col-lg-12">
                <div class="primary_input mb-15">
                    <label class="primary_input_label" for=""> <?php echo e(__("common.name")); ?> *</label>
                    <input class="primary_input_field" name="name" id="name" placeholder="<?php echo e(__("common.name")); ?>" type="text" value="<?php echo e(old('name')); ?>" required="1">
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <?php if(permissionCheck('tags.create')): ?>
                <button class="primary_btn_2 mt-2"><i class="ti-check"></i><?php echo e(__("common.save")); ?> </button>
                <?php else: ?>
                <span class=" alert alert-danger"><?php echo e(__('common.not_permit')); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /var/www/DhatriProduction/Modules/Setup/Resources/views/tags/create.blade.php ENDPATH**/ ?>