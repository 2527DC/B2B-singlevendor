<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/vendors/css/icon-picker.css'))); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/product_edit.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-20 white_box">
            <form action="<?php echo e(route('product.update', $product->id)); ?>" method="POST" enctype="multipart/form-data"
                id="choice_form">
                <?php echo csrf_field(); ?>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.edit_product')); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs justify-content-end mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" href="#GenaralInfo" role="tab" data-toggle="tab" id="1"
                            aria-selected="true"><?php echo e(__('product.general_information')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link show" href="#RelatedProduct" role="tab" data-toggle="tab" id="2"
                            aria-selected="false"><?php echo e(__('product.related_product')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link show" href="#UpSale" role="tab" data-toggle="tab" id="3"
                            aria-selected="false"><?php echo e(__('common.up_sale')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link show" href="#CrossSale" role="tab" data-toggle="tab" id="4"
                            aria-selected="true"><?php echo e(__('common.cross_sale')); ?></a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active show" id="GenaralInfo">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="white_box_50px box_shadow_white mb-20 pt-0 p-15">
                                    <div class="row">
                                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link default_lang anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" data-id="<?php echo e($language->code); ?>" href="#pnelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-2 mr-30"><?php echo e(__('product.product_information')); ?></h3>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>" id="product_id">
                                        <div class="col-lg-12">
                                            <input type="hidden" value="<?php echo e($product->product_type); ?>" id="product_type">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><strong><?php echo e(__('common.type')); ?></strong><?php if($product->product_type == 2): ?> (<?php echo e(__('product.variant_product_is_not_changable_to_single_product')); ?>) <?php elseif($product->product_type == 1 && !product_attribute_editable($product->id)): ?> (<?php echo e(__('product.change_not_possible_for_use')); ?>) <?php endif; ?><span class="text-danger">*</span></label>
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="product_type" id="single_prod" value="1" <?php echo e($product->product_type == 1?'checked':''); ?> <?php echo e(($product->product_type == 2 || !product_attribute_editable($product->id))?'disabled':''); ?>

                                                                class="active prod_type" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('product.single')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="product_type" value="2" id="variant_prod" <?php echo e($product->product_type == 2?'checked':''); ?> <?php echo e(($product->product_type == 2 || !product_attribute_editable($product->id))?'disabled':''); ?>

                                                                class="de_active prod_type" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('product.variant')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if($product->product_type == 2 || !product_attribute_editable($product->id)): ?>
                                        <input type="hidden" name="product_type" value="<?php echo e($product->product_type); ?>">
                                        <?php endif; ?>

                                        <div class="col-lg-12">
                                            <div class="tab-content">
                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="pnelement<?php echo e($language->code); ?>">
                                                       <div class="row">
                                                           <div class="col-lg-6">
                                                               <div class="primary_input mb-15">
                                                                   <label class="primary_input_label" for="product_name"> <?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                                                   <input class="primary_input_field" name="product_name[<?php echo e($language->code); ?>]" id="product_name_<?php echo e($language->code); ?>" placeholder="<?php echo e(__('common.name')); ?>" type="text" value="<?php echo e(isset($product)?$product->getTranslation('product_name',$language->code):old('product_name.'.$language->code)); ?>">
                                                                   <span class="text-danger" id="error_product_name_<?php echo e($language->code); ?>"><?php echo e($errors->first('product_name')); ?></span>
                                                               </div>
                                                           </div>
                                                           <div class="col-lg-6 sku_single_div d-none" id="default_lang_<?php echo e($language->code); ?>">
                                                               <div class="primary_input mb-15">
                                                                   <label class="primary_input_label" for="sku_single"> <?php echo e(__('product.product_sku')); ?></label>
                                                                   <input class="primary_input_field" name="product_sku[<?php echo e($language->code); ?>]" id="sku_single" placeholder="<?php echo e(__('product.product_sku')); ?>" type="text" value="<?php echo e(isset($product)?$product->skus->first()->sku:old('product_sku.'.$language->code)); ?>">
                                                                   <span id="error_single_sku" class="text-danger"><?php echo e($errors->first('product_sku')); ?></span>
                                                               </div>
                                                           </div>
                                                           <div class="col-lg-6 <?php if(!app('general_setting')->product_subtitle_show): ?> d-none <?php endif; ?>">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_1"> <?php echo e(__('product.subtitle_1')); ?></label>
                                                                <input class="primary_input_field" name="subtitle_1[<?php echo e($language->code); ?>]" id="subtitle_1" placeholder="<?php echo e(__('product.subtitle_1')); ?>" type="text" value="<?php echo e(isset($product)?$product->getTranslation('subtitle_1',$language->code):old('subtitle_1.'.$language->code)); ?>">
                                                                <span id="error_subtitle_1" class="text-danger"><?php echo e($errors->first('subtitle_1')); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 <?php if(!app('general_setting')->product_subtitle_show): ?> d-none <?php endif; ?>">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="subtitle_2"> <?php echo e(__('product.subtitle_2')); ?></label>
                                                                <input class="primary_input_field" name="subtitle_2[<?php echo e($language->code); ?>]" id="subtitle_2" placeholder="<?php echo e(__('product.subtitle_2')); ?>" type="text" value="<?php echo e(isset($product)?$product->getTranslation('subtitle_2',$language->code):old('subtitle_2.'.$language->code)); ?>">
                                                                <span id="error_subtitle_2" class="text-danger"><?php echo e($errors->first('subtitle_2')); ?></span>
                                                            </div>
                                                        </div>
                                                       </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-2 mr-30"><?php echo e(__('product.product_information')); ?></h3>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>" id="product_id">
                                        <div class="col-lg-12">
                                            <input type="hidden" value="<?php echo e($product->product_type); ?>" id="product_type">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><strong><?php echo e(__('common.type')); ?></strong><?php if($product->product_type == 2): ?> (<?php echo e(__('product.variant_product_is_not_changable_to_single_product')); ?>) <?php elseif($product->product_type == 1 && !product_attribute_editable($product->id)): ?> (<?php echo e(__('product.change_not_possible_for_use')); ?>) <?php endif; ?><span
                                                        class="text-danger">*</span></label>
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="product_type" id="single_prod" value="1" <?php echo e($product->product_type == 1?'checked':''); ?> <?php echo e(($product->product_type == 2 || !product_attribute_editable($product->id))?'disabled':''); ?>

                                                                class="active prod_type" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('product.single')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="product_type" value="2" id="variant_prod" <?php echo e($product->product_type == 2?'checked':''); ?> <?php echo e(($product->product_type == 2 || !product_attribute_editable($product->id))?'disabled':''); ?>

                                                                class="de_active prod_type" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('product.variant')); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if($product->product_type == 2 || !product_attribute_editable($product->id)): ?>
                                        <input type="hidden" name="product_type" value="<?php echo e($product->product_type); ?>">
                                        <?php endif; ?>
                                        <div class="col-lg-6">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""> <?php echo e(__('common.name')); ?> <span
                                                    class="text-danger">*</span></label>
                                                <input class="primary_input_field" name="product_name" id="product_name"
                                                    placeholder="<?php echo e(__('common.name')); ?>" type="text"
                                                    value="<?php echo e(old('product_name')?old('product_name'):$product->product_name); ?>" required="1">
                                                <span class="text-danger" id="error_product_name"><?php echo e($errors->first('product_name')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 sku_single_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""> <?php echo e(__('product.product_sku')); ?>  <span class="text-danger">*</span> </label>
                                                <input class="primary_input_field" name="product_sku" id="sku_single"
                                                    placeholder="<?php echo e(__('product.product_sku')); ?>" type="text"
                                                    value="<?php echo e(old('product_sku')??@$product->skus->first()->sku); ?>">
                                                <span class="text-danger" id="error_single_sku"><?php echo e($errors->first('product_sku')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 <?php if(!app('general_setting')->product_subtitle_show): ?> d-none <?php endif; ?>">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""> <?php echo e(__('product.subtitle_1')); ?></label>
                                                <input class="primary_input_field" name="subtitle_1" id="subtitle_1"
                                                    placeholder="<?php echo e(__('product.subtitle_1')); ?>" type="text" value="<?php echo e(old('subtitle_1')?old('subtitle_1'):$product->subtitle_1); ?>">
                                                <span id="error_subtitle_1" class="text-danger"><?php echo e($errors->first('subtitle_1')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 <?php if(!app('general_setting')->product_subtitle_show): ?> d-none <?php endif; ?>">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""> <?php echo e(__('product.subtitle_2')); ?></label>
                                                <input class="primary_input_field" name="subtitle_2" id="subtitle_2"
                                                    placeholder="<?php echo e(__('product.subtitle_2')); ?>" type="text" value="<?php echo e(old('subtitle_2')?old('subtitle_2'):$product->subtitle_2); ?>">
                                                <span id="error_subtitle_2" class="text-danger"><?php echo e($errors->first('subtitle_2')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-3 <?php echo e($product->product_type == 2 ? '' : 'd-none'); ?> variant_sku_prefix">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="variant_sku_prefix"> <?php echo e(__('product.variant_sku_prefix')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field" name="variant_sku_prefix" id="variant_sku_prefix" placeholder="<?php echo e(__('product.variant_sku_prefix')); ?>" type="text" value="<?php echo e($product->variant_sku_prefix); ?>">
                                            <span id="error_variant_sku_prefix" class="text-danger"><?php echo e($errors->first('variant_sku_prefix')); ?></span>
                                        </div>
                                    </div>
                                        <input type="hidden" name="new_attribute_added" id="new_attribute_added_id" value="0">
                                        <div class="col-lg-3 "  style="display: none;" >
                                            <div class="primary_input mb-15" style="display: none;" >
                                                <label class="primary_input_label" for="model_number">
                                                    <?php echo e(__('common.model_number')); ?></label>
                                                <input class="primary_input_field" name="model_number"
                                                    placeholder="<?php echo e(__('common.model_number')); ?>" type="text"
                                                    value="<?php echo e(old('model_number') ? old('model_number') : $product->model_number); ?>">
                                                <span class="text-danger"><?php echo e($errors->first('model_number')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3" id="category_select_div">
                                            <?php
                                                $product_categories = $product->categories;
                                            ?>
                                            <?php echo $__env->make('product::products.components._category_list_select',['product_categories' => $product_categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <div class="col-lg-3" id="brand_select_div">
                                            <?php echo $__env->make('product::products.components._brand_list_select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        </div>
                                        <div class="col-lg-3" id="unit_select_div">
                                            <?php echo $__env->make('product::products.components._unit_list_select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                    for=""><?php echo e(__('product.barcode_type')); ?></label>
                                                <select name="barcode_type" id="barcode_type" class="primary_select mb-15">
                                                    <?php $__currentLoopData = barcodeList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $barcode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($barcode); ?>" <?php if($barcode == @$product->skus->first()->barcode_type): ?> selected <?php endif; ?>><?php echo e($barcode); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="text-danger"><?php echo e($errors->first('barcode_type')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">
                                                    <?php echo e(__('product.minimum_order_qty')); ?> <span
                                                    class="text-danger">*</span></label>
                                                <input class="primary_input_field" name="minimum_order_qty" id="minimum_order_qty"
                                                    value="<?php echo e($product->minimum_order_qty); ?>" type="number" min="1"
                                                    step="0" required="1">
                                                <span class="text-danger" id="error_minumum_qty"><?php echo e($errors->first('minimum_order_qty')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">
                                                    <?php echo e(__('product.max_order_qty')); ?></label>
                                                <input class="primary_input_field" name="max_order_qty" type="number"
                                                    min="0" step="0" value="<?php echo e($product->max_order_qty); ?>">
                                                <span class="text-danger"><?php echo e($errors->first('max_order_qty')); ?></span>
                                            </div>
                                        </div>
                                        <?php if(isModuleActive('GoogleMerchantCenter')): ?>
                                            <div class="col-lg-3">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="condition"><?php echo e(__('product.product_condition')); ?></label>
                                                    <select class="primary_select mb-25" name="condition" id="condition">
                                                        <option value="new" <?php if($product->condition == 'new'): ?> selected <?php endif; ?>><?php echo e(__('product.new')); ?></option>
                                                        <option value="used" <?php if($product->condition == 'used'): ?> selected <?php endif; ?>><?php echo e(__('product.used')); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="gtin"> <?php echo e(__('common.gtin')); ?></label>
                                                    <input class="primary_input_field" name="gtin" id="gtin" placeholder="<?php echo e(__('common.gtin')); ?>" type="text" value="<?php echo e($product->gtin); ?>">
                                                    <span class="text-danger" id="error_gtin"><?php echo e($errors->first('gtin')); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="mpn"> <?php echo e(__('common.mpn')); ?></label>
                                                    <input class="primary_input_field" name="mpn" id="mpn" placeholder="<?php echo e(__('common.mpn')); ?>" type="text" value="<?php echo e($product->mpn); ?>">
                                                    <span class="text-danger" id="error_mpn"><?php echo e($errors->first('mpn')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isModuleActive('ClubPoint')): ?>
                                            <div class="col-lg-6">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="club_point"><?php echo e(__('clubpoint.point')); ?></label>
                                                    <input class="primary_input_field" name="club_point" id="club_point" placeholder="<?php echo e(__('clubpoint.point')); ?>" type="number" min="0" value="<?php echo e(@$product->club_point); ?>">
                                                    <span class="text-danger" id="error_discunt"><?php echo e($errors->first('club_point')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label for=""><?php echo app('translator')->get('blog.tags'); ?> (<?php echo app('translator')->get('product.comma_separated'); ?>)<span class="text-danger">*</span></label>
                                                <div class="tagInput_field mb_26">
                                                    <?php
                                                        $tags = [];
                                                        foreach ($product->tags as $tag) {
                                                            $tags[] = $tag->name;
                                                        }
                                                        $tags = implode(',', $tags);
                                                    ?>
                                                    <input name="tags" class="tag-input" id="tag-input-upload-shots"
                                                        type="text" value="<?php echo e($tags); ?>" data-role="tagsinput" />
                                                </div>
                                                <div class="suggeted_tags">
                                                    <label><?php echo app('translator')->get('blog.suggested_tags'); ?></label><br>
                                                    <ul id="tag_show"  class="suggested_tag_show">
                                                    </ul>
                                                </div>
                                                <span class="text-danger" id="error_tags"><?php echo e($errors->first('tags')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 attribute_div">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for=""><strong><?php echo e(__('product.attribute')); ?></strong> <?php if(!product_attribute_editable($product->id)): ?> (<?php echo e(__('product.attribute_add_not_possible_for_this_product')); ?>) <?php endif; ?></label>
                                                <select name="choice_attributes[]" id="choice_attributes" <?php if(!product_attribute_editable($product->id)): ?> disabled <?php endif; ?>
                                                    class="primary_select mb-15">
                                                    <option value="" disabled selected><?php echo e(__('product.select_attribute')); ?></option>
                                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="text-danger"><?php echo e($errors->first('choice_attributes')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col lg-12">
                                            <div class="customer_choice_options" id="customer_choice_options">
                                                <?php $__currentLoopData = $product->variations->unique('attribute_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <input type="hidden" name="choice_no[]" id="attribute_id_<?php echo e($choice_option->attribute_id); ?>" value="<?php echo e($choice_option->attribute_id); ?>">
                                                            <div class="primary_input mb-25">
                                                                <input class="primary_input_field" width="40%" name="choice[]" type="text" value="<?php echo e(\Modules\Product\Entities\Attribute::find($choice_option->attribute_id)->name); ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="primary_input mb-25">
                                                                <select name="choice_options_<?php echo e($choice_option->attribute_id); ?>[]" id="choice_options" class="primary_select mb-15 choice_attribute" multiple>
                                                                    <?php $__currentLoopData = $choice_option->attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($value->id); ?>" <?php if($product->variations->where('attribute_value_id', $value->id)->first()): ?> selected <?php endif; ?>> <?php echo e($value->color ? $value->color->name : $value->value); ?> </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php if(product_attribute_editable($product->id)): ?>
                                                            <div class="col-lg-1 text-center">
                                                                <a class="btn cursor_pointer attribute_remove"><i class="ti-trash"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 sku_combination overflow-auto">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.price_info_and_stock')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">

                                            <div class="primary_input">
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="is_physical" id="is_physical" <?php echo e($product->is_physical == 1 ? 'checked' : ''); ?> value="1" type="checkbox" >
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('product.is_physical_product')); ?></p>
                                                        <input type="hidden" name="is_physical" id="is_physical_prod" value="<?php echo e($product->is_physical); ?>">
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="col-lg-12 weight_height_div">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.weight_height_info')); ?></h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for="weight"> <?php echo e(__('product.weight')); ?> [<?php echo e(__('kg')); ?>]</label>
                                                        <input value="<?php echo e(@$product->skus->first()->weight); ?>" class="primary_input_field" name="weight" id="weight" type="number" min="0" step="<?php echo e(step_decimal()); ?>">
                                                        <span class="text-danger" id="error_weight"><?php echo e($errors->first('weight')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="primary_input mb-15" style="display: none;">
                                                        <label class="primary_input_label" for="length"> <?php echo e(__('product.length')); ?> [<?php echo e(__('product.cm')); ?>]</label>
                                                        <input value="<?php echo e(@getNumberTranslate($product->skus->first()->length)); ?>" class="primary_input_field" name="length" id="length" type="number" min="0" step="<?php echo e(step_decimal()); ?>">
                                                        <span class="text-danger" id="error_length"><?php echo e($errors->first('length')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="primary_input mb-15" style="display: none;">
                                                        <label class="primary_input_label" for=""> <?php echo e(__('product.breadth')); ?> [<?php echo e(__('product.cm')); ?>]</label>
                                                        <input value="<?php echo e(@$product->skus->first()->breadth); ?>" class="primary_input_field" name="breadth" id="breadth" type="number" min="0" step="<?php echo e(step_decimal()); ?>">
                                                        <span class="text-danger" id="error_breadth"><?php echo e($errors->first('breadth')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="primary_input mb-15" style="display: none;" >
                                                        <label class="primary_input_label" for=""> <?php echo e(__('product.height')); ?> [<?php echo e(__('product.cm')); ?>]</label>
                                                        <input value="<?php echo e(@$product->skus->first()->height); ?>" class="primary_input_field" name="height" id="height"
                                                               type="number" min="0" step="<?php echo e(step_decimal()); ?>">
                                                        <span class="text-danger" id="error_height"><?php echo e($errors->first('height')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 digital_file_upload_div_edit" style="display: <?php echo e(($product->is_physical == 1)?'none':'block'); ?>;">
                                            <div class="primary_input mb-25">
                                                <?php
                                                    $digital_file = @$product->skus->first()->digital_file->file_source;
                                                    $first_sku = $product->skus->first();
                                                ?>
                                                <label class="primary_input_label" for="pdf_place"><?php echo e(__('product.program_file_upload')); ?> <small> <?php if($digital_file): ?> <a class="link_color" href="<?php echo e(asset(asset_path(@$product->skus->first()->digital_file->file_source))); ?>" download><?php echo e(__('product.download_link')); ?></a> <?php endif; ?> </small> </label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text" id="pdf_place" placeholder="<?php echo e(__('product.upload_file')); ?>" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="pdf"><?php echo e(__('product.Browse')); ?> </label>
                                                        <input type="file" class="d-none" name="single_digital_file" id="pdf">
                                                    </button>
                                                </div>
                                                <span class="text-danger"><?php echo e($errors->first('documents')); ?></span>
                                            </div>
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="pdf_place"><?php echo e(__('product.in_app_purchase_code')); ?></label>
                                                <input type="text" value="<?php echo e(!empty($first_sku) ?  $first_sku->in_app_purchase:''); ?>" name="in_app_purchase_code" class="primary_input_field">
                                            </div>
                                        </div>
                                        <div id="phisical_shipping_div" class="col-lg-12" style="display: <?php echo e($product->is_physical == 0?'none':'block'); ?>">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for="additional_shipping"> <?php echo e(__('product.additional_shipping_charge')); ?> </label>
                                                        <input class="primary_input_field" name="additional_shipping" placeholder="<?php echo e(__('product.additional_shipping_charge')); ?>" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e(@$product->skus->first()->additional_shipping); ?>">
                                                        <span class="text-danger"><?php echo e($errors->first('additional_shipping')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(!isModuleActive('MultiVendor')): ?>
                                            <?php
                                                $frontend_product = $product->sellerProducts->where('user_id', 1)->first();
                                            ?>
                                            <div class="col-lg-12" id="stock_manage_div">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="stock_manage"><?php echo e(__('product.stock_manage')); ?></label>
                                                    <select class="primary_select mb-25" name="stock_manage" id="stock_manage">
                                                        <option value="1" <?php echo e(@$frontend_product->stock_manage == 1?'selected':''); ?>><?php echo e(__('common.yes')); ?></option>
                                                        <option value="0" <?php echo e(@$frontend_product->stock_manage == 0?'selected':''); ?>><?php echo e(__('common.no')); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-none" id="single_stock_div">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="single_stock"> <?php echo e(__('product.product_stock')); ?>

                                                    </label>
                                                    <input class="primary_input_field" name="single_stock" id="single_stock"
                                                        type="number" min="0" step="0"
                                                        value="<?php echo e(old('single_stock')?old('single_stock'):@$frontend_product->skus[0]->product_stock); ?>">
                                                    <span class="text-danger"><?php echo e($errors->first('single_stock')); ?></span>
                                                </div>
                                            </div>

                                        <?php endif; ?>

                                        <div class="col-lg-6 mrp_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">
                                                    <?php echo e(__('product.mrp')); ?> <span
                                                    class="text-danger">*</span></label>
                                                <input class="primary_input_field mrp" name="mrp" id="mrp"
                                                    placeholder="<?php echo e(__('product.mrp')); ?>" type="number" min="1"
                                                    step="<?php echo e(step_decimal()); ?>" value="<?php echo e(@$product->skus->first()->mrp); ?>"
                                                    required>
                                                <span class="text-danger" id="error_mrp"><?php echo e($errors->first('mrp')); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 selling_price_div">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">
                                                    <?php echo e(__('product.selling_price')); ?> <span
                                                    class="text-danger">*</span></label>
                                                <input class="primary_input_field selling_price" name="selling_price" id="selling_price"
                                                    placeholder="<?php echo e(__('product.selling_price')); ?>" type="number" min="1"
                                                    step="<?php echo e(step_decimal()); ?>" value="<?php echo e(@$product->skus->first()->selling_price); ?>"
                                                    required>
                                                <span class="text-danger" id="error_selling_price"><?php echo e($errors->first('selling_price')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3"  style="display: none !important;">
                                            <div class="primary_input mb-15"   style="display: none !important;">
                                                <label class="primary_input_label" for="discount"> <?php echo e(__('product.discount')); ?></label>
                                                <input class="primary_input_field" name="discount" id="discount" placeholder="<?php echo e(__('product.discount')); ?>" type="number" min="0" step="<?php echo e(step_decimal()); ?>" value="<?php echo e(getNumberTranslate(@$product->discount)); ?>">
                                                <span class="text-danger" id="error_discunt"><?php echo e($errors->first('discount')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 "  style="display: none !important;">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="discount_type"><?php echo e(__('product.discount_type')); ?></label>
                                                <select class="primary_select mb-25" name="discount_type" id="discount_type">
                                                    <option value="1" <?php if($product->discount_type == 1): ?> selected <?php endif; ?>><?php echo e(__('common.amount')); ?></option>
                                                    <option value="0" <?php if($product->discount_type == 0): ?> selected <?php endif; ?>><?php echo e(__('common.percentage')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if(app('gst_config')['enable_gst'] == "only_tax"): ?>
                                        <div class="col-lg-6">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="tax_id"><?php echo e(__('common.tax')); ?></label>
                                                <select class="primary_select mb-25" name="tax_id" id="tax_id">
                                                    <option value="" selected disabled><?php echo e(__('common.select_one')); ?></option>
                                                    <?php $__currentLoopData = $gst_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($gst->id); ?>" <?php echo e($gst->id == $product->tax_id?'selected':''); ?>><?php echo e($gst->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="col-lg-6">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('gst.GST_group')); ?></label>
                                                <select class="primary_select mb-25" name="gst_group" id="tax_type">
                                                    <option value="" selected disabled><?php echo e(__('common.select_one')); ?></option>
                                                    <?php $__currentLoopData = $gst_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($group->id); ?>" <?php echo e($group->id == $product->gst_group_id?'selected':''); ?>><?php echo e($group->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" id="gst_list_div">
                                            <?php if($product->gst_group_id): ?>
                                                <?php echo $__env->make('product::products.components._group_gst_list',['group' => $product->gstGroup], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                        <!-- Whole-Sale (Load previous Data & add new)-->
                                        <?php if(($product->product_type==1) && isModuleActive('WholeSale') && !isModuleActive('MultiVendor')): ?>
                                        <div class="col-lg-12 whole_sale_info_add" id="whole_sale_info_add">
                                            <h3 class="mb-2 mr-30"><?php echo e(__('wholesale.Wholesale Price')); ?></h3>
                                            <div class="QA_section2">
                                                <div class="QA_table mb_15">
                                                    <!-- table-responsive -->
                                                    <div class="table-responsive">
                                                        <table class="table create_table">
                                                            <tbody id="single_product_w_p">
                                                            <tr>
                                                                <td><?php echo e(__('wholesale.Min QTY')); ?></td>
                                                                <td><?php echo e(__('wholesale.Max QTY')); ?></td>
                                                                <td><?php echo e(__('common.price')); ?></td>
                                                                <td></td>
                                                            </tr>
                                                            <?php if( count($wholesale_price)==0 ): ?>
                                                                <tr class="whole_sale_price_list">
                                                                    <td class="pl-0 pb-0 pr-3 border-0">
                                                                        <input type="text" class="form-control primary_input_field" placeholder="Min QTY" name="wholesale_min_qty_0[]">
                                                                    </td>
                                                                    <td class="pl-0 pb-0 pr-3 border-0">
                                                                        <input type="text" class="form-control primary_input_field" placeholder="Max QTY" name="wholesale_max_qty_0[]">
                                                                    </td>
                                                                    <td class="pl-0 pb-0  border-0">
                                                                        <input type="text" class="form-control primary_input_field" placeholder="Price per piece" name="wholesale_price_0[]">
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $wholesale_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w_key=>$w_sale_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr class="whole_sale_price_list whole_sale_price_list_child">
                                                                    <td class="pl-0 pb-0 pr-3 border-0">
                                                                        <input type="text" class="form-control primary_input_field" name="wholesale_min_qty_0[]" value="<?php echo e($w_sale_price->min_qty); ?>">
                                                                    </td>
                                                                    <td class="pl-0 pb-0 pr-3 border-0">
                                                                        <input type="text" class="form-control primary_input_field" name="wholesale_max_qty_0[]" value="<?php echo e($w_sale_price->max_qty); ?>">
                                                                    </td>
                                                                    <td class="pl-0 pb-0 pr-3 border-0">
                                                                        <input type="text" class="form-control primary_input_field" name="wholesale_price_0[]" value="<?php echo e($w_sale_price->selling_price); ?>">
                                                                    </td>
                                                                    <td class="pl-0 pb-0 remove_whole_sale border-0">
                                                                        <button type="button" class="btn close style_close_icon">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="add_items_button mb-20">
                                                <button type="button" class="btn btn-light btn-sm border add_single_whole_sale_price"> <?php echo e(__('wholesale.Add More')); ?> </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        <!-- End Whole-Sale -->
                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                        <div class="col-lg-12">
                                            <div class="tab-content">
                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div role="tabpanel" class="tab-pane fade pelement <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="pelement<?php echo e($language->code); ?>">
                                                        <div class="col-lg-12">
                                                            <div class="main-title d-flex">
                                                                <h3 class="mb-3 mr-30"><?php echo e(__('common.description')); ?></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <textarea class="summernote" name="description[<?php echo e($language->code); ?>]"> <?php echo e(isset($product)?$product->getTranslation('description',$language->code):old('description.'.$language->code)); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="main-title d-flex">
                                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.specifications')); ?></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <textarea class="summernote2" id="specification" name="specification[<?php echo e($language->code); ?>]"><?php echo e(isset($product)?$product->getTranslation('specification',$language->code):old('specification.'.$language->code)); ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="main-title d-flex">
                                                                <h3 class="mb-3 mr-30"><?php echo e(__('common.seo_info')); ?></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="meta_title"> <?php echo e(__('common.meta_title')); ?></label>
                                                                <input class="primary_input_field" id="meta_title" name="meta_title[<?php echo e($language->code); ?>]" placeholder="<?php echo e(__('common.meta_title')); ?>" type="text" value="<?php echo e(isset($product)?$product->getTranslation('meta_title',$language->code):old('meta_title.'.$language->code)); ?>">
                                                                <span class="text-danger"><?php echo e($errors->first('meta_title')); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for="meta_description"> <?php echo e(__('common.meta_description')); ?></label>
                                                                <textarea class="primary_textarea height_112 meta_description" id="meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description[<?php echo e($language->code); ?>]" spellcheck="false"><?php echo e(isset($product)?$product->getTranslation('meta_description',$language->code):old('meta_description.'.$language->code)); ?></textarea>
                                                                <span class="text-danger"><?php echo e($errors->first('meta_description')); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('common.description')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <textarea class="summernote" name="description"><?php echo e($product->description); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.specifications')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <textarea class="summernote2" id="specification" name="specification"><?php echo e($product->specification); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('common.seo_info')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="meta_title"> <?php echo e(__('common.meta_title')); ?></label>
                                                <input class="primary_input_field" id="meta_title" name="meta_title" placeholder="<?php echo e(__('common.meta_title')); ?>" type="text" value="<?php echo e($product->meta_title); ?>">
                                                <span class="text-danger"><?php echo e($errors->first('meta_title')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="meta_description"><?php echo e(__('common.meta_description')); ?></label>
                                                <textarea class="primary_textarea height_112 meta_description" id="meta_description" placeholder="<?php echo e(__('common.meta_description')); ?>" name="meta_description" spellcheck="false"><?php echo e($product->meta_description); ?></textarea>
                                                <span class="text-danger"><?php echo e($errors->first('meta_description')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for=""><?php echo e(__('product.meta_image')); ?> (<?php echo e(getNumberTranslate(300)); ?> X <?php echo e(getNumberTranslate(300)); ?>)<?php echo e(__('common.px')); ?></label>
                                                <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="meta_image">
                                                    <input class="primary-input" type="text" id="meta_image_file" placeholder="<?php echo e(__('common.browse_image_file')); ?>" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="meta_image"><?php echo e(__('product.meta_image')); ?> </label>
                                                        <input type="hidden" class="selected_files" value="<?php echo e(@$product->meta_image_media->media_id); ?>">
                                                    </button>
                                                </div>
                                                <div class="product_image_all_div">
                                                    <?php if(@$product->meta_image_media->media_id): ?>
                                                        <input type="hidden" name="meta_image" class="product_images_hidden" value="<?php echo e(@$product->meta_image_media->media_id); ?>">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_box p-15 box_shadow_white pt-0">
                                    <div class="row image_section">
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.product_image_info')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="true" data-type="image" data-name="images[]">
                                                    <input class="primary-input file_amount" type="text" id="thumbnail_image_file" placeholder="<?php echo e(__('common.choose_images')); ?>" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="thumbnail_image"><?php echo e(__('product.Browse')); ?> </label>
                                                        <input type="hidden" class="selected_files image_selected_files" value="<?php echo e($product->media_ids); ?>">
                                                    </button>
                                                    <span class="text-danger" id="error_thumbnail"></span>
                                                </div>
                                                <div class="product_image_all_div">
                                                    <?php
                                                        if($product->media_ids){
                                                            $media_ids = explode(',',$product->media_ids);
                                                        }else{
                                                            $media_ids = [];
                                                        }
                                                    ?>
                                                    <?php $__currentLoopData = $media_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <input type="hidden" name="images[]" class="product_images_hidden" value="<?php echo e($media_id); ?>">
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.pdf_specifications')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="pdf_place1"><?php echo e(__('product.pdf_specifications')); ?></label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text" id="pdf_place1" placeholder="<?php echo e(__('product.upload_pdf')); ?>" readonly>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="pdf_file"><?php echo e(__('common.browse')); ?> </label>
                                                        <input type="file" class="d-none" name="pdf_file" id="pdf_file">
                                                    </button>
                                                </div>
                                                <span class="text-danger"><?php echo e($errors->first('documents')); ?></span>
                                            </div>
                                            <?php if(@$product->pdf): ?>
                                            <a class="float-left anchore_color" href="<?php echo e(asset(asset_path($product->pdf))); ?>" download><?php echo e(__('product.download_file')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.product_videos_info')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                    for=""><?php echo e(__('product.video_provider')); ?></label>
                                                <select class="primary_select mb-25" name="video_provider"
                                                    id="video_provider">
                                                    <option value="youtube" <?php if($product->video_provider == 'youtube'): ?> selected <?php endif; ?>><?php echo e(__('product.youtube')); ?></option>
                                                    <option value="daily_motion" <?php if($product->video_provider == 'daily_motion'): ?> selected <?php endif; ?>><?php echo e(__('product.daily_motion')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="video_link"><?php echo e(__('product.video_link')); ?></label>
                                                <input class="primary_input_field" id="video_link" name="video_link" placeholder="<?php echo e(__('product.video_link')); ?>" type="text" value="<?php echo e($product->video_link); ?>">
                                                <span class="text-danger"><?php echo e($errors->first('video_link')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-title d-flex">
                                                <h3 class="mb-3 mr-30"><?php echo e(__('product.others_info')); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.status')); ?> <span class="text-danger">*</span></label>
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option"
                                                               class="primary_checkbox d-flex mr-12">
                                                            <input name="status" id="status_active" value="1" <?php if(@$product->status == 1): ?> checked <?php endif; ?> class="active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.publish')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="status" value="0" id="status_inactive" <?php if(@$product->status == 0): ?> checked <?php endif; ?>  class="de_active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.pending')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="status" value="3" id="defat_status" <?php if(@$product->status == 3): ?> checked <?php endif; ?>  class="de_active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.draft')); ?></p>
                                                    </li>
                                                </ul>
                                                <span class="text-danger" id="status_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for=""><?php echo e(__('common.make_Display_in_details_page')); ?> <span class="text-danger">*</span></label>
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="display_in_details" id="status_active" value="1" <?php if($product->display_in_details == 1): ?> checked <?php endif; ?> class="active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.up_sale')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="display_in_details" value="2" id="status_inactive" <?php if($product->display_in_details == 2): ?> checked <?php endif; ?> class="de_active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.cross_sale')); ?></p>
                                                    </li>
                                                </ul>
                                                <span class="text-danger" id="status_error"></span>
                                            </div>
                                        </div>
                                        <?php if(isModuleActive('GoldPrice')): ?>
                                        <div class="col-lg-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label"><?php echo e(__('product.auto_update_required')); ?> <span class="text-danger">*</span></label>
                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                    <li>
                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="auto_update_required" id="auto_update_required_active" value="1" <?php echo e($product->auto_update?'checked':''); ?> class="active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.on')); ?></p>
                                                    </li>
                                                    <li>
                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                            <input name="auto_update_required" value="0" id="auto_update_required_inactive" <?php echo e(!$product->auto_update?'checked':''); ?> class="de_active" type="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <p><?php echo e(__('common.off')); ?></p>
                                                    </li>
                                                </ul>
                                                <span class="text-danger" id="auto_update_required_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="gold_price_id"><?php echo e(__('product.gold_price')); ?></label>
                                                <select class="primary_select mb-25" name="gold_price_id" id="gold_price_id">
                                                    <?php $__currentLoopData = $gold_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gold_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-price="<?php echo e($gold_price->price); ?>" <?php echo e($product->gold_price_id == $gold_price->id?'selected':''); ?> value="<?php echo e($gold_price->id); ?>"><?php echo e($gold_price->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="making_charge"> <?php echo e(__('product.making_charge')); ?>

                                                </label>
                                                <input class="primary_input_field" name="making_charge" id="making_charge" placeholder="-" type="number" min="0"
                                                    step="<?php echo e(step_decimal()); ?>" value="<?php echo e($product->making_charge); ?>">
                                                <span class="text-danger" id="error_making_charge"><?php echo e($errors->first('making_charge')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="RelatedProduct">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.related_product')); ?></h3>

                            </div>
                        </div>
                        <input class="primary_input_field" placeholder="Quick Search" type="text" id="rsearch_products">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table" id="related_product">
                                <!-- table-responsive -->
                                <div class="table-responsive" id="product_list_div">
                                    <table class="table">
                                        <thead>

                                            <tr>
                                                <th width="10%" scope="col">
                                                    <label class="primary_checkbox d-flex ">
                                                        <input type="checkbox" id="relatedProductAll">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th width="25%" scope="col"><?php echo e(__('common.name')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.brand')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.thumbnail')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.created_at')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontentsrelatedProduct">
                                            <?php if(count(@$relatedProducts) > 0): ?>
                                                <?php $__currentLoopData = @$relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $relatedSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="col">
                                                        <label class="primary_checkbox d-flex">
                                                            <input name="related_product[]" id="related_product_<?php echo e($key); ?>" checked value="<?php echo e($relatedSale->main_product->id); ?>" type="checkbox" class="related_product_checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <td><?php echo e($relatedSale->main_product->product_name); ?></td>
                                                    <td><?php echo e(@$relatedSale->main_product->brand->name); ?></td>
                                                    <td>
                                                        <div class="product_img_div">
                                                            <img class="product_list_img"
                                                                src="<?php echo e(showImage($relatedSale->main_product->thumbnail_image_source)); ?>"
                                                                alt="<?php echo e($relatedSale->main_product->product_name); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e(date(app('general_setting')->dateFormat->format, strtotime($relatedSale->main_product->created_at))); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="pagination-container">
                                        <?php
                                        echo $relatedProducts->links();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="related_product_hidden_name" id="related_product_hidden_id">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="UpSale">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.up_sale')); ?></h3>
                            </div>
                        </div>
                        <input class="primary_input_field" placeholder="Quick Search" type="text" id="upsale_search_products">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table" id="upsale_products">
                                <!-- table-responsive -->
                                <div class="table-responsive" id="product_list_div">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="10%" scope="col">
                                                    <label class="primary_checkbox d-flex ">
                                                        <input type="checkbox" id="upSaleAll">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th width="25%" scope="col"><?php echo e(__('common.name')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.brand')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.thumbnail')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.created_at')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontentsupSaleAll">
                                            <?php if(count(@$upSales) > 0): ?>
                                            <?php $__currentLoopData = $upSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $upSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="col">
                                                        <label class="primary_checkbox d-flex">
                                                            <input name="up_sale[]" id="up_sale_<?php echo e($key); ?>" checked value="<?php echo e($upSale->main_product->id); ?>" type="checkbox" class="upsale_product_checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <td><?php echo e($upSale->main_product->product_name); ?></td>
                                                    <td><?php echo e(@$upSale->main_product->brand->name); ?></td>
                                                    <td>
                                                        <div class="product_img_div">
                                                            <img class="product_list_img" src="<?php echo e(showImage($upSale->main_product->thumbnail_image_source)); ?>" alt="<?php echo e($upSale->main_product->product_name); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e(date(app('general_setting')->dateFormat->format, strtotime($upSale->main_product->created_at))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="pagination-container">
                                        <?php
                                        echo $upSales->links();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="upsale_product_hidden_name" id="upsale_product_hidden_id">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="CrossSale">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.cross_sale')); ?></h3>
                            </div>
                        </div>
                        <input class="primary_input_field" placeholder="Quick Search" type="text" id="crosssale_search_products">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table" id="crosssale_products">
                                <!-- table-responsive -->
                                <div class="table-responsive" id="product_list_div">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="10%" scope="col">
                                                    <label class="primary_checkbox d-flex ">
                                                        <input type="checkbox" id="crossSaleAll">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th width="25%" scope="col"><?php echo e(__('common.name')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.brand')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.thumbnail')); ?></th>
                                                <th width="15%" scope="col"><?php echo e(__('product.created_at')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontentscrossSaleAll">
                                            <?php if(count(@$crossSales) > 0): ?>
                                            <?php $__currentLoopData = $crossSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $crossSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="col">
                                                        <label class="primary_checkbox d-flex">
                                                            <input name="cross_sale[]" id="cross_sale_<?php echo e($key); ?>" checked value="<?php echo e($crossSale->main_product->id); ?>" type="checkbox" class="crosssale_product_checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <td><?php echo e($crossSale->main_product->product_name); ?></td>
                                                    <td><?php echo e(@$crossSale->main_product->brand->name); ?></td>
                                                    <td>
                                                        <div class="product_img_div">
                                                            <img class="product_list_img"
                                                                src="<?php echo e(showImage($crossSale->main_product->thumbnail_image_source)); ?>"
                                                                alt="<?php echo e($crossSale->main_product->product_name); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e(date(app('general_setting')->dateFormat->format, strtotime($crossSale->main_product->created_at))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="pagination-container">
                                        <?php
                                        echo $crossSales->links();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="crosssale_product_hidden_name" id="crosssale_product_hidden_id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="primary_btn_2 mt-5 text-center saveBtn"><i class="ti-check"></i><?php echo e(__('common.update')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php echo $__env->make('product::products.components._create_category_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('product::products.components._create_brand_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('product::products.components._create_unit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('product::products.components._create_shipping_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('product::products.edit_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/edit.blade.php ENDPATH**/ ?>