<div class="boards count-<?php echo e(@count($leads ?? [])); ?> js-trigger-leads-kanban-board" id="leads-view-wrapper" data-position="<?php echo e(url('leads/update-position')); ?>">
    <!--each board-->
    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!--board-->
    <?php echo $__env->make('pages.leads.components.kanban.board', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/pages/leads/components/kanban/kanban.blade.php ENDPATH**/ ?>