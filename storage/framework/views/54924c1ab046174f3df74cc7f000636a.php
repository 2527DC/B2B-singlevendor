<?php $__env->startSection('styles'); ?>
    <style>
        .dashed {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px dashed var(--gradient_1);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-25">
                    <div class="white_box_50px box_shadow_white">
                        <form action="<?php echo e(route('shipping.pending_orders.index')); ?>" method="get">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-3 date-range-block">
                                    <div class="primary_input mb-15 date_range">
                                        <div class="primary_datepicker_input filter">
                                            <label class="primary_input_label" for="date"><?php echo e(__('common.date')); ?></label>
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input autocomplete="off" class="primary_input_field filter_date_input_field" type="text" name="date_range_filter" value="<?php echo e(!empty($date_range_filter) ? $date_range_filter : ""); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="carrier"><?php echo e(__('shipping.carrier')); ?> </label>
                                        <select class="primary_select mb-15" id="carrier" name="carrier">
                                            <option value=""><?php echo e(__('common.select_one')); ?></option>
                                            <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carrier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($carrier->id == $f_carrier ? 'selected' :''); ?> value="<?php echo e($carrier->id); ?>"><?php echo e($carrier->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="shipping_method"><?php echo e(__('shipping.method')); ?> </label>
                                        <select class="primary_select mb-15" id="shipping_method" name="shipping_method">
                                            <option value=""><?php echo e(__('common.select_one')); ?></option>
                                            <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($method->id == $shipping_method ? 'selected' :''); ?> value="<?php echo e($method->id); ?>"><?php echo e($method->method_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="package_code"> <?php echo e(__("shipping.tracking_id")); ?></label>
                                        <input value="<?php echo e(!empty($package_code) ? $package_code :''); ?>" class="primary_input_field" name="package_code" id="package_code" placeholder=" <?php echo e(__("shipping.tracking_id")); ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center">
                                        <button class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-search"></i><?php echo e(__('common.search')); ?></button>
                                        <a href="<?php echo e(route('shipping.pending_orders.index')); ?>" class="primary-btn semi_large2  fix-gr-bg"  type="button"><i class="ti-reload"></i><?php echo e(__('shipping.reset')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="dashed">

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="primary_input_label" for=""><?php echo e(__('shipping.set_pickup_location')); ?></label>
                                    <ul class="permission_list sms_list">
                                        <?php $__currentLoopData = $pickup_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <label class="primary_checkbox d-flex mr-12 ">
                                                    <input <?php echo e(pickupLocationData('id') == $location->id ? 'checked' :''); ?> name="pickup_location" class="pickup_location" type="radio" id="set_pickup_location" value="<?php echo e($location->id); ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <p><?php echo e($location->pickup_location); ?></p>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table mt-80">
                        
                        <?php if(permissionCheck('shipping.invoice_generate')): ?>
                            <form id="bulk_invoice_download_form" method="POST" action="<?php echo e(route('shipping.bulk_invoice_download')); ?>" target="_blank" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <div id="bulk_invoice_inputs"></div>
                                <button type="button" class="primary-btn fix-gr-bg" id="bulk_download_invoice">Download Invoices</button>
                            </form>
                        <?php endif; ?>
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('common.sl')); ?></th>
                                        <th>
                                              <label class="primary_checkbox">
                                                <input type="checkbox" id="select_all">
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th><?php echo e(__('common.date')); ?></th>
                                        <th><?php echo e(__('common.order_id')); ?></th>
                                        <th><?php echo e(__('shipping.tracking_id')); ?></th>
                                        <th><?php echo e(__('shipping.shipping_method')); ?></th>
                                        <th><?php echo e(__('shipping.carrier')); ?></th>
                                        <!-- removed packaging column as not required -->
                                        <th><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e(getNumberTranslate($key+1)); ?></td>
                                            <td>
                                                <label class="primary_checkbox">
                                                    <input type="checkbox"
                                                        class="invoice_checkbox"
                                                        value="<?php echo e($row->id); ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>

                                            <td><?php echo e(dateConvert($row->created_at)); ?></td>
                                            <td><?php echo e(getNumberTranslate($row->order->order_number)); ?></td>
                                            <td><?php echo e(getNumberTranslate($row->package_code)); ?></td>
                                            <td><?php echo e($row->shipping->method_name); ?></td>
                                            <td><?php echo e($row->carrier->name); ?></td>
                                                                                        <!-- packaging columns removed per request -->
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php echo e(__('common.select')); ?>

                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        <?php if(permissionCheck('shipping.label_generate')): ?>
                                                            <a  target="_blank" href="<?php echo e(route('shipping.label_generate',$row->id)); ?>" download="" class="dropdown-item"><?php echo e(__('shipping.Print of Manifestation ')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('shipping.invoice_generate')): ?>
                                                            <a download="" target="_blank" href="<?php echo e(route('shipping.invoice_generate',$row->id)); ?>" class="dropdown-item"><?php echo e(__('shipping.invoice')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('shipping.method_update') && $row->carrier_order_id == null && ($row->length && $row->breadth && $row->height && $row->weight)): ?>
                                                            <a href="#" data-id="<?php echo e($row->id); ?>" class="change_shipping_method dropdown-item"><?php echo e(__('shipping.shipping')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('shipping.packaging.update')): ?>
                                                            <a href="#" data-id="<?php echo e($row->id); ?>" class="packaging_edit dropdown-item"><?php echo e(__('shipping.packaging')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('shipping.customer_address_update') && $row->carrier_order_id == null): ?>
                                                            <a href="#" data-id="<?php echo e($row->id); ?>" class="customer_address_edit dropdown-item"><?php echo e(__('common.address')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('shipping.carrier_status') && $row->carrier_order_id && $row->carrier->slug == 'Shiprocket'): ?>
                                                            <a href="#" data-id="<?php echo e($row->id); ?>" class="carrier_status dropdown-item"><?php echo e(__('shipping.carrier_status')); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="append_html"></div>
        <?php echo $__env->make('shipping::order.components._multiple_order_method_change', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <input type="hidden" value="<?php echo e(count($orders)); ?>" id="total_order">
        <input type="hidden" value="<?php echo e(route('shipping.single_order_method_change',':id')); ?>" id="shipping_method_change_url">
        <input type="hidden" value="<?php echo e(route('shipping.method_update')); ?>" id="shipping_method_update_url">
        <input type="hidden" value="<?php echo e(route('shipping.pickup_locations.set',':location')); ?>" id="set_pickup_location_url">
        <input type="hidden" value="<?php echo e(route('shipping.update_carrier_order',':id')); ?>" id="update_carrier_order_url">
        <input type="hidden" value="<?php echo e(route('shipping.packaging.edit',':id')); ?>" id="packaging_edit_url">
        <input type="hidden" value="<?php echo e(route('shipping.packaging.update')); ?>" id="packaging_update_url">
        <input type="hidden" value="<?php echo e(route('shipping.carrier_change')); ?>" id="shipping_carrier_change">
        <input type="hidden" value="<?php echo e(route('shipping.customer_address_edit',':id')); ?>" id="customer_address_edit">
        <input type="hidden" value="<?php echo e(route('shipping.customer_address_update')); ?>" id="customer_address_update">
        <input type="hidden" value="<?php echo e(route('shipping.carrier_status',':id')); ?>" id="carrier_status_url">
        
        <input type="hidden" id="csrf_token" value="<?php echo e(csrf_token()); ?>">
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('Modules/Shipping/Resources/assets/js/shipping.js')); ?>"></script>
    <script src="<?php echo e(asset('Modules/Shipping/Resources/assets/js/shipping_method_change.js')); ?>"></script>
    <script src="<?php echo e(asset('Modules/Shipping/Resources/assets/js/date_range.js')); ?>"></script>
    <script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $(document).on('change', '#b_business_country', function(event){
                let country = $('#b_business_country').val();

                $('#pre-loader').removeClass('d-none');
                if(country){
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-state?country_id=' +country;

                    $('#b_business_state').empty();

                    $('#b_business_state').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#b_business_state').niceSelect('update');
                    $('#b_business_city').empty();
                    $('#b_business_city').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#b_business_city').niceSelect('update');
                    $.get(url, function(data){

                        $.each(data, function(index, stateObj) {
                            $('#b_business_state').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                        });

                        $('#b_business_state').niceSelect('update');
                        $('#pre-loader').addClass('d-none');
                    });
                }
            });
            $(document).on('change', '#b_business_state', function(event){
                let state = $('#b_business_state').val();

                $('#pre-loader').removeClass('d-none');
                if(state){
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-city?state_id=' +state;

                    $('#b_business_city').empty();

                    $('#b_business_city').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#b_business_city').niceSelect('update');

                    $.get(url, function(data){

                        $.each(data, function(index, cityObj) {
                            $('#b_business_city').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                        });

                        $('#b_business_city').niceSelect('update');
                        $('#pre-loader').addClass('d-none');
                    });
                }
            });

            $(document).on('change', '#s_business_country', function(event){
                let country = $('#s_business_country').val();

                $('#pre-loader').removeClass('d-none');
                if(country){
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-state?country_id=' +country;

                    $('#s_business_state').empty();

                    $('#s_business_state').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#s_business_state').niceSelect('update');
                    $('#s_business_city').empty();
                    $('#s_business_city').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#s_business_city').niceSelect('update');
                    $.get(url, function(data){

                        $.each(data, function(index, stateObj) {
                            $('#s_business_state').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                        });

                        $('#s_business_state').niceSelect('update');
                        $('#pre-loader').addClass('d-none');
                    });
                }
            });
            $(document).on('change', '#s_business_state', function(event){
                let state = $('#s_business_state').val();

                $('#pre-loader').removeClass('d-none');
                if(state){
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-city?state_id=' +state;

                    $('#s_business_city').empty();

                    $('#s_business_city').append(
                        `<option value="" disabled selected><?php echo e(__('common.select_one')); ?></option>`
                    );
                    $('#s_business_city').niceSelect('update');

                    $.get(url, function(data){

                        $.each(data, function(index, cityObj) {
                            $('#s_business_city').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                        });

                        $('#s_business_city').niceSelect('update');
                        $('#pre-loader').addClass('d-none');
                    });
                }
            });

            $(document).on('change', '#shipping_carrier', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                let carrier = $(this).val();
                let url =  $('#shipping_carrier_change').val();
                url = url.replace(':id',carrier);
                let data = {
                    "_token":"<?php echo e(csrf_token()); ?>",
                    "carrier_id":carrier,
                    "package_id":$('#packageId').val(),
                }
                $.post(url,data, function(response){
                    if(response){
                       $('#courier_div').html(response)
                        $('select').niceSelect();
                        $('#pre-loader').addClass('d-none');

                    }
                });
            });

            $(document).on('click', '.update_carrier_order', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                let id = $(this).data('id');
                let url =  $('#update_carrier_order_url').val();
                url = url.replace(':id',id);
                $.get(url, function(response){
                    if(response){
                        $('#pre-loader').addClass('d-none');
                        if(response.status == 'NEW'){
                            let url = "<?php echo e(route('shipping.edit_carrier_order',':id')); ?>";
                            url = url.replace(':id', id);
                            document.location.href=url;
                        }else {
                            toastr.warning('Order Update Not Possible')
                        }

                    }
                });
            });

            $(document).on('change', '#set_pickup_location', function(event){
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                let location = $('#set_pickup_location:checked').val();
                let url =  $('#set_pickup_location_url').val();
                url = url.replace(':location',location);
                $.get(url, function(response){
                    if(response){
                        $('#pre-loader').addClass('d-none');
                       toastr.success('Pickup Location Change Successfully.')
                    }
                });
            });

            $(document).on('change', '#filter', function(event){
                let filter = $(this).val();
                let couriers = JSON.parse( $('#couriers_data').val());

                if(filter == "1"){
                    couriers.sort(function(a, b) {
                        return a['freight_charge'] - b['freight_charge'];
                    });
                }else {
                    couriers.sort(dynamicAlphabeticallySort("estimated_delivery_days"));
                }
                let data = ``;

                $.each(couriers, function (index, c) {
                    data+= ` <li>
                                <label class="primary_checkbox d-flex mr-12 ">
                                    <input name="shipping_method" class="shipping_method" type="radio" id="shipping_method" value="`+c.courier_company_id+`">
                                    <span class="checkmark"></span>
                                </label>
                                <p>`+c.courier_name+` (Freight Charges: `+c.freight_charge+` , <?php echo e(__('shipping.estimated_delivery')); ?>: `+c.estimated_delivery_days+` days)</p>
                             </li>
                            `
                });
                $('#courier_data').html(data);
            });

            /**
             * Function to sort alphabetically an array of objects by some specific key.
             *
             * @param {String} property Key of the object to sort.
             */
            function dynamicAlphabeticallySort(property) {
                var sortOrder = 1;
                if(property[0] === "-") {
                    sortOrder = -1;
                    property = property.substr(1);
                }

                return function (a,b) {
                    if(sortOrder == -1){
                        return b[property].localeCompare(a[property]);
                    }else{
                        return a[property].localeCompare(b[property]);
                    }
                }
            }

            // ============ BULK INVOICE IMPORT CODE ============
            
            // Select/Deselect all invoices
            $('#select_all').on('change', function() {
                $('.invoice_checkbox').prop('checked', this.checked);
            });

            // Update select all when individual checkboxes change
            $(document).on('change', '.invoice_checkbox', function() {
                let totalCheckboxes = $('.invoice_checkbox').length;
                let checkedCount = $('.invoice_checkbox:checked').length;
                $('#select_all').prop('checked', checkedCount === totalCheckboxes);
            });

            // Bulk Import Invoice feature removed
            
            // Bulk Download Invoices
            $('#bulk_download_invoice').on('click', function(e) {
                e.preventDefault();

                let invoiceIds = [];
                $('.invoice_checkbox:checked').each(function() {
                    invoiceIds.push($(this).val());
                });

                if (invoiceIds.length === 0) {
                    toastr.warning('Please select at least one invoice');
                    return false;
                }

                // prepare form inputs and submit to download in new tab
                $('#bulk_invoice_inputs').empty();
                invoiceIds.forEach(function(id) {
                    $('#bulk_invoice_inputs').append('<input type="hidden" name="invoice_ids[]" value="'+id+'">');
                });

                $('#bulk_invoice_download_form').submit();
            });
            // ============ END BULK INVOICE DOWNLOAD CODE ============
            // ============ END BULK INVOICE IMPORT CODE ============

        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/order/index.blade.php ENDPATH**/ ?>