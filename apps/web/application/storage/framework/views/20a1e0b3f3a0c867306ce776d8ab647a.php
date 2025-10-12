<div class="card count-<?php echo e(@count($payments ?? [])); ?>" id="payments-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($payments ?? []) > 0): ?>
            <table id="payments-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.payments_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper payments_col_checkbox">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-payments" name="listcheckbox-payments"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="payments-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-payments">
                                <label for="listcheckbox-payments"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.payments_col_id')): ?>
                        <th class="payments_col_id"><a class="js-ajax-ux-request js-list-sorting" id="sort_payment_id"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?>#<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <th class="payments_col_date"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payment_date" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <?php if(config('visibility.payments_col_invoiceid')): ?>
                        <th class="payments_col_bill_invoiceid"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payment_invoiceid" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_invoiceid&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.invoice'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <th class="payments_col_amount"><a class="js-ajax-ux-request js-list-sorting"
                            id="sort_payment_amount" href="javascript:void(0)"
                            data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_amount&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.amount'))); ?><span
                                class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                    </th>
                        <?php if(config('visibility.payments_col_client')): ?>
                        <th class="payments_col_client"><a class="js-ajax-ux-request js-list-sorting" id="sort_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.client'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.payments_col_project')): ?>
                        <th class="payments_col_project"><a class="js-ajax-ux-request js-list-sorting" id="sort_project"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=project&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.project'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <th class="payments_col_transaction hidden"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payment_transaction_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_transaction_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.transaction_id'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></a>
                        </th>

                        <?php if(config('visibility.payments_col_method')): ?>
                        <th class="payments_col_method"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payment_gateway" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/payments?action=sort&orderby=payment_gateway&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.method'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <?php if(config('visibility.payments_col_action')): ?>
                        <th class="payments_col_action actions_column"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="payments-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.payments.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?>
            <?php if(@count($payments ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/payments/components/table/table.blade.php ENDPATH**/ ?>