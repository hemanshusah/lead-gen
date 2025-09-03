<div class="count-<?php echo e(@count($projects ?? [])); ?>" id="projects-view-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive list-table-wrapper">
                <?php if(@count($projects ?? []) > 0): ?>
                <table id="projects-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <?php if(config('visibility.projects_col_checkboxes')): ?>
                            <th class="list-checkbox-wrapper">
                                <!--list checkbox-->
                                <span class="list-checkboxes display-inline-block w-px-20">
                                    <input type="checkbox" id="listcheckbox-projects" name="listcheckbox-projects"
                                        class="listcheckbox-all filled-in chk-col-light-blue"
                                        data-actions-container-class="projects-checkbox-actions-container"
                                        data-children-checkbox-class="listcheckbox-projects">
                                    <label for="listcheckbox-projects"></label>
                                </span>
                            </th>
                            <?php endif; ?>
                            <!--tableconfig_column_1 [project_id]-->
                            <th class="projects_col_id <?php echo e(config('table.tableconfig_column_1')); ?> tableconfig_column_1">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_id"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <!--tableconfig_column_2 [project_title]-->
                            <th
                                class="projects_col_project <?php echo e(config('table.tableconfig_column_2')); ?> tableconfig_column_2">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_title"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <!--tableconfig_column_3 [client_company_name]-->
                            <?php if(config('visibility.projects_col_client')): ?>
                            <th
                                class="projects_col_client <?php echo e(config('table.tableconfig_column_3')); ?> tableconfig_column_3">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_client"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.client'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <?php endif; ?>
                            <!--tableconfig_column_4 [project_date_start]-->
                            <th
                                class="projects_col_start_date <?php echo e(config('table.tableconfig_column_4')); ?> tableconfig_column_4">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_date_start"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_date_start&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.start_date'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <!--tableconfig_column_5 [project_date_due]-->
                            <th
                                class="projects_col_end_date <?php echo e(config('table.tableconfig_column_5')); ?> tableconfig_column_5">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_date_due"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_date_due&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.due_date'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <!--tableconfig_column_6 [tags]-->
                            <?php if(config('visibility.projects_col_tags')): ?>
                            <th
                                class="projects_col_tags <?php echo e(config('table.tableconfig_column_6')); ?> tableconfig_column_6">
                                <a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.tags'))); ?></a>
                            </th>
                            <?php endif; ?>
                            <!--tableconfig_column_7 [project_progress]-->
                            <th
                                class="projects_col_progress <?php echo e(config('table.tableconfig_column_7')); ?> tableconfig_column_7">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_progress"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_progress&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.progress'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <!--tableconfig_column_8 [count_pending_tasks]-->
                            <th
                                class="col_count_pending_tasks <?php echo e(config('table.tableconfig_column_8')); ?> tableconfig_column_8">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_count_pending_tasks"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=count_pending_tasks&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.pending_tasks'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                            <!--tableconfig_column_9 [count_completed_tasks]-->
                            <th
                                class="col_count_completed_tasks <?php echo e(config('table.tableconfig_column_9')); ?> tableconfig_column_9">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_count_completed_tasks"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=count_completed_tasks&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.completed_tasks'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                            <!--tableconfig_column_10 [sum_invoices_all]-->
                            <?php if(config('visibility.role_invoices')): ?>
                            <th
                                class="col_sum_invoices_all <?php echo e(config('table.tableconfig_column_10')); ?> tableconfig_column_10">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_invoices_all"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=sum_invoices_all&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.invoices'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_11 [sum_all_payments]-->
                            <?php if(config('visibility.role_payments')): ?>
                            <th
                                class="col_sum_all_payments <?php echo e(config('table.tableconfig_column_11')); ?> tableconfig_column_11">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_all_payments"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=sum_all_payments&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.payments'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_12 [sum_outstanding_balance]-->
                            <?php if(config('visibility.role_invoices')): ?>
                            <th
                                class="col_sum_outstanding_balance <?php echo e(config('table.tableconfig_column_12')); ?> tableconfig_column_12">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_outstanding_balance"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=sum_outstanding_balance&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.unpaid_invoices'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_13 [project_billing_type]-->
                            <?php if(config('visibility.role_invoices')): ?>
                            <th
                                class="col_project_billing_type <?php echo e(config('table.tableconfig_column_13')); ?> tableconfig_column_13">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_billing_type"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_billing_type&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.billing'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_14 [project_billing_estimated_hours]-->
                            <?php if(config('visibility.role_estimates')): ?>
                            <th
                                class="col_project_billing_estimated_hours <?php echo e(config('table.tableconfig_column_14')); ?> tableconfig_column_14">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_billing_estimated_hours"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_billing_estimated_hours&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.estimated_hours'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_15 [project_billing_costs_estimate]-->
                            <?php if(config('visibility.role_estimates')): ?>
                            <th
                                class="col_project_billing_costs_estimate <?php echo e(config('table.tableconfig_column_15')); ?> tableconfig_column_15">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_billing_costs_estimate"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_billing_costs_estimate&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.estimated_cost'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_16 [sum_hours]-->
                            <?php if(config('visibility.role_timesheets')): ?>
                            <th class="col_sum_hours <?php echo e(config('table.tableconfig_column_16')); ?> tableconfig_column_16">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_hours"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=sum_hours&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.hours_worked'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_17 [sum_expenses]-->
                            <?php if(config('visibility.role_expenses')): ?>
                            <th
                                class="col_sum_expenses <?php echo e(config('table.tableconfig_column_17')); ?> tableconfig_column_17">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_expenses"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=sum_expenses&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.expenses'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <?php endif; ?>

                            <!--tableconfig_column_18 [count_files]-->
                            <th
                                class="col_count_files <?php echo e(config('table.tableconfig_column_18')); ?> tableconfig_column_18">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_count_files"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=count_files&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.files'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                            <!--tableconfig_column_19 [count_tickets_open]-->
                            <th
                                class="count_tickets_open <?php echo e(config('table.tableconfig_column_19')); ?> tableconfig_column_19">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_open"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=count_tickets_open&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.open_tickets'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                            <!--tableconfig_column_20 [count_tickets_closed]-->
                            <th
                                class="col_count_tickets_closed <?php echo e(config('table.tableconfig_column_20')); ?> tableconfig_column_20">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_closed"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=count_tickets_closed&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.closed_tickets'); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                            <!--tableconfig_column_21 [assigned]-->
                            <?php if(config('visibility.projects_col_team')): ?>
                            <th
                                class="projects_col_team column_assigned_users <?php echo e(config('table.tableconfig_column_21')); ?> tableconfig_column_21">
                                <a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.team'))); ?></a></th>
                            <?php endif; ?>
                            <!--tableconfig_column_22 [project_status]-->
                            <th
                                class="projects_col_status <?php echo e(config('table.tableconfig_column_22')); ?> tableconfig_column_22">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_project_status"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/projects?action=sort&orderby=project_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <?php if(config('visibility.projects_col_actions')): ?>
                            <th class="projects_col_action with-table-config-icon actions_column"><a
                                    href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a>

                                <!--[tableconfig]-->
                                <div class="table-config-icon">
                                    <span class="text-default js-toggle-table-config-panel"
                                        data-target="table-config-projects">
                                        <i class="sl-icon-settings">
                                        </i>
                                    </span>
                                </div>
                            </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="projects-td-container">
                        <!--ajax content here-->
                        <?php echo $__env->make('pages.projects.views.list.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <!--/ajax content here-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                <!--load more button-->
                                <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <!--/load more button-->
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php endif; ?> <?php if(@count($projects ?? []) == 0): ?>
                <!--nothing found-->
                <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--nothing found-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/projects/views/list/table/table.blade.php ENDPATH**/ ?>