 <?php $__env->startSection('content'); ?>
<!--signup-->
<div class="login-logo m-t-30 p-b-5">
    <a href="javascript:void(0)" class="text-center db">
        <img src="<?php echo e(runtimeLogoLarge()); ?>" alt="Home">
    </a>
</div>

<div class="login-box m-t-20">
    <h3 class="box-title  m-t-10 text-center"><?php echo e(cleanLang(__('lang.forgot_password'))); ?></h3>
    <div class="text-center  m-b-20 ">
        <small><?php echo e(cleanLang(__('lang.please_enter_account_email_address'))); ?></small>
    </div>
    <form class="form-horizontal form-material" id="forgotPasswordForm">
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" name="email" id="email" placeholder="<?php echo e(cleanLang(__('lang.email'))); ?>">
            </div>
        </div>
        <div class="form-group text-center p-b-10">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block" id="forgotSubmitButton"
                    data-button-loading-annimation="yes" data-button-disable-on-click="yes"
                    data-url="<?php echo e(url('forgotpassword')); ?>" data-ajax-type="POST" data-loading-target=""
                    data-loading-class="loading" type="submit"><?php echo e(cleanLang(__('lang.forgot_password'))); ?></button>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <a href="<?php echo e(url('login')); ?>" class="text-info m-l-5 js-toggle-login-forms"
                    data-target="login-forms-login">
                    <b><?php echo e(cleanLang(__('lang.back_to_login'))); ?></b>
                </a>
                </p>
            </div>
        </div>
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
<?php echo $__env->make('layout.wrapperplain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/authentication/forgotpassword.blade.php ENDPATH**/ ?>