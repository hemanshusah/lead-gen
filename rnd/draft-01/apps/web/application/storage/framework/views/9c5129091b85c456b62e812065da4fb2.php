<div class="x-section">
    <div class="x-title">
        <h6><?php echo app('translator')->get('lang.tags'); ?></h6>
    </div>
    <!--current tags-->
    <div id="card-tags-current-tags-container">
        <?php if(count($current_tags ?? []) >0): ?>
        <div class="x-tags">
            <?php $__currentLoopData = $current_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="x-each-tag"><?php echo e($current->tag_title); ?></span>
            <!--dynamic js script array-->
            <script>
                NX.array_1.push('<?php echo e($current->tag_title); ?>');
            </script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
        <div class="x-edit-tabs"><a href="javascript:void(0);" id="card-tags-button-edit"><?php echo app('translator')->get('lang.edit_tags'); ?></a>
        </div>
    </div>
    <!--edit tags-->
    <div id="card-tags-edit-tags-container" class="hidden">
        <select name="tags" id="card_tags"
            class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"
            multiple="multiple" tabindex="-1" aria-hidden="true">
            <!--array of selected tags-->
            <?php $__currentLoopData = $current_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $selected_tags[] = $selected->tag_title ; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--/#array of selected tags-->
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tag->tag_title); ?>"
                <?php echo e(runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags  ?? [])); ?>>
                <?php echo e($tag->tag_title); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div id="card-edit-tags-buttons" class="p-t-10 hidden text-right display-block">
            <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
                id="card-tags-button-cancel"><?php echo app('translator')->get('lang.close'); ?></button>
            <button type="button" class="btn waves-effect waves-light btn-xs btn-danger ajax-request"
                data-url="<?php echo e(url('leads/'.$lead->lead_id.'/update-tags')); ?>" data-progress-bar="hidden"
                data-type="form" data-form-id="card-tags-container" data-ajax-type="post"
                id="card-tags-button-save"><?php echo app('translator')->get('lang.save'); ?></button>
        </div>
    </div>
</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/components/tags.blade.php ENDPATH**/ ?>