<!-- action buttons -->
<?php echo $__env->make('pages.categories.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="categories-stats-wrapper" class="stats-wrapper card-embed-fix">
    <?php if(@count($categories ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
</div>
<?php endif; ?>
<!--stats panel-->

<!--categories table-->
<div class="card-embed-fix">
    <?php echo $__env->make('pages.categories.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!--categories table--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/categories/tabswrapper.blade.php ENDPATH**/ ?>