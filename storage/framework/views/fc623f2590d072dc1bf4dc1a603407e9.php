<div class="col-md-12 mb-20">
    <div class="box_header_right">
        <div class=" float-none pos_tab_btn justify-content-start">
            <?php
               $carriers =  $carriers->where('name','!=','Manual')->where('status',1);
            ?>
            <ul class="nav nav_list" role="tablist">
                <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li class="nav-item mb-2">
                        <a class="nav-link <?php if($key == 0): ?>  active show  <?php endif; ?>" href="#<?php echo e($cary->slug); ?>" role="tab"
                        data-toggle="tab" id="1" aria-selected="true"> <?php echo e($cary->name); ?> </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="white_box_30px mb_30">
        <div class="tab-content">
            <?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if($cary->name == "Shiprocket"): ?>
                    <?php if(isModuleActive('ShipRocket') && $cary->status == 1): ?>
                        <div role="tabpanel" class="tab-pane fade <?php echo e($key == 0 ? 'active show':''); ?>" id="<?php echo e($cary->slug); ?>">
                            <div class="box_header common_table_header ">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('shipping.shiprocket')); ?></h3>
                                </div>
                            </div>
                            <?php echo $__env->make('shiprocket::config',['shipRocket'=>$cary], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <?php if($cary->name == "Torod"): ?>
                    <div role="tabpanel" class="tab-pane fade <?php echo e($key == 0 ? 'active show':''); ?>" id="<?php echo e($cary->slug); ?>">
                        <div class="box_header common_table_header ">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"><?php echo e(__('torod.torod')); ?></h3>
                            </div>
                        </div>
                        <?php echo $__env->make('torod::config',['torod' => $cary], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/Modules/Shipping/Resources/views/carriers/components/_config.blade.php ENDPATH**/ ?>