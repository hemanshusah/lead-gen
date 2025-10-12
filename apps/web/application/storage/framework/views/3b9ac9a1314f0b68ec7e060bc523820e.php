<!--bulk actions-->
<?php echo $__env->make('pages.payments.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.payments.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.payments.components.misc.filter-payments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter-->

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.payments.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/payments/components/table/wrapper.blade.php ENDPATH**/ ?>