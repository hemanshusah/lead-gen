
<?php $__env->startSection('settings-page'); ?>
<!--settings-->

<div class="row">
    <div class="col-md-6">
        <div class="card card-outline-warning">
            <div class="card-header fx-settings-logo-card">
                <h4 class="m-b-0"><?php echo e(cleanLang(__('lang.large_logo'))); ?></h4>
            </div>
            <div class="card-body text-center">
                <div class="p-b-20"> <img class="logo-large display-inline-block" src="<?php echo e(runtimeLogoLarge()); ?>"
                        alt="<?php echo e(cleanLang(__('lang.large_logo'))); ?>">
                </div>
                <p class="card-text"><?php echo e(cleanLang(__('lang.logo_used_when_menu_is_expanded'))); ?></p>
                <p class="card-text"><?php echo e(cleanLang(__('lang.logo_used_on_pdf_documents'))); ?></p>
                <p class="card-text text-bold font-weight-500"><?php echo e(cleanLang(__('lang.best_image_dimensions'))); ?> :
                    (185px X
                    45px)</p>

                <a href="javascript:void(0)"
                    class="btn btn-rounded-x btn-danger waves-effect js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(url('/settings/logos/uploadlogo?logo_size=large')); ?>"
                    data-loading-target="commonModalBody" data-modal-size="modal-sm" data-header-close-icon="hidden"
                    data-add-class="settings-logo" data-modal-title="<?php echo e(cleanLang(__('lang.update_avatar'))); ?>"
                    data-header-visibility="hidden" data-header-extra-close-icon="visible"
                    data-action-url="<?php echo e(url('/settings/logos/uploadlogo')); ?>"
                    data-action-method="PUT"><?php echo e(cleanLang(__('lang.change_logo'))); ?></a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline-warning">
            <div class="card-header fx-settings-logo-card">
                <h4 class="m-b-0"><?php echo e(cleanLang(__('lang.small_logo'))); ?></h4>
            </div>
            <div class="card-body text-center">
                <div class="p-b-20"> <img class="logo-small display-inline-block" src="<?php echo e(runtimeLogoSmall()); ?>"
                        alt="<?php echo e(cleanLang(__('lang.small_logo'))); ?>">
                </div>
                <p class="card-text"><?php echo e(cleanLang(__('lang.logo_used_when_menu_is_collapsed'))); ?></p>
                <p class="card-text text-bold font-weight-500"><?php echo e(cleanLang(__('lang.best_image_dimensions'))); ?> : (45px
                    X
                    45px)</p>

                <a href="javascript:void(0)"
                    class="btn btn-rounded-x btn-danger waves-effect js-ajax-ux-request reset-target-modal-form edit-add-modal-button"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(url('/settings/logos/uploadlogo?logo_size=small')); ?>"
                    data-loading-target="commonModalBody" data-modal-size="modal-sm" data-header-close-icon="hidden"
                    data-add-class="settings-logo" data-modal-title="<?php echo e(cleanLang(__('lang.update_avatar'))); ?>"
                    data-header-visibility="hidden" data-header-extra-close-icon="visible"
                    data-action-url="<?php echo e(url('/settings/logos/uploadlogo')); ?>"
                    data-action-method="PUT"><?php echo e(cleanLang(__('lang.change_logo'))); ?></a>
            </div>
        </div>
    </div>
</div>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/logos/page.blade.php ENDPATH**/ ?>