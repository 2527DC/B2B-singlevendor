<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
                <?php if(isset($row)): ?>
                    <?php echo e(__('affiliate.Update Affiliate Link')); ?>

                <?php else: ?>
                    <?php echo e(__('affiliate.Create Affiliate Link')); ?>

                <?php endif; ?>
            </h3>
        </div>
        <?php if(isset($row)): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('affiliate.my_affiliate.update',$row->id), 'method' => 'PUT'])); ?>

        <?php else: ?>

            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'affiliate.my_affiliate.store',
            'method' => 'POST'])); ?>


        <?php endif; ?>
        <div class="white-box">
            <div class="add-visitor">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="user_name"> <?php echo e(__('affiliate.Email_or_Username')); ?> </label>
                            <input readonly  class="primary_input_field" name="user_name" id="user_name" placeholder="<?php echo e(__('affiliate.Email_or_Username')); ?>" type="text" value="<?php echo e(!empty($user->email)?$user->email:$user->username); ?>">
                            <span class="text-danger"><?php echo e($errors->first('user_name')); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="url"> <?php echo e(__('affiliate.Enter URL')); ?> <span class="required_mark_theme">*</span> </label>
                            <input autocomplete="off"  class="primary_input_field" name="url" id="url" placeholder="<?php echo e(__('affiliate.Enter URL')); ?>" type="text" value="<?php echo e(isset($row)? $row->url : old('url')); ?>">
                            <span class="text-danger"><?php echo e($errors->first('url')); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="affiliate_link"> <?php echo e(__('affiliate.Affiliate Link')); ?> </label>
                            <input readonly  class="primary_input_field" name="affiliate_link" id="affiliate_link" placeholder="<?php echo e(__('affiliate.Affiliate Link')); ?>" type="text" value="<?php echo e(isset($row)? $row->affiliate_link : old('affiliate_link')); ?>">
                            <span class="text-danger"><?php echo e($errors->first('affiliate_link')); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button class="primary-btn fix-gr-bg submit">

                            <span class="ti-check"></span>
                            <?php if(isset($row)): ?>
                                <?php echo e(__('common.update')); ?>

                            <?php else: ?>
                                <?php echo e(__('common.save')); ?>

                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Affiliate/Resources/views/affiliate/components/_create_link.blade.php ENDPATH**/ ?>