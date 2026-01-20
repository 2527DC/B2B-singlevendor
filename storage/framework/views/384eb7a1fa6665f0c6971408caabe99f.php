<?php if(isModuleActive('FrontendMultiLang')): ?>
<?php
$LanguageList = getLanguageList();
?>
<?php endif; ?>
<div class="menu_item_div">
    <?php if($menu->menu_type == 'mega_menu'): ?>
        <div id="itemDiv" class="row">
            <?php $__currentLoopData = $menu->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12 card mb-10 column_header_div" data-id="<?php echo e($column->id); ?>">
                <div class="card-header card_header" id="accordion_column_<?php echo e($column->id); ?>">
                    <h4 class="d-inline"><?php echo e($column->column); ?>[<?php echo e(getNumberTranslate($column->size)); ?>] (<?php echo e(__('menu.column')); ?>)</h4>
                    <div class="pull-right">
                        <a href="javascript:void(0);" class="panel-title d-inline  mr-10 primary-btn" data-toggle="collapse" data-target="#collapse_column_<?php echo e($column->id); ?>" aria-expanded="false" aria-controls="collapse_column_<?php echo e($column->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                        <a href="" data-id="<?php echo e($column->id); ?>" class="d-inline primary-btn column_delete_btn"><i class="ti-close"></i></a>
                    </div>

                    <div class="mt-20 column_edit_div collapse" id="collapse_column_<?php echo e($column->id); ?>" aria-labelledby="heading_column_<?php echo e($column->id); ?>" data-parent="#accordion_column_<?php echo e($column->id); ?>">
                        <form enctype="multipart/form-data" id="columnEditForm" data-column_id="<?php echo e($column->id); ?>">
                            <div class="row">
                                <input type="hidden" name="column_id" value="<?php echo e($column->id); ?>">
                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#megamenuelement<?php echo e($language->code); ?><?php echo e($column->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="megamenuelement<?php echo e($language->code); ?><?php echo e($column->id); ?>">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="name"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                        <input class="primary_input_field editname" type="text" id="edit_column<?php echo e($language->code); ?><?php echo e($column->id); ?>" name="column[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($column)?$column->getTranslation('column',$language->code):old('column.'.$language->code)); ?>"  placeholder="<?php echo e(__('menu.column')); ?>" >
                                                    </div>
                                                    <span class="text-danger" id="error_edit_column<?php echo e($language->code); ?><?php echo e($column->id); ?>"></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="name"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                            <input class="primary_input_field editname" type="text" id="edit_column<?php echo e($column->id); ?>" name="column" autocomplete="off" value="<?php echo e($column->column); ?>"  placeholder="<?php echo e(__('menu.column')); ?>" >
                                        </div>
                                        <span class="text-danger" id="error_edit_column<?php echo e($column->id); ?>"></span>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-12">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for=""><?php echo e(__('common.size')); ?> <span class="text-danger">*</span></label>
                                        <select name="size" id="edit_size<?php echo e($column->id); ?>" class="primary_select mb-15 edit_size">
                                            <option data-display="Select Size" value=""><?php echo e(__('common.size')); ?></option>
                                            <option <?php echo e($column->size =='1/1'?'selected':''); ?> value="1/1"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(1)); ?></option>
                                            <option <?php echo e($column->size =='1/2'?'selected':''); ?> value="1/2"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(2)); ?></option>
                                            <option <?php echo e($column->size =='1/3'?'selected':''); ?> value="1/3"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(3)); ?></option>
                                            <option <?php echo e($column->size =='1/4'?'selected':''); ?> value="1/4"><?php echo e(getNumberTranslate(1)); ?>/<?php echo e(getNumberTranslate(4)); ?></option>
                                        </select>
                                    </div>
                                    <span class="text-danger" id="error_edit_size<?php echo e($column->id); ?>"></span>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn fix-gr-bg"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

                <div class="card-body p-10 item_list" data-id="<?php echo e($column->id); ?>">
                    <?php $__currentLoopData = @$column->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                        <div class="mb-10">
                            <div class="card" id="accordion_<?php echo e($element->id); ?>">
                                <div class="card-header card_header_element">
                                    <p class="d-inline">
                                        <?php if($element->type == 'category'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)

                                        <?php elseif($element->type == 'link'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)

                                        <?php elseif($element->type == 'page'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)

                                        <?php elseif($element->type == 'product'): ?>
                                        <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                        (<?php echo e(__('common.product')); ?>)

                                        <?php elseif($element->type == 'brand'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)

                                        <?php elseif($element->type == 'tag'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)

                                        <?php endif; ?>
                                    </p>
                                    <div class="pull-right">

                                        <a href="javascript:void(0);" class="d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                        <a href="" data-id="<?php echo e($element->id); ?>" class="d-inline primary-btn element_delete_btn"><i class="ti-close"></i></a>
                                    </div>
                                </div>

                                <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                    <div class="card-body">
                                        <form enctype="multipart/form-data" id="elementEditForm" data-element_type= "<?php echo e($element->type); ?>" data-element_id= "<?php echo e($element->id); ?>">
                                            <div class="row">
                                                <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                <input type="hidden" name="type" class="element_type" value="<?php echo e($element->type); ?>">
                                                <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                    <div class="col-lg-12">
                                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#megalistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="megalistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                        <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                    </div>
                                                                    <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                    
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                            <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                            <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($element->type == 'link'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="link"><?php echo e(__('common.link')); ?></label>
                                                        <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                        <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                        <span class="text-danger"  id="error_icon"></span>
                                                    </div>
                                                </div>
                                                <?php elseif($element->type == 'category'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                        <select name="category" class="mb-15 edit_category">
                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                            <?php
                                                                $depth = '';
                                                                for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                    $depth .='-';
                                                                }
                                                                $depth.='> ';
                                                            ?>
                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>

                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>


                                                </div>
                                                <?php elseif($element->type == 'page'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                        <select name="page" class="primary_select mb-15 edit_page">
                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                </div>
                                                <?php elseif($element->type == 'product'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                        <select name="product" class="mb-15 edit_product">
                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                            
                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <?php elseif($element->type == 'brand'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                        <select name="brand" class="mb-15 edit_brand">
                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                            
                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <?php elseif($element->type == 'tag'): ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                        <select name="tag" class="mb-15 edit_tag">
                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                        </select>
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
                                                                <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
        <div class="mt-20 white-box p-15">
            <h4><?php echo e(__('menu.menu_item_list')); ?></h4>
            <div id="elementDiv">
                <?php if(count(@$menu->notUsedElement)>0): ?>
                <?php $__currentLoopData = @$menu->notUsedElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                    <div class="mb-10">
                        <div class="card" id="accordion_<?php echo e($element->id); ?>">
                            <div class="card-header card_header_element">
                                <p class="d-inline">
                                    <?php if($element->type == 'category'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)

                                        <?php elseif($element->type == 'link'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)

                                        <?php elseif($element->type == 'page'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)

                                        <?php elseif($element->type == 'product'): ?>
                                        <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                        (<?php echo e(__('common.product')); ?>)

                                        <?php elseif($element->type == 'brand'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.brand')); ?>)

                                        <?php elseif($element->type == 'tag'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)

                                        <?php endif; ?>
                                </p>
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class="d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                    <a href="" data-id="<?php echo e($element->id); ?>" class="d-inline primary-btn element_delete_btn"><i class="ti-close"></i></a>
                                </div>

                            </div>
                            <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" id="elementEditForm" data-element_type="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                            <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                        <?php if(isModuleActive('FrontendMultiLang')): ?>
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#menulistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <div class="tab-content">
                                                    <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="menulistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                            </div>
                                                            <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                            
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="title"> <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                    <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                    <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                            <?php if($element->type == 'link'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="link">
                                                        <?php echo e(__('common.link')); ?>


                                                    </label>
                                                    <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                </div>
                                            </div>

                                            <?php elseif($element->type == 'category'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                    <select name="category" class="mb-15 edit_category">
                                                        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <?php
                                                            $depth = '';
                                                            for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                $depth .='-';
                                                            }
                                                            $depth.='> ';
                                                        ?>
                                                        <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>


                                            </div>
                                            <?php elseif($element->type == 'page'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                    <select name="page" class="primary_select mb-15 edit_page">
                                                        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <?php elseif($element->type == 'product'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                    <select name="product" class="mb-15 edit_product">
                                                        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                    </select>
                                                </div>

                                            </div>
                                            <?php elseif($element->type == 'brand'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                    <select name="brand" class="mb-15 edit_brand">
                                                        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                    </select>
                                                </div>

                                            </div>
                                            <?php elseif($element->type == 'tag'): ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                    <select name="tag" class="mb-15 edit_tag">
                                                        <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                        <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                    </select>
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
                                                            <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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

                <?php endif; ?>
            </div>
        </div>
    <?php elseif($menu->menu_type == 'normal_menu'): ?>
        <?php if(count(@$menu->elements)>0): ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="accordion" class="dd">
                            <ol class="dd-list">
                                <?php $__currentLoopData = $menu->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="dd-item" data-id="<?php echo e($element->id); ?>">
                                    <div class="card accordion_card" id="accordion_<?php echo e($element->id); ?>">
                                        <div class="card-header item_header" id="heading_<?php echo e($element->id); ?>">
                                            <div class="dd-handle">
                                                <div class="pull-left">
                                                    <?php if($element->type == 'category'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)
                                                    <?php elseif($element->type == 'link'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)
                                                    <?php elseif($element->type == 'page'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)

                                                    <?php elseif($element->type == 'product'): ?>
                                                        <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                                        (<?php echo e(__('common.product')); ?>)
                                                    <?php elseif($element->type == 'brand'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)
                                                    <?php elseif($element->type == 'tag'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)
                                                    <?php elseif($element->type == 'function'): ?>
                                                        <?php echo e(@$element->title); ?> (<?php echo e(__('menu.function')); ?>)
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                            <div class="pull-right btn_div">
                                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>" class="primary-btn btn_zindex panel-title"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow_normal"></span></a>
                                                <a href="" data-id="<?php echo e($element->id); ?>" class="primary-btn element_delete_btn btn_zindex"><i class="ti-close"></i></a>
                                            </div>
                                        </div>
                                        <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                            <div class="card-body">
                                                <form enctype="multipart/form-data" id="elementEditForm" data-element_type ="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                        <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                        <div class="col-lg-12">
                                                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                            <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                        </div>
                                                                        <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                        
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                        <?php if($element->type == 'link'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="link"><?php echo e(__('common.link')); ?> </label>
                                                                <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                                <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                                <span class="text-danger"  id="error_icon"></span>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'category'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                <select name="category" class="mb-15 edit_category">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <?php
                                                                        $depth = '';
                                                                        for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                            $depth .='-';
                                                                        }
                                                                        $depth.='> ';
                                                                    ?>
                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                </select>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'page'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                <select name="page" class="primary_select mb-15 edit_page">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'product'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                                <select name="product" class="mb-15 edit_product">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'brand'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                                <select name="brand" class="mb-15 edit_brand">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'tag'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                                <select name="tag" class="mb-15 edit_tag">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php elseif($element->type == 'function'): ?>
                                                        <div class="col-lg-12">
                                                            <div class="primary_input mb-15">
                                                                <label class="primary_input_label" for=""><?php echo e(__('menu.function')); ?> <span class="text-danger">*</span></label>
                                                                <select name="function" class="primary_select mb-15 edit_function">
                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                    <option value="1" <?php echo e($element->element_id == 1?'selected':''); ?>><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="col-xl-12">
                                                            <div class="primary_input">
                                                                <label class="primary_input_label" for=""><?php echo e(__('common.show')); ?></label>
                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                    <li>
                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="show" <?php echo e($element->show == 1?'checked':''); ?> id="show_active" value="1" checked="true" class="active"
                                                                                type="radio">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('menu.left')); ?></p>
                                                                    </li>
                                                                    <li>
                                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="show" <?php echo e($element->show == 0?'checked':''); ?> value="0" id="show_inactive" class="de_active" type="radio">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('menu.right')); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="primary_input">
                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                    <li>
                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                            <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 text-center">
                                                            <div class="d-flex justify-content-center pt_20">
                                                                <button type="submit" class="primary-btn fix-gr-bg"><i class="ti-check"></i><?php echo e(__('common.update')); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <ol class="dd-list">
                                        <?php $__currentLoopData = $element->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="dd-item" data-id="<?php echo e($element->id); ?>">
                                            <div class="card accordion_card" id="accordion_<?php echo e($element->id); ?>">
                                                <div class="card-header item_header" id="heading_<?php echo e($element->id); ?>">
                                                    <div class="dd-handle">
                                                        <div class="pull-left">
                                                            <?php if($element->type == 'category'): ?>
                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)

                                                            <?php elseif($element->type == 'link'): ?>
                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)

                                                            <?php elseif($element->type == 'page'): ?>
                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)

                                                            <?php elseif($element->type == 'product'): ?>
                                                            <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                                            (<?php echo e(__('common.product')); ?>)

                                                            <?php elseif($element->type == 'brand'): ?>
                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)

                                                            <?php elseif($element->type == 'tag'): ?>
                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)
                                                            <?php elseif($element->type == 'function'): ?>
                                                                <?php echo e(@$element->title); ?> (<?php echo e(__('menu.function')); ?>)
                                                            <?php endif; ?>
                                                        </div>

                                                    </div>
                                                    <div class="pull-right btn_div">
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>" class="primary-btn btn_zindex panel-title"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow_normal"></span></a>
                                                        <a href="" data-id="<?php echo e($element->id); ?>" class="primary-btn element_delete_btn btn_zindex"><i class="ti-close"></i></a>
                                                    </div>
                                                </div>
                                                <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                                    <div class="card-body">
                                                        <form enctype="multipart/form-data" id="elementEditForm" data-element_type="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                                            <div class="row">
                                                                <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                                <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                <div class="col-lg-12">
                                                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#menuchildlistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="menuchildlistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                                <div class="primary_input mb-25">
                                                                                    <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                    <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                </div>
                                                                                <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                                
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="title">
                                                                            <?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                        <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                        <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php if($element->type == 'link'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="link">
                                                                            <?php echo e(__('common.link')); ?>


                                                                        </label>
                                                                        <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                                        <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                                        <span class="text-danger"  id="error_icon"></span>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'category'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="category" class="mb-15 edit_category">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <?php
                                                                                $depth = '';
                                                                                for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                                    $depth .='-';
                                                                                }
                                                                                $depth.='> ';
                                                                            ?>
                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                        </select>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'page'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="page" class="primary_select mb-15 edit_page">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'product'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="product" class="mb-15 edit_product">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                                        </select>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'brand'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="brand" class="mb-15 edit_brand">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'tag'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="tag" class="mb-15 edit_tag">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php elseif($element->type == 'function'): ?>
                                                                <div class="col-lg-12">
                                                                    <div class="primary_input mb-15">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                        <select name="function" class="primary_select mb-15 edit_function">
                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                            <option value="1" <?php echo e($element->element_id == 1?'selected':''); ?>><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.show')); ?></label>
                                                                        <ul id="theme_nav" class="permission_list sms_list ">
                                                                            <li>
                                                                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                    <input name="show" <?php echo e($element->show == 1?'checked':''); ?> id="show_active" value="1" checked="true" class="active"
                                                                                        type="radio">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <p><?php echo e(__('menu.left')); ?></p>
                                                                            </li>
                                                                            <li>
                                                                                <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                                    <input name="show" <?php echo e($element->show == 0?'checked':''); ?> value="0" id="show_inactive" class="de_active" type="radio">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <p><?php echo e(__('menu.right')); ?></p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input">
                                                                        <ul id="theme_nav" class="permission_list sms_list ">
                                                                            <li>
                                                                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                    <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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
                                            <ol class="dd-list">
                                                <?php $__currentLoopData = $element->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="dd-item" data-id="<?php echo e($element->id); ?>">
                                                    <div class="card accordion_card" id="accordion_<?php echo e($element->id); ?>">
                                                        <div class="card-header item_header" id="heading_<?php echo e($element->id); ?>">
                                                            <div class="dd-handle">
                                                                <div class="pull-left">
                                                                    <?php if($element->type == 'category'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)
                                                                    <?php elseif($element->type == 'link'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)
                                                                    <?php elseif($element->type == 'page'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)
                                                                    <?php elseif($element->type == 'product'): ?>
                                                                    <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                                                    (<?php echo e(__('common.product')); ?>)
                                                                    <?php elseif($element->type == 'brand'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)
                                                                    <?php elseif($element->type == 'tag'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)
                                                                    <?php elseif($element->type == 'function'): ?>
                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('menu.function')); ?>)
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="pull-right btn_div">
                                                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>" class="primary-btn btn_zindex panel-title"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow_normal"></span></a>
                                                                <a href="" data-id="<?php echo e($element->id); ?>" class="primary-btn element_delete_btn btn_zindex"><i class="ti-close"></i></a>
                                                            </div>
                                                        </div>
                                                        <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                                            <div class="card-body">
                                                                <form enctype="multipart/form-data" id="elementEditForm" data-element_type="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                                                    <div class="row">
                                                                        <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                                        <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                        <div class="col-lg-12">
                                                                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#menuchild2listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                                    </li>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </ul>
                                                                            <div class="tab-content">
                                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="menuchild2listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                                        <div class="primary_input mb-25">
                                                                                            <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                            <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                        </div>
                                                                                        <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                        <?php if($element->type == 'link'): ?>

                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label" for="link"> <?php echo e(__('common.link')); ?> </label>
                                                                                <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                                                <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                                                <span class="text-danger"  id="error_icon"></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php elseif($element->type == 'category'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="category" class="mb-15 edit_category">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <?php
                                                                                        $depth = '';
                                                                                        for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                                            $depth .='-';
                                                                                        }
                                                                                        $depth.='> ';
                                                                                    ?>
                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                                </select>
                                                                                <span class="text-danger"></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php elseif($element->type == 'page'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="page" class="primary_select mb-15 edit_page">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>
                                                                                <span class="text-danger"></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php elseif($element->type == 'product'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="product" class="mb-15 edit_product">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php elseif($element->type == 'brand'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="brand" class="mb-15 edit_brand">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php elseif($element->type == 'tag'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="tag" class="mb-15 edit_tag">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                                                </select>
                                                                            </div>

                                                                        </div>

                                                                        <?php elseif($element->type == 'function'): ?>
                                                                        <div class="col-lg-12">
                                                                            <div class="primary_input mb-15">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                <select name="function" class="primary_select mb-15 edit_function">
                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                    <option value="1" <?php echo e($element->element_id == 1?'selected':''); ?>><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <div class="col-xl-12">
                                                                            <div class="primary_input">
                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.show')); ?></label>
                                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                                    <li>
                                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                            <input name="show" <?php echo e($element->show == 1?'checked':''); ?> id="show_active" value="1" checked="true" class="active"
                                                                                                type="radio">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                        <p><?php echo e(__('menu.left')); ?></p>
                                                                                    </li>
                                                                                    <li>
                                                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                                            <input name="show" <?php echo e($element->show == 0?'checked':''); ?> value="0" id="show_inactive" class="de_active" type="radio">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                        <p><?php echo e(__('menu.right')); ?></p>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12">
                                                                            <div class="primary_input">
                                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                                    <li>
                                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                            <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                        <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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
                                                    <ol class="dd-list">
                                                        <?php $__currentLoopData = $element->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="dd-item" data-id="<?php echo e($element->id); ?>">
                                                            <div class="card accordion_card" id="accordion_<?php echo e($element->id); ?>">
                                                                <div class="card-header item_header" id="heading_<?php echo e($element->id); ?>">
                                                                    <div class="dd-handle">
                                                                        <div class="pull-left">
                                                                            <?php if($element->type == 'category'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)
                                                                            <?php elseif($element->type == 'link'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)
                                                                            <?php elseif($element->type == 'page'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)
                                                                            <?php elseif($element->type == 'product'): ?>
                                                                            <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                                                            (<?php echo e(__('common.product')); ?>)
                                                                            <?php elseif($element->type == 'brand'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)
                                                                            <?php elseif($element->type == 'tag'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)
                                                                            <?php elseif($element->type == 'function'): ?>
                                                                            <?php echo e(@$element->title); ?> (<?php echo e(__('menu.function')); ?>)
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right btn_div">
                                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>" class="primary-btn btn_zindex panel-title"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow_normal"></span></a>
                                                                        <a href="" data-id="<?php echo e($element->id); ?>" class="primary-btn element_delete_btn btn_zindex"><i class="ti-close"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                                                    <div class="card-body">
                                                                        <form enctype="multipart/form-data" id="elementEditForm" data-element_type="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                                                            <div class="row">
                                                                                <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                                                <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                                                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                                <div class="col-lg-12">
                                                                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#normalchildlistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                                            </li>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </ul>
                                                                                    <div class="tab-content">
                                                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="normalchildlistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                                                <div class="primary_input mb-25">
                                                                                                    <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                                    <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                                </div>
                                                                                                <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                                                
                                                                                            </div>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </div>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-25">
                                                                                        <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                        <input class="primary_input_field edit_title" type="text" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                                <?php if($element->type == 'link'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-25">
                                                                                        <label class="primary_input_label" for="link">
                                                                                            <?php echo e(__('common.link')); ?>

                                                                                        </label>
                                                                                        <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-25">
                                                                                        <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                                                        <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                                                        <span class="text-danger"  id="error_icon"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <?php elseif($element->type == 'category'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="category" class="mb-15 edit_category">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <?php
                                                                                                $depth = '';
                                                                                                for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                                                    $depth .='-';
                                                                                                }
                                                                                                $depth.='> ';
                                                                                            ?>
                                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                                        </select>
                                                                                        <span class="text-danger"></span>
                                                                                    </div>


                                                                                </div>
                                                                                <?php elseif($element->type == 'page'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="page" class="primary_select mb-15 edit_page">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        </select>
                                                                                        <span class="text-danger"></span>
                                                                                    </div>

                                                                                </div>
                                                                                <?php elseif($element->type == 'product'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="product" class="mb-15 edit_product">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <?php elseif($element->type == 'brand'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="brand" class="mb-15 edit_brand">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <?php elseif($element->type == 'tag'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="tag" class="mb-15 edit_tag">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <?php elseif($element->type == 'function'): ?>
                                                                                <div class="col-lg-12">
                                                                                    <div class="primary_input mb-15">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                        <select name="function" class="primary_select mb-15 edit_function">
                                                                                            <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                            <option value="1" <?php echo e($element->element_id == 1?'selected':''); ?>><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                                <div class="col-xl-12">
                                                                                    <div class="primary_input">
                                                                                        <label class="primary_input_label" for=""><?php echo e(__('common.show')); ?></label>
                                                                                        <ul id="theme_nav" class="permission_list sms_list ">
                                                                                            <li>
                                                                                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                                    <input name="show" <?php echo e($element->show == 1?'checked':''); ?> id="show_active" value="1" checked="true" class="active"
                                                                                                        type="radio">
                                                                                                    <span class="checkmark"></span>
                                                                                                </label>
                                                                                                <p><?php echo e(__('menu.left')); ?></p>
                                                                                            </li>
                                                                                            <li>
                                                                                                <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                                                    <input name="show" <?php echo e($element->show == 0?'checked':''); ?> value="0" id="show_inactive" class="de_active" type="radio">
                                                                                                    <span class="checkmark"></span>
                                                                                                </label>
                                                                                                <p><?php echo e(__('menu.right')); ?></p>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <div class="primary_input">
                                                                                        <ul id="theme_nav" class="permission_list sms_list ">
                                                                                            <li>
                                                                                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                                    <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                                                    <span class="checkmark"></span>
                                                                                                </label>
                                                                                                <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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
                                                            <ol class="dd-list">
                                                                <?php $__currentLoopData = $element->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="dd-item" data-id="<?php echo e($element->id); ?>">
                                                                    <div class="card accordion_card" id="accordion_<?php echo e($element->id); ?>">
                                                                        <div class="card-header item_header" id="heading_<?php echo e($element->id); ?>">
                                                                            <div class="dd-handle">
                                                                                <div class="pull-left">
                                                                                    <?php if($element->type == 'category'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.category')); ?>)
                                                                                    <?php elseif($element->type == 'link'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.link')); ?>)
                                                                                    <?php elseif($element->type == 'page'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.page')); ?>)
                                                                                    <?php elseif($element->type == 'product'): ?>
                                                                                    <?php echo e(@$element->title); ?> <?php if(isModuleActive('MultiVendor')): ?> [<?php if(@$element->product->seller->role->type == 'seller'): ?> <?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>] <?php endif; ?> 
                                                                                    (<?php echo e(__('common.product')); ?>)
                                                                                    <?php elseif($element->type == 'brand'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('product.brand')); ?>)
                                                                                    <?php elseif($element->type == 'tag'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('common.tag')); ?>)
                                                                                    <?php elseif($element->type == 'function'): ?>
                                                                                    <?php echo e(@$element->title); ?> (<?php echo e(__('menu.function')); ?>)
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="pull-right btn_div">
                                                                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>" class="primary-btn btn_zindex panel-title"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow_normal"></span></a>
                                                                                <a href="" data-id="<?php echo e($element->id); ?>" class="primary-btn element_delete_btn btn_zindex"><i class="ti-close"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                                                            <div class="card-body">
                                                                                <form enctype="multipart/form-data" id="elementEditForm" data-element_type="<?php echo e($element->type); ?>" data-element_id="<?php echo e($element->id); ?>">
                                                                                    <div class="row">
                                                                                        <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                                                                        <input type="hidden" name="type" value="<?php echo e($element->type); ?>">
                                                                                    <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#normalchild2listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                                                                    </li>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </ul>
                                                                                            <div class="tab-content">
                                                                                                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="normalchild2listelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                                                        <div class="primary_input mb-25">
                                                                                                            <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                                            <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                                        </div>
                                                                                                        <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                                                                    </div>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php else: ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-25">
                                                                                                <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                                                <input class="primary_input_field edit_title" type="text" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                        <?php if($element->type == 'link'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-25">
                                                                                                <label class="primary_input_label" for="link">
                                                                                                    <?php echo e(__('common.link')); ?>

                                                                                                </label>
                                                                                                <input class="primary_input_field link" type="text" name="link" autocomplete="off" value="<?php echo e($element->link); ?>"  placeholder="<?php echo e(__('common.link')); ?>">
                                                                                            </div>
                                                                                            <span class="text-danger" id="error_name"></span>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-25">
                                                                                                <label class="primary_input_label" for="icon"> <?php echo e(__('common.icon')); ?> (<?php echo e(__('menu.use_themefy_or_fontawesome_icon')); ?>) </label>
                                                                                                <input class="primary_input_field icp icon" type="text" id="icon" name="icon" autocomplete="off" placeholder="ti-briefcase" value="<?php echo e($element->icon); ?>">
                                                                                                <span class="text-danger"  id="error_icon"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'category'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.category')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="category" class="mb-15 edit_category">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <?php
                                                                                                        $depth = '';
                                                                                                        for($i= 1; $i <= $element->category->depth_level; $i++){
                                                                                                            $depth .='-';
                                                                                                        }
                                                                                                        $depth.='> ';
                                                                                                    ?>
                                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($depth . @$element->category->name); ?></option>
                                                                                                </select>
                                                                                                <span class="text-danger"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'page'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="page" class="primary_select mb-15 edit_page">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option <?php echo e($element->element_id == $page->id?'selected':''); ?> value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                </select>
                                                                                                <span class="text-danger"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'product'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.product')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="product" class="mb-15 edit_product">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e(@$element->product->product_name); ?> <?php if(isModuleActive('MultiVendor')): ?>[<?php if(@$element->product->seller->role->type == 'seller'): ?><?php echo e(@$element->product->seller->first_name); ?> <?php else: ?> Inhouse <?php endif; ?>]<?php endif; ?></option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'brand'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('product.brand')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="brand" class="mb-15 edit_brand">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->brand->name); ?></option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'tag'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.tag')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="tag" class="mb-15 edit_tag">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <option value="<?php echo e($element->element_id); ?>" selected><?php echo e($element->tag->name); ?></option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php elseif($element->type == 'function'): ?>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="primary_input mb-15">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.page')); ?> <span class="text-danger">*</span></label>
                                                                                                <select name="function" class="primary_select mb-15 edit_function">
                                                                                                    <option selected disabled value=""><?php echo e(__('common.select_one')); ?></option>
                                                                                                    <option value="1" <?php echo e($element->element_id == 1?'selected':''); ?>><?php echo e(__('menu.lang_and_currency')); ?></option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                        <div class="col-xl-12">
                                                                                            <div class="primary_input">
                                                                                                <label class="primary_input_label" for=""><?php echo e(__('common.show')); ?></label>
                                                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                                                    <li>
                                                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                                            <input name="show" <?php echo e($element->show == 1?'checked':''); ?> id="show_active" value="1" checked="true" class="active"
                                                                                                                type="radio">
                                                                                                            <span class="checkmark"></span>
                                                                                                        </label>
                                                                                                        <p><?php echo e(__('menu.left')); ?></p>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                                                                                            <input name="show" <?php echo e($element->show == 0?'checked':''); ?> value="0" id="show_inactive" class="de_active" type="radio">
                                                                                                            <span class="checkmark"></span>
                                                                                                        </label>
                                                                                                        <p><?php echo e(__('menu.right')); ?></p>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-12">
                                                                                            <div class="primary_input">
                                                                                                <ul id="theme_nav" class="permission_list sms_list ">
                                                                                                    <li>
                                                                                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                                                            <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                                                            <span class="checkmark"></span>
                                                                                                        </label>
                                                                                                        <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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
                                                                </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ol>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ol>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ol>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="card">
            <div class="card-body text-center">
                <?php echo e(__('menu.no_elements')); ?>

            </div>
        </div>
        <?php endif; ?>
    <?php elseif($menu->menu_type == 'multi_mega_menu'): ?>
        <div class="white-box p-15">
            <h4 class="mb-10"><?php echo e(__('menu.menu_list')); ?></h4>
            <div id="menuDiv" class="minh-250">
                <?php if(count(@$menu->menus)>0): ?>
                <?php $__currentLoopData = @$menu->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 single_item" data-id="<?php echo e($element->id); ?>" >
                    <div class="mb-10">
                        <div class="card" id="accordion_<?php echo e($element->id); ?>">
                            <div class="card-header card_header_element">
                                <p class="d-inline">
                                    <?php if(@$element->menu->menu_type == 'mega_menu'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('menu.mega_menu')); ?>)
                                    <?php elseif(@$element->menu->menu_type == 'normal_menu'): ?>
                                        <?php echo e(@$element->title); ?> (<?php echo e(__('menu.mega_menu')); ?>)
                                    <?php endif; ?>
                                </p>
                                <div class="pull-right">
                                    <a href="<?php echo e(route('menu.setup',$element->menu->id)); ?>" target="_blank" class=" d-inline  mr-10 primary-btn"><?php echo e(__('common.setup')); ?></a>
                                    <a href="javascript:void(0);" class=" d-inline  mr-10 primary-btn panel-title" data-toggle="collapse" data-target="#collapse_<?php echo e($element->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($element->id); ?>"><?php echo e(__('common.edit')); ?> <span class="collapge_arrow"></span></a>
                                    <a href="" data-id="<?php echo e($element->id); ?>" class="d-inline primary-btn menu_delete_btn"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div id="collapse_<?php echo e($element->id); ?>" class="collapse" aria-labelledby="heading_<?php echo e($element->id); ?>" data-parent="#accordion_<?php echo e($element->id); ?>">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" id="menuEditForm" data-element_id="<?php echo e($element->id); ?>">
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo e($element->id); ?>">
                                            <?php if(isModuleActive('FrontendMultiLang')): ?>
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link anchore_color <?php if(auth()->user()->lang_code == $language->code): ?> active <?php endif; ?>" href="#multilistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>" role="tab" data-toggle="tab" aria-selected="<?php if(auth()->user()->lang_code == $language->code): ?> true <?php else: ?> false <?php endif; ?>"><?php echo e($language->native); ?> </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div role="tabpanel" class="tab-pane fade <?php if(auth()->user()->lang_code == $language->code): ?> show active <?php endif; ?>" id="multilistelement<?php echo e($language->code); ?><?php echo e($element->id); ?>">
                                                                <div class="primary_input mb-25">
                                                                    <label class="primary_input_label" for="title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                                    <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($language->code); ?><?php echo e($element->id); ?>" name="title[<?php echo e($language->code); ?>]" autocomplete="off" value="<?php echo e(isset($element)?$element->getTranslation('title',$language->code):old('title.'.$language->code)); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>">
                                                                </div>
                                                                <span class="text-danger" id="edit_error_title_<?php echo e($language->code); ?><?php echo e($element->id); ?>"></span>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="edit_title"><?php echo e(__('marketing.navigation_label')); ?> <span class="text-danger">*</span></label>
                                                        <input class="primary_input_field edit_title" type="text" id="edit_title<?php echo e($element->id); ?>" name="title" autocomplete="off" value="<?php echo e($element->title); ?>"  placeholder="<?php echo e(__('marketing.navigation_label')); ?>" >
                                                    </div>
                                                    <span class="text-danger" id="edit_error_title<?php echo e($element->id); ?>"></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for=""><?php echo e(__('menu.menu')); ?> <span class="text-danger">*</span></label>
                                                    <select name="menu" class="primary_select mb-15 edit_menu">
                                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php echo e($element->menu_id == $item->id? 'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="primary_input">
                                                    <ul id="theme_nav" class="permission_list sms_list ">
                                                        <li>
                                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                                                <input name="is_newtab" id="is_newtab" value="1" <?php echo e($element->is_newtab == 1? 'checked':''); ?> type="checkbox">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p><?php echo e(__('menu.open_link_in_a_new_tab')); ?></p>
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
                    <?php echo e(__('menu.no_menus')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Menu/Resources/views/menu/components/element_list.blade.php ENDPATH**/ ?>