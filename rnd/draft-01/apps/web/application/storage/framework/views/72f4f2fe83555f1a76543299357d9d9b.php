<div class="card count-<?php echo e(@count($leads ?? [])); ?>" id="leads-view-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($leads ?? []) > 0): ?>
            <table id="leads-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.leads_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-leads" name="listcheckbox-leads"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="leads-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-leads">
                                <label for="listcheckbox-leads"></label>
                            </span>
                        </th>
                        <?php endif; ?>

                        <!--tableconfig_column_1 [lead_firstname lead_lastname]-->
                        <th class="col_lead_firstname <?php echo e(config('table.tableconfig_column_1')); ?> tableconfig_column_1">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_firstname"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_firstname&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.contact'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_2 [lead_title]-->
                        <th class="col_lead_title <?php echo e(config('table.tableconfig_column_2')); ?> tableconfig_column_2">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_title" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_3 [lead_created]-->
                        <th class="col_lead_created <?php echo e(config('table.tableconfig_column_3')); ?> tableconfig_column_3">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_created"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_created&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.created'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_4 [lead_value]-->
                        <th class="col_lead_value <?php echo e(config('table.tableconfig_column_4')); ?> tableconfig_column_4">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_value" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_value&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.value'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_6 [lead_assigned]-->
                        <th class="col_lead_assigned <?php echo e(config('table.tableconfig_column_6')); ?> tableconfig_column_6">
                            <a href="javascript:void(0);"><?php echo e(cleanLang(__('lang.assigned'))); ?></a></th>


                        <!--tableconfig_column_7 [lead_category_name]-->
                        <th
                            class="col_lead_category_name <?php echo e(config('table.tableconfig_column_7')); ?> tableconfig_column_7">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_category_name"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_category_name&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.category'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_5 [lead_status]-->
                        <th class="col_lead_status <?php echo e(config('table.tableconfig_column_5')); ?> tableconfig_column_5">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_status"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_status&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.status'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_8 [lead_company_name]-->
                        <th
                            class="col_lead_company_name <?php echo e(config('table.tableconfig_column_8')); ?> tableconfig_column_8">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_company_name"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_company_name&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.company'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_9 [lead_email]-->
                        <th class="col_lead_email <?php echo e(config('table.tableconfig_column_9')); ?> tableconfig_column_9">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_email" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_email&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.email'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_10 [lead_phone]-->
                        <th class="col_lead_phone <?php echo e(config('table.tableconfig_column_10')); ?> tableconfig_column_10">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_phone" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_phone&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.phone'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_11 [lead_job_position]-->
                        <th
                            class="col_lead_job_position <?php echo e(config('table.tableconfig_column_11')); ?> tableconfig_column_11">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_job_position"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_job_position&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.position'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_12 [lead_city]-->
                        <th class="col_lead_city <?php echo e(config('table.tableconfig_column_12')); ?> tableconfig_column_12">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_city" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_city&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.city'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_13 [lead_state]-->
                        <th class="col_lead_state <?php echo e(config('table.tableconfig_column_13')); ?> tableconfig_column_13">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_state" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_state&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.state'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_14 [lead_zip]-->
                        <th class="col_lead_zip <?php echo e(config('table.tableconfig_column_14')); ?> tableconfig_column_14">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_zip" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_zip&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.zipcode'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>

                        <!--tableconfig_column_15 [lead_country]-->
                        <th class="col_lead_country <?php echo e(config('table.tableconfig_column_15')); ?> tableconfig_column_15">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_country"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_country&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.country'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_16 [lead_last_contacted]-->
                        <th
                            class="col_lead_last_contacted <?php echo e(config('table.tableconfig_column_16')); ?> tableconfig_column_16">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_last_contacted"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_last_contacted&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.last_contacted'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_17 [lead_converted_by_userid]-->
                        <th
                            class="col_lead_converted_by_userid <?php echo e(config('table.tableconfig_column_17')); ?> tableconfig_column_17">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_converted_by_userid"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_converted_by_userid&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.converted_by'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_18 [lead_converted_date]-->
                        <th
                            class="col_lead_converted_date <?php echo e(config('table.tableconfig_column_18')); ?> tableconfig_column_18">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_converted_date"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_converted_date&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.date_converted'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--tableconfig_column_19 [lead_source]-->
                        <th class="col_lead_source <?php echo e(config('table.tableconfig_column_19')); ?> tableconfig_column_19">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lead_source"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/leads?action=sort&orderby=lead_source&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.source'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </a>
                        </th>


                        <!--[actions]-->
                        <th class="leads_col_action with-table-config-icon"><a href="javascript:void(0)">
                                <?php echo e(cleanLang(__('lang.action'))); ?></a>

                            <!--[tableconfig]-->
                            <div class="table-config-icon">
                                <span class="text-default js-toggle-table-config-panel"
                                    data-target="table-config-leads">
                                    <i class="sl-icon-settings">
                                    </i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="leads-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.leads.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($leads ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/table/table.blade.php ENDPATH**/ ?>