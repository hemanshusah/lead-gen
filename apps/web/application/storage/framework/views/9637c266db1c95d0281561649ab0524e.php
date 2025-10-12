<div class="row">
    <div class="col-lg-12">
        <!--title-->
        <div class="form-group row">
            <label class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.status_name'))); ?>*</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="leadstatus_title" name="leadstatus_title"
                    value="<?php echo e($status->leadstatus_title ?? ''); ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group row">
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_default" value="default"
                    <?php echo e($page['default_color'] ?? ''); ?> <?php echo e(runtimePreChecked2('default', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_default"><span class="bg-default settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12 p-b-5">
                <input name="leadstatus_colors" type="radio" id="radio_info" value="info"
                    <?php echo e(runtimePreChecked2('info', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_info"><span class="bg-info settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_success" value="success"
                    <?php echo e(runtimePreChecked2('success', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_success"><span class="bg-success settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_danger" value="danger"
                    <?php echo e(runtimePreChecked2('danger', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_danger"><span class="bg-danger settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_warning" value="warning"
                    <?php echo e(runtimePreChecked2('warning', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_warning"><span class="bg-warning settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_primary" value="primary"
                    <?php echo e(runtimePreChecked2('primary', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_primary"><span class="bg-primary settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_lime" value="lime"
                    <?php echo e(runtimePreChecked2('lime', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_lime"><span class="bg-lime settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>
            <div class="col-12">
                <input name="leadstatus_colors" type="radio" id="radio_brown" value="brown"
                    <?php echo e(runtimePreChecked2('brown', $status->leadstatus_color ?? '')); ?>

                    class="with-gap radio-col-grey leadstatus_colors">
                <label for="radio_brown"><span class="bg-brown settings-leads-modal-color-select"
                        >&nbsp;</span>
                </label>
            </div>

            <!--hidden-->
            <input type="hidden" name="leadstatus_color" id="leadstatus_color" value="">

        </div>
    </div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/leads/modals/add-edit-inc.blade.php ENDPATH**/ ?>