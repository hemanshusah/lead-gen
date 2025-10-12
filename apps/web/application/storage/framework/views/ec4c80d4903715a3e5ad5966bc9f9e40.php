 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--admin dashboard-->
    <?php if(auth()->user()->is_team): ?>
    <?php if(auth()->user()->is_admin): ?>
    <?php echo $__env->make('pages.home.admin.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
    <?php echo $__env->make('pages.home.team.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->user()->is_client): ?>
    <?php echo $__env->make('pages.home.client.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>



</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/home/home.blade.php ENDPATH**/ ?>