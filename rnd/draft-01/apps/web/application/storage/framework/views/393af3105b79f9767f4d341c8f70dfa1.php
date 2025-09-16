<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="category_<?php echo e($category->category_id); ?>">
    <td class="categories_col_name">
        <?php echo e(str_limit($category->category_name ?? '---', 60)); ?>

        <!--default-->
        <?php if($category->category_system_default == 'yes'): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.system_default'))); ?>"></span>
        <?php endif; ?>
    </td>
    <?php if(config('visibility.categories_col_created_by')): ?>
    <td class="categories_col_created_by">
        <img src="<?php echo e(getUsersAvatar($category->avatar_directory, $category->avatar_filename, $category->category_creatorid)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($category->first_name, $category->category_creatorid)); ?>

    </td>
    <?php endif; ?>

    <?php if(config('visibility.categories_col_date')): ?>
    <td class="categories_col_date">
        <?php echo e(runtimeDate($category->category_created)); ?>

    </td>
    <?php endif; ?>

    <?php if(config('visibility.categories_col_date')): ?>
    <td class="categories_col_items"><?php echo e($category->count); ?></td>
    <?php endif; ?>

    <!--ticket email integration (email piping)-->
    <?php if(config('visibility.categories_col_email_piping')): ?>
    <td class="categories_col_email_piping">

        <!--imap is enabled-->
        <?php if($category->category_meta_4 == 'enabled'): ?>
        <span class="display-inline-block"><?php echo e($category->category_meta_5); ?></span>
        <?php endif; ?>

        <!--imap is disabled-->
        <?php if($category->category_meta_4 != 'enabled'): ?>
        <span class="label label-outline-default"><?php echo app('translator')->get('lang.disabled'); ?></span>
        <?php endif; ?>

        <!--edit imap email settings-->
        <span
            class="display-inline-block vm m-l-5 opacity-7 cursor-pointer data-toggle-action-tooltip edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(url('/settings/tickets/emailintegration/category/'.$category->category_id)); ?>"
            data-loading-target="commonModalBody" data-modal-title="<?php echo e($page['department_email_integration'] ?? ''); ?>"
            data-action-url="<?php echo e(url('/settings/tickets/emailintegration/category/'.$category->category_id)); ?>"
            data-action-method="PUT" data-action-ajax-class="ajax-request"
            data-action-ajax-loading-target="categories-td-container">
            <i class="sl-icon-settings"></i>
        </span>
    </td>
    <td class="categories_col_email_last_checked">
        <?php echo e(runtimeDate($category->category_meta_2 ?? '---')); ?>

    </td>
    <td class="categories_col_email_last_fetched_count">
        <?php echo e($category->category_meta_23 ?? '---'); ?>

    </td>
    <td class="categories_col_email_total_count">
        <?php echo e($category->category_meta_24 ?? '---'); ?>

    </td>
    <?php endif; ?>
    <?php if(request('filter_category_type')=='project'): ?>
    <td class="categories_col_team" id="category_user_count_<?php echo e($category->category_id); ?>"><?php echo e($category->count_users); ?>

    </td>
    <?php endif; ?>
    <td class="categories_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <?php if($category->category_system_default == 'no'): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/categories/<?php echo e($category->category_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-trash"></i></span>
            <?php endif; ?>
            <!--edit-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(url('/categories/'.$category->category_id.'/edit?filter_category_type='.$category->category_type)); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e($page['edit_modal_action_title'] ?? ''); ?>"
                data-action-url="<?php echo e(url('/categories/'.$category->category_id.'?filter_category_type='.$category->category_type)); ?>"
                data-action-method="PUT" data-action-ajax-class=""
                data-action-ajax-loading-target="categories-td-container">
                <i class="sl-icon-note"></i>
            </button>
            <!--team members-->
            <?php if(request('filter_category_type')=='project'): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-warning btn-circle btn-sm edit-add-modal-button  js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(url('/categories/'.$category->category_id.'/team')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e($page['edit_team_members'] ?? ''); ?>"
                data-action-url="<?php echo e(url('/categories/'.$category->category_id.'/team')); ?>" data-action-method="put"
                data-action-ajax-class="" data-action-ajax-loading-target="categories-td-container">
                <i class="sl-icon-people"></i>
            </button>
            <?php endif; ?>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/categories/components/table/ajax.blade.php ENDPATH**/ ?>