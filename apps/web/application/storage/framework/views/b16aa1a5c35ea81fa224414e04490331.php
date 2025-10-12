 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        <?php echo $__env->make('misc.heading-crumbs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        <?php echo $__env->make('pages.proposals.components.misc.list-page-actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    <?php if(auth()->user()->is_team): ?>
    <div class="stats-wrapper" id="proposals-stats-wrapper">
        <?php echo $__env->make('misc.list-pages-stats', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <?php endif; ?>
    <!--stats panel-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--proposals table-->
            <?php echo $__env->make('pages.proposals.components.table.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!--proposals table-->
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/proposals/wrapper.blade.php ENDPATH**/ ?>