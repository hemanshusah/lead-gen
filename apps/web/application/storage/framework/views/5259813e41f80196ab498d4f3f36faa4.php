
<?php $__env->startSection('settings-page'); ?>
<!--settings-->
<form class="form" id="settings-proposals-automation">


    <!--settings2_proposals_automation_default_status-->
    <div class="form-group row p-b-10">
        <label class="col-sm-12 text-left control-label col-form-label"><?php echo app('translator')->get('lang.proposal_automation_default'); ?> <span
                class="align-middle text-info font-16" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.proposal_automation_default_info'); ?>" data-placement="top"><i
                    class="ti-info-alt"></i></span></label>
        <div class="col-sm-12">
            <select class="select2-basic form-control form-control-sm select2-preselected"
                id="settings2_proposals_automation_default_status" name="settings2_proposals_automation_default_status"
                data-preselected="<?php echo e($settings->settings2_proposals_automation_default_status ?? ''); ?>">
                <option></option>
                <option value="enabled"><?php echo app('translator')->get('lang.enabled'); ?></option>
                <option value="disabled"><?php echo app('translator')->get('lang.disabled'); ?></option>
            </select>
        </div>
    </div>


    <!--automation options container-->
    <div class="<?php echo e(proposalAutomationVisibility($settings->settings2_proposals_automation_default_status)); ?>"
        id="settings-automation-options-container">

        <div class="line m-t-20 m-b-10"></div>

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-25">
            <h6><?php echo app('translator')->get('lang.automation_option'); ?></h6> <?php echo app('translator')->get('lang.proposal_automation_info_1'); ?>: <span
                class="align-middle text-info font-16" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.proposal_automation_info_2'); ?>" data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--settings2_proposals_automation_create_project-->
        <div class="form-group form-group-checkbox row m-b-20">
            <div class="col-12">
                <label
                    class="text-left control-label col-form-label required p-r-3"><?php echo app('translator')->get('lang.automation_create_project'); ?></label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="settings2_proposals_automation_create_project"
                        name="settings2_proposals_automation_create_project" class="filled-in chk-col-light-blue"
                        <?php echo e(runtimePrechecked($settings->settings2_proposals_automation_create_project ?? '')); ?>>
                    <label for="settings2_proposals_automation_create_project" class="display-inline"></label>
                </span>
            </div>
        </div>

        <!--project creation options-->
        <div class="card-contrast-panel m-l-30 <?php echo e(proposalAutomationVisibility($settings->settings2_proposals_automation_create_project)); ?>"
            id="settings_automation_create_project_options">


            <!--settings2_proposals_automation_project_status-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_create_project_status'); ?></label>
                <div class="col-sm-12 col-lg-4">
                    <select class="select2-basic form-control form-control-sm select2-preselected"
                        id="settings2_proposals_automation_project_status"
                        name="settings2_proposals_automation_project_status"
                        data-preselected="<?php echo e($settings->settings2_proposals_automation_project_status ?? ''); ?>">
                        <option></option>
                        <option value="not_started"><?php echo app('translator')->get('lang.not_started'); ?></option>
                        <option value="in_progress"><?php echo app('translator')->get('lang.in_progress'); ?></option>
                        <option value="on_hold"><?php echo app('translator')->get('lang.on_hold'); ?></option>
                    </select>
                </div>
            </div>

            <!--proposal_automation_assigned_users-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_assign_project'); ?></label>
                <div class="col-sm-12 col-lg-4">
                    <select name="proposal_automation_assigned_users" id="proposal_automation_assigned_users"
                        class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">
                        <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"
                            <?php echo e(runtimePreselectedInArray($user->id ?? '', $assigned ?? [])); ?>>
                            <?php echo e($user->full_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!--settings2_proposals_automation_create_tasks-->
            <div class="form-group form-group-checkbox row">
                <label
                    class="col-sm-12 col-lg-4 col-form-label text-left"><?php echo app('translator')->get('lang.automation_create_tasks_from_line_item'); ?></label>
                <div class="col-sm-12 col-lg-8 text-left p-t-5">
                    <input type="checkbox" id="settings2_proposals_automation_create_tasks"
                        <?php echo e(runtimePrechecked($settings->settings2_proposals_automation_create_tasks ?? '')); ?>

                        name="settings2_proposals_automation_create_tasks" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="settings2_proposals_automation_create_tasks"></label>
                </div>
            </div>


            <!--settings2_proposals_automation_project_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-4 col-form-label text-left"><?php echo app('translator')->get('lang.automation_email_client'); ?> <span
                        class="align-middle text-info font-16" data-toggle="tooltip"
                        title="<?php echo app('translator')->get('lang.automation_email_client_project_info'); ?>" data-placement="top"><i
                            class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-8 text-left p-t-5">
                    <input type="checkbox" id="settings2_proposals_automation_project_email_client"
                        <?php echo e(runtimePrechecked($settings->settings2_proposals_automation_project_email_client ?? '')); ?>

                        name="settings2_proposals_automation_project_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="settings2_proposals_automation_project_email_client"></label>
                </div>
            </div>


        </div>

        <!--[automation option]-->
        <div class="alert alert-info m-b-20 m-t-50">
            <h6><?php echo app('translator')->get('lang.automation_option'); ?></h6> <?php echo app('translator')->get('lang.proposal_automation_info_1'); ?>: <span
                class="align-middle text-info font-16" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.proposal_automation_info_2'); ?>" data-placement="top"><i class="ti-info-alt"></i></span>
        </div>

        <!--settings2_proposals_automation_create_invoice-->
        <div class="form-group form-group-checkbox row m-b-20">
            <div class="col-12">
                <label
                    class="text-left control-label col-form-label p-r-3 required"><?php echo app('translator')->get('lang.automation_create_invoice'); ?></label>
                <span class="text-right p-l-5">
                    <input type="checkbox" id="settings2_proposals_automation_create_invoice"
                        name="settings2_proposals_automation_create_invoice" class="filled-in chk-col-light-blue"
                        <?php echo e(runtimePrechecked($settings->settings2_proposals_automation_create_invoice ?? '')); ?>>
                    <label for="settings2_proposals_automation_create_invoice" class="display-inline"></label>
                </span>
            </div>
        </div>

        <!--invoice creation options-->
        <div class="card-contrast-panel m-l-30 <?php echo e(proposalAutomationVisibility($settings->settings2_proposals_automation_create_invoice)); ?>"
            id="settings_automation_create_invoice_options">

            <!--item-->
            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo app('translator')->get('lang.automation_invoice_due_date'); ?></label>
                <div class="col-sm-12 col-lg-4">
                    <input type="text" class="form-control form-control-sm"
                        id="settings2_proposals_automation_invoice_due_date"
                        name="settings2_proposals_automation_invoice_due_date"
                        value="<?php echo e($settings->settings2_proposals_automation_invoice_due_date ?? ''); ?>">
                </div>
            </div>

            <!--settings2_proposals_automation_invoice_email_client-->
            <div class="form-group form-group-checkbox row">
                <label class="col-sm-12 col-lg-4 col-form-label text-left"><?php echo app('translator')->get('lang.automation_email_client'); ?> <span
                        class="align-middle text-info font-16" data-toggle="tooltip"
                        title="<?php echo app('translator')->get('lang.automation_email_client_invoice_info'); ?>" data-placement="top"><i
                            class="ti-info-alt"></i></span></label>
                <div class="col-sm-12 col-lg-8 text-left p-t-5">
                    <input type="checkbox" id="settings2_proposals_automation_invoice_email_client"
                        <?php echo e(runtimePrechecked($settings->settings2_proposals_automation_invoice_email_client ?? '')); ?>

                        name="settings2_proposals_automation_invoice_email_client" class="filled-in chk-col-light-blue">
                    <label class="p-l-30" for="settings2_proposals_automation_invoice_email_client"></label>
                </div>
            </div>

        </div>

    </div>


    <!--buttons-->
    <div class="text-right">
        <button type="submit" id="commonModalSubmitButton" class="btn btn-rounded-x btn-danger waves-effect text-left ajax-request"
            data-url="/settings/proposals/automation" data-loading-target="" data-ajax-type="PUT" data-type="form"
            data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
    </div>
</form>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/proposals/automation.blade.php ENDPATH**/ ?>