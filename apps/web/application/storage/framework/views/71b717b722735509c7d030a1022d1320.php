 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Page Title & Bread Crumbs -->

        <!-- action buttons -->
        <?php echo $__env->make('pages.tickets.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <?php if(auth()->user()->is_team): ?>
    <div id="tickets-stats-wrapper" class="stats-wrapper">
    <?php echo $__env->make('pages.tickets.components.misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php endif; ?>
    <!--stats panel-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--tickets table-->
            <?php echo $__env->make('pages.tickets.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--tickets table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tickets/wrapper.blade.php ENDPATH**/ ?>