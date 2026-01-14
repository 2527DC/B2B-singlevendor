<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(__('defaultTheme.contact_form')); ?></title>
</head>
<body>
    <h2><?php echo e(__('defaultTheme.contact_message')); ?></h2>
    <p>
        <?php echo e(__('common.name')); ?>:
        <?php echo e($details['name']); ?></p>
    <p>
        <?php echo e(__('common.email')); ?>:
        <?php echo e($details['email']); ?></p>
    <p>
        <?php echo e(__('common.message')); ?>:
        <?php echo e($details['message']); ?></p>

</body>
</html>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/frontend/amazy/emails/contact_mail_template.blade.php ENDPATH**/ ?>