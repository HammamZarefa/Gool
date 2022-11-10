<div class="col-lg-2 col-sm-12 p-0 shadow bg-black rounded-3 left-panel pb-3 sports-bets">
    <div class="d-flex flex-wrap" style='display: flex;'>
        <div class="col-lg-12 col-sm-12 p-0 shadow bg-black rounded-3 left-panel pb-3 sports-bets" data-toggle="collapse" aria-expanded="true" data-target=".league-list">
            <div class=" text-center pb-1 pt-3 bg-light header" style='background: linear-gradient(to bottom,#995656 15%,#680202 58%); height: 50px;'>
                <h2 style='margin: 0;padding-bottom: 15px;color: white; font-size: 14px' ><?php echo app('translator')->get('Favori Ligler'); ?></h2>
            </div>
            <div class="league-list"  style='background: #060606'>
                    <?php $__currentLoopData = $leagues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $league): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="container-sm-fluid clickable subcategory mb-2"  >
                            <div class="p-1 side-sprt d-flex justify-content-start align-items-center country">
                                <div class="ps-1">
                                    <img src="<?php echo e($league->league_logo); ?>" height="24px" width="30px">
                                </div>
                                <div class="text-center text-white ptg" style="font-size: 12px; margin-left: 3px;">
                                    <a><?php echo e($league->league_name); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
        </div>
    </div>
    <div class=" text-center pb-1 pt-3 bg-light header" style='background: linear-gradient(to bottom,#995656 15%,#680202 58%);'>
        <h2 style='margin: 0;padding-bottom: 15px;color: white; font-size: 14px'><?php echo app('translator')->get('Sports Bets'); ?></h2>
    </div>
    <div class="" id="sports-menu" style='background: #060606'>
        <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="collapsed" id="<?php echo e($sport); ?>" data-toggle="collapse" data-target="#sub-category-<?php echo e(str_replace(' ', '', $sport)); ?>" aria-expanded="false" aria-controls="<?php echo e(str_replace(' ', '', $sport)); ?>">
                <div  style='background: linear-gradient(to bottom, #205ca2 0%,#0f2d50 100%)!important;height: 45px;' class=" pl-2 pr-2 align-items-center d-flex justify-content-between border-bottom clickable main-category sublist-header sport">
                    <img src="<?php echo e(asset('images/icons/'.$loop->index.'.gif')); ?>" width="25px" height="25px"/>
                    <h5 class="text-white"><?php echo e($sport); ?></h5>
                    <span class="fw-bold text-white" id="teams-count-<?php echo e($sport); ?>"></span>
                </div>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($country->sport == $sport): ?>
                        <div class="container-sm-fluid clickable subcategory mb-2 collapse" id="sub-category-<?php echo e(str_replace(' ', '', $country->sport)); ?>" data-parent="#sports-menu" aria-labelledby="<?php echo e(str_replace(' ', '', $sport)); ?>">
                            <div class="p-1 side-sprt d-flex justify-content-start align-items-center country" data-name="<?php echo e($country->icon); ?>" data-league="1" data-time="4" data-write="F"
                                 onclick="getMatchesByCountry( '<?php echo e($country->icon); ?>','F',4,'1')">
                                <div class="ps-1">
                                    <img src="https://cdn.o-betgaming.com/lflags/<?php echo e($country->icon); ?>" height="20px" width="20px">
                                </div>
                                <div class="text-center text-white ptg" style="font-size: 12px; margin-left: 3px;">
                                    <a><?php echo e($country->country); ?></a>
                                </div>
                                <div class="pe-1 fw-bold text-white d-none">
                                    64
                                </div>
                                <input type="checkbox" style="margin-left:auto">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH G:\gool10bet\resources\views/partials/left_panel.blade.php ENDPATH**/ ?>