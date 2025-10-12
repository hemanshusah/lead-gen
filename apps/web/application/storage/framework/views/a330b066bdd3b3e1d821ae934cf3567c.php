<div class="table-responsive">
    <?php if(@count($roles ?? []) > 0): ?>
    <table id="demo-foo-addrow" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
        <thead>
            <tr>
                <th class="roles_col_name"><?php echo e(cleanLang(__('lang.name'))); ?></th>
                <th class="roles_col_users"><?php echo e(cleanLang(__('lang.active_users'))); ?></th>
                <th class="roles_col_type"><?php echo e(cleanLang(__('lang.type'))); ?></th>
                <th class="roles_col_status"><?php echo e(cleanLang(__('lang.status'))); ?></th>
                <th class="roles_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
            </tr>
        </thead>
        <tbody id="roles-td-container">
            <!--ajax content here-->
            <?php echo $__env->make('pages.settings.sections.roles.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <?php if(@count($roles ?? []) == 0): ?>
    <!--nothing found-->
    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--nothing found-->
    <?php endif; ?>

    <?php if(config('system.settings_type') == 'standalone'): ?>
    <!--[standalone] - settings documentation help-->
    <?php endif; ?>

</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/roles/table/table.blade.php ENDPATH**/ ?>