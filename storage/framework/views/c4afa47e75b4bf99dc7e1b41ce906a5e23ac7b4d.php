<?php $__env->startSection('content'); ?>

          <div class="page-header">
              <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-key "></i>
              </span> <?php echo e($page_title); ?> </h3>

              

          </div>

            <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                  <h4 class="card-title mb-5"> 
                  <div class="float-right">
                    <?php echo $__env->make('admin.settings.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  </h4>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                              <form class="forms-sample" action="" method="post">
                              <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                  <label for="prefix" class="col-sm-3 col-form-label">Admin Prefix</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="prefix" value="<?php echo e($basic->prefix); ?>" class="form-control" id="prefix" placeholder="Admin Prefix">

                                    <?php if($errors->has('prefix')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('prefix')); ?></p>
                                    <?php endif; ?>
                                  </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                      <button type="submit" class="btn btn-gradient-success btn-block">Update</button>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                  </div>
                </div>
              </div>

              
              
            </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/settings/prefix.blade.php ENDPATH**/ ?>