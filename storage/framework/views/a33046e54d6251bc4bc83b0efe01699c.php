<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo e(url('/')); ?></loc>
        <lastmod><?php echo e(gmdate('Y-m-d\TH:i:s+00:00')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <?php if(isset($products)): ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(singleProductURL($product->seller->slug, $product->slug)); ?></loc>
        <lastmod><?php echo e($product->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($pages)): ?>
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/'.$page->slug)); ?></loc>
        <lastmod><?php echo e(@$page->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($blogs)): ?>
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/'.$blog->slug)); ?></loc>
        <lastmod><?php echo e(@$blog->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($categories)): ?>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route('frontend.category-product',['slug' => @$category->slug, 'item' =>'category'])); ?></loc>
        <lastmod><?php echo e(@$category->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($brands)): ?>
    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route('frontend.category-product',['slug' => $brand->slug, 'item' =>'brand'])); ?></loc>
        <lastmod><?php echo e(@$brand->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($tags)): ?>
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route('frontend.category-product',['slug' => $tag->tag->name, 'item' =>'tag'])); ?></loc>
        <lastmod><?php echo e(@$tag->tag->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(isset($flash_deal)): ?>
    <url>
        <loc><?php echo e(url('/flash-deal'.'/'.$flash_deal->slug)); ?></loc>
        <lastmod><?php echo e(@$flash_deal->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endif; ?>
    <?php if(isset($new_user_zone)): ?>
    <url>
        <loc><?php echo e(url('new-user-zone/'.$new_user_zone->slug)); ?></loc>
        <lastmod><?php echo e(@$new_user_zone->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endif; ?>
</urlset>

<?php /**PATH /var/www/DhatriProduction/Modules/Utilities/Resources/views/xml_sitemap.blade.php ENDPATH**/ ?>