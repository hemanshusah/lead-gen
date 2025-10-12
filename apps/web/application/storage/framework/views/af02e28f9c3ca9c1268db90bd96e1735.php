<div class="card count-<?php echo e(@count($subscriptions ?? [])); ?>" id="subscriptions-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($subscriptions ?? []) > 0): ?>
            <table id="subscription-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="subscriptions_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_subscription_id"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=subscription_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?>

                                #<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php if(config('visibility.subscriptions_col_client')): ?>
                        <th class="subscriptions_col_company">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=client&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.client_name'))); ?>

                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <?php endif; ?>
                        <th class="subscriptions_col_plan">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_plan" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=plan&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.plan'))); ?>

                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="subscriptions_col_amount">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_amount" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=amount&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.amount'))); ?>

                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="subscriptions_col_renewed"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_date_renewed" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=date_renewed&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.renewed'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <th class="subscriptions_col_payments"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_payments" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=payments&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.payments'))); ?>

                                <span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="subscriptions_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/subscriptions?action=sort&orderby=status&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i
                                        class="ti-arrows-vertical"></i></span></a></th>
                        <th class="subscriptions_col_action"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="subscriptions-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.subscriptions.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($subscriptions ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/subscriptions/components/table/table.blade.php ENDPATH**/ ?>