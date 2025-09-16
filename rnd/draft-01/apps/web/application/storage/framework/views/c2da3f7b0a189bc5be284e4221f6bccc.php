<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum"
    id="tickets-checkbox-actions-container">
    <!--button-->
    <?php if(config('visibility.action_buttons_edit')): ?>
    <div class="x-buttons">
        <?php if(config('visibility.action_buttons_delete')): ?>
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="tickets-list-table"
            data-url="<?php echo e(url('/tickets/delete?type=bulk')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_selected_items'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-delete-tickets">
            <i class="sl-icon-trash"></i> <?php echo e(cleanLang(__('lang.delete'))); ?>

        </button>
        <?php endif; ?>

        <!--archive-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="tickets-list-table"
            data-url="<?php echo e(url('/tickets/archive?ref=list')); ?>"
            data-confirm-title="<?php echo app('translator')->get('lang.archive_tickets'); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-delete-tickets">
            <i class="ti-archive"></i> <?php echo app('translator')->get('lang.archive'); ?>
        </button>

        <!--restore-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="tickets-list-table"
            data-url="<?php echo e(url('/tickets/restore?ref=list')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.restore_tickets'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-delete-tickets">
            <i class="ti-folder"></i> <?php echo app('translator')->get('lang.restore'); ?>
        </button>

        <!--change status-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal"
            data-modal-title="<?php echo e(cleanLang(__('lang.change_status'))); ?>"
            data-url="<?php echo e(urlResource('/tickets/change-status')); ?>"
            data-action-url="<?php echo e(urlResource('/tickets/change-status?type=bulk')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-tickets">
            <i class="ti-bookmark"></i> <?php echo e(cleanLang(__('lang.change_status'))); ?>

        </button>


    </div>
    <?php else: ?>
    <div class="x-notice">
        <?php echo e(cleanLang(__('lang.no_actions_available'))); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/tickets/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>