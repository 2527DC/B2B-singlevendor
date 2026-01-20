<?php $__env->startSection('title'); ?>
    <?php echo e(__('common.category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
    .category-card {
        width: 100%;
        border: 1px solid #f1f1f1;
        padding: 9px;
        border-radius: 4px;
        margin-bottom: 20px;
    }


    .parent-category {
        display: flex;
        justify-content: start;
        margin-bottom: 3px;
    }
    .category-image {
        height: 40px;
        width: 40px;
        border: 1px solid #f1f1f1;
        margin-right: 6px;
    }
    .parent-name {
        margin-top: 9px;
        color: #5d5d5d;
        font-weight: 600;
    }

    .child-categories {
        padding: 0px 6px;
    }
    .child-category {
        color: #707070;
        font-size: 14px;
        font-weight: 600;
    }
    .third-level {
        padding: 0px 0px 5px 8px;
        width: 100%;
    }
    .third-level li a{
        color: #383636;
        font-size: 13px;
    }
    .load-more {
        color: #ff2732 !important;
    }

    .load-more i {
        position: absolute;
        margin-top: 7px;
        margin-left: 7px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- brand_banner::start  -->
<div class="brand_banner d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="branding_text"><?php echo e(__('common.category')); ?></h3>
            </div>
        </div>
    </div>
</div>
<!-- brand_banner::end  -->
<!-- prodcuts_area ::start  -->
<div class="prodcuts_area ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-card">
                        <?php if(count($category->subCategories) > 0): ?>
                            <div class="parent-category">
                                <a href="javascript:void(0)">
                                    <div class="parent-category">

                                        <div class="parent-img">
                                            <img src="<?php echo e(showImage($category->categoryImage->image)); ?>" class="category-image">
                                        </div>
                                        <div class="parent-name">
                                            <?php echo e($category->name); ?>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="parent-category">
                                <a href="<?php echo e(route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])); ?>">
                                    <div class="parent-category">

                                        <div class="parent-img">
                                            <img src="<?php echo e(showImage($category->categoryImage->image)); ?>" class="category-image">
                                        </div>
                                        <div class="parent-name">
                                            <?php echo e($category->name); ?>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>


                        <?php if(!empty($category->subCategories)): ?>
                           <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="child-categories">
                                    <?php if(!empty($subCategory->subCategories) && count($subCategory->subCategories) > 0): ?>
                                        <a class="child-category" href="javascript:void(0)">
                                            <?php echo e($subCategory->name); ?>

                                        </a>
                                        <ul class="third-level">
                                            <?php $__currentLoopData = $subCategory->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $thirdCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="<?php echo e($key > 4 ? 'd-none '.Str::slug($subCategory->name):''); ?>">
                                                    <a  href="<?php echo e(route('frontend.category-product',['slug' => $thirdCategory->slug, 'item' =>'category'])); ?>"><?php echo e($thirdCategory->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(count($subCategory->subCategories) > 5): ?>
                                                <li>
                                                    <a class="load-more" data-class=".<?php echo e(Str::slug($subCategory->name)); ?>" href="javascript:void(0)">more <i class='fas fa-angle-down'></i></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php else: ?>
                                    <a class="child-category" href="<?php echo e(route('frontend.category-product',['slug' => $subCategory->slug, 'item' =>'category'])); ?>">
                                        <?php echo e($subCategory->name); ?>

                                    </a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <?php if($categories->lastPage() > 1): ?>
                    <?php if (isset($component)) { $__componentOriginal44b74027c2291d639abf8a70f559de1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44b74027c2291d639abf8a70f559de1b = $attributes; } ?>
<?php $component = App\View\Components\PaginationComponent::resolve(['items' => $categories,'type' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PaginationComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $attributes = $__attributesOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__attributesOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44b74027c2291d639abf8a70f559de1b)): ?>
<?php $component = $__componentOriginal44b74027c2291d639abf8a70f559de1b; ?>
<?php unset($__componentOriginal44b74027c2291d639abf8a70f559de1b); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="add-product-to-cart-using-modal">
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){
        $(document).on('click','.load-more',function(){
            let class_name = $(this).attr('data-class');
            $(class_name).toggleClass('d-none');
            if($(this).html() == 'more <i class="fas fa-angle-down"></i>'){
                $(this).html('less <i class="fas fa-angle-up"></i>');
            }else{
                $(this).html('more <i class="fas fa-angle-down"></i>');
            }

        });

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(theme('partials.add_to_cart_script'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(theme('partials.add_to_compare_script'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('frontend.amazy.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/category.blade.php ENDPATH**/ ?>