<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum" id="leads-checkbox-actions-container">
    <!--button-->
    <?php if(config('visibility.action_buttons_edit')): ?>
    <div class="x-buttons">
        <?php if(config('visibility.action_buttons_delete')): ?>
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="leads-list-table"
            data-url="<?php echo e(url('/leads/delete?type=bulk')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_selected_items'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-delete-leads">
            <i class="sl-icon-trash"></i> <?php echo e(cleanLang(__('lang.delete'))); ?>

        </button>
        <?php endif; ?>

        <!--change category-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal"
            data-modal-title="<?php echo e(cleanLang(__('lang.change_category'))); ?>"
            data-url="<?php echo e(urlResource('/leads/change-category')); ?>"
            data-action-url="<?php echo e(urlResource('/leads/change-category?type=bulk')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-leads">
            <i class="sl-icon-share-alt"></i> <?php echo e(cleanLang(__('lang.change_category'))); ?>

        </button>

        <!--change status-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo app('translator')->get('lang.change_status'); ?>"
            data-url="<?php echo e(urlResource('/leads/bulk-change-status')); ?>"
            data-action-url="<?php echo e(urlResource('/leads/bulk-change-status')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-leads">
            <i class="ti-bookmark"></i> <?php echo app('translator')->get('lang.change_status'); ?>
        </button>


        <!--archive-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="leads-list-table"
            data-url="<?php echo e(url('/leads/bulk/archive')); ?>" data-confirm-title="<?php echo e(cleanLang(__('lang.archive_leads'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-archive-leads">
            <i class="sl-icon-briefcase"></i> <?php echo e(cleanLang(__('lang.archive'))); ?></button>

        <!--restore-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="leads-list-table"
            data-url="<?php echo e(url('/leads/bulk/restore')); ?>" data-confirm-title="<?php echo e(cleanLang(__('lang.restore_leads'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-restore-leads">
            <i class="sl-icon-folder-alt"></i> <?php echo e(cleanLang(__('lang.restore'))); ?></button>



        <?php if(auth()->user()->role->role_assign_leads == 'yes'): ?>
        <!--assign users-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo app('translator')->get('lang.assign_users'); ?>"
            data-url="<?php echo e(urlResource('/leads/change-assigned')); ?>"
            data-action-url="<?php echo e(urlResource('/leads/change-assigned?type=bulk')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-leads">
            <i class="sl-icon-people"></i> <?php echo app('translator')->get('lang.assign_users'); ?>
        </button>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <div class="x-notice">
        <?php echo e(cleanLang(__('lang.no_actions_available'))); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/leads/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>