<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="col-xl-12">
    <div class="primary_input">
        <ul id="theme_nav" class="permission_list sms_list ">
            <li>
                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                    <input name="status" id="status" value="1" <?php echo e($data->status?'checked':''); ?> type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <p><?php echo e(__('appearance.enable_this_section')); ?></p>
            </li>
        </ul>
        <span class="text-danger" id="is_featured_error"></span>
    </div>
    <input type="hidden" id="form_for" name="form_for" value="<?php echo e($data->section_name); ?>">
    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
</div>
<div id="hide_for_top_bar" class="row w-100">
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
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                            <input class="primary_input_field" name="title[<?php echo e($language->code); ?>]" id="title<?php echo e($language->code); ?>" placeholder="<?php echo e(__('common.title')); ?>" type="text" value="<?php echo e(isset($data)?$data->getTranslation('title',$language->code):old('title.'.$language->code)); ?>">
                            <span class="text-danger" id="error_title_<?php echo e($language->code); ?>"></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php else: ?>
        <div class="col-xl-12">
            <div class="primary_input mb-15">
                <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                <input class="primary_input_field" name="title" id="title" placeholder="<?php echo e(__('common.title')); ?>" type="text" value="<?php echo e($data->title); ?>">
                <span class="text-danger" id="error_title"></span>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-lg-12 <?php if(app('theme')->folder_path != 'default'): ?> d-none <?php endif; ?>">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for=""><?php echo e(__('appearance.column_size')); ?></label>
            <select name="column_size" id="column_size" class="primary_select mb-15" data-value="<?php echo e($data->column_size); ?>">
                <option disabled selected><?php echo e(__('common.select')); ?></option>
                <option <?php echo e($data->column_size =='col-lg-3'?'selected':''); ?> value="col-lg-3"><?php echo e(__('appearance.3_column')); ?></option>
                <option <?php echo e($data->column_size =='col-lg-4'?'selected':''); ?> value="col-lg-4"><?php echo e(__('appearance.4_column')); ?></option>
                <option <?php echo e($data->column_size =='col-lg-6'?'selected':''); ?> value="col-lg-6"><?php echo e(__('appearance.6_column')); ?></option>
                <option <?php echo e($data->column_size =='col-lg-12'?'selected':''); ?> value="col-lg-12"><?php echo e(__('appearance.12_column')); ?></option>
            </select>
            <span class="text-danger" id="coulmn_size_error"></span>
        </div>
    </div>
    <?php if($data->section_for ==1): ?>
        <div id="for_product_type" class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.type')); ?></label>
                <select name="type" id="type" class="primary_select mb-15 product_type">
                    <option <?php echo e($data->type == 1?'selected':''); ?> value="1"><?php echo e(__('frontendCms.category_products')); ?></option>
                    <option <?php echo e($data->type == 2?'selected':''); ?> value="2"><?php echo e(__('frontendCms.latest_products')); ?></option>
                    <option <?php echo e($data->type == 3?'selected':''); ?> value="3"><?php echo e(__('frontendCms.recently_viewed_products')); ?></option>
                    <option <?php echo e($data->type == 4?'selected':''); ?> value="4"><?php echo e(__('frontendCms.max_sale')); ?></option>
                    <option <?php echo e($data->type == 5?'selected':''); ?> value="5"><?php echo e(__('frontendCms.max_review')); ?></option>
                    <option <?php echo e($data->type == 6?'selected':''); ?> value="6"><?php echo e(__('frontendCms.custom_products')); ?></option>
                </select>
                <span class="text-danger" id="type_error"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for ==2): ?>
        <div id="for_product_type" class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.type')); ?></label>
                <select name="type" id="type" class="primary_select mb-15 category_type">
                    <option <?php echo e($data->type == 1?'selected':''); ?> value="1"><?php echo e(__('frontendCms.top_category')); ?></option>
                    <option <?php echo e($data->type == 2?'selected':''); ?> value="2"><?php echo e(__('frontendCms.latest_category')); ?></option>
                    <option <?php echo e($data->type == 3?'selected':''); ?> value="3"><?php echo e(__('frontendCms.max_sale')); ?></option>
                    <option <?php echo e($data->type == 4?'selected':''); ?> value="4"><?php echo e(__('frontendCms.max_review')); ?></option>
                    <option <?php echo e($data->type == 5?'selected':''); ?> value="5"><?php echo e(__('frontendCms.amount_of_product')); ?></option>
                    <option <?php echo e($data->type == 6?'selected':''); ?> value="6"><?php echo e(__('frontendCms.custom_category')); ?></option>
                </select>
                <span class="text-danger" id="type_error"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for ==3): ?>
        <div id="for_product_type" class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.type')); ?></label>
                <select name="type" id="type" class="primary_select mb-15 brand_type">
                    <option <?php echo e($data->type == 1?'selected':''); ?> value="1"><?php echo e(__('frontendCms.top_brands')); ?></option>
                    <option <?php echo e($data->type == 2?'selected':''); ?> value="2"><?php echo e(__('frontendCms.latest_brands')); ?></option>
                    <option <?php echo e($data->type == 3?'selected':''); ?> value="3"><?php echo e(__('frontendCms.featured_brands')); ?></option>
                    <option <?php echo e($data->type == 4?'selected':''); ?> value="4"><?php echo e(__('frontendCms.max_sale')); ?></option>
                    <option <?php echo e($data->type == 5?'selected':''); ?> value="5"><?php echo e(__('frontendCms.max_review')); ?></option>
                    <option <?php echo e($data->type == 6?'selected':''); ?> value="6"><?php echo e(__('frontendCms.custom_brands')); ?></option>
                </select>
                <span class="text-danger" id="type_error"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for ==1): ?>
        <div id="product_list_div" class="col-lg-12 <?php echo e($data->type != 6? 'd-none':''); ?>">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('appearance.product_list')); ?></label>
                <select name="product_list[]" id="product_list" class="primary_select mb-15" multiple>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($data->products->where('seller_product_id',$product->id)->first()): ?> selected <?php endif; ?> value="<?php echo e($product->id); ?>"><?php echo e($product->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[ <?php if($product->seller->role->type == 'seller'): ?> <?php echo e($product->seller->first_name); ?> <?php else: ?> <?php echo e(__('common.inhouse')); ?> <?php endif; ?>] <?php endif; ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for ==2): ?>
        <div id="category_list_div" class="col-lg-12 <?php echo e($data->type != 6? 'd-none':''); ?>">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                <select name="category_list[]" id="category_list" class="primary_select mb-15" multiple>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($data->categories->where('category_id',$category->id)->first()): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for ==3): ?>
        <div id="brand_list_div" class="col-lg-12 <?php echo e($data->type != 6? 'd-none':''); ?>">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.brand_list')); ?></label>
                <select name="brand_list[]" id="brand_list" class="primary_select mb-15" multiple>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($data->brands->where('brand_id',$brand->id)->first()): ?> selected <?php endif; ?> value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data->section_for == 4 && $data->section_name == 'filter_category_1'): ?>
        <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                <select name="category" id="category" class="primary_select mb-15">
                    <?php $__currentLoopData = $categories->where('parent_id', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(@$data->customSection->field_1 == $category->id?'selected':''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.section_image')); ?> (<?php echo e(getNumberTranslate(330)); ?> X <?php echo e(getNumberTranslate(860)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader">
                  <input class="primary-input" type="text" id="filter_category_image_file" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                  <button class="" type="button">
                      <label class="primary-btn small fix-gr-bg" for="filter_category_image"><?php echo e(__("common.browse")); ?> </label>
                      <input type="file" class="d-none image_file" accept="image/*" name="filter_category_image" id="filter_category_image" data-name_id="#filter_category_image_file" data-view_id="#filter_category_image_show">
                  </button>
               </div>
                <?php $__errorArgs = ['filter_category_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form_img_div">
                    <img id="filter_category_image_show" src="<?php echo e(showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png')); ?>" alt="">
                </div>
            </div>
        </div>
    <?php elseif($data->section_for == 4 && $data->section_name == 'filter_category_2'): ?>
        <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                <select name="category" id="category_2" class="primary_select mb-15">
                    <?php $__currentLoopData = $categories->where('parent_id', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(@$data->customSection->field_1 == $category->id?'selected':''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.section_image')); ?> (<?php echo e(getNumberTranslate(330)); ?> X <?php echo e(getNumberTranslate(860)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader">
                  <input class="primary-input" type="text" id="filter_category_image_file" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                  <button class="" type="button">
                      <label class="primary-btn small fix-gr-bg" for="filter_category_image"><?php echo e(__("common.browse")); ?> </label>
                      <input type="file" class="d-none image_file" accept="image/*" name="filter_category_image" id="filter_category_image" data-name_id="#filter_category_image_file" data-view_id="#filter_category_image_show">
                  </button>
               </div>
                <?php $__errorArgs = ['filter_category_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form_img_div">
                    <img id="filter_category_image_show_2" src="<?php echo e(showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png')); ?>" alt="">
                </div>
            </div>
        </div>
    <?php elseif($data->section_for == 4 && $data->section_name == 'filter_category_3'): ?>
        <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('common.category_list')); ?></label>
                <select name="category" id="category_3" class="primary_select mb-15">
                    <?php $__currentLoopData = $categories->where('parent_id', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(@$data->customSection->field_1 == $category->id?'selected':''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.section_image')); ?> (<?php echo e(getNumberTranslate(330)); ?> X <?php echo e(getNumberTranslate(860)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="filter_category_image">
                    <input class="primary-input file_amount" type="text" id="filter_category_image_file" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="filter_category_image"><?php echo e(__('common.browse')); ?> </label>
                        <input type="hidden" class="selected_files" value="<?php echo e(old('filter_category_image')); ?>">
                    </button>
                </div>
                <div class="product_image_all_div">
                    <img id="filter_category_image_show_3" src="<?php echo e(showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png')); ?>" alt="">
                </div>
            </div>
        </div>
    <?php elseif($data->section_for == 4 && $data->section_name == 'discount_banner'): ?>
        <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.section_image_1')); ?> (<?php echo e(getNumberTranslate(450)); ?> X <?php echo e(getNumberTranslate(300)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="banner_image_file_1" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="banner_image_1"><?php echo e(__("common.browse")); ?> </label>
                        <input type="file" class="d-none image_file" accept="image/*" name="banner_image_1" id="banner_image_1" data-name_id="#banner_image_file_1" data-view_id="#banner_image_show_1">
                    </button>
                </div>
                <?php $__errorArgs = ['banner_image_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form_img_div">
                <img id="banner_image_show_1" src="<?php echo e(showImage($data->customSection->field_1?$data->customSection->field_1:'backend/img/default.png')); ?>" alt="">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="section_1_link"> <?php echo e(__('frontendCms.section_1_link')); ?> <span class="text-danger">*</span> </label>
                <input class="primary_input_field" type="text" id="section_1_link" value="<?php echo e($data->customSection->field_4); ?>" name="section_1_link" autocomplete="off"  placeholder="<?php echo e(__('common.link')); ?>">
                <span class="text-danger" id="error_section_1_link"></span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="banner_image_file_2"><?php echo e(__('frontendCms.section_image_2')); ?> (<?php echo e(getNumberTranslate(450)); ?> X <?php echo e(getNumberTranslate(300)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="banner_image_file_2" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="banner_image_2"><?php echo e(__("common.browse")); ?> </label>
                        <input type="file" class="d-none image_file" accept="image/*" name="banner_image_2" id="banner_image_2" data-name_id="#banner_image_file_2" data-view_id="#banner_image_show_2">
                    </button>
                </div>
                <?php $__errorArgs = ['banner_image_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form_img_div">
                <img id="banner_image_show_2" src="<?php echo e(showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png')); ?>" alt="">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="name"> <?php echo e(__('frontendCms.section_2_link')); ?> <span class="text-danger">*</span> </label>
                <input class="primary_input_field" type="text" id="section_2_link" value="<?php echo e($data->customSection->field_5); ?>" name="section_2_link" autocomplete="off"  placeholder="<?php echo e(__('common.link')); ?>">
                <span class="text-danger" id="error_section_2_link"></span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for=""><?php echo e(__('frontendCms.section_image_3')); ?> (<?php echo e(getNumberTranslate(450)); ?> X <?php echo e(getNumberTranslate(300)); ?>)<?php echo e(__('common.px')); ?></label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="banner_image_file_3" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="banner_image_3"><?php echo e(__("common.browse")); ?> </label>
                        <input type="file" class="d-none image_file" accept="image/*" name="banner_image_3" id="banner_image_3" data-name_id="#banner_image_file_3" data-view_id="#banner_image_show_3">
                    </button>
                </div>
                <?php $__errorArgs = ['banner_image_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form_img_div">
                <img id="banner_image_show_3" src="<?php echo e(showImage($data->customSection->field_3?$data->customSection->field_3:'backend/img/default.png')); ?>" alt="">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="name"> <?php echo e(__('frontendCms.section_3_link')); ?> <span class="text-danger">*</span></label>
                <input class="primary_input_field" type="text" id="section_3_link" value="<?php echo e($data->customSection->field_6); ?>" name="section_3_link" autocomplete="off"  placeholder="<?php echo e(__('common.link')); ?>">
                <span class="text-danger" id="error_section_3_link"></span>
            </div>
        </div>
    <?php elseif($data->section_for ==5): ?>
    <input type="hidden" name="type" value="<?php echo e($data->type); ?>">
    <?php endif; ?>
</div>
    <?php if(permissionCheck('frontendcms.homepage.update')): ?>
        <div class="col-xl-6 offset-xl-3">
            <button class="primary_btn_2 mt-5" id="widget_form_btn"><i class="ti-check"></i><?php echo e(__('common.update')); ?> </button>
        </div>
    <?php endif; ?>


<?php /**PATH /var/www/html/Production_dev/Modules/FrontendCMS/Resources/views/widget_manage/components/formdata_best_deals.blade.php ENDPATH**/ ?>