<!-- right-sidebar -->
<div class="right-sidebar right-sidebar-export sidebar-lg" id="sidepanel-export-tasks">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="ti-export display-inline-block m-t--11 p-r-10"></i><?php echo e(cleanLang(__('lang.export_tasks'))); ?>

                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-export-tasks"></i>
                </span>
            </div>

            <!--body-->
            <div class="r-panel-body p-l-35 p-r-35">

                <!--standard fields-->
                <div class="">
                    <h5><?php echo app('translator')->get('lang.standard_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    <!--task id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_id]" name="standard_field[task_id]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[task_id]"><?php echo app('translator')->get('lang.id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--title-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_title]" name="standard_field[task_title]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30" for="standard_field[task_title]"><?php echo app('translator')->get('lang.title'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--start date-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_date_start]"
                                    name="standard_field[task_date_start]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_date_start]"><?php echo app('translator')->get('lang.start_date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--due date-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_date_due]"
                                    name="standard_field[task_date_due]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[task_date_due]"><?php echo app('translator')->get('lang.due_date'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--description-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_description]"
                                    name="standard_field[task_description]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_description]"><?php echo app('translator')->get('lang.description'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--task assigned-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_assigned]"
                                    name="standard_field[task_assigned]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[task_assigned]"><?php echo app('translator')->get('lang.assigned'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--creatorid-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_creatorid]"
                                    name="standard_field[task_creatorid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_creatorid]"><?php echo app('translator')->get('lang.created_by'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--client-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_clientid]"
                                    name="standard_field[task_clientid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_clientid]"><?php echo app('translator')->get('lang.client_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--client_name-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_client]"
                                    name="standard_field[task_client]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_client]"><?php echo app('translator')->get('lang.client_name'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--project id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_projectid]"
                                    name="standard_field[task_projectid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_projectid]"><?php echo app('translator')->get('lang.project_id'); ?></label>
                            </div>
                        </div>
                    </div>


                    <!--project-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_project]"
                                    name="standard_field[task_project]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_project]"><?php echo app('translator')->get('lang.project_title'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--milestone-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_milestoneid]"
                                    name="standard_field[task_milestoneid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_milestoneid]"><?php echo app('translator')->get('lang.milestone'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--priority-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_priority]"
                                    name="standard_field[task_priority]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[task_priority]"><?php echo app('translator')->get('lang.priority'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_status]"
                                    name="standard_field[task_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[task_status]"><?php echo app('translator')->get('lang.status'); ?></label>
                            </div>
                        </div>
                    </div>
                    <!--billable-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_billable]"
                                    name="standard_field[task_billable]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30" for="standard_field[task_billable]"><?php echo app('translator')->get('lang.billable'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--billing status-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_billable_status]"
                                    name="standard_field[task_billable_status]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_billable_status]"><?php echo app('translator')->get('lang.billing_status'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--invoice id-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_billable_invoiceid]"
                                    name="standard_field[task_billable_invoiceid]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_billable_invoiceid]"><?php echo app('translator')->get('lang.invoice_id'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--recurring-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring]"
                                    name="standard_field[task_recurring]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring]"><?php echo app('translator')->get('lang.recurring'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--recurring duration-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_duration]"
                                    name="standard_field[task_recurring_duration]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_duration]"><?php echo app('translator')->get('lang.duration'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--recurring period-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_period]"
                                    name="standard_field[task_recurring_period]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_period]"><?php echo app('translator')->get('lang.period'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--cycles-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_cycles]"
                                    name="standard_field[task_recurring_cycles]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_cycles]"><?php echo app('translator')->get('lang.cycles'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--cycle counter-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_cycles_counter]"
                                    name="standard_field[task_recurring_cycles_counter]"
                                    class="filled-in chk-col-light-blue" checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_cycles_counter]"><?php echo app('translator')->get('lang.recurred_counter'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--last recurring-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_last]"
                                    name="standard_field[task_recurring_last]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_last]"><?php echo app('translator')->get('lang.last_recurred'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--next recurring-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_next]"
                                    name="standard_field[task_recurring_next]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_next]"><?php echo app('translator')->get('lang.next_recurring'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!--recurring parent-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="standard_field[task_recurring_parent_id]"
                                    name="standard_field[task_recurring_parent_id]" class="filled-in chk-col-light-blue"
                                    checked="checked">
                                <label class="p-l-30"
                                    for="standard_field[task_recurring_parent_id]"><?php echo app('translator')->get('lang.recurring_parent_id'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--custom fields-->
                <div class="m-t-30">
                    <h5><?php echo app('translator')->get('lang.custom_fields'); ?></h5>
                </div>
                <div class="line"></div>
                <div class="row">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($field->customfields_title): ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group form-group-checkbox row">
                            <div class="col-12 p-t-5">
                                <input type="checkbox" id="custom_field[<?php echo e($field->customfields_name); ?>]"
                                    class="filled-in chk-col-light-blue toggle-all-checkbox"
                                    name="custom_field[<?php echo e($field->customfields_name); ?>]">
                                <label class="p-l-30"
                                    for="custom_field[<?php echo e($field->customfields_name); ?>]"><?php echo e($field->customfields_title); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                        id="export-tasks-button" data-url="<?php echo e(urlResource('/export/tasks?')); ?>" data-type="form"
                        data-ajax-type="POST" data-button-loading-annimation="yes">
                        <?php echo app('translator')->get('lang.export'); ?>
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/export/tasks/export.blade.php ENDPATH**/ ?>