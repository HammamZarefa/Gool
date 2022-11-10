<div class="btn-group" role="group" aria-label="Basic example">
    <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-sm btn-outline-success <?php if(Request::routeIs('admin.profile')): ?> active <?php endif; ?>">
       <i class=" mdi mdi-account-circle "></i> Profile
    </a>
    <a href="<?php echo e(route('admin.password')); ?>" class="btn btn-sm btn-outline-success <?php if(Request::routeIs('admin.password')): ?> active <?php endif; ?>">
       <i class=" mdi mdi-account-key "></i> Password 
    </a>
</div><?php /**PATH G:\gool10bet\resources\views/admin/settings/nav.blade.php ENDPATH**/ ?>