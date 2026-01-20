<div class="row">
<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div id="formHtml" class="col-lg-12 mb-20">
    <div class="white-box minh-250">
        <div class="add-visitor">
            <?php if($menu->menu_type == 'mega_menu'): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0 create-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <button class="btn btn-link add_btn_link"><?php echo e(__('menu.add_column')); ?></button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <form id="add_row_btn">
                                            <div id="row_element_div" class="row">
                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                    <div class="col-lg-12">
                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#rowelement<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="rowelement<?php echo e($language->code); ?>">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="name"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                        <input class="primary_input_field name" type="text" id="row<?php echo e($language->code); ?>" name="row[<?php echo e($language->code); ?>]" autocomplete="off" placeholder="<?php echo e(__('menu.column')); ?>">
                                                                    </div>
                                                                    <span class="text-danger" id="error_row_<?php echo e($language->code); ?>"></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for="name"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                            <input class="primary_input_field name" type="text" id="row" name="row" autocomplete="off" placeholder="<?php echo e(__('menu.column')); ?>">
                                                        </div>
                                                        <span class="text-danger" id="error_row"></span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for="size"><?php echo e(__('menu.size')); ?> <span class="text-danger">*</span></label>
                                                        <select name="size" id="size" class="primary_select mb-15">
                                                            <option data-display="<?php echo e(__('menu.select_size')); ?>" value=""><?php echo e(__('menu.size')); ?></option>
                                                            <option value="1/1"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(1)); ?></option>
                                                            <option value="1/2"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(2)); ?></option>
                                                            <option value="1/3"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(3)); ?></option>
                                                            <option value="1/4"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(4)); ?></option>
                                                        </select>
                                                        <span class="text-danger" id="error_size"></span>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title="" data-original-title=""><span class="ti-check"></span><?php echo e(__('menu.add_to_menu')); ?> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10 mt-10">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <button class="btn btn-link add_btn_link"> <?php echo e(__('menu.add_links')); ?> </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <form id="add_link_btn">
                                            <div class="row">
                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                    <div class="col-lg-12">
                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span> </label>
                                                                        <input class="primary_input_field title" type="text" id="title<?php echo e($language->code); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="" placeholder="<?php echo e(__('common.title')); ?>">
                                                                    </div>
                                                                    <span class="text-danger" id="error_title_<?php echo e($language->code); ?>"></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span> </label>
                                                            <input class="primary_input_field title" type="text" id="title" name="title" autocomplete="off" value="" placeholder="<?php echo e(__('common.title')); ?>">
                                                        </div>
                                                        <span class="text-danger" id="error_title"></span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="link"><?php echo e(__('common.link')); ?> </label>
                                                        <input class="primary_input_field link" type="text" id="link" name="link" autocomplete="off" value="" placeholder="<?php echo e(__('common.link')); ?>">
                                                    </div>
                                                    <span class="text-danger" id="error_link"></span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                        <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase">
                                                        <span class="text-danger"  id="error_icon"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title="" data-original-title=""> <span class="ti-check"></span><?php echo e(__('menu.add_to_menu')); ?> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_categories')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                        for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                    <select name="category" id="category" multiple
                                                        class="mb-15">
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_category_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingPages">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#pages" aria-expanded="false"
                                    aria-controls="collapsePages">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_pages')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="pages" class="collapse" aria-labelledby="headingPages"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                        for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                    <select name="page" id="page" class="primary_select mb-15"
                                                        multiple>
                                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($page->id); ?>">
                                                                <?php echo e($page->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_page_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingProduct">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#products" aria-expanded="false"
                                    aria-controls="collapseProduct">
                                        <button class="btn btn-link add_btn_link ">
                                            <?php echo e(__('menu.add_product')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="products" class="collapse" aria-labelledby="headingProduct"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                    <select name="product" id="product" class="mb-15"
                                                        multiple>
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo e($errors->first('barcode_type')); ?></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_product_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-10">
                                <div class="card-header" id="headingBrand">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#brands" aria-expanded="false"
                                    aria-controls="collapseBrand">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_brand')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="brands" class="collapse" aria-labelledby="headingBrand"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                    <select name="brand" id="brand" class="mb-15"
                                                        multiple>
                                                        
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_brand_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTag">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#tags" aria-expanded="false" aria-controls="collapseTag">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_tag')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="tags" class="collapse" aria-labelledby="headingTag"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?>

                                                        <span class="text-danger">*</span></label>
                                                    <select name="tag" id="tag" class="mb-15"
                                                        multiple>
                                                        
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_tag_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif($menu->menu_type == 'normal_menu'): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion">
                            <div class="card mb-10 mt-10">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                        <button class="btn btn-link add_btn_link ">
                                            <?php echo e(__('menu.add_links')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <form id="add_link_btn">
                                            <div class="row">
                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                    <div class="col-lg-12">
                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#element<?php echo e($language->code); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="element<?php echo e($language->code); ?>">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="title"> <?php echo e(__('common.title')); ?> <span class="text-danger">*</span> </label>
                                                                        <input class="primary_input_field title" type="text" id="title<?php echo e($language->code); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="" placeholder="<?php echo e(__('common.title')); ?>">
                                                                    </div>
                                                                    <span class="text-danger" id="error_title_<?php echo e($language->code); ?>"></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for="title"><?php echo e(__('common.title')); ?> <span class="text-danger">*</span></label>
                                                            <input class="primary_input_field title" type="text" id="title" name="title" autocomplete="off" value="" placeholder="<?php echo e(__('common.title')); ?>">
                                                        </div>
                                                        <span class="text-danger" id="error_title"></span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="link"><?php echo e(__('common.link')); ?></label>
                                                        <input class="primary_input_field link" type="text" id="link" name="link" autocomplete="off" value="" placeholder="<?php echo e(__('common.link')); ?>">
                                                    </div>
                                                    <span class="text-danger" id="error_name"></span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                        <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase">
                                                        <span class="text-danger"  id="error_icon"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"><span class="ti-check"></span><?php echo e(__('menu.add_to_menu')); ?> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_categories')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                        for=""><?php echo e(__('common.category')); ?> <span
                                                            class="text-danger">*</span></label>
                                                    <select name="category" id="category"
                                                        class="mb-15" multiple>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_category_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingPages">
                                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse"
                                    data-target="#pages" aria-expanded="false"
                                    aria-controls="collapsePages">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_pages')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="pages" class="collapse" aria-labelledby="headingPages"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?>

                                                        <span class="text-danger">*</span></label>
                                                    <select name="page" id="page" class="primary_select mb-15"
                                                        multiple>
                                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($page->id); ?>">
                                                                <?php echo e($page->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_page_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-10">
                                <div class="card-header" id="headingProduct">
                                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse"
                                    data-target="#products" aria-expanded="false"
                                    aria-controls="collapseProduct">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_product')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="products" class="collapse" aria-labelledby="headingProduct"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                    <select name="product" id="product" class="mb-15" multiple>
                                                    </select>
                                                    <span class="text-danger"><?php echo e($errors->first('barcode_type')); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_product_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-10">
                                <div class="card-header" id="headingBrand">
                                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse"
                                    data-target="#brands" aria-expanded="false"
                                    aria-controls="collapseBrand">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_brand')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="brands" class="collapse" aria-labelledby="headingBrand"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?>

                                                        <span class="text-danger">*</span></label>
                                                    <select name="brand" id="brand" class="mb-15"
                                                        multiple>
                                                    </select>
                                                    <span
                                                        class="text-danger"><?php echo e($errors->first('barcode_type')); ?></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_brand_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-10">
                                <div class="card-header" id="headingTag">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#tags" aria-expanded="false" aria-controls="collapseTag">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('menu.add_tag')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="tags" class="collapse" aria-labelledby="headingTag"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?>

                                                        <span class="text-danger">*</span></label>
                                                    <select name="tag" id="tag" class="mb-15"
                                                        multiple>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_tag_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFunc">
                                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse"
                                    data-target="#funcs" aria-expanded="false" aria-controls="collapseFunc">
                                        <button class="btn btn-link add_btn_link">
                                            <?php echo e(__('Add functions')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="funcs" class="collapse" aria-labelledby="headingFunc"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('menu.functions')); ?>

                                                        <span class="text-danger">*</span></label>
                                                    <select name="function" id="function" class="primary_select mb-15">
                                                        <option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>
                                                        <option value="1"><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button id="add_func_btn" type="submit"
                                                    class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo e(__('menu.add_to_menu')); ?> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif($menu->menu_type == 'multi_mega_menu'): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingMenu">
                                    <h5 class="mb-0 create-title collapsed" data-toggle="collapse"
                                    data-target="#menus" aria-expanded="false" aria-controls="collapseMenu">
                                        <button class="btn btn-link add_btn_link" >
                                            <?php echo e(__('menu.add_menu')); ?>

                                        </button>
                                    </h5>
                                </div>
                                <div id="menus" class="collapse" aria-labelledby="headingMenu"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for=""><?php echo e(__('menu.menu')); ?> <span class="text-danger">*</span></label>
                                                <select name="menu" id="menu" class="primary_select mb-15" multiple>
                                                    <?php $__currentLoopData = $menus->where('menu_type', '!=', 'normal_menu'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menu->id); ?>"><?php echo e($menu->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button id="add_menu_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title=""
                                                data-original-title="">
                                                <span class="ti-check"></span>
                                                <?php echo e(__('menu.add_to_menu')); ?> </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/create_element.blade.php ENDPATH**/ ?>