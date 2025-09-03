<!--modified Laravel Pagination Template: https://laravel.com/docs/8.x/pagination-->
<?php if($paginator->hasPages()): ?>
<nav>
    <ul class="pagination">

        <!--previous link-->
        
        <?php if($paginator->onFirstPage()): ?>
        <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('previous'); ?>">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
        <?php else: ?>
        <li class="page-item">
            <a class="page-link ajax-request" href="javascript:void(0);"
                data-type="form" 
                data-ajax-type="POST"
                data-form-id="reports-list-page-filter-form"
                data-url="<?php echo e($paginator->previousPageUrl()); ?>"
                rel="prev"
                aria-label="<?php echo app('translator')->get('previous'); ?>">&lsaquo;</a>
        </li>
        <?php endif; ?>



        <!--each page buttons-->
        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <?php if(is_string($element)): ?>
        <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?php echo e($element); ?></span></li>
        <?php endif; ?>

        
        <?php if(is_array($element)): ?>
        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($page == $paginator->currentPage()): ?>
        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo e($page); ?></span></li>
        <?php else: ?>
        <li class="page-item">
            <a class="page-link ajax-request" 
            href="javascript:void(0);"
            data-ajax-type="POST"
            data-type="form" 
            data-form-id="reports-list-page-filter-form"
            data-url="<?php echo e($url); ?>" ><?php echo e($page); ?>

            </a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!--next link-->
        
        <?php if($paginator->hasMorePages()): ?>
        <li class="page-item">
            <a class="page-link ajax-request" 
            href="javascript:void(0);"
            data-type="form" 
            data-ajax-type="POST"
            data-form-id="reports-list-page-filter-form"
            data-url="<?php echo e($paginator->nextPageUrl()); ?>" 
            rel="next"
            aria-label="<?php echo app('translator')->get('next'); ?>">&rsaquo;</a>
        </li>
        <?php else: ?>
        <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('next'); ?>">
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reports/components/misc/pagination.blade.php ENDPATH**/ ?>