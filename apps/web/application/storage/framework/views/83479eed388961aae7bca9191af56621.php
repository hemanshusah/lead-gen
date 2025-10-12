
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form">
    <!--form text tem-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.cron_job_command'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_company_name"
                name="settings_company_name" value="<?php echo e(config('system.cronjob_path')); ?>">
        </div>
    </div>
    <?php if(config('system.settings_cronjob_has_run') == 'yes'): ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
        </button>
        <h4 class="text-info"><?php echo e(cleanLang(__('lang.cronjob_status'))); ?></h4>
        <?php echo e(cleanLang(__('lang.cronjob_last_executed'))); ?>:
        (<?php echo e(runtimeDateAgo(config('system.settings_cronjob_last_run'))); ?>)
    </div>
    <?php else: ?>


    <div id="fx-settings-cronjob-instructions">
        <?php echo e(cleanLang(__('lang.cronjob_instructions'))); ?>

    </div>


    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
        </button>
        <h4 class="text-danger"><?php echo e(cleanLang(__('lang.cronjob_status'))); ?></h4>
        <?php echo e(cleanLang(__('lang.cronjob_inactive'))); ?>

    </div>
    <?php endif; ?>

    <?php if(config('system.settings_type') == 'standalone'): ?>
    <!--[standalone] - settings documentation help-->

    <?php endif; ?>

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/cronjobs/page.blade.php ENDPATH**/ ?>