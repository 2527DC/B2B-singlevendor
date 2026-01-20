<div class="modal fade admin-query" id="productDetails">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e($product->product_name); ?> <?php echo e(__('product.details')); ?></h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="products_view_left text-center mb-35">
                                <div class="products_image_div mb-25">
                                    <img src="<?php echo e(showImage($product->thumbnail_image_source)); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="products_view_right mb-35">
                                <div class="products_details_list">
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.product_name')); ?>: </span>
                                        <span><?php echo e($product->product_name); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.SKU')); ?>: </span>
                                        <span><?php echo e($product->skus->first()->sku); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.product_type')); ?>: </span>
                                        <span><?php echo e($product->product_type ==1 ? __("product.physical_product"): __("product.digital_product")); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.category')); ?>: </span>
                                        <div class="d-flex flex-wrap">
                                            <?php $__currentLoopData = @$product->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="pr_5"><?php echo e(@$category->name); ?> <?php if($loop->last): ?> <?php else: ?> , <?php endif; ?> </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.brand')); ?>:</span>
                                        <span><?php echo e(@$product->brand->name); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.barcode_type')); ?>: </span>
                                        <span><?php echo e(getNumberTranslate($product->barcode_type)); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.unit')); ?>: </span>
                                        <span><?php echo e(@$product->unit_type->name); ?></span>
                                    </div>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.minimum_order_qty')); ?>: </span>
                                        <span><?php echo e(getNumberTranslate($product->minimum_order_qty)); ?>

                                            <small>/<?php echo e(@$product->unit_type->name); ?></small> </span>
                                    </div>
                                    <div class="products_details_single d-none">
                                        <span><?php echo e(__('product.unit_cost')); ?>: </span>
                                        <?php
                                            $purchase_price = $product->skus->first()->purchase_price ?
                                            $product->skus->first()->purchase_price : 0
                                        ?>
                                        <span><?php echo e(single_price($purchase_price)); ?></span>
                                    </div>


                                    <?php if(!empty($product->gstGroup)): ?>
                                        <?php
                                            $cgst = (array) json_decode($product->gstGroup->same_state_gst);
                                            $igst = (array) json_decode($product->gstGroup->outsite_state_gst);
                                        ?>
                                        <div class="products_details_single">
                                            <span><?php echo e(__('gst.gst')); ?>: </span>
                                            <span> <?php if(!empty($product->gstGroup->same_state_gst)): ?> <?php echo e(__('gst.same_state_GST')); ?>: <?php $__currentLoopData = $cgst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(getGstName($key)); ?> <?php ?>  <?php echo e($c); ?>% <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>  <br> <?php if(!empty($product->gstGroup->outsite_state_gst)): ?> <?php echo e(__('gst.outsite_state_GST')); ?>: <?php $__currentLoopData = $igst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l =>  $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(getGstName($l)); ?> <?php echo e($i); ?>% <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?> </span>
                                        </div>
                                    <?php elseif($product->tax != 0): ?>
                                        <div class="products_details_single">
                                            <span><?php echo e(__('product.tax')); ?>: </span>
                                            <span><?php echo e(getNumberTranslate(($product->tax_type == 1) ? single_price($product->tax) : $product->tax. "%")); ?></span>
                                        </div>
                                    <?php endif; ?>


                                    <?php if(isModuleActive('ClubPoint')): ?>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('clubpoint.point')); ?>: </span>
                                        <span><?php echo e(getNumberTranslate(($product->club_point == 1) ? single_price($product->club_point) : $product->club_point)); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.discount')); ?>: </span>
                                        <span><?php echo e(($product->discount_type == 1) ? single_price($product->discount) : $product->discount. "%"); ?></span>
                                    </div>
                                    <?php if($product->is_physical != 1 && $product->product_type == 1 && @$product->skus->first()->digital_file->file_source != null): ?>
                                    <div class="products_details_single">
                                        <span><?php echo e(__('product.download_file')); ?>: </span>
                                        <span> <a
                                                href="<?php echo e(asset(asset_path(@$product->skus->first()->digital_file->file_source))); ?>"><?php echo e(__('product.click_on_it')); ?></a>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(count($product->gallary_images) > 0): ?>
                        <div class="col-12">
                            <div class="mb-35">
                                <div class="box_header m-0">
                                    <div class="main-title d-flex mb-15">
                                        <h3 class="mb-0"><?php echo e(__('product.galary_image')); ?></h3>
                                    </div>
                                </div>
                                <div class="gallary_img_div">
                                    <?php $__currentLoopData = $product->gallary_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallary_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="gallary_img">
                                        <img src="<?php echo e(showImage($gallary_image->images_source)); ?>" alt="<?php echo e($product->product_name); ?>">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(count($product->skus) > 0): ?>
                        <div class="col-12 mb-40">
                            <!-- content  -->
                            <div class="QA_section3 QA_section_heading_custom">
                                <div class="box_header m-0">
                                    <div class="main-title d-flex mb-10">
                                        <h3 class="mb-0"><?php echo e(__('product.variant_items')); ?> <span
                                                class="f_s_12 f_w_500 theme_text2 ml-15">(<?php echo e(count($product->skus)); ?>

                                                <?php echo e(__('product.variant')); ?>)</span> </h3>
                                    </div>
                                </div>
                                <div class="QA_table QA_table4">
                                    <!-- table-responsive -->
                                    <div class="table-responsive">
                                        <table class="table shadow_none pb-0 ">
                                            <thead class="tect-center">
                                                <tr>
                                                    <th scope="col"><?php echo e(__('product.attribute')); ?></th>
                                                    <th scope="col"><?php echo e(__('product.product_sku')); ?></th>
                                                    <th scope="col"><?php echo e(__('product.selling_price')); ?></th>
                                                    <th scope="col"><?php echo e(__('common.status')); ?></th>
                                                    <?php if($product->is_physical != 1 && $product->product_type == 2): ?>
                                                    <th scope="col"><?php echo e(__('product.download_file')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">
                                                <?php $__currentLoopData = $product->skus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php $__currentLoopData = $sku->product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e(@$variation->attribute->name); ?> :
                                                        <?php echo e($variation->attribute_value->color ? @$variation->attribute_value->color->name : @$variation->attribute_value->value); ?>

                                                        <br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td><?php echo e($sku->sku); ?></td>
                                                    <td>
                                                        <span> <?php echo e(__('product.base_price')); ?>: </span><?php echo e(single_price($sku->selling_price)); ?>

                                                        <?php if(isModuleActive('WholeSale') && !isModuleActive('MultiVendor')): ?>
                                                            <?php
                                                                $sellerProductSku = $sku->sellerProductSku;
                                                                if ($sellerProductSku != null){
                                                                    $wholesalePrices = $sellerProductSku->wholeSalePrices;
                                                                }
                                                            ?>
                                                            <?php if(($sellerProductSku != null) && !empty($wholesalePrices)): ?>
                                                                <br><span> <?php echo e(__('wholesale.Wholesale Price')); ?>: </span>
                                                                <ul>
                                                                    <?php $__currentLoopData = $wholesalePrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li> <span><?php echo e(__('wholesale.Range')); ?>: (<?php echo e($w_price->min_qty.'-'.$w_price->max_qty); ?>) </span>  <?php echo e(single_price($w_price->selling_price)); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <label class="switch_toggle" for="checkboxy<?php echo e($sku->id); ?>">
                                                            <input type="checkbox" id="checkboxy<?php echo e($sku->id); ?>" <?php if($sku->status == 1): ?> checked <?php endif; ?>
                                                            value="<?php echo e($sku->id); ?>" class="sku_status_change"
                                                            data-id="<?php echo e($sku->id); ?>">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </td>
                                                    <?php if($product->is_physical != 1 && $product->product_type == 2 && @$product->skus->first()->digital_file->file_source != null): ?>
                                                    <td><a href="<?php echo e(asset(asset_path(@$product->skus->first()->digital_file->file_source))); ?>"><?php echo e(__('product.click_on_it')); ?></a>
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ content  -->
                        </div>
                        <?php endif; ?>
                        <div class="col-12 mt-40 mb-20">
                            <div class="description_box">
                                <h4 class="f_s_14 f_w_500 mb_10"><?php echo e(__('common.description')); ?>:</h4>
                                <p class="f_w_400">
                                    <?php
                                    echo $product->description;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/product_detail.blade.php ENDPATH**/ ?>