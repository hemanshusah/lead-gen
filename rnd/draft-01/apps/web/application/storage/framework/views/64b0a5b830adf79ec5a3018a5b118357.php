<!-- dynamic load more button-->
<?php if(isset($page['visibility_show_load_more']) && $page['visibility_show_load_more']): ?>
<div class="autoload loadmore-button-container" id="team_see_more_button">
    <a data-url="<?php echo e($page['url'] ?? ''); ?>" data-loading-target="<?php echo e($page['loading_target'] ?? ''); ?>"
        href="javascript:void(0)" class="btn btn-rounded btn-secondary js-ajax-ux-request" id="load-more-button"><?php echo e(cleanLang(__('lang.show_more'))); ?></a>
</div>
<?php endif; ?>
<!-- /#dynamic load more button--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/misc/load-more-button.blade.php ENDPATH**/ ?>