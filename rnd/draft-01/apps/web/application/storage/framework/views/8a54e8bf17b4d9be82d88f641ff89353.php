<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-projects">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_projects'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-projects"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5><?php echo app('translator')->get('lang.standard_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">

                    <!--project_id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_id]" name="standard_field[project_id]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[project_id]"><?php echo app('translator')->get('lang.id'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project_created-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_created]"
                                    name="standard_field[project_created]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_created]"><?php echo app('translator')->get('lang.date_created'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project_title-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_title]"
                                    name="standard_field[project_title]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[project_title]"><?php echo app('translator')->get('lang.title'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project_status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_status]"
                                    name="standard_field[project_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[project_status]"><?php echo app('translator')->get('lang.status'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_clientid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_clientid]"
                                    name="standard_field[project_clientid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_clientid]"><?php echo app('translator')->get('lang.client_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_client_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_client_name]"
                                    name="standard_field[project_client_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_client_name]"><?php echo app('translator')->get('lang.client_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_created_by-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_created_by]"
                                    name="standard_field[project_created_by]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_created_by]"><?php echo app('translator')->get('lang.created_by'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_category_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_category_name]"
                                    name="standard_field[project_category_name]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_category_name]"><?php echo app('translator')->get('lang.category'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project_date_start-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_date_start]"
                                    name="standard_field[project_date_start]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_date_start]"><?php echo app('translator')->get('lang.start_date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_date_due-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_date_due]"
                                    name="standard_field[project_date_due]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_date_due]"><?php echo app('translator')->get('lang.due_date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_description-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_description]"
                                    name="standard_field[project_description]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_description]"><?php echo app('translator')->get('lang.description'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project_progress-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_progress]"
                                    name="standard_field[project_progress]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_progress]"><?php echo app('translator')->get('lang.progress'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_billing_type-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_billing_type]"
                                    name="standard_field[project_billing_type]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_billing_type]"><?php echo app('translator')->get('lang.billing_type'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_billing_estimated_hours-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_billing_estimated_hours]"
                                    name="standard_field[project_billing_estimated_hours]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_billing_estimated_hours]"><?php echo app('translator')->get('lang.estimated_hours'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_billing_costs_estimate-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_billing_costs_estimate]"
                                    name="standard_field[project_billing_costs_estimate]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_billing_costs_estimate]"><?php echo app('translator')->get('lang.estimated_cost'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_visibility-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_visibility]"
                                    name="standard_field[project_visibility]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_visibility]"><?php echo app('translator')->get('lang.visibility'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_tasks_all-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_tasks_all]"
                                    name="standard_field[project_tasks_all]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_tasks_all]"><?php echo app('translator')->get('lang.all_tasks'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_tasks_due-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_tasks_due]"
                                    name="standard_field[project_tasks_due]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_tasks_due]"><?php echo app('translator')->get('lang.due_tasks'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_tasks_completed-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_tasks_completed]"
                                    name="standard_field[project_tasks_completed]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_tasks_completed]"><?php echo app('translator')->get('lang.completed_tasks'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_invoices_all-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_invoices_all]"
                                    name="standard_field[project_sum_invoices_all]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_invoices_all]"><?php echo app('translator')->get('lang.all_invoices'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_invoices_due-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_invoices_due]"
                                    name="standard_field[project_sum_invoices_due]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_invoices_due]"><?php echo app('translator')->get('lang.due_invoices'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_invoices_overdue-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_invoices_overdue]"
                                    name="standard_field[project_sum_invoices_overdue]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_invoices_overdue]"><?php echo app('translator')->get('lang.overdue_invoices'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_invoices_paid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_invoices_paid]"
                                    name="standard_field[project_sum_invoices_paid]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_invoices_paid]"><?php echo app('translator')->get('lang.paid_invoices'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_payments-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_payments]"
                                    name="standard_field[project_sum_payments]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_payments]"><?php echo app('translator')->get('lang.payments'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project_sum_expenses-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[project_sum_expenses]"
                                    name="standard_field[project_sum_expenses]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[project_sum_expenses]"><?php echo app('translator')->get('lang.expenses'); ?></label>
                            </div>
                        </div>
                    </div>

                </div>

                <!--custon fields-->
                <div class="m-t-30">
                    <h5><?php echo app('translator')->get('lang.custom_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    name="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="custom_field[<?php echo e($field->customfields_name); ?>]"><?php echo e($field->customfields_title); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>


                <!--buttons-->
                <div class="buttons-block">

                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button" id="export-projects-button"
                        data-url="<?php echo e(urlResource('/export/projects?')); ?>" data-type="form" data-ajax-type="POST"
                        data-button-loading-annimation="yes"><?php echo app('translator')->get('lang.export'); ?></button>
                </div>
            </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/projects/export.blade.php ENDPATH**/ ?>