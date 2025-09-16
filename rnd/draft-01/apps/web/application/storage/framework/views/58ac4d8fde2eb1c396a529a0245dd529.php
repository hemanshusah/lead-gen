
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form">
    <!--form text tem-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.proposal_prefix'))); ?></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="settings_proposals_prefix"
                name="settings_proposals_prefix" value="<?php echo e($settings->settings_proposals_prefix ?? ''); ?>">
        </div>
    </div>

    <!--next id-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo app('translator')->get('lang.next_id_number_proposal'); ?>
            (<?php echo app('translator')->get('lang.optional'); ?>)
            <!--info tooltip-->
            <span class="align-middle text-themecontrast" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.next_id_number_info'); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span></label>
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="next_id" name="next_id" value="<?php echo e($next_id); ?>">
            <input type="hidden" name="next_id_current" value="<?php echo e($next_id); ?>">
        </div>
    </div>

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton"
            class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request"
            data-url="/settings/proposals" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/proposals/page.blade.php ENDPATH**/ ?>