<?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-sm-12" id="card_attachment_<?php echo e($attachment->attachment_uniqiueid); ?>">
    <div class="file-attachment m-b-25">
        <?php if($attachment->attachment_type == 'image'): ?>
        <!--dynamic inline style-->
        <div class="">
            <a class="fancybox preview-image-thumb"
                href="storage/files/<?php echo e($attachment->attachment_directory); ?>/<?php echo e($attachment->attachment_filename); ?>"
                title="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>"
                alt="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>">
                <img class="x-image"
                    src="<?php echo e(url('storage/files/' . $attachment->attachment_directory .'/'. $attachment->attachment_thumbname)); ?>">
            </a>
        </div>
        <?php else: ?>
        <div class="x-image">
            <a class="preview-image-thumb" href="tasks/download-attachment/<?php echo e($attachment->attachment_uniqiueid); ?>"
                download>
                <?php echo e($attachment->attachment_extension); ?>

            </a>
        </div>
        <?php endif; ?>
        <div class="x-details">
            <div><span class="x-meta"><?php echo e($attachment->first_name ?? runtimeUnkownUser()); ?></span>
                [<?php echo e(runtimeDateAgo($attachment->attachment_created)); ?>]</div>
            <div class="x-name"><span
                    title="<?php echo e($attachment->attachment_filename); ?>"><?php echo e(str_limit($attachment->attachment_filename, 60)); ?></span>
            </div>
            <div class="x-tags">
                <?php $__currentLoopData = $attachment->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="x-each-tag"><?php echo e($tag->tag_title); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="x-actions"><strong>
                    <!--action: download-->
                    <a href="leads/download-attachment/<?php echo e($attachment->attachment_uniqiueid); ?>"
                        download><?php echo e(cleanLang(__('lang.download'))); ?>

                        <span class="x-icons"><i class="ti-download"></i></span></strong></a>

                <!--action: cover image-->
                <?php if($attachment->permission_set_cover): ?>
                <!--add cover---->
                <span id="cover_image_add_<?php echo e($attachment->attachment_id); ?>"
                    class="cover_image_buttons cover_image_buttons_add js-add-cover-image <?php echo e(runtimeCoverImageAddButton($attachment->attachment_uniqiueid, $attachment->lead_cover_image_uniqueid)); ?>"
                    data-image-url="storage/files/<?php echo e($attachment->attachment_directory); ?>/<?php echo e($attachment->attachment_filename); ?>"
                    data-progress-bar="hidden" data-add-cover-button="cover_image_add_<?php echo e($attachment->attachment_id); ?>"
                    data-remove-cover-button="cover_image_remove_<?php echo e($attachment->attachment_id); ?>"
                    data-cover-remove-button-url="<?php echo e(url('/leads/'.$attachment->attachmentresource_id.'/remove-cover-image')); ?>"
                    data-id="<?php echo e($attachment->attachmentresource_id); ?>"
                    data-url="<?php echo e(url('/leads/'.$attachment->attachmentresource_id.'/add-cover-image?imageid='.$attachment->attachment_uniqiueid)); ?>">
                    |
                    <strong><a href="javascript:void(0)"><?php echo app('translator')->get('lang.set_cover'); ?></a>
                    </strong></span>
                <!--remove cover---->
                <span id="cover_image_remove_<?php echo e($attachment->attachment_id); ?>"
                    class="cover_image_buttons cover_image_buttons_remove js-remove-cover-image  <?php echo e(runtimeCoverImageRemoveButton($attachment->attachment_uniqiueid, $attachment->lead_cover_image_uniqueid)); ?>"
                    data-progress-bar="hidden" data-add-cover-button="cover_image_add_<?php echo e($attachment->attachment_id); ?>"
                    data-remove-cover-button="cover_image_remove_<?php echo e($attachment->attachment_id); ?>"
                    data-id="<?php echo e($attachment->attachmentresource_id); ?>"
                    data-url="<?php echo e(url('/leads/'.$attachment->attachmentresource_id.'/remove-cover-image')); ?>">
                    |
                    <strong><a href="javascript:void(0)"><?php echo app('translator')->get('lang.remove_cover'); ?></a>
                    </strong></span>
                <?php endif; ?>

                <!--action: delete-->
                <?php if($attachment->permission_delete_attachment): ?>
                <span> |
                    <strong><a href="javascript:void(0)" class="text-danger js-delete-ux-confirm confirm-action-danger"
                            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                            data-parent-container="card_attachment_<?php echo e($attachment->attachment_uniqiueid); ?>"
                            data-progress-bar="hidden"
                            data-url="<?php echo e(url('/leads/delete-attachment/'.$attachment->attachment_uniqiueid)); ?>"><?php echo e(cleanLang(__('lang.delete'))); ?></a></strong></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/attachment.blade.php ENDPATH**/ ?>