
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form" id="settingsFormEmailSMTP">

    <!--smtp host-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.smtp_host'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_smtp_host"
                name="settings_email_smtp_host" value="<?php echo e($settings->settings_email_smtp_host ?? ''); ?>">
        </div>
    </div>

    <!--port-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.smtp_port'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_smtp_port"
                name="settings_email_smtp_port" value="<?php echo e($settings->settings_email_smtp_port ?? ''); ?>">
        </div>
    </div>

    <!--usrname-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.username'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_smtp_username"
                name="settings_email_smtp_username" value="<?php echo e($settings->settings_email_smtp_username ?? ''); ?>">
        </div>
    </div>

    <!--password-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.password'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_email_smtp_password"
                name="settings_email_smtp_password" value="<?php echo e($settings->settings_email_smtp_password ?? ''); ?>">
        </div>
    </div>

    <!--ensryption-->
    <div class="form-group row">
        <label for="example-month-input"
            class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.encryption'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_email_smtp_encryption"
                name="settings_email_smtp_encryption">
                <option value="none">None</option>
                <option value="tls" <?php echo e(runtimePreselected('tls', $settings->settings_email_smtp_encryption ?? '')); ?>>
                    TLS</option>
                <option value="starttls"
                    <?php echo e(runtimePreselected('starttls', $settings->settings_email_smtp_encryption ?? '')); ?>>
                    STARTTLS</option>
                <option value="ssl" <?php echo e(runtimePreselected('ssl', $settings->settings_email_smtp_encryption ?? '')); ?>>
                    SSL</option>
            </select>
        </div>
    </div>

    <!--show error if cronjob has not run before-->
    <?php if($settings->settings_cronjob_has_run != 'yes'): ?>
    <div class="splash-text">
        <div class="alert alert-danger"><?php echo e(cleanLang(__('lang.cronjob_and_emails'))); ?>. <a
                href="https://mycrm.io/documentation/cron-job-settings/"
                target="_blank"><?php echo app('translator')->get('lang.more_information'); ?></a></div>
    </div>
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
        <button type="submit" id="email-smtp-settings-button" class="btn btn-rounded-x btn-danger waves-effect text-left"
            data-url="/settings/email/smtp" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>

<!--email testing tool-->
<div class="row">
    <div class="col-12">
        <div class="alert alert-info m-t-40 p-t-30 p-b-30">
            <div class="email-testing-tool-sections" id="email-testing-tool-start">
                <h5 class="text-info"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.email_delivery_problem'); ?></h5>
                <p class="card-text"><?php echo app('translator')->get('lang.use_tool_to_debug_smtp'); ?></p>
                <a href="#" class="btn btn-sm btn-primary ajax-request" data-url="<?php echo e(url('settings/email/testsmtp')); ?>"
                    data-onstart-hide="#email-testing-tool-start" data-onstart-show="#email-testing-tool-running"
                    id=""><?php echo app('translator')->get('lang.run_test_now'); ?></a>
            </div>

            <div class="hidden email-testing-tool-sections" id="email-testing-tool-running">
                <h5 class="text-info"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.please_wait'); ?></h5>
                <div class="p-t-10">
                    <p class="card-text"><?php echo app('translator')->get('lang.this_test_can_take_some_time'); ?></p>
                </div>

                <div class="loading m-t-20 m-b-50"></div>
            </div>

            <div class="hidden email-testing-tool-sections" id="email-testing-tool-error-fsockopen">
                <h5 class="text-danger"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.smtp_error'); ?></h5>
                <div class="p-t-10">
                    <p class="card-text"><?php echo app('translator')->get('lang.a_required_function_is_disabled_on_server'); ?> [fsockopen]</p>
                </div>
            </div>

            <div class="hidden email-testing-tool-sections" id="email-testing-tool-error-smtp-not-enabled">
                <h5 class="text-danger"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.smtp_error'); ?></h5>
                <div class="p-t-10">
                    <p class="card-text"><?php echo app('translator')->get('lang.smtp_not_enabled'); ?></p>
                </div>
            </div>

            <!--smtp errors-->
            <div class="hidden email-testing-tool-sections" id="email-testing-tool-smtp-failed">
                <h5 class="text-danger"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.smtp_ports_closed'); ?></h5>
                <div class="p-t-10 p-b-20">
                    <p class="card-text"><?php echo app('translator')->get('lang.ask_webhost_to_enable_smtp_ports'); ?></p>
                </div>
                <table class="table table-sm table-bordered m-b-40" id="email-testing-tool-smtp-results-failed">

                </table>
            </div>

            <!--smtp passed-->
            <div class="hidden email-testing-tool-sections" id="email-testing-tool-smtp-passed">
                <h5 class="text-success"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.everything_looks_ok'); ?></h5>
                <div class="p-t-10 p-b-20">
                    <p class="card-text"><?php echo app('translator')->get('lang.smtp_test_passed'); ?></p>
                </div>
                <table class="table table-sm table-bordered m-b-40" id="email-testing-tool-smtp-results-passed">

                </table>
            </div>


        </div>
    </div>
</div>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<a href="https://mycrm.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
        class="ti-info-alt"></i>
    <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

</a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/email/smtp.blade.php ENDPATH**/ ?>