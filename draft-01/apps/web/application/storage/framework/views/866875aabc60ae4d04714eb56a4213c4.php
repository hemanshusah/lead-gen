<div class="card count-<?php echo e(@count($expenses ?? [])); ?>" id="expenses-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($expenses ?? []) > 0): ?>
            <table id="expenses-list-table" class="table m-t-0 m-b-0 table-hover no-wrap expense-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.expenses_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-expenses" name="listcheckbox-expenses"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="expenses-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-expenses">
                                <label for="listcheckbox-expenses"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <th class="expenses_col_id"><a class="js-ajax-ux-request js-list-sorting" id="sort_expense_id"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=expense_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.expenses_col_date')): ?>
                        <th class="expenses_col_date"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_expense_date" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=expense_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.expenses_col_description')): ?>
                        <th class="expenses_col_description"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_expense_description" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=expense_description&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.description'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <!--column visibility-->
                        <?php if(config('visibility.expenses_col_user')): ?>
                        <th class="expenses_col_user"><a class="js-ajax-ux-request js-list-sorting" id="sort_user"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=user&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.user'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <!--column visibility-->
                        <?php if(config('visibility.expenses_col_client')): ?>
                        <th class="expenses_col_client"><a class="js-ajax-ux-request js-list-sorting" id="sort_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.client'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <!--column visibility-->
                        <?php if(config('visibility.expenses_col_project')): ?>
                        <th class="expenses_col_project"><a class="js-ajax-ux-request js-list-sorting" id="sort_project"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=project&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.project'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.expenses_col_amount')): ?>
                        <th class="expenses_col_amount"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_expense_amount" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=expense_amount&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.amount'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.expenses_col_status')): ?>
                        <th class="expenses_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_expense_billing_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/expenses?action=sort&orderby=expense_billing_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.expenses_col_action')): ?>
                        <th class="expenses_col_action actions_column"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="expenses-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.expenses.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($expenses ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/expenses/components/table/table.blade.php ENDPATH**/ ?>