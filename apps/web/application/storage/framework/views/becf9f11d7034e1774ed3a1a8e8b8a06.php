<!--bulk actions-->
<?php echo $__env->make('pages.leads.components.actions.checkbox-actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--custom table view-->
<?php echo $__env->make('pages.leads.components.table.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.leads.export', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/leads/components/table/wrapper.blade.php ENDPATH**/ ?>