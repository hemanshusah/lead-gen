<!--heading-->
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.my_notes'))); ?></div>



<!--Form Data-->
<div class="card-show-form-data " id="card-lead-mynotes">

    <?php if($has_note): ?>

    <div class="p-t-10">
        <?php echo _clean($note->note_description); ?>

    </div>
    <div class="form-data-row-buttons p-t-40">
        <button type="button" class="btn btn-danger btn-xs confirm-action-danger"
            data-loading-target="card-leads-left-panel" data-confirm-title="<?php echo app('translator')->get('lang.delete_item'); ?>"
            data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>"
            data-url="<?php echo e(url('/leads/content/'.$lead->lead_id.'/delete-mynotes')); ?>" data-ajax-type="DELETE"
            data-loading-class="loading-before-centre">
            <?php echo e(cleanLang(__('lang.delete'))); ?>

        </button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-info ajax-request"
            data-url="<?php echo e(url('leads/content/'.$lead->lead_id.'/edit-mynotes')); ?>"
            data-loading-class="loading-before-centre"
            data-loading-target="card-leads-left-panel"><?php echo app('translator')->get('lang.edit'); ?></button>
    </div>

    <?php else: ?>
    <div class="x-no-result">
        <img src="<?php echo e(url('/')); ?>/public/images/no-download-avialble.png" alt="404 - Not found" /> 
        <div class="p-t-20"><h4><?php echo e(cleanLang(__('lang.you_do_not_have_notes'))); ?></h4></div>
        <div class="p-t-10">
            <button class="btn btn-info btn-sm ajax-request"
            data-loading-class="loading-before-centre"
            data-loading-target="card-leads-left-panel"
            data-url="<?php echo e(url('/leads/content/'.$lead->lead_id.'/create-mynotes')); ?>" ><?php echo app('translator')->get('lang.create_notes'); ?></a>
        </div>
    </div>
    <?php endif; ?>

</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/lead/content/mynotes/show.blade.php ENDPATH**/ ?>