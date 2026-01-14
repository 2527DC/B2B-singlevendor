
<?php $__env->startSection('mainContent'); ?>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('general_settings.currency_list')); ?></h3>
                        <?php if(permissionCheck('currencies.store')): ?>
                        <ul class="d-flex">
                            <li><a data-toggle="modal" class="primary-btn radius_30px mr-10 fix-gr-bg currency_modal_open"><i class="ti-plus"></i><?php echo e(__('general_settings.add_new_currency')); ?></a></li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table class="table Crm_table_active3">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(__('common.sl')); ?></th>
                                        <th scope="col"><?php echo e(__('common.name')); ?></th>
                                        <th scope="col"><?php echo e(__('general_settings.code')); ?></th>
                                        <th scope="col"><?php echo e(__('general_settings.symbol')); ?></th>
                                        <th scope="col"><?php echo e(__('general_settings.activate')); ?></th>
                                        <th scope="col"><?php echo e(__('general_settings.convert_rate')); ?> <?php echo e(getNumberTranslate(1)); ?> <?php echo e(app('general_setting')->currency_code); ?> = ?</th>
                                        <th scope="col"><?php echo e(__('common.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e(getNumberTranslate($key+1)); ?></th>
                                        <td><?php echo e($currency->name); ?></td>
                                        <td><?php echo e($currency->code); ?></td>
                                        <td><?php echo e($currency->symbol); ?></td>
                                        <td>
                                            <label class="switch_toggle" for="active_checkbox<?php echo e($currency->id); ?>">
                                                <input type="checkbox" id="active_checkbox<?php echo e($currency->id); ?>"
                                                    <?php if($currency->status == 1): ?> checked <?php endif; ?> <?php if(permissionCheck('currencies.update_active_status')): ?>value="<?php echo e($currency->id); ?>" class="update-status" <?php else: ?> disabled <?php endif; ?>>
                                                <div class="slider round"></div>
                                            </label>
                                        </td>
                                        <td><?php echo e(getNumberTranslate($currency->convert_rate)); ?> <?php echo e($currency->symbol); ?></td>
                                        <td>
                                            <!-- shortby  -->
                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <?php echo e(__('common.select')); ?>

                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenu2">
                                                    <?php if(permissionCheck('currencies.update')): ?>
                                                    <a class="dropdown-item edit_currency"
                                                        data-id=<?php echo e($currency->id); ?>><?php echo e(__('common.edit')); ?></a>
                                                    <?php endif; ?>
                                                    <?php if($currency->id > 120 && permissionCheck('currencies.destroy')): ?>
                                                    <a href="" data-id="<?php echo e($currency->id); ?>"
                                                        class="dropdown-item delete_currency"><?php echo e(__('common.delete')); ?></a>
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
                </div>
            </div>
        </div>
    </div>
</section>
<div id="edit_form">

</div>
<div id="add_currency_modal">
    <div class="modal fade admin-query" id="currency_add">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('general_settings.add_new_currency')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo e(route('currencies.store')); ?>" method="POST" id="currency_addForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('common.name')); ?> <span class="text-danger">*</span></label>
                                    <input name="name" class="primary_input_field name" placeholder="" type="text"
                                        required>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.code')); ?> <span class="text-danger">*</span></label>
                                    <input name="code" class="primary_input_field name" placeholder="" type="text"
                                        required>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label"
                                        for=""><?php echo e(__('general_settings.symbol')); ?> <span class="text-danger">*</span></label>
                                    <input name="symbol" class="primary_input_field name" placeholder="" type="text"
                                        required>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""><?php echo e(__('general_settings.convert_rate')); ?>

                                        <?php echo e(getNumberTranslate(1)); ?> <?php echo e(app('general_setting')->currency_code); ?> = ? <span class="text-danger">*</span></label>
                                    <input name="convert_rate" class="primary_input_field convert_rate" min="0" step="any"
                                        type="convert_rate" required>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2  fix-gr-bg"
                                        id="save_button_parent"><i class="ti-check"></i><?php echo e(__('common.save')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#add_currency_modal').hide();

            $(document).on('click','.currency_modal_open', function(){
                $('#add_currency_modal').modal('show');
                $('#currency_add').modal('show');
            });
            $(document).on('click', '.edit_currency', function(){
                $('#pre-loader').removeClass('d-none');
                $.post('<?php echo e(route('currencies.edit')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:$(this).attr("data-id")}, function(data){
                    $('#pre-loader').addClass('d-none');
                    $('#edit_form').html(data);
                    $('#Item_Edit').modal('show');
                });
            });
            $(document).on('click','.update-status', function(){
                if(this.checked){
                    var status = 1;
                }
                else{
                    var status = 0;
                }
                $('#pre-loader').removeClass('d-none');
                $.post('<?php echo e(route('currencies.update_active_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:this.value, status:status}, function(data){
                    
                    if(data.msg === 'success'){
                        toastr.success("<?php echo e(__('common.updated_successfully')); ?>","<?php echo e(__('common.success')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }else if(data.msg == 'default_currency'){
                        toastr.error("<?php echo e(__('general_settings.default_currency_not_changeble')); ?>","<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                    else{
                        toastr.error("<?php echo e(__('common.error_message')); ?>","<?php echo e(__('common.error')); ?>");
                        $('#pre-loader').addClass('d-none');
                    }
                }).fail(function(response) {
               if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error ,"<?php echo e(__('common.error')); ?>");
                    $('#pre-loader').addClass('d-none');
                    return false;
                }

            });
            });

            $(document).on('click', '.delete_currency', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                let baseUrl = $('#url').val();
                let url = baseUrl + "/setup/currencies/destroy/" + id;
                confirm_modal(url);
            });

        });

    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/GeneralSetting/Resources/views/currencies/index.blade.php ENDPATH**/ ?>