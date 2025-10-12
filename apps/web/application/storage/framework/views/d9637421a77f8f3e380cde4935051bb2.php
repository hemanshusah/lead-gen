<!--bulk actions-->
<?php echo $__env->make('pages.expenses.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.expenses.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.expenses.components.misc.filter-expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter-->

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.expenses.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/expenses/components/table/wrapper.blade.php ENDPATH**/ ?>