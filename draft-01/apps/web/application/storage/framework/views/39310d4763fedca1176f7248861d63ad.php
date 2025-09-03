<div class="card-attachments" id="card-attachments"
    data-upload-url="<?php echo e(url('/leads/'.$lead->lead_id.'/attach-files')); ?>">
    <div class="x-heading"><i class="mdi mdi-cloud-download"></i><?php echo e(cleanLang(__('lang.attachments'))); ?></div>
    <div class="x-content row" id="card-attachments-container">
        <!--dynamic content here-->
    </div>
    <?php if($lead->permission_participate): ?>
    <div class="x-action"><a class="card_fileupload" id="js-card-toggle-fileupload"
            href="javascript:void(0)"><?php echo e(cleanLang(__('lang.add_attachment'))); ?></a></div>


    <div class="hidden" id="card-fileupload-container">
        
        <!--tags-->
        <div class="form-group row">
            <label
                class="col-12 text-left control-label col-form-label required p-l-35"><?php echo e(cleanLang(__('lang.tags'))); ?></label>
            <div class="col-12 p-l-35">
                <select name="tags" id="tags"
                    class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible card-attachment-tags"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    <?php $__currentLoopData = $attachment_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($attachment_tag->tag_title); ?>">
                        <?php echo e($attachment_tag->tag_title); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <!--dropzone-->
        <div class="dropzone dz-clickable" id="card_fileupload">
            <div class="dz-default dz-message">
                <i class="icon-Upload-toCloud"></i>
                <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<!--attachemnts js--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/attachments.blade.php ENDPATH**/ ?>