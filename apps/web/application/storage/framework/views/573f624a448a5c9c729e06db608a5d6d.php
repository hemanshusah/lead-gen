<div class="row">

    <!--INCOME-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.income', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!--LEADS-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.leads', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!--TICKETS (optional)-->
    <?php echo $__env->make('pages.home.admin.widgets.second-row.tickets', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/home/admin/widgets/second-row/wrapper.blade.php ENDPATH**/ ?>