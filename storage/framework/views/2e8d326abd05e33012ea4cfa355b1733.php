
<?php if($rating == 0): ?>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating < 1 && $rating > 0): ?>
    <i class="fas fa-star-half-alt"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating <= 1 && $rating > 0): ?>
    <i class="fas fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating < 2 && $rating > 1): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating <= 2 && $rating > 1): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating < 3 && $rating > 2): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating <= 3 && $rating > 2): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star "></i>
    <i class="far fa-star"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating < 4 && $rating > 3): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star-half-alt"></i>
    <i class="far fa-star"></i>
    <?php elseif($rating <= 4 && $rating > 3): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star "></i>
    <i class="far fa-star "></i>
    <?php elseif($rating < 5 && $rating > 4): ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star-half-alt"></i>
    <?php else: ?>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star "></i>
    <i class="fas fa-star "></i>
<?php endif; ?>
<?php /**PATH /var/www/html/Production_Test/resources/views/frontend/amazy/components/rating.blade.php ENDPATH**/ ?>