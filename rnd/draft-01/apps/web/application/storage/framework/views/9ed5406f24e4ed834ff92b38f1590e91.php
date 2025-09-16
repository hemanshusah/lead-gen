<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="role_<?php echo e($role->role_id); ?>">
    <td class="roles_col_name">
        <?php echo e($role->role_name); ?>

        <!--default-->
        <?php if($role->role_system == 'yes'): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.system_default'))); ?>"></span>
        <?php endif; ?>
    </td>
    <td class="roles_col_users">
        <?php echo e($role->count_users); ?>

    </td>
    <td class="roles_col_type">
        <?php echo e($role->role_type); ?>

    </td>
    <td class="roles_col_status">
        <?php if($role->role_system == 'yes'): ?>
        <span class="label label-outline-default"><?php echo e(cleanLang(__('lang.default'))); ?></span>
        <?php else: ?>
        ---
        <?php endif; ?>
    </td>
    <td class="roles_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <?php if($role->role_id != 1): ?>
            <!--edit-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(url('/settings/roles/'.$role->role_id.'/edit')); ?>" data-loading-target="commonModalBody"
                data-modal-title="<?php echo e(cleanLang(__('lang.edit_user_role'))); ?>"
                data-modal-size="modal-xl"
                data-action-url="<?php echo e(url('/settings/roles/'.$role->role_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="roles-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <!--homepage-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit_home_page_setting'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(url('/settings/roles/'.$role->role_id.'/homepage')); ?>"
                data-loading-target="commonModalBody"
                data-modal-title="<?php echo e(cleanLang(__('lang.edit_home_page_setting'))); ?>"
                data-action-url="<?php echo e(url('/settings/roles/'.$role->role_id.'/homepage')); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="roles-td-container">
                <i class="ti-home"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-note"></i></span>
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="ti-home"></i></span>
            <?php endif; ?>
            <?php if($role->role_system == 'no'): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_user_role'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/settings/roles/<?php echo e($role->role_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-trash"></i></span>
            <?php endif; ?>

        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/settings/sections/roles/table/ajax.blade.php ENDPATH**/ ?>