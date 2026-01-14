<thead>
    <tr>
        <th scope="col"><?php echo e(__('common.full_name')); ?></th>
        <th scope="col"><?php echo e(__('common.address')); ?></th>
        <th scope="col"><?php echo e(__('common.region')); ?></th>
        <th scope="col"><?php echo e(__('common.email')); ?></th>
        <th scope="col"><?php echo e(__('common.phone_number')); ?></th>
        <th scope="col" class="text-right"><?php echo e(__('common.action')); ?></th>
    </tr>

</thead>
<tbody>
    <?php $__currentLoopData = $addressList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($address->name); ?></td>
            <td><?php echo e($address->address); ?></td>
            <td><?php echo e(@$address->getCity->name.', '.@$address->getState->name.', '.@$address->getCountry->name); ?></td>
            <td><?php echo e($address->email); ?></td>
            <td><?php echo e(getNumberTranslate($address->phone)); ?></td>
            <td class="text-right">
                <a class="primary-btn radius_30px mr-10 fix-gr-bg edit_address" data-id="<?php echo e($address->id); ?>"><?php echo e(__('common.edit')); ?></a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
<?php /**PATH /var/www/html/mytestdhatri/resources/views/backEnd/pages/customer_data/_table.blade.php ENDPATH**/ ?>