<div class="page-notification">
    <img src="<?php echo e(url('/')); ?>/public/images/no-results-found.png" alt="404" /> 
    <?php if(isset($page['no_results_message']) && $page['no_results_message']): ?>
    <!--sepcified-->
    <div class="title"><?php echo e($page['no_results_message'] ?? ''); ?></div>
    <?php else: ?>
    <!--generic-->
    <div class="title">Ooops - No records were found</div>
    <?php endif; ?> 
    <?php if(isset($page['no_results_sub_message']) && $page['no_results_sub_message']): ?>
    <!--sepcified-->
    <div class="sub-title"><?php echo e($page['no_results_sub_message'] ?? ''); ?></div>
    <?php else: ?>
    <!--generic-->
    <div class="sub-title"><?php echo e(cleanLang(__('lang.try_a_differet_search'))); ?></div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/notifications/no-results-found.blade.php ENDPATH**/ ?>