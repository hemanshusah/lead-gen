<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="timesheets-checkbox-actions-container">
    <!--button-->
    <?php if(config('visibility.action_buttons_delete')): ?>
    <div class="x-buttons">
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger" 
                data-type="form"
                data-ajax-type="POST" 
                data-form-id="timesheets-list-table" 
                data-url="<?php echo e(url('/timesheets/delete?type=bulk')); ?>"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_selected_items'))); ?>" 
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                id="checkbox-actions-delete-timesheets">
            <i class="sl-icon-trash"></i> <?php echo e(cleanLang(__('lang.delete'))); ?>

        </button>
    </div>
    <?php else: ?>
    <div class="x-notice">
        <?php echo e(cleanLang(__('lang.no_actions_available'))); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/timesheets/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>