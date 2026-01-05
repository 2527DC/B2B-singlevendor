<?php $__env->startSection('styles'); ?>
    <style>
        .mb-15{
            margin-bottom: 15px!important;
        }
        .customer_img input{
            width: 100%;
            background: #fff;
        }
        .send_query .form-group input{
            text-transform: none!important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e($contactContent->mainTitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo e($contactContent->mainTitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="contact_section ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center m-0">
                <div class="col-12 p-0">
                    <div class="contact_map">
                        <div id="contact-map"></div>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-xxl-8 col-xl-9 col-md-10 mx-auto">
                    <div class="contact_address">
                        <div class="row justify-content-end row-gap-60">
                        <div class="col-lg-8">
                                <div class="contact_form_box">
                                    <div class="contact_info">
                                        <div class="contact_title">
                                            <h4 class=""><?php echo e(__('amazy.Get in touch')); ?></h4>
                                        </div>

                                        <div class="contact_description">
                                            Enim tempor eget pharetra facilisis sed maecenas adipiscing. Eu leo molestie vel, ornare non id blandit netus.
                                        </div>
                                    </div>
                                    <form class="form-area contact-form send_query_form" id="contactForm" action="#" name="#" enctype="multipart/form-data">
                                        <?php if(!empty($row) && !empty($form_data)): ?>
                                            <?php
                                                $default_field = [];
                                                $custom_field = [];
                                                $custom_file = false;
                                            ?>
                                            <?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    if($row->type != 'header' && $row->type !='paragraph'){
                                                        if(property_exists($row,'className') && strpos($row->className, 'default-field') !== false){
                                                            $default_field[] = $row->name;
                                                        }else{
                                                            $custom_field[] = $row->name;
                                                            $custom_file  = true;
                                                        }
                                                        $required = property_exists($row,'required');
                                                        $type = property_exists($row,'subtype') ? $row->subtype : $row->type;
                                                        $placeholder = property_exists($row,'placeholder') ? $row->placeholder : $row->label;
                                                    }
                                                ?>
                                                    <?php if($row->type =='header' || $row->type =='paragraph'): ?>
                                                        <div class="form-group">
                                                            <<?php echo e($row->subtype); ?>><?php echo e($row->label); ?> </<?php echo e($row->subtype); ?>>
                                                        </div>
                                                    <?php elseif($row->type == 'text' || $row->type == 'number' || $row->type == 'email' || $row->type == 'date'): ?>
                                                        <div class="col-xl-12">
                                                            <input <?php echo e($required ? 'required' :''); ?> name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" placeholder="<?php echo e($row->label); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e($row->label); ?>'" class="<?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> primary_line_input style4 mb_20" value="<?php echo e(old($row->name)); ?>" type="<?php echo e($type); ?>">
                                                            <?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="text-danger" ><?php echo e($message); ?></span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    <?php elseif($row->type=='select'): ?>
                                                        <div class="col-xl-12">
                                                            <select <?php echo e($required ? 'required' :''); ?> name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" class="form-control amaz_select2 style2 wide mb_30">
                                                                <?php if($row->name == 'query_type'): ?>
                                                                    <?php $__currentLoopData = $QueryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($value->value); ?>" <?php echo e(old($row->name) == $value->value? 'selected': ''); ?>><?php echo e($value->label); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo e($errors->first($row->name)); ?></span>
                                                        </div>
                                                    <?php elseif($row->type == 'date'): ?>
                                                        <div class="col-xl-12">
                                                            <input <?php echo e($required ? 'required' :''); ?> type="<?php echo e($type); ?>" id="datepicker" class="<?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="<?php echo e($row->name); ?>" value="<?php echo e(old($row->name)); ?>" placeholder="<?php echo e($placeholder); ?>">
                                                            <?php $__errorArgs = [$row->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger" ><?php echo e($message); ?></span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    <?php elseif($row->type=='textarea'): ?>
                                                        <div class="col-xl-12">
                                                            <textarea class="form-control primary_line_textarea style4 mb_40" <?php echo e($required ? 'required' :''); ?> name="<?php echo e($row->name); ?>" placeholder="<?php echo e($placeholder); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write Message here…'" id="<?php echo e($row->name); ?>"><?php echo e(old($row->name)); ?></textarea>
                                                            <span class="text-danger"><?php echo e($errors->first($row->name)); ?></span>
                                                        </div>
                                                    <?php elseif($row->type=="radio-group"): ?>
                                                        <div class="col-xl-12">
                                                            <label for=""><?php echo e($row->label); ?></label>
                                                            <div class="address_type d-flex align-items-center gap_30 flex-wrap mb_5">
                                                                <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <label class="primary_checkbox style6 d-flex" >
                                                                    <input type="radio" name="<?php echo e($row->name); ?>" value="<?php echo e($value->value); ?>">
                                                                    <span class="checkmark mr_10"></span>
                                                                    <span class="label_name f_w_500"><?php echo e($value->label); ?></span>
                                                                </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php elseif($row->type=="checkbox-group"): ?>
                                                        <div class="col-xl-12 mb_20">
                                                            <label><?php echo e(@$row->label); ?></label>
                                                            <?php $__currentLoopData = $row->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <label class="primary_checkbox d-flex mb_30">
                                                                    <input type="checkbox"  name="<?php echo e($row->name); ?>[]" value="<?php echo e($value->value); ?>">
                                                                    <span class="checkmark mr_10"></span>
                                                                    <span class="label_name"><?php echo e($value->label); ?></span>
                                                                </label>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php elseif($row->type =='file'): ?>
                                                        <div class="col-xl-12 customer_img mb_20">
                                                            <input class="<?php echo e($custom_file ? 'custom_file' :''); ?> form-control" accept="image/*" type="<?php echo e($type); ?>" name="<?php echo e($row->name); ?>" id="<?php echo e($row->name); ?>" >
                                                        </div>
                                                    <?php elseif($row->type =='checkbox'): ?>
                                                        <div class="col-md-12 mb-15">
                                                            <div class="checkbox">
                                                                <label class="cs_checkbox">
                                                                    <input id="policyCheck" type="checkbox" checked>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <p><?php echo e($row->label); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <input type="hidden" name="custom_field" value="<?php echo e(json_encode($custom_field)); ?>">

                                            <?php else: ?>
                                            <input type="hidden" name="custom_field" value="<?php echo e(json_encode(['phone','district'])); ?>">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <input name="name" id="name" placeholder="<?php echo e(__('defaultTheme.enter_name')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.enter_name')); ?>'" class="primary_line_input style4 mb_20" type="text">
                                                    <span class="text-danger"  id="error_name"></span>
                                                </div>

                                                <div class="col-xl-12">
                                                    <input name="email" id="email" placeholder="<?php echo e(__('defaultTheme.enter_email_address')); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.enter_email_address')); ?>'" class="primary_line_input style4 mb_20" type="email">
                                                    <span class="text-danger"  id="error_email"></span>
                                                </div>

                                                <div class="col-xl-12">
                                                    <input name="phone" id="phone" placeholder="<?php echo e(__('defaultTheme.phone_number')); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.phone_number')); ?>'" class="primary_line_input style4 mb_20" type="phone">
                                                    <span class="text-danger"  id="error_phone_number"></span>
                                                </div>


                                                <div class="col-xl-12">
                                                    <select name="query_type" id="query_type" class="amaz_select2 style2 wide mb_30 nc_select" >
                                                        <?php $__currentLoopData = $QueryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <span class="text-danger" id="error_query_type"></span>

                                                <div class="col-xl-12">
                                                    <textarea class="primary_line_textarea style4 mb_40" id="message" name="message" placeholder="<?php echo e(__('defaultTheme.write_messages')); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo e(__('defaultTheme.write_messages')); ?>'"></textarea>
                                                    <span class="text-danger"  id="error_message"></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(env('NOCAPTCHA_FOR_CONTACT') == "true"): ?>
                                            <div class="col-12 mb_20">
                                                <?php if(env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                                                    <div class="g-recaptcha" data-callback="callback" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
                                                <?php else: ?>
                                                    <div class="g-recaptcha"
                                                        data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"
                                                        data-callback="onSubmit"
                                                        data-size="invisible">
                                                    </div>
                                                <?php endif; ?>
                                                <span class="text-danger" id="error_g_recaptcha"></span>
                                            </div>
                                            <?php endif; ?>
                                                <div class="col-lg-12 text-right send_query_btn">
                                                    <div class="alert-msg"></div>
                                                    <button  <?php if(env('NOCAPTCHA_FOR_CONTACT') == "true"): ?> style="margin-top: 80px !important;" <?php endif; ?> type="submit" id="contactBtn" class="amaz_primary_btn style2 submit-btn text-center f_w_700 text-uppercase rounded-0 w-100 btn_1" ><?php echo e(__('defaultTheme.send_message')); ?></button>
                                                </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="contact_box_wrapper">
                                    <div class="d-flex gap-15 align-items-center">
                                        <div class="icon">
                                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.2059 0.424316V2.35275C18.1133 2.35275 19.9002 2.83486 21.5666 3.79908C23.1528 4.74321 24.4177 6.00875 25.3613 7.59569C26.3251 9.26299 26.8069 11.0508 26.8069 12.9592H28.7344C28.7344 10.6892 28.1622 8.58 27.0177 6.63147C25.9135 4.74321 24.4177 3.24666 22.5304 2.14183C20.5828 0.996821 18.4747 0.424316 16.2059 0.424316ZM6.23733 3.31697C5.69524 3.31697 5.22341 3.48772 4.82186 3.82921L1.71985 6.99305L1.8102 6.93279C1.30826 7.35464 0.97698 7.87692 0.816359 8.49965C0.675815 9.12237 0.71597 9.72501 0.936825 10.3076C1.499 11.8744 2.25191 13.4814 3.19556 15.1286C4.52069 17.3986 6.09679 19.4375 7.92386 21.2454C10.8552 24.1983 14.4993 26.5285 18.8562 28.236H18.8863C19.4685 28.4369 20.0508 28.477 20.633 28.3565C21.2354 28.236 21.7674 27.9748 22.2292 27.5731L25.271 24.5298C25.6725 24.128 25.8733 23.6359 25.8733 23.0533C25.8733 22.4507 25.6725 21.9485 25.271 21.5467L21.3257 17.5693C20.9242 17.1676 20.4222 16.9667 19.8199 16.9667C19.2176 16.9667 18.7156 17.1676 18.3141 17.5693L16.4167 19.4978C14.8908 18.7746 13.5657 17.8807 12.4413 16.816C11.317 15.7313 10.4235 14.4155 9.76097 12.8688L11.6884 10.9403C12.1101 10.4984 12.3209 9.97611 12.3209 9.37347C12.3209 8.75074 12.0799 8.24855 11.5981 7.86688L11.6884 7.95727L7.65281 3.82921C7.25126 3.48772 6.77943 3.31697 6.23733 3.31697ZM16.2059 4.28119V6.20963C17.4306 6.20963 18.555 6.51095 19.579 7.11358C20.623 7.71622 21.4462 8.53982 22.0485 9.58439C22.6508 10.6089 22.952 11.7338 22.952 12.9592H24.8795C24.8795 11.3923 24.4879 9.93593 23.7049 8.59004C22.9219 7.28433 21.8778 6.23976 20.5728 5.45633C19.2276 4.6729 17.772 4.28119 16.2059 4.28119ZM6.23733 5.24541C6.29757 5.24541 6.36784 5.27554 6.44815 5.3358L10.3934 9.37347C10.4135 9.45382 10.3934 9.52413 10.3332 9.58439L7.47211 12.4168L7.68293 13.0194L8.07444 13.8631C8.39568 14.5461 8.76712 15.209 9.18875 15.8518C9.771 16.7558 10.4135 17.5292 11.1162 18.172C12.0599 19.096 13.1942 19.9397 14.5194 20.703C15.1819 21.0847 15.7441 21.3659 16.2059 21.5467L16.8082 21.8179L19.7295 18.8951C19.7697 18.8549 19.7998 18.8349 19.8199 18.8349C19.84 18.8349 19.8701 18.8549 19.9102 18.8951L23.976 22.9629C24.0161 23.0031 24.0362 23.0332 24.0362 23.0533C24.0362 23.0533 24.0161 23.0734 23.976 23.1136L20.9643 26.0966C20.5226 26.4783 20.0407 26.5787 19.5187 26.398C15.4229 24.811 12.0097 22.6415 9.2791 19.8895C7.59258 18.2021 6.11687 16.2837 4.85197 14.1343C3.94848 12.5875 3.24576 11.091 2.74382 9.64466V9.61452C2.66351 9.43373 2.65347 9.22281 2.7137 8.98176C2.77393 8.72061 2.88436 8.51973 3.04498 8.37912L6.02652 5.3358C6.08675 5.27554 6.15702 5.24541 6.23733 5.24541ZM16.2059 8.13806V10.0665C17.009 10.0665 17.6917 10.3477 18.2538 10.9102C18.816 11.4727 19.0971 12.1556 19.0971 12.9592H21.0245C21.0245 12.0954 20.8037 11.2919 20.362 10.5486C19.9403 9.80536 19.3581 9.22281 18.6152 8.80096C17.8723 8.35903 17.0692 8.13806 16.2059 8.13806Z" fill="#1A1A1C"/>
                                            </svg>

                                        </div>
                                        <div class="contact_wiz_box">
                                            <span class="contact_box_title d-block lh-1 "><?php echo e(__('amazy.Call or WhatsApp')); ?></span>
                                            <h4 class="contact_box_desc mb-0"><?php echo e(getNumberTranslate(app('general_setting')->phone)); ?></h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-15 align-items-center">
                                        <div class="icon">
                                            <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.95455 0.625V2.59624L0.75 6.63565V23.375H25.5682V6.63565L19.3636 2.59624V0.625H6.95455ZM9.02273 2.69318H17.2955V10.6428L13.1591 13.3249L9.02273 10.6428V2.69318ZM10.0568 4.76136V6.82955H16.2614V4.76136H10.0568ZM6.95455 5.0522V9.28551L3.6907 7.18501L6.95455 5.0522ZM19.3636 5.0522L22.6275 7.18501L19.3636 9.28551V5.0522ZM10.0568 7.86364V9.93182H16.2614V7.86364H10.0568ZM2.81818 9.09162L13.1591 15.7809L23.5 9.09162V21.3068H2.81818V9.09162Z" fill="#202122"/>
                                            </svg>
                                        </div>
                                        <div class="contact_wiz_box">
                                            <span class="contact_box_title d-block lh-1 "><?php echo e(__('amazy.Get in touch')); ?></span>
                                            <h4 class="contact_box_desc mb-0"><?php echo e($contactContent->email); ?></h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-15 align-items-center">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="contact_wiz_box">
                                            <span class="contact_box_title d-block lh-1 "><?php echo e(__('amazy.Head office')); ?></span>
                                            <h4 class="contact_box_desc mb-0"><?php echo e(app('general_setting')->address); ?></h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-15 align-items-center">
                                        <div class="contact_wiz_box">
                                            <span class="contact_box_title d-block lh-1 mb-3"><?php echo e(__('amazy.Social Media')); ?></span>
                                            <div class="contact_link">
                                                <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($social->url); ?>">
                                                    <i class="<?php echo e($social->icon); ?>"></i>
                                                </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('app.map_api_key')?config('app.map_api_key'):'AIzaSyDfpGBFn5yRPvJrvAKoGIdj1O1aO9QisgQ'); ?>"></script>
<script src="<?php echo e(url('/')); ?>/public/frontend/amazy/js/map.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    (function($){
        "use strict";
        $(document).ready(function() {
            $('#contactForm').on('submit', function(event) {
                event.preventDefault();
                <?php if(env('NOCAPTCHA_FOR_CONTACT') == "true" ): ?>
                    var response = grecaptcha.getResponse();
                    if(response.length == 0){
                        <?php if(env('NOCAPTCHA_INVISIBLE') != "true"): ?>
                        $('#error_g_recaptcha').text("The google recaptcha field is required");
                        return false;
                        <?php endif; ?>
                    }
                    <?php endif; ?>
              //  $("#contactBtn").prop('disabled', true);
                $('#contactBtn').text('<?php echo e(__('common.submitting')); ?>');

                var formElement = $(this).serializeArray();
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                if($('.custom_file').length > 0){
                    let photo = $('.custom_file')[0].files[0];
                    if (photo) {
                        formData.append($('.custom_file').attr('name'), photo)
                    }
                }
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                $.ajax({
                    url: "<?php echo e(route('contact.store')); ?>",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        toastr.success("<?php echo e(__('defaultTheme.message_sent_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text("<?php echo e(__('defaultTheme.send_message')); ?>");
                        resetErrorData();
                    },
                    error: function(data) {
                        toastr.error("<?php echo e(__('common.error_message')); ?>", "<?php echo e(__('common.error')); ?>");
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text("<?php echo e(__('defaultTheme.send_message')); ?>");
                        showErrorData(data.responseJSON.errors)

                    }
                });
            });

            function showErrorData(errors){
                $('#contactForm #error_name').text(errors.name);
                $('#contactForm #error_email').text(errors.email);
                $('#contactForm #error_query_type').text(errors.query_type);
                $('#contactForm #error_message').text(errors.message);
            }

            function resetErrorData(){
                $('#contactForm')[0].reset();
                $('#contactForm #error_name').text('');
                $('#contactForm #error_email').text('');
                $('#contactForm #error_query_type').text('');
                $('#contactForm #error_message').text('');
            }

            if ($('#contact-map').length != 0) {
                var latitude = "<?php echo e(app('general_setting')->latitude); ?>";
                var longitude = "<?php echo e(app('general_setting')->longitude); ?>";
                google.maps.event.addDomListener(window, 'load', basicmap(parseFloat(latitude),parseFloat(longitude)));
            }
        });
    })(jQuery);


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/contact_us.blade.php ENDPATH**/ ?>