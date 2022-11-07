<!DOCTYPE html>
<html lang="ar" translate="yes">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=1024">
    <title><?php echo e($basic->sitename); ?> <?php if(isset($page_title)): ?> | <?php echo e(@$page_title); ?> <?php endif; ?></title>
    <meta name="keywords" content="<?php echo e($basic->meta_keywords); ?>"/>
    <meta name="description" content="<?php echo e($basic->meta_description); ?>"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Source+Sans+Pro:400,600,700&amp;display=swap"
          rel="stylesheet">


    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('images/logo/favicon.png')); ?>" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/file.min.css')); ?>">
<?php echo $__env->yieldContent('load-css'); ?>

<?php echo $__env->yieldContent('css'); ?>
<!-- responsive css -->
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/responsive.css')); ?>">
    <!-- jquery js -->
    <script src="<?php echo e(asset('templates/js/jquery-1.10.2.min.js')); ?>"></script>
</head>

<body>


<!--  Header Section Start  -->
<div class="header-section home-3">
    <div class="info-area">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-6">
                    <a class="logo-wrapper" href="<?php echo e(route('site')); ?>"><img src="<?php echo e(asset('images/logo/logo.png')); ?>"
                                                                          alt=""></a>
                </div>
                <div class="col-md-6 ">
                    <ul class="socials text-end">
                       <?php echo $__env->make('partials.language', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if(auth()->guard()->guest()): ?>
                            <form id="logins" method="post" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>
                                <span class='spn1' style="display: inline-block; width:120px"><input
                                            placeholder="UserName" type="text" name="username"></span>
                                <span class='spn2' style="display: inline-block;width: 120px;"><input
                                            placeholder="password" type="password" name="password"></span>
                                <span class='spn3' style="display: inline-block;width: 120px;"><input type="submit"
                                                                                                      class="button"
                                                                                                      value="Login"
                                                                                                      id="giris"></span>
                            </form>
                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                            <span id="logins" style="display: inline-block;float: right;margin-right: -5px;padding-top: 10px; ">
			                    <a href="<?php echo e(route('home')); ?>" class="kmenu" style="text-decoration:none; color: white;"><?php echo app('translator')->get('My Bets'); ?></a>
                                <a href="<?php echo e(route('profile-setting')); ?>" class="kmenu" style="text-decoration:none; color: white;"><?php echo app('translator')->get('My Account'); ?></a>
                                <a href="<?php echo e(route('transaction')); ?>" class="kmenu" style="text-decoration:none; color: white;"><?php echo app('translator')->get('Reports'); ?></a>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="kmenu" style="text-decoration:none;margin-right: 5px; color: white;background: #B40004;"><?php echo app('translator')->get('Logout'); ?></a>
                                 <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                       class="d-none">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                
		                    </span>
                            <li class="pt-2"><a href="javascript:void(0)"><i class="fa fa-wallet"></i> <?php echo app('translator')->get('Balance'); ?>
                                    : <?php echo e(number_format(Auth::user()->balance,$basic->decimal)); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--  Navbar Area Start  -->
    <div class="nav-area ">
        <div class="main-menu">
            <div class="container">
                <div class="row align-items-center position-relative">
                    
                    
                    
                    <div class="col-lg-12 col-12 position-static">
                        <nav>
                            <ul class="menus" id="mainMenu">
                                <li <?php if(Request::routeIs('site')): ?> class="active" <?php endif; ?>><a href="<?php echo e(route('site')); ?>"
                                                                                           class="parent-link"><?php echo app('translator')->get('SPORTS BETS'); ?></a>
                                </li>

                                <li <?php if(Request::routeIs('livesport')): ?> class="active" <?php endif; ?>><a href="<?php echo e(route('livesport')); ?>"
                                                                                            class="parent-link"><?php echo app('translator')->get('LIVE SPORTS'); ?></a>
                                </li>
                                <li <?php if(Request::routeIs('blog')): ?> class="active" <?php endif; ?>><a href=""
                                                                                           class="parent-link"><?php echo app('translator')->get('SLOT'); ?></a>
                                </li>

                                <li <?php if(Request::routeIs('faq')): ?> class="active" <?php endif; ?>><a href=""
                                                                                          class="parent-link"><?php echo app('translator')->get('TOMBALA'); ?></a>
                                </li>
                                
                                


                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                    
                                        
                                        
                                            
                                            
                                                   
                                                     
                                            

                                            
                                                  
                                                
                                            
                                        
                                    
                                


                            </ul>

                            <div id="mobileMenu"></div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Navbar Area End  -->
</div>
<!--  Header Section End  -->
<style>
    a{
        text-decoration: none;
    }

    .clickable{
        cursor: pointer;
    }

    .float-right{
        float: right;
    }

    .float-left{
        float: left;
    }

    /* .left-panel {
         max-height: 90vh;
         overflow-y: auto;
     }*/

    .left-panel .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .left-panel .sublist-header{
        position: sticky;
        top: 100px;
        z-index: 100;
    }

    /* .matches-table{
         max-height: 90vh;
         overflow-y: auto;
     }*/

    .matches-table .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }
    /*    alaa mhna new edit       */
    /*        .bets-table{
                max-height: 90vh;
                overflow-y: auto;
            }
    */
    .bets-table .header{
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .loading-spinner{
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        z-index: 99999;
    }

    .input-group-text{
        min-width: 100px;
    }

    .opponent, .bet-info, .sub-opponent{
        cursor: pointer;
    }

    .opponent:hover, .draw:hover{
        color: black;
    }

    .main-container h2, .live-container h2{
        margin-bottom: 0.25rem !important;
    }

    .main-container span, .live-container span{
        font-size: 12px;!important;
        /*color: #fff !important;*/
    }

    .main-container h2::after, .live-container h2::after{
        display: none !important;
    }


    @media    screen and (max-width: 568px) {
        .left-panel .sublist-header{
            top: 50px;
        }

        .mt-sm-3{
            margin-top: 1rem;
        }

        .mt-sm-2{
            margin-top: 0.75rem;
        }

        .matches-table{
            zoom: 0.3;
        }

        .ps-sm-2{
            padding-left: 1.5rem;
        }

        .float-right{
            float: unset !important;
        }

        .float-left{
            float: unset !important;
        }

    }

    .font-sm{
        font-size: 14px;
    }

    .match, .live-match{
        overflow: auto;
        font-size: 11px;
    }

    .bg-primary{
        background-color: #151b29 !important;
    }
    @media    screen and (max-width: 768px) {
        .matches-table{
            zoom: 0.5;
        }
    }

</style>

<?php echo $__env->yieldContent('content'); ?>

<div class="footer-bottom">
    <p class="font-11 text-black-777 m-0"><a target="_blank" href="https://www.facebook.com/AllSafeMHR">©All Safe</a></p>
</div>
<!-- back to top area start -->
<div class="back-to-top">
    <i class="fas fa-chevron-up"></i>
</div>
<!-- back to top area end -->


<!-- popper js -->
<script src="<?php echo e(asset('templates/js/file.min.js')); ?>"></script>

<?php echo $__env->yieldContent('load-js'); ?>

<?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('js'); ?>


</body>

</html>
<?php /**PATH G:\gool10bet\resources\views/layout.blade.php ENDPATH**/ ?>