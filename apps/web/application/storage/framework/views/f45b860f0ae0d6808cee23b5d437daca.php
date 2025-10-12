<!--bulk actions-->
<?php echo $__env->make('pages.leads.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--custom table view-->
<?php echo $__env->make('pages.leads.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.leads.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/table/wrapper.blade.php ENDPATH**/ ?>