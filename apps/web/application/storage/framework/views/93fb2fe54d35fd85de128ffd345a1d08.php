<?php
   $page['meta_title'] = __('lang.error_404');
?>

<?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">
    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <div class="permision-denied">
                <img src="<?php echo e(url('/')); ?>/public/images/404.png" alt="404 - Not found" /> 
                <div class="x-message"><h2><?php echo e($error['message'] ?? __('lang.error_not_found')); ?></h2></div>
            </div>
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make(Auth::user() ? 'layout.wrapper' : 'layout.wrapperplain', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/arochan/Desktop/personal/lead-gen/apps/web/application/resources/views/errors/404.blade.php ENDPATH**/ ?>