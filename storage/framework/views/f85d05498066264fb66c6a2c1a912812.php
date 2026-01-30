<?php
    $langs = app('langs');
    $locale = app('general_setting')->language_code;
    if(\Session::has('locale')){
        $locale = \Session::get('locale');
    }
    if(auth()->check()){
        $locale = auth()->user()->lang_code;
    }
?>
<div class="container-fluid no-gutters">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="small_logo_crm d-lg-none">
                    <a href="<?php echo e(url('/login')); ?>"> <img src="<?php echo e(showImage(app('general_setting')->logo)); ?>" alt="<?php echo e(app('general_setting')->company_name); ?>" title="<?php echo e(app('general_setting')->company_name); ?>"></a>
                </div>
                <div id="sidebarCollapse" class="sidebar_icon  d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="collaspe_icon open_miniSide">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area ml-50">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" class="form-control primary-input input-left-icon" autocomplete="off" placeholder="<?php echo e(__('common.search')); ?>" id="search" onkeyup="showResult(this.value)">
                            </div>
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    <div id="livesearch" style="display: none;"></div>
                </div>
                <div class="header_middle">
                    <div class="select_style d-flex">
                        <a target="_blank" class="primary-btn white mr-10 tab_hide" href="<?php echo e(url('/')); ?>"><?php echo e(__('common.website')); ?></a>
                        <div class="border_1px tab_hide"></div>
                        <select name="#" class="nice_Select bgLess mb-0" id="language_select">
                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($locale == $lang->code?'selected':''); ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->native); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <?php if(auth()->user()->role->type != 'affiliate' && auth()->user()->role->type != 'customer'): ?>
                        <li class="notification_warp_pop">
                            <a class="popUP_clicker gredient_hover" href="#">
                                <!-- plus     -->
                                <i class="fas fa-plus-square"></i>
                                <!--/ plus      -->
                            </a>
                            <div class="menu_popUp_list_wrapper">
                                <!-- popUp_single_wrap  -->
                                <div class="popUp_single_wrap">
                                    <?php if(permissionCheck('appearance.slider.index') || permissionCheck('menu.manage')): ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('appearance.appearance')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('appearance.slider.index')): ?>
                                            <li><a href="<?php echo e(route('appearance.slider.index')); ?>"> <i class="ti-plus"></i> <?php echo e(__('appearance.slider')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('menu.manage')): ?>
                                            <li><a href="<?php echo e(route('menu.manage')); ?>"><i class="ti-plus"></i><?php echo e(__('appearance.menus')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(permissionCheck('blog.tags.index') || permissionCheck('blog.posts.create')): ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('blog.blog')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('blog.posts.index')): ?>
                                            <li><a href="<?php echo e(route('blog.posts.index')); ?>"><i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('blog.posts.create')): ?>
                                            <li><a href="<?php echo e(route('blog.posts.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <?php if(permissionCheck('admin.merchants_list.get-data') || permissionCheck('admin.merchants_create')): ?>
                                        <div class="popup_single_item">
                                            <div class="main-title2 mb_10">
                                                <h4 class="mb_15"><?php echo e(__('common.seller')); ?></h4>
                                            </div>
                                            <ul>
                                                <?php if(permissionCheck('admin.merchants_list.get-data')): ?>
                                                <li><a href="<?php echo e(route('admin.merchants_list')); ?>"> <i class="ti-plus"></i> <?php echo e(__('common.list')); ?></a></li>
                                                <?php endif; ?>
                                                <?php if(permissionCheck('admin.merchants_create')): ?>
                                                <li><a href="<?php echo e(route('admin.merchants_create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- popUp_single_wrap  -->
                                <div class="popUp_single_wrap">
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('common.order')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('order_manage.total_sales_get_data')): ?>
                                            <li><a href="<?php echo e(route('order_manage.total_sales_index')); ?>"> <i class="ti-plus"></i><?php echo e(__('order.total_order')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(isModuleActive('MultiVendor')): ?>
                                                <li><a href="<?php echo e(route('order_manage.my_sales_index')); ?>"><i class="ti-plus"></i><?php echo e(__('order.my_order')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php if(permissionCheck('admin.inhouse-order.get-data') || permissionCheck('admin.inhouse-order.create')): ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('order.in_house_order')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('admin.inhouse-order.get-data')): ?>
                                            <li><a href="<?php echo e(route('admin.inhouse-order.index')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('admin.inhouse-order.create')): ?>
                                            <li><a href="<?php echo e(route('admin.inhouse-order.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(permissionCheck('product.index') || permissionCheck('product.create')): ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('common.product')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('product.index')): ?>
                                            <li><a href="<?php echo e(route('product.index')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('product.create')): ?>
                                            <li><a href="<?php echo e(route("product.create")); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!-- popUp_single_wrap  -->
                                <div class="popUp_single_wrap">
                                    <?php if(isModuleActive('MultiVendor')): ?>
                                        <?php if(permissionCheck('admin.my-product.index') || permissionCheck('admin.my-product.create')): ?>
                                            <div class="popup_single_item">
                                                <div class="main-title2 mb_10">
                                                    <h4 class="mb_15"><?php echo e(__('common.inhouse_product')); ?></h4>
                                                </div>
                                                <ul>
                                                    <?php if(permissionCheck('admin.my-product.index')): ?>
                                                    <li><a href="<?php echo e(route('admin.my-product.index')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if(permissionCheck('admin.my-product.create')): ?>
                                                    <li><a href="<?php echo e(route('admin.my-product.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(permissionCheck('review.seller.index') || permissionCheck('review.product.index')): ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('review.review')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('review.seller.index')): ?>
                                            <li><a href="<?php echo e(route('review.seller.index')); ?>"> <i class="ti-plus"></i><?php echo e(__('review.seller_review')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(permissionCheck('review.product.index')): ?>
                                            <li><a href="<?php echo e(route('review.product.index')); ?>"><i class="ti-plus"></i><?php echo e(__('review.product_review')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('common.refund')); ?></h4>
                                        </div>
                                        <ul>
                                            <?php if(permissionCheck('refund.total_refund_list')): ?>
                                            <li><a href="<?php echo e(route('refund.total_refund_list')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.pending_request')); ?></a></li>
                                            <?php endif; ?>
                                            <?php if(isModuleActive('MultiVendor')): ?>
                                            <li><a href="<?php echo e(route('refund.my_refund_list')); ?>"><i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- popUp_single_wrap  -->
                                <?php if(Auth::user()->role->type == "superadmin"): ?>
                                <div class="popUp_single_wrap">
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('ticket.support_ticket')); ?></h4>
                                        </div>
                                        <ul>
                                            <li><a href="<?php echo e(route('ticket.tickets.index')); ?>"> <i class="ti-plus"></i><?php echo e(__('ticket.all_ticket')); ?></a></li>
                                            <li><a href="<?php echo e(route('ticket.my_ticket')); ?>"><i class="ti-plus"></i><?php echo e(__('customer_panel.my_ticket')); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('common.flash_deals')); ?></h4>
                                        </div>
                                        <ul>
                                            <li><a href="<?php echo e(route('marketing.flash-deals')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.list')); ?></a></li>
                                            <li><a href="<?php echo e(route('marketing.flash-deals.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.create')); ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="popup_single_item">
                                        <div class="main-title2 mb_10">
                                            <h4 class="mb_15"><?php echo e(__('common.others')); ?></h4>
                                        </div>
                                        <ul>
                                            <li><a href="<?php echo e(route('marketing.coupon')); ?>"> <i class="ti-plus"></i><?php echo e(__('common.coupon')); ?></a></li>
                                            <li><a href="<?php echo e(route('marketing.new-user-zone.create')); ?>"><i class="ti-plus"></i><?php echo e(__('common.user_zone')); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endif; ?>
                        <li class="scroll_notification_list">
                            <a class="pulse theme_color bell_notification_clicker" href="javascript:void(0)">
                                <!-- bell   -->
                                <i class="fa fa-bell"></i>
                                <!--/ bell   -->
                                <?php if(count($notifications) > 0): ?>
                                <span class="notification_count"><?php echo e(getNumberTranslate(count($notifications))); ?> </span>
                                <span class="pulse-ring notification_count_pulse"></span>
                                <?php endif; ?>
                            </a>
                            <!-- Menu_NOtification_Wrap  -->
                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    <h4><?php echo e(__('common.notifications')); ?></h4>
                                </div>
                                <div class="Notification_body">
                                    <!-- single_notify  -->
                                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_content">
                                            <a class="notification-content notification_read_btn" data-id="<?php echo e($notification->id); ?>" data-url="<?php echo e(url($notification->url)); ?>"> <?php echo e(getNumberTranslate($loop->index+1)); ?>. <?php echo e(ucfirst($notification->title)); ?></a>
                                            <br />
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_content">
                                            <?php echo e(__('common.no_notification_found')); ?>.
                                            <br />
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        <a href="<?php echo e(route('user.notificationsetting.index')); ?>"
                                            class="primary-btn radius_30px text_white  fix-gr-bg"><?php echo e(__('common.setting')); ?></a>
                                        <?php if(count($notifications) > 0): ?>
                                        <a href="<?php echo e(route('frontend.mark_as_read')); ?>"
                                            class="primary-btn radius_30px text_white  fix-gr-bg"><?php echo e(__('common.read_all')); ?></a>
                                        <a href="<?php echo e(route('frontend.notifications')); ?>"
                                            class="primary-btn radius_30px text_white  fix-gr-bg"><?php echo e(__('common.view')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!--/ Menu_NOtification_Wrap  -->
                        </li>
                    </div>
                    <div class="profile_info">

                        <div class="user_avatar_div">
                            <img id="profile_pic" src="<?php echo e(showImage(auth()->user()->avatar !=null?auth()->user()->avatar:'backend/img/avatar.png')); ?>" alt="">
                        </div>

                        <div class="profile_info_iner">
                            <p> <?php echo e(__('common.welcome')); ?>

                                <?php if(auth()->user()->role->type == 'superadmin'): ?> <?php echo e(__('hr.super_admin')); ?>

                                <?php elseif(auth()->user()->role->type == 'admin'): ?> <?php echo e(__('hr.admin')); ?>

                                <?php elseif(auth()->user()->role->type == 'seller'): ?> <?php echo e(__('hr.seller')); ?>

                                <?php elseif(auth()->user()->role->type == 'staff'): ?> <?php echo e(__('hr.staff')); ?> <?php endif; ?>!</p>
                            <h5><?php echo e(auth()->user()->first_name); ?></h5>
                            <div class="profile_info_details">
                                <?php if(auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff'): ?>
                                <a href="<?php echo e(url('/profile')); ?>"><?php echo e(__('customer_panel.my_profile')); ?><i class="ti-user"></i></a>
                                <?php if(permissionCheck('company_info')): ?>
                                <a href="<?php echo e(url('/generalsetting/company-info')); ?>"><?php echo e(__('customer_panel.company_info')); ?><i class="ti-user"></i></a>
                                <?php endif; ?>
                                <?php if(permissionCheck('generalsetting.index')): ?>
                                <a href="<?php echo e(url('/generalsetting')); ?>"><?php echo e(__('common.settings')); ?><i class="ti-settings"></i></a>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php if(auth()->user()->role->type == 'seller'): ?>
                                <a href="<?php echo e(url('/profile')); ?>"><?php echo e(__('customer_panel.customer_profile')); ?><i class="ti-user"></i></a>
                                <a href="<?php echo e(url('/seller/profile')); ?>"><?php echo e(__('seller.seller_profile')); ?><i class="ti-user"></i></a>
                                <a href="<?php echo e(url('/seller/setting')); ?>"><?php echo e(__('common.setting')); ?><i class="ti-user"></i></a>
                                <?php endif; ?>
                                <?php if(auth()->user()->role->type == 'customer'): ?>
                                    <a href="<?php echo e(url('/profile/dashboard')); ?>"><?php echo e(__('common.dashboard')); ?><i class="ti-dashboard"></i></a>
                                <?php endif; ?>
                                <?php if(auth()->user()->secret_login): ?>
                                <a href="<?php echo e(route('secret_logout')); ?>"><?php echo e(__('common.log_out')); ?><i class="ti-shift-left"></i></a>
                                <?php else: ?>
                                <a href="<?php echo e(route('logout')); ?>" class="log_out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('common.log_out')); ?><i class="ti-shift-left"></i>
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Production_dev/resources/views/backEnd/partials/_menu.blade.php ENDPATH**/ ?>