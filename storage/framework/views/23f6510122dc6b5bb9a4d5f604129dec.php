<style>
    @media (max-width: 991px){
        .mobile_menu {
            top: 54px;
        }
    }
    @media (max-width: 767.98px){
        header.amazcartui_header .header_area .header_top_area .header__wrapper .header__left {
              justify-content: flex-start;
              margin-left: 0;
        }
        .mobile_menu {
            top: 46px;
        }
    }
</style>

<div class="header_top_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__wrapper">
                    <!-- header__left__start  -->
                    <div class="header__left d-flex align-items-center">
                        <div class="logo_img">
                            <a href="<?php echo e(url('/')); ?>">
                                <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>">
                            </a>
                        </div>
                    </div>
                    <!-- header__left__end  -->
                    <div class="header_middle d-flex">
                        <form method="GET" id="search_form">
                            <div class="input-group header_search_field ">
                                <div class="input-group-prepend">
                                    <button class="btn input-group-append" id="search_button"> <i class="ti-search"></i> </button>
                                </div>
                                <input type="text" class="form-control category_box_input lh-base" id="inlineFormInputGroup" placeholder="<?php echo e(__('defaultTheme.search_your_item')); ?>">

                                <div class="live-search">
                                    <ul class="p-0" id="search_items">
                                        <li class="search_item" id="search_empty_list">

                                        </li>
                                        <li class="search_item" id="search_history">

                                        </li>
                                        <li class="search_item" id="tag_search">

                                        </li>
                                        <li class="search_item" id="category_search">

                                        </li>
                                        <li class="search_item" id="product_search">

                                        </li>
                                        <li class="search_item" id="seller_search">

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- header__right_start  -->
                    <div class="header_top_area_right">
                        <div class="wish_cart">
                            <div class="single_wishcart_lists" >
                                <div class="icon d-inline-block lh-1 dynamic_svg">

                                    <svg  width="16.5" height="16.5" viewBox="0 0 16.5 16.5">
                                        <g id="user" transform="translate(0.25 0.25)">
                                          <g id="Group_1602" data-name="Group 1602" transform="translate(0)">
                                            <path id="Path_1911" data-name="Path 1911" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                            <path id="Path_1912" data-name="Path 1912" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                          </g>
                                        </g>
                                      </svg>
                                </div>
                                <?php if(auth()->guard()->guest()): ?>
                                    <span class="d-inline-block lh-1 ">
                                        <a href="<?php echo e(url('/login')); ?>"><?php echo e(__('defaultTheme.login')); ?></a>
                                        <a href="<?php echo e(url('/register')); ?>">/ <?php echo e(__('defaultTheme.register')); ?></a>
                                    </span>
                                <?php else: ?>
                                    <span class="d-inline-block lh-1 ">
                                        <?php if(auth()->check() && auth()->user()->role->type == "superadmin" || auth()->check() && auth()->user()->role->type == "admin" || auth()->check() && auth()->user()->role->type == "staff"): ?>
                                            <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(__('common.dashboard')); ?></a>
                                        <?php elseif(auth()->check() && auth()->user()->role->type == "seller" && isModuleActive('MultiVendor')): ?>
                                            <a href="<?php echo e(route('seller.dashboard')); ?>"><?php echo e(__('common.dashboard')); ?></a>
                                        <?php elseif(auth()->check() && auth()->user()->role->type == "affiliate"): ?>
                                            <a href="<?php echo e(route('affiliate.my_affiliate.index')); ?>"><?php echo e(__('common.dashboard')); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('frontend.dashboard')); ?>"><?php echo e(__('common.dashboard')); ?></a>
                                        <?php endif; ?>

                                        <a href="<?php echo e(route('logout')); ?>" class="log_out">/ <?php echo e(__('defaultTheme.log_out')); ?></a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                         <div class="single_top_lists position-relative me-3 d-flex align-items-center shoping_language d-lg-none d-inline-flex">
                            <div class="">
                                <div class="language_toggle_btn gj-cursor-pointer d-flex align-items-center gap_10 ">
                                    <span><?php echo e(strtoupper($locale)); ?></span>
                                    <span class="vertical_line style2 d-none d-md-block"></span>
                                    <span><?php echo e(strtoupper($currency_code)); ?></span>
                                    <i class="ti-angle-down"></i>
                                </div>
                                <div class="language_toggle_box position-absolute top-100 end-0 bg-white">
                                    <form action="<?php echo e(route('frontend.locale')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block"><?php echo e(__('defaultTheme.language')); ?></span>
                                            <select class="amaz_select6 wide mb_20" name="lang">
                                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($locale==$lang->code?'selected':''); ?> value="<?php echo e($lang->code); ?>">
                                                    <?php echo e($lang->native); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block"><?php echo e(__('defaultTheme.currency')); ?></span>
                                            <select class="amaz_select6 wide" name="currency">
                                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($currency_code==$item->code?'selected':''); ?>

                                                    value="<?php echo e($item->id); ?>">
                                                    (<?php echo e($item->symbol); ?>) <?php echo e($item->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="amaz_primary_btn style3 save_btn"><?php echo e(__('defaultTheme.save_change')); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="wish_cart_mobile">
                            <div class="home6_search_toggle ">
                                <i class="ti-search"></i>
                            </div>
                        </div>
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    <!-- header__right_end  -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/partials/_mainmenu.blade.php ENDPATH**/ ?>