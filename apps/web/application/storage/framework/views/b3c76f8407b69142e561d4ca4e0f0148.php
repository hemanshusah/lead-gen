<!--bulk actions-->
<?php echo $__env->make('pages.items.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.items.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.items.components.misc.filter-items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter-->

<!--automation tasks-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.itemtasks.components.tasks-side-panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--automation tasks-->

<!--export-->
<?php if(config('visibility.list_page_actions_exporting')): ?>
<?php echo $__env->make('pages.export.items.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/items/components/table/wrapper.blade.php ENDPATH**/ ?>