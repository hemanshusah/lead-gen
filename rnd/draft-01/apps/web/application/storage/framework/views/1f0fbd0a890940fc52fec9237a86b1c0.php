<!--WIDGET NOTES: stats displayed on top of result tables and list pages-->
<div class="card-group table-stats-cards  <?php echo e(runtimePreferenceStatsPanelPosition(auth()->user()->stats_panel_position)); ?>" id="list-pages-stats-widget">
    <?php echo $__env->make('misc.list-pages-stats-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/misc/list-pages-stats.blade.php ENDPATH**/ ?>