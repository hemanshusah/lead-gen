<div class="col-12 align-self-center hidden checkbox-actions box-shadow-minimum"
    id="projects-checkbox-actions-container">
    <!--button-->
    <?php if(config('visibility.action_buttons_edit')): ?>
    <div class="x-buttons">
        <?php if(config('visibility.action_buttons_delete')): ?>
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-danger"
            data-type="form" data-ajax-type="POST" data-form-id="projects-list-table"
            data-url="<?php echo e(url('/projects/delete?type=bulk')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_selected_items'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-delete-projects">
            <i class="sl-icon-trash"></i> <?php echo e(cleanLang(__('lang.delete'))); ?></button>
        <?php endif; ?>
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal"
            data-modal-title="<?php echo e(cleanLang(__('lang.change_category'))); ?>"
            data-url="<?php echo e(urlResource('/projects/change-category')); ?>"
            data-action-url="<?php echo e(urlResource('/projects/change-category?type=bulk')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-projects">
            <i class="sl-icon-share-alt"></i> <?php echo e(cleanLang(__('lang.change_category'))); ?>

        </button>

        <!--change status-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo app('translator')->get('lang.change_status'); ?>"
            data-url="<?php echo e(urlResource('/projects/bulk-change-status')); ?>"
            data-action-url="<?php echo e(urlResource('/projects/bulk-change-status')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-projects">
            <i class="ti-bookmark"></i> <?php echo app('translator')->get('lang.change_status'); ?>
        </button>


        <!--change progress-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo app('translator')->get('lang.update_progress'); ?>"
            data-url="<?php echo e(urlResource('/projects/bulk-change-progress')); ?>"
            data-action-url="<?php echo e(urlResource('/projects/bulk-change-progress')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-progress-projects">
            <i class="mdi mdi-percent"></i> <?php echo app('translator')->get('lang.update_progress'); ?>
        </button>


        <?php if(auth()->user()->role->role_assign_projects == 'yes'): ?>
        <!--assign users-->
        <button type="button"
            class="btn btn-sm btn-default waves-effect waves-dark actions-modal-button js-ajax-ux-request"
            data-toggle="modal" data-target="#actionsModal" data-modal-title="<?php echo app('translator')->get('lang.assign_users'); ?>"
            data-url="<?php echo e(urlResource('/projects/change-assigned')); ?>"
            data-action-url="<?php echo e(urlResource('/projects/change-assigned?type=bulk')); ?>" data-action-method="POST"
            data-action-type="form" data-action-form-id="main-body" data-loading-target="actionsModalBody"
            data-skip-checkboxes-reset="TRUE" id="checkbox-actions-change-category-projects">
            <i class="sl-icon-people"></i> <?php echo app('translator')->get('lang.assign_users'); ?>
        </button>
        <?php endif; ?>


        <!--archive-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="projects-list-table"
            data-url="<?php echo e(url('/projects/bulk/archive')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.archives_projects'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-archive-projects">
            <i class="sl-icon-briefcase"></i> <?php echo e(cleanLang(__('lang.archive'))); ?></button>

        <!--restore-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="projects-list-table"
            data-url="<?php echo e(url('/projects/bulk/restore')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.restore_projects'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-archive-projects">
            <i class="sl-icon-folder-alt"></i> <?php echo e(cleanLang(__('lang.restore'))); ?></button>


        <!--stop timers-->
        <!--stop all timers-->
        <button type="button" class="btn btn-sm btn-default waves-effect waves-dark confirm-action-info"
            data-type="form" data-ajax-type="POST" data-form-id="projects-list-table"
            data-url="<?php echo e(url('/projects/bulk/stop-timers')); ?>"
            data-confirm-title="<?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" id="checkbox-actions-stop-timers-projects">
            <i class="ti-timer"></i> <?php echo e(cleanLang(__('lang.stop_all_timers'))); ?></button>
            
    </div>
    <?php else: ?>
    <div class="x-notice">
        <?php echo e(cleanLang(__('lang.no_actions_available'))); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/projects/components/actions/checkbox-actions.blade.php ENDPATH**/ ?>