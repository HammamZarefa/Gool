<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-circle "></i>
              </span> <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title mb-5">
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Basic">
                                <a href="#0" data-toggle="modal" data-target="#addModal"
                                   class="btn btn-sm btn-outline-success  active ">
                                    <i class=" mdi mdi-account-circle "></i> Add New
                                </a>
                            </div>
                        </div>
                    </h4>

                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$mac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="SL"><?php echo e(++$k); ?></td>
                                <td data-label="Username"><strong><?php echo e($mac->username); ?></strong></td>
                                <td data-label="Email"><?php echo e($mac->email); ?></td>
                                <td data-label="Phone"><?php echo e($mac->mobile); ?></td>

                                <td>
                                    <span class="badge  badge-pill  badge-<?php echo e($mac->status ==0 ? 'danger' : 'success'); ?>"><?php echo e($mac->status == 0 ? 'Deactive' : 'Active'); ?></span>
                                </td>


                                <td>
                                    <button type="button"
                                            class="btn btn-gradient-danger btn-rounded btn-icon edit_button"
                                            data-toggle="modal" data-target="#myModal<?php echo e($mac->id); ?>"
                                            data-id="<?php echo e($mac->id); ?>">
                                        <i class="mdi mdi-lead-pencil "></i>
                                    </button>


                                </td>
                            </tr>



                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo e($mac->id); ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Manage Admin Role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="<?php echo e(route('updateStaff',$mac)); ?>">
                                            <?php echo e(method_field('put')); ?>

                                            <?php echo e(csrf_field()); ?>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <h6> Name :</h6>
                                                        <input class="form-control form-control-lg" name="name"
                                                               placeholder="Name" value="<?php echo e($mac->name); ?>" required>
                                                    </div>


                                                    <div class="form-group col-md-6">
                                                        <h6> Username :</h6>
                                                        <input class="form-control form-control-lg" name="username"
                                                               placeholder="Username" value="<?php echo e($mac->username); ?>"
                                                               required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6> E-Mail :</h6>
                                                        <input class="form-control form-control-lg" name="email"
                                                               placeholder="Email Address" value="<?php echo e($mac->email); ?>"
                                                               required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h6> Mobile :</h6>
                                                        <input class="form-control form-control-lg" name="mobile"
                                                               placeholder="Mobile Number" value="<?php echo e($mac->mobile); ?>"
                                                               required>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <h6> Password :</h6>
                                                        <input type="password" name="password" placeholder="Password"
                                                               class="form-control form-control-lg" value="">
                                                    </div>


                                                    <div class="form-group col-md-6">
                                                        <h6> Select Status :</h6>
                                                        <select name="status" id="event-status"
                                                                class="form-control form-control-lg" required>
                                                            <option value="1" <?php if($mac->status == 1): ?> selected <?php endif; ?>>
                                                                Active
                                                            </option>
                                                            <option value="0" <?php if($mac->status == 0): ?> selected <?php endif; ?>>
                                                                DeActive
                                                            </option>
                                                        </select>
                                                        <br>
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <div class="card">
                                                            <div class="card-header"><h5 class="card-title text-center">
                                                                    Accessibility</h5></div>
                                                            <div class="card-body">
                                                                <div class="row mt-2">
                                                                    <div class="col-md-6"><label>
                                                                            <input type="checkbox"
                                                                                   value="1"
                                                                                   name="access[]"
                                                                                   <?php if(in_array('1',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            Dashboard</label></div>


                                                                    <div class="col-md-6"><label><input type="checkbox"
                                                                                                        value="2"
                                                                                                        name="access[]"
                                                                                                        <?php if(in_array('2',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            Betting Manage</label></div>

                                                                    <div class="col-md-6"><label><input type="checkbox"
                                                                                                        value="3"
                                                                                                        name="access[]"
                                                                                                        <?php if(in_array('3',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            Manage Betting</label></div>
                                                                    <div class="col-md-6">
                                                                        <label>
                                                                            <input type="checkbox" value="4" name="access[]" <?php if(in_array('4',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            User Manage
                                                                        </label>
                                                                    </div>


                                                                    <div class="col-md-6"><label><input type="checkbox"
                                                                                                        value="5"
                                                                                                        name="access[]"
                                                                                                        <?php if(in_array('5',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            Invoices Manage</label></div>

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            


                                                                    <div class="col-md-6"><label><input type="checkbox"
                                                                                                        value="7"
                                                                                                        name="access[]"
                                                                                                        <?php if(in_array('7',json_decode($mac->access))): ?> checked <?php endif; ?>>
                                                                            Admin Manage</label></div>
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            

                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            


                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            
                                                                    
                                                                                                        
                                                                                                        
                                                                                                        
                                                                            


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-gradient-success ">Update</button>
                                                <button type="button" class="btn btn-gradient-danger "
                                                        data-dismiss="modal">
                                                    Close
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>




                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Manage Admin Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="<?php echo e(route('storeStaff')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <h6> Name :</h6>
                                <input class="form-control form-control-lg" name="name" placeholder=" Name"
                                       value="<?php echo e(old('name')); ?>" required>
                            </div>


                            <div class="form-group col-md-6">
                                <h6> Username :</h6>
                                <input class="form-control form-control-lg" name="username" placeholder="Username"
                                       value="<?php echo e(old('username')); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h6> E-Mail :</h6>
                                <input class="form-control form-control-lg" name="email" placeholder="Email Address"
                                       value="<?php echo e(old('email')); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <h6> Mobile :</h6>
                                <input class="form-control form-control-lg" name="mobile" placeholder="Mobile Number"
                                       value="<?php echo e(old('mobile')); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <h6> Password :</h6>
                                <input type="password" name="password" placeholder="Password"
                                       class="form-control form-control-lg" value="">
                            </div>


                            <div class="form-group col-md-6">
                                <h6> Select Status :</h6>
                                <select name="status" id="event-status" class="form-control form-control-lg" required>
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                                <br>
                            </div>


                            <div class="form-group col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="text-center card-title">Accessibility</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-2">

                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="1" name="access[]">
                                                    Dashboard</label>
                                            </div>


                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="2" name="access[]"> Prediction
                                                    Manage</label>
                                            </div>

                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="3" name="access[]"> Manage
                                                    Result</label>
                                            </div>

                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="4" name="access[]"> User
                                                    Manage</label>
                                            </div>


                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="5" name="access[]"> Invoices Manage</label>
                                            </div>

                                            
                                                
                                            


                                            <div class="col-md-6">
                                                <label><input type="checkbox" value="7" name="access[]"> Admin
                                                    Manage</label>
                                            </div>
                                            
                                                
                                                    
                                            

                                            
                                                
                                                    
                                            

                                            
                                                
                                                    
                                            

                                            
                                                
                                                    
                                            

                                            
                                                
                                                    
                                            

                                            
                                                
                                            
                                            
                                                
                                                    
                                            
                                            
                                                
                                                
                                            
                                            
                                                
                                                    
                                            
                                            
                                                
                                                    
                                            


                                            
                                                                                
                                                    

                                            
                                                
                                                    
                                            
                                            
                                                
                                                    
                                            
                                            
                                                
                                                    
                                            


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-gradient-success">Save</button>
                        <button type="button" class="btn btn-gradient-danger" data-dismiss="modal">
                            Close
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $(document).on("click", '.delete_button', function (e) {
                    var id = $(this).data('id');
                    $(".slider_id").val(id);
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>