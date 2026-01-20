
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/backend_page_css/wishlist.css'))); ?>" />
<link rel="stylesheet" href="<?php echo e(asset(asset_path('backend/css/cart_modal.css'))); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<!--  dashboard part css here -->
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="white_box_30px mb_30">
                    <div id="productShow">
                        <?php echo $__env->make('backEnd.pages.customer_data._wishlist_with_paginate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="login_check" value="<?php if(auth()->check()): ?> 1 <?php else: ?> 0 <?php endif; ?>">
    <div class="add-product-to-cart-using-modal">
    </div>
</section>
<?php echo $__env->make('backEnd.partials._deleteModalForAjax',['item_name' => __('defaultTheme.wishlist_product'),'form_id' =>
'wishlist_delete_form','modal_id' => 'wishlist_delete_modal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.page-item a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_filter_data(page);
        });
        function fetch_filter_data(page){
            $('#pre-loader').removeClass('d-none');
            var paginate = $('#paginate_by').val();
            var sort_by = $('#product_short_list').val();
            if (sort_by != null && paginate != null) {
                var url = "<?php echo e(route('frontend.my-wishlist.paginate-data')); ?>"+'?sort_by='+sort_by+'&paginate='+paginate+'&page='+page;
            }else if (sort_by == null && paginate != null) {
                var url = "<?php echo e(route('frontend.my-wishlist.paginate-data')); ?>"+'?paginate='+paginate+'&page='+page;
            }else {
                var url = "<?php echo e(route('frontend.my-wishlist.paginate-data')); ?>"+'?page='+page;
            }
            if(page != 'undefined'){
                $.ajax({
                    url:url,
                    success:function(data)
                    {
                        $('#productShow').html(data);
                        $('#product_short_list').niceSelect();
                        $('#paginate_by').niceSelect();
                        $('#pre-loader').addClass('d-none');
                    }
                });
            }else{
                toastr.warning("<?php echo e(__('common.error_message')); ?>");
            }
        }
        $(document).on('click', '#wishlist_delete_form', function(event){
            event.preventDefault();
            $('#pre-loader').removeClass('d-none');
            $('#wishlist_delete_modal').modal('hide');
            let formData = new FormData();
            formData.append('_token', "<?php echo e(csrf_token()); ?>");
            formData.append('id', $('#delete_item_id').val());
            formData.append('sort_by', $('#product_short_list').val());
            formData.append('paginate', $('#paginate_by').val());
            $.ajax({
                url: "<?php echo e(route('frontend.wishlist.remove')); ?>",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    toastr.success("<?php echo e(__('common.deleted_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                    $('#productShow').html(response);
                    $('#product_short_list').niceSelect();
                    $('#paginate_by').niceSelect();
                    $('#pre-loader').addClass('d-none');
                },
                error: function(response) {
                    toastr.error('<?php echo e(__("common.error_message")); ?>', "<?php echo e(__('common.error')); ?>");
                    $('#pre-loader').addClass('d-none');
                }
            });
        });
    });
    $(document).on('change','.paginate_no', function(){
        getFilterUpdateByIndex()
    });
    $(document).on('change','.sort_by', function(){
        getFilterUpdateByIndex()
    });
    $(document).on('click','.removeFromWhishlist', function(event){
        event.preventDefault();
        $('#wishlist_delete_modal').modal('show');
        $('#delete_item_id').val($(this).attr("data-product-id"));
    });
    function getFilterUpdateByIndex(){
        var paginate = $('#paginate_by').val();
        var sort_by = $('#product_short_list').val();
        $("#pre-loader").removeClass('d-none');
        $.get("<?php echo e(route('frontend.my-wishlist.paginate-data')); ?>", {sort_by:sort_by, paginate:paginate}, function(data){
            $('#productShow').html(data);
            $('#product_short_list').niceSelect();
            $('#paginate_by').niceSelect();
            $("#pre-loader").addClass('d-none');
        });
    }
    function removeWishlist(id){
        $('#wishlist_delete_modal').modal('show');
        $('#delete_item_id').val(id);
    }
    $(document).on('click', ".addToCompareFromThumnail", function(event) {
        event.preventDefault();
        var className = this.className;
        if ($(this).data('producttype') == 1) {
            addToCompare($(this).attr('data-product-sku'), $(this).data('producttype'), 'product');
        }
        else {
            $('#pre-loader').removeClass('d-none');
            $.post('<?php echo e(route('frontend.item.show_in_modal')); ?>', {_token:'<?php echo e(csrf_token()); ?>', product_id:$(this).attr('data-product-id')}, function(data){
                $(".add-product-to-cart-using-modal").html(data);
                $("#theme_modal").modal('show');
                $('.nc_select, .select_address, #product_short_list, #paginate_by').niceSelect();
                $('#pre-loader').addClass('d-none');
            });
        }
    });
    function addToCompare(product_sku_id, product_type, type){
        if(product_sku_id && type){
            $('#pre-loader').removeClass('d-none');
            let data = {
                '_token' : '<?php echo e(csrf_token()); ?>',
                'product_sku_id' : product_sku_id,
                'data_type' : type,
                'product_type' : product_type
            }
            $.post("<?php echo e(route('frontend.compare.store')); ?>", data, function(response){
                if(response.msg == 'done'){
                    toastr.success("<?php echo e(__('defaultTheme.product_added_to_compare_list_successfully')); ?>","<?php echo e(__('common.success')); ?>")
                    $("#theme_modal").modal('hide');
                    $('.compare_count').text(numbertrans(response.totalItems));
                }else{
                    toastr.error("<?php echo e(__('defaultTheme.not_added')); ?>","<?php echo e(__('common.error')); ?>")
                }
                $('#pre-loader').addClass('d-none');
            });
        }
    }
    $(document).on('click', '.quickView', function(event){
        event.preventDefault();
        let product_id = $(this).data('product-id');
        let type = $(this).data('producttype');
        quickView(product_id, type);
    });
    function quickView(product_id, type){
        $('#pre-loader').removeClass('d-none');
        let payloadData = {
            _token:'<?php echo e(csrf_token()); ?>',
            product_id: product_id,
            type: type
        };
        $.post('<?php echo e(route('admin.item.show_in_modal')); ?>', payloadData, function(data){
            $(".add-product-to-cart-using-modal").html(data);
            $("#theme_modal").modal('show');
            $('.nc_select, .select_address, #product_short_list, #paginate_by').niceSelect();
            $('#pre-loader').addClass('d-none');
        });
    }
    $(document).on("click", ".buy_now_btn_modal", function(event){
        event.preventDefault();
        buyNow($('#product_sku_id_modal').val(),$('#seller_id_modal').val(),$('#qty_modal').data('value'),$('#base_sku_price_modal').val(),$('#shipping_type').val(),'product',$('#owner_modal').val());
    });
    function buyNow(product_sku_id, seller_id, qty, price, shipping_type, type, owner=null) {
        $('#butItNow').prop('disabled',true);
        $('#butItNow').html("<?php echo e(__('defaultTheme.processing')); ?>");
        var formData = new FormData();
        formData.append('_token', "<?php echo e(csrf_token()); ?>");
        formData.append('price', price);
        formData.append('qty', qty);
        formData.append('product_id', product_sku_id);
        formData.append('seller_id', seller_id);
        formData.append('shipping_method_id', shipping_type);
        formData.append('type', type);
        formData.append('is_buy_now', 'yes');
        $('#pre-loader').removeClass('d-none');

        var base_url = $('#url').val();
        $.ajax({
            url: base_url + "/cart/store",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if(response.cart_details_submenu == 'out_of_stock'){
                    toastr.error('No more product to buy.');
                    $('#pre-loader').addClass('d-none');
                    $('#butItNow').prop('disabled',false);
                    $('#butItNow').html("<?php echo e(__('defaultTheme.but_it_now')); ?>");
                }else{
                    let checkout_type = "<?php echo e(base64_encode('buy_it_now')); ?>";
                    let seller_wise_payment = "<?php echo e(app('general_setting')->seller_wise_payment); ?>";
                    let = multi = "<?php echo e(isModuleActive('MultiVendor')); ?>";
                    let checkout_url = base_url + '/checkout?checkout_type='+checkout_type;
                    if(seller_wise_payment && multi){
                        checkout_url = base_url + '/checkout?checkout_type='+checkout_type+'&owner='+ owner;
                    }
                    location.replace(checkout_url);
                }
            },
            error: function (response) {
                toastr.error("<?php echo e(__('defaultTheme.product_not_added')); ?>","<?php echo e(__('common.error')); ?>");
                $('#butItNow').prop('disabled',false);
                $('#butItNow').html("<?php echo e(__('defaultTheme.but_it_now')); ?>");
                $('#pre-loader').addClass('d-none');
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(theme('partials.add_to_cart_script'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/pages/customer_data/wishlist.blade.php ENDPATH**/ ?>