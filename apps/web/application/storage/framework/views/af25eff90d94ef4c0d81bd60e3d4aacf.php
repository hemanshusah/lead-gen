<div class="card count-<?php echo e(@count($items ?? [])); ?>" id="items-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($items ?? []) > 0): ?>
            <table id="items-list-table" class="table m-t-0 m-b-0 table-hover no-wrap item-list" data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.items_col_checkboxes')): ?>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-items" name="listcheckbox-items"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="items-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-items">
                                <label for="listcheckbox-items"></label>
                            </span>
                        </th>
                        <?php endif; ?>
                        <th class="items_col_description"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_item_description" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_description&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.description'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="items_col_rate"><a class="js-ajax-ux-request js-list-sorting" id="sort_item_rate"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_rate&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.rate'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="items_col_unit"><a class="js-ajax-ux-request js-list-sorting" id="sort_item_unit"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=item_unit&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.unit'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php if(config('visibility.items_col_category')): ?>
                        <th class="items_col_category"><a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=category&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.category'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <?php endif; ?>

                        <!--count sold-->
                        <th class="items_col_count_sold"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_count_sold" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=count_sold&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.number_sold'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <!--sum sold-->
                        <th class="items_col_amount_sold"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_amount_sold" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/items?action=sort&orderby=amount_sold&sortorder=asc')); ?>"><?php echo app('translator')->get('lang.amount_sold'); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>


                        <?php if(config('visibility.items_col_action')): ?>
                        <th class="items_col_action actions_column"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a>
                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="items-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.items.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->

                    <!--bulk actions - change category-->
                    <input type="hidden" name="checkbox_actions_items_category" id="checkbox_actions_items_category">
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
            <?php endif; ?> <?php if(@count($items ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/items/components/table/table.blade.php ENDPATH**/ ?>