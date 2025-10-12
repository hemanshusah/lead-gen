 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--admin dashboard-->
    <?php if(auth()->user()->is_team): ?>
    <?php if(auth()->user()->is_admin): ?>
    <?php echo $__env->make('pages.home.admin.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
    <?php echo $__env->make('pages.home.team.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->user()->is_client): ?>
    <?php echo $__env->make('pages.home.client.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>



</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/home/home.blade.php ENDPATH**/ ?>