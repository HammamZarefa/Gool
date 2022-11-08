<?php
    $access = json_decode(Auth::guard('admin')->user()->access);
?>


<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="<?php echo e(route('admin.profile')); ?>" class="nav-link">
                <div class="nav-profile-image">

                    <?php if(Auth::guard('admin')->user()->image == null): ?>
                        <img src="<?php echo e(asset('images/user/user-default.jpg')); ?>" alt="profile">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/user/')); ?>/<?php echo e(Auth::guard('admin')->user()->image); ?>"
                             alt="profile">
                    <?php endif; ?>

                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo e(Auth::guard('admin')->user()->username); ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <?php if(in_array('1',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        <?php if(in_array('3',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('awaiting.winner')); ?>">
                    <span class="menu-title">Betting</span>
                    <i class="mdi mdi-table-large menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if(in_array('3',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('invoices')); ?>">
                    <span class="menu-title">Invoices</span>
                    <i class="mdi mdi-table-large menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if(in_array('4',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('users')); ?>">
                    <span class="menu-title">User List</span>
                    <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>




        
        
        
        
        
        
        
        
        
        

        
        
        

        
        


        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        






        <?php if(in_array('7',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('staff')); ?>">
                    <span class="menu-title">Staff Manage</span>
                    <i class="mdi mdi-account-convert menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if(in_array('8',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.changePrefix')); ?>">
                    <span class="menu-title">Admin Prefix</span>
                    <i class="mdi mdi-format-text menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if(in_array('16',$access)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('mail-setting')); ?>">
                    <span class="menu-title">Mail / SMS Setting</span>
                    <i class="mdi mdi-email menu-icon"></i>
                </a>
            </li>
        <?php endif; ?>


        
        
        
        
        
        
        

        
        
        
        
        
        
        

        
        
        
        
        
        
        


        
        
        
        
        
        
        
        


        
        
        
        
        
        
        
        


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        

        
        
        
        
        
        



        


        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
    </ul>
</nav>
<?php /**PATH D:\projects\Gool\resources\views/admin/layout/sidebar.blade.php ENDPATH**/ ?>