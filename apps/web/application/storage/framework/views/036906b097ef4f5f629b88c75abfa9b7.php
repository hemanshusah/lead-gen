
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form">
    <!--form text tem-->
    <div class="form-group row">
        <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.main_theme'))); ?></label>
        <div class="col-12">
            <select class="select2-basic form-control form-control-sm" id="settings_theme_name"
                name="settings_theme_name">
                <?php $__currentLoopData = config('theme.list'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($theme); ?>" <?php echo e(runtimePreselected($theme, $settings->settings_theme_name ?? '')); ?>>
                    <?php echo e(runtimeThemeName($theme)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>


    <div class="form-group form-group-checkbox row">
        <div class="col-12 p-t-5">
            <input type="checkbox" id="reset_users_theme" name="reset_users_theme" class="filled-in chk-col-light-blue">
            <label class="p-l-30" for="reset_users_theme"><?php echo app('translator')->get('lang.reset_users_theme'); ?></label>
        </div>
    </div>

    <div class="line"></div>

    <div class="alert alert-info hidden">
        <?php echo e(cleanLang(__('lang.head_body_information'))); ?>

    </div>

    <!--form checkbox item-->
    <div class="form-group form-group-checkbox row">
        <label class="col-12 col-form-label"><?php echo e(cleanLang(__('lang.head'))); ?></label>
        <div class="col-12 p-t-5">
            <textarea class="form-control form-control-sm" rows="10" name="settings_theme_head"
                id="settings_theme_head"><?php echo e($settings->settings_theme_head); ?></textarea>
        </div>
    </div>

    <!--form checkbox item-->
    <div class="form-group form-group-checkbox row">
        <label class="col-12 col-form-label"><?php echo e(cleanLang(__('lang.body'))); ?></label>
        <div class="col-12 p-t-5">
            <textarea class="form-control form-control-sm" rows="10" name="settings_theme_body"
                id="settings_theme_body"><?php echo e($settings->settings_theme_body); ?></textarea>
        </div>
    </div>

    <!--css_style-->
    <div class="form-group form-group-checkbox row m-b-30">
        <label class="col-12 col-form-label"><?php echo e(cleanLang(__('lang.css_style'))); ?> <span
                class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.custom_css_crm'); ?>"
                data-placement="top"><i class="ti-info-alt"></i></span></label>
        <div class="col-12 p-t-5">
            <textarea id="css-editor-textarea" class="hidden" name="settings2_theme_css"
                data-crm-theme="<?php echo e(auth()->user()->pref_theme); ?>"><?php echo e($settings2->settings2_theme_css ?? ''); ?></textarea>
        </div>
    </div>

    <?php if(config('system.settings_type') == 'standalone'): ?>
    <!--[standalone] - settings documentation help-->
    <div>
        <a href="https://demo.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
                class="ti-info-alt"></i>
            <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

        </a>
    </div>
    <?php endif; ?>

    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton"
            class="btn btn-rounded-x btn-danger waves-effect text-left js-ajax-ux-request" data-url="/settings/theme"
            data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/theme/page.blade.php ENDPATH**/ ?>