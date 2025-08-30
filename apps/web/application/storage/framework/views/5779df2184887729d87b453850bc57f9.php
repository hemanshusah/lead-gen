<div class="card count-<?php echo e(@count($timesheets ?? [])); ?>" id="timesheets-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($timesheets ?? []) > 0): ?>
            <table id="timesheets-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.timesheets_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-timesheets" name="listcheckbox-timesheets"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="timesheets-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-timesheets"
                                    <?php echo e(runtimeDisabledTimesheetsCheckboxes(config('visibility.timesheets_disable_actions'))); ?>>
                                <label for="listcheckbox-timesheets"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <th class="timesheets_col_user"><a class="js-ajax-ux-request js-list-sorting" id="sort_user"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=user&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.user'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="timesheets_col_task"><a class="js-ajax-ux-request js-list-sorting" id="sort_task"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=task&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.task'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.timesheets_col_related')): ?>
                        <th class="timesheets_col_related"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_related" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=related&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.project'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <?php if(config('visibility.timesheets_col_recorded_by')): ?>
                        <th class="timesheets_col_recorded_by"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_recorded_by" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=recorded_by&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.recorded_by'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <!--date-->
                        <th class="timesheets_col_start_date"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_start_date" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=start_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                        <!--start time-->
                        <?php if(config('visibility.timesheets_col_start_time')): ?>
                        <th class="timesheets_col_start_time"><a href="javascript:void(0)"><?php echo app('translator')->get('lang.start_time'); ?></a>
                        </th>
                        <?php endif; ?>
                        
                        <!--billing status-->
                        <th class="timesheets_col_billing_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_billing_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=billing_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.invoiced'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>

                        <th class="timesheets_col_time"><a class="js-ajax-ux-request js-list-sorting" id="sort_time"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/timesheets?action=sort&orderby=time&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.time'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.timesheets_col_action')): ?>
                        <th class="timesheets_col_action actions_column"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="timesheets-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.timesheets.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($timesheets ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/timesheets/components/table/table.blade.php ENDPATH**/ ?>