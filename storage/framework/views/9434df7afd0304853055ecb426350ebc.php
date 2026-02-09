<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<?php if($header->type == 'category'): ?>
    <div class="white-box p-15">
        <h4 class="mb-10"><?php echo e(__('common.category_list')); ?></h4>
        <div id="categoryDiv" class="minh-250">
            <?php if(count(@$header->CateGorySectionItems())>0): ?>
            <?php $__currentLoopData = @$header->CateGorySectionItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($element->category->status == 1): ?>
            <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                <div class="mb-10">
                    <div class="card" id="accordion_<?php echo e($element->id); ?>">
                        <div class="card-header card_header_element">
                            <p class="d-inline">
                                <?php echo e($element->title); ?>

                            </p>
                            <div class="pull-right">
                                <a href="javascript:void(0);" class=" d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                <a href="" data-id="<?php echo e($element->id); ?>" class=" d-inline primary-btn category_delete_btn"><i class="ti-close"></i></a>
                            </div>
                        </div>
                        <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                            <div class="card-body">
                                <form enctype="multipart/form-data" id="element_edit_form">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                        <input type="hidden" name="header_id" value="<?php echo e($header->id); ?>">
                                        <input type="hidden" id="header_type" value="<?php echo e($header->type); ?>">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="title">
                                                    <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field title" type="text" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>" required>
                                            </div>
                                        </div>
                                        <?php if($header->type == 'category'): ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                                                <select name="category" class="mb-15 category" required>
                                                    <?php if($element->category): ?>
                                                    <?php
                                                        $depth = '';
                                                        for($i= 1; $i <= $element->category->depth_level; $i++){
                                                            $depth .='-';
                                                        }
                                                        $depth.='> ';
                                                    ?>
                                                    <option value="<?php echo e($element->category_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-xl-12">
                                            <div class="primary_input">
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.open_link_in_a_new_tab')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <div class="d-flex justify-content-center pt_20">
                                                <button type="submit" class="primary-btn fix-gr-bg"><i
                                                        class="ti-check"></i>
                                                    <?php echo e(__('common.update')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="mt-20 pt-100 text-center">
                <?php echo e(__('appearance.no_categories')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
<?php elseif($header->type == 'product'): ?>
    <div class="white-box p-15">
        <h4 class="mb-10"><?php echo e(__('appearance.product_list')); ?></h4>
        <div id="productDiv" class="minh-250">
            <?php if(count(@$header->productSectionItems())>0): ?>
            <?php $__currentLoopData = @$header->productSectionItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                <div class="mb-10">
                    <div class="card" id="accordion_<?php echo e($element->id); ?>">
                        <div class="card-header card_header_element">
                            <p class="d-inline">
                                <?php echo e($element->title); ?>

                            </p>
                            <div class="pull-right">
                                <a href="javascript:void(0);" class=" d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                <a href="" data-id="<?php echo e($element->id); ?>" class="d-inline primary-btn product_delete_btn"><i class="ti-close"></i></a>
                            </div>
                        </div>
                        <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                            <div class="card-body">
                                <form enctype="multipart/form-data" id="element_edit_form">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                        <input type="hidden" name="header_id" value="<?php echo e($header->id); ?>">
                                        <input type="hidden" id="header_type" value="<?php echo e($header->type); ?>">

                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="title">
                                                    <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                <input class="primary_input_field title" type="text" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>" required>
                                            </div>
                                        </div>
                                        <?php if($header->type == 'product'): ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('appearance.product_list')); ?></label>
                                                <select name="product" class="mb-15 product" required>
                                                    <option value="<?php echo e($element->product_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>

                                                </select>
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-xl-12">
                                            <div class="primary_input">
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.open_link_in_a_new_tab')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <div class="d-flex justify-content-center pt_20">
                                                <button type="submit" class="primary-btn fix-gr-bg"><i
                                                        class="ti-check"></i>
                                                    <?php echo e(__('common.update')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="mt-20 pt-100 text-center">
                <?php echo e(__('appearance.no_categories')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
<?php elseif($header->type == 'slider'): ?>
    <div class="white-box p-15">
        <h4 class="mb-10"><?php echo e(__('appearance.slider_list')); ?></h4>
        <div id="sliderDiv" class="minh-250">
            <?php if(count(@$header->sliderSectionItems())>0): ?>
            <?php $__currentLoopData = @$header->sliderSectionItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                    <div class="mb-10">
                        <div class="card" id="accordion_<?php echo e($element->id); ?>">
                            <div class="card-header card_header_element">
                                <p class="d-inline">
                                    <?php echo e($element->name); ?>

                                </p>
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class=" d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                    <a href="" data-id="<?php echo e($element->id); ?>" class="d-inline primary-btn slider_delete_btn"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" id="element_edit_form">
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo e($element->id); ?>" class="element_id">
                                            <input type="hidden" name="header_id" value="<?php echo e($header->id); ?>">
                                            <input type="hidden" id="header_type" value="<?php echo e($header->type); ?>">
                                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="nav-item lang_code" data-id="<?php echo e($language->code); ?>">
                                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#seelement<?php echo e($element->id); ?><?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <div class="tab-content">
                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="seelement<?php echo e($element->id); ?><?php echo e($language->code); ?>">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="name">
                                                                    <?php echo e(__('common.name')); ?>

                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input class="primary_input_field name" type="text" id="name<?php echo e(auth()->user()->lang_code == $language->code?$language->code:''); ?>" name="name[<?php echo e($language->code); ?>]" autocomplete="off"  placeholder="<?php echo e(__('common.name')); ?>" value="<?php echo e(isset($element)?$element->getTranslation('name',$language->code):old('name.'.$language->code)); ?>">
                                                                <span class="text-danger" id="edit_error_name_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="name"><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                                    <input class="primary_input_field" type="text" id="name" name="name" autocomplete="off" value="<?php echo e($element->name); ?>" placeholder="<?php echo e(__('common.name')); ?>">
                                                </div>
                                                <span class="text-danger" id="edit_error_name<?php echo e($element->id); ?>"></span>
                                            </div>
                                        <?php endif; ?>
                                            <div class="col-xl-12 upload_photo_div">
                                                <div class="primary_input">
                                                    <label class="primary_input_label"><?php echo e(__('common.upload_photo')); ?> (<?php if(app('theme')->folder_path == 'default'): ?> <?php echo e(getNumberTranslate(660)); ?> X <?php echo e(getNumberTranslate(365)); ?> <?php else: ?> <?php echo e(getNumberTranslate(1920)); ?> X <?php echo e(getNumberTranslate(600)); ?> <?php endif; ?>) <?php echo e(__('common.px')); ?> <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">

                                                <div class="primary_input mb-25">
                                                    <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="slider_image_media">
                                                        <input class="primary-input file_amount" type="text" id="image" placeholder="<?php echo e(__('common.choose_images')); ?>" readonly="">
                                                        <button class="" type="button">
                                                            <label class="primary-btn small fix-gr-bg" for="thumbnail_image"><?php echo e(__('product.Browse')); ?> </label>
                                                            <input type="hidden" class="selected_files image_selected_files" value="<?php echo e(@$element->slider_image_media->media_id); ?>">
                                                        </button>

                                                        <span class="text-danger" id="edit_error_image<?php echo e($element->id); ?>"> </span>

                                                    </div>
                                                    <div class="product_image_all_div">
                                                        <?php if(@$element->slider_image_media->media_id): ?>
                                                            <input type="hidden" name="slider_image_media" class="product_images_hidden" value="<?php echo e(@$element->slider_image_media->media_id); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for=""><?php echo e(__('appearance.slider_for')); ?></label>
                                                    <select name="data_type" data-id="#data_div_<?php echo e($element->id); ?>" class="primary_select edit_slider_drop mb-15 element_list_data_type">
                                                        <option value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <option <?php echo e($element->data_type == 'product'?'selected':''); ?> value="product"><?php echo e(__('appearance.for_product')); ?></option>
                                                        <option <?php echo e($element->data_type == 'category'?'selected':''); ?> value="category"><?php echo e(__('appearance.for_category')); ?></option>
                                                        <option <?php echo e($element->data_type == 'brand'?'selected':''); ?> value="brand"><?php echo e(__('appearance.for_brand')); ?></option>
                                                        <option <?php echo e($element->data_type == 'tag'?'selected':''); ?> value="tag"><?php echo e(__('appearance.for_tag')); ?></option>
                                                        <option <?php echo e($element->data_type == 'url'?'selected':''); ?> value="url"><?php echo e(__('appearance.for_url_not_support_in_mobile_app')); ?></option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="data_div_<?php echo e($element->id); ?>">
                                                    <?php if($element->data_type == 'url'): ?>
                                                        <div class="primary_input mb-25">
                                                                <label class="primary_input_label"
                                                                    for="url"><?php echo e(__('setup.url')); ?> <span class="text-danger">*</span></label>
                                                                    <input class="primary_input_field" type="text" id="url" name="url" autocomplete="off"
                                                                value="<?php echo e($element->url); ?>" placeholder="<?php echo e(__('setup.url')); ?>" required>
                                                        </div>
                                                        <span class="text-danger" id="error_name"></span>

                                                    <?php elseif($element->data_type == 'product'): ?>
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for=""><?php echo e(__('product.product_list')); ?></label>
                                                            <select name="data_id" class="product mb-15">
                                                                <?php if($element->product): ?>
                                                                <option value="<?php echo e($element->data_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> <?php echo e(__('common.inhouse')); ?> <?php endif; ?>]<?php endif; ?></option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    <?php elseif($element->data_type == 'category'): ?>
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for=""><?php echo e(__('product.category_list')); ?></label>
                                                            <select name="data_id" class="category mb-15">
                                                                <?php if($element->category): ?>
                                                                    <?php
                                                                        $depth = '';
                                                                        for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                            $depth .='-';
                                                                        }
                                                                        $depth.='> ';
                                                                    ?>
                                                                    <option value="<?php echo e($element->data_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    <?php elseif($element->data_type == 'brand'): ?>
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for=""><?php echo e(__('product.brand_list')); ?></label>
                                                            <select name="data_id" id="slider_brand" class="slider_brand mb-15">
                                                                <?php if($element->brand): ?>
                                                                    <option value="<?php echo e($element->data_id); ?>" selected><?php echo e(@$element->brand->name); ?></option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    <?php elseif($element->data_type == 'tag'): ?>
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <?php echo e(__('common.list')); ?></label>
                                                            <select name="data_id" id="slider_tag" class="slider_tag mb-15">
                                                                <?php if($element->tag): ?>
                                                                <option value="<?php echo e($element->data_id); ?>" selected><?php echo e(@$element->tag->name); ?></option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    <?php endif; ?>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="primary_input">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?></label>
                                                    <ul id="theme_nav" class="permission_list sms_list ">
                                                        <li>
                                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                <input name="status" id="status_active" value="1" <?php echo e($element->status?'checked':''); ?> class="active"
                                                                    type="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.active')); ?></p>
                                                        </li>
                                                        <li>
                                                            <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                <input name="status" value="0" id="status_inactive" <?php echo e($element->status == 0?'checked':''); ?> class="de_active" type="radio">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.inactive')); ?></p>
                                                        </li>
                                                    </ul>
                                                    <span class="text-danger" id="status_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input">
                                                    <ul id="theme_nav" class="permission_list sms_list ">
                                                        <li>
                                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab?'checked':''); ?> type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('common.open_link_in_a_new_tab')); ?></p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div class="d-flex justify-content-center pt_20">
                                                    <button type="submit" class="primary-btn fix-gr-bg"><i
                                                            class="ti-check"></i>
                                                        <?php echo e(__('common.update')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="mt-20 pt-100 text-center">
                <?php echo e(__('appearance.no_sliders')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/DhatriProduction/Modules/Appearance/Resources/views/header/components/element_list.blade.php ENDPATH**/ ?>