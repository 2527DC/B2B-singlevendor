
<?php $__env->startSection('styles'); ?>
    <style>
        .aoraeditor-header .header_area {
            padding: 0 !important;
            position: relative !important;
            top: 0;
        }

        .aoraeditor-header {
            width: calc(100% - var(--editor-width));
            margin-left: var(--editor-width);
        }

        .aoraeditor-footer {
            width: calc(100% - var(--editor-width));
            margin-left: var(--editor-width);
        }

    </style>
<?php $__env->stopSection(); ?>
<?php
    $active =   isset($_GET['lang']) && !empty($_GET['lang']) ? $_GET['lang']:'en';
    $langCode = isset($_GET['lang']) && !empty($_GET['lang']) ? $_GET['lang']:'en';
?>
<?php $__env->startSection('content'); ?>
    <?php echo $row->getTranslation('description',$active); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>



    <script type="text/javascript" data-aoraeditor="script">
        $(function () {
            $('#content-area').aoraeditor({
                snippetsUrl: '<?php echo e(route('page_builder.snippet')); ?>',
                title: '<?php echo e(__('common.Design')); ?> <?php echo e($row->title); ?> <?php echo e(__('frontendmanage.Page')); ?>',
                onSave: function (content) {
                    let jHtmlObject = jQuery(content);
                    let editor = jQuery("<p>").append(jHtmlObject);
                    editor.find(".aoraeditor-skip").remove();
                    let newHtml = editor.html();


                    var url = '<?php echo e(route("page_builder.pages.design.update",":id")); ?>';
                    url = url.replace(':id', <?php echo e($row->id); ?>);


                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: {
                            'body': newHtml,
                            'lang': '<?php echo e($active); ?>',
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function (data) {
                            location.reload();
                            toastr.success("<?php echo e(__('frontendmanage.Page Designed Save Successfully')); ?>")
                        }
                    });
                },
            });

            $('.aoraeditor-topbar-right').prepend(
                '<a href="#" title="Responsive View" class="aoraeditor-ui aoraeditor-topbar-btn toggleResponsiveBar"><i class="fas fa-laptop"></i></a>'
            );
            $('.aoraeditor-topbar-right').prepend(
                '<a target="_blank" href="<?php echo e($row->is_static!=1?url('pages/'.$row->slug):url($row->slug)); ?>" title="Frontend View" class="aoraeditor-ui aoraeditor-topbar-btn"><i class="fas fa-external-link-alt"></i></a>'
            );

            <?php if(isModuleActive('FrontendMultiLang')): ?>
            <?php
                $LanguageList = getLanguageList();
            ?>
            $('.aoraeditor-topbar-right').prepend(
                '<select name="lang" id="languageChanger">' +
                <?php $__currentLoopData = $LanguageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<option value="<?php echo e(url()->current().'?lang='.$language->code); ?>" <?php echo e($active==$language->code?'selected':''); ?>><?php echo e($language->native); ?></option>' +
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    '</select>'
            );

            $(document).on('change', '#languageChanger', function (e) {
                e.preventDefault();
                window.location.href = $(this).val();

            });
            <?php endif; ?>




            $('.aoraeditor-topbar').prependTo(".aoraeditor-header");
            $('.aoraeditor-topbar').appendTo(".aoraeditor-footer");

            // $(".aoraeditor-topbar-right").clone().appendTo(".aoraeditor-modal-footer");
            $(".aoraeditor-topbar-right").appendTo(".aoraeditor-modal-footer");


            $(document).on("click", ".toggleResponsiveBar", function () {
                $('.aoraeditor-topbar').toggleClass('hide-desktop')
            });


            function checkWindowSize() {
                if (window.matchMedia('(min-width: 992px)').matches) {
                    $('.aoraeditor-modal').addClass('show_modal');
                } else {
                    $('.aoraeditor-modal').removeClass('show_modal');

                }
                $(document).on("click", "[data-snippet]", function () {
                    $('.aoraeditor-modal').hide();
                });
            }

            checkWindowSize();
            $(window).on('resize', function () {
                checkWindowSize();
            });

        });



    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('aorapagebuilder::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/AoraPageBuilder/Resources/views/pages/design.blade.php ENDPATH**/ ?>