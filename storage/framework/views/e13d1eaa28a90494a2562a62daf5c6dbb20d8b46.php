<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--   contact section start    -->
    <div class="contact-section">
        <div class="container">
            <!--  contact form and map start  -->
            <div class="contact-form-section smoke-bg py-5 px-3">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <form action="<?php echo e(route('register')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-element">

                                        <label for="first_name" class="font-weight-bold text-white"><?php echo app('translator')->get('First Name'); ?></label>

                                        <input type="text" name="first_name" placeholder="<?php echo app('translator')->get('First Name'); ?>" value="<?php echo e(old('first_name')); ?>">
                                        <?php if($errors->has('first_name')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('first_name')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-element">
                                        <label for="last_name" class="font-weight-bold text-white"><?php echo app('translator')->get('Last Name'); ?></label>
                                        <input type="text" name="last_name" placeholder="<?php echo app('translator')->get('Last Name'); ?>" value="<?php echo e(old('last_name')); ?>">
                                        <?php if($errors->has('last_name')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('last_name')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-element">
                                        <label for="username"  class="font-weight-bold text-white"><?php echo app('translator')->get('Username'); ?></label>
                                        <input type="text" name="username" placeholder="<?php echo app('translator')->get('Username'); ?>" value="<?php echo e(old('username')); ?>">
                                        <?php if($errors->has('username')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('username')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-element">
                                        <label for="phone"  class="font-weight-bold text-white"><?php echo app('translator')->get('Contact Number'); ?></label>
                                        <input type="hidden" id="track" name="country_code">

                                        <input type="tel" name="phone" id="phone" placeholder="<?php echo app('translator')->get('Contact Number'); ?>">

                                        <?php if($errors->has('phone')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                    <div class="form-wrap d-none" >
                                        <label class="form-label rd-input-label"></label>
                                        <input type="text" id="country" readonly name="country" value="<?php echo e(old('country')); ?>" class="form-input form-control-last-child <?php echo e($errors->has('country') ? ' form-control-has-validation' : ''); ?>" autocomplete="off" placeholder="Country...">
                                        <?php if($errors->has('country')): ?>
                                            <span class="form-validation"><?php echo e(__($errors->first('country'))); ?></span>
                                        <?php endif; ?>
                                    </div>


                                    <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="email"  class="font-weight-bold text-white"><?php echo app('translator')->get('E-mail Address'); ?></label>
                                        <input type="text" name="email" placeholder="<?php echo app('translator')->get('E-mail Address'); ?>" value="<?php echo e(old('email')); ?>">
                                        <?php if($errors->has('email')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-element">
                                        <label for="password"  class="font-weight-bold text-white"><?php echo app('translator')->get('Password'); ?></label>
                                        <input type="password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>">
                                        <?php if($errors->has('password')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-element">
                                        <label for="password"  class="font-weight-bold text-white"><?php echo app('translator')->get('Repeat Password'); ?></label>
                                        <input type="password" name="password_confirmation"
                                               placeholder="<?php echo app('translator')->get('Repeat Password'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-element mt-3">
                                        <button type="submit" class="btn btn-block"><span><?php echo app('translator')->get('Sign Up'); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  contact form and map end  -->
        </div>
    </div>
    <!--   contact section end    -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('templates/js/intlTelInput.js')); ?>"></script>
    <script>
        $("#phone").on("countrychange", function(e, countryData) {
            // do something with countryData
            console.log(countryData);
            var data =  $(this).val('+' + countryData.dialCode)
            $('#track').val(data);
            var country = countryData.name;
            var country = country.split('(')[0];
            $('#country').val(country);
        });
        $("#phone").intlTelInput({
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            // hiddenInput: "full_number",
            initialCountry: "auto",
            utilsScript: "<?php echo e(asset('templates/js/utils.js')); ?>"
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/auth/register.blade.php ENDPATH**/ ?>