<?php if($combinations != [] && count($combinations[0]) > 0): ?>
    <table class="table table-bordered sku_table">
        <thead>
        <tr>
            <td width="10%" class="text-center">
                <label for="" class="control-label"><?php echo e(__('product.variant')); ?></label>
            </td>

            <td width="13%" class="text-center">
                <label for="" class="control-label"><?php echo e(__('product.selling_price')); ?></label>
            </td>
            <?php if(!isModuleActive('MultiVendor')): ?>
                <td width="13%" class="text-center stock_td d-none">
                    <label for="" class="control-label"><?php echo e(__('product.stock')); ?></label>
                </td>
            <?php endif; ?>
            <td width="11%" class="text-center">
                <label for="" class="control-label"><?php echo e(__('product.SKU')); ?></label>
            </td>
            <td width="20%" class="text-center variant_physical_div">
                <label for="" class="control-label"><?php echo e(__('common.image')); ?> (<?php echo e(getNumberTranslate(165)); ?> X <?php echo e(getNumberTranslate(165)); ?>)<?php echo e(__('common.px')); ?></label>
            </td>
            <td width="15%" class="text-center variant_digital_div">
                <label for="" class="control-label"><?php echo e(__('product.file')); ?></label>
            </td>
            <td width="15%" class="variant_digital_div">
                <label for="" class="control-label"><?php echo e(__('product.in_app_purchase_code')); ?></label>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
            $valIncre = 1;
            $imgIncrement = 0;
        ?>
        <?php $__currentLoopData = $combinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $sku = '';
                $ttt = $key;
                $sku .= str_replace(' ', '-', $variant_sku_prefix);
                $str = '';
                $str_id = '';
                $attribute_id = '';
                foreach ($combination as $key => $items){
                    $item_value = \Modules\Product\Entities\AttributeValue::find($items);
                    if ($item_value->attribute_id == 1) {
                        $item = $item_value->color->name;
                    }else {
                        $item = $item_value->value;
                    }
                    if($key > 0 ){
                        $attribute_id .= '-'.str_replace(' ', '', $attribute[$key]);
                        $str_id .= '-'.str_replace(' ', '', $items);
                        $str .= '-'.str_replace(' ', '', $item);
                        $sku .='-'.str_replace(' ', '', $item);
                    }else {
                        $attribute_id .= str_replace(' ', '', $attribute[$key]);
                        $str_id .= str_replace(' ', '', $items);
                        $str .= str_replace(' ', '', $item);
                        $sku .= '-'.str_replace(' ', '', $item);
                    }
                }
                $valIncre +=$valIncre;
                $imgIncrement += 1;
            ?>
            <?php if(strlen($str) > 0): ?>
                <tr class="variant">
                    <td class="text-center">
                        <input type="hidden" name="str_attribute_id[]" value="<?php echo e($attribute_id); ?>">
                        <input type="hidden" name="str_id[]" value="<?php echo e($str_id); ?>">
                        <label for="" class="control-label mt-30"><?php echo e($str); ?></label>
                    </td>
                    <td class="text-center">
                        <div class="float-left mt_10">
                            <input class="mt-1 selling_price style_selling_price_field" type="number" name="selling_price_sku[]"
                                   value="<?php echo e(gv($selling_price_sku,$ttt, 0)); ?>" min="0" step="<?php echo e(step_decimal()); ?>"
                                   class="form-control">
                            <?php if(isModuleActive('WholeSale')): ?>
                                <button type="button" data-toggle="modal" tabindex="-1"
                                        data-target="#variant_wholesale_price_modal_<?php echo e($sku.$ttt); ?>"
                                        class="btn btn-sm style_plus_icon add_variant_whole_sale_price">
                                    <i class="ti-plus"></i>
                                </button>
                                <!-- Append WholeSale Price  -->
                                <ul id="append_w_p<?php echo e($sku.$ttt); ?>"></ul>
                            <?php endif; ?>
                        </div>
                    </td>
                    <?php if(!isModuleActive('MultiVendor')): ?>
                        <td class="text-center pt-20 stock_td d-none">
                            <input class="primary_input_field mt-20" type="number" name="sku_stock[]"
                                   value="<?php echo e(gv($sku_stock,$ttt, 0)); ?>" min="0" step="0" class="form-control" required>
                        </td>
                    <?php endif; ?>
                    <td class="text-center pt-25">
                        <input class="primary_input_field mt-20" type="text" name="sku[]"
                               value="<?php echo e(gv($old_sku,$ttt, $sku)); ?>" class="form-control">
                        <input type="hidden" name="track_sku[]" value="<?php echo e($sku); ?>">
                    </td>

                    <td class="variant_physical_div text-center pt_2">
                        <div class="primary_input ">
                            <div class="primary_file_uploader mt-25" data-toggle="amazuploader" data-multiple="false"
                                 data-type="image" data-name="variant_image_<?php echo e($imgIncrement); ?>">
                                <input class="primary-input file_amount" type="text"
                                       id="variant_image_file_<?php echo e($valIncre); ?>" placeholder="<?php echo e(__("common.image")); ?>"
                                       readonly="">
                                <button class="" type="button">
                                    <label class="primary-btn small fix-gr-bg"
                                           for="variant_image_<?php echo e($valIncre); ?>"><?php echo e(__("product.Browse")); ?> </label>

                                    <input type="hidden" class="selected_files" value="">
                                </button>
                            </div>
                            <div class="product_image_all_div variant_image">

                            </div>
                        </div>
                    </td>
                    <td class="variant_digital_div text-center">
                        <div class="primary_input mb-10">
                            <div class="primary_file_uploader">
                                <input class="primary-input mt_10" type="text" id="variant_digital_file_<?php echo e($valIncre); ?>"
                                       placeholder="<?php echo e(__("common.file")); ?>" readonly="">
                                <button class="mt_10" type="button">
                                    <label class="primary-btn small fix-gr-bg"
                                           for="digital_file_<?php echo e($valIncre); ?>"><?php echo e(__("product.Browse")); ?> </label>
                                    <input type="file" class="d-none variant_digital_file_change" name="digital_file[]"
                                           data-name_id="variant_digital_file_<?php echo e($valIncre); ?>"
                                           id="digital_file_<?php echo e($valIncre); ?>">
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="variant_digital_div text-center">
                        <input class="primary_input_field mt-1" type="text" name="var_in_app_purchase_code[]"
                                   value=""  class="form-control">
                    </td>
                </tr>
            <?php endif; ?>
            <?php if(isModuleActive('WholeSale')): ?>
                <?php echo $__env->make('wholesale::components._create_variant_wholesale_price_modal', ['modalTargetId'=> $sku.$ttt, 'incKey'=>$ttt], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php /**PATH /var/www/DhatriProduction/Modules/Product/Resources/views/products/sku_combinations.blade.php ENDPATH**/ ?>