<div class="main_header_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shop_header_wrapper d-flex align-items-center">
                    <div class="menu_logo">
                        <a href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>">
                        </a>
                    </div>
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($menu->menu_type == 'multi_mega_menu'): ?>
                            <div class="dropdown show category_menu">
                                <a class="Categories_togler">
                                    <?php echo e(textLimit($menu->name, 25)); ?>

                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown_menu catdropdown_menu">
                                    <?php $__currentLoopData = @$menu->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(@$menu->menu->menu_type == 'mega_menu' && @$menu->menu->status == 1): ?>
                                            <li><a class="dropdown-item has_arrow d-flex align-items-center">
                                                <i class="<?php echo e(@$menu->menu->icon); ?>"></i> <?php echo e(textLimit(@$menu->menu->name, 25)); ?></a>
                                                <!-- 2nd level  -->
                                                <!-- mega_width_menu  -->
                                                <ul class="mega_width_menu">
                                                    <?php if(@$menu->menu->columns->count()): ?>
                                                        <?php
                                                            $is_same = 1;
                                                            $column_size = $menu->menu->columns[0]->size;

                                                            foreach($menu->menu->columns as $key => $column){
                                                            if($column->size != $column_size){
                                                                $is_same =0;
                                                            }
                                                            }
                                                        ?>
                                                        <!-- single_menu  -->
                                                        <?php $__currentLoopData = @$menu->menu->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="pt-0
                                                                <?php if($column->size == '1/1'): ?>
                                                                flex_100
                                                                <?php elseif($column->size == '1/2'): ?>
                                                                flex_50
                                                                <?php elseif($column->size == '1/3'): ?>
                                                                flex_33
                                                                <?php elseif($column->size == '1/4'): ?>
                                                                flex_25
                                                                <?php endif; ?>
                                                            ">
                                                                <a class="mega_metu_title"><?php echo e(textLimit($column->column, 25)); ?></a>
                                                                <ul>
                                                                    <?php $__currentLoopData = @$column->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($element->type == 'link'): ?>
                                                                        <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php if($element->link != null): ?>
                                                                            <?php echo e(url($element->link)); ?>

                                                                            <?php else: ?>
                                                                            javascript:void(0);
                                                                            <?php endif; ?>"><?php echo e(textLimit($element->title, 25)); ?></a></li>

                                                                        <?php elseif($element->type == 'category' && $element->category->status == 1): ?>
                                                                            <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php echo e(route('frontend.category-product',['slug' => @$element->category->slug, 'item' =>'category'])); ?>"><?php echo e(ucfirst(textLimit($element->title, 25))); ?></a></li>

                                                                        <?php elseif(@$element->type == 'product' && @$element->product): ?>
                                                                        <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php echo e(singleProductURL(@$element->product->seller->slug, $element->product->slug)); ?>"><?php echo e(ucfirst(textLimit($element->title,25))); ?></a></li>
                                                                         <?php elseif(@$element->type == 'brand' && @$element->brand->status == 1): ?>
                                                                        <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php echo e(route('frontend.category-product',['slug' => @$element->brand->slug, 'item' =>'brand'])); ?>"><?php echo e(ucfirst(textLimit($element->title, 25))); ?></a></li>

                                                                        <?php elseif($element->type == 'page' && $element->page->status == 1): ?>
                                                                                <?php if(!isModuleActive('Lead') && $element->page->module == 'Lead'): ?>
                                                                                    <?php continue; ?>
                                                                                <?php endif; ?>
                                                                        <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php echo e(url(@$element->page->slug)); ?>"><?php echo e(ucfirst(textLimit($element->title, 25))); ?></a></li>

                                                                        <?php elseif($element->type == 'tag'): ?>
                                                                        <li><a <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?> href="<?php echo e(route('frontend.category-product',['slug' => @$element->tag->name, 'item' =>'tag'])); ?>"><?php echo e(ucfirst(textLimit($element->title,25))); ?></a></li>

                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <!-- single_menu  -->
                                                    <li class="img_menu pt-0 position-relative <?php echo e(@$menu->menu->menuAds->status?'':'d-none'); ?>">
                                                        <div class="sub_menu_bg_img position-absolute end-0 bottom-0 p-3">
                                                            <img class="img-fluid lazyload" data-src="<?php echo e(showImage(@$menu->menu->menuAds->image)); ?>" src="<?php echo e(showImage(themeDefaultImg())); ?>" alt="<?php echo e(@$menu->menu->menuAds->title); ?>" title="<?php echo e(@$menu->menu->menuAds->title); ?>">
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <h6><?php echo e(@$menu->menu->menuAds->subtitle); ?></h6>
                                                            </li>
                                                            <li>
                                                            <h4><?php echo e(@$menu->menu->menuAds->title); ?></h4>
                                                            </li>
                                                            <li>
                                                                <a class="shop_now" href="<?php echo e(@$menu->menu->menuAds->link); ?>"><?php echo e(__('common.shop_now')); ?> »</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <!--/ mega_width_menu -->
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- main_menu_start  -->
                    <div class="main_menu  d-none d-lg-block">
                        <nav>
                            <?php
                                $main_menu = $menus->where('menu_type','normal_menu')->where('menu_position', 'main_menu')->first();
                                $function = null;
                            ?>

                            <ul id="mobile-menu">
                                <?php if($main_menu): ?>
                                    <?php $__currentLoopData = $main_menu->elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($element->type == 'page'): ?>
                                            <?php if(!isModuleActive('Lead') && $element->page->module == 'Lead'): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <?php if(!isModuleActive('MultiVendor') && $element->page->slug == 'merchant' || !isModuleActive('MultiVendor') && $element->page->module == 'MultiVendor'): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <?php if($element->childs->count() > 0): ?>
                                                <li class="submenu_active"><a href="<?php echo e(url(@$element->page->slug)); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(ucfirst(textLimit($element->title, 20))); ?>  <i class="ti-angle-down"></i></a>
                                                    <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e(url(@$element->page->slug)); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(ucfirst(textLimit($element->title, 20))); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php elseif($element->type == 'category'): ?>
                                            <?php if($element->childs->count() > 0): ?>
                                                <li class="submenu_active"><a href="<?php echo e(route('frontend.category-product',['slug' => $element->category->slug, 'item' =>'category'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?> <i class="ti-angle-down"></i></a>
                                                    <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e(route('frontend.category-product',['slug' => $element->category->slug, 'item' =>'category'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php elseif($element->type == 'brand'): ?>
                                            <?php if($element->childs->count() > 0): ?>
                                                <li class="submenu_active"><a href="<?php echo e(route('frontend.category-product',['slug' => $element->brand->slug, 'item' =>'brand'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?> <i class="ti-angle-down"></i></a>
                                                    <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e(route('frontend.category-product',['slug' => $element->brand->slug, 'item' =>'brand'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?></a>
                                                </li>
                                            <?php endif; ?>

                                        <?php elseif($element->type == 'tag'): ?>
                                            <?php if($element->childs->count() > 0): ?>
                                                <li class="submenu_active"><a href="<?php echo e(route('frontend.category-product',['slug' => $element->tag->name, 'item' =>'tag'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?> <i class="ti-angle-down"></i></a>
                                                    <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e(route('frontend.category-product',['slug' => $element->tag->name, 'item' =>'tag'])); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php elseif($element->type == 'product' && @$element->product): ?>
                                            <?php if($element->childs->count() > 0): ?>
                                            <li class="submenu_active">
                                                <a href="<?php echo e(singleProductURL(@$element->product->seller->slug, @$element->product->slug)); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?> <i class="ti-angle-down"></i></a>
                                                <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e(singleProductURL(@$element->product->seller->slug, @$element->product->slug)); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php elseif($element->type == 'link'): ?>
                                            <?php if($element->childs->count() > 0): ?>
                                                <li class="submenu_active">
                                                    <a href="<?php echo e($element->link); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?> <i class="ti-angle-down"></i></a>
                                                    <?php echo $__env->make(theme('partials._menu_chield'), ['element' => $element], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </li>
                                            <?php else: ?>
                                                <li class="">
                                                    <a href="<?php echo e($element->link); ?>" <?php echo e($element->is_newtab == 1? 'target="_blank"':''); ?>><?php echo e(textLimit($element->title,20)); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php elseif($element->type == 'function' & $element->element_id == 1): ?>
                                            <?php
                                                $function = $element;
                                            ?>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(isModuleActive('AuctionProducts')): ?>
                                    <li class="">
                                        <a href="<?php echo e(route('frontend.auctionproducts.gallary')); ?>" ><?php echo e(__('auctionproduct.auction')); ?></a>
                                    </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </ul>
                        </nav>
                    </div>
                    <div class="main_header_media d-none d-xl-flex dynamic_svg">
                        <?php if(isset($new_user_zone)): ?>
                            <a href="<?php echo e(route('frontend.new-user-zone', $new_user_zone->slug)); ?>" class="single_top_lists d-flex align-items-center d-none d-lg-inline-flex">

                                <svg  width="15.021" height="15" viewBox="0 0 15.021 15">
                                    <g id="new_user" transform="translate(0 -0.499)">
                                      <g id="Group_2649" data-name="Group 2649" transform="translate(0 0.499)">
                                        <g id="Group_2648" data-name="Group 2648" transform="translate(0 0)">
                                          <path id="Path_3139" data-name="Path 3139" d="M7.5.5A4.335,4.335,0,0,0,5.044,8.408,7.511,7.511,0,0,0,0,15.5H1.171A6.333,6.333,0,0,1,7.5,9.171,4.336,4.336,0,0,0,7.5.5ZM7.5,8a3.164,3.164,0,1,1,3.162-3.164A3.167,3.167,0,0,1,7.5,8Z" transform="translate(0 -0.499)" fill="#fd4949"/>
                                        </g>
                                      </g>
                                      <g id="Group_2651" data-name="Group 2651" transform="translate(8.93 9.409)">
                                        <g id="Group_2650" data-name="Group 2650">
                                          <path id="Path_3140" data-name="Path 3140" d="M308.036,306.366v-2.46h-1.171v2.46H304.4v1.171h2.46V310h1.171v-2.459h2.46v-1.171Z" transform="translate(-304.405 -303.906)" fill="#fd4949"/>
                                        </g>
                                      </g>
                                    </g>
                                  </svg>

                                <span><?php echo e(__('defaultTheme.new_user_zone')); ?></span>
                            </a>
                            <span class="vertical_line style2 d-none d-lg-inline-flex"></span>
                        <?php endif; ?>
                        <?php if(isset($flash_deal)): ?>
                            <a href="<?php echo e(route('frontend.flash-deal', $flash_deal->slug)); ?>" class="single_top_lists d-flex align-items-center d-none d-md-inline-flex">

                                <svg id="deals"  width="15" height="15" viewBox="0 0 15 15">
                                    <path id="Path_3131" data-name="Path 3131" d="M13.906,5.75a2.972,2.972,0,0,1-.625-.656,2.246,2.246,0,0,1-.031-.937,2.435,2.435,0,0,0-.437-1.969,2.435,2.435,0,0,0-1.969-.437,2.94,2.94,0,0,1-.937-.031c-.187-.063-.437-.375-.656-.625A2.557,2.557,0,0,0,7.5,0,2.557,2.557,0,0,0,5.75,1.094a2.972,2.972,0,0,1-.656.625,2.246,2.246,0,0,1-.937.031,2.587,2.587,0,0,0-1.969.438A2.435,2.435,0,0,0,1.75,4.156a2.94,2.94,0,0,1-.031.937c-.063.188-.375.438-.625.656A2.557,2.557,0,0,0,0,7.5,2.557,2.557,0,0,0,1.094,9.25a2.972,2.972,0,0,1,.625.656,2.246,2.246,0,0,1,.031.937,2.587,2.587,0,0,0,.438,1.969,2.435,2.435,0,0,0,1.969.438,2.94,2.94,0,0,1,.937.031c.188.062.438.375.656.625A2.557,2.557,0,0,0,7.5,15a2.557,2.557,0,0,0,1.75-1.094,2.972,2.972,0,0,1,.656-.625,2.246,2.246,0,0,1,.937-.031,2.435,2.435,0,0,0,1.969-.437,2.435,2.435,0,0,0,.438-1.969,2.94,2.94,0,0,1,.031-.937c.062-.187.375-.437.625-.656A2.557,2.557,0,0,0,15,7.5,2.557,2.557,0,0,0,13.906,5.75Zm-.844,2.531a3.232,3.232,0,0,0-.937,1.125,3.465,3.465,0,0,0-.125,1.5c.031.344.062.875-.063,1s-.656.094-1,.062a3.465,3.465,0,0,0-1.5.125,3.539,3.539,0,0,0-1.125.938c-.281.313-.625.719-.812.719s-.531-.406-.781-.688a2.975,2.975,0,0,0-1.125-.937,2.277,2.277,0,0,0-.937-.156A3.984,3.984,0,0,0,4.062,12c-.344.031-.875.062-1-.062s-.094-.656-.062-1a3.465,3.465,0,0,0-.125-1.5,3.539,3.539,0,0,0-.937-1.125c-.281-.281-.688-.625-.688-.812s.406-.531.688-.781a3.232,3.232,0,0,0,.937-1.125A3.465,3.465,0,0,0,3,4.094c-.031-.344-.062-.875.062-1s.656-.094,1-.062a3.465,3.465,0,0,0,1.5-.125,3.539,3.539,0,0,0,1.125-.937c.281-.313.625-.719.813-.719s.531.406.781.688a2.975,2.975,0,0,0,1.125.937,3.465,3.465,0,0,0,1.5.125c.344-.031.875-.063,1,.062s.094.656.062,1a3.465,3.465,0,0,0,.125,1.5,3.539,3.539,0,0,0,.938,1.125c.281.25.688.594.688.781s-.375.562-.656.812Z" transform="translate(0 0)" fill="#fd4949"/>
                                    <path id="Path_3132" data-name="Path 3132" d="M0,0H4.784V1.251H0Z" transform="translate(5.354 8.76) rotate(-45)" fill="#fd4949"/>
                                    <g id="Group_2644" data-name="Group 2644" transform="translate(4.995 4.995)">
                                      <circle id="Ellipse_105" data-name="Ellipse 105" cx="1" cy="1" r="1" fill="#fd4949"/>
                                      <circle id="Ellipse_106" data-name="Ellipse 106" cx="1" cy="1" r="1" transform="translate(3 3)" fill="#fd4949"/>
                                    </g>
                                </svg>
                                <span><?php echo e(__('amazy.Daily Deals')); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/resources/views/frontend/amazy/partials/_mega_menu.blade.php ENDPATH**/ ?>