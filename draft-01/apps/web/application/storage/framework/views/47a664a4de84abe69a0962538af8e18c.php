<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="status_<?php echo e($status->leadstatus_id); ?>">
    <td class="status_col_date">
        <span class="mdi mdi-drag-vertical cursor-pointer"></span>
        <!--sorting data-->
        <input type="hidden" name="sort-stages[<?php echo e($status->leadstatus_id); ?>]" value="<?php echo e($status->leadstatus_id); ?>">
        <?php echo e(runtimeLang($status->leadstatus_title)); ?>

        <!--system initial stage-->
        <?php if($status->leadstatus_system_default == 'yes' && $status->leadstatus_id == 1): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.required_leads_stage'))); ?>"></span>
        <span class="label label-light-info label-rounded"><?php echo e(cleanLang(__('lang.initial_stage'))); ?></span>

        <?php endif; ?>
        <!--system initial stage-->
        <?php if($status->leadstatus_system_default == 'yes' && $status->leadstatus_id == 2): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.required_leads_stage'))); ?>"></span>
        <span class="label label-light-info label-rounded"><?php echo e(cleanLang(__('lang.final_stage'))); ?></span>
        <?php endif; ?>
    </td>
    <td class="status_col_count"><?php echo e($status->count_leads); ?></td>
    <td class="status_col_color"><span class="bg-<?php echo e($status->leadstatus_color); ?>" id="fx-settimgs-leads-status">&nbsp;</span>
    </td>
    <td class="status_col_created_by">
        <img src="<?php echo e(getUsersAvatar($status->avatar_directory, $status->avatar_filename, $status->leadstatus_creatorid)); ?>" alt="user"
            class="img-circle avatar-xsmall">
            <?php echo e(checkUsersName($status->first_name, $status->leadstatus_creatorid)); ?>

        </td>
    <td class="status_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit" >
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                data-url="<?php echo e(url('/settings/leads/statuses/'.$status->leadstatus_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_lead_status'))); ?>"
                data-action-url="<?php echo e(url('/settings/leads/statuses/'.$status->leadstatus_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="status-td-container">
                <i class="sl-icon-note"></i>
            </button>
            <button type="button" title="<?php echo e(cleanLang(__('lang.move'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" title="<?php echo e(cleanLang(__('lang.move'))); ?>"
                data-url="<?php echo e(url('/settings/leads/move/'.$status->leadstatus_id)); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.move_leads'); ?>"
                data-action-url="<?php echo e(url('/settings/leads/move/'.$status->leadstatus_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="js-ajax-ux-request" data-action-ajax-loading-target="commonModalBody">
                <i class="sl-icon-share-alt"></i>
            </button>
            <?php if($status->leadstatus_system_default == 'no'): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>" class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_lead_status'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(url('/')); ?>/settings/leads/statuses/<?php echo e($status->leadstatus_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i class="sl-icon-trash"></i></span>
            <?php endif; ?>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/leads/table/ajax.blade.php ENDPATH**/ ?>