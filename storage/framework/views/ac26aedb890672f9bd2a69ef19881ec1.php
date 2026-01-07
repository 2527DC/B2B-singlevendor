<?php $__env->startSection('mainContent'); ?>

<div class="container">
    <!-- Toolbar Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
        <div>
            <h3 class="mb-0">
                <i class="fas fa-user-friends me-2 text-primary"></i>
                Manage Drivers
            </h3>
            <small class="text-muted">Total Drivers: <?php echo e(count($drivers)); ?></small>
        </div>
        <div>
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createDriverModal">
                <i class="fas fa-plus-circle me-2"></i>
                Add New Driver
            </button>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Drivers Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th width="200" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td><?php echo e($driver->name); ?></td>
    <td><?php echo e($driver->phone); ?></td>

    <td>
        <?php
            $isActive = isset($driver->is_active) && (int)$driver->is_active === 1;
        ?>

        <span class="badge bg-<?php echo e($isActive ? 'success' : 'danger'); ?>">
            <?php echo e($isActive ? 'Active' : 'Inactive'); ?>

        </span>
    </td>

    <td class="text-center">
        <div class="btn-group" role="group">
            <button type="button"
                class="btn btn-sm btn-outline-warning"
                title="Edit"
                data-bs-toggle="modal"
                data-bs-target="#editDriverModal"
                data-driver-id="<?php echo e($driver->id); ?>"
                data-driver-name="<?php echo e($driver->name); ?>"
                data-driver-phone="<?php echo e($driver->phone); ?>"
                data-driver-is-active="<?php echo e(isset($driver->is_active) ? (int)$driver->is_active : 1); ?>">
                <i class="fas fa-edit"></i>
            </button>

            <button type="button"
                class="btn btn-sm btn-outline-info"
                title="Reset Password"
                data-bs-toggle="modal"
                data-bs-target="#resetPasswordModal"
                data-driver-id="<?php echo e($driver->id); ?>"
                data-driver-name="<?php echo e($driver->name); ?>">
                <i class="fas fa-key"></i>
            </button>

            <form action="<?php echo e(route('drivers.delete', $driver->id)); ?>"
                  method="POST"
                  style="display:inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button onclick="return confirm('Are you sure you want to delete this driver?')"
                        class="btn btn-sm btn-outline-danger"
                        title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Driver Modal -->
<div class="modal fade" id="createDriverModal" tabindex="-1" aria-labelledby="createDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('drivers.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="createDriverModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add New Driver
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active Driver</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Driver Modal -->
<div class="modal fade" id="editDriverModal" tabindex="-1" aria-labelledby="editDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editDriverForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editDriverModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Driver
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_driver_id" name="driver_id">
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">Phone *</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                            <label class="form-check-label" for="edit_is_active">Active Driver</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="resetPasswordForm" method="POST">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i> Reset Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="reset_driver_id" name="driver_id">

                    <p>Reset password for driver: <strong id="driverName"></strong></p>

                    <div class="mb-3">
                        <label class="form-label">New Password *</label>
                        <input type="password"
                               class="form-control"
                               id="new_password"
                               name="new_password"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password"
                               class="form-control"
                               id="confirm_password"
                               name="new_password_confirmation"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit Driver Modal
    const editDriverModal = document.getElementById('editDriverModal');
    if (editDriverModal) {
        editDriverModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const driverId = button.getAttribute('data-driver-id');
            const driverName = button.getAttribute('data-driver-name');
            const driverPhone = button.getAttribute('data-driver-phone');
            const isActive = button.getAttribute('data-driver-is-active');
            
            // Update modal content
            const modalTitle = editDriverModal.querySelector('.modal-title');
            const driverIdInput = editDriverModal.querySelector('#edit_driver_id');
            const nameInput = editDriverModal.querySelector('#edit_name');
            const phoneInput = editDriverModal.querySelector('#edit_phone');
            const isActiveInput = editDriverModal.querySelector('#edit_is_active');
            
            modalTitle.textContent = `Edit Driver: ${driverName}`;
            driverIdInput.value = driverId;
            nameInput.value = driverName;
            phoneInput.value = driverPhone;
            isActiveInput.checked = isActive === '1';
            
            // Update form action using Laravel route
            const form = editDriverModal.querySelector('#editDriverForm');
            form.action = "<?php echo e(url('drivers')); ?>" + "/" + driverId;
        });
    }
    
    // Reset Password Modal
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    if (resetPasswordModal) {
        resetPasswordModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const driverId = button.getAttribute('data-driver-id');
            const driverName = button.getAttribute('data-driver-name');
            
            // Update modal content
            const driverNameSpan = resetPasswordModal.querySelector('#driverName');
            const driverIdInput = resetPasswordModal.querySelector('#reset_driver_id');
            
            driverNameSpan.textContent = driverName;
            driverIdInput.value = driverId;
            
            // Update form action using Laravel route
            const form = resetPasswordModal.querySelector('#resetPasswordForm');
            form.action = "<?php echo e(url('drivers')); ?>" + "/" + driverId + "/reset-password";
        });
        
        // Password validation
        const resetPasswordForm = resetPasswordModal.querySelector('#resetPasswordForm');
        if (resetPasswordForm) {
            resetPasswordForm.addEventListener('submit', function(e) {
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('confirm_password').value;
                
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    return false;
                }
                
                if (newPassword.length < 6) {
                    e.preventDefault();
                    alert('Password must be at least 6 characters long!');
                    return false;
                }
                
                return true;
            });
        }
    }
    
    // Password validation for create form
    const createForm = document.querySelector('#createDriverModal form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
            }
            
            return true;
        });
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mytestdhatri/Modules/Driver/Resources/views/index.blade.php ENDPATH**/ ?>