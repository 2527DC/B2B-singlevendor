<div class="col-xl-3 col-lg-3">
    <div class="blog_sidebar_wrap mb_30">
        <form action="<?php echo e(url('/blog')); ?>" name="sidebar_search">
            <div class="input-group  theme_search_field4 w-100 mb_20 style2">
                <div class="input-group-prepend">
                    <button class="btn" type="button"> <i class="ti-search"></i> </button>
                </div>
                <input type="text" class="form-control search_input" id="inlineFormInputGroup" placeholder="<?php echo e(__('blog.search_post')); ?>" value="<?php echo e(request()->get('query')); ?>" name="query" required>
            </div>
        </form>
        <div class="blog_sidebar_box mb_20">
            <h4 class="font_18 f_w_700 mb_10">
                <?php echo e(__('common.category')); ?>

            </h4>
            <div class="home6_border w-100 mb_20"></div>
            <ul class="Check_sidebar mb-0">
                <?php $__currentLoopData = $categoryPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <label class="primary_checkbox d-flex">
                            <a href="<?php echo e(route('blog.category.posts',$post->slug)); ?>" class="label_name f_w_400"><?php echo e($post->name); ?> <span>(<?php echo e($post->active_post_count); ?>)</span></a>

                        </label>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="blog_sidebar_box mb_15">
            <h4 class="font_18 f_w_700 mb_10">
                <?php echo e(__('blog.popular_posts')); ?>

            </h4>
            <div class="home6_border w-100 mb_20"></div>
            <div class="news_lists">
                <?php $__currentLoopData = $popularPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single_newslist">
                        <a href="<?php echo e(route('blog.single.page',$post->slug)); ?>">
                            <h4><?php echo e(textLimit($post->title,50)); ?></h4>
                        </a>
                        <p><?php echo e(dateConvert($post->published_at)); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="blog_sidebar_box mb_30 p-0 border-0">
            <h4 class="font_18 f_w_700 mb_10">
                <?php echo e(__('blog.Keywords')); ?>

            </h4>
            <div class="home6_border w-100 mb_20"></div>
            <div class="keyword_lists d-flex align-items-center flex-wrap gap_10">
                <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url('/blog').'?tag='.$tag->name); ?>"><?php echo e($tag->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/pages/blog/partials/_sidebar.blade.php ENDPATH**/ ?>