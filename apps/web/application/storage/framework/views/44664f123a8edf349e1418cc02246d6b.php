<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="display-flex flex-row comment-row" id="card_comment_<?php echo e($comment->comment_id); ?>">
    <div class="p-2 comment-avatar">
        <img src="<?php echo e(getUsersAvatar($comment->avatar_directory, $comment->avatar_filename)); ?>" class="img-circle"
            alt="<?php echo e($comment->first_name ?? runtimeUnkownUser()); ?>" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name"><?php echo e($comment->first_name ?? runtimeUnkownUser()); ?></div>
            <div class="col-sm-6 x-meta text-right">
                <!--meta-->
                <span class="x-date"><small><?php echo e(runtimeDateAgo($comment->comment_created)); ?></small></span>
                <!--actions: delete-->
                <?php if($comment->permission_delete_comment): ?>
                <span class="comment-actions"> | 
                    <a href="javascript:void(0)" class="js-delete-ux-confirm confirm-action-danger text-danger"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                        data-ajax-type="DELETE"
                        data-parent-container="card_comment_<?php echo e($comment->comment_id); ?>"
                        data-progress-bar="hidden"
                        data-url="<?php echo e(url('/')); ?>/leads/delete-comment/<?php echo e($comment->comment_id); ?>">
                        <small><?php echo e(cleanLang(__('lang.delete'))); ?></small>
                    </a>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="p-t-4"><?php echo clean($comment->comment_text); ?></div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/comment.blade.php ENDPATH**/ ?>