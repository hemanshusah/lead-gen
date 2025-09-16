<div class="row">
    <!--PROJECTS PENDING-->
    <?php echo $__env->make('pages.home.team.widgets.first-row.projects-pending', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--PROJECTS COMPLETED-->
    <?php echo $__env->make('pages.home.team.widgets.first-row.tasks-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--INVOICES DUE-->
    <?php echo $__env->make('pages.home.team.widgets.first-row.tasks-inprogress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--INVOICES OVERDUE-->
    <?php echo $__env->make('pages.home.team.widgets.first-row.tasks-feedback', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/team/widgets/first-row/wrapper.blade.php ENDPATH**/ ?>