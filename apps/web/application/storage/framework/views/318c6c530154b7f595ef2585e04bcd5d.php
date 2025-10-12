<div class="row">
    <!--PAYMENTS TODAY-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.payments-today', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--PAYMENTS THIS MONTH-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.payments-this-month', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--INVOICES DUE-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.invoices-due', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--INVOICES OVERDUE-->
    <?php echo $__env->make('pages.home.admin.widgets.first-row.invoices-overdue', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/home/admin/widgets/first-row/wrapper.blade.php ENDPATH**/ ?>