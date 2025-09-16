
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<div class="p-t-40 p-b-40" id="updates-container">


    <!--no updates avialable-->
    <div class="updates-card m-t-10" id="updates-checking" data-url="<?php echo e(url('settings/updates/check')); ?>"
        data-type="form" data-form-id="updates-checking" data-ajax-type="post">
        <input type="hidden" name="licence_key" value="<?php echo e(config('system.settings_purchase_code')); ?>">
        <input type="hidden" name="ip_address" value="<?php echo e(request()->ip()); ?>">
        <input type="hidden" name="url" value="<?php echo e(url()->current()); ?>">
        <input type="hidden" name="current_version" value="<?php echo e(config('system.settings_version')); ?>">
        <input type="hidden" name="email" value="<?php echo e(auth()->user()->email); ?>">
        <input type="hidden" name="name" value="<?php echo e(auth()->user()->first_name.' '. auth()->user()->first_name); ?>">
        <div class="loading p-b-30 p-t-30"></div>
        <div class="x-message">
            <h2><?php echo e(cleanLang(__('lang.checking_for_updates'))); ?>. <?php echo e(cleanLang(__('lang.please_wait'))); ?></h2>
        </div>
    </div>


    <!--server error-->
    <div class="updates-card m-t-10 hidden" id="updates-server-error">
        <img src="<?php echo e(url('/')); ?>/public/images/server-communication-error.png"
            alt="<?php echo e(cleanLang(__('lang.error_communicating_updates_server'))); ?>" />
        <div class="x-message">
            <h3><?php echo e(cleanLang(__('lang.error_communicating_updates_server'))); ?></h3>
            <h4><?php echo e(cleanLang(__('lang.try_again_later'))); ?></h4>
            <h6><?php echo e(cleanLang(__('lang.check_logs_for_details'))); ?></h6>
        </div>
    </div>


    <!-- product code-->
    <div class="updates-card alert alert-warning hidden" id="updates-invalid-purchase-code">
        <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> <?php echo e(cleanLang(__('lang.warning'))); ?></h3>
        <?php echo e(cleanLang(__('lang.purchase_code_could_not_be_confirmed'))); ?>

        <div>
            <a href="<?php echo e(url('app/settings/general')); ?>"><?php echo e(cleanLang(__('lang.enter_product_code'))); ?></a>
        </div>
    </div>


    <!--app version error-->
    <div class="updates-card m-t-10 hidden" id="updates-app-version-error">
        <img src="<?php echo e(url('/')); ?>/public/images/error-app-version.png"
            alt="<?php echo e(cleanLang(__('lang.error_communicating_updates_server'))); ?>" />
        <div class="x-message">
            <h3><?php echo e(cleanLang(__('lang.app_version_could_not_be_veried'))); ?></h3>
            <h4><?php echo e(cleanLang(__('lang.please_contact_support'))); ?></h4>
        </div>
    </div>




    <!--no updates avialable-->
    <div class="updates-card m-t-10 hidden" id="updates-none-available">
        <img src="<?php echo e(url('/')); ?>/public/images/no-download-avialble.png" alt="No updates available" />
        <div class="x-message m-t-5">
            <h3><?php echo e(cleanLang(__('lang.no_updates_available'))); ?></h3>
        </div>
        <div class="m-t-5">
            <h5><?php echo e(cleanLang(__('lang.your_version'))); ?>: <span
                    class="label label-rounded label-info">v<?php echo e(config('system.settings_version')); ?></span></h5>
        </div>
    </div>



    <!--custom error message-->
    <div class="updates-card alert alert-warning hidden m-b-30" id="updates-error-message">
        <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i>
            <span id="update-message-title"></span></h3>
        <div id="update-message-body"></div>
        <div class="m-t-8" id="update-message-url hidden">
            <a href="" id="update-message-url-link" target="_blank"><span class="font-weight-500"
                    id="update-message-url-anchor"></span></a>
        </div>
    </div>


    <!--updates avialable-->
    <div class="updates-card m-t-10 hidden" id="updates-available">
        <img src="<?php echo e(url('/')); ?>/public/images/download-available.png" alt="updates available" />
        <div class="m-t-20">
            <h3><?php echo e(cleanLang(__('lang.new_updates_available'))); ?></h3>
        </div>
        <div class="m-t-10">
            <h5><?php echo e(cleanLang(__('lang.your_version'))); ?>: <span
                    class="label label-rounded label-info">v<?php echo e(config('system.settings_version')); ?></span> ----
                <?php echo e(cleanLang(__('lang.new_version'))); ?>: <span class="label label-rounded label-success"
                    id="updated-current-version">x</span></h5>
        </div>
        <div class="m-t-20">
            <a class="btn waves-effect waves-light btn-rounded-x btn-danger" href="javascript:void(0)"
                id="updated-download-link"><?php echo e(cleanLang(__('lang.download_updates'))); ?></a>
        </div>

        <?php if(config('system.settings_type') == 'standalone'): ?>
        <!--[standalone] - settings documentation help-->
        <div class="p-t-30">
            <a href="https://demo.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
                    class="ti-info-alt"></i>
                <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

            </a>
        </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/updates/page.blade.php ENDPATH**/ ?>