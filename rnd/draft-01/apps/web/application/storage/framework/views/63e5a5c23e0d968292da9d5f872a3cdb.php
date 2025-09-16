<div class="card count-<?php echo e(@count($estimates ?? [])); ?>" id="estimates-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($estimates ?? []) > 0): ?>
            <table id="estimates-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.estimates_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-estimates" name="listcheckbox-estimates"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="estimates-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-estimates">
                                <label for="listcheckbox-estimates"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <th class="estimates_col_id"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_estimateid" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=bill_estimateid&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="estimates_col_date"><a class="js-ajax-ux-request js-list-sorting" id="sort_bill_date"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=bill_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.estimates_col_client')): ?>
                        <th class="estimates_col_company"><a class="js-ajax-ux-request js-list-sorting" id="sort_client"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.company_name'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>
                        <?php if(config('visibility.estimates_col_created_by')): ?>
                        <th class="estimates_col_created_by"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_created_by" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=created_by&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.created_by'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>

                        <th class="estimates_col_category"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_category" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=category&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.category'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>


                        <?php if(config('visibility.estimates_col_expires')): ?>
                        <th class="estimates_col_expires"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_expiry_date" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=bill_expiry_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.expires'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>
                        <?php if(config('visibility.estimates_col_tags')): ?>
                        <th class="estimates_col_tags"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.tags'))); ?></a>
                        </th>
                        <?php endif; ?>
                        <th class="estimates_col_amount"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_final_amount" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=bill_final_amount&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.amount'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="estimates_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_bill_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/estimates?action=sort&orderby=bill_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.estimates_col_action')): ?>
                        <th class="estimates_col_action actions_column"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="estimates-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.estimates.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($estimates ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/estimates/components/table/table.blade.php ENDPATH**/ ?>