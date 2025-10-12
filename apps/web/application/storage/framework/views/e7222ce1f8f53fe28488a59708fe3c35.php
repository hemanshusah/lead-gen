
<?php $__env->startSection('settings-page'); ?>

<!--error logs-->
<?php if(@count($logs ?? []) > 0): ?>
<div class="row">
    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-12 col-md-4 col-lg-3" id="logfile_<?php echo e($key); ?>">
        <div class="error-log">
            <h6><?php echo e($log->getFilename()); ?></h6>
            <a type="button" href="<?php echo e(url('settings/errorlogs/download?filename='.$log->getFilename())); ?>"
                class="btn btn-primary btn-xs" download><i class="fa fa-check"></i>
                <?php echo app('translator')->get('lang.download'); ?> - (<?php echo e(humanFileSize($log->getSize())); ?>)
            </a>
            <input type="hidden" name="filename" value="<?php echo e($log->getFilename()); ?>">
            <button type="button" class="btn btn-danger btn-sm btn-xs confirm-action-danger"
                data-confirm-title="<?php echo app('translator')->get('lang.delete_item'); ?>" data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
                data-ajax-type="DELETE"
                data-url="<?php echo e(url('settings/errorlogs/delete?key='.$key.'&filename='.$log->getFilename())); ?>">
                <?php echo app('translator')->get('lang.delete'); ?>
            </button>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="alert alert-info m-t-30">
    <h5 class="text-info"><i class="sl-icon-info"></i> <?php echo app('translator')->get('lang.info'); ?></h5><?php echo app('translator')->get('lang.you_can_delete_these_files'); ?>
</div>
<?php endif; ?>
<?php if(@count($logs ?? []) == 0): ?>
<!--nothing found-->
<?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--nothing found-->
<?php endif; ?>

<?php if(config('system.settings_type') == 'standalone'): ?>
<!--[standalone] - settings documentation help-->
<a href="https://demo.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
        class="ti-info-alt"></i>
    <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

</a>
<?php endif; ?>

<!--section js resource-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.settings.ajaxwrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/errorlogs/page.blade.php ENDPATH**/ ?>