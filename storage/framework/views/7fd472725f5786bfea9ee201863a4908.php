
<?php $__env->startSection('mainContent'); ?>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('wallet.online_recharge_transactions')); ?></h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <table class="table" id="walletTable">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('common.sl')); ?></th>
                                        <th width="10%"><?php echo e(__('common.date')); ?></th>
                                        <th><?php echo e(__('common.email')); ?></th>
                                        <th><?php echo e(__('order.txn_id')); ?></th>
                                        <th><?php echo e(__('common.amount')); ?></th>
                                        <th><?php echo e(__('common.type')); ?></th>
                                        <th><?php echo e(__('common.payment_method')); ?></th>
                                        <th><?php echo e(__('common.approval')); ?></th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="base_url" value="<?php echo e(asset(asset_path('/'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($){
        "use Strict";
        $(document).ready(function(){
            walletTable();
            $(document).on('change', '.update_status', function(event){
                let id = $(this).data('id');
                let status = 0;
                if($(this).prop('checked')){
                    status = 1;
                }
                else{
                    status = 0;
                }
                $.post('<?php echo e(route('wallet_charge.update_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:id, status:status}, function(data){
                    if(data == 1){
                        toastr.success("<?php echo e(__('common.successful')); ?>","<?php echo e(__('common.success')); ?>")
                        walletTable();
                    }
                    else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                        walletTable();
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
            $(document).on('click', '.bank_details', function(event){
                let el = $(this).data('value');
                var base_url = $("#base_url").val();
                $("#bankDetails").modal('show');
                $("#account_holder").text(el.walletable.account_holder);
                $("#account_number").text(el.walletable.account_number);
                $("#branch_name").text(el.walletable.branch_name);
                $("#bank_name").text(el.walletable.bank_name);
                $("#check").attr("src",base_url+el.walletable.image_src);
            });
            $(document).on('submit', '#recharge_form', function(event){
                $('#user_id_error').text('');
                $('#recharge_amount_error').text('');
                $('#comment_error').text('');
                let user_id = $('#user_id').val();
                let amount_id = $('#amount_id').val();
                let comment_id = $('#comment_id').val();
                let input_check = 0;
                if(user_id == null){
                    $('#user_id_error').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                    input_check = 1;
                }
                if(amount_id < 1){
                    $('#recharge_amount_error').text("<?php echo e(__('validation.the_amount_is_must_be_gretter_than_0')); ?>");
                    input_check = 1;
                }
                if(amount_id == ''){
                    $('#recharge_amount_error').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                    input_check = 1;
                }
                if(comment_id ==  ''){
                    $('#comment_error').text("<?php echo e(__('validation.this_field_is_required')); ?>");
                    input_check = 1;
                }

                if(input_check == 1){
                    event.preventDefault();
                }
            });
            function walletTable(){
                $('#walletTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "ajax": ( {
                        url: "<?php echo e(route('wallet_recharge.get-data')); ?>"
                    }),
                    "initComplete":function(json){
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'id',render:function(data){
                            return numbertrans(data)
                        }},
                        { data: 'date', name: 'date' },
                        { data: 'email', name: 'user.email' },
                        { data: 'txn_id', name: 'txn_id' },
                        { data: 'amount', name: 'amount' },
                        { data: 'type', name: 'type' },
                        { data: 'GatewayName', name: 'GatewayName' },
                        { data: 'approval', name: 'approval' }
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
            }
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Wallet/Resources/views/backend/admin/recharge_request_index.blade.php ENDPATH**/ ?>