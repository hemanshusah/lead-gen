<div class="card count-<?php echo e(@count($clients ?? [])); ?>" id="clients-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($clients ?? []) > 0): ?>
            <table id="clients-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <!--tableconfig_column_1 [client_id]-->
                        <th class="col_client_id <?php echo e(config('table.tableconfig_column_1')); ?> tableconfig_column_1">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=client_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_2 [client_company_name]-->
                        <th
                            class="col_client_company_name <?php echo e(config('table.tableconfig_column_2')); ?> tableconfig_column_2">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_company_name"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=client_company_name&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.company_name'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>

                        <!--tableconfig_column_3 [account_owner]-->
                        <th class="col_account_owner <?php echo e(config('table.tableconfig_column_3')); ?> tableconfig_column_3">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_account_owner"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=account_owner&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.account_owner'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>


                        <!--tableconfig_column_4 [count_pending_projects]-->
                        <?php if(config('visibility.modules.projects')): ?>
                        <th
                            class="col_count_pending_projects <?php echo e(config('table.tableconfig_column_4')); ?> tableconfig_column_4">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_pending_projects"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_pending_projects&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.pending_projects'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_5 [count_completed_projects]-->
                        <?php if(config('visibility.modules.projects')): ?>
                        <th
                            class="col_count_completed_projects <?php echo e(config('table.tableconfig_column_5')); ?> tableconfig_column_5">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_completed_projects"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_completed_projects&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.completed_projects'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>


                        <!--tableconfig_column_6 [count_pending_tasks]-->
                        <?php if(config('visibility.modules.tasks')): ?>
                        <th
                            class="col_count_pending_tasks <?php echo e(config('table.tableconfig_column_6')); ?> tableconfig_column_6">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_pending_tasks"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_pending_tasks&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.pending_tasks'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_7 [count_completed_tasks]-->
                        <?php if(config('visibility.modules.tasks')): ?>
                        <th
                            class="col_count_completed_tasks <?php echo e(config('table.tableconfig_column_7')); ?> tableconfig_column_7">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_completed_tasks"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_completed_tasks&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.completed_tasks'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_8 [count_tickets_open]-->
                        <?php if(config('visibility.modules.tickets')): ?>
                        <th
                            class="col_count_tickets_open <?php echo e(config('table.tableconfig_column_8')); ?> tableconfig_column_8">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_open"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_tickets_open&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.open_tickets'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_9 [count_tickets_closed]-->
                        <?php if(config('visibility.modules.tickets')): ?>
                        <th
                            class="col_count_tickets_closed <?php echo e(config('table.tableconfig_column_9')); ?> tableconfig_column_9">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_closed"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_tickets_closed&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.closed_tickets'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_10 [sum_estimates_accepted]-->
                        <?php if(config('visibility.modules.estimates') && config('visibility.role_estimates')): ?>
                        <th
                            class="col_sum_estimates_accepted <?php echo e(config('table.tableconfig_column_10')); ?> tableconfig_column_10">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_estimates_accepted"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_estimates_accepted&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.accepted_estimates'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_11 [sum_estimates_declined]-->
                        <?php if(config('visibility.modules.estimates') && config('visibility.role_estimates')): ?>
                        <th
                            class="col_sum_estimates_declined <?php echo e(config('table.tableconfig_column_11')); ?> tableconfig_column_11">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_estimates_declined"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_estimates_declined&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.declined_estimates'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_12 [sum_invoices_all]-->
                        <?php if(config('visibility.modules.invoices')  && config('visibility.role_invoices')): ?>
                        <th
                            class="col_sum_invoices_all_x <?php echo e(config('table.tableconfig_column_12')); ?> tableconfig_column_12">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_invoices_all_x"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_invoices_all_x&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.invoices'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_13 [sum_all_payments]-->
                        <?php if(config('visibility.modules.payments')  && config('visibility.role_payments')): ?>
                        <th
                            class="col_sum_all_payments <?php echo e(config('table.tableconfig_column_13')); ?> tableconfig_column_13">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_all_payments"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_all_payments&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.payments'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>

                        <?php endif; ?>

                        <!--tableconfig_column_14 [sum_outstanding_balance]-->
                        <?php if(config('visibility.modules.invoices')  && config('visibility.role_invoices')): ?>
                        <th
                            class="col_sum_outstanding_balance <?php echo e(config('table.tableconfig_column_14')); ?> tableconfig_column_14">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_outstanding_balance"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_outstanding_balance&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.unpaid_invoices'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_15 [sum_subscriptions_active]-->
                        <?php if(config('visibility.modules.subscriptions')  && config('visibility.role_subscriptions')): ?>
                        <th
                            class="col_sum_subscriptions_active <?php echo e(config('table.tableconfig_column_15')); ?> tableconfig_column_15">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_subscriptions_active"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_subscriptions_active&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.subscriptions'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_16 [count_proposals_accepted]-->
                        <?php if(config('visibility.modules.proposals')  && config('visibility.role_proposals')): ?>
                        <th
                            class="col_count_proposals_accepted <?php echo e(config('table.tableconfig_column_16')); ?> tableconfig_column_16">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_proposals_accepted"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_proposals_accepted&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.accepted_proposals'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_17 [count_proposals_declined]-->
                        <?php if(config('visibility.modules.proposals')  && config('visibility.role_proposals')): ?>
                        <th
                            class="col_count_proposals_declined <?php echo e(config('table.tableconfig_column_17')); ?> tableconfig_column_17">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_proposals_declined"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_proposals_declined&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.declined_proposals'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_18 [sum_contracts]-->
                        <?php if(config('visibility.modules.contracts')  && config('visibility.role_contracts')): ?>
                        <th class="col_sum_contracts <?php echo e(config('table.tableconfig_column_18')); ?> tableconfig_column_18">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_contracts"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_contracts&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.contracts'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_ 19[sum_hours_worked]-->
                        <?php if(config('visibility.modules.timesheets')  && config('visibility.role_timesheets')): ?>
                        <th
                            class="col_sum_hours_worked <?php echo e(config('table.tableconfig_column_19')); ?> tableconfig_column_19">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_sum_hours_worked"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=sum_hours_worked&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.hours_worked'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_20 [count_tickets_open]-->
                        <?php if(config('visibility.modules.tickets')): ?>
                        <th
                            class="col_count_tickets_open <?php echo e(config('table.tableconfig_column_20')); ?> tableconfig_column_20">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_open"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_tickets_open&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.open_tickets'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_21 [count_tickets_closed]-->
                        <?php if(config('visibility.modules.tickets')): ?>
                        <th
                            class="col_count_tickets_closed <?php echo e(config('table.tableconfig_column_21')); ?> tableconfig_column_21">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_count_tickets_closed"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_tickets_closed&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.closed_tickets'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--tableconfig_column_22 [count_users]-->
                        <th class="col_count_users <?php echo e(config('table.tableconfig_column_22')); ?> tableconfig_column_22"><a
                                class="js-ajax-ux-request js-list-sorting" id="sort_count_users"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=count_users&sortorder=asc')); ?>">
                                <?php echo app('translator')->get('lang.users'); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>


                        <!--tableconfig_column_23 [tags]-->
                        <th class="clients_col_tags <?php echo e(config('table.tableconfig_column_23')); ?> tableconfig_column_23">
                            <a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.tags'))); ?></a>
                        </th>

                        <!--tableconfig_column_24 [category]-->
                        <th class="col_category <?php echo e(config('table.tableconfig_column_24')); ?> tableconfig_column_24">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=category&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.category'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--tableconfig_column_25 [status]-->
                        <th class="col_status <?php echo e(config('table.tableconfig_column_25')); ?> tableconfig_column_25">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_status"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/clients?action=sort&orderby=client_status&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--actions-->
                        <?php if(config('visibility.action_column')): ?>
                        <th class="col_action with-table-config-icon"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a>

                            <!--[tableconfig]-->
                            <div class="table-config-icon">
                                <span class="text-default js-toggle-table-config-panel"
                                    data-target="table-config-clients">
                                    <i class="sl-icon-settings">
                                    </i>
                                </span>
                            </div>
                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="clients-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.clients.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($clients ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/clients/components/table/table.blade.php ENDPATH**/ ?>