
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form" id="settingsFormEmailGeneral">

    <!--from email address-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.system_email_address'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_from_address"
                name="settings_email_from_address" value="<?php echo e($settings->settings_email_from_address ?? ''); ?>">
        </div>
    </div>

    <!--from name-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.system_from_name'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_from_name"
                name="settings_email_from_name" value="<?php echo e($settings->settings_email_from_name ?? ''); ?>">
        </div>
    </div>

    <!--server type-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.email_delivery'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_email_server_type"
                name="settings_email_server_type">
                <option value="sendmail"
                    <?php echo e(runtimePreselected('sendmail', $settings->settings_email_server_type ?? '')); ?>>
                    Sendmail</option>
                <option value="smtp" <?php echo e(runtimePreselected('smtp', $settings->settings_email_server_type ?? '')); ?>>
                    SMTP</option>
            </select>
        </div>
    </div>

    <!--show error if cronjob has not run before-->
    <!--[MULTITENANCY]-->
    <?php if(config('system.settings_type') == 'standalone'): ?>
    <?php if($settings->settings_cronjob_has_run != 'yes'): ?>
    <div class="splash-text">
        <div class="alert alert-danger"><?php echo e(cleanLang(__('lang.cronjob_and_emails'))); ?>. <a
                href="https://mycrm.io/documentation/cron-job-settings/"
                target="_blank"><?php echo app('translator')->get('lang.more_information'); ?></a></div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <!--buttons-->
    <div class="text-right">
        <!--send a test email-->
        <button type="button" class="btn btn-info edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(url('settings/email/testemail')); ?>"
            data-loading-target="commonModalBody" data-modal-title="Send A Test Email"
            data-action-url="<?php echo e(url('settings/email/testemail')); ?>" data-action-method="POST" data-action-ajax-class=""
            data-action-type='form' data-action-form-id="test-email-form""
            data-modal-size=" modal-lg" data-header-close-icon="hidden" data-header-extra-close-icon="visible"
            data-action-ajax-loading-target="commonModalBody"><?php echo e(cleanLang(__('lang.send_test_email'))); ?>

        </button>
        <!--save changes-->
        <button type="submit" id="email-general-settings-button" class="btn btn-rounded-x btn-danger waves-effect text-left"
            data-url="/settings/email/general" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>

    </div>
</form>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<a href="https://mycrm.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
        class="ti-info-alt"></i>
    <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

</a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/email/general.blade.php ENDPATH**/ ?>