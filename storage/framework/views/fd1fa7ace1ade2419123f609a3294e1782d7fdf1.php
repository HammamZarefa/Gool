
<div class="col-md-3 ">
    <div class="card">
        <div class="card-body pt-3 pb-1">

            <div class="text-center">
                <?php if( $user->image == null): ?>
                    <img src=" <?php echo e(url('public/images/user/user-default.jpg')); ?> "
                         class="user-profile" alt="Profile Pic">
                <?php else: ?>
                    <img src=" <?php echo e(url('public/images/user/'.$user->image)); ?> " class="user-profile"
                         alt="Profile Pic">
                <?php endif; ?>
            </div>
            <div class="list-wrapper text-center mt-2">

                <p>User Name : <span class="text-right"><?php echo e($user->username); ?></span></p>
                <p>Email : <span class="text-right"><?php echo e($user->email); ?></span></p>
                <p>Mobile : <span class="text-right"><?php echo e($user->phone); ?></span></p>
                <p>BALANCE : <span
                            class="text-right"><?php echo e(number_format(floatval($user->balance), $basic->decimal, '.', '')); ?> <?php echo e($basic->currency); ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body ">

            <div class="user-menu list-group">



                <a href="<?php echo e(route('user.single',[$user->id])); ?>" class="<?php if(Request::routeIs('user.single')): ?> active <?php endif; ?> list-group-item list-group-item-action">Profile Setting <i class="mdi mdi-face-profile float-right"></i></a>
                <a href="<?php echo e(route('user.password',[$user->id])); ?>" class="<?php if(Request::routeIs('user.password')): ?> active <?php endif; ?> list-group-item list-group-item-action">Password Setting <i class="mdi mdi-key float-right"></i></a>
                <a href="<?php echo e(route('user.balance',[$user->id])); ?>" class="<?php if(Request::routeIs('user.balance')): ?> active <?php endif; ?> list-group-item list-group-item-action ">Manage Balance <i class="mdi mdi-wallet float-right"></i></a>
                
                
                <a href="<?php echo e(route('user.predictions',[$user->id])); ?>" class="<?php if(Request::routeIs('user.predictions')): ?> active <?php endif; ?>  list-group-item list-group-item-action">Prediction Log <i class="mdi mdi-stack-exchange float-right"></i></a>
                

                


                
                
                
                <a href="<?php echo e(route('user.loginLogs',[$user->id])); ?>" class="<?php if(Request::routeIs('user.loginLogs')): ?> active <?php endif; ?> list-group-item list-group-item-action">Login History <i class="mdi mdi-information float-right"></i></a>

            </div>
        </div>
    </div>
</div><?php /**PATH D:\projects\Gool\resources\views/admin/users/user-sidebar.blade.php ENDPATH**/ ?>