<div class="x-splash-failed-text">
    <?php echo app('translator')->get('lang.you_can_download_sample_files'); ?>
</div>

<!--leads samples-->
<?php if($type == 'leads'): ?>
<div class="x-splash-failed-text">
    <a href="<?php echo e(url('storage/system/samples/import-leads.csv')); ?>" download><?php echo app('translator')->get('lang.csv_sample'); ?></a>
    | <a href="<?php echo e(url('storage/system/samples/import-leads.xlsx')); ?>" download><?php echo app('translator')->get('lang.xlsx_sample'); ?></a>
</div>
<?php endif; ?>

<!--tasks samples-->
<?php if($type == 'tasks'): ?>
<div class="x-splash-failed-text">
    <a href="<?php echo e(url('storage/system/samples/import-tasks.csv')); ?>" download><?php echo app('translator')->get('lang.csv_sample'); ?></a>
    | <a href="<?php echo e(url('storage/system/samples/import-tasks.xlsx')); ?>" download><?php echo app('translator')->get('lang.xlsx_sample'); ?></a>
</div>
<?php endif; ?>

<!--projects samples-->
<?php if($type == 'projects'): ?>
<div class="x-splash-failed-text">
    <a href="<?php echo e(url('storage/system/samples/import-projects.csv')); ?>" download><?php echo app('translator')->get('lang.csv_sample'); ?></a>
    | <a href="<?php echo e(url('storage/system/samples/import-projects.xlsx')); ?>" download><?php echo app('translator')->get('lang.xlsx_sample'); ?></a>
</div>
<?php endif; ?>

<!--clients samples-->
<?php if($type == 'clients'): ?>
<div class="x-splash-failed-text">
    <a href="<?php echo e(url('storage/system/samples/import-clients.csv')); ?>" download><?php echo app('translator')->get('lang.csv_sample'); ?></a>
    | <a href="<?php echo e(url('storage/system/samples/import-clients.xlsx')); ?>" download><?php echo app('translator')->get('lang.xlsx_sample'); ?></a>
</div>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/import/common/samples.blade.php ENDPATH**/ ?>