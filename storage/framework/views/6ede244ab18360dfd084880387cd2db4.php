
<style>
    @media (max-width:767px){
        .sumery_product_details .table-responsive table{
            width: 700px
        }     
        .summery_pro_content{
            padding-left: 40px;
        }
        .font_16{
            padding-left: 20px;
        }
        .sumery_product_details .amazy_table3 tbody tr td{
            padding: 10px
        }
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?php echo $__env->make('frontend.amazy.pages.profile.partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-xl-9 col-lg-8">
                <?php $__currentLoopData = $my_refund_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $my_refund_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="white_box roundted rounded-3 style2 bg-white mb_20">
                        <div class="white_box_header d-flex align-items-center gap_20 flex-wrap  amazy_bb3 justify-content-between ">
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.order_id')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($my_refund_item->order->order_number)); ?></p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_date')); ?> : </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($my_refund_item->order->created_at)); ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('common.status')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e($my_refund_item->CheckConfirmed); ?></p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.request_sent_date')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(getNumberTranslate($my_refund_item->created_at)); ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-column  ">
                                <div class="d-flex align-items-center flex-wrap gap_5">
                                    <h4 class="font_14 f_w_500 m-0 lh-base"><?php echo e(__('defaultTheme.order_amount')); ?>: </h4> <p class="font_14 f_w_400 m-0 lh-base"> <?php echo e(single_price( $my_refund_item->total_return_amount)); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_white_box_body">
                            <div class="table-responsive mb_10">
                                <table class="table amazy_table3 style2 mb-0">
                                    <tbody>
                                        <?php $__currentLoopData = $my_refund_item->refund_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $refund_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $refund_detail->refund_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $refund_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <a href="product_details.php" class="d-flex align-items-center gap_20 cart_thumb_div">
                                                            <div class="thumb">
                                                                <img src="
                                                                    <?php if(@$refund_product->seller_product_sku->sku->product->product_type == 1): ?>
                                                                        <?php echo e(showImage(@$refund_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>

                                                                    <?php else: ?>
                                                                        <?php if(@$refund_product->seller_product_sku->sku->variant_image): ?>
                                                                            <?php echo e(showImage(@$refund_product->seller_product_sku->sku->variant_image)); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e(showImage(@$refund_product->seller_product_sku->sku->product->thumbnail_image_source)); ?>

                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                " alt="">
                                                            </div>
                                                            <div class="summery_pro_content">
                                                                <h4 class="font_16 f_w_700 text-nowrap m-0 theme_hover"><?php echo e(textLimit(@$refund_product->seller_product_sku->sku->product->product_name, 30)); ?></h4>
                                                                <?php if(@$refund_product->seller_product_sku->sku->product->product_type == 2): ?>
                                                                    <p class="font_14 f_w_400 m-0 ">
                                                                        <?php
                                                                            $countCombinatiion = count(@$refund_product->seller_product_sku->product_variations);
                                                                        ?>
                                                                        <?php $__currentLoopData = @$refund_product->seller_product_sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($combination->attribute->id == 1): ?>
                                                                                <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->color->name); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e($combination->attribute->name); ?>: <?php echo e($combination->attribute_value->value); ?>

                                                                            <?php endif; ?>

                                                                            <?php if(!$loop->last): ?>, <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(__('common.qty')); ?>: <?php echo e(getNumberTranslate($refund_product->return_qty)); ?></h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="font_16 f_w_500 m-0 text-nowrap"><?php echo e(single_price($refund_product->return_amount / $refund_product->return_qty)); ?></h4>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?php echo e(route('refund.frontend.my_refund_order_detail', encrypt($my_refund_item->id))); ?>" class="amaz_primary_btn style2 text-nowrap "><?php echo e(__('defaultTheme.view_details')); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php if($my_refund_items->lastPage() > 1): ?>
                    <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $my_refund_items,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PaginationComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $attributes = $__attributesOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__attributesOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $component = $__componentOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__componentOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/pages/profile/refunds/refund.blade.php ENDPATH**/ ?>