<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/templates/css/custom-table.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        table {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            text-indent: initial;
            border-spacing: 2px;
            border-color: grey;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        td {
            display: table-cell;
            vertical-align: inherit;
        }

        .invoice-tr:hover {
            background: #FFEB3B;
            cursor: pointer;
        }

        table, th, td {
            border: 1px solid black;
        }

        .filterform {
            background: #004c17;
            margin-top: 10px;
        }

        label {
            padding-left: 10px;
            color: white;
        }
    </style>
    <div class="filterform">
        <form action="<?php echo e(route('invoice.search')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <label style="padding-left: 10px; color:white;">Date :</label>
            <input type="date" id="fromdate" name="from" value="2018-07-22"> /
            <input type="date" id="todate" name="to" value="<?php echo e(Now()->format('Y-m-d')); ?>">
            <label style="padding-left: 10px; color:white;" width="29%">User :
                <span style="padding-left: 10px;">
                    <select name="user" size="1" class="hinput2" style="font-weight: 600;  font-size: 14px;height: 25px;">
                        <option value="<?php echo e(auth()->id()); ?>">My Account</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($users->id); ?>"><?php echo e($users->username); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </span>
            </label>
            <label style="padding-left: 10px; color:white;" width="45%" align="left">Filter :
                <select name="filter" size="1" class="hinput2" style="font-weight: 600;  font-size: 14px;height: 25px;">
                    <option value="All">All Bets</option>
                    <option value="Proccessing">Bets that can be paid</option>
                    <option value="Win">Only winning bets</option>
                    <option value="Lose">Only lost bets</option>
                    <option value="Proccessing">Only open bets</option>
                </select>
            </label>
            <br>
            <label>Ticket No:</label>
            <input type="text" id="ticket"
                   style="border-style:solid; border-width:0; width: 120px; height:20px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; font-size: 14px; font-weight: 600;"
                   name="ticket">
            <button type="submit" style="font-weight: 600; font-size: 14px; height: 25px;width: 100px;">List</button>
        </form>
    </div>
    <div class=" shadow-bg ">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-12">
                    <div class="table-custom">
                        <table class="table">
                            <thead>
                            <tr class="result-table-header"
                                style="font-family: sans-serif; font-weight: 600; color: white; background:#191919 ">
                                
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Bet Type'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Total Win'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Slip No.'); ?></th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="invoice-tr" data-invoice-id="<?php echo e($data->id); ?>" id="<?php echo e($data->id); ?>"
                                    onclick="test(this.id)" <?php echo e($data->status!="Lose" ? 'style=color:#069e32' : 'style=color:#e60202'); ?>>
                                    
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(date('d/m/Y',strtotime($data->date))); ?></td>
                                    <td><?php echo e(date('h:i a',strtotime($data->date))); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Bet Type'); ?>" class=" font-weight-bold">bet(<?php echo e(count($data->bets->where('result','!=',0))); ?>/<?php echo e(count($data->bets)); ?>)</td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>" class=" font-weight-bold"><?php echo e($data->amount); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Total Win'); ?>"><?php echo e($data->status!="Lose" ? $data->possible_win : "-"); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Slip No.'); ?>"><?php echo e($data->coupon_id); ?></td>
                                    
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr class="result-table-tr">
                                    <td colspan="8"><?php echo app('translator')->get('No Data Found!'); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>

                    </div>

                    <div class="pagination-nav ">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function test(id) {
            window.location.href = "/user/invoicebets/" + id;
        }
    </script>

<?php $__env->stopSection(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/my-prediction.blade.php ENDPATH**/ ?>