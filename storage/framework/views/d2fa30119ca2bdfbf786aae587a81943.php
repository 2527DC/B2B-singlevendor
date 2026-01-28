<?php $__env->startSection('mainContent'); ?>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('common.all_uploaded_files')); ?></h3>
                    </div>
                    <?php if(permissionCheck('media-manager.new-upload')): ?>
                    <ul class="d-flex">
                        <li><a class="primary-btn radius_30px mr-10 fix-gr-bg float-right" href="<?php echo e(url('/media-manager/new-upload')); ?>"></i><?php echo e(__('common.uploads_new_files')); ?></a></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="media_box box_shadow_white p-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="" method="GET" class="d-flex align-items-center gap_20 flex-wrap">
                                    <h4 class="flex-fill m-0"><?php echo e(__('common.all_files')); ?></h4>
                                    <div class="media_header_inputs flex-fill">
                                        <div class="primary_input ">
                                                <select class="primary_select style2" name="sort" id="status">
                                                    <option value="newest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'newest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by newest')); ?></option>
                                                    <option value="oldest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'oldest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by oldest')); ?></option>
                                                    <option value="smallest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'smallest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by smallest')); ?></option>
                                                    <option value="bigest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'bigest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by bigest')); ?></option>
                                                </select>
                                            </div>
                                            <div class="primary_input">
                                                <input class="primary_input_field2 input_height50 radius_30" name="search" placeholder="<?php echo e(__('common.search')); ?>" type="text" value="<?php echo e(isset($_GET['search'])?$_GET['search']:''); ?>">
                                            </div>
                                    </div>
                                    <button class="primary-btn semi_large2 fix-gr-bg cusrve_30px w_160"><i class="ti-check"></i><?php echo e(__('common.search')); ?> </button>
                            </form>
                            </div>
                            <div class="col-lg-12">
                                <button class="primary-btn semi_large2 fix-gr-bg cusrve_30px w_160" id="bulk_select"><i class="ti-check"></i><?php echo e(__('common.bulk_select')); ?> </button>
                                <form action="<?php echo e(route('media-manager.bulk_delete')); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg cusrve_30px w_160 d-none" id="bulk_delete"><i class="ti-trash"></i><?php echo e(__("common.bulk_delete")); ?></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="amazcart_file_wrapper">
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="amazcart_file_box">
                                        <div class="form-check d-none bulk_delete_checkbox float-right">
                                            <label class="primary_checkbox d-flex">
                                                <input type="checkbox" name="bulk_select[]" class="attr_checkbox" value="<?php echo e($file->id); ?>">
                                                <span class="checkmark mr_10"></span>
                                            </label>
                                        </div>
                                        <div class="amazcart_file_body">
                                            <div class="img-box position-relative">
                                                <div class="gallery_action position-absolute">
                                                    <a data-value="<?php echo e($file); ?>" class="details_info" data-toggle="tooltip" title="Info"><i class="ti-info-alt"></i></a>
                                                    <a data-id="<?php echo e($file->id); ?>" class="copy_id" data-toggle="tooltip" title="<?php echo e(__('product.Copy ID')); ?>"><i class="ti-pin"></i></a>
                                                    <a href="<?php echo e($file->storage=='local'?showImage($file->file_name):$file->file_name); ?>" download data-toggle="tooltip" title="Download"><i class="ti-download"></i></a>
                                                    <a href="<?php echo e($file->storage=='local'?showImage($file->file_name):$file->file_name); ?>" class="copy_link" data-toggle="tooltip" title="Copy Link"><i class="ti-layers"></i></a>
                                                    <?php if(permissionCheck('media-manager.delete_media_file')): ?>
                                                        <a data-url="<?php echo e(route('media-manager.delete_media_file', $file->id)); ?>" class="delete_file" data-toggle="tooltip" title="Delete"><i class="ti-trash"></i></a>
                                                    <?php endif; ?>
                                                </div>

                                                 <?php
                                                    if($file->storage == 'local'){
                                                        $image = showImage($file->file_name);
                                                    }elseif($file->storage == 'google'){
                                                        $qs = getQueryParams($file->file_name);
                                                        $image = 'https://lh3.google.com/u/0/d/'.$qs['id'];
                                                    }else{
                                                        $image = $file->file_name;
                                                    }
                                                ?>
                                                <img  src="<?php echo e($image); ?>" alt="">

                                            </div>
                                            <div class="amazcart_file_content-box">
                                                <div class="file-content-wrapper">
                                                    <h5><?php echo e($file->orginal_name); ?></h5>
                                                    <p><?php echo e($file->size); ?> <?php echo e(('common.kb')); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </form>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo e($files->onEachSide(1)->links('backEnd.media_manager.paginate')); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('backEnd.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('backEnd.media_manager.partials._info_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.delete_file', function(event){
                event.preventDefault();
                let url = $(this).data('url');
                confirm_modal(url);
            });
            $(document).on('click','#delete_link', function(){
                $('#pre-loader').removeClass('d-none');
                $('#confirm-delete').modal('hide');
            });
            $(document).on('click', '.details_info', function(event){
                event.preventDefault();
                let data = $(this).data('value');
                if(data){
                    $('#show_name').text(data.orginal_name);
                    $('#show_extension').text(data.extension);
                    $('#show_size').text(data.size + ' kb');
                    $('#show_storage').text(data.storage);
                    $('#single_image_div').removeClass('d-none');
                    var imag= data.file_name;
                    if(data.storage == 'local'){
                        $('#show_path').text('<?php echo e(url('')); ?>'+'/public/'+data.file_name);
                        var image_path = "<?php echo e(asset(asset_path(''))); ?>" + "/"+imag;
                        document.getElementById('view_image').src=image_path;
                    }else{
                        $('#show_path').text(data.file_name);
                        document.getElementById('view_image').src=imag;
                    }
                    $('#item_show').modal('show');
                }
            });

            $('.copy_link').click(function (e) {
                e.preventDefault();
                var copyText = $(this).attr('href');

                document.addEventListener('copy', function(e) {
                    e.clipboardData.setData('text/plain', copyText);
                        e.preventDefault();
                    }, true);

                    document.execCommand('copy');
                    toastr.info('Link copied to clipboard!');
            });

            $('#bulk_select').click(function(e){
                e.preventDefault();
                $('.bulk_delete_checkbox').removeClass('d-none');
            });

            $('input[type="checkbox"]').change(function ()
            {
                var arr = $.map($('input:checkbox:checked'), function(e,i) {
                    return +e.value;
                });
                if(arr.length>0){
                    $('#bulk_delete').removeClass('d-none');
                    $('#bulk_select').addClass('d-none');
                }
                if(arr.length==0){
                    $('#bulk_delete').addClass('d-none');
                    $('#bulk_select').removeClass('d-none');
                    $('.bulk_delete_checkbox').addClass('d-none');
                }
            });
            });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/backEnd/media_manager/index.blade.php ENDPATH**/ ?>