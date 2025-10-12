<!--each checklist-->
<?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $checklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="checklist-item clearfix" id="lead_checklist_container_<?php echo e($checklist->checklist_id); ?>" data-id="<?php echo e($checklist->checklist_id); ?>">
    <!--drag icon-->
    <span class="mdi mdi-drag-vertical cursor-pointer drag-handle position-absolute left-3 top-4 hidden"></span>
    <!--checkbox-->
    <input type="checkbox" class="filled-in chk-col-light-blue js-ajax-ux-request-default" name="card_checklist[<?php echo e($checklist->checklist_id); ?>]"
        data-url="<?php echo e(urlResource('/leads/toggle-checklist-status/'.$checklist->checklist_id)); ?>" data-ajax-type="post"
        data-type="form" data-form-id="lead_checklist_container_<?php echo e($checklist->checklist_id); ?>" data-notifications="disabled"
        id="lead_checklist_<?php echo e($checklist->checklist_id); ?>" 
        <?php echo e(runtimeChecklistCheckbox($checklist->permission_edit_delete_checklist)); ?>

        <?php echo e(runtimePrechecked($checklist->checklist_status)); ?>>
    <label class="checklist-label" for="lead_checklist_<?php echo e($checklist->checklist_id); ?>"></label>
    <span class="checklist-text <?php echo e(runtimePermissions('lead-edit-checklist', $checklist->permission_edit_delete_checklist)); ?>" data-toggle="edit" data-id="<?php echo e($checklist->checklist_id); ?>"
        data-action-url="<?php echo e(url('/leads/update-checklist/'.$checklist->checklist_id)); ?>"><?php echo e($checklist->checklist_text); ?></span>
    
    <?php if($checklist->permission_edit_delete_checklist): ?>

    <!--button to toggle checklist comments wrapper-->
    <a href="javascript:void(0)"
        class="checklist-comments-wrapper-toggle-button text-info checklist-action-buttons hidden"
        data-checklist-comments-textarea-wrapper="checklist-comments-textarea-wrapper-<?php echo e($checklist->checklist_id); ?>"
        title="<?php echo app('translator')->get('lang.add_comment'); ?>">
        <i class="mdi mdi-comment-outline"></i>
    </a>
    
    <!--delete action-->
    <a href="javascript:void(0)" class="x-action-delete checklist-item-delete checklist-action-buttons hidden  m-r-5 js-delete-ux js-ajax-ux-request"
        data-ajax-type="DELETE" data-parent-container="lead_checklist_container_<?php echo e($checklist->checklist_id); ?>"
        data-progress-bar="hidden" data-url="<?php echo e(url('/leads/delete-checklist/'.$checklist->checklist_id)); ?>"><i
            class="mdi mdi-delete text-default"></i></a>
   <?php endif; ?>

    <!--checklist comments wrapper-->
    <div class="checklist-comments-wrapper" id="checklist-comments-wrapper-<?php echo e($checklist->checklist_id); ?>">

        <!--post comment textarea wrapper; hidden by default-->
        <div class="checklist-comments-textarea-wrapper hidden"
            id="checklist-comments-textarea-wrapper-<?php echo e($checklist->checklist_id); ?>">

            <!--tinymce textarea-->
            <textarea class="form-control form-control-sm" rows="4" name="checklist-comment"
                id="checklist-comments-textarea-<?php echo e($checklist->checklist_id); ?>"></textarea>

            <!--checklist id hidden field-->
            <input type="hidden" name="checklist-comments-checklist-id" value="<?php echo e($checklist->checklist_id); ?>">

            <!--cancel button-->
            <div class="text-right">
                <button type="button" class="btn btn-default btn-xs checklist-comments-close-button"
                    data-tinymce-textarea-id="checklist-comments-textarea-<?php echo e($checklist->checklist_id); ?>"
                    data-textarea-wrapper="checklist-comments-textarea-wrapper-<?php echo e($checklist->checklist_id); ?>"
                    data-checklist-comments-post-button="checklist-comments-post-button-<?php echo e($checklist->checklist_id); ?>">
                    <?php echo app('translator')->get('lang.close'); ?>
                </button>

                <!--submit button-->
                <button type="button" class="btn btn-danger btn-xs x-submit-button checklist-comments-submit-button ajax-request"
                    data-url="<?php echo e(url('/leads/'.$checklist->checklistresource_id.'/post-checklist-comment')); ?>"
                    data-type="form" data-ajax-type="post"
                    data-form-id="checklist-comments-textarea-wrapper-<?php echo e($checklist->checklist_id); ?>"
                    data-tinymce-textarea-id="checklist-comments-textarea-<?php echo e($checklist->checklist_id); ?>"
                    data-button-loading-annimation="yes"
                    data-button-disable-on-click="yes"
                    data-checklist-comments-post-button="checklist-comments-post-button-<?php echo e($checklist->checklist_id); ?>">
                    <?php echo app('translator')->get('lang.post'); ?>
                </button>
            </div>
        </div>

        <!--display existing comments if any-->
        <div class="checklist-comments-list-wrapper hidden"
            id="checklist-comments-list-wrapper-<?php echo e($checklist->checklist_id); ?>">
            <?php if($checklist->comments && $checklist->comments->count() > 0): ?>
            <?php $__currentLoopData = $checklist->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('pages.lead.components.checklist-comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/checklist.blade.php ENDPATH**/ ?>