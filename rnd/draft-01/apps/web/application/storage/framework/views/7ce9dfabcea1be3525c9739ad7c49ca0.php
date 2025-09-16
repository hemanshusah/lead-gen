<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="proposals-checkbox-actions-container">
    <!--button-->
    <?php if(config('visibility.action_buttons_edit')): ?>
    <div class="x-buttons">
        <?php if(config('visibility.action_buttons_delete')): ?>
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="proposals-list-table" data-url="<?php echo e(url('/proposals/delete')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_selected_items'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
            id="checkbox-actions-delete-proposals">
            <i class="sl-icon-trash"></i> <?php echo e(cleanLang(__('lang.delete'))); ?>

        </button>
        <?php endif; ?>
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo e(cleanLang(__('lang.change_category'))); ?>"
            data-url="<?php echo e(urlResource('/proposals/change-category')); ?>" 
            data-action-url="<?php echo e(urlResource('/proposals/change-category')); ?>"
            data-action-method="POST" data-action-type="form" data-action-form-id="main-body"
            data-loading-target="actionsModalBody" data-skip-checkboxes-reset="TRUE"
            id="checkbox-actions-change-category-proposals">
            <i class="sl-icon-share-alt"></i> <?php echo e(cleanLang(__('lang.change_category'))); ?>

        </button>
    </div>
    <?php else: ?>
    <div class="x-notice">
        <?php echo e(cleanLang(__('lang.no_actions_available'))); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/proposals/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>