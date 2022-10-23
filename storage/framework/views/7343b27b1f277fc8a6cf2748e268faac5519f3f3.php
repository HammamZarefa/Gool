<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>

    
    
    
    



    
        
            
                
                    
                        
                            
                            
                                
                                
                                
                                
                            
                            
                            
                            
                                
                                    
                                    
                                    
                                    
                                        
                                            
                                        
                                            
                                        
                                            
                                        
                                            
                                        
                                    
                                    
                                
                            
                                
                                    
                                
                            

                            
                        

                    

                    
                        
                    

                
            
        
    
    
        
        

            
                
                
            

            

            
                

            
                
                
                    
                    
                    
                        
                        
                    
                
                
                    
                        
                    
                    
                        
                        
                    
                
            

            
        

        
            
            
            
                

                
                    
                    
                

                
                    
                    
                    
                    
                    
                    

                    
                        
                        
                        
                        
                        
                            
                        
                        
                            
                            
                            
                            
                                
                                
                                
                             
                                
                                    
                                        
                                        
                                    
                                    
                                        
                                    
                                    
                                        
                                        
                                    
                                
                            
                        
                            

                            
                                
                                
                                
                                
                                
                                

                            
                            
                                
                                    
                                        
                                            
                                                
                                                
                                            
                                            
                                                
                                                
                                            
                                            
                                                
                                                
                                            
                                        
                                    

                                    

                                    
                                        
                                            
                                                
                                                
                                            
                                            
                                                
                                                
                                            
                                            
                                                
                                            
                                        
                                    
                                
                    
                            
                            
                        
                        
                            
                            
                        
                    
                            
                            
                                
                                
                            

                        
                        
                    

                    
                        
                        

                    

                    
                        
                        
                        
                    
                
            

            
            
            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            

            
            
            
            
        
    
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-multiple-outline"></i>
              </span>  Users </h3>
    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="input-group-append">
                        <a class="kmenu"  href="<?php echo e(route('user.users.create')); ?>" style="background:#1dcfb4 "> Create New</a>
                    </div>
                    <h4 class="card-title mb-5">
                        <div class="row justify-content-end">
                            <div class="col-4">
                                <form action="<?php echo e(route('search.users')); ?>" method="get">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" value="<?php echo e(@$search); ?>" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-gradient-success" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </h4>



                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="Name"><?php echo e($user->name); ?></td>
                                <td data-label="Username"> <strong><?php echo e($user->username); ?> </strong></td>
                                <td data-label="Mobile"><?php echo e($user->phone); ?></td>
                                <td data-label="Balance"><?php echo e($user->balance); ?> <?php echo e($basic->currency); ?></td>
                                <td data-label="Status">
                                    <?php if($user->status == 1): ?>
                                        <label class="badge badge-gradient-success">Active</label>
                                    <?php else: ?>
                                        <label class="badge badge-gradient-danger">Blocked</label>
                                    <?php endif; ?>
                                </td>
                                <td  data-label="Details">
                                    <a href="<?php echo e(route('user.users.edit', $user->id)); ?>"
                                       data-tooltip-content="User Details"
                                       class="btn btn-gradient-success btn-sm btn-rounded btn-icon pt-12 tooltip-styled">

                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>
                    </table>





                </div>
                
                    
                
            </div>
        </div>


    </div>




<?php $__env->stopSection(); ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/users/index.blade.php ENDPATH**/ ?>