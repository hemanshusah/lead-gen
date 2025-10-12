
<?php $__env->startSection('settings-page'); ?>
<!--page notification-->
<div class="row">
    <div class="col-12">
        <div class="page-notification-imaged">
            <img src="<?php echo e(url('/')); ?>/public/images/settings.png" alt="Application Settings" />
            <div class="message">
                <h3><?php echo e(cleanLang(__('lang.setting_welcome_message'))); ?></h2>
            </div>
            <div class="sub-message" id="sub-message-large">
                <h4><?php echo e(cleanLang(__('lang.setting_welcome_message_sub'))); ?></h2>
            </div>
            <div class="sub-message hidden" id="sub-message-small">
                <h4><?php echo e(cleanLang(__('lang.access_top_menu'))); ?> <i class="sl-icon-menu text-danger"></i></h2>
            </div>
            <!--[MULTITENANCY]-->
            <?php if(config('system.settings_type') == 'standalone'): ?>
            <div class="m-t-20">
                <h4><span class="badge badge-success"> <?php echo app('translator')->get('lang.version'); ?> <?php echo e($settings->settings_version); ?></span>
                    </h2>
            </div>

            <div class="m-t-20">
                <a href="<?php echo e(url('/app/settings/updates')); ?>"
                    class="btn btn-rounded-x btn-sm btn-danger waves-effect text-left"><?php echo app('translator')->get('lang.check_for_updates'); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/home/page.blade.php ENDPATH**/ ?>