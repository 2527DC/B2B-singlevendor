
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/backend_page_css/refund.css'))); ?>" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainContent'); ?>
<!--  dashboard part css here -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('customer_panel.my_refund_list')); ?></h3>
                    </div><br>
                    <div class="order_details">
                        <?php $__currentLoopData = $my_refund_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $my_refund_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single_order_part">
                            <div class="order_details_status">
                                <ul class="w-100">
                                    <li>
                                        <p><span><?php echo e(__('common.order_id')); ?></span>: <?php echo e($my_refund_item->order->order_number); ?></p>
                                        <p><span><?php echo e(__('defaultTheme.order_date')); ?></span>: <?php echo e($my_refund_item->order->created_at); ?></p>
                                    </li>
                                    <li>
                                        <p><span><?php echo e(__('common.status')); ?></span>: <?php echo e($my_refund_item->CheckConfirmed); ?>

                                        </p>
                                        <p><span><?php echo e(__('defaultTheme.request_sent_date')); ?></span>: <?php echo e($my_refund_item->created_at); ?></p>
                                    </li>
                                    <li>
                                        <p><span><?php echo e(__('defaultTheme.order_amount')); ?></span>: <?php echo e(single_price(
                                            $my_refund_item->total_return_amount)); ?></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="order_details_iner">
                                <div class="order_item">
                                    <?php $__currentLoopData = $my_refund_item->refund_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $refund_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $refund_detail->refund_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $refund_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single_order_item">
                                        <div class="order_item_name">
                                            <div class="product_img_div">
                                                <?php if(@$refund_product->seller_product_sku->sku->product->product_type ==
                                                1): ?>
                                                <img src="<?php echo e(showImage(@$refund_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>"
                                                    alt="#">
                                                <?php else: ?>
                                                <img src="<?php echo e(showImage(@$refund_product->seller_product_sku->sku->variant_image)); ?>"
                                                    alt="#">
                                                <?php endif; ?>
                                            </div>
                                            <p><?php echo e(@$refund_product->seller_product_sku->sku->product->product_name); ?>

                                            </p>
                                        </div>
                                        <p><?php echo e($refund_product->return_qty); ?> X <?php echo e(single_price($refund_product->return_amount / $refund_product->return_qty)); ?></p>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="order_details_btn">
                                    <a href="#" class="btn_2"><?php echo e(($my_refund_item->is_completed == 1) ? "Completed" :
                                        "Waiting"); ?></a>
                                    <a href="<?php echo e(route('refund.frontend.my_refund_order_detail', encrypt($my_refund_item->id))); ?>"
                                        class="btn_2"><?php echo e(__('defaultTheme.view_details')); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        echo $my_refund_items->links();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/pages/customer_data/refund.blade.php ENDPATH**/ ?>