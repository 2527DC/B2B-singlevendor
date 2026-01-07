<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30"><?php echo e(__('marketing.create_bulk_sms')); ?> </h3>
        </div>
    </div>
</div>
<div class="row">
    <div id="formHtml" class="col-lg-12">
        <div class="white-box">
            <form action="" id="add_form">
                <div class="add-visitor">
                    <div class="row">
                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="tab-content">
                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                                    <input class="primary_input_field" type="text" id="title" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(old('title.'.$language->code)); ?>" placeholder="<?php echo e(__('common.title')); ?>">
                                                    <span class="text-danger" id="error_title_<?php echo e($language->code); ?>"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.short_code')); ?> <small>(<?php echo e(__('general_settings.use_these_to_get_your_neccessary_info')); ?>)</small> </label>
                                                    <label class="primary_input_label red_text" for="">{GIFT_CARD_NAME}, {SECRET_CODE}, {USER_FIRST_NAME}, {USER_EMAIL}, {EMAIL_SIGNATURE}, {EMAIL_FOOTER}, {ORDER_TRACKING_NUMBER}, {WEBSITE_NAME}</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="message"><?php echo e(__('common.message')); ?> <span class="text-danger">*</span></label>
                                                    <textarea name="message[<?php echo e($language->code); ?>]" id="message" cols="30" class="form-control primary_input_field" placeholder="<?php echo e(__('common.message')); ?>" rows="10"><?php echo e(old('message.'.$language->code) ?? $template->value); ?></textarea>
                                                    <span class="text-danger" id="error_message_<?php echo e($language->code); ?>"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" type="text" id="title" name="title" autocomplete="off" value="<?php echo e(old('title')); ?>" placeholder="<?php echo e(__('common.title')); ?>">
                                    <span class="text-danger" id="error_title"></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.short_code')); ?> <small>(<?php echo e(__('general_settings.use_these_to_get_your_neccessary_info')); ?>)</small> </label>
                                    <label class="primary_input_label red_text" for="">{GIFT_CARD_NAME}, {SECRET_CODE}, {USER_FIRST_NAME}, {USER_EMAIL}, {EMAIL_SIGNATURE}, {EMAIL_FOOTER}, {ORDER_TRACKING_NUMBER}, {WEBSITE_NAME}</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="message"><?php echo e(__('common.message')); ?> <span class="text-danger">*</span></label>
                                    <textarea name="message" id="message" cols="30" class="form-control primary_input_field" placeholder="<?php echo e(__('common.message')); ?>" rows="10"><?php echo e(old('message') ?? $template->value); ?></textarea>
                                    <span class="text-danger" id="error_message"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="publish_date"><?php echo e(__('marketing.publish_on')); ?> <span class="text-danger">*</span></label>
                                <div class="primary_datepicker_input">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="">
                                                <input placeholder="<?php echo e(__('common.date')); ?>" class="primary_input_field primary-input date form-control" id="publish_date" type="text" name="publish_date" value="<?php echo e(dateConvert(date('m/d/Y'))); ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <button class="btn-date" data-id="#publish_date" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <span class="text-danger" id="error_publish_date"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="send_to"><?php echo e(__('marketing.send_to')); ?> <span class="text-danger">*</span></label>
                                <select name="send_to" id="send_to" class="primary_select mb-15">
                                    <option disabled selected><?php echo e(__('common.select')); ?></option>
                                    <option value="1"><?php echo e(__('marketing.all_user')); ?></option>
                                    <option value="2"><?php echo e(__('marketing.role_wise')); ?></option>
                                    <option value="3"><?php echo e(__('marketing.multiple_role_select_user')); ?></option>
                                </select>
                                <span class="text-danger" id="error_send_to"></span>
                            </div>
                        </div>
                        <div id="all_user_div" class="col-lg-12 d-none">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="all_user"><?php echo e(__('marketing.all_user')); ?> <span class="text-danger">*</span></label>
                                <select name="all_user[]" id="all_user" class="primary_select mb-15" multiple>
                                    <option disabled><?php echo e(__('common.select')); ?></option>
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option selected value="<?php echo e($user->id); ?>"> <?php echo e($user->username); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $users->where('role_id','!=',5)->where('role_id','!=', 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option selected value="<?php echo e($user->id); ?>"><?php echo e($user->username); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger" id="error_all_user"></span>
                            </div>
                        </div>
                        <div id="select_role_div" class="col-lg-12 d-none">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="role"><?php echo e(__('common.select_role')); ?> <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="primary_select mb-15">
                                    <option disabled selected><?php echo e(__('common.select')); ?></option>
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $roles->where('type','!=','seller'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger" id="error_role"></span>
                            </div>
                        </div>
                        <div id="select_role_user_div" class="col-lg-12 d-none">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="role_user"><?php echo e(__('marketing.selected_role_user')); ?> <span class="text-danger">*</span></label>
                                <select name="role_user[]" id="role_user" class="primary_select mb-15" multiple>
                                    <option disabled><?php echo e(__('common.select')); ?></option>
                                </select>
                                <span class="text-danger" id="error_role_user"></span>
                            </div>
                        </div>
                        <div id="multiple_role_div" class="col-lg-12 d-none">
                            <label><?php echo e(__('marketing.message_to')); ?> <span class="text-danger">*</span></label>
                            <br>
                            <div class="">
                                <input type="checkbox" checked id="role_all" class="common-checkbox" value="" name="">
                                <label for="role_all"><?php echo e(__('common.all')); ?></label>
                            </div>
                            <?php if(isModuleActive('MultiVendor')): ?>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="">
                                        <input type="checkbox" checked id="role_<?php echo e($role->id); ?>" class="common-checkbox multi_check" value="<?php echo e($role->id); ?>" name="role_list[]">
                                        <label for="role_<?php echo e($role->id); ?>"><?php echo e($role->name); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $roles->where('type', '!=', 'seller'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="">
                                        <input type="checkbox" checked id="role_<?php echo e($role->id); ?>" class="common-checkbox multi_check" value="<?php echo e($role->id); ?>" name="role_list[]">
                                        <label for="role_<?php echo e($role->id); ?>"><?php echo e($role->name); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <span class="text-danger" id="error_role_list"></span>
                        </div>
                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button id="submit_btn" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip"> <span class="ti-check"></span> <?php echo e(__('marketing.save_test_sms')); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="testSMSDiv">
</div>

<?php /**PATH /var/www/html/mytestdhatri/Modules/Marketing/Resources/views/bulk_sms/components/create.blade.php ENDPATH**/ ?>