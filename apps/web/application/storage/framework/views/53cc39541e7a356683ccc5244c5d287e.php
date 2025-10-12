
<?php $__env->startSection('settings-page'); ?>
<!-- action buttons -->
<?php echo $__env->make('pages.settings.sections.leads.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--heading-->
<?php echo $__env->make('pages.settings.sections.leads.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/leads/table/page.blade.php ENDPATH**/ ?>