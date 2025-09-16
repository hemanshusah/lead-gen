<div class="row">
    <!--PAYMENTS TODAY-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.payments-today', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--PAYMENTS THIS MONTH-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.payments-this-month', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--INVOICES DUE-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.invoices-due', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--INVOICES OVERDUE-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.invoices-overdue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/admin/widgets/first-row/wrapper.blade.php ENDPATH**/ ?>