 <?php $__env->startSection('content'); ?>
<!--signup-->
<div class="login-logo m-t-30 p-b-5">
    <a href="javascript:void(0)" class="text-center db">
        <img src="<?php echo e(runtimeLogoLarge()); ?>" alt="Home">
    </a>
</div>

<div class="login-box m-t-20">
    <form class="form-horizontal form-material" id="loginForm">
        <div class="title">
            <h4 class="box-title m-t-10 text-center"><?php echo e(cleanLang(__('lang.sign_in_to_your_account'))); ?></h4>
            <div class="text-center  m-b-20 ">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="email" id="email"
                    placeholder="<?php echo e(cleanLang(__('lang.email'))); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" name="password" id="password"
                    placeholder="<?php echo e(cleanLang(__('lang.password'))); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox cursor-pointer">
                <input type="checkbox" class="custom-control-input" name="remember_me" checked="checked">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description"><?php echo e(cleanLang(__('lang.remember_me'))); ?></span>
            </label>
        </div>
        <div class="form-group row p-t-10 p-b-10">
            <div class="col-md-12">
                <a href="<?php echo e(url('forgotpassword')); ?>" id="to-recover" class="text-dark pull-right js-toggle-login-forms"
                    data-target="login-forms-forgot">
                    <i class="fa fa-lock m-r-5"></i> <?php echo e(cleanLang(__('lang.forgot_password'))); ?></a>
            </div>
        </div>

        <!--DYANMIC TRUSTED CONTENT - No sanitizing required] for this trusted content (Google reCAPTCHA)-->
        <?php if(@config('system.settings2_captcha_status') == 'enabled'): ?>
        <div class="m-b-20">
            <?php echo htmlFormSnippet([]); ?>

        </div>
        <?php endif; ?>

        <div class="form-group text-center p-b-10">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block" id="loginSubmitButton"
                    data-button-loading-annimation="yes" data-button-disable-on-click="yes"
                    data-url="<?php echo e(url('login?action=initial&redirect_url='.request('redirect_url'))); ?>"
                    data-ajax-type="POST" type="submit"><?php echo e(cleanLang(__('lang.continue'))); ?></button>
            </div>
        </div>
        <?php if(config('system.settings_clients_registration') == 'enabled'): ?>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <?php echo e(cleanLang(__('lang.dont_have_an_account'))); ?>

                <a href="<?php echo e(url('signup')); ?>" class="text-info m-l-5 js-toggle-login-forms"
                    data-target="login-forms-signup">
                    <b><?php echo e(cleanLang(__('lang.sign_up'))); ?></b>
                </a>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </form>
</div>

<div class="login-background">
    <div class="x-left">
        <img src="<?php echo e(url('/')); ?>/public/images/login-1.png" class="login-images" />
    </div>
    <div class="x-right hidden">
        <img src="<?php echo e(url('/')); ?>/public/images/login-2.png" alt="404 - Not found" />
    </div>
</div>
<!--signup-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapperplain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/authentication/login.blade.php ENDPATH**/ ?>