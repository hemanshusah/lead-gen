<div class="splash-image" id="updatePasswordSplash">
    <img src="<?php echo e(url('/')); ?>/public/images/upload-logo.png" alt="update logo" />
</div>
<div class="splash-text">
    <?php echo e(cleanLang(__('lang.update_your_company_logo'))); ?>

</div>


<!--fileupload-->
<div class="form-group row">
    <div class="col-12">
        <div class="dropzone dz-clickable text-center file-upload-box" id="fileupload_single_image">
            <div class="dz-default dz-message">
                <div>
                    <h4><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></h4>
                </div>
                <div class="p-t-10"><small><?php echo e(cleanLang(__('lang.allowed_file_types'))); ?>: (jpg|png)</small></div>
                <?php if(request('type') == 'large'): ?>
                <div class=""><small><?php echo e(cleanLang(__('lang.best_image_dimensions'))); ?>: (185px X 45px)</small></div>
                <?php else: ?>
                <div class=""><small><?php echo e(cleanLang(__('lang.best_image_dimensions'))); ?>: (45px X 45px)</small></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!--section js resource-->
<span class="hidden" id="js-settings-logos-modal" data-size="<?php echo e(request('logo_size')); ?>">placeholder</span><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/logos/modals/update-logo.blade.php ENDPATH**/ ?>