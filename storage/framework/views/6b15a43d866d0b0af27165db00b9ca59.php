<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/adminreport/css/style.css'))); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title', app('general_setting')->site_title); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('report.filter_selection_criteria')); ?>

                            <?php echo e(__('common.for')); ?> <?php echo e(__('report.product_stock')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-20">
                <div class="white_box_50px box_shadow_white pb-3">
                    <form class="" action="<?php echo e(route('report.product_stock')); ?>" method="GET">
                        <div class="row">
                            <div class="col">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.type')); ?></label>
                                    <select required class="primary_select mb-15" name="type" id="type">
                                        <option value=""><?php echo e(__('common.select_one')); ?></option>
                                        <?php if(isModuleActive('MultiVendor')): ?>
                                        <option <?php if(isset($type) && $type=="inhouse" ): ?> selected <?php endif; ?> value="inhouse">
                                            <?php echo e(__('product.inhouse_product_list')); ?></option>
                                        <?php endif; ?>
                                        <option <?php if(!isset($type)): ?> selected <?php endif; ?> <?php if(isset($type) && $type=="all" ): ?>
                                            selected <?php endif; ?> value="all"><?php echo e(__('common.all')); ?>

                                            <?php echo e(__('common.product')); ?> <?php echo e(__('common.list')); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('seller_id')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="primary_input">
                                <button type="submit" class="primary-btn fix-gr-bg" id="save_button_parent"><i
                                        class="ti-search"></i><?php echo e(__('report.search')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if(isModuleActive('MultiVendor')): ?>
            <div class="col-lg-6">
                <div class="white_box_50px box_shadow_white pb-3">
                    <form class="" action="<?php echo e(route('report.product_stock')); ?>" method="GET">
                        <div class="row">
                            <div class="col">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label"
                                        for=""><?php echo e(__('report.seller_wise_stock')); ?></label>
                                        <input type="hidden" name="type" id="" value="seller">

                                    <select required class="primary_select mb-15" name="seller_id" id="type">
                                        <option value=""><?php echo e(__('common.select_one')); ?></option>
                                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($seller->user->id); ?>" <?php if(isset($seller_id) && $seller->
                                            user->id == $seller_id): ?> selected
                                            <?php endif; ?>><?php echo e(($seller->seller_shop_display_name) ? $seller->seller_shop_display_name : $seller->user->first_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger"><?php echo e($errors->first('seller_id')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="primary_input">
                                <button type="submit" class="primary-btn fix-gr-bg" id="save_button_parent"><i
                                        class="ti-search"></i><?php echo e(__('report.search')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if(isset($type) && $type=="all" ): ?>

    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('report.product_stock')); ?> (<?php echo e(__('common.all')); ?>)</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="allProductTable" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('common.name')); ?></th>
                                        <th scope="col"><?php echo e(__('product.stock')); ?></th>
                                        <th scope="col"><?php echo e(__('common.type')); ?></th>
                                        <?php if(isModuleActive('MultiVendor')): ?>
                                        <th scope="col"><?php echo e(__('common.seller')); ?></th>
                                        <?php endif; ?>
                                        <th scope="col"><?php echo e(__('product.brand')); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(isset($type) && $type=="inhouse" ): ?>
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('report.product_stock')); ?> (<?php echo e(__('common.inhouse')); ?>)</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="inhouseTable" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('common.name')); ?></th>
                                        <th scope="col"><?php echo e(__('product.stock')); ?></th>
                                        <th scope="col"><?php echo e(__('product.brand')); ?></th>
                                        <th scope="col"><?php echo e(__('product.logo')); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(isset($type) && $type=="seller" ): ?>
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('report.product_stock')); ?> (<?php echo e(__('common.seller')); ?>)</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="sellerTable" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('common.name')); ?></th>
                                        <th scope="col"><?php echo e(__('product.stock')); ?></th>
                                        <th scope="col"><?php echo e(__('common.type')); ?></th>
                                        <th scope="col"><?php echo e(__('product.brand')); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($){
            "use strict";

            var column_data = [];
            <?php if(isModuleActive('MultiVendor')): ?>
                column_data = [
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_stock', name: 'product_stock' },
                        { data: 'product_type', name: 'product_type' },
                        { data: 'seller', name: 'seller' },
                        { data: 'brand', name: 'brand.name' }

                    ]
            <?php else: ?>
                column_data = [
                        { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_stock', name: 'product_stock' },
                        { data: 'product_type', name: 'product_type' },
                        { data: 'brand', name: 'brand.name' }
                    ]
            <?php endif; ?>

            $('#allProductTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": ( {
                    url: "<?php echo e(route('report.product_stock_data')); ?>?type=all"
                }),
                "initComplete":function(json){

                },
                columns: column_data,

                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });
            <?php if(isset($seller_id)): ?>

            $('#sellerTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": ( {
                    url: "<?php echo e(route('report.product_stock_data')); ?>?type=seller&seller_id=<?php echo e($seller_id); ?>"
                }),
                "initComplete":function(json){

                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'product_name', name: 'product_name' },
                    { data: 'product_stock', name: 'product_stock' },
                    { data: 'product_type', name: 'product_type' },
                    { data: 'brand', name: 'brand.name' },

                ],

                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                        visible: false
                }],
                    responsive: true,
            });


            <?php endif; ?>
            $('#inhouseTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": ( {
                    url: "<?php echo e(route('seller.product.get-data')); ?>"
                }),
                "initComplete":function(json){

                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'product_name', name: 'product_name' },
                    { data: 'product_stock', name: 'product_stock' },
                    { data: 'brand', name: 'brand' },
                    { data: 'logo', name: 'logo' },

                ],

                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });

    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/Modules/AdminReport/Resources/views/product_stock/index.blade.php ENDPATH**/ ?>