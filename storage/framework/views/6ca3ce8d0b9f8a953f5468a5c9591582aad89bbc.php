<div class="col-md-3 padding-top: 50px ">
    <div class="card mt-2">
        <div class="card-body ">
            <div class="user-menu list-group">
                <a href="<?php echo e(route('profile-setting')); ?>" class="<?php if(Request::routeIs('profile-setting')): ?> active <?php endif; ?> list-group-item list-group-item-action">Account Information <i class="mdi mdi-face-profile float-right"></i></a>
                <a href="<?php echo e(route('password-setting')); ?>" class="<?php if(Request::routeIs('password-setting')): ?> active <?php endif; ?> list-group-item list-group-item-action">Change Password<i class="mdi mdi-key float-right"></i></a>
                <a href="<?php echo e(route('home')); ?>" class="<?php if(Request::routeIs('home')): ?> active <?php endif; ?> list-group-item list-group-item-action ">Sports Bets<i class="mdi mdi-wallet float-right"></i></a>
                <a href="<?php echo e(route('transaction')); ?>" class="<?php if(Request::routeIs('transaction')): ?> active <?php endif; ?> list-group-item list-group-item-action ">Account Movements <i class="mdi mdi-mail float-right"></i></a>
                
                
                
                <?php if(auth()->user()->is_admin==1): ?>
                   <a href="<?php echo e(route('user.users')); ?>" class="<?php if(Request::routeIs('user.users')): ?> active <?php endif; ?> list-group-item list-group-item-action ">Users <i class="mdi mdi-stack-exchange float-right"></i></a>
                <?php endif; ?>
                
                
                
                

            </div>
        </div>
    </div>
</div><?php /**PATH E:\Gool\resources\views/user/user-sidebar.blade.php ENDPATH**/ ?>