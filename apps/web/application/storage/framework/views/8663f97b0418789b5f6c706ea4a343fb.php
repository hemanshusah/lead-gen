<!--main table view-->
<?php echo $__env->make('pages.leads.components.kanban.kanban', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--Update Card Poistion-->
<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.leads.export', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/leads/components/kanban/wrapper.blade.php ENDPATH**/ ?>