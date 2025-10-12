<!--bulk actions-->
<?php echo $__env->make('pages.proposals.components.actions.checkbox-actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.proposals.components.table.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.proposals.components.misc.filter-proposals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/proposals/components/table/wrapper.blade.php ENDPATH**/ ?>