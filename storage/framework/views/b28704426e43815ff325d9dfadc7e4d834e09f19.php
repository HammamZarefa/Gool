<?php $__env->startSection('content'); ?>


    <form class="pt-3"  action="<?php echo e(route('admin.login')); ?>" method="post">
        <?php echo csrf_field(); ?>
      <div class="form-group">
        <input type="text" name="username" value="<?php echo e(old('username')); ?>"  class="form-control form-control-lg"  placeholder="Username">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
      </div>
    </form>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>