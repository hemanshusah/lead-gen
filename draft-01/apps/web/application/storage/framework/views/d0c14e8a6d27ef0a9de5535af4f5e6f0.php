<div class="card count-<?php echo e(@count($categories ?? [])); ?>" id="categories-table-wrapper"
    data-payload="<?php echo e(request('filter_category_type')); ?>">
    <div class="card-body">
        <div class="table-responsive">
            <?php if(@count($categories ?? []) > 0): ?>
            <table id="demo-foo-addrow" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="categories_col_name"><?php echo e(cleanLang(__('lang.name'))); ?></th>

                        <?php if(config('visibility.categories_col_created_by')): ?>
                        <th class="categories_col_created_by"><?php echo e(cleanLang(__('lang.created_by'))); ?></th>
                        <?php endif; ?>

                        <?php if(config('visibility.categories_col_date')): ?>
                        <th class="categories_col_date"><?php echo e(cleanLang(__('lang.date_created'))); ?></th>
                        <?php endif; ?>

                        <?php if(config('visibility.categories_col_date')): ?>
                        <th class="categories_col_items"><?php echo e(cleanLang(__('lang.items'))); ?></th>
                        <?php endif; ?>
                        <!--ticket email piping-->
                        <?php if(config('visibility.categories_col_email_piping')): ?>
                        <th class="categories_col_email_piping"><?php echo app('translator')->get('lang.email_integration'); ?> <span
                                class="align-middle text-info font-16" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.department_email_integration_info'); ?> (<?php echo app('translator')->get('lang.this_feature_is_optional'); ?>)"
                                data-placement="top"><i class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_last_checked"><?php echo app('translator')->get('lang.email_last_checked'); ?> <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="<?php echo app('translator')->get('lang.email_last_checked_info'); ?>" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_last_fetched_count"><?php echo app('translator')->get('lang.email_last_fetched_count'); ?> <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="<?php echo app('translator')->get('lang.email_last_fetched_count_info'); ?>" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        <th class="categories_col_email_total_count"><?php echo app('translator')->get('lang.email_fetched_count'); ?> <span
                                class="align-middle text-info font-16" data-toggle="tooltip"
                                title="<?php echo app('translator')->get('lang.email_fetched_count_info'); ?>" data-placement="top"><i
                                    class="ti-info-alt"></i></span></th>
                        <?php endif; ?>
                        <?php if(request('filter_category_type')=='project'): ?>
                        <th class="categories_col_users"><?php echo e(cleanLang(__('lang.team'))); ?></th>
                        <?php endif; ?>
                        <th class="categories_col_action"><a
                                href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="categories-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.categories.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php if(@count($categories ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>

            <!--email integration is optional-->
            <?php if(config('visibility.categories_col_email_piping')): ?>
            <div class="alert alert-info"><?php echo app('translator')->get('lang.email_integration_optional'); ?></div>
            <?php endif; ?>

            <?php if(config('system.settings_type') == 'standalone'): ?>
            <!--[standalone] - settings documentation help-->
            <?php endif; ?>

        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/categories/components/table/table.blade.php ENDPATH**/ ?>