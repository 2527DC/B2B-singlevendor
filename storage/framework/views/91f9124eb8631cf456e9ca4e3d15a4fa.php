<div class="amaz_cta_box <?php echo e($ads->status == 0?'d-none':''); ?>">
    <div class="row justify-content-center ">
        <a href="<?php echo e(@$ads->description); ?>" class="col-xl-12 random_ads_div">
            <img class="img-fluid w-100" src="<?php echo e(showImage(@$ads->image)); ?>" alt="<?php echo e(@$ads->title); ?>" title="<?php echo e(@$ads->title); ?>">
        </a>
    </div>
</div>
<?php /**PATH /var/www/DhatriProduction/resources/views/frontend/amazy/components/random-ads-component.blade.php ENDPATH**/ ?>