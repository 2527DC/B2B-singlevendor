
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('modules/product/css/brand.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('product.brand_list')); ?></h3>
                            <?php if(permissionCheck('product.brand.create')): ?>
                                <ul class="d-md-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route("product.brand.create")); ?>"><i class="ti-plus"></i><?php echo e(__('product.add_new_brand')); ?></a></li>
                                    <?php if(permissionCheck('product.bulk_brand_upload_page')): ?>
                                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('product.bulk_brand_upload_page')); ?>"><i class="ti-plus"></i><?php echo e(__('product.bulk_brand_upload')); ?></a></li>
                                    <?php endif; ?>

                                    <?php if(permissionCheck('product.csv_brand_download')): ?>
                                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="<?php echo e(route('product.csv_brand_download')); ?>"><i class="ti-download"></i><?php echo e(__('product.brand_csv')); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="table_search d-md-none d-xl-block">
                            <div class="serach_field-area3">
                                <div class="search_inner">
                                    <form action="<?php echo e(route('product.brands.index')); ?>" method="get">
                                        <div class="search_field">
                                            <input type="text" placeholder="<?php echo e(__('common.search')); ?>" name="keyword" id="keyword"  <?php if(isset($keyword)): ?> value="<?php echo e($keyword); ?>" <?php endif; ?>>
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th  width="20%" scope="col"><?php echo e(__('common.name')); ?></th>
                                        <th  width="20%" scope="col"><?php echo e(__('common.logo')); ?></th>
                                        <th  width="15%" scope="col"><?php echo e(__('common.status')); ?></th>
                                        <th  width="15%" scope="col"><?php echo e(__('common.featured')); ?></th>
                                        <th  width="20%" scope="col"><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="row1" data-id="<?php echo e($brand->id); ?>">
                                            <td><?php echo e($brand->name); ?></td>
                                            <td>
                                                <div class="logo_div">
                                                    <?php if($brand->logo != null): ?>
                                                        <img src="<?php echo e(showImage($brand->logo)); ?>" alt="<?php echo e($brand->name); ?>">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(showImage('frontend/default/img/brand_image.png')); ?>" alt="<?php echo e($brand->name); ?>">
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="switch_toggle" for="checkbox<?php echo e($brand->id); ?>">
                                                    <input type="checkbox" id="checkbox<?php echo e($brand->id); ?>" <?php if($brand->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('product.brand.update_active_status')): ?> value="<?php echo e($brand->id); ?>" data-id="<?php echo e($brand->id); ?>" class="status_change" <?php else: ?> disabled <?php endif; ?>>
                                                    <div class="slider round"></div>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="switch_toggle" for="active_checkbox<?php echo e($brand->id); ?>">
                                                    <input type="checkbox" id="active_checkbox<?php echo e($brand->id); ?>" <?php if($brand->featured == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('product.brand.update_active_feature')): ?> value="<?php echo e($brand->id); ?>" data-id="<?php echo e($brand->id); ?>" class="featured_change" <?php else: ?> disabled <?php endif; ?>>
                                                    <div class="slider round"></div>
                                                </label>
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php echo e(__('common.select')); ?>

                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        <a data-id="<?php echo e($brand->id); ?>" class="dropdown-item copy_id"><?php echo e(__('product.Copy ID')); ?></a>
                                                        <?php if(permissionCheck('product.brand.edit')): ?>
                                                            <a class="dropdown-item edit_brand" href="<?php echo e(route('product.brand.edit', $brand->id)); ?>"><?php echo e(__('common.edit')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(permissionCheck('product.brand.destroy')): ?>
                                                            <a class="dropdown-item delete_brand" data-value="<?php echo e(route('product.brand.destroy', $brand->id)); ?>"><?php echo e(__('common.delete')); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <?php echo e($brands->links()); ?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo $__env->make('backEnd.partials.delete_modal',['item_name' => __('product.brand')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
    (function($){
        "use strict";
        $(document).ready(function(){
            $(document).on('change', '.status_change', function(event){
                let id = $(this).data('id');
                let status = 0;
                if($(this).prop('checked')){
                    status = 1;
                }
                else{
                    status = 0;
                }
                $.post("<?php echo e(route('product.brand.update_active_status')); ?>", {_token:'<?php echo e(csrf_token()); ?>', id:id, status:status}, function(data){
                    if(data == 1){
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                    }
                    else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                })
                .fail(function(response) {
                if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }

                });
            });
            $(document).on('change', '.featured_change', function(event){
                let id = $(this).data('id');
                let featured = 0;

                if(this.checked){
                    featured = 1;
                }
                else{
                    featured = 0;
                }
                $.post('<?php echo e(route('product.brand.update_active_feature')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:id, featured:featured}, function(data){
                    if(data == 1){
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                    }
                    else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                    }
                }).fail(function(response) {
                    if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                        return false;
                    }
                });
            })
            $(function () {
                $("#table").DataTable();
                $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
                });
                function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="_token"]').attr('content');
                $('tr.row1').each(function(index,element) {
                    order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                    });
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('product.abc')); ?>",
                        data: {
                    order: order,
                    _token: token
                    },
                    success: function(response) {
                    }
                });
                }
            });
            $(document).on('click', '.loadmore_btn', function () {
                var totalCurrentResult = $('#tablecontents tr').length;
                $("#pre-loader").removeClass('d-none');
                $.ajax({
                    url: "<?php echo e(route('product.load_more_brands')); ?>",
                    method: "POST",
                    data: {
                        skip: totalCurrentResult,
                        _token: "<?php echo e(csrf_token()); ?>",
                    },
                    success: function (response) {
                        $("#tablecontents").append(response.brands);
                        $("#pre-loader").addClass('d-none');
                    },
                    error: function(response) {
                        $("#pre-loader").addClass('d-none');
                    }
                })
            });
            $(document).on('click', '.delete_brand', function(event){
                event.preventDefault();
                let route = $(this).data('value');
                confirm_modal(route);
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Product/Resources/views/brand/index.blade.php ENDPATH**/ ?>