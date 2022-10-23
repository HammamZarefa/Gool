

<!--    Footer Area Start    -->
<footer>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <a class="logo-wrapper" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('images/logo/footer-logo.png')); ?>" alt=""></a>
                    <p class="txt"><?php echo e(__($basic->footer_about)); ?></p>
                </div>
                <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-2">
                    <h4>Useful Links</h4>
                    <ul class="links">
                        <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                        <li><a href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('About Us'); ?></a></li>
                        <li><a href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a></li>
                        <li><a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQS'); ?></a></li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3">
                    <ul class="links mt-5">
                        <li><a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('Sign Up'); ?></a></li>
                        <li><a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact Us'); ?></a></li>
                        <li><a href="<?php echo e(route('terms')); ?>"><?php echo app('translator')->get('Terms & Conditions'); ?></a></li>
                        <li><a href="<?php echo e(route('policy')); ?>"><?php echo app('translator')->get('Policy'); ?></a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <h4><?php echo app('translator')->get('Contact Us'); ?></h4>
                    <div class="contact-infos">
                        <div class="single-info">
                            <div class="icon-wrapper"><i class="flaticon-placeholder"></i></div>
                            <p><?php echo e(__($basic->address)); ?></p>
                        </div>
                        <div class="single-info">
                            <div class="icon-wrapper"><i class="flaticon-phone-auricular-hand-drawn-ringing-tool-outline"></i></div>
                            <p><?php echo e(__($basic->phone)); ?></p>
                        </div>
                        <div class="single-info">
                            <div class="icon-wrapper"><i class="flaticon-message"></i></div>
                            <p><?php echo e(__($basic->email)); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="font-11 text-black-777 m-0"><a target="_blank" href="https://www.facebook.com/AllSafeMHR">©All Safe</a></p>
        </div>
    </div>
</footer>
<!--    Footer Area End    -->

<?php /**PATH G:\gool10bet\resources\views/partials/footer.blade.php ENDPATH**/ ?>