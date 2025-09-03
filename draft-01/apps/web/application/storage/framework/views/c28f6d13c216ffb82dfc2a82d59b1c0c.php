<div class="profiletimeline p-t-30" id="timeline-container">
<!--ajax content here-->
<?php echo $__env->make('pages.timeline.components.misc.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--ajax content here-->
</div>

<!--load more-->
<?php if(isset($page['visibility_show_load_more']) && $page['visibility_show_load_more']): ?>
<div class="autoload loadmore-button-container" id="timeline_see_more_button">
    <a data-url="<?php echo e($page['url'] ?? ''); ?>" data-loading-target="timeline-container"
        href="javascript:void(0)" class="btn btn-rounded-x btn-secondary js-ajax-ux-request" id="load-more-button"><?php echo e(cleanLang(__('lang.show_more'))); ?></a>
</div>
<?php endif; ?>
<!--load more--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/timeline/timeline.blade.php ENDPATH**/ ?>