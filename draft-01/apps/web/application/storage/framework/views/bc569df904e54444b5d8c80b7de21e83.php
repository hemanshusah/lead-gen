<!--bulk actions-->
<?php echo $__env->make('pages.contacts.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.contacts.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.contacts.components.misc.filter-contacts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/contacts/components/table/wrapper.blade.php ENDPATH**/ ?>